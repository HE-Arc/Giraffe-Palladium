<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display the user connection form.
     */
    public function formConnection()
    {
        $error = session('signin-error');
        if (session('user')) {
            return redirect('/');
        }
        return view('signin');
    }

    /**
     * Connect the user.
     */
    public function connect()
    {
        try {
            $this->validate(request(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
        }
        catch (ValidationException $e) {
            return redirect('/signin')->with('error', 'Champs invalides');
        }

        # Check if the email and password are correct
        $user = User::where('email', request('email'))->first();
        if ($user) {
            if (password_verify(request('password'), $user->password)) {
                # The user is connected
                session(['user' => $user]);
                return redirect('/users/' . $user->id);
            }
        }

        # If the user is not connected
        //session(['signin-error' => 'invalid_credentials']);
        return redirect('/signin')->with('error', 'Identifiants invalides');
    }

    /**
     * Display the user creation form.
     */
    public function formCreation()
    {
        $error = session('signup-error');
        if (session('user')) {
            return redirect('/');
        }
        return view('signup');
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
            return redirect('/')->with('success', 'Compte créé avec succès');
        }
        catch (QueryException $e)
        {
            return redirect('/signup')->with('error', 'Email déjà utilisé');
        }
        catch (ValidationException $e)
        {
            return redirect('/signup')->with('error', 'Champs invalides');
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
