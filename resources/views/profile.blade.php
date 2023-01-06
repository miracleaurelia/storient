@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    <div class="container pt-120">
        <h1 class="my-4 text-center">My Profile</h1>
        <div class="row py-5 mt-4 align-items-center">
            <div class="col-md-5 m-auto d-flex">
                <img src="{{ URL::asset('/images/profile.png') }}" alt="" class="m-auto">
            </div>
            <div class="col-md-7 p-3 card bg-dark">
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="form-group mb-3">
                    <label class="text-white">Username</label>
                    <input type="text" class="form-control" value="{{ $member->name }}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label class="text-white">Email Address</label>
                    <input type="text" class="form-control" value="{{ $member->email }}" disabled>
                </div>
                {{-- <div class="form-group mb-3">
                    <label class="text-white">Password</label>
                    <input type="text" class="form-control" value="{{ $member->password }}" disabled>
                </div> --}}
                <div class="form-group mb-3">
                    <label class="text-white">Phone Number</label>
                    <input type="text" class="form-control" value="{{ $member->phone }}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label class="text-white">KTP No.</label>
                    <input type="text" class="form-control" value="{{ $member->ktp }}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label class="text-white">Address</label>
                    <input type="text" class="form-control" value="{{ $member->address }}" disabled>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="/editProfile"><button type="button" class="btn-default">Edit Profile</button></a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-danger py-2 px-4">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- @endif --}}
@endsection
