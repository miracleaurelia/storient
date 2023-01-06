<section class="container pb-5">
    <div class="row py-3">
        <h1>Unverified Transactions</h1>
    </div>
    @if (count($transactions) > 0)
        <div class="row">
            <div class="col">
                <div class="table-list">
                    <div class="table-list-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Transaction ID</th>
                                    <th>Customer Name</th>
                                    <th>Products</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $k = 0;
                                @endphp
                                @foreach ($transactions as $transaction)
                                    @if($transaction->isApproved == 0)
                                    <tr>
                                        <td>{{ ++$k }}</td>
                                        <td>{{ $transaction->id }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#userModal"
                                                data-role="{{ $transaction->User->isAdmin }}"
                                                data-status="{{ $transaction->User->status }}"
                                                data-name="{{ $transaction->User->name }}"
                                                data-email="{{ $transaction->User->email}}"
                                                data-address="{{ $transaction->User->address }}"
                                                data-phone="{{ $transaction->User->phone }}"
                                                data-ktp="{{ $transaction->User->ktp }}">
                                            {{$transaction->User->name}}
                                        </a>
                                        </td>
                                        <td>
                                            @foreach ($transaction->TransactionDetail as $book)
                                                <p>{{$book->Book->bookTitle}}</p>
                                            @endforeach

                                        </td>
                                        <td>{{$transaction->totalPrice}}</td>
                                        <td class="d-flex justify-content-end align-items-center">
                                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#paymentProofModal{{ $transaction->id }}">Verify</a>
                                        </td>
                                    </tr>
                                    
                                    
                                    <div class="modal fade" id="paymentProofModal{{ $transaction->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Transaction
                                                        {{ $transaction->id }} Proof of Payment
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img style="object-fit: cover" class="w-100"
                                                        src='{{ asset('paymentProof/' . $transaction->paymentProof) }}' />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form action="/adminTransactions/{{ $transaction->id }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Accept</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($k == 0)
            <div class="my-5 py-5 d-flex justify-content-center align-items-center">
                <h2 class="text-white">There are no pending member transactions</h2>
            </div>
        @endif
    @else
        <div class="my-5 py-5 d-flex justify-content-center align-items-center">
            <h2 class="text-white">There are no pending member transactions</h2>
        </div>
    @endif
    
    {{-- ================================================================================ --}}

    <div class="row py-3">
        <h1>Verified Transactions</h1>
    </div>
    @if (count($transactions) > 0)
        <div class="row">
            <div class="col">
                <div class="table-list">
                    <div class="table-list-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Transaction ID</th>
                                    <th>Customer Name</th>
                                    <th>Products</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $k = 0;
                                @endphp
                                @foreach ($transactions as $transaction)
                                    @if ($transaction->isApproved == 1)
                                    <tr>
                                        <td>{{ ++$k }}</td>
                                        <td>{{ $transaction->id }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#userModal"
                                                data-role="{{ $transaction->User->isAdmin }}"
                                                data-status="{{ $transaction->User->status }}"
                                                data-name="{{ $transaction->User->name }}"
                                                data-email="{{ $transaction->User->email}}"
                                                data-address="{{ $transaction->User->address }}"
                                                data-phone="{{ $transaction->User->phone }}"
                                                data-ktp="{{ $transaction->User->ktp }}">
                                            {{$transaction->User->name}}
                                        </a>
                                        </td>
                                        <td>
                                            @foreach ($transaction->TransactionDetail as $book)
                                                <p>{{$book->Book->bookTitle}}</p>
                                            @endforeach

                                        </td>
                                        <td>{{$transaction->totalPrice}}</td>
                                        <td class="d-flex justify-content-end align-items-center">
                                            <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#paymentProof{{ $transaction->id }}">Verified (View Payment Proof)</a>
                                        </td>
                                    </tr>
                                    
                                    <div class="modal fade verified" id="paymentProof{{ $transaction->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Transaction
                                                        {{ $transaction->id }} Proof of Payment
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img style="object-fit: cover" class="w-100"
                                                        src='{{ asset('paymentProof/' . $transaction->paymentProof) }}' />
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if ($k == 0)
            <div class="my-5 py-5 d-flex justify-content-center align-items-center">
                <h2 class="text-white">There are no verified member transactions</h2>
            </div>
        @endif
    @else
        <div class="my-5 py-5 d-flex justify-content-center align-items-center">
            <h2 class="text-white">There are no verified member transactions</h2>
        </div>
    @endif


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
</section>
