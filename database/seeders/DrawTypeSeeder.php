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
                'type' => '5x36',
                'name' => '5 из 36',
                'volume' => 36,
                'min_of_values' => 5,
                'max_of_values' => 36,
                'description' => 'Empty',
            ],
            [
                'type' => '6x45',
                'name' => '6 из 45',
                'volume' => 45,
                'min_of_values' => 6,
                'max_of_values' => 45,
                'description' => 'Empty',
            ],
            [
                'type' => '7x49',
                'name' => '7 из 49',
                'volume' => 49,
                'min_of_values' => 7,
                'max_of_values' => 49,
                'description' => 'Empty',
            ]
        ];

        foreach ($draw_types as $draw_type) {
            DrawType::firstOrCreate($draw_type);
        }
    }
}
