@extends('layouts.app')

@section('title', 'Transaction Detail')

@section('content')
    <div class="container pt-120 pb-100">
        <div class="row">
            <p>
                <a href="/transaction" class="customViewLink">
                    <- Back to All Transactions </a>
            </p>
        </div>
        <div class="row">
            <div class="col">
                <h1>Transaction Id. {{ $transaction->id }}</h1>
                <p class="my-1"><b>Transaction by:</b><br>{{ $transaction->username }}</p>
                <p class="my-1"><b>Transaction Type:</b><br> {{ $transaction->type }}</p>
                <p class="my-1"><b>Purchase Date:</b><br> {{ $transaction->date }}</p>
                <p class="my-1"><b>Bought Price:</b><br> Rp.{{ $transaction->price }}</p>
            </div>
        </div>
    </div>
@endsection
