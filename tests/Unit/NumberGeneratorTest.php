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
        $ids = DrawType::where('id' ,'>' ,0)->pluck('id')->toArray();
        foreach ($ids as $id) {
            $min = DrawType::where('id',$id)->value('min_of_values');
            $max = DrawType::where('id',$id)->value('max_of_values');
            for ($n = $min; $n <= $max; $n++) {
                $generator = new NumberGenerator();
                $this->assertEquals($n, count($generator->run($id, $n)));
            }
        }


    }
}
