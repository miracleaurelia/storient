<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $returnedLoan = Loan::where('user_id', $user->id)->where('isReturned', 1)->get();
        $unreturnedLoan = Loan::where('user_id', $user->id)->where('isReturned', 0)->get();

        return view('loan', compact('returnedLoan', 'unreturnedLoan'));
    }

    public function borrow($id)
    {
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
                return redirect()->route('memberLoans')->with('error_message', "Cannot borrow books shorter than one week before the last book loan return's date.");
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

        return redirect()->route('memberLoans')->with('success_message', 'Book borrowed successfully');
    }

    public function returnBook($id) {
        $book = Loan::findOrFail($id);
        $book->isReturned = 1;
        $book->returnTime = Carbon::now();
        $book->save();

        return redirect()->route('memberLoans')->with('success_message', 'Book returned successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
