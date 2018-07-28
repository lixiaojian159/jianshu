<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Post;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    //编辑的权限
    public function update(User $user, Post $post){
        return $user->id === $post->user_id;
    }

    //删除的权限
    public function delete(User $user, Post $post){
        return $user->id === $post->user_id;
    }
}
