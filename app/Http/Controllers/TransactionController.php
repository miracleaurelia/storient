<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    public function getTransactions(){

        // if ('member') {
            // $transaction = get transaction where current signed member username = transaction username
            // return view('transaction')->with('transaction', $transaction);

        // }else if ('admin') {
            $transactions = Transaction::all();
            return view('transaction')->with('transactions', $transactions);
        // }

    }

    public function getSelectedTransaction($id){

        // if ('admin') {
            $transaction = Transaction::find($id);
            return view('transactionDetail')->with('transaction', $transaction);
        // }

    }

}
