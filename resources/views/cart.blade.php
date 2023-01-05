@extends('layouts.app')

@section('title', 'Member Cart')

@section('content')
    <section class="container pt-120 pb-5">
        <div class="row py-3">
            <h1>My Cart</h1>
        </div>
        @if (count($carts->CartItem) > 0)
        <div>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $k = 1;
                                    @endphp
                                    @foreach ($carts->CartItem as $book)
                                        <tr>
                                            <td>{{ $k }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-2">
                                                        <img src="/images/{{ $book->Book->image }}" alt="book cover"
                                                            style="object-fit: cover">
                                                    </div>
                                                    <div class="col">
                                                        <p class="m-0 fw-bold">{{ $book->Book->bookTitle }}</p>
                                                        <p class="m-0">by {{ $book->Book->author }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rp{{ $book->Book->price }}</td>
                                            <td>
                                                <a href="#" data-uri="{{ route('removeCartItem', $book->id) }}"
                                                    class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $k++;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-end table-footer">
                                            <h5 class="p-0 m-0 fw-bold">Total Price: {{ $totalprice }}</h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <form action="/cart" method="POST" class="container d-flex flex-column p-0 mt-3" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="paymentProof" class="fw-bold">Proof of Payment Image</label>
                    <p>
                        Amount: <b>Rp{{ $totalprice }},00</b>
                        <br>
                        Transfer to 6280678866 BCA a/n John Doe
                    </p>
                    <input type="file" name="paymentProof"
                        class="form-control @error('paymentProof') is-invalid @enderror" id="paymentProof">
                    @error('paymentProof')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mx-0 my-2 py-2 px-4">Checkout</button>
                </div>
            </form>
        </div>
        @else
            <div class="my-5 py-5 d-flex justify-content-center align-items-center">
                <h2 class="text-white">There are no items in your cart</h2>
            </div>
        @endif
    </section>
@endsection
