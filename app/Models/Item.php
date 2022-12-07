<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'title',
        'description'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function asks()
    {
        return $this->hasMany(Ask::class);
    }

    public function shares()
    {
        return $this->hasMany(Share::class);
    }

    /**
     * Get all borrowable items.
     */
    public static function borrowable()
    {
        return Item::where('listed', true)
            ->whereDoesntHave('shares', function ($query) {
                $query->where('terminated', false);
            });
    }
}
