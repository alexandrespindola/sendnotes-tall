<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'user_id' => User::factory(),
            'title' => ucfirst($this->faker->words(5, true)),
            'body' => $this->faker->paragraph,
            'recipient' => $this->faker->email,
            'send_date' => $this->faker->dateTimeBetween('Y-m-d', '+10 days'),
            'is_published' => $this->faker->boolean,
            'heart_count' => $this->faker->numberBetween(0, 20),
        ];
    }
}
