<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Item;

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
        $items = $user->items()->get();
        if (!$isMe)
        {
            $items = Item::borrowable($user)->get();
        }

        return view('users.show', [
            'user' => $user,
            'isMe' => $isMe,
            'items' => $items,
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
        $this->authorize('update', $user);
        return view('users.edit', ['user' => $user]);
    }

    public function borrows(User $user)
    {
        $this->authorize('activeShare', $user);

        $borrows = $user->borrows()->orderby("deadline")->simplePaginate(10);
        return view('users.borrows', [
            'user' => $user,
            'borrows' => $borrows,
        ]);
    }

    public function lends(User $user)
    {
        $this->authorize('activeShare', $user);

        $lends = $user->lends()->orderby("deadline")->simplePaginate(10);
        return view('users.lends', [
            'user' => $user,
            'lends' => $lends,
        ]);
    }
}
