<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ArticleLocation;
use App\Models\User;

class ArticleLocationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any ArticleLocation');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ArticleLocation $articlelocation): bool
    {
        return $user->can('view ArticleLocation');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create ArticleLocation');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ArticleLocation $articlelocation): bool
    {
        return $user->can('update ArticleLocation');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ArticleLocation $articlelocation): bool
    {
        return $user->can('delete ArticleLocation');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ArticleLocation $articlelocation): bool
    {
        return $user->can('restore ArticleLocation');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ArticleLocation $articlelocation): bool
    {
        return $user->can('force-delete ArticleLocation');
    }
}
