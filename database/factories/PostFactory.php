<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'categoria_id' => random_int(1,9),
            'post_type_id' => random_int(1,3),
            'titulo' => fake()->sentence(5),
            'texto' => fake()->paragraph(35),
            'parent_id' => null,
        ];
    }

    public function comment(): Factory
    {

        return $this->state(function (array $attributes){
            $parent = Post::where('post_type_id', '!=', 4)->get()->random();
            return [
                'user_id' => User::all()->random()->id,
                'categoria_id' => $parent->categoria_id,
                'post_type_id' => 4,
                'titulo' => null,
                'texto' => fake()->paragraph(12),
                'parent_id' => $parent->id,
            ];
        });

    }

}
