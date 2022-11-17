@extends('layouts.master')

@section('title', 'Edit Book Form')

@section('content')
    <div class="container pt-120">
        <h1 class="my-4 text-center">Enter Edit Book <span class="text-custom">Details</span></h1>
        <div class="row py-5 mt-4 align-items-center">
            <div class="col-md-5 pr-lg-5 mb-5 mb-md-0 bookForm-img">
                <img src="{{ URL::asset('/images/edit.png') }}" alt="">
            </div>
            <div class="col-md-7 ml-auto">
                <div class="book-a book-card">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form action="{{ route('updateBook', $book->id) }}" method="POST" id="form" class="book-form">
                        @csrf
                        <div class="book-form-field">
                            <input type="text" class="book-input @error('bookTitle') is-invalid @enderror" id="bookTitle"
                                name="bookTitle" placeholder="Book Title" value="{{ $book->bookTitle }}">
                            <label for="bookTitle"><i class="fas fa-book"></i></label>

                            @error('bookTitle')
                                <span class="invalid-feedback" role="alert">
                                    <h5 class="error">Title must be filled & between 1-50 characters</h5>
                                </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="text" class="book-input @error('author') is-invalid @enderror" id="author"
                                name="author" placeholder="Book Author" value="{{ $book->author }}">
                            <label for="author"><i class="fas fa-user"></i></label>

                            @error('author')
                                <span class="invalid-feedback" role="alert">
                                    <h5 class="error">Author's name must be filled & between 1-50 characters</h5>
                                </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="number" class="book-input @error('pageCount') is-invalid @enderror" id="pageCount"
                                name="pageCount" placeholder="Book's Page Count" value="{{ $book->pageCount }}">
                            <label for="pageCount"><i class="fas fa-sort-numeric-up"></i></label>

                            @error('pageCount')
                                <span class="invalid-feedback" role="alert">
                                    <h5 class="error">Page count must be filled & greater than 0</h5>
                                </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="number" class="book-input @error('releaseYear') is-invalid @enderror"
                                id="releaseYear" name="releaseYear" placeholder="Book's Release Year"
                                value="{{ $book->releaseYear }}">
                            <label for="releaseYear"><i class="fas fa-calendar-alt"></i></label>

                            @error('releaseYear')
                                <span class="invalid-feedback" role="alert">
                                    <h5 class="error">Release Year must be filled</h5>
                                </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="text" class="book-input @error('category') is-invalid @enderror" id="category"
                                name="category" placeholder="Book's Category" value="{{ $book->category }}">
                            <label for="category"><i class="fas fa-th-large"></i></label>

                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <h5 class="error">Category must be filled & is less than 25 characters</h5>
                                </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="text" class="book-input @error('price') is-invalid @enderror" id="price"
                                name="price" placeholder="Book's Price">
                            <label for="price"><i class="fas fa-solid fa-dollar-sign"></i></label>

                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <h5 class="error">Price must be filled </h5>
                                </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="text" class="book-input @error('description') is-invalid @enderror"
                                id="description" name="description" placeholder="Book's Description">
                            <label for="description"><i class="fas fa-regular fa-comment-dots"></i></label>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <h5 class="error">Description must be filled </h5>
                                </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="file" class="pt-2 book-input @error('image') is-invalid @enderror"
                                name="image" id="image" placeholder="Book's Image">
                            <label for="image"><i class="fas fa-regular fa-image"></i></label>

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <h5 class="error">Image must be filled </h5>
                                </span>
                            @enderror
                        </div>
                        <div class="book-form-field">
                            <input type="file" class="pt-2 book-input @error('preview') is-invalid @enderror"
                                name="preview" id="preview" placeholder="Book's Preview">
                            <label for="preview"><i class="fas fa-solid fa-file"></i></label>

                            @error('preview')
                                <span class="invalid-feedback" role="alert">
                                    <h5 class="error">Preview must be filled </h5>
                                </span>
                            @enderror
                        </div>
                        <div class="book-submit-frame d-flex justify-content-between">
                            <a class="submit-btn bg-danger" href="/updateView/book">Cancel</a>
                            <button class="submit-btn">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
