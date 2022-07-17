<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // define super admin
        $roleSuperAdmin = Role::where('name', 'super admin')->first();

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'spadmin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $superAdmin->assignRole($roleSuperAdmin);

        // define admin
        $roleAdmin = Role::where('name', 'admin')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole($roleAdmin);

    }
}
