<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Share;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateShareRequest;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Share::class);

        $share = new Share();
        $share->since = now();
        $share->item()->associate($request->itemId);

        $items = Item::borrowable(auth()->user())->get();
        $items->push($share->item);

        return view(
            'shares.create',
            [
                'share' => $share,
                'users' => User::all()->whereNotIn('id', auth()->id()),
                'items' => $items,
                'imBorrower' => false,
                'otherUserName' => "",
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateShareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateShareRequest $request)
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

        $items = Item::borrowable(auth()->user())->get();
        $items->push($share->item);

        return view('shares.edit', [
            'share' => $share,
            'users' => User::all()->whereNotIn('id', auth()->id()),
            'items' => $items,
            'imBorrower' => $imBorrower,
            'otherUserName' => $otherUserName,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateShareRequest  $request
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateShareRequest $request, Share $share)
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
