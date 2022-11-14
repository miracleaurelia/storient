@extends('layouts.master')

@section('title', 'Display Book')

@section('content')
    <div class="container pt-120 pb-100">
        <h1 class="my-4 text-center">Book <span class="text-custom">Collections</span></h1>
        @include('partials.displayAllBooks')
    </div>
@endsection