@extends('layouts.master')

@section('title', 'Register')

@section('content')
    <div class="container pt-120 pb-100">
        <div class="row">
            <div class="col-12 d-flex flex-column align-items-center">
                <h1 class="mb-4">Create your account</h1>

                <div class="card p-3 col-6  registerFormContainer" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form action="/register" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="inputUsername">Username</label>
                            @error('username')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                id="inputUsername" aria-describedby="usernameHelp" placeholder="Enter username"
                                value="{{ old('username') }}">

                        </div>
                        <div class="form-group mb-3">
                            <label for="inputEmail">Email address</label>
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email"
                                value="{{ old('email') }}">

                        </div>
                        <div class="row">
                            <div class="form-group mb-3 col-6">
                                <label for="inputPassword">Password</label>
                                @error('password')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                                    placeholder="Password" value="{{ old('password') }}">
                            </div>
                            <div class="form-group mb-3 col-6">
                                <label for="inputConfirm">Confirm Password</label>
                                @error('password_confirmation')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="inputConfirm" placeholder="Confirmation Password"
                                    value="{{ old('password_confirmation') }}">

                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="inputPhoneNumber">Phone Number</label>
                            @error('phoneNumber')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="phoneNumber" class="form-control @error('phoneNumber') is-invalid @enderror"
                                id="inputPhoneNumber" placeholder="Phone Number" value="{{ old('phoneNumber') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="inputKTP">KTP No.</label>
                            @error('ktp')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="ktp" class="form-control @error('ktp') is-invalid @enderror"
                                id="inputKTP" placeholder="KTP" value="{{ old('ktp') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="inputAddress">Address</label>
                            @error('address')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="inputAddress" rows="3">{{ old('address') }}</textarea>

                        </div>

                        <div class="">
                            <button type="submit" class="btn btnRegisterForm">Create Account</button>
                            <p class="haveAccount">Already have an account? <a href="/login">Sign In</a></p>
                        </div>


                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
