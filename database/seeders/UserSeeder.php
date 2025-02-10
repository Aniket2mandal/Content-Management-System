<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            // $adminRole = Role::findByName('admin');
            // $userRole = Role::findByName('user');
        
            // // Assigning roles to existing users
            $password=Hash::make('password');
            $adminUser = User::create(['name' => 'super admin','email'=>'super@gmail.com','password'=>$password,'status'=>1]);
            $adminUser->syncRoles('super admin');
           
        }
    }
}
