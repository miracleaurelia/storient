<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use App\Models\Member;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Facade\FlareClient\View;

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

Route::get(
    '/',
    [HomeController::class, 'index']
);

Route::get(
    '/display/book',
    [BookController::class, 'showBook']
)->name('display');

// Book Detail
Route::get(
    '/display/book/{id}',
    [BookController::class, 'showBookDetail']
)->name('displayBookDetail');

Route::get(
    '/create/book',
    [BookController::class, 'createBook']
)->name('createBook');

Route::post(
    '/store/book',
    [BookController::class, 'storeBook']
)->name('storeBook');

Route::get(
    'show/book',
    [BookController::class, 'showBook']
)->name('showBook');

Route::get(
    'updateView/book',
    [BookController::class, 'updateBookView']
)->name('updateBookView');

Route::get(
    'post/edit/{id}',
    [BookController::class, 'edit']
)->name('editBook');

Route::post(
    'post/update/{id}',
    [BookController::class, 'update']
)->name('updateBook');

Route::get(
    'delete/book',
    [BookController::class, 'delete']
)->name('delete');

Route::get(
    'deleteDB/book/{id}',
    [BookController::class, 'deleteDB']
)->name('deleteDB');

Route::get("/login", function () {
    return view("login");
});
Route::get("/register", function () {
    return view("register");
});
Route::post('/register', [MemberController::class, 'register']);
Route::post('/login', [MemberController::class, 'login']);

Route::get('/profile', [MemberController::class, 'getProfile']);
Route::get('/editProfile', [MemberController::class, 'getEditProfile']);
Route::post('/editProfile', [MemberController::class, 'editProfile']);

Route::get('/transaction', [TransactionController::class, 'getTransactions']);
Route::get('/transaction/{id}', [TransactionController::class, 'getSelectedTransaction']);
