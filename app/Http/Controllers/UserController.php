<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a list of all users.
     */
    public function index()
    {
        # Get the page number from the URL parameter (default = 1)
        $page = request('page', 1);

        if ($page < 1) {
            return redirect()->route('users.index', ['page' => 1]);
        }

        # Get the 10 users of the page
        $users = User::orderBy('name')->paginate(10, ['*'], 'page', $page);

        # Get the number of pages
        $total = $users->lastPage();

        if ($page > $total) {
            return redirect()->route('users.index', ['page' => $total]);
        }

        return view('users.index')->with([
            'users' => $users,
            'page' => $page,
            'total' => $total,
        ]);
    }

    /**
     * Display the user profil.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route("users.edit", $id);
        }
        $isMe = session('user') && session('user')->id === $user->id;
        return view('users.show')->with([
            'user' => $user,
            'isMe' => $isMe,
        ]);
    }

    /**
     * Update the user account.
     */
    public function update(int $id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route("auth.signin.connect");
        }
        if ($user->id !== $id) {
            return redirect()->route("users.index");
        }
        try {
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email',
            ]);
            $user->name = request('name');
            $user->email = request('email');
            $user->description = request('description');
            // Update the password only if the user has entered a new one
            if (request('password') && request('password') !== '') {
                $user->password = request('password');
            }
            $user->save();
            session(['user' => $user]);
            return redirect()->route("users.show", $id)->with('success', 'Compte mis à jour');
        } catch (QueryException $e) {
            return redirect()->route("users.edit", $id)->with('error', 'Email déjà utilisé');
        } catch (ValidationException $e) {
            return redirect()->route("users.edit", $id)->with('error', 'Champs invalides');
        }
    }

    /**
     * Delete the user account.
     */
    public function delete(int $id)
    {
        // TODO
    }

    /**
     * Display the user edition form.
     */
    public function edit(int $id)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route("auth.signin.index");
        }
        if ($user->id !== $id) {
            return redirect()->route("user.index");
        }
        return view('users.edit');
    }
}
