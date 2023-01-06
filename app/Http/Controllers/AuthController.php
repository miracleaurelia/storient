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

    public function profile(){
        $member = auth()->user();
        return view('profile',compact('member'));
    }

    public function editProfile(){
        $member = auth()->user();
        return view('editProfile',compact('member'));
    }
    public function updateProfile(Request $request){
        $validate = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable','string', 'min:5', 'confirmed'],
            'password_confirmation' => ['same:password'],
            'phoneNumber' => ['required', 'digits_between:11,20', 'numeric'],
            'ktp' => ['required', 'digits:16'],
            'address' => ['required', 'string', 'min:5']
        ]);
        if($validate){
            $user = Auth::user();
            if($request->password == null){
                $user->update([
                    $user->name = $request->name,
                    $user->email = $request->email,
                    $user->address = $request->address,
                    $user->ktp = $request->ktp,
                    $user->phone = $request->phoneNumber,
                ]);
            }else{
                $user->update([
                    $user->name = $request->name,
                    $user->email = $request->email,
                    $user->address = $request->address,
                    $user->ktp = $request->ktp,
                    $user->phone = $request->phoneNumber,
                    $user->password = Hash::make($request->password)
                ]);
            }
            
            return redirect()->route('profile')->with('success_message','Successfully update profile');
        }
    }
}
