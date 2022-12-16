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
        'description',
        'listed',
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
     *
     * @param  \App\Models\User  $owner if not null, get all borrowable elements of this owner
     */
    public static function borrowable($owner = null)
    {
        $where = [
            'listed' => true,
        ];
        if ($owner)
        {
            $where['owner_id'] = $owner->id;
        }


        return Item::where($where)
            ->whereDoesntHave('shares', function ($query) {
                $query->where('terminated', false);
            });
    }
}
