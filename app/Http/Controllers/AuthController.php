<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ], [
    //         'email.required' => "Email must be filled",
    //         'password.required' => 'Password must be filled',
    //         'email.email' => 'email format is incorrect',
    //     ]);
    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         return redirect('/');
    //     }
    //     return redirect('/login')->with(['loginError' => 'Your email or password is wrong ']);
    // }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect('/');
    // }

}
