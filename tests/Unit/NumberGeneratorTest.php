<?php

namespace Tests\Unit;

use App\Actions\NumberGenerator;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\DrawTypeSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\DrawType;

class NumberGeneratorTest extends TestCase
{

    use RefreshDatabase;
    /**
     * @test
     */
    public function compare_number_of_values()
    {
        $seeder = new DrawTypeSeeder();
        $seeder->call(DrawTypeSeeder::class);
        $ids = DrawType::where('draw_type_id' ,'>' ,0)->pluck('draw_type_id')->toArray();
        foreach ($ids as $id) {
            $min = DrawType::where('draw_type_id',$id)->value('draw_type_min_of_values');
            $max = DrawType::where('draw_type_id',$id)->value('draw_type_max_of_values');
            for ($n = $min; $n <= $max; $n++) {
                $generator = new NumberGenerator();
                $this->assertEquals($n, count($generator->run($id, $n)));
            }
        }


    }
}
