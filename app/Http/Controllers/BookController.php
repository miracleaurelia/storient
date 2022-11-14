<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function createBook() {
        return view('createBook');
    }

    public function storeBook(Request $request) {
        $this->validate($request, [
            'bookTitle' => 'required|min:1|max:50',
            'author' => 'required|min:1|max:50',
            'pageCount' => 'required|numeric|min:0|not_in:0',
            'releaseYear'=>'required|numeric',
            'category' => 'required|max:25'
        ]);

        Book::create([
            'bookTitle' => $request->bookTitle,
            'author' => $request->author,
            'pageCount' => $request->pageCount,
            'releaseYear' => $request->releaseYear,
            'category' => $request->category
        ]);

        return back()->with('success', 'Book successfully inserted. Fill the form below to insert another.');
    }

    public function showBook() {
        $books = Book::all();
        return view('displayBook', compact('books'));
    }

    public function updateBookView() {
        $books = Book::all();
        return view('updateBook', compact('books'));
    }

    public function edit($id) {
        $book = Book::findOrFail($id);
        return view('edit', compact('book'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'bookTitle' => 'required|min:5|max:40',
            'author' => 'required|min:5|max:40',
            'pageCount' => 'required|numeric|min:0|not_in:0',
            'releaseYear'=>'required|numeric',
            'category' => 'required|max:25'
        ]);

        $book = Book::find($id)->update($request->all());

        return back()->with('success', 'Data successfully updated!');
    }

    public function delete() {
        $books = Book::all();
        return view('deleteBook', compact('books'));
    }

    public function deleteDB($id) {

        $res = Book::find($id)->delete();

        if ($res) {
            return back()->with('msg', 'Data successfully deleted!');
        }
        
        else {
            return back()->with('msg', 'No such book data found.');
        }
    }
}
