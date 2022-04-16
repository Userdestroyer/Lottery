<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Draw;
use App\Models\DrawType;
use Database\Factories\DrawFactory;
use Illuminate\Support\Facades\DB;
use App\Actions\NumberGenerator;

class DrawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $DrawTypesIds = DrawType::where('id', '>', 0)->pluck('id')->toArray();
        $generator = new NumberGenerator();
        $n = 10; //NUMBER OF FACTORY ITERATIONS
            for ($i = 1; $i <= $n; $i++) {
                foreach ($DrawTypesIds as $id){
                    $drawType = DrawType::find($id);
                if ($i<$n) {
                    Draw::factory()->create([
                        'type_id' => $drawType->id,
                        'values' => json_encode($generator->run($drawType->id, $drawType->min_of_values))
                    ]);
                } else {
                    Draw::factory()->create([
                        'type_id' => $drawType->id,
                        'values' => json_encode($generator->run($drawType->id, $drawType->min_of_values)),
                        'is_played' => false
                    ]);
                }
            }
        }
    }
}
