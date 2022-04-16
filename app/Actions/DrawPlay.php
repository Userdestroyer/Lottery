<?php

namespace App\Actions;

use App\Models\DrawType;
use App\Models\Draw;
use App\Models\Ticket;
use App\Models\User;
use App\Actions\NumberGenerator;
use App\Actions\CompareValues;

class DrawPlay {


    public function closeActiveDraw (Draw $draw) {
        $draw->draw_played = true;
        $draw->save();
    }

    public function fillNumbers (DrawType $draw_type, Draw $draw) {
        $numbers = new NumberGenerator();
        $draw->values = $numbers->run($draw_type->id, $draw_type->min_of_values);
        $draw->save();
    }

    public function updateTickets (Draw $draw) {

        $prizeChart= $draw->prizeChart()->find($draw->type_id);
        $allTicketsIds = Ticket::where('draw_id', $draw->id)->get('id')->toArray();
        $drawValues = json_decode($draw->values);
        $comparer = new CompareValues();

        foreach ($allTicketsIds as $id) {
            $ticket = Ticket::find($id);
            $ticketValues = json_decode($ticket);
            $outputValues = $comparer->run($ticketValues, $drawValues);
            $outputValuesCount = count($outputValues);
            if ($outputValuesCount >= $prizeChart->winner_after) {
                $ticket->winner = true;
                $ticket->matches = $outputValues;
                $ticket->number_of_matches = $outputValuesCount;
                $matchColumn = $outputValuesCount . '_match_level';
                $ticket->winning_sum = $prizeChart->value($matchColumn);
                $ticket->save();
            }
        }

    }

    public function count_collect_sum () {

    }

    public function pay () {

    }

    public function play (string $type) {

        $draw_type = DrawType::where('type', $type)->first();
        $draw = Draw::where([
            ['type_id', $draw_type->id],
            ['is_played', '0']
        ])->first();

        $this->closeActiveDraw($draw);
        $this->fillNumbers($draw_type, $draw);

    }
}
