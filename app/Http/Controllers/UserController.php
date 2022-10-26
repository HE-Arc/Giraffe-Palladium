<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
     * Display a list of all users.
     */
    public function index()
    {
        # Create a new user (TEMPORARY CODE)
        $user = new User();
        $user->name = 'John Doe';
        $user->email = 'hello@hello';
        $user->password = 'hello';
        $user->tag = 1357;
        $user->information = 'Hello World!';
        $user->save();

        # Get all users
        $users = User::all();

        return view('account')->with('users', $users);
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
