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
        $idx = 0;
        foreach($carts->CartItem as $item){
            if ($item->Book != null) {
                $totalprice += $item->Book->price * $item->qty;
            }else{
                unset($carts->CartItem[$idx]);
            }
            $idx = $idx + 1;
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
        $carts = Cart::with('User')->where('carts.UserID','=',auth()->user()->id)->first();
        if(!$carts){
            CartController::createCart();
        }
        $carts = Cart::with(['CartItem','CartItem.Book'])
                ->where('carts.UserID','=',auth()->user()->id)
                // ->where('CartItem.Book.is_deleted','=',0)
                ->first();
        // $carts = CartItem::with(['Cart'])
        //         // ->where('carts.UserID','=',auth()->user()->id)
        //         // ->where('CartItem.Book.is_deleted','=',0)
        //         ->get();
        // echo ($carts->CartItem[1]);
        // $carts = DB::table('carts')
        //     ->join('cart_items','cart_items.CartID','=','carts.id')
        //     ->join('books','books.id','=','cart_items.BookID')
        //     ->where('carts.UserID', '=', auth()->user()->id)
        //     ->where('books.is_deleted', '=', 0)
        //     ->first();
        $totalprice = 0;
        $idx = 0;
        if ($carts) {
            foreach($carts->CartItem as $item){
                if ($item->Book != null) {
                    $totalprice += $item->Book->price * $item->qty;
                }else{
                    unset($carts->CartItem[$idx]);
                }
                $idx = $idx + 1;
            }
        }
        return view('cart',compact('carts', 'totalprice'));
    }

    public function addToCart($id){
        $book = Book::findOrFail($id);
        if ($book->is_deleted == 1) {
            return view('notFound');
        }
        if ($book->buy_stock <= 0) {
            return redirect()->back()->with('error_message', 'Cannot buy/add to cart because item is out of stock');
        }
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

    public function removeCartItem($id) {

        $res = CartItem::find($id);

        if ($res->Book->is_deleted == 1) {
            return view('notFound');
        }

        $res->delete();

        if ($res) {
            return redirect()->route('memberCart')->with('success_message', 'Cart item removed successfully');
        }

        else {
            return redirect()->route('memberCart')->with('error_message', 'Something went wrong');
        }
    }

    protected function qtyValidator(array $data)
    {
        $rules = ['cartItemQty' => 'required'];
        $messages = ['cartItemQty.required' => 'Book quantity is required.'];
        return Validator::make($data, $rules, $messages);
    }

    public function updateCart(Request $request, $id) {
        $validator = $this->qtyValidator($request->all());

        $cartItem = CartItem::find($id);

        $max_qty = $cartItem->Book->buy_stock;

        $error_msg = 'Only ' . $max_qty . ' stock left';

        if ($request->cartItemQty > $max_qty) {
            return redirect('/cart')->withErrors(['cartItemQty' => $error_msg])->withInput()->with('error_message', "Please fill the book quantity correctly.");
        }

        if ($validator->fails()) {
            return redirect('/cart')->withErrors($validator)->withInput()->with('error_message', "Please fill the book quantity correctly.");
        }
        else {
            $cartItem->qty = $request->cartItemQty;
            $cartItem->save();

            return redirect()->route('memberCart')->with('success_message', 'Book quantity updated successfully');
        }
    }
}
