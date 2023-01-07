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
                                        <th>Qty</th>
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
                                            <td><p class="my-2">{{ $book->qty }}</p></td>
                                            <td><p class="my-2">Rp{{ $book->Book->price * $book->qty }}</p></td>
                                            <td class="">
                                                <a href="#" data-uri="{{ route('removeCartItem', $book->id) }}"
                                                    class="btn btn-danger btn-sm my-2" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal">
                                                    Delete
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-stock="{{ $book->Book->buy_stock }}"
                                                    data-currqty="{{ $book->qty }}" data-bs-target="#updateCartQtyModal" data-uri="{{ route('updateCart', $book->id) }}">
                                                    Update Qty
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $k++;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="text-end table-footer">
                                            <h5 class="p-0 m-0 fw-bold">Total Price: {{ $totalprice }}</h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
                <div class="form-group mb-3">
                    <label for="paymentProof" class="fw-bold">Proof of Payment Image</label>
                    <p>
                        Amount: <b>Rp{{ $totalprice }},00</b>
                        <br>
                        Transfer to 6280678866 BCA a/n John Doe
                    </p>
                    
                </div>
                <div class="d-flex justify-content-end">
                    <a href="#" data-uri=""
                        class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#checkout">
                        Checkout
                    </a>
                </div>
            
        </div>
        @else
            <div class="my-5 py-5 d-flex justify-content-center align-items-center">
                <h2 class="text-white">There are no items in your cart</h2>
            </div>
        @endif
    </section>

    {{-- MODAL CHECKOUT --}}

    <div class="modal fade" id="checkout" tabindex="-1" aria-labelledby="confirmReturnModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/cart" method="POST" class="container d-flex flex-column p-0 mt-3" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="confirmReturnModalLabel">Return Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 class="text-danger">Please read before checkout.</h4>
                        <p>
                            Amount: <b>Rp{{ $totalprice }},00</b>
                            <br>
                            Transfer to 6280678866 BCA a/n John Doe
                        </p>
                        <p>
                            Upload your payment proof below.
                        </p>
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group text-center">
                                    <input type="file" name="paymentProof" class="d-none" id="returnProof">
                                    <label for="paymentProof" class="d-block">
                                        <img src="{{ asset('images/upload-file.png') }}" alt="Upload Return Proof"
                                            class="w-50 rounded shadow-sm cursor-pointer" id="proof-preview">
                                    </label>
                                    <button type="button" class="btn btn-info btn-sm mt-3 shadow-sm" id="changeProofImage">
                                        Upload payment proof
                                    </button>
                                    @error('paymentProof')
                                        <span class="text-danger mt-2 d-block" role="alert">
                                            <h5 class="error">Payment proof must be uploaded</h5>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-sm">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let image = document.getElementById('returnProof')
        let imagePreview = document.getElementById('proof-preview')
        let changeImage = document.getElementById('changeProofImage')
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

        let fineImage = document.getElementById('fineProof')
        let fineImagePreview = document.getElementById('fine-preview')
        let changeFineImage = document.getElementById('changeFineImage')
        if (fineImage) {
            fineImage.onchange = (e) => {
                const [fineFile] = fineImage.files
                if (fineFile) {
                    fineImagePreview.src = URL.createObjectURL(fineFile)
                    changeFineImage.classList.remove('d-none')
                }
            }
            changeFineImage.onclick = () => fineImage.click()
        }

        let image2 = document.getElementById('returnProof2')
        let imagePreview2 = document.getElementById('proof-preview2')
        let changeImage2 = document.getElementById('changeProofImage2')
        if (image2) {
            image2.onchange = (e) => {
                const [file2] = image2.files
                if (file2) {
                    imagePreview2.src = URL.createObjectURL(file2)
                    changeImage2.classList.remove('d-none')
                }
            }
            changeImage2.onclick = () => image2.click()
        }
    </script>

@endsection
