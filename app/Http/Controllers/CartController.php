<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $books = Book::all();

        return view('cart')->with('books', $books);
    }
}
