<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->sentence();
        return [
            'title' => $name,
            'description' => fake()->words(7, true),
            'body' => fake()->paragraph(),
            'start_event' => now(),
            'slug' => Str::slug($name),
        ];
    }
}
