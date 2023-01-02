@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="container pt-120 pb-100">
    <h1 class="my-4 text-center">Search <span class="text-custom">Results</span></h1>
    @if (count($books) > 0)
        <div class="row">
            @foreach ($books as $book)
                <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                    <div class="card item-card">
                        <div class="item-cover d-flex justify-content-center">
                            <img src="/images/{{ $book->image }}" class="card-img-top" alt="book cover">
                        </div>
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <h5 class="card-title">{{ $book->bookTitle }}</h5>
                            <p class="card-text text-black">by <br> {{ $book->author }}</p>
                            <a href="/display/book/{{ $book->id }}"
                                class="btn btn-primary customViewLink">View Details</a>
                            @guest
                            @else
                                @if (Auth::user()->isAdmin == 1)
                                    <a href="{{ route('editBook', $book->id) }}" class="btn btn-warning mt-2"
                                        data-tip="edit"><i class="fa fa-edit"></i> Edit</a>

                                    <a href="#" data-uri="{{ route('deleteDB', $book->id) }}"
                                    class="btn btn-danger btn-sm mt-2" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal"><i class="fa fa-trash"></i> Delete</a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($books->hasPages())
                <div class="pagination-wrapper mt-3">
                    {{ $books->links() }}
                </div>
                <div class="mb-3">
                    Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} results
                </div>
            @endif
        </div>
    @else
        <div class="warning">
            <div class="row py-5 mt-4 align-items-center">
                <div class="col-md-6 pr-lg-5 mb-5 mb-md-0 insert-img">
                    <img src="{{ URL::asset('/images/not-found.png') }}" alt="">
                </div>
                <div class="col-md-6 ml-auto d-flex flex-column justify-content-center align-items-center">
                    <h3>No books were found with the keyword you entered.</h3>
                    <div class="d-flex">
                        <a href="/" class="cmn-btn">Go To Home</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
