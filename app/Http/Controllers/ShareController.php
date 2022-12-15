<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Share;
use App\Models\Item;
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
     * @param  \App\Models\Item  $item The item to be shared
     * @return \Illuminate\Http\Response
     */
    public function create(Item $item)
    {
        $this->authorize('create', Share::class);

        $share = new Share();
        $share->since = now();
        $share->item()->associate($item);

        return view(
            'shares.create',
            [
                'share' => $share,
                'users' => User::all(),
                'items' => auth()->user()->items()->get(),
                'imBorrower' => false,
                'otherUserName' => "",
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShareRequest $request)
    {
        $this->authorize('create', Share::class);
        $validated = $request->validated();

        $itemId = $validated['itemId'];
        $imBorrower = $validated['imBorrower'];
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

        Share::create([
            'item_id' => $itemId,
            'lender_id' => $lenderId,
            'nonuser_lender' => $nonuser_lender,
            'borrower_id' => $borrowerId,
            'nonuser_borrower' => $nonuser_borrower,
            'since' => $validated['since'],
            'deadline' => $validated['deadline'],
            'terminated' => $validated['terminated'],
        ]);

        return redirect()->route('items.show', $itemId);
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
            // Add "@" for the logic referencement of existing user of the page
            $otherUserName = "@" . $share->borrower->name;
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

        $imBorrower = $validated['imBorrower'];
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
            'lender_id' => $lenderId,
            'nonuser_lender' => $nonuser_lender,
            'borrower_id' => $borrowerId,
            'nonuser_borrower' => $nonuser_borrower,
            'since' => $validated['since'],
            'deadline' => $validated['deadline'],
            'terminated' => $validated['terminated'],
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
