<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
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
        
        // Post::create([
        //     'title' => 'Title 1',
        //     'text' => 'lorem ipsum dolor sit',
        //     'creation_date' => date('Y-m-d'),
        //     'user_id' => User::all()->first()->id,
        // ]);

        // Post::create([
        //     'title' => 'Title 2',
        //     'text' => 'lorem ipsum dolor sit lorem ipsum dolor sit',
        //     'creation_date' => date('Y-m-d'),
        //     'user_id' => User::all()->first()->id,
        // ]);
    }
}
