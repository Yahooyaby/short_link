<?php

namespace App\Policies;

use App\Models\Url;
use App\Models\User;

class UrlPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Url $url): bool
    {
        if (!$url->user()->where('is_admin', true)->whereNot('id', $user->id)->exists()) {
            return $user->isAdmin() || $user->id === $url->user_id;
        }
        return false;
    }

    public function redirect(User $user, Url $url):bool {
        return $user->isAdmin() || $user->id === $url->user_id;
    }
}
