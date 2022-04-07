<?php

namespace Database\Factories;

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
        $array = array (
            $ar1 = array (7, 9, 12, 22, 27, 34),
            $ar2 = array (1, 3, 6, 11, 22, 30, 35),
            $ar3 = array (4, 8, 7, 19, 20, 21, 27, 31)
        );
        return [
            'ticket_draw_id' => 1,
            'ticket_number' => $this->faker->numberBetween(1,100),
            'ticket_values' => json_encode($this->faker->randomElement($array)),
            'ticket_price' => $this->faker->numberBetween(100,5000),
            'ticket_is_winner' => (mt_rand(0,1) === 0),
            'ticket_winning_sum' => $this->faker->numberBetween(0,5000),
            'ticket_user_id' => $this->faker->numberBetween(1,10)
        ];
    }
}
