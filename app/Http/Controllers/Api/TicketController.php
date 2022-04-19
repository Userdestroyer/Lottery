<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Draw;
use App\Models\User;
use App\Models\DrawType;
use App\Rules\ActiveDraw;
use App\Actions\Transfer;
use App\Models\Company;

class TicketController extends Controller
{
    //Create ticket
    public function createTicket (Request $request) {
        //Validate

        $rules = [
            'type_id' => ['required', 'exists:draw_types,id', new ActiveDraw],
            'values' =>  ['required', 'json'], //VERIFY BY DRAW TYPE
            'price' =>  ['required', 'integer'] //finish
        ];

        $this->validate($request, $rules);

        $company_name = 'Lotto';
        $company_id = Company::where('name', $company_name)->first();
        $companyPayAccount = $company_id->payAccount()->first();
        //user id+create data
            $ticket = new Ticket();
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $number = 0;
                $ticket->type_id = $request->type_id;
                $ticket->draw_id = Draw::where([
                    ['type_id', $request->type_id],
                    ['is_played', '0']
                    ])->value('id');

                    if (Ticket::where('draw_id', $ticket->draw_id)->exists()) {
                        $number = Ticket::where('draw_id', $ticket->draw_id)->max('number');
                    }
                $ticket->number = ++$number;
                $ticket->values = $request->values; //VERIFY BY DRAW TYPE
                $ticket->price = $request->price; //CUSTOM METHOD
                $ticket->is_winner = false;
                $ticket->user_id = $user_id; // UPDATE

            return \DB::transaction(function () use ($request, $ticket, $user, $companyPayAccount){
                $transfer = new Transfer();
                $transfer->run($user->payAccount, $companyPayAccount, $request->price, 'Ticket purchase');

                $ticket->save();

                return response()->json([
                    "status" => 1,
                    "Message" => "Ticket has been created"
                ]);
            });

            //response


    }
}
