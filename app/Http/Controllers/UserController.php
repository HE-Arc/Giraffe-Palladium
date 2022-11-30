<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a list of all users.
     */
    public function index()
    {
        $users = User::orderBy('name')->simplePaginate(20);
        return view('users.index', ['users' => $users]);
    }

    /**
     * Display the user profil.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $isMe = $user->id === auth()->id();
        return view('users.show', [
            'user' => $user,
            'isMe' => $isMe,
            'items' => $user->items()->get(),
        ]);
    }

    /**
     * Update the user account.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->description = $validated['description'] ?? null;
        if ($validated['password']) {
            $user->setPasswordAttribute($validated['password']);
        }

        $user->save();

        return redirect()->route('users.show', $user->id);
    }

    /**
     * Delete the user account.
     */
    public function delete(User $user)
    {
        // TODO
    }

    /**
     * Display the user edition form.
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function borrows(User $user)
    {
        return view('users.borrows', [
            'user' => $user,
            'borrows' => $user->borrows()->orderby("deadline")->get(),
        ]);
    }
}
