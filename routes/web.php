<?php


use App\Http\Controllers\AuthController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoanController;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/display/book', [BookController::class, 'showBook'])->name('display');

Route::get('/display/category/{id}', [BookController::class, 'showBookWithCategory'])->name('displayWithCategory');

Route::get(
    '/display/book/{id}',
    [BookController::class, 'showBookDetail']
)->name('showBookDetail');

Route::get('/book/search', [BookController::class, 'search'])->name('searchBook');
// Route::middleware('guest')->group(function () {
//     Route::get("/login", function () {
//         return view("login");
//     })->name('login');
//     Route::post("/login", [AuthController::class,'login'])->name('loginUser');
//     Route::get("/register", function () {
//         return view("register");
//     })->name('register');

// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/editProfile', [AuthController::class, 'editProfile']);
    Route::post('/editProfile', [AuthController::class, 'updateProfile']);
});

Route::group(['middleware' => 'AdminRole'], function () {
    Route::get('/create/book', [BookController::class, 'createBook'])->name('createBook');
    Route::post(
        '/store/book',
        [BookController::class, 'storeBook']
    )->name('storeBook');
    Route::get(
        'updateView/book',
        [BookController::class, 'updateBookView']
    )->name('updateBookView');
    Route::get(
        'updateView/book/{id}',
        [BookController::class, 'updateBookWithCategoryView']
    )->name('updateBookWithCategoryView');
    Route::get(
        'post/edit/{id}',
        [BookController::class, 'edit']
    )->name('editBook');
    Route::post(
        'post/update/{id}',
        [BookController::class, 'update']
    )->name('updateBook');
    Route::post(
        'update/category/{id}',
        [CategoryController::class, 'update']
    )->name('updateCategory');
    Route::get(
        'delete/book',
        [BookController::class, 'delete']
    )->name('delete');
    Route::get(
        'delete/book/{id}',
        [BookController::class, 'deleteWithCategory']
    )->name('deleteWithCategory');
    Route::get(
        'deleteDB/book/{id}',
        [BookController::class, 'deleteDB']
    )->name('deleteDB');
    Route::get(
        'adminTransactions',
        [TransactionController::class, 'getTransactions']
    )->name('adminTransaction');
    Route::post(
        'adminTransactions/{id}',
        [TransactionController::class, 'verifyTransaction']
    )->name('verifyTransaction');
    Route::get(
        '/adminLoans',
        [LoanController::class, 'adminLoans']
    )->name('adminLoans');
    Route::get(
        '/adminUnban',
        [LoanController::class, 'adminUnban']
    )->name('adminUnban');
    Route::get('ban/{id}', [LoanController::class, 'banUser'])->name('banUser');
    Route::post('verify/{id}', [LoanController::class, 'verifyBookReturn'])->name('verifyBookReturn');
    Route::get(
        'delete/category/{id}',
        [CategoryController::class, 'deleteCategory']
    )->name('deleteCategory');
    Route::get('/display/category', [CategoryController::class, 'index'])->name('displayCategory');
    Route::post('/add/category', [CategoryController::class, 'add'])->name('addCategory');
});

Route::group(['middleware' => 'MemberRole'], function () {
    //
    Route::get(
        'cart',
        [CartController::class, 'index']
    )->name('memberCart');

    Route::post(
        'cart',
        [CartController::class, 'checkoutCart']
    )->name('memberCartCheckout');

    Route::get(
        'transactions',
        [TransactionController::class, 'getTransactions']
    )->name('memberTransaction');

    Route::get('cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');

    Route::get(
        'remove/cart/{id}',
        [CartController::class, 'removeCartItem']
    )->name('removeCartItem');

    Route::get('borrow/{id}', [LoanController::class, 'borrow'])->name('borrow');

    Route::get(
        'loans',
        [LoanController::class, 'index']
    )->name('memberLoans');

    Route::post(
        'return/{id}',
        [LoanController::class, 'returnBook']
    )->name('returnBook');

    Route::post(
        'returnWithFine/{id}',
        [LoanController::class, 'returnBookWithFine']
    )->name('returnBookWithFine');

    Route::post(
        'update/cart/{id}',
        [CartController::class, 'updateCart']
    )->name('updateCart');
});

Route::get('/abc', function () {
    return view('profile');
});
