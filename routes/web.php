<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Home */
Route::get('/', [HomeController::class, 'index'])->name('home');


/* Auth */
Route::get('/login', [AuthController::class, 'getLogin'])->name('get-login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('post-login');

Route::get('/register', [AuthController::class, 'getRegister'])->name('get-register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('post-register');
Route::get('/books', [BookController::class, 'index'])->name('books');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'getLogout'])->name('get-logout');

    Route::get('/books/selected', [BookController::class, 'showSelected'])->name('show-selected');

    Route::get('/books/{book}/deselect', [BookController::class, 'removeFromSelected'])->name('remove-from-selected');
    Route::get('/books/{book}/select', [BookController::class, 'addToSelected'])->name('add-to-selected');
    Route::get('/books/all-deselect', [BookController::class, 'removeAllFromSelected'])->name('remove-all-from-selected');

    /* Admin Panel */
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::post('/admin/genres', [AdminController::class, 'storeGenres'])->name('store-genres');
    Route::get('/admin/genres/{genre}/delete', [AdminController::class, 'deleteGenres'])->name('delete-genres');

    Route::post('/admin/authors', [AdminController::class, 'storeAuthors'])->name('store-authors');
    Route::get('/admin/authors/{author}/delete', [AdminController::class, 'deleteAuthors'])->name('delete-authors');

    Route::post('/admin/books', [AdminController::class, 'storeBooks'])->name('store-books');
    Route::get('/admin/books/{book}/delete', [AdminController::class, 'deleteBooks'])->name('delete-books');

    Route::get('/admin/users/{user}/delete', [AdminController::class, 'deleteUsers'])->name('delete-users');
});

Route::get('/books/{book}', [BookController::class, 'show'])->name('show-book');
