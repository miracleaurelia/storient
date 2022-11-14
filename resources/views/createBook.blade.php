@extends('layouts.master')

@section('title', 'Insert Book')

@section('content')
    <div class="container pt-120">
        <h1 class="my-4 text-center">Insert <span class="text-custom">Book</span></h1>
        <div class="row py-5 mt-4 align-items-center">
            <div class="col-md-5 pr-lg-5 mb-5 mb-md-0 bookForm-img">
                <img src="{{URL::asset('/images/insert.png')}}" alt="">
            </div>
            <div class="col-md-7 ml-auto">
                <div class="book-a book-card">
                    @if(Session::has('success'))
                        <div class="alert alert-success text-center">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    <form action="{{route('storeBook')}}" method="POST" id="form" class="book-form">
                        @csrf
                        <div class="book-form-field">
                            <input type="text" class="book-input @error('bookTitle') is-invalid @enderror" id="bookTitle" name="bookTitle" placeholder="Book Title">
                            <label for="bookTitle"><i class="fas fa-book"></i></label>

                            @error('bookTitle')
                            <span class="invalid-feedback" role="alert">
                                <h5 class="error">Title must be filled & between 1-50 characters</h5>
                            </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="text" class="book-input @error('author') is-invalid @enderror" id="author" name="author" placeholder="Book Author">
                            <label for="author"><i class="fas fa-user"></i></label>

                            @error('author')
                            <span class="invalid-feedback" role="alert">
                                <h5 class="error">Author's name must be filled & between 1-50 characters</h5>
                            </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="number" class="book-input @error('pageCount') is-invalid @enderror" id="pageCount" name="pageCount" placeholder="Book's Page Count">
                            <label for="pageCount"><i class="fas fa-sort-numeric-up"></i></label>

                            @error('pageCount')
                            <span class="invalid-feedback" role="alert">
                                <h5 class="error">Page count must be filled & greater than 0</h5>
                            </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="number" class="book-input @error('releaseYear') is-invalid @enderror" id="releaseYear" name="releaseYear" placeholder="Book's Release Year">
                            <label for="releaseYear"><i class="fas fa-calendar-alt"></i></label>

                            @error('releaseYear')
                            <span class="invalid-feedback" role="alert">
                                <h5 class="error">Release Year must be filled</h5>
                            </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="text" class="book-input @error('category') is-invalid @enderror" id="category" name="category" placeholder="Book's Category">
                            <label for="category"><i class="fas fa-th-large"></i></label>

                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <h5 class="error">Category must be filled & is less than 25 characters</h5>
                            </span>
                            @enderror
                        </div>
                        <div class="book-submit-frame">
                            <button class="submit-btn">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection