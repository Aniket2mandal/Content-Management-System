<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission::truncate();

        // POST MODULE PERMISSIONS
        Permission::create(['name' => 'create post','Slug'=>'create-posts']);
        Permission::create(['name' => 'edit post','Slug'=>'edit-posts']);
        Permission::create(['name' => 'delete post','Slug'=>'delete-posts']);
        Permission::create(['name' => 'view post','Slug'=>'view-posts']);

        // CATEGORY PERMISSIONS
        Permission::create(['name' => 'create category','Slug'=>'create-categories']);
        Permission::create(['name' => 'edit category','Slug'=>'edit-categories']);
        Permission::create(['name' => 'delete category','Slug'=>'delete-categories']);
        Permission::create(['name' => 'view category','Slug'=>'view-categories']);

        // Author Permissions
        Permission::create(['name' => 'create author','Slug'=>'create-authors']);
        Permission::create(['name' => 'edit author','Slug'=>'edit-authors']);
        Permission::create(['name' => 'delete author','Slug'=>'delete-authors']);
        Permission::create(['name' => 'view author','Slug'=>'view-authors']);

        // User CRUD Permissions
        Permission::create(['name' => 'create user', 'slug' => 'create-users']);
        Permission::create(['name' => 'edit user', 'slug' => 'edit-users']);
        Permission::create(['name' => 'delete user', 'slug' => 'delete-users']);
        Permission::create(['name' => 'view user', 'slug' => 'view-users']);

        // Role Permissions
        Permission::create(['name' => 'assign role', 'slug' => 'assign-roles']);
        Permission::create(['name' => 'edit role', 'slug' => 'edit-roles']);
        Permission::create(['name' => 'delete role', 'slug' => 'delete-roles']);
        Permission::create(['name' => 'view role', 'slug' => 'view-roles']);

        // Permission Permissions (for viewing and assigning permissions to roles)
        Permission::create(['name' => 'view permission', 'slug' => 'view-permissions']);
        Permission::create(['name' => 'assign permission', 'slug' => 'assign-permissions']);

        // STATUS PERMISSIOSN
        Permission::create(['name' => 'change status','Slug'=>'change-status']);

    }
}
