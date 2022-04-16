<?php

namespace Database\Factories;

use App\Models\DrawType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'type_id' => 1,
            'draw_id' => 1,
            'number' => 1,
            'values' => json_encode([0, 0, 0, 0, 0, 0]),
            'price' => $this->faker->numberBetween(100,5000),
            'is_winner' => false,
            'winning_sum' => 0,
            'balance' => 0,
            'user_id' => 1
        ];
    }
}
