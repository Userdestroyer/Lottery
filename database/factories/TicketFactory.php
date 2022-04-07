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
        return [
            'ticket_type' =>
            'ticket_draw_number'
            'ticket_number'
            'ticket_values'
            'ticket_price'
            'ticket_is_winner'
            'ticket_winning_sum'
            'ticket_user_id'
        ];
    }
}
