<?php

namespace App\Policies;

use App\Models\User;
use App\Models\admin;
use Illuminate\Auth\Access\Response;

class AdminPolicy
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
    public function view(User $user, admin $admin): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return $user->admin
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, admin $admin): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, admin $admin): \Illuminate\Auth\Access\Response|bool
    {
        return $user->admin
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, admin $admin): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, admin $admin): bool
    {
        //
    }

    public function manageApplicant(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return $user->admin
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function manageAuthor(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return $user->admin
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function manageWorks(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return $user->admin
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function manageChapters(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return $user->admin
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function manageUsers(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return $user->admin
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function manageApp(User $user): \Illuminate\Auth\Access\Response|bool
    {
        return $user->admin
            ? Response::allow()
            : Response::denyWithStatus(403);
    }
}
