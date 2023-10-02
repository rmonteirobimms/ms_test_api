<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $creator = Profile::inRandomOrder()->first();
        $assignee = Profile::inRandomOrder()->first();
        return [
            'creator_id' => $creator->id,
            'title' => fake()->firstName(),
            'description' => fake()->unique()->safeEmail(),
            'assigned_to' => $assignee->id
        ];
    }
}
