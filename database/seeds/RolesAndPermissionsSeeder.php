<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create users
        Permission::create(['guard_name' => 'web', 'name' => 'edit users']);
        Permission::create(['guard_name' => 'web', 'name' => 'create users']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete users']);
        Permission::create(['guard_name' => 'web', 'name' => 'view users']);
        Permission::create(['guard_name' => 'web', 'name' => 'restore users']);
        Permission::create(['guard_name' => 'web', 'name' => 'force delete users']);

        // create roles
        Permission::create(['guard_name' => 'web', 'name' => 'create roles']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit roles']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete roles']);
        Permission::create(['guard_name' => 'web', 'name' => 'view roles']);
        Permission::create(['guard_name' => 'web', 'name' => 'restore roles']);
        Permission::create(['guard_name' => 'web', 'name' => 'force delete roles']);

        // create clients
        Permission::create(['guard_name' => 'web', 'name' => 'create clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'view clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'restore clients']);
        Permission::create(['guard_name' => 'web', 'name' => 'force delete clients']);

        // create orders
        Permission::create(['guard_name' => 'web', 'name' => 'update orders status']);
        Permission::create(['guard_name' => 'web', 'name' => 'create orders']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit orders']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete orders']);
        Permission::create(['guard_name' => 'web', 'name' => 'view orders']);
        Permission::create(['guard_name' => 'web', 'name' => 'upload orders']);
        Permission::create(['guard_name' => 'web', 'name' => 'send orders']);
        Permission::create(['guard_name' => 'web', 'name' => 'restore orders']);
        Permission::create(['guard_name' => 'web', 'name' => 'force delete orders']);

        // create products
        Permission::create(['guard_name' => 'web', 'name' => 'create products']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit products']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete products']);
        Permission::create(['guard_name' => 'web', 'name' => 'view products']);
        Permission::create(['guard_name' => 'web', 'name' => 'restore products']);
        Permission::create(['guard_name' => 'web', 'name' => 'force delete products']);

        // create invoices
        Permission::create(['guard_name' => 'web', 'name' => 'create invoices']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit invoices']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete invoices']);
        Permission::create(['guard_name' => 'web', 'name' => 'view invoices']);
        Permission::create(['guard_name' => 'web', 'name' => 'restore invoices']);
        Permission::create(['guard_name' => 'web', 'name' => 'force delete invoices']);


        // View
        Permission::create(['guard_name' => 'web', 'name' => 'view sales']);
        Permission::create(['guard_name' => 'web', 'name' => 'view returns']);
        Permission::create(['guard_name' => 'web', 'name' => 'view settings']);
        Permission::create(['guard_name' => 'web', 'name' => 'view reports']);
        Permission::create(['guard_name' => 'web', 'name' => 'download invoice']);


        Permission::create(['guard_name' => 'web', 'name' => 'filter product by client']);

        // Client
        // create Super admin
        $role = Role::create(['guard_name' => 'web', 'name' => 'Super admin']);
        // $role->givePermissionTo(Permission::all());

        // this can be done as separate statements
        $role = Role::create(['guard_name' => 'web', 'name' => 'Admin']);
        $role->givePermissionTo('view users');

        // $role = Role::create(['guard_name' => 'client', 'name' => 'Client']);
        $role->givePermissionTo('view orders');

    }

}
