<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bot;
use App\Models\Content;
use App\Models\Conversation;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        

        // User::factory(10)->has(
        //     Conversation::factory(2)->hasMessages(10)
        // )
        //     ->has(Bot::factory(1))
        //     ->has(Content::factory(3)->hasDocuments(2))
        //     ->create();

        $products = [
            ['name'=> 'product name', 'product_id' => 'wso_wrr75v', 'funnel' => 'frontend'],
            ['name'=> 'product name', 'product_id' => 'wso_kzgryb', 'funnel' => 'Bundle'],
            ['name'=> 'product name', 'product_id' => 'wso_zsy96g', 'funnel' => 'oto1'],
            ['name'=> 'product name', 'product_id' => 'wso_lnlw8h', 'funnel' => 'oto2'],
            ['name'=> 'product name', 'product_id' => 'wso_wyf6rq', 'funnel' => 'oto3'],
            ['name'=> 'product name', 'product_id' => 'wso_j5mmqv', 'funnel' => 'oto4'],
            ['name'=> 'product name', 'product_id' => 'wso_v18wf7', 'funnel' => 'oto5'],
            ['name'=> 'product name', 'product_id' => 'wso_dbt76y', 'funnel' => 'oto6'],
        ];


        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'product_id' => $product['product_id'],
                'funnel' => $product['funnel']
            ]);
        }

        $newUser = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'user',
            'password' =>  Hash::make('success'),
        ]);

        $newUser->assignRole('Bundle');
    }
}
