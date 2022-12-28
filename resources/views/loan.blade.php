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
                                                <a href="#" data-uri="{{ route('returnBook', $urloans->id) }}"
                                                    class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#confirmReturnModal">
                                                    Return
                                                </a>
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
@endsection
