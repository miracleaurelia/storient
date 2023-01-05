<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public static function createTransactionDetail($headerID){
        $carts = Cart::with(['CartItem','CartItem.Book'])
                ->where('carts.UserID','=',auth()->user()->id)
                ->first();
        foreach($carts->CartItem as $item){
            if ($item->Book->is_deleted == 0) {
                TransactionDetail::create([
                    'TransactionID' => $headerID,
                    'BookID' => $item->Book->id,
                ]);
            }
        }
    }
    //
    public function getTransactions(){

        // if ('member') {
        if (Auth::user()->isAdmin == 0){
            // $transaction = get transaction where current signed member username = transaction username
            $transactions = TransactionHeader::with(['TransactionDetail','User','TransactionDetail.Book'])
            ->where('transaction_headers.UserID','=',auth()->user()->id)
            ->get();
            return view('transaction',compact('transactions'));

        }else if(Auth::user()->isAdmin == 1){
            //get all trans where verified = false
            $transactions = TransactionHeader::with(['TransactionDetail', 'User', 'TransactionDetail.Book'])
            ->where('transaction_headers.isApproved','=','0')
                ->get();
            return view('transaction',compact('transactions'));
        }

    }

    public function verifyTransaction($id){
        $transaction = TransactionHeader::find($id);
        $transaction->isApproved = 1;
        $transaction->save();
        return redirect()->route('adminTransaction');
    }

    public function getSelectedTransaction($id){

        // if ('admin') {
            $transaction = TransactionHeader::find($id);
            return view('transactionDetail')->with('transaction', $transaction);
        // }

    }

}
