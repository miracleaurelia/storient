@extends('layouts.app')

@section('title', 'Manage Category')

@section('content')
    <div class="container pt-120">
        <section class="container pb-5">
            <div class="row py-3">
                <h3 class="text-center">All Categories</h3>
            </div>
            <a href="#" class="btn btn-warning mb-4"
                data-bs-toggle="modal"
                data-bs-target="#addModal"
                data-tip="edit"><i class="fa fa-plus"></i> Add Category</a>

            <div class="modal fade" id="addModal" tabindex="-1"
                aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form method="POST" action="/add/category">
                            @csrf
                            @method('post')
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addModalLabel">Add Category
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="book-form-main-field-container">
                                    <label class="main-field-label" for="addCatName">Category Name</label>
                                    <div class="book-form-field">
                                        <input type="text" class="book-input @error('addCatName') is-invalid @enderror" id="addCatName" name="addCatName" placeholder="Category Name" value="{{ old('addCatName') ? old('addCatName') : '' }}" style="padding-left: 15px">

                                        @error('addCatName')
                                            <span class="invalid-feedback" role="alert">
                                                <h5 class="error">{{$message}}</h5>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"
                                    data-bs-dismiss="modal">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if (count($categories) > 0)

                <div class="row">
                    <div class="col">
                        <div class="table-list">
                            <div class="table-list-body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $cat)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cat->name }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $cat->id }}"
                                                        data-tip="edit"><i class="fa fa-edit"></i> Edit</a>

                                                    <div class="modal fade" id="editModal{{ $cat->id }}" tabindex="-1"
                                                        aria-labelledby="editModalLabel{{ $cat->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <form method="POST" action="/update/category/{{ $cat->id }}">
                                                                    @csrf
                                                                    @method('post')
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="editModalLabel{{ $cat->id }}">Edit Category
                                                                        </h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="book-form-main-field-container">
                                                                            <label class="main-field-label" for="catName">Category Name</label>
                                                                            <div class="book-form-field">
                                                                                <input type="text" class="book-input @error('catName') is-invalid @enderror" id="catName" name="catName" placeholder="Category Name" value="{{ old('catName') ? old('catName') : $cat->name }}" style="padding-left: 15px">

                                                                                @error('catName')
                                                                                    <span class="invalid-feedback" role="alert">
                                                                                        <h5 class="error">{{$message}}</h5>
                                                                                    </span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            data-bs-dismiss="modal">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a href="#" data-uri="{{ route('deleteCategory', $cat->id) }}"
                                                        class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="my-5 py-5 d-flex justify-content-center align-items-center">
                    <h2 class="text-white">No categories exist. Please add one.</h2>
                </div>
            @endif
        </section>
    </div>
@endsection
