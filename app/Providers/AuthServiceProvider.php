<?php

namespace App\Providers;

use App\Models\Author;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Seo;
use App\Models\User;
use App\Policies\AuthorPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\PagePolicy;
use App\Policies\PermissionPolicy;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use App\Policies\SeoPolicy;

use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
      
            Post::class => PostPolicy::class,
            Category::class => CategoryPolicy::class,
            Author::class => AuthorPolicy::class,
            User::class=>UserPolicy::class,
            Role::class=>RolePolicy::class,
            Permission::class=>PermissionPolicy::class,
            Page::class=>PagePolicy::class,
            Seo::class=>SeoPolicy::class,
     
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
       

        
    }
}
