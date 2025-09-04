<?php

namespace Database\Factories\Posts;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        $name = fake()->word();

        return [
            'person_id' => rand(1,5),
            'group_id' => rand(1,5),
            'name' => $name,
            'content' => fake()->paragraph(rand(5, 15)),
            'valid_from' => Carbon::now()->addDays(rand(-5, 2)),
            'slug' => Str::slug($name),
        ];
    }
}
