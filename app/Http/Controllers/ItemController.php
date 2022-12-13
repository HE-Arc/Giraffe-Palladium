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
        $items = Item::borrowable()->simplePaginate(20);
        return view('items.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Item::class);
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
        $this->authorize('create', Item::class);
        $validated = $request->validated();
        $item = Item::create([
            'owner_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'listed' => isset($validated['listed']),
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
        $isMine = optional(auth())->id() === $item->owner_id;
        $myAsk = auth()->guest() ? null : $item->asks()->where('borrower_id', auth()->id())->first();
        return view('items.show', [
            'item' => $item,
            'isMine' => $isMine,
            'myAsk' => $myAsk,
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
        $this->authorize('delete', $item);
        $item->delete();
        return redirect()->route('users.show', auth()->id());
    }
}
