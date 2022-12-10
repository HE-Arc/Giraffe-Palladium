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

        $imBorrower = $share->borrower_id === auth()->id();
        $otherUserName = $imBorrower ? $share->nonuser_lender : $share->nonuser_borrower;
        if (!$otherUserName) {
            $otherUserName = "@" . $share->borrower->name;
            // Add "@" for the logic referencement of existing user of the page
        }

        return view('shares.edit', [
            'share' => $share,
            'users' => User::all(),
            'items' => auth()->user()->items()->get(),
            'imBorrower' => $imBorrower,
            'otherUserName' => $otherUserName,
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

        $imBorrower = filter_var($validated['imBorrower'], FILTER_VALIDATE_BOOLEAN);
        $existingUser = $validated['existingUser'];
        $otherUserName = $validated['otherUserName'];

        if ($imBorrower) {
            $lenderId = null;
            $nonuser_lender = $otherUserName;
            $borrowerId = auth()->id();
            $nonuser_borrower = null;
        } else {
            $lenderId = auth()->id();
            $nonuser_lender = null;
            $borrowerId = $existingUser ? $existingUser->id : null;
            $nonuser_borrower = $borrowerId ? null : $otherUserName;
        }

        $share->update([
            // 'item_id' => $validated['item'], // element was disabled in form
            'lender_id' => $lenderId,
            'nonuser_lender' => $nonuser_lender,
            'borrower_id' => $borrowerId,
            'nonuser_borrower' => $nonuser_borrower,
            'since' => $validated['since'],
            'deadline' => $validated['deadline'],
            'terminated' => filter_var($validated['terminated'], FILTER_VALIDATE_BOOLEAN),
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
