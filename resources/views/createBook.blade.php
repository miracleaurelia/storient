@extends('layouts.app')

@section('title', 'Insert Book')

@section('content')
    <div class="container pt-120">
        <h1 class="my-4 text-center">Insert <span class="text-custom">Book</span></h1>
        <div class="row py-5 mt-4 justify-content-center align-items-center">
            <div class="col-md-6 pr-lg-5 mb-5 mb-md-0 bookForm-img">
                <div class="form-group text-center">
                    <label for="image" class="d-block">
                        <img src="{{ asset('images/upload-file.png') }}" alt="Upload Cover"
                            class="rounded shadow-sm cursor-pointer" id="image-preview">
                    </label>
                    <button type="button" class="btn btn-info btn-sm mt-3 shadow-sm"
                        id="changeImage">
                        Upload Book Image
                    </button>
                    @error('image')
                        <span class="text-danger mt-2 d-block" role="alert">
                            <h5 class="error">Image must be filled </h5>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 ml-auto">
                <div class="book-a book-card">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form action="{{ route('storeBook') }}" method="POST" id="form" class="book-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="book-form-main-field-container">
                            <label class="main-field-label" for="bookTitle">Book Title</label>
                            <div class="book-form-field">
                                <input type="text" class="book-input @error('bookTitle') is-invalid @enderror"
                                    id="bookTitle" name="bookTitle" placeholder="Book Title" value="{{ old('bookTitle') }}">
                                <label for="bookTitle"><i class="fas fa-book"></i></label>

                                @error('bookTitle')
                                    <span class="invalid-feedback" role="alert">
                                        <h5 class="error">{{$message}}</h5>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="book-form-main-field-container">
                            <label class="main-field-label" for="author">Book Author</label>
                            <div class="book-form-field">
                                <input type="text" class="book-input @error('author') is-invalid @enderror"
                                    id="author" name="author" placeholder="Book Author" value="{{ old('author') }}">
                                <label for="author"><i class="fas fa-user"></i></label>

                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <h5 class="error">{{$message}}</h5>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="book-form-main-field-container">
                            <label class="main-field-label" for="pageCount">Book's Page Count</label>
                            <div class="book-form-field">
                                <input type="number" class="book-input @error('pageCount') is-invalid @enderror"
                                    id="pageCount" name="pageCount" placeholder="Book's Page Count"
                                    value="{{ old('pageCount') }}">
                                <label for="pageCount"><i class="fas fa-sort-numeric-up"></i></label>

                                @error('pageCount')
                                    <span class="invalid-feedback" role="alert">
                                        <h5 class="error">{{$message}}</h5>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="book-form-main-field-container">
                            <label class="main-field-label" for="releaseYear">Book's Release Year</label>
                            <div class="book-form-field">
                                <input type="number" class="book-input @error('releaseYear') is-invalid @enderror"
                                    id="releaseYear" name="releaseYear" placeholder="Book's Release Year"
                                    value="{{ old('releaseYear') }}">
                                <label for="releaseYear"><i class="fas fa-calendar-alt"></i></label>

                                @error('releaseYear')
                                    <span class="invalid-feedback" role="alert">
                                        <h5 class="error">{{$message}}</h5>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="book-form-main-field-container">
                            <label class="main-field-label" for="category">Book's Category</label>
                            <div class="book-form-field d-flex">
                                <label for="category" style="position: initial"><i class="fas fa-th-large"></i></label>
                                <select style="border: none; border-radius: 0;"
                                    class="selectpicker @error('category') is-invalid @enderror" id="category" name="category[]" multiple data-live-search="true">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (in_array($category->id, old('category',[]))) selected="selected" @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <h5 class="error">{{$message}}</h5>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="book-form-main-field-container">
                            <label class="main-field-label" for="price">Book's Price</label>
                            <div class="book-form-field">
                                <input type="text" class="book-input @error('price') is-invalid @enderror" id="price"
                                    name="price" placeholder="Book's Price" value="{{ old('price') }}">
                                <label for="price"><i class="fas fa-solid fa-dollar-sign"></i></label>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <h5 class="error">{{$message}}</h5>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="book-form-main-field-container">
                            <label class="main-field-label" for="description">Book's Description</label>
                            <div class="book-form-field">
                                <input type="text" class="book-input @error('description') is-invalid @enderror"
                                    id="description" name="description" placeholder="Book's Description"
                                    value="{{ old('description') }}">
                                <label for="description"><i class="fas fa-regular fa-comment-dots"></i></label>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <h5 class="error">{{$message}}</h5>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="book-form-main-field-container d-none">
                            <input type="file" name="image" class="d-none" id="image">
                        </div>

                        <div class="book-form-main-field-container">
                            <label class="main-field-label" for="preview">Book's Preview</label>
                            <div class="book-form-field">
                                <input type="file" class="pt-2 book-input @error('preview') is-invalid @enderror"
                                    name="preview" id="preview" placeholder="Book's Preview"
                                    value="{{ old('preview') }}">
                                <label for="preview"><i class="fas fa-solid fa-file"></i></label>

                                @error('preview')
                                    <span class="invalid-feedback" role="alert">
                                        <h5 class="error">{{$message}}</h5>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="book-submit-frame d-flex justify-content-between">
                            <a class="submit-btn bg-danger" href="/display/book">Cancel</a>
                            <button class="submit-btn">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let image = document.getElementById('image')
        let imagePreview = document.getElementById('image-preview')
        let changeimage = document.getElementById('changeImage')
        if (image) {
            image.onchange = (e) => {
                const [file] = image.files
                if (file) {
                    imagePreview.src = URL.createObjectURL(file)
                    changeImage.classList.remove('d-none')
                }
            }
            changeImage.onclick = () => image.click()
        }
    </script>
@endsection
