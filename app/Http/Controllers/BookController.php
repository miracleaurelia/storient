<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function __construct()
    {
        $this->bookReq = [
            'bookTitle' => request()->bookTitle,
            'author' => request()->author,
            'pageCount' => request()->pageCount,
            'releaseYear'=> request()->releaseYear,
            'category' => request()->category,
            'description' => request()->description,
            'price' => request()->price
        ];
    }

    public function createBook() {
        return view('createBook');
    }

    public function moveImage() {
        $files = request()->file('image');
        $fullFileName = $files->getClientOriginalName();
        $fileName = pathinfo($fullFileName)['filename'];
        $extension = $files->getClientOriginalExtension();
        $image = $fileName . "-" . date('YmdHis') . "." . $extension;
        $files->move(public_path('images'), $image);

        return $image;
    }

    public function storeBook(Request $request) {
        $validate = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bookTitle' => 'required|min:1|max:50',
            'author' => 'required|min:1|max:50',
            'pageCount' => 'required|numeric|min:0|not_in:0',
            'releaseYear'=>'required|numeric',
            'category' => 'required|max:25',
            'description' => 'min:50',
            'price' => 'required|integer|gt:0',
            'preview' => 'required|file|mimes:pdf'
        ],[
            'min.description'=>'asdasd',
        ]);

        if($validate){
            $image = $this->moveImage();

        $preview = time() . '.' . $request->preview->extension();
        $request->preview->move(public_path('files'), $preview);

        Book::create([
            'image' => $image,
            'bookTitle' => $request->bookTitle,
            'author' => $request->author,
            'pageCount' => $request->pageCount,
            'releaseYear' => $request->releaseYear,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'preview' => $preview
        ]);

        return redirect()->route('display')->with('success_message', 'Book inserted successfully');
        }
        
    }

    public function showBook() {
        if (!Auth::check()) {
            return redirect('/login')->with('error_message', 'Please login first');
        }
        $books = Book::all();
        return view('displayBook', compact('books'));
    }

    public function showBookDetail($id) {
        $book = Book::find($id);
        return view('displayBookDetail')->with('book', $book);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bookTitle' => 'required|min:1|max:50',
            'author' => 'required|min:1|max:50',
            'pageCount' => 'required|numeric|min:0|not_in:0',
            'releaseYear'=>'required|numeric',
            'category' => 'required|max:25',
            'description' => 'required|min:50',
            'price' => 'required|integer|gt:0',
            'preview' => 'nullable|file|mimes:pdf'
        ]);

        $book = Book::find($id);
        $book->update($this->bookReq);

        if ($request->file('image') != null) {
            $image = $this->moveImage();
            $book->update(['image' => $image]);
        }

        if ($request->preview != null) {
            $preview = time() . '.' . $request->preview->extension();
            $request->preview->move(public_path('files'), $preview);
            $book->update(['preview' => $preview]);
        }

        return back()->with('success', 'Data successfully updated!');
    }

    public function delete() {
        $books = Book::all();
        return view('deleteBook', compact('books'));
    }

    public function deleteDB($id) {

        $res = Book::find($id)->delete();

        if ($res) {
            return redirect()->route('display')->with('success_message', 'Book inserted successfully');
        }

        else {
            return redirect()->route('display')->with('error_message', 'Something went wrong');
        }
    }
}
