<section class="container pb-5">
    <div class="row py-3">
        <h1>My Transactions</h1>
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
                                    <th>Products</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
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
                                        <td>(Array buku)</td>
                                        {{-- sum of all bought book price --}}
                                        {{-- <td>Rp{{ $transaction->sum(bookprice) }}</td> --}}
                                        <td>Rp100000 (ini sum)</td>
                                        <td>
                                            @if ($transaction->verified)
                                                <p class="p-0 m-0 text-success">Verified<p>
                                            @else
                                            <p class="p-0 m-0 text-danger">Unverified<p>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $k++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="my-5 py-5 d-flex justify-content-center align-items-center">
            <h2 class="text-white">You have no transactions</h2>
        </div>
    @endif
</section>
