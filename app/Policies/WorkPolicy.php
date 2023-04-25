<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;

class WorkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Work $work): \Illuminate\Auth\Access\Response|bool
    {
        if ($work->age->year >= 18) {
            $userAge = $user ? Carbon::parse($user->birthdate)->age : 0;
            if ($userAge < 18) {
                return Response::denyWithStatus(404);
            }
        }
        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return $user->author
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Work $work): \Illuminate\Auth\Access\Response|bool
    {
        return $user->author->id == $work->author_id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Work $work): \Illuminate\Auth\Access\Response|bool
    {
        return $user->author->id == $work->author_id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Work $work): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Work $work): bool
    {
        //
    }
}
