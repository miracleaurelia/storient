<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput()
                ->with('error_message', 'Please fill in the form correctly');
        } else {
            return $this->create($request->all());
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'phoneNumber' => ['required', 'digits_between:11,20', 'numeric'],
            'ktp' => ['required', 'digits:16', 'unique:users'],
            'address' => ['required', 'string', 'min:5']
        ]);
    }

    protected function create(array $data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phoneNumber'],
            'ktp' => $data['ktp'],
            'address' => $data['address'],
            'isAdmin' => 0
        ]);

        return redirect('/login')->with('success_message', 'Account created successfully. Please login');
    }
}
