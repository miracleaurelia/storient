<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public static function createTransactionDetail($headerID){
        $carts = Cart::with(['CartItem','CartItem.Book'])
        ->where('carts.UserID','=',auth()->user()->id)
        ->first();

        foreach($carts->CartItem as $item){
            if ($item->Book != null) {
                TransactionDetail::create([
                    'TransactionID' => $headerID,
                    'BookID' => $item->Book->id,
                    'qty' => $item->qty
                ]);

                $currBook = Book::find($item->Book->id);
                $currQty = $currBook->buy_stock;
                $currBook->buy_stock = $currQty - $item->qty;
                $currBook->save();
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
            $unverifiedTransactions = TransactionHeader::with(['TransactionDetail', 'User', 'TransactionDetail.Book'])
            ->where('transaction_headers.isApproved','=','0')
                ->get();
            $verifiedTransactions = TransactionHeader::with(['TransactionDetail', 'User', 'TransactionDetail.Book'])
            ->where('transaction_headers.isApproved','=','1')
                ->get();
            return view('transaction',compact('unverifiedTransactions', 'verifiedTransactions'));
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
    public function banUser($id){
        $user = User::findOrFail($id);
        $user->status = 'Banned';
        $user->save();

        return redirect()->route('adminTransaction')->with('success_message', 'User banned successfully');
    }
}
