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

Route::get('/', [IndexController::class, 'index']);
Route::get('/index', [IndexController::class, 'index']);

// AboutController

Route::get('/about', [AboutController::class, 'index']);

// UserController

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);
Route::get('/users/{id}/edit', [UserController::class, 'edit']);

// AuthController

Route::get('/signin', [AuthController::class, 'index']);
Route::post('/signin', [AuthController::class, 'connect']);
Route::get('/signup', [AuthController::class, 'create']);
Route::post('/signup', [AuthController::class, 'store']);
Route::get('/signout', [AuthController::class, 'disconnect']);
