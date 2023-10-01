<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\ArticleCategory;
use App\Models\User;

class ArticleCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any ArticleCategory');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ArticleCategory $articlecategory): bool
    {
        return $user->can('view ArticleCategory');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create ArticleCategory');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ArticleCategory $articlecategory): bool
    {
        return $user->can('update ArticleCategory');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ArticleCategory $articlecategory): bool
    {
        return $user->can('delete ArticleCategory');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ArticleCategory $articlecategory): bool
    {
        return $user->can('restore ArticleCategory');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ArticleCategory $articlecategory): bool
    {
        return $user->can('force-delete ArticleCategory');
    }
}
