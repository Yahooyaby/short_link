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

    public function viewAny(User $user)
    {
        return $user->is_admin;
    }

    public function delete(User $user,Url $url)
    {
        if ($user->is_admin || ($user->id === $url->user_id)){
            return true;
        }
    }
}
