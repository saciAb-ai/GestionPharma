<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'view-dashboard',
            'view-sales', 'create-sale','destroy-sale','edit-sale',
            'view-reports',
            'view-category','create-category','destroy-category','edit-category',
            'view-products','create-product','edit-product','destroy-product',
            'view-purchase','create-purchase','edit-purchase','destroy-purchase',
            'view-supplier','create-supplier','edit-supplier','destroy-supplier',
            'view-users','create-user','edit-user','destroy-user',
            'view-access-control',
            'view-role','edit-role','destroy-role','create-role',
            'view-permission','create-permission','edit-permission','destroy-permission',
            'view-expired-products','view-outstock-products',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Roles
        // 1. Sales Person
        $salesRole = Role::create(['name' => 'sales-person']);
        $salesRole->givePermissionTo([
            'view-dashboard',
            'view-sales',
            'create-sale',
            'view-products',
            'view-expired-products',
            'view-outstock-products'
        ]);

        // 2. Super Admin
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
