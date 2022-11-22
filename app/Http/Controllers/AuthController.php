<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ConnectAuthRequest;
use App\Http\Requests\StoreAuthRequest;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

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
    public function connect(ConnectAuthRequest $request)
    {
        $validated = $request->validated();

        if(Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route("users.show", $user->id);
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ])->onlyInput('email');
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
    public function store(StoreAuthRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'description' => $validated['description'],
        ]);
        session(['user' => $user]);
        return redirect()->route('home');

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
