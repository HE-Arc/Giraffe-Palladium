<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display a list of all users.
     */
    public function index()
    {
        $users = User::all();
        return view('account-edit')->with('users', $users);
    }

    /**
     * Display the user connection form.
     */
    public function formConnection()
    {
        $error = session('signin-error');
        session()->forget('signin-error');
        if (session('user')) {
            return redirect('/');
        }
        return view('signin')->with('error', $error);
    }

    /**
     * Connect the user.
     */
    public function connect()
    {
        # Check if the email and password are correct
        $user = User::where('email', request('email'))->first();
        if ($user) {
            if (password_verify(request('password'), $user->password)) {
                # The user is connected
                session(['user' => $user]);
                return redirect('/account');
            }
        }

        # If the user is not connected
        session(['signin-error' => 'invalid_credentials']);
        return redirect('/signin');
    }

    /**
     * Display the user creation form.
     */
    public function formCreation()
    {
        $error = session('signup-error');
        session()->forget('signup-error');
        if (session('user')) {
            return redirect('/');
        }
        return view('signup')->with('error', $error);
    }

    /**
     * Create the user.
     */
    public function create()
    {
        try
        {
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::create(request(['name', 'email', 'password', 'description']));

            # Connect the user
            session(['user' => $user]);
            return redirect('/');
        }
        catch (QueryException $e)
        {
            session(['signup-error' => 'email_already_exists']);
            return redirect('/signup');
        }
        catch (ValidationException $e)
        {
            session(['signup-error' => 'some_fields_required']);
            return redirect('/signup');
        }
    }

    /**
     * Disconnect the user.
     */
    public function disconnect()
    {
        session()->forget('user');
        return redirect('/');
    }
}
