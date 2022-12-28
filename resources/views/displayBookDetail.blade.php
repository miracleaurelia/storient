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
        <div class="row">
            <div class="col-md pb-2 d-flex justify-content-center">
                <img src='{{ asset('images/' . $book->image) }}' />
            </div>
            <div class="col-md">
                <div class="row">
                    <div class="col">
                        <h1>{{ $book->bookTitle }}</h1>
                        <p class="my-0"><b>Author:</b>
                             {{ $book->author }}</p>
                        <p class="my-0"><b>Page Count:</b> {{ $book->pageCount }}</p>
                        <p class="my-0"><b>Release Year:</b> {{ $book->releaseYear }}</p>
                        <p class="my-0"><b>Category:</b> {{ $book->category }}</p>
                        <p class="my-0"><b>Description:</b></p>
                        <p class="my-0">{{ $book->description }}</p>
                        @if (Auth::user()->isAdmin == 0)
                            <div class="row">
                                <div class="col-md-auto my-2">
                                    <a class="btn-default" href={{route('addToCart',$book->id)}}>Add to cart</a>
                                    <a class="btn-alternate" href={{route('borrow',$book->id)}}>Borrow</a>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('editBook', $book->id) }}" class="btn btn-warning" data-tip="edit">Edit</a>

                            <a href="#" data-uri="{{ route('deleteDB', $book->id) }}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-100 py-3 px-2">
            {{-- $book->preview --}}
            <embed type="application/pdf" src="{{ asset('files/' . $book->preview) }}" height="800px"
                title="Book Preview">
        </div>
    </div>
@endsection
