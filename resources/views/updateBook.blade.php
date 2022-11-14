@extends('layouts.master')

@section('title', 'Update Book')

@section('content')
    <div class="container pt-120 pb-100">
        <h1 class="my-4 text-center">Select Book to <span class="text-custom">Update</span></h1>
        @include('partials.displayAllBooks')
    </div>
@endsection