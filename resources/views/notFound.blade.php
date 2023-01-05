@extends('layouts.app')

@section('title', 'Product Not Found')

@section('content')
    <div class="warning text-center d-flex flex-column justify-content-center align-items-center">
        <div class="row py-5 mt-4 align-items-center">
            <div class="col-md-6 pr-lg-5 mb-5 mb-md-0 insert-img">
                <img src="{{ URL::asset('/images/not-found.png') }}" alt="">
            </div>
            <div class="col-md-6 ml-auto d-flex flex-column justify-content-center align-items-center">
                @if (Auth::user()->isAdmin == 1)
                    <h3>Book does not exist/is deleted</h3>
                    <div class="d-flex">
                        <a href="/store/book" class="btn btn-warning">Insert Book</a>
                    </div>
                @else
                    <h3>Book does not exist/is deleted</h3>
                    <div class="d-flex">
                        <a href="/" class="btn btn-warning">Go To Home</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

