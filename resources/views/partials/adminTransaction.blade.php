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
                                <th>Email</th>
                                <th></th>
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
                                    <td>"ini isi member email"{{-- $transaction->email --}}</td>
                                    <td>
                                        <a href="/transaction/{{$transaction->id}}" class="customViewLink">View Transaction</a>
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
        <h2 class="text-white">There are no transactions</h2>
    </div>
@endif
