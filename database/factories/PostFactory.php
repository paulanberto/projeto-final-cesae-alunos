<?php

namespace Database\Factories;

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
            'user_id' => User::factory(),
            'categoria_id' => random_int(1,9),
            'post_type_id' => random_int(1,3),
            'titulo' => fake()->sentence(5),
            'texto' => fake()->paragraph(40)
        ];
    }
}
