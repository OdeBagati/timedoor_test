<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;

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

// Route::get('/', function () {
//     return view('book');
// });

Route::get('/rating', function () {
    return view('rating');
});

Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/author', [AuthorController::class, 'index'])->name('author');
Route::get('/getAuthor/{id}', [AuthorController::class, 'getAuthor'])->name('getAuthor');

Route::resource('ratings', RatingController::class);
