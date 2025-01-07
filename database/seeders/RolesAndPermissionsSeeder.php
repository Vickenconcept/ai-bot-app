<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {

         // Define permissions
         Permission::create(['name' => 'create-review']);
         Permission::create(['name' => 'manage-review']);
         Permission::create(['name' => 'access-agency-setup']);
         Permission::create(['name' => 'access-dfy-traffic']);
         Permission::create(['name' => 'access-affiliate-coaching']);
         Permission::create(['name' => 'access-reseller']);
        //  Add more permissions as needed...
 
        //  Define roles and assign permissions
         $frontendRole = Role::create(['name' => 'frontend']);
         $frontendRole->givePermissionTo(['create-review', 'manage-review']);
 
         $fastPassRole = Role::create(['name' => 'fast_pass_bundle']);
         $fastPassRole->givePermissionTo(Permission::all()); // Fast-pass has full access
 
         $dfyAgencyRole = Role::create(['name' => 'dfy_ai']);
         $dfyAgencyRole->givePermissionTo('access-agency-setup');
 
         $dfyTrafficRole = Role::create(['name' => 'unlimited_traffic']);
         $dfyTrafficRole->givePermissionTo('access-dfy-traffic');
 
         $affiliateCoachingRole = Role::create(['name' => 'affiliate_coaching']);
         $affiliateCoachingRole->givePermissionTo('access-affiliate-coaching');
 
         $affiliateCoachingRole = Role::create(['name' => 'reseller']);
         $affiliateCoachingRole->givePermissionTo('access-reseller');

         
        $products = [
            // Frontend Products
            ['product_id' => 413969, 'name' => 'Frontend', 'funnel' => 'frontend'],
            // ['product_id' => 412441, 'name' => 'Frontend', 'funnel' => 'frontend'],

            // Fast-Pass Bundle
            ['product_id' => 414105, 'name' => 'Fast-Pass Bundle', 'funnel' => 'fast_pass_bundle'],
            ['product_id' => 414107, 'name' => 'Fast-Pass Bundle', 'funnel' => 'fast_pass_bundle'],

            // DFY Review Management Agency Setup
            ['product_id' => 414157, 'name' => 'DFY Review Management Agency Setup', 'funnel' => 'dfy_review'],
            ['product_id' => 414159, 'name' => 'DFY Review Management Agency Setup', 'funnel' => 'dfy_review'],

            // Unlimited DFY Traffic
            ['product_id' => 414161, 'name' => 'Unlimited DFY Traffic', 'funnel' => 'unlimited_traffic'],
            ['product_id' => 414163, 'name' => 'Unlimited DFY Traffic', 'funnel' => 'unlimited_traffic'],

            // Affiliate Marketing Coaching
            ['product_id' => 414169, 'name' => 'Affiliate Marketing Coaching', 'funnel' => 'affiliate_coaching'],
            ['product_id' => 414171, 'name' => 'Affiliate Marketing Coaching', 'funnel' => 'affiliate_coaching'],
            
            // Reseller
            ['product_id' => 414165, 'name' => 'Reseller', 'funnel' => 'reseller'],
            ['product_id' => 414167, 'name' => 'Reseller', 'funnel' => 'reseller'],
        ];

        // foreach ($products as $product) {
        //     Product::create($product);
        // }

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['product_id' => $product['product_id']], // Check for existence by product_id
                ['name' => $product['name'], 'funnel' => $product['funnel']] // Data to create if product_id doesn't exist
            );
        }
    }
    // {
    //     // Create Permissions
    //     Permission::create(['name' => 'frontend']);
    //     Permission::create(['name' => 'oto1']);
    //     Permission::create(['name' => 'oto2']);
    //     Permission::create(['name' => 'oto3']);
    //     Permission::create(['name' => 'oto4']);
    //     Permission::create(['name' => 'oto5']);
    //     Permission::create(['name' => 'oto6']);
    //     Permission::create(['name' => 'Bundle']);
    //     // Add more permissions as needed

    //     // Create Roles and assign Permissions
    //     $frontend = Role::create(['name' => 'frontend']);
    //     $frontend->givePermissionTo('frontend');

    //     $oto1 = Role::create(['name' => 'oto1']);
    //     $oto1->givePermissionTo('oto1');

    //     $oto2 = Role::create(['name' => 'oto2']);
    //     $oto2->givePermissionTo('oto2');

    //     $oto3 = Role::create(['name' => 'oto3']);
    //     $oto3->givePermissionTo('oto3');

    //     $oto4 = Role::create(['name' => 'oto4']);
    //     $oto4->givePermissionTo('oto4');

    //     $oto5 = Role::create(['name' => 'oto5']);
    //     $oto5->givePermissionTo('oto5');
        
    //     $oto6 = Role::create(['name' => 'oto6']);
    //     $oto6->givePermissionTo('oto6');

    //     $Bundle = Role::create(['name' => 'Bundle']);
    //     $Bundle->givePermissionTo('Bundle');

    //     // Repeat for other roles and permissions
    // }
}
