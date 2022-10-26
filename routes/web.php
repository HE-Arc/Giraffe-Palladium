<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
//use App\Http\Controllers\AboutController;
use App\Http\Controllers\UserController;

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

//Route::get('/about', [AboutController::class, 'about']);

// UserController

Route::get('/account', [UserController::class, 'index']);
Route::put('/account', [UserController::class, 'update']);
Route::delete('/account', [UserController::class, 'delete']);

Route::get('/signin', [UserController::class, 'formConnection']);
Route::post('/signin', [UserController::class, 'connect']);

Route::get('/signup', [UserController::class, 'formCreation']);
Route::post('/signup', [UserController::class, 'create']);

Route::get('/signout', [UserController::class, 'disconnect']);
