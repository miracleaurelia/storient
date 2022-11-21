<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:members|min:5',
            'email' => 'required|unique:members|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
            'phoneNumber' => 'required|numeric|digits_between:10,13',
            'ktp' => 'required|numeric|digits:16',
            'address' => 'required',
        ]);

        Member::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
            'phoneNumber' => $request->phoneNumber,
            'KTP' => $request->ktp,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Registered Successfully!');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $member = Member::where([['email', $request->email],['password', $request->password]])->first();

        if ($member) {
            return redirect('/');
        } else {
            return back()->with('error', 'User not found / Wrong Password')->withInput();
        }
    }

    public function getProfile()
    {
        //find by id nanti diganti jadi authorized member
        $member = Member::find(1);

        return view('profile')->with('member', $member);
    }

    public function getEditProfile()
    {
        //find by id nanti diganti jadi authorized member
        $member = Member::find(1);

        return view('editProfile')->with('member', $member);
    }

    public function editProfile(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:members|min:5',
            'email' => 'required|unique:members|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
            'phoneNumber' => 'required|numeric|digits_between:10,13',
            'ktp' => 'required|numeric|digits:16',
            'address' => 'required',
        ]);

        //find by id nanti diganti jadi authorized member
        $member = Member::find(1)->update($request->all());

        return redirect('/profile')->with('success', 'Profile successfully edited!');
    }

}
