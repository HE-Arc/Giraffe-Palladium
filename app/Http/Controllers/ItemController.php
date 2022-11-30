<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Share;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
    /**
     * Show the list of all borrowable items.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all shares that that are borrowable, they are referenced in the Share table
        // The share should have a null value for the borrower id
        // The share should have a deadline date that is in the future
        // The share should have the "displayed" field set to true
        // The share should have the "terminated" field set to false
        $shares = Share::whereNull('borrower_id')
            ->get();

        // Get all items that are referenced in the shares
        $items = Item::whereIn('id', $shares->pluck('item_id'))
            ->orderBy('title')
            ->simplePaginate(20);

        return view('items.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();
        $item = Item::create([
            'owner_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);
        return redirect()->route('items.show', $item->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', [
            'item' => $item,
            'isMine' => $item->owner->id == auth()->user()->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $this->authorize('update', $item);
        return view('items.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $this->authorize('update', $item);
        $validated = $request->validated();
        $item->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);
        return redirect()->route('items.show', $item->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
