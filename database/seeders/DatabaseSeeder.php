<?php

namespace Database\Seeders;

use Database\Seeders\CategorySeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
{
    // $adminRole = Role::create(['name' => 'admin']);
    // $userRole = Role::create(['name' => 'user']);

    // Permission::create(['name' => 'create Posts','Slug'=>'create-posts']);
    // Permission::create(['name' => 'View Posts','Slug'=>'view-posts']);

    // $adminRole->givePermissionTo(['edit articles', 'delete articles']);
    // $userRole->givePermissionTo(['edit articles']);

    $this->call([
        PermissionSeeder::class,
        RoleSeeder::class,
        UserSeeder::class,
        CategorySeeder::class,
        AuthorSeeder::class,
        PostSeeder::class
    ]);

}
}
