<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    /**
     * Display a list of all users.
     */
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('account-list')->with('users', $users);
    }

    /**
     * Display the user profile.
     * @param int $id
     */
    public function show(int $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect('/account');
        }
        $isMe = session('user') && session('user')->id == $user->id;
        return view('account-view')->with([
            'user' => $user,
            'isMe' => $isMe,
        ]);
    }

    /**
     * Display the user edition form.
     */
    public function edit()
    {
        $error = session('account-edit-error');
        session()->forget('account-edit-error');
        $user = session('user');
        if (!$user) {
            return redirect('/signin');
        }
        return view('account-edit')->with([
            'user' => $user,
            'error' => $error,
        ]);
    }

    /**
     * Update the user account.
     */
    public function update()
    {
        $user = session('user');
        if (!$user) {
            return redirect('/signin');
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
            if (request('password') && request('password') != '') {
                $user->password = request('password');
            }
            $user->save();
            session(['user' => $user]);
            return redirect('/account');
        } catch (QueryException $e) {
            session(['account-edit-error' => 'email_already_exists']);
        }
        catch (ValidationException $e) {
            session(['account-edit-error' => 'unknown_error']);
        }
    }

    /**
     * Delete the user account.
     */
    public function delete()
    {
        // TODO
    }
}
