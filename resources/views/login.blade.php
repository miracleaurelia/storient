@extends('layouts.master')

@section('title', 'Login')

@section('content')
    <div class="container pt-120 pb-100">
        <div class="row">
            <div class="col-12 d-flex flex-column align-items-center">
                <h1 class="mb-4">Login</h1>

                <div class="card p-3 col-6 loginFormContainer" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    @if (session()->has('alert'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('alert') }}
                        </div>
                    @endif
                    @if (session()->has('loginError'))
                        <div class="text-danger">
                            {{ session('loginError') }}
                        </div>
                    @endif
                    <form action="{{ Route('loginUser') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1">Email address</label>
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"
                                value="{{ old('email') }}">

                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">Password</label>
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="exampleInputPassword1" placeholder="Password"
                                value="{{ old('password') }}">
                        </div>
                        <button type="submit" class="btn btnLoginForm w-100">Login</button>
                        <p class="dontHaveAccount">Don't have an account? <a href="/register">SignUp</a></p>

                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
