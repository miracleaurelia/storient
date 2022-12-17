<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function getTotalPrice(){
        $carts = Cart::with(['CartItem','CartItem.Book'])
                ->where('carts.UserID','=',auth()->user()->id)
                ->first();
        $totalprice = 0;
        foreach($carts->CartItem as $item){
            $totalprice = $totalprice + $item->Book->price;
        }
        return $totalprice;
    }
    
    public function createCart(){
        $user = auth()->user();
        Cart::create([
            'UserID' => $user->id
        ]);
    }
    public function index(){
        // CartController::createCart();
        $carts = Cart::with(['CartItem','CartItem.Book'])
                ->where('carts.UserID','=',auth()->user()->id)
                ->first();
        return view('cart',compact('carts'));
    }

    public function addToCart($id){
        $book = Book::findOrFail($id);
        $carts = Cart::with('User')->where('carts.UserID','=',auth()->user()->id)->first();
        if(!$carts){
            CartController::createCart();
        }
        $carts = Cart::with('User')->where('carts.UserID','=',auth()->user()->id)->first();
        CartItem::create([
            'CartID' => $carts->id,
            'BookID' => $book->id,
        ]);
        return redirect()->route('memberCart');
     }
    public function checkoutCart(Request $req){
        //clear cart with user id, trs add ke transaction
        $validator =  Validator::make($req->all(), [
            'paymentProof' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if($validator->fails()){
            return redirect()->route('memberCart')->withErrors($validator)->with('error_message', 'Please provide an image of the payment proof for this transaction');
        }else{
            //logic untuk hapus cart+add ke transaction
            $image = $req->file('paymentProof')->getClientOriginalName();
            $path = $req->file('paymentProof')->move('paymentProof/', $image);
            $carts = Cart::with('User')->where('carts.UserID','=',auth()->user()->id)->first();
            $price = CartController::getTotalPrice();
            $header = TransactionHeader::create([
                'UserID' => $carts->UserID,
                'totalPrice' => $price,
                'paymentProof' => $image,
                'isApproved' => false,
            ]);
            TransactionController::createTransactionDetail($header->id);
            Cart::with('User')
                ->where('carts.UserID', '=', auth()->user()->id)
                ->delete();
            return redirect()->route('home')->with('success_message', 'Checkout success, please wait for admin verification');
        }
    }
}
