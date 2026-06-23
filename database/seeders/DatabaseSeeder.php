<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            SlideSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        $admin = User::firstOrCreate(
            ['email' => 'admin@volt.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        $adminRole = Role::where('slug', 'admin')->first();
        if ($adminRole && !$admin->roles()->where('role_id', $adminRole->id)->exists()) {
            $admin->roles()->attach($adminRole);
        }
    }
}
