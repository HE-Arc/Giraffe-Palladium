<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Share;
use App\Http\Requests\StoreShareRequest;
use App\Http\Requests\UpdateShareRequest;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShareRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function show(Share $share)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function edit(Share $share)
    {
        $this->authorize('update', $share);
        return view('shares.edit', [
            'share' => $share,
            'users' => User::all(),
            'items' => auth()->user()->items()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShareRequest  $request
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShareRequest $request, Share $share)
    {
        $this->authorize('update', $share);


        $validated = $request->validated();
        // todo : add validation if item id is really owned by user
        // todo : add validation for "existing users" and "nonuser"

        $otherUser = $validated['otherUser'];

        $lenderId = auth()->id();
        $nonuser_lender = null;
        $borrowerId = User::where('name', $otherUser)->first()->id ?? null;
        $nonuser_borrower = $borrowerId ? null : $otherUser;

        $share->update([
            'item_id' => $validated['item'],
            'lender_id' => $lenderId,
            'nonuser_lender' => $nonuser_lender,
            'borrower_id' => $borrowerId,
            'nonuser_borrower' => $nonuser_borrower,
            'since' => $validated['since'],
            'deadline' => $validated['deadline'],
            'terminated' => array_key_exists('terminated', $validated),
        ]);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function destroy(Share $share)
    {
        //
    }
}
