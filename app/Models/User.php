<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Add a mutator to ensure hashed passwords.
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'owner_id');
    }

    /**
     * Requests made by this user to borrow items.
     */
    public function asks()
    {
        return $this->hasMany(Ask::class, 'borrower_id');
    }

    /**
     * Requests received by this user to lend items.
     */
    public function offers()
    {
        return $this->hasManyThrough(Ask::class, Item::class, 'owner_id', 'item_id');
    }

    public function borrows()
    {
        return $this->hasMany(Share::class, 'borrower_id')->where('terminated', false);
    }

    public function lends()
    {
        return $this->hasMany(Share::class, 'lender_id')->where('terminated', false);
    }
}
