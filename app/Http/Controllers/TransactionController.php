<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //
    public function getTransactions(){

        // if ('member') {
        if (Auth::user()->isAdmin == 0){
            // $transaction = get transaction where current signed member username = transaction username
            $transactions = Transaction::all();/*->where('memberId', $id) */
            return view('transaction')->with('transactions', $transactions);

        }else if(Auth::user()->isAdmin == 1){
            //get all trans where verified = false
            $transactions = Transaction::all()->where('verified',0);
            return view('transaction')->with('transactions', $transactions);
        }

    }

    public function verifyTransaction($id){
        $transaction = Transaction::find($id);
        $transaction->verified = 1;
        $transaction->save();
        return redirect()->route('adminTransaction');
    }

    public function getSelectedTransaction($id){

        // if ('admin') {
            $transaction = Transaction::find($id);
            return view('transactionDetail')->with('transaction', $transaction);
        // }

    }

}
