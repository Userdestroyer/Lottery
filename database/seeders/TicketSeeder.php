<?php

namespace Database\Seeders;

use App\Actions\NumberGenerator;
use App\Models\Draw;
use App\Models\DrawType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //FOR PLAYED

        //FOR UNPLAYED
        $DrawIds = Draw::where('is_played', false)->pluck('id')->toArray();
        $generator = new NumberGenerator();
        $n = 100; //NUMBER OF FACTORY ITERATIONS
        foreach ($DrawIds as $id){
            $draw = Draw::find($id);
            $number = 0; // INITIAL TICKET NUMBER
            for ($i = 1; $i <= $n; $i++) {
                $user = User::where('id','>', 0)->inRandomOrder()->limit(1)->first();
                $values = json_encode($generator->run($draw->type_id, mt_rand(
                    $draw->draw_type()->value('min_of_values'),
                    $draw->draw_type()->value('max_of_values'))));
                if (Ticket::where('draw_id', $draw->id)->exists()) {
                    $number = Ticket::where('draw_id', $draw->id)->max('number');
                }
                Ticket::factory()->create([
                    'type_id' => $draw->type_id,
                    'draw_id' => $draw->id,
                    'number' => ++$number, //REFACTOR
                    'values' => $values,
                    'user_id' => $user->id
                ]);
            }
        }

    }
}
