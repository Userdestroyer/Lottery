<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Draw>
 */
class DrawFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function randomArray()
    {
        $array = array (
            $ar1 = array (7, 9, 12, 22, 27, 34),
            $ar2 = array (1, 3, 6, 11, 22, 30, 35),
            $ar3 = array (4, 8, 7, 19, 20, 21, 27, 31)
        );
        return $this->faker->randomElement($array);
    }

    public function definition()
    {
        return [
            //'draw_values' => $this->faker->randomElements($array, $count = 1),
            'draw_type_id' => $this->faker->numberBetween(1,3),
            'draw_values' => json_encode($this->randomArray()),
            'draw_pot' => $this->faker->numberBetween(1000,4800000),
            'draw_received' => 0,
            'draw_paid' => 0,
            'draw_played' => true
        ];
    }
}
