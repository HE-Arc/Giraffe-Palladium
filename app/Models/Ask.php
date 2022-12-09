<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ask extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrower_id',
        'item_id',
    ];

    /**
     * User who asked for the item (potential borrower)
     */
    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    /**
     * User who owns the asked item (potential lender)
     */
    public function lender()
    {
        return $this->item->owner;
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
