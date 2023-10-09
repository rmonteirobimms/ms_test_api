<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deliverable>
 */
class DeliverableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $task = Task::inRandomOrder()->first();
        return [
            'task_id' => $task->id,
            'title' => fake()->sentence(3),
            'status' => fake()->biasedNumberBetween(0, 3)
        ];
    }
}
