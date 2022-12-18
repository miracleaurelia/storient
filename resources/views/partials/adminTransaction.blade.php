<section class="container pb-5">
    <div class="row py-3">
        <h1>Unverified Transactions</h1>
    </div>
    {{-- @php
        echo $transactions[0]->TransactionDetail
    @endphp --}}
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
                                    $k = 1;
                                @endphp
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $k }}</td>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->User->name }}</td>
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
                                    @php
                                        $k++;
                                    @endphp
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="my-5 py-5 d-flex justify-content-center align-items-center">
            <h2 class="text-white">There are no pending member transactions</h2>
        </div>
    @endif
</section>
