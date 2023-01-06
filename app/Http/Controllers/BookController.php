<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
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
            'description' => request()->description,
            'price' => request()->price,
            'borrow_stock' => request()->borrow_stock,
            'buy_stock' => request()->buy_stock
        ];
    }

    public function createBook() {
        $categories = Category::all();
        return view('createBook', compact('categories'));
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
            'category' => 'required',
            'description' => 'min:50',
            'price' => 'required|integer|gt:0',
            'preview' => 'required|file|mimes:pdf',
            'borrow_stock' => 'required|numeric|min:1',
            'buy_stock' => 'required|numeric|min:1'
        ],[
            'min.description'=>'asdasd',
        ]);

        if($validate){
            $image = $this->moveImage();

            $preview = time() . '.' . $request->preview->extension();
            $request->preview->move(public_path('files'), $preview);

            $newBook = Book::create([
                'image' => $image,
                'bookTitle' => $request->bookTitle,
                'author' => $request->author,
                'pageCount' => $request->pageCount,
                'releaseYear' => $request->releaseYear,
                'description' => $request->description,
                'price' => $request->price,
                'preview' => $preview,
                'buy_stock' => $request->buy_stock,
                'borrow_stock' => $request->borrow_stock
            ]);

            foreach ($request->category as $category) {
                BookCategory::create([
                    "book_id" => $newBook->id,
                    "category_id" => $category
                ]);
            }

            return redirect()->route('display')->with(['success_message' => 'Book inserted successfully']);
        }

    }

    public function showBook() {
        // if (!Auth::check()) {
        //     return redirect('/login')->with('error_message', 'Please login first');
        // }
        $books = Book::where('is_deleted', 0)->paginate(6);
        $categories = Category::all();
        return view('displayBook', compact('books', 'categories'));
    }

    public function showBookWithCategory($id) {
        $category = Category::findOrFail($id);
        $books = $category->available_books()->paginate(6);
        $categories = Category::all();
        return view('displayBook', ['books' => $books, 'categories' => $categories]);
    }

    public function showBookDetail($id) {
        $book = Book::find($id);
        if ($book->is_deleted == 1) {
            return view('notFound');
        }
        return view('displayBookDetail')->with('book', $book);
    }

    public function updateBookView() {
        $books = Book::where('is_deleted', 0)->paginate(6);
        $categories = Category::all();
        return view('updateBook', compact('books', 'categories'));
    }

    public function updateBookWithCategoryView($id) {
        $category = Category::findOrFail($id);
        $books = $category->available_books()->paginate(6);
        $categories = Category::all();
        return view('updateBook', ['books' => $books, 'categories' => $categories]);
    }

    public function edit($id) {
        $book = Book::findOrFail($id);
        if ($book->is_deleted == 1) {
            return view('notFound');
        }
        $categories = Category::all();
        return view('edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bookTitle' => 'required|min:1|max:50',
            'author' => 'required|min:1|max:50',
            'pageCount' => 'required|numeric|min:0|not_in:0',
            'releaseYear'=>'required|numeric',
            'category' => 'required',
            'description' => 'required|min:50',
            'price' => 'required|integer|gt:0',
            'preview' => 'nullable|file|mimes:pdf',
            'borrow_stock' => 'required|numeric|min:1',
            'buy_stock' => 'required|numeric|min:1'
        ]);

        $book = Book::find($id);
        if ($book->is_deleted == 1) {
            return view('notFound');
        }
        $book->update($this->bookReq);

        BookCategory::where('book_id', $id)->delete();

        foreach ($request->category as $category) {
            BookCategory::create([
                "book_id" => $id,
                "category_id" => $category
            ]);
        }

        if ($request->file('image') != null) {
            $image = $this->moveImage();
            $book->update(['image' => $image]);
        }

        if ($request->preview != null) {
            $preview = time() . '.' . $request->preview->extension();
            $request->preview->move(public_path('files'), $preview);
            $book->update(['preview' => $preview]);
        }

        return redirect()->route('display')->with(['success_message' => 'Book updated successfully']);
    }

    public function delete() {
        $books = Book::where('is_deleted', 0)->paginate(6);
        $categories = Category::all();
        return view('deleteBook', compact('books', 'categories'));
    }

    public function deleteWithCategory($id) {
        $category = Category::findOrFail($id);
        $books = $category->available_books()->paginate(6);
        $categories = Category::all();
        return view('deleteBook', ['books' => $books, 'categories' => $categories]);
    }

    public function deleteDB($id) {
        $book = Book::findOrFail($id);
        if ($book->is_deleted == 1) {
            return view('notFound');
        }
        $book->is_deleted = 1;
        $book->save();
        // CartController::deleteCartItem();
        return redirect()->route('display')->with('success_message', 'Book deleted successfully');
    }

    public function search(Request $request) {
        $request->validate(['search' => 'required']);
        $books = Book::where('bookTitle', 'like', '%' . $request->search . '%')->where('is_deleted', 0)->paginate(8)->withQueryString();
        return view('searchResults', [
            'books' => $books
        ]);
    }
}
