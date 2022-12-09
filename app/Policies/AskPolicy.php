<?php

namespace App\Policies;

use App\Models\Ask;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Ask $ask)
    {
        return $user->id === $ask->lender()->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ask $ask)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Ask $ask)
    {
        return $ask->borrower_id === $user->id;
    }

    /**
     * Determine whether the user can accept the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function accept(User $user, Ask $ask)
    {
        return $user->id === $ask->lender()->id;
    }

    /**
     * Determine whether the user can reject the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function reject(User $user, Ask $ask)
    {
        return $user->id === $ask->lender()->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Ask $ask)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ask  $ask
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Ask $ask)
    {
        //
    }
}
