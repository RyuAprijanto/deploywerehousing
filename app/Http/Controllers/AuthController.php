<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\History;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_login()
    {
        return view('login');
        //login ke register
    }


    public function login(Request $request)
    {
        //
        $credential = $request->validate([

            'email' => 'required|email',
            'password' => 'required|min:5|max:20'

        ]);

        if (!Auth::attempt($credential, $request->input('remember'))){
            return redirect()->back()->withErrors('Invalid Credential!');
        }

        History::create([
            'user_id' => Auth::id(),
            'action' => 'Masuk',
            'product_id' => 0,
            'details' => 'Pengguna Masuk',
            'quantity' => 0,
            'action_time' => now(),
        ]);
        return redirect()->route('index_home');
    }

    public function register(Request $request)
    {
        //

        $request->validate([
            'inputEmail' => 'required|email',
            'inputUsername' => 'required',
            'inputPassword' => 'required|min:5|max:20',
        ]);

        if (User::where('email', $request->input('inputEmail'))->exists()) {
            return redirect()->back()->withErrors(['inputEmail' => 'Email already exists.']);
        }

        $newUser = new User();
        $newUser->email = $request->input('inputEmail');
        $newUser->username = $request->input('inputUsername');
        $newUser->password = Hash::make($request->input('inputPassword'));

        $newUser->save();

        return redirect()->route('index_login');

    }
    public function actionlogout()
    {
        History::create([
            'user_id' => Auth::id(),
            'product_id' => 0,
            'action' => 'Keluar',
            'quantity' => 0,
            'details' => 'Pengguna Keluar',
            'action_time' => now(),
        ]);
        Auth::logout();

        return redirect('/');
    }


    public function index_register(Request $request)
    {
        //register ke login
        return view('register');

    }

}
