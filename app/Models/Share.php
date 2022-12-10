<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'lender_id',
        'borrower_id',
        'nonuser_lender',
        'nonuser_borrower',
        'since',
        'deadline',
        'terminated',
    ];

    protected $casts = [
        'since'  => 'datetime',
        'deadline' => 'datetime',
    ];

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function lender()
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function owner()
    {
        // It's easier to pass through the item to known if the share belongs to the user.
        // else we need to check if we had an "nonuser_lender" and "nonuser_borrower"
        //      to determine if this share belongs to the user
        return $this->item->owner;
    }
}
