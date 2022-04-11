<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DrawType;

class DrawTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $draw_types = [
            [
                'draw_type' => '5x36',
                'draw_type_name' => '5 из 36',
                'draw_type_volume' => 36,
                'draw_type_min_of_values' => 5,
                'draw_type_max_of_values' => 36,
                'draw_type_description' => 'Empty',
            ],
            [
                'draw_type' => '6x45',
                'draw_type_name' => '6 из 45',
                'draw_type_volume' => 45,
                'draw_type_min_of_values' => 6,
                'draw_type_max_of_values' => 45,
                'draw_type_description' => 'Empty',
            ],
            [
                'draw_type' => '7x49',
                'draw_type_name' => '7 из 49',
                'draw_type_volume' => 49,
                'draw_type_min_of_values' => 7,
                'draw_type_max_of_values' => 49,
                'draw_type_description' => 'Empty',
            ]
        ];

        foreach ($draw_types as $draw_type) {
            DrawType::firstOrCreate($draw_type);
        }
    }
}
