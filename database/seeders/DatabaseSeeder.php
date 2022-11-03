<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tags;
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
        User::factory(4)->create();

        Tags::create([
            'name' => 'PHP',
            'slug' => 'php',
        ]);
        Tags::create([
            'name' => 'Jalan jalan',
            'slug' => 'jalan-jalan',
        ]);
        Tags::create([
            'name' => 'Design',
            'slug' => 'design',
        ]);
        Tags::create([
            'name' => 'Travel',
            'slug' => 'travel',
        ]);

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

        Post::factory(5)->create();
    }
}
