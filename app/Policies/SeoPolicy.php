<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewany(User $user){
        return $user->hasPermissionTo('view seo');
        }
     
        public function createfield(User $user){
         return $user->hasPermissionTo('create field');
        }
     
        public function editseo(User $user){
         // logic not matched
         // return $user->hasRole('Admin')||($user->hasPermissionTo('update post') && $user->id===$post->authors->contains('author_id',$user->id));
           return $user->hasPermissionTo('edit seo');
        }
     
        public function deleteseo(User $user){
         // return $user->hasPermissionTo('delete post')||$user->id===$post->authors->contains('id',$user->id);
         return $user->hasPermissionTo('delete seo');
        }
     
        // public function changeStatus(User $user){
        //  return $user->hasPermissionTo('change user status');
        // }
}
