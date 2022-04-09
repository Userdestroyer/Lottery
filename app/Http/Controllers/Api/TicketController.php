<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Draw;
use App\Models\DrawType;
use App\Rules\ActiveDraw;

class TicketController extends Controller
{
    //Create ticket
    public function createTicket (Request $request) {
        //Validate

        $rules = [
            'ticket_draw_type_id' => ['required', 'exists:draw_types,draw_type_id', new ActiveDraw],
            'ticket_values' =>  ['required', 'json'], //VERIFY BY DRAW TYPE
            'ticket_price' =>  ['required', 'integer'] //finish
        ];

        $this->validate($request, $rules);

        //user_id+create data
        $ticket = new Ticket();

        $ticket_number = 0;
            $ticket->ticket_draw_type_id = $request->ticket_draw_type_id;
            $ticket->ticket_draw_id = Draw::where([
                ['draw_type_id', $request->ticket_draw_type_id],
                ['draw_played', '0']
                ])->value('draw_id');

                if (Ticket::where('ticket_draw_id', $ticket->ticket_draw_id)->exists()) {
                    $ticket_number = Ticket::where('ticket_draw_id', $ticket->ticket_draw_id)->max('ticket_number');
                }
            $ticket->ticket_number = ++$ticket_number;
            $ticket->ticket_values = $request->ticket_values; //VERIFY BY DRAW TYPE
            $ticket->ticket_price = $request->ticket_price; //CUSTOM METHOD
            $ticket->ticket_is_winner = false;
            $ticket->ticket_winning_sum = 0;
            $ticket->ticket_user_id = 1; //

        $ticket->save();

        //response
        return response()->json([
            "status" => 1,
            "Message" => "Ticket has been created"
        ]);

    }
}
