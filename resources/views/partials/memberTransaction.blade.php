@if (count($transactions) > 0)
    <div class="row">
        <div class="col">
            <div class="table-list">
                <div class="table-list-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Transaction Type</th>
                                <th>Transaction Date</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $k = 1;
                            @endphp
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $k }}</td>
                                    <td>{{ $transaction->username }}</td>
                                    <td>{{ $transaction->type }}</td>
                                    <td>{{ $transaction->date }}</td>
                                    <td>Rp.{{ $transaction->price }}</td>
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
    <div class="my-5 py-5 d-flex flex-column justify-content-center align-items-center">
        <h2 class="text-white">You have no transactions</h2>
        <a href="/display/book"><p class="customViewLink">Click here to browse our books!</p></a>
    </div>
@endif
