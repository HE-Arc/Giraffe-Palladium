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
    public function index()
    {
        $error = session('signin-error');
        if (session('user')) {
            return redirect()->route('home');
        }
        return view('auth.signin');
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
        } catch (ValidationException $e) {
            return redirect()->route('auth.signin.index')->with('error', 'Champs invalides');
        }

        # Check if the email and password are correct
        $user = User::where('email', request('email'))->first();
        if ($user) {
            if (password_verify(request('password'), $user->password)) {
                # The user is connected
                session(['user' => $user]);
                return redirect()->route("users.show", $user->id);
            }
        }

        # If the user is not connected
        //session(['signin-error' => 'invalid_credentials']);
        return redirect()->route('auth.signin.index')->with('error', 'Identifiants invalides');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $error = session('signup-error');
        if (session('user')) {
            return redirect()->route("home");
        }
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        try {
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::create(request(['name', 'email', 'password', 'description']));

            # Connect the user
            session(['user' => $user]);
            return redirect()->route('home')->with('success', 'Compte créé avec succès');
        } catch (QueryException $e) {
            return redirect()->route('auth.signup.create')->with('error', 'Email déjà utilisé');
        } catch (ValidationException $e) {
            return redirect()->route('auth.signup.create')->with('error', 'Champs invalides');
        }
    }

    /**
     * Disconnect the user.
     */
    public function disconnect()
    {
        session()->forget('user');
        return redirect()->route('home');
    }
}
