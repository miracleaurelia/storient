@extends('layouts.master')

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
            <div class="col-md pb-2">
                {{-- $book->image --}}
                <img src='{{ URL::asset('/images/lib.jpg') }}' />
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
                        <p class="my-0">{{-- $book->description --}}Buku ini sangat bagus. Ini deskripsi dari buku tersebut.
                            Deskripsinya sangat panjang</p>
                        {{-- @if (member) --}}
                        <div class="row">
                            <div class="col-md-auto my-2">
                                <button class="btn-default">Buy</button>
                                <button class="btn-alternate">Rent</button>
                            </div>
                        </div>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-100 py-3 px-2">
            {{-- $book->preview --}}
            <embed type="application/pdf" src="{{ URL::asset('/files/test-preview.pdf') }}" height="800px"
                title="Book Preview">
        </div>
    </div>
@endsection
