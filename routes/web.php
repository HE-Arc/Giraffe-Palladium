<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
//use App\Http\Controllers\AboutController;
use App\Http\Controllers\AccountController;
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

//Route::get('/about', [AboutController::class, 'about']);

// AccountController

Route::get('/account', [AccountController::class, 'index']);
Route::put('/account', [AccountController::class, 'update']);
Route::get('/account/edit', [AccountController::class, 'edit']);
Route::get('/account/{id}', [AccountController::class, 'show']);
Route::delete('/account', [AccountController::class, 'delete']);

// AuthController

Route::get('/signin', [AuthController::class, 'formConnection']);
Route::post('/signin', [AuthController::class, 'connect']);
Route::get('/signup', [AuthController::class, 'formCreation']);
Route::post('/signup', [AuthController::class, 'create']);
Route::get('/signout', [AuthController::class, 'disconnect']);
