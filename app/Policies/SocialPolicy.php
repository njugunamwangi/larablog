<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Social;
use App\Models\User;

class SocialPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any Social');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Social $social): bool
    {
        return $user->can('view Social');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create Social');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Social $social): bool
    {
        return $user->can('update Social');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Social $social): bool
    {
        return $user->can('delete Social');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Social $social): bool
    {
        return $user->can('restore Social');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Social $social): bool
    {
        return $user->can('force-delete Social');
    }
}
