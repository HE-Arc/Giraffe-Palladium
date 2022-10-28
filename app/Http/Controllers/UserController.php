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
            return redirect('/users?page=1');
        }

        # Get the 10 users of the page
        $users = User::orderBy('name')->paginate(10, ['*'], 'page', $page);

        # Get the number of pages
        $total = $users->lastPage();

        if ($page > $total) {
            return redirect('/users?page=' . $total);
        }

        return view('user-list')->with([
            'users' => $users,
            'page' => $page,
            'total' => $total,
        ]);
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
