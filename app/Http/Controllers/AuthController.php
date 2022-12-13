<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

<<<<<<< HEAD
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

=======
    public function register(Request $request){
        $validate = $request->validate([
            'username' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|same:password',
            'address' => 'required|min:10',
            'phoneNumber' => 'required|numeric|digits:12',
            'ktp' => 'required|numeric|digits:16|'
        ], [
            
            
        ]);
        if($validate){
            $newUser = User::create([
                "name" => $request->username,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "phone" => $request->phoneNumber,
                "ktp" => $request->ktp,
                "address" => $request->address,
                "isAdmin" => false,
            ]);
            
            Auth::login($newUser);
            return redirect('/')->with(['success'=>'Register Succesfully']);
        }
    }
>>>>>>> 271b5884fb5cda41083407e9def924c76dbbab1c
}
