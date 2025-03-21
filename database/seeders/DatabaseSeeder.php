<?php

namespace Database\Seeders;

use App\Models\Tag;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CursoSeeder;
use Database\Seeders\PostTypeSeeder;
use Database\Seeders\CategoriaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        $this->call([
            TagSeeder::class,
            CategoriaSeeder::class,
            CursoSeeder::class,
            UserSeeder::class,
            PostTypeSeeder::class,
        ]);

        Post::factory(100)->create();

        foreach( Post::all() as $post ) {
            $tags = Tag::inRandomOrder()->take(rand(1,5))->pluck('id');
            $post->tags()->attach($tags);
        }
    }
}
