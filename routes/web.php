<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShareController;

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
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'delete'])->name('users.delete');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('/users/{user}/borrows', [UserController::class, 'borrows'])->name('users.borrows');
Route::get('/users/{user}/lends', [UserController::class, 'lends'])->name('users.lends');

// AskController
Route::post('/asks', [AskController::class, 'store'])->name('asks.store');
Route::delete('/asks/{ask}', [AskController::class, 'destroy'])->name('asks.destroy');

// ItemsController
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

// AuthController
Route::get('/signin', [AuthController::class, 'index'])->middleware('guest')->name('auth.signin.index');
Route::post('/signin', [AuthController::class, 'connect'])->name('auth.signin.connect');
Route::get('/signup', [AuthController::class, 'create'])->middleware('guest')->name('auth.signup.create');
Route::post('/signup', [AuthController::class, 'store'])->name('auth.signup.store');
Route::get('/signout', [AuthController::class, 'disconnect'])->name('auth.signout.disconnect');

// ShareController
Route::get('/shares/{share}/edit', [ShareController::class, 'edit'])->name('shares.edit');
Route::put('/shares/{share}', [ShareController::class, 'update'])->name('shares.update');
