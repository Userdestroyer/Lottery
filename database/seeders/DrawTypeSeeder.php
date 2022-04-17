<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DrawType;
use App\Models\PayAccount;

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
                'max_of_values' => 12,
                'fee_percentage' => 0.5,
                'pot_min_amount' => 1000000,
                'description' => 'Empty',
            ],
            [
                'type' => '6x45',
                'name' => '6 из 45',
                'volume' => 45,
                'min_of_values' => 6,
                'max_of_values' => 12,
                'fee_percentage' => 0.5,
                'pot_min_amount' => 1000000,
                'description' => 'Empty',
            ],
            [
                'type' => '7x49',
                'name' => '7 из 49',
                'volume' => 49,
                'min_of_values' => 7,
                'max_of_values' => 15,
                'fee_percentage' => 0.5,
                'pot_min_amount' => 1000000,
                'description' => 'Empty',
            ]
        ];

        $prize_charts = [
            [
                'winner_after' => 2,
                '2_match_level' => 100,
                '3_match_level' => 1000,
                '4_match_level' => 10000
            ],
            [
                'winner_after' => 2,
                '2_match_level' => 100,
                '3_match_level' => 1000,
                '4_match_level' => 10000,
                '5_match_level' => 100000,
            ],
            [
                'winner_after' => 2,
                '2_match_level' => 100,
                '3_match_level' => 1000,
                '4_match_level' => 10000,
                '5_match_level' => 100000,
                '6_match_level' => 500000,

            ]
        ];

        for ($i=0; $i < count($draw_types); $i++) {
            $newDraw = DrawType::firstOrCreate($draw_types[$i]);
            $newDraw->payAccount()->create([
                'description' => 'Prize fund',
                'balance' => 500000
            ]);
            $newDraw->payAccount()->create([
                'description' => 'Pot',
                'balance' => 1000000
            ]);
            $newDraw->prizeChart()->create($prize_charts[$i]);
        }
    }
}
