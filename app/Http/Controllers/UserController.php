<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index_profile()
    {
        $user = Auth::users();
        return view('profile', compact('user'));
    }
    public function editProfile()
{
    $user = Auth::user();
    return view('editProfile', compact('user'));
}

public function updateProfile(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        'password' => 'nullable|string|min:5|confirmed',
    ]);

    /** @var \App\Models\User $user **/
    $user = Auth::user();
    $user->username = $request->input('username');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    return redirect()->route('showProfile')->with('success', 'Profile updated successfully!');
}

    public function addSupplier(Request $request, $id)
    {
        /** @var \App\Models\User $seller **/
        $seller = auth()->user();
        $supplier = User::find($id);

        // Ensure the supplier exists and has the correct role
        if (!$supplier || !$supplier->role || $supplier->role->name !== 'supplier') {
            return response()->json(['message' => 'Supplier not found or invalid role'], 404);
        }

        // Check if the supplier is already added
        if ($seller->suppliers()->where('supplier_id', $supplier->id)->exists()) {
            return response()->json(['message' => 'Supplier already added'], 400);
        }

        // Attach the supplier
        $seller->suppliers()->attach($supplier);

        return response()->json(['message' => 'Supplier added successfully']);
    }


    public function removeSupplier(Request $request, $id)
    {
        /** @var \App\Models\User $seller **/
        $seller = auth()->user();
        $supplier = User::find($id);

        if (!$supplier || $supplier->role !== 'supplier') {
            return response()->json(['message' => 'Supplier not found or invalid role'], 404);
        }

        if (!$seller->suppliers()->where('supplier_id', $supplier->id)->exists()) {
            return response()->json(['message' => 'Supplier not found'], 400);
        }

        $seller->suppliers()->detach($supplier);

        return response()->json(['message' => 'Supplier removed successfully']);
    }

}
