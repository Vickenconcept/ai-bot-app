<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create Permissions
        Permission::create(['name' => 'frontend']);
        Permission::create(['name' => 'oto1']);
        Permission::create(['name' => 'oto2']);
        Permission::create(['name' => 'oto3']);
        Permission::create(['name' => 'oto4']);
        Permission::create(['name' => 'oto5']);
        Permission::create(['name' => 'oto6']);
        Permission::create(['name' => 'Bundle']);
        // Add more permissions as needed

        // Create Roles and assign Permissions
        $frontend = Role::create(['name' => 'frontend']);
        $frontend->givePermissionTo('frontend');

        $oto1 = Role::create(['name' => 'oto1']);
        $oto1->givePermissionTo('oto1');

        $oto2 = Role::create(['name' => 'oto2']);
        $oto2->givePermissionTo('oto2');

        $oto3 = Role::create(['name' => 'oto3']);
        $oto3->givePermissionTo('oto3');

        $oto4 = Role::create(['name' => 'oto4']);
        $oto4->givePermissionTo('oto4');

        $oto5 = Role::create(['name' => 'oto5']);
        $oto5->givePermissionTo('oto5');
        
        $oto6 = Role::create(['name' => 'oto6']);
        $oto6->givePermissionTo('oto6');

        $Bundle = Role::create(['name' => 'Bundle']);
        $Bundle->givePermissionTo('Bundle');

        // Repeat for other roles and permissions
    }
}
