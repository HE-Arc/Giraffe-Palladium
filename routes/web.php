<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

// IndexController
Route::get('/', [IndexController::class, 'index'])->name('home');

// AboutController
Route::get('/about', [AboutController::class, 'index'])->name('about');

// UserController
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'delete'])->name('users.delete');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

// AuthController
Route::get('/signin', [AuthController::class, 'index'])->middleware('guest')->name('auth.signin.index');
Route::post('/signin', [AuthController::class, 'connect'])->name('auth.signin.connect');
Route::get('/signup', [AuthController::class, 'create'])->middleware('guest')->name('auth.signup.create');
Route::post('/signup', [AuthController::class, 'store'])->name('auth.signup.store');
Route::get('/signout', [AuthController::class, 'disconnect'])->name('auth.signout.disconnect');
