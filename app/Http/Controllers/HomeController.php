<?php
  
namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function home_redirect()
    {
        return view('home');
    }
    public function addItem_redirect()
    {
        return view('addProduct');
        //Munculkan Auth Login
    }
    public function index_home(){
        $products = DB::table('products')
            ->join('users', 'products.user_id', '=', 'users.id')
            ->where('user_id', '=', Auth::user()->id)
            ->select('products.*')
            ->simplePaginate(8); 
            $allTypes = DB::table('products')
            ->join('types', 'products.type_id', '=', 'types.id')
            ->where('products.user_id', '=', Auth::user()->id)
            ->select('types.name')
            ->distinct()
            ->pluck('name');
        return view('main', compact('products', 'allTypes'));
    }
    
    public function viewPageSearch(Request $request)
{
    $search = $request->input('search');
    $type = $request->input('type');
    $sortBy = $request->input('sort_by', 'name'); // Default sorting by name
    $sortOrder = $request->input('sort_order', 'asc'); // Default sort order ascending

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

    // Apply sorting
    $products = $query->select('products.*', 'types.name as type_name')
        ->orderBy($sortBy, $sortOrder) // Apply sorting
        ->paginate(8);

    return view('main', compact('products', 'search', 'type', 'allTypes'));
}


    


public function showProfile()
{
    $user = Auth::user();

    // Fetch recent changes
    $recentChanges = History::with('user')
        ->where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    // Get the current month's revenue (profit/loss)
    $currentMonth = now()->month;
    $currentYear = now()->year;
    
    // Fetch the transactions for the current month and year
    $profitLoss = DB::table('transactions')
        ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
        ->where('transactions.user_id', '=', $user->id)
        ->whereMonth('transactions.date', $currentMonth)
        ->whereYear('transactions.date', $currentYear)  // Add this to restrict to the current year
        ->select(DB::raw('SUM(CASE 
            WHEN transaction_types.name = "sell" THEN transactions.price 
            WHEN transaction_types.name = "buy" THEN -transactions.price 
            ELSE 0 END) as total_profit_loss'))
        ->value('total_profit_loss');

    return view('profile', compact('user', 'recentChanges', 'profitLoss'));
}




    public function index_addItem(Request $request)
    {
        //home ke add item? idk
        return view('addItem');

    }
}