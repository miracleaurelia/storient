<?php


use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
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

Route::get(
    '/display/book/{id}',
    [BookController::class, 'showBookDetail']
)->name('showBookDetail');
// Route::middleware('guest')->group(function () {
//     Route::get("/login", function () {
//         return view("login");
//     })->name('login');
//     Route::post("/login", [AuthController::class,'login'])->name('loginUser');
//     Route::get("/register", function () {
//         return view("register");
//     })->name('register');

// });

// Route::middleware('auth')->group(function () {

// });

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
});

Route::group(['middleware' => 'MemberRole'], function () {
    //
});
