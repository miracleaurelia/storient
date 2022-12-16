<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(){
        //get cart with user id
        $books = Book::all();

        return view('cart')->with('books', $books);
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
            return redirect()->route('home')->with('success_message', 'Checkout success, please wait for admin verification');
        }
    }
}
