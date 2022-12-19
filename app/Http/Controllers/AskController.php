<?php

namespace App\Http\Controllers;

use App\Models\Ask;
use App\Http\Requests\StoreAskRequest;
use App\Http\Requests\UpdateAskRequest;
use App\Http\Requests\AcceptAskRequest;

class AskController extends Controller
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
     * @param  \App\Http\Requests\StoreAskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAskRequest $request)
    {
        $this->authorize('create', Ask::class);
        $validated = $request->validated();

        // if borrower already trying to borrow this item, redirect to item page
        $existingAsk = Ask::where('borrower_id', auth()->id())
            ->where('item_id', $validated['item_id'])
            ->first();
        if ($existingAsk) {
            return redirect()->route('items.show', $existingAsk->item_id);
        }

        Ask::create([
            'borrower_id' => auth()->id(),
            'item_id' => $validated['item_id'],
        ]);
        return redirect()->route('items.show', $validated['item_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Http\Response
     */
    public function show(Ask $ask)
    {
        $this->authorize('view', $ask);
        return view('asks.show', [
            'ask' => $ask,
            'item' => $ask->item,
            'borrower' => $ask->borrower,
            'lender' => $ask->lender(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Http\Response
     */
    public function edit(Ask $ask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAskRequest  $request
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAskRequest $request, Ask $ask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ask $ask)
    {
        $this->authorize('delete', $ask);
        $ask->delete();
        return redirect()->route('items.show', $ask->item_id);
    }

    /**
     * Accept the specified resource.
     *
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Http\Response
     */
    public function accept(AcceptAskRequest $request, Ask $ask)
    {
        $this->authorize('accept', $ask);
        $validated = $request->validated();
        $item = $ask->item;

        $item->shares()->create([
            'borrower_id' => $ask->borrower_id,
            'lender_id' => $item->owner_id,
            'since' => now(),
            'deadline' => $validated['deadline'],
        ]);

        // Delete all asks for this item (including the accepted one)
        $item->asks()->delete();

        return redirect()->route('users.asks', $ask->lender()->id);
    }

    /**
     * Reject the specified resource.
     *
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Http\Response
     */
    public function reject(Ask $ask)
    {
        $this->authorize('reject', $ask);
        $ask->delete();
        return redirect()->route('users.asks', $ask->lender()->id);
    }
}
