<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'View Products', 'slug' => 'view-products', 'description' => 'View product list'],
            ['name' => 'Create Products', 'slug' => 'create-products', 'description' => 'Create new products'],
            ['name' => 'Edit Products', 'slug' => 'edit-products', 'description' => 'Edit existing products'],
            ['name' => 'Delete Products', 'slug' => 'delete-products', 'description' => 'Delete products'],
            ['name' => 'View Categories', 'slug' => 'view-categories', 'description' => 'View category list'],
            ['name' => 'Create Categories', 'slug' => 'create-categories', 'description' => 'Create new categories'],
            ['name' => 'Edit Categories', 'slug' => 'edit-categories', 'description' => 'Edit existing categories'],
            ['name' => 'Delete Categories', 'slug' => 'delete-categories', 'description' => 'Delete categories'],
            ['name' => 'View Slides', 'slug' => 'view-slides', 'description' => 'View slides list'],
            ['name' => 'Create Slides', 'slug' => 'create-slides', 'description' => 'Create new homepage slides'],
            ['name' => 'Edit Slides', 'slug' => 'edit-slides', 'description' => 'Edit existing slides'],
            ['name' => 'Delete Slides', 'slug' => 'delete-slides', 'description' => 'Delete slides'],
            ['name' => 'View Orders', 'slug' => 'view-orders', 'description' => 'View customer orders'],
            ['name' => 'Update Orders', 'slug' => 'update-orders', 'description' => 'Update order status'],
            ['name' => 'Manage Users', 'slug' => 'manage-users', 'description' => 'View, edit, and delete users'],
            ['name' => 'Manage Roles', 'slug' => 'manage-roles', 'description' => 'Create, edit, and delete roles'],
            ['name' => 'Manage Permissions', 'slug' => 'manage-permissions', 'description' => 'Create, edit, and delete permissions'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['slug' => $perm['slug']], $perm);
        }

        $adminRole = Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'description' => 'Full access to all features']
        );
        $adminRole->permissions()->sync(Permission::pluck('id'));

        $editorRole = Role::firstOrCreate(
            ['slug' => 'editor'],
            ['name' => 'Editor', 'description' => 'Can manage products, categories, slides, and orders']
        );
        $editorPermissions = Permission::whereIn('slug', [
            'view-products', 'create-products', 'edit-products', 'delete-products',
            'view-categories', 'create-categories', 'edit-categories', 'delete-categories',
            'view-slides', 'create-slides', 'edit-slides', 'delete-slides',
            'view-orders', 'update-orders',
        ])->pluck('id');
        $editorRole->permissions()->sync($editorPermissions);
    }
}
