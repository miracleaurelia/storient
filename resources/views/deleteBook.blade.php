@extends('layouts.master')

@section('title', 'Delete Book')

@section('content')
    <div class="container pt-120 pb-100">
        <h1 class="my-4 text-center">Select Book to <span class="text-custom">Delete</span></h1>
        @if(Session::has('msg'))
            <div class="alert alert-success text-center">
                {{Session::get('msg')}}
            </div>
        @endif
        @include('partials.displayAllBooks')
    </div>
@endsection