@extends('layouts.app')

@section('title', 'Transactions')

@section('content')
    <div class="container pt-120">
        {{-- @if ('BUKAN MEMBER')
            <div class="container pt-120">
            <h1 class="my-4 text-center">You must sign in to view transactions!</h1>
            </div> --}}

        {{-- @elseif ('MEMBER') --}}
        @if (Auth::user()->isAdmin == 0)
            {{-- <h1 class="my-4 text-center">My Transactions</h1> --}}
            @include('partials.memberTransaction')
        @elseif (Auth::user()->isAdmin == 1)
            {{-- <h1 class="my-4 text-center">All Member Transactions</h1> --}}
            @include('partials.adminTransaction')
        @endif
    </div>

@endsection
