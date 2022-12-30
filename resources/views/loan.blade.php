@extends('layouts.app')

@section('title', 'Member Loan')

@section('content')
    <section class="container pt-120 pb-5">
        <div class="row py-3">
            <h1>My Book Loan History</h1>
        </div>
        @if ($returnedLoan->count() > 0)
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
                                            <th>Borrow DateTime</th>
                                            <th>Return DateTime</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($returnedLoan as $rloans)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <img src="/images/{{ $rloans->book->image }}" alt="book cover"
                                                                style="object-fit: cover">
                                                        </div>
                                                        <div class="col">
                                                            <p class="m-0 fw-bold">{{ $rloans->book->bookTitle }}</p>
                                                            <p class="m-0">by {{ $rloans->book->author }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $rloans->borrowTime }}
                                                </td>
                                                <td>
                                                    {{ $rloans->returnTime }}
                                                </td>
                                                <td>
                                                    @if ($rloans->isReturned == 1)
                                                    Unverified
                                                    @elseif ($rloans->isReturned == 2)
                                                    Verified
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="my-5 py-5 d-flex justify-content-center align-items-center">
                <h2 class="text-white">There are no items in your loan history</h2>
            </div>
        @endif
    </section>

    <section class="container pt-120 pb-5">
        <div class="row py-3">
            <h1>Current Book Loan</h1>
        </div>
        @if ($unreturnedLoan->count() > 0)
            <div>
                <div class="row">
                    <div class="col">
                        <div class="table-list">
                            <div class="table-list-body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Book</th>
                                            <th>Borrow DateTime</th>
                                            <th>Return Deadline DateTime</th>
                                            <th>Fine</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($unreturnedLoan as $urloans)
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <img src="/images/{{ $urloans->book->image }}" alt="book cover"
                                                                style="object-fit: cover">
                                                        </div>
                                                        <div class="col">
                                                            <p class="m-0 fw-bold">{{ $urloans->book->bookTitle }}</p>
                                                            <p class="m-0">by {{ $urloans->book->author }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $urloans->borrowTime }}
                                                </td>
                                                <td>
                                                    {{ $urloans->returnDeadlineTime }}
                                                </td>
                                                <td>
                                                    Rp{{ $urloans->fine }},00
                                                </td>
                                                <td>
                                                    @if ($urloans->fine == 0)
                                                        <a href="#" data-uri="{{ route('returnBook', $urloans->id) }}"
                                                            class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#confirmReturnModal">
                                                            Return
                                                        </a>
                                                    @else
                                                        <a href="#" data-uri="{{ route('returnBookWithFine', $urloans->id) }}"
                                                            class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#confirmReturnWithFineModal"
                                                            data-fine="{{ $urloans->fine }}">
                                                            Return
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="my-5 py-5 d-flex justify-content-center align-items-center">
                <h2 class="text-white">You currently do not borrow any book.</h2>
            </div>
        @endif
    </section>

    {{-- MODAL RETURN --}}
    <div class="modal fade" id="confirmReturnModal" tabindex="-1" aria-labelledby="confirmReturnModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formReturn" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="confirmReturnModalLabel">Return Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 class="text-danger">Please read before returning.</h4>
                        <p>
                            Please send this book as a package via JNE/Tiki/JnT or any expedition of your choice to:
                            <br>
                            <b>Jl. Kebon Jeruk Raya No. 27 Kebon Jeruk Jakarta Barat 11530.</b>
                            <br>
                            Upload your proof of book package delivery below.
                        </p>
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group text-center">
                                    <input type="file" name="returnProof2" class="d-none" id="returnProof2">
                                    <label for="returnProof2" class="d-block">
                                        <img src="{{ asset('images/upload-file.png') }}" alt="Upload Return Proof"
                                            class="w-50 rounded shadow-sm cursor-pointer" id="proof-preview2">
                                    </label>
                                    <button type="button" class="btn btn-info btn-sm mt-3 shadow-sm" id="changeProofImage2">
                                        Upload Proof of Book Return
                                    </button>
                                    @error('returnProof2')
                                        <span class="text-danger mt-2 d-block" role="alert">
                                            <h5 class="error">Proof of Book Return must be uploaded</h5>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-sm">Return</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL RETURN WITH FINE --}}
    <div class="modal fade" id="confirmReturnWithFineModal" tabindex="-1" aria-labelledby="confirmReturnWithFineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formReturnFine" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="confirmReturnWithFineModalLabel">Return Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 class="text-danger">Please read before returning.</h4>
                        <p>
                            Please send this book as a package via JNE/Tiki/JnT or any expedition of your choice to:
                            <br>
                            <b>Jl. Kebon Jeruk Raya No. 27 Kebon Jeruk Jakarta Barat 11530.</b>
                            <br>
                            Upload your proof of book package delivery below.
                        </p>
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group text-center">
                                    <input type="file" name="returnProof" class="d-none" id="returnProof">
                                    <label for="returnProof" class="d-block">
                                        <img src="{{ asset('images/upload-file.png') }}" alt="Upload Return Proof"
                                            class="w-50 rounded shadow-sm cursor-pointer" id="proof-preview">
                                    </label>
                                    <button type="button" class="btn btn-info btn-sm mt-3 shadow-sm" id="changeProofImage">
                                        Upload Proof of Book Return
                                    </button>
                                    @error('returnProof')
                                        <span class="text-danger mt-2 d-block" role="alert">
                                            <h5 class="error">Proof of Book Return must be uploaded</h5>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <p>
                            You also have to pay some fine for returning the book past the deadline.
                            <br>
                            Amount: <b>Rp<span id="fine"></span>,00</b>
                            <br>
                            To 6280678866 BCA a/n John Doe
                        </p>
                        <div class="row my-4 justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group text-center">
                                    <input type="file" name="fineProof" class="d-none" id="fineProof">
                                    <label for="fineProof" class="d-block">
                                        <img src="{{ asset('images/upload-file.png') }}" alt="Upload Fine Payment Proof"
                                            class="w-50 rounded shadow-sm cursor-pointer" id="fine-preview">
                                    </label>
                                    <button type="button" class="btn btn-info btn-sm mt-3 shadow-sm" id="changeFineImage">
                                        Upload Proof of Fine Payment
                                    </button>
                                    @error('fineProof')
                                        <span class="text-danger mt-2 d-block" role="alert">
                                            <h5 class="error">Proof of Fine Payment must be uploaded</h5>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-sm">Return</button>
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
