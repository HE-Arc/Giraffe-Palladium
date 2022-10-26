<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/*

Route::get('/account', [UserController::class, 'index']);
Route::put('/account', [UserController::class, 'update']);
Route::delete('/account', [UserController::class, 'delete']);

Route::get('/signin', [UserController::class, 'formConnection']);
Route::post('/signin', [UserController::class, 'connect']);

Route::get('/signup', [UserController::class, 'formCreation']);
Route::post('/signup', [UserController::class, 'create']);

Route::get('/signout', [UserController::class, 'disconnect']);

*/

class UserController extends Controller
{
    /**
     * Display the user account page.
     */
    public function index()
    {
        return view('account');
    }

    /**
     * Update the user account.
     */
    public function update()
    {
        // TODO
    }

    /**
     * Delete the user account.
     */
    public function delete()
    {
        // TODO
    }

    /**
     * Display the user connection form.
     */
    public function formConnection()
    {
        return view('signin');
    }

    /**
     * Connect the user.
     */
    public function connect(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $salt = 'TODO(get salt from database)';

        $hashed_pass = hash('sha256', $password . $salt);

        echo $username;
        echo $password;
        echo $hashed_pass;
        echo '--------------------';

        return redirect()->route('account');
    }

    /**
     * Display the user creation form.
     */
    public function formCreation()
    {
        return view('signup');
    }

    /**
     * Create the user.
     */
    public function create()
    {
        // TODO
    }

    /**
     * Disconnect the user.
     */
    public function disconnect()
    {
        // TODO
    }
}
