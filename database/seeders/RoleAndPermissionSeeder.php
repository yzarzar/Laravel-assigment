<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);
        $manager = Role::create(['name' => 'manager']);

        // Admin only permission
        $dashboard = Permission::create(['name' => 'dashboard']);

        // Role management permissions
        $roleList = Permission::create(['name' => 'role-list']);
        $roleCreate = Permission::create(['name' => 'role-create']);
        $roleEdit = Permission::create(['name' => 'role-edit']);
        $roleDelete = Permission::create(['name' => 'role-delete']);

        // Product permissions
        $productList = Permission::create(['name' => 'product-list']);
        $productCreate = Permission::create(['name' => 'product-create']);
        $productEdit = Permission::create(['name' => 'product-edit']);
        $productDelete = Permission::create(['name' => 'product-delete']);
        $productView = Permission::create(['name' => 'product-view']);

        // Category permissions
        $categoryList = Permission::create(['name' => 'category-list']);
        $categoryCreate = Permission::create(['name' => 'category-create']);
        $categoryEdit = Permission::create(['name' => 'category-edit']);
        $categoryDelete = Permission::create(['name' => 'category-delete']);
        $categoryView = Permission::create(['name' => 'category-view']);

        // User permissions
        $userList = Permission::create(['name' => 'user-list']);
        $userCreate = Permission::create(['name' => 'user-create']);
        $userEdit = Permission::create(['name' => 'user-edit']);
        $userDelete = Permission::create(['name' => 'user-delete']);
        $userView = Permission::create(['name' => 'user-view']);

        // Give admin all permissions
        $admin->givePermissionTo([
            $dashboard,
            // Products
            $productList,
            $productCreate,
            $productEdit,
            $productDelete,
            $productView,
            // Categories
            $categoryList,
            $categoryCreate,
            $categoryEdit,
            $categoryDelete,
            $categoryView,
            // Users
            $userList,
            $userCreate,
            $userEdit,
            $userDelete,
            $userView,
            // Roles
            $roleList,
            $roleCreate,
            $roleEdit,
            $roleDelete,
        ]);

        // Give manager permissions
        $manager->givePermissionTo([
            // Products
            $productList,
            $productCreate,
            $productEdit,
            $productView,
            // Categories
            $categoryList,
            $categoryCreate,
            $categoryEdit,
            $categoryView,
            // Users
            $userList,
            $userView,
            // Roles
            $roleList,
            $roleCreate,
            $roleEdit,
            $roleDelete,
        ]);

        // Give regular user permissions
        $user->givePermissionTo([
            $productList,
            $productView,
            $categoryList,
            $categoryView,
        ]);
    }
}
