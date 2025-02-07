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
        // POST MODULE PERMISSIONS
        Permission::create(['name' => 'create Post','Slug'=>'create-posts']);
        Permission::create(['name' => 'edit Post','Slug'=>'edit-posts']);
        Permission::create(['name' => 'delete Post','Slug'=>'delete-posts']);
        Permission::create(['name' => 'View Post','Slug'=>'view-posts']);

        // CATEGORY PERMISSIONS
        Permission::create(['name' => 'create category','Slug'=>'create-categories']);
        Permission::create(['name' => 'edit category','Slug'=>'edit-categories']);
        Permission::create(['name' => 'delete category','Slug'=>'delete-categories']);
        Permission::create(['name' => 'View category','Slug'=>'view-categories']);

        // Author Permissions
        Permission::create(['name' => 'create author','Slug'=>'create-authors']);
        Permission::create(['name' => 'edit author','Slug'=>'edit-authors']);
        Permission::create(['name' => 'delete author','Slug'=>'delete-authors']);
        Permission::create(['name' => 'View author','Slug'=>'view-authors']);

        // User CRUD Permissions
        Permission::create(['name' => 'create User', 'slug' => 'create-users']);
        Permission::create(['name' => 'edit User', 'slug' => 'edit-users']);
        Permission::create(['name' => 'delete User', 'slug' => 'delete-users']);
        Permission::create(['name' => 'view User', 'slug' => 'view-users']);

        // Role Permissions
        Permission::create(['name' => 'assign Role', 'slug' => 'assign-roles']);
        Permission::create(['name' => 'edit Role', 'slug' => 'edit-roles']);
        Permission::create(['name' => 'delete Role', 'slug' => 'delete-roles']);
        Permission::create(['name' => 'view Role', 'slug' => 'view-roles']);

        // Permission Permissions (for viewing and assigning permissions to roles)
        Permission::create(['name' => 'view Permissions', 'slug' => 'view-permissions']);
        Permission::create(['name' => 'assign Permissions', 'slug' => 'assign-permissions']);

        // STATUS PERMISSIOSN
        Permission::create(['name' => 'change status','Slug'=>'change-status']);

    }
}
