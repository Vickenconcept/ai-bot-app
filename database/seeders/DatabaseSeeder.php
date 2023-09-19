<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Bot;
use App\Models\Content;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(10)->has(
            Conversation::factory(2)->hasMessages(10)
        )
            ->has(Bot::factory(1))
            ->has(Content::factory(3)->hasDocuments(2))
            ->create();
    }
}
