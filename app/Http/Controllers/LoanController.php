<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $returnedLoan = Loan::where('user_id', $user->id)->whereIn('isReturned', [1, 2])->get();
        $unreturnedLoan = Loan::where('user_id', $user->id)->where('isReturned', 0)->get();

        return view('loan', compact('returnedLoan', 'unreturnedLoan'));
    }

    public function adminLoans()
    {
        $returnedLoan = Loan::whereIn('isReturned', [1, 2])->get();
        $unreturnedLoan = Loan::where('isReturned', 0)->get();

        return view('adminLoans',  compact('returnedLoan', 'unreturnedLoan'));
    }

    public function borrow($id)
    {
        $book = Book::find($id);

        if ($book->is_deleted == 1) {
            return view('notFound');
        }

        if ($book->borrow_stock <= 0) {
            return redirect()->back()->with('error_message', "Out of book borrow stock.");
        }

        $user = auth()->user();

        $borrowed = Loan::where('user_id', $user->id)->where('isReturned', 0)->get();

        if ($borrowed->count() > 0) {
            return redirect()->route('memberLoans')->with('error_message', 'Please return the book you borrowed first before borrowing another.');
        }

        $lastBorrowed = Loan::where('user_id', $user->id)->where('isReturned', 1)->orderBy('returnTime', 'DESC')->first();

        if ($lastBorrowed) {
            $lastBorrowedReturnTime = Carbon::parse($lastBorrowed->returnTime);

            $diff_in_days = $lastBorrowedReturnTime->diffInDays(Carbon::now());

            if ($diff_in_days <= 7) {
                return redirect()->back()->with('error_message', "Cannot borrow books shorter than one week before the last book loan return's date.");
            }
        }

        Loan::create([
            'user_id' => $user->id,
            'book_id' => $id,
            'borrowTime' => Carbon::now(),
            'returnDeadlineTime' => Carbon::now()->addDays(7),
            'isReturned' => 0,
            'fine' => 0
        ]);

        $currQty = $book->borrow_stock;
        $book->borrow_stock = $currQty - 1;
        $book->save();

        return redirect()->route('memberLoans')->with('success_message', 'Book borrowed successfully');
    }


    protected function returnValidator(array $data)
    {
        return Validator::make($data, [
            'returnProof2' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }

    protected function returnValidatorWithFine(array $data)
    {
        return Validator::make($data, [
            'returnProof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'fineProof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }

    public function moveImage($string)
    {
        $files = request()->file($string);
        $fullFileName = $files->getClientOriginalName();
        $fileName = pathinfo($fullFileName)['filename'];
        $extension = $files->getClientOriginalExtension();
        $image = $fileName . "-" . date('YmdHis') . "." . $extension;
        if ($string == 'returnProof2') {
            $string = 'returnProof';
        }
        $files->move(public_path($string), $image);

        return $image;
    }

    public function returnBook(Request $request, $id)
    {
        $validator = $this->returnValidator($request->all());

        if ($validator->fails()) {
            return redirect('/loans')->withErrors($validator)->withInput()->with('error_message', "Please upload proof(s) of book return correctly!");
        } else {
            $returnProof = $this->moveImage('returnProof2');

            $book = Loan::findOrFail($id);
            $book->isReturned = 1;
            $book->returnTime = Carbon::now();
            $book->returnProof = $returnProof;
            $book->save();

            $returnedBook = Book::find($book->book->id);
            $currQty = $returnedBook->borrow_stock;
            $returnedBook->borrow_stock = $currQty + 1;
            $returnedBook->save();

            return redirect()->route('memberLoans')->with('success_message', 'Book returned successfully');
        }
    }

    public function returnBookWithFine(Request $request, $id)
    {
        $validator = $this->returnValidatorWithFine($request->all());

        if ($validator->fails()) {
            return redirect('/loans')->withErrors($validator)->withInput()->with('error_message', "Please upload proof(s) of book return correctly!");
        } else {
            $returnProof = $this->moveImage('returnProof');
            $fineProof = $this->moveImage('fineProof');

            $book = Loan::findOrFail($id);
            $book->isReturned = 1;
            $book->returnTime = Carbon::now();
            $book->returnProof = $returnProof;
            $book->fineProof = $fineProof;
            $book->save();

            return redirect()->route('memberLoans')->with('success_message', 'Book returned successfully');
        }
    }

    public function banUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'Banned';
        $user->save();

        return redirect()->route('adminLoans')->with('success_message', 'User banned successfully');
    }

    public function verifyBookReturn($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->isReturned = 2;
        $loan->save();
        return redirect()->route('adminLoans')->with('success_message', 'Book return verified successfully');
    }
}
