<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat role
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);
        Role::create(['name' => 'Warung']);

        // Assign role ke user tertentu
        $admin = User::find(1); // Ganti dengan ID admin
        $admin->assignRole('Admin');

        $user = User::find(2); // Ganti dengan ID user
        $user->assignRole('User');

        $warung = User::find(3); // Ganti dengan ID warung
        $warung->assignRole('Warung');
    }
}
