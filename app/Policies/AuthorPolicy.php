<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewany(User $user){
        return $user->hasPermissionTo('view author');
        }
     
        public function create(User $user){
         return $user->hasPermissionTo('create author');
        }
     
        public function edit(User $user){
         // logic not matched
         // return $user->hasRole('Admin')||($user->hasPermissionTo('update post') && $user->id===$post->authors->contains('author_id',$user->id));
           return $user->hasPermissionTo('edit author');
        }
     
        public function delete(User $user){
         // return $user->hasPermissionTo('delete post')||$user->id===$post->authors->contains('id',$user->id);
         return $user->hasPermissionTo('delete author');
        }
     
        public function changeStatus(User $user){
         return $user->hasPermissionTo('change author status');
        }
}
