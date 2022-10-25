<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'rima',
            'username' => 'rima123',
            'email' => 'ramba14@gmail.com',
            'password' => bcrypt('password'),
        ]);
        // User::create([
        //     'name' => 'Julia Ria',
        //     'email' => 'juliaria@gmail.com',
        //     'password' => bcrypt('11111')
        // ]);

        User::factory(4)->create();

        Category::create([
            'name' => 'Web Progaming',
            'slug' => 'web-progaming',
        ]);
        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        Post::factory(13)->create();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
