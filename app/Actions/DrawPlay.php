<?php

namespace App\Actions;

use App\Models\DrawType;
use App\Models\Draw;
use App\Models\Ticket;
use App\Models\User;
use App\Actions\NumberGenerator;

class DrawPlay {


    public function closeActiveDraw (Draw $draw) {
        $draw->draw_played = true;
        $draw->save();
    }

    public function fillNumbers (DrawType $draw_type, Draw $draw) {
        $numbers = new NumberGenerator();
        $draw->draw_values = $numbers->run($draw_type->draw_type_id, $draw_type->draw_type_min_of_values);
        $draw->save();
    }

    public function count () {
        // Update all winning tickets in foreach loop (ticket_number_of_matches)

        // Count sum to pay
    }

    public function play (string $type) {

        $draw_type = DrawType::where('draw_type', $type)->get();
        $draw = Draw::where([
            ['draw_type_id', $draw_type->draw_type_id],
            ['draw_played', '0']
        ])->get();

        $this->closeActiveDraw($draw);
        $this->fillNumbers($draw_type, $draw);

    }
}
