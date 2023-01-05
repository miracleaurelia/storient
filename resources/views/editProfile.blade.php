@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    {{-- @if ('BUKAN MEMBER')
    <div class="container pt-120">
        <h1 class="my-4 text-center">You must sign in to edit profile!</h1>
    </div> --}}

    {{-- @elseif ('MEMBER') --}}

    <div class="container pt-120">
        <h1 class="my-4 text-center">Edit Profile</h1>
        <div class="row py-5 mt-4 align-items-center">
            <div class="col-md-5 m-auto d-flex">
                <img src="{{ URL::asset('/images/edit_profile.png') }}" alt="" class="m-auto">
            </div>
            <div class="col-md-7 p-3 card bg-dark">
                <form action="/editProfile" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="inputUsername" class="text-white">Username</label>
                        @error('username')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" name="name" class="form-control @error('username') is-invalid @enderror"
                            id="inputUsername" aria-describedby="usernameHelp" placeholder="Enter username"
                            value="{{ $member->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputEmail" class="text-white">Email address</label>
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email"
                            value="{{ $member->email }}">
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="inputPassword" class="text-white">Password</label>
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                                placeholder="Password" >
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="inputConfirm" class="text-white">Confirm Password</label>
                            @error('password_confirmation')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" id="inputConfirm"
                                placeholder="Confirmation Password" value="">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputPhoneNumber" class="text-white">Phone Number</label>
                        @error('phoneNumber')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" name="phoneNumber"
                            class="form-control @error('phoneNumber') is-invalid @enderror" id="inputPhoneNumber"
                            placeholder="Phone Number" value="{{ $member->phone }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputKTP" class="text-white">KTP No.</label>
                        @error('ktp')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" name="ktp" class="form-control @error('ktp') is-invalid @enderror"
                            id="inputKTP" placeholder="KTP" value="{{ $member->ktp }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputAddress" class="text-white">Address</label>
                        @error('address')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="inputAddress" rows="3">{{ $member->address }}</textarea>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <button type="submit" class="btn-default">Save</button>
                        <a href="/profile"><button type="button" class="btn-alternate">Cancel</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- @endif --}}
@endsection
