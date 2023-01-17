@extends('layouts.app')

@section('title', 'Admin Loan')

@section('content')
    <section class="container pt-120 pb-5">
        <div class="row py-3">
            <h1>All Users Book Loan History</h1>
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
                                            <th style="width: 250px">Book</th>
                                            <th>Borrow DateTime</th>
                                            <th>Return DateTime</th>
                                            <th>Return Proof</th>
                                            <th>Fine Payment Proof</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($returnedLoan as $rloans)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="/images/{{ $rloans->book->image }}" alt="book cover"
                                                                style="object-fit: cover">
                                                        </div>
                                                        <div class="col-8">
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
                                                    <a href="#"
                                                        class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#returnProofModal{{ $rloans->id }}"
                                                        >
                                                        See Image
                                                    </a>

                                                    <div class="modal fade" id="returnProofModal{{ $rloans->id }}" tabindex="-1"
                                                        aria-labelledby="returnProofModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="returnProofModalLabel">Loan
                                                                        {{ $rloans->id }} Proof of Return
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img
                                                                        src='{{ asset('returnProof/' . $rloans->returnProof) }}' />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($rloans->fineProof != null)
                                                    <a href="#"
                                                        class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#returnFineModal{{ $rloans->id }}"
                                                        >
                                                        See Image
                                                    </a>
                                                    @else
                                                    <button disabled
                                                        class="btn btn-danger btn-sm">
                                                        See Image
                                                    </button>
                                                    @endif

                                                    <div class="modal fade" id="returnFineModal{{ $rloans->id }}" tabindex="-1"
                                                        aria-labelledby="returnFineModalLabel{{ $rloans->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="returnFineModalLabel{{ $rloans->id }}">Loan
                                                                        {{ $rloans->id }} Proof of Fine Payment
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img
                                                                        src='{{ asset('fineProof/' . $rloans->fineProof) }}' />
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($rloans->isReturned == 1)
                                                        <a href="#" data-uri="{{ route('verifyBookReturn', $rloans->id) }}"
                                                            class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#confirmVerifyModal{{ $rloans->id }}">Verify</a>
                                                    @else
                                                        <button disabled
                                                            class="btn btn-secondary btn-sm"
                                                            >
                                                            Verify
                                                        </button>
                                                    @endif

                                                    <div class="modal fade" id="confirmVerifyModal{{ $rloans->id }}" tabindex="-1"
                                                        aria-labelledby="confirmVerifyModalLabel{{ $rloans->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="confirmVerifyModalLabel{{ $rloans->id }}">Loan
                                                                        {{ $rloans->id }} Verification
                                                                    </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    Are you sure you want to verify this loan's book return?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <form action="{{ route('verifyBookReturn', $rloans->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-primary"
                                                                            data-bs-dismiss="modal">Verify</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                <h2 class="text-white">No users have borrowed any book.</h2>
            </div>
        @endif
    </section>

    <section class="container pt-120 pb-5">
        <div class="row py-3">
            <h1>All Users Current Book Loan</h1>
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
                                            <th>No</th>
                                            <th style="width: 250px">Book</th>
                                            <th>User</th>
                                            <th>Borrow DateTime</th>
                                            <th>Return Deadline DateTime</th>
                                            <th>Fine</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($unreturnedLoan as $urloans)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="/images/{{ $urloans->book->image }}" alt="book cover"
                                                                style="object-fit: cover">
                                                        </div>
                                                        <div class="col-8">
                                                            <p class="m-0 fw-bold">{{ $urloans->book->bookTitle }}</p>
                                                            <p class="m-0">by {{ $urloans->book->author }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#userModal"
                                                        data-role="{{ $urloans->user->isAdmin }}"
                                                        data-status="{{ $urloans->user->status }}"
                                                        data-name="{{ $urloans->user->name }}"
                                                        data-email="{{ $urloans->user->email }}"
                                                        data-address="{{ $urloans->user->address }}"
                                                        data-phone="{{ $urloans->user->phone }}"
                                                        data-ktp="{{ $urloans->user->ktp }}">
                                                        {{ $urloans->user->name }}
                                                    </a>
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
                                                    @if ($urloans->user->status == 'Active')
                                                        <a href="#" data-uri="{{ route('banUser', $urloans->user->id) }}"
                                                            class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#confirmBanModal"
                                                            >
                                                            Ban User
                                                        </a>
                                                    @else
                                                        <button disabled
                                                            class="btn btn-secondary btn-sm"
                                                            >
                                                            Ban User
                                                        </button>
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
                <h2 class="text-white">No user currently borrow any book.</h2>
            </div>
        @endif
    </section>

    {{-- MODAL USER INFO --}}
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">User Information Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <div class="card p-3 py-4">
                            <div class="text-center mt-3">
                                <span class="role p-1 px-4 rounded text-white" id="user-role"></span>
                                <h5 class="mt-2 mb-0" id="user-name"></h5>
                                <div id="user-email"></div>
                                <div id="user-address"></div>
                                <div id="user-phone"></div>
                                <div id="user-ktp"></div>
                                <div class="button">
                                    <button class="btn px-4 ms-3"><a id="user-contact" href="" class="btn contact"
                                            target="_blank">Contact</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL BAN USER --}}
    <div class="modal fade" id="confirmBanModal" tabindex="-1" aria-labelledby="confirmBanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmBanModalLabel">Ban Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to ban this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form id="formBan" method="POST" action="">
                        @csrf
                        @method('get')
                        <button type="submit" class="btn btn-danger btn-sm">Ban User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .w-15 {
            width: 15%;
        }

        .mt-100 {
            margin-top: 100px;
        }

        .card {
            border: none;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
        }

        .card:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: #E1BEE7;
            transform: scaleY(1);
            transition: all 0.5s;
            transform-origin: bottom;
        }

        .card:after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: #8E24AA;
            transform: scaleY(0);
            transition: all 0.5s;
            transform-origin: bottom;
        }

        .card:hover::after {
            transform: scaleY(1);
        }

        .fonts {
            font-size: 11px;
        }

        .role {
            background-color: #8E24AA;
        }

        .contact {
            text-decoration: none;
            color: #8E24AA;
        }

        .button a {
            border: 1px solid #8E24AA !important;
            color: #8E24AA;
            height: 40px;
        }

        .button a:hover {
            border: 1px solid #8E24AA !important;
            height: 40px;
            background-color: #8E24AA;
            color: white;
        }
    </style>

    <script>
        if (document.getElementById('userModal') != null) {
            document.getElementById('userModal').addEventListener('show.bs.modal', (e) => {
                let role;
                if (e.relatedTarget.getAttribute('data-role') == 1) {
                    role = "Admin";
                }
                else {
                    role = "User"
                }
                document.getElementById('user-role').innerHTML = e.relatedTarget.getAttribute('data-status') + " " + role
                document.getElementById('user-name').innerHTML = e.relatedTarget.getAttribute('data-name')
                document.getElementById('user-email').innerHTML = e.relatedTarget.getAttribute('data-email')
                document.getElementById('user-address').innerHTML = e.relatedTarget.getAttribute('data-address')
                document.getElementById('user-phone').innerHTML = e.relatedTarget.getAttribute('data-phone')
                document.getElementById('user-ktp').innerHTML = e.relatedTarget.getAttribute('data-ktp')
                document.getElementById('user-contact').href = "https://wa.me/" + e.relatedTarget.getAttribute('data-phone')
            })
        }

        if ( document.getElementById('confirmBanModal') != null) {
            document.getElementById('confirmBanModal').addEventListener('show.bs.modal', (e) => {
                document.getElementById('formBan').setAttribute('action', e.relatedTarget.getAttribute('data-uri'))
            })
        }
    </script>

@endsection
