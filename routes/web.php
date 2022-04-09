<?php

use App\Http\Controllers\Admin\CommentControler;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//comments
Route::get('/users/{id}/comments/create', [CommentControler::class, 'create'])->name('comments.create');
Route::get('/users/{user}/comments/{id}', [CommentControler::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [CommentControler::class, 'update'])->name('comments.update');
Route::post('/users/{id}/comments', [CommentControler::class, 'store'])->name('comments.store');
Route::get('/users/{id}/comments', [CommentControler::class, 'index'])->name('comments.index');

//users
Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/report', [UserController::class, 'getRelatorio'])->name('users.report');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

//Route::get('/report', function () {
//    return redirect()->route('users.report');
//    // return view('welcome');
//});
//index
Route::get('/', function () {
    return redirect()->route('users.index');
    // return view('welcome');
});
