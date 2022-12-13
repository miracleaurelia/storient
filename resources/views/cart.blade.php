@extends('layouts.app')

@section('title', 'Member Cart')

@section('content')
    <section class="container pt-120 pb-5">
        <div class="row">
            <h1>My Cart</h1>
        </div>
        <div>
            @if (count($books) > 0)
                <div class="row">
                    <div class="col">
                        <div class="table-list">
                            <div class="table-list-body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Book</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $k = 1;
                                        @endphp
                                        @foreach ($books as $book)
                                            <tr>
                                                <td>{{ $k }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <img src="/images/{{ $book->image }}" alt="book cover" style="object-fit: cover">
                                                        </div>
                                                        <div class="col">
                                                            {{$book->bookTitle}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$book->price}}</td>
                                            </tr>
                                            @php
                                                $k++;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="fw-bold text-end table-footer">
                                                Total Price: {{$books->sum('price')}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container align-items-end p-0 mt-3">
                    <button class="btn cmn-btn mx-0 my-2">Checkout</button>
                </div>
            @else
                <div class="my-5 py-5 d-flex justify-content-center align-items-center">
                    <h2 class="text-white">There are no items in your cart</h2>
                </div>
            @endif

        </div>
    </section>
@endsection
