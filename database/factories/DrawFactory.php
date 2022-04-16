<?php

namespace Database\Factories;

use App\Models\DrawType;
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
    public function definition()
    {
        return [
            'type_id' => 1,
            'values' => json_encode(array (0, 0, 0, 0, 0, 0)),
            'is_played' => true
        ];
    }
}
