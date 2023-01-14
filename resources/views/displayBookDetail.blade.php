@extends('layouts.app')

@section('title', $book->bookTitle)

@section('content')
    <div class="container pt-120 pb-100">

        <div class="row">
            <p>
                <a href="/display/book" class="customViewLink">
                    <- Back to All Books </a>
            </p>
        </div>

        <div class="row mainBookDetailContainer">
            <div class="col-md p-3 bookDetailBox d-flex mainBookDetailBox">
                <div class="col-md pb-2 d-flex justify-content-center flex-grow-1 mr-1">
                    <img style="max-height: 500px" src='{{ asset('images/' . $book->image) }}' />
                </div>
                <div class="col-md d-flex flex-grow-1">
                    <div class="row">
                        <div class="col ">
                            <h1 class="border-bottom border-dark">{{ $book->bookTitle }}</h1>
                            <p class="my-0">By (author) {{ $book->author }}</p>
                            <p class="my-0 mt-2"><b>Description:</b></p>
                            <p class="my-0">{{ $book->description }}</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md p-3 bookDetailBox">
                <h2 class="border-bottom border-dark pb-2">Rp. {{ $book->price }}</h2>
                <p>🚀 free delivery for member in Jakarta</p>
                <p>✔ Expected delivery to all regions of Indonesia in 3-7 business days</p>

                @guest
                    <a href="{{ route('login') }}" class="btn btn-warning">Login to Buy/Borrow</a>
                @else
                    @if (Auth::user()->isAdmin == 0)
                        <div class="row">
                            <div class="col-md-auto my-2">
                                @if ($book->buy_stock > 0)
                                    <a class="btn-default" href={{ route('addToCart', $book->id) }}>Add to cart</a>
                                @else
                                    <button class="btn-default btn-disabled btn-secondary" disabled>Out of buy
                                        stock</button>
                                @endif
                                @if ($book->borrow_stock > 0)
                                    <a href="#" data-uri="{{ route('borrow', $book->id) }}" class="btn btn-alternate"
                                        data-bs-toggle="modal" data-bs-target="#confirmBorrowModal">Borrow</a>
                                @else
                                    <button class="btn-default btn-disabled btn-secondary" disabled>Out of borrow
                                        stock</button>
                                @endif
                            </div>
                        </div>
                    @else
                        <a href="{{ route('editBook', $book->id) }}" class="btn btn-warning" data-tip="edit">Edit</a>

                        <a href="#" data-uri="{{ route('deleteDB', $book->id) }}" class="btn btn-danger"
                            data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</a>
                    @endif
                @endguest
            </div>

        </div>



        <div class="row my-5 bookDetailBox p-3">
            <h2>Product Detail</h2>
            <p class="my-0"><b>Page Count:</b> {{ $book->pageCount }} </p>
            <p class="my-0"><b>Release Year:</b> {{ $book->releaseYear }}</p>
            <p class="my-0"><b>Buy Stock:</b> {{ $book->buy_stock }}</p>
            <p class="my-0"><b>Borrow Stock:</b> {{ $book->borrow_stock }}</p>
            <p class="my-0"><b>Category:</b>
                @foreach ($book->category as $bc)
                    @if ($loop->last)
                        {{ $bc->name }}
                    @else
                        {{ $bc->name . ', ' }}
                    @endif
                @endforeach
            </p>
        </div>
        <div class="row w-100 py-3 px-2">
            {{-- $book->preview --}}
            <embed type="application/pdf" src="{{ asset('files/' . $book->preview) }}" height="800px" title="Book Preview">
        </div>
    </div>
@endsection
