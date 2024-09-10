<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Checkout;
use App\Models\CheckoutItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function viewCheckout()
{
    // Retrieve checkout items and calculate total price
    $checkoutItems = session('checkoutItems', []);
    $totalPrice = array_reduce($checkoutItems, function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);
    $allTypes = DB::table('products')
            ->join('types', 'products.type_id', '=', 'types.id')
            ->where('products.user_id', '=', Auth::user()->id)
            ->select('types.name')
            ->distinct()
            ->pluck('name');
    // Pass products for the view
    $products = Product::all();
    return view('checkout', compact('checkoutItems', 'totalPrice', 'products','allTypes'));
}
public function checkoutviewPageSearch(Request $request)
{
    $search = $request->input('search');
    $type = $request->input('type');

    // Fetch all unique types
    $allTypes = DB::table('products')
        ->join('types', 'products.type_id', '=', 'types.id')
        ->where('products.user_id', '=', Auth::user()->id)
        ->select('types.name')
        ->distinct()
        ->pluck('name');

    $query = DB::table('products')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->join('types', 'products.type_id', '=', 'types.id') // Always join the types table
        ->where('products.user_id', '=', Auth::user()->id);

    // Search bar
    if ($search) {
        $query->where('products.name', 'LIKE', "%{$search}%");
    }

    // Filter bar
    if ($type && $type !== 'All') {
        $query->where('types.name', $type);
    }

    $products = $query->select('products.*', 'types.name as type_name')->paginate(8); // Explicitly select columns

    // Retrieve checkout items from session
    $checkoutItems = session('checkoutItems', []);

    // Calculate total price for checkout items
    $totalPrice = array_reduce($checkoutItems, function ($carry, $item) {
        return $carry + ($item['quantity'] * $item['price']);
    }, 0);

    return view('checkout', compact('products', 'search', 'type', 'allTypes', 'checkoutItems', 'totalPrice'));
}

public function addToCheckout(Request $request, $id)
{
    // Retrieve or create a checkout session
    $checkoutItems = session('checkoutItems', []);
    
    // Find the product
    $product = Product::findOrFail($id);
    
    // Check if the product is already in the checkout
    if (isset($checkoutItems[$id])) {
        $checkoutItems[$id]['quantity'] += $request->input('quantity');
    } else {
        $checkoutItems[$id] = [
            'product' => $product,
            'quantity' => $request->input('quantity'),
            'price' => $product->sell_price
        ];
    }

    // Save the updated checkout items to the session
    session(['checkoutItems' => $checkoutItems]);
    
    return redirect()->route('viewCheckout');
}

public function updateQuantity(Request $request, $productId)
{
    // Find the product
    $product = Product::findOrFail($productId);

    // Get the current checkout item
    $checkoutItem = session('checkoutItems')[$productId] ?? null;

    // Check if the checkout item exists
    if (!$checkoutItem) {
        return back()->withErrors(['message' => 'Item not found in checkout']);
    }

    // Determine the action (increase or decrease)
    $action = $request->input('action');
    $newQuantity = $checkoutItem['quantity'];

    if ($action === 'increase') {
        $newQuantity++;
    } elseif ($action === 'decrease') {
        $newQuantity--;
    }

    // Validate the new quantity
    if ($newQuantity <= 0) {
        // Remove the item if the quantity is zero or less
        unset(session('checkoutItems')[$productId]);
        return back()->with('message', 'Item removed from checkout');
    }

    if ($product->stock < $newQuantity) {
        return back()->withErrors(['message' => 'Not enough stock for ' . $product->name]);
    }

    // Update the quantity in the session
    session()->put("checkoutItems.$productId.quantity", $newQuantity);

    // Recalculate total price (optional, if needed)
    $this->recalculateTotalPrice();

    return back()->with('message', 'Quantity updated successfully');
}

private function recalculateTotalPrice()
{
    $checkoutItems = session('checkoutItems', []);
    $totalPrice = 0;

    foreach ($checkoutItems as $item) {
        $totalPrice += $item['quantity'] * $item['price'];
    }

    session()->put('totalPrice', $totalPrice);
}

public function removeItem(Request $request, $id)
{
    $checkoutItems = session('checkoutItems', []);
    
    if (isset($checkoutItems[$id])) {
        unset($checkoutItems[$id]);
        session(['checkoutItems' => $checkoutItems]);
    }

    return redirect()->route('viewCheckout');
}

public function processCheckout(Request $request)
{
    $checkoutItems = session('checkoutItems', []);
    $userId = Auth::id();
    
    // Calculate the total price of the checkout
    $totalPrice = array_reduce($checkoutItems, function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    DB::beginTransaction();  // Start a database transaction

    try {
        // Create the checkout record
        $checkoutId = DB::table('checkouts')->insertGetId([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Create records for each item in the checkout
        foreach ($checkoutItems as $item) {
            DB::table('checkout_items')->insert([
                'checkout_id' => $checkoutId,
                'product_id' => $item['product']->id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            // Update product stock
            Product::where('id', $item['product']->id)
                ->decrement('stock', $item['quantity']);
        }

        // Retrieve the transaction type ID for "Sell"
        $transactionTypeId = DB::table('transaction_types')
            ->where('name', 'sell')
            ->value('id');
        
        if (!$transactionTypeId) {
            throw new \Exception('Transaction type "Sell" not found.');
        }

        // Insert the sell transaction record into the transactions table
        DB::table('transactions')->insert([
            'user_id' => $userId,
            'transaction_type_id' => $transactionTypeId,
            'date' => now(),
            'price' => $totalPrice,
            'description' => 'Checkout Transaction ID: ' . $checkoutId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::commit();  // Commit the transaction

        // Clear the checkout session
        session()->forget('checkoutItems');

        return redirect()->route('index_home')->with('success', 'Checkout processed successfully.');
    } catch (\Exception $e) {
        DB::rollBack();  // Rollback on failure
        return redirect()->route('index_home')->with('error', 'Checkout failed: ' . $e->getMessage());
    }
}


public function viewCheckouts()
{
    // Fetching the checkouts with their related checkoutItems
    $checkouts = Checkout::with('checkoutItems')->get();

    return view('viewCheckouts', compact('checkouts'));
}

    // Method to display details of a specific checkout
    public function checkoutsDetails($id)
{
    // Find the specific checkout by its ID and load related checkoutItems and their products
    $checkout = Checkout::with('checkoutItems.product')->findOrFail($id);
    
    return view('checkoutDetails', compact('checkout'));
}
}
