<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Draw;
use Database\Factories\DrawFactory;
use Illuminate\Support\Facades\DB;

class DrawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Draw::factory(7)->create();
        for ($i = 1; $i<=3; $i++) {
            Draw::where([
                ['type_id', $i],
                ['is_played', '0']
            ])->update(array('is_played' => '1'));

            DB::table('draws')->insert([
                'type_id' => $i,
                'values' => json_encode(array (7, 9, 12, 22, 27, 34)),
                'pot' => mt_rand(1000,4800000),
                'received' => 0,
                'paid' => 0,
                'is_played' => false,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }

    }
}
