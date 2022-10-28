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
        $users = User::orderBy('name')->get();
        return view('user-list')->with('users', $users);
    }

    /**
     * Display the user profile.
     * @param int $id
     */
    public function show(int $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect("/users/$id/edit");
        }
        $isMe = session('user') && session('user')->id === $user->id;
        return view('user-view')->with([
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
            return redirect('/signin');
        }
        if ($user->id !== $id) {
            return redirect('/users');
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
            return redirect("/users/$id")->with('success', 'Compte mis à jour');
        } catch (QueryException $e) {
            return redirect("/users/$id/edit")->with('error', 'Email déjà utilisé');
        }
        catch (ValidationException $e) {
            return redirect("/users/$id/edit")->with('error', 'Champs invalides');
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
            return redirect('/signin');
        }
        if ($user->id !== $id) {
            return redirect('/users');
        }
        return view('user-edit');
    }
}
