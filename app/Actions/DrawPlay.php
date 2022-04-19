<?php

namespace App\Actions;

use App\Models\DrawType;
use App\Models\Draw;
use App\Models\Ticket;
use App\Models\PayAccount;
use App\Models\User;
use App\Actions\NumberGenerator;
use App\Actions\CompareValues;
use App\Actions\Transfer;

class DrawPlay {


    public function closeActiveDraw (Draw $draw) {
        $draw->is_played = true;
        $draw->save();
    }

    public function fillNumbers (DrawType $drawType, Draw $draw) {
        $numbers = new NumberGenerator();
        $draw->values = $numbers->run($drawType->id, $drawType->min_of_values);
        $draw->save();
    }

    public function updateTickets (Draw $draw) {

        $prizeChart= $draw->prizeChart()->find($draw->type_id);

        $allTicketsIds = Ticket::where('draw_id', $draw->id)->pluck('id')->toArray();
        $drawValues = $draw->values;
        $comparer = new CompareValues();
        $sumToPay = 0;
        foreach ($allTicketsIds as $id) {
            $ticket = Ticket::find($id);
            $ticketValues = json_decode($ticket->values);
            $outputValues = $comparer->run($ticketValues, $drawValues);
            $outputValuesCount = count($outputValues);
            if ($outputValuesCount >= $prizeChart->winner_after) {
                $ticket->is_winner = true;
                $ticket->matches = $outputValues;
                $ticket->number_of_matches = $outputValuesCount;
                $matchColumn = $outputValuesCount . '_match_level';
                $ticket->winning_sum = $prizeChart->value($matchColumn);
                $sumToPay += $prizeChart->value($matchColumn);
                $ticket->save();
            }
        }
        return $sumToPay;

    }

    public function collectSum (Draw $draw, int $sumToPay) {

        $prizeFundPayAccount = PayAccount::where('draw_type_id', $draw->type_id)
            ->where('description', 'Prize fund')->first();
        $potPayAccount = PayAccount::where('draw_type_id', $draw->type_id)
            ->where('description', 'Pot')->first();
        $lottoPayAccount = PayAccount::where('description', "Lotto's balance")->first();
        $potMinAmount = $draw->draw_type()->value('pot_min_amount');
        $transfer = new Transfer();

        $feePercentage = $draw->draw_type()->value('fee_percentage');
        $feeSum = $prizeFundPayAccount->balance * $feePercentage;
        $transfer->run($prizeFundPayAccount, $lottoPayAccount, $feeSum, 'Fee Payment');

        if ($sumToPay > $prizeFundPayAccount->balance) {
            if ($sumToPay - $prizeFundPayAccount->balance > $potPayAccount->balance - $potMinAmount) {
                $sumFromPot = $potPayAccount->balance - $potMinAmount;
                $sumFromCompanyAccount = $sumToPay - $prizeFundPayAccount->balance - $sumFromPot;

                return \DB::transaction(function () use ($transfer, $potPayAccount, $prizeFundPayAccount,
                    $lottoPayAccount, $sumFromPot, $sumFromCompanyAccount) {
                    $transfer->run($potPayAccount, $prizeFundPayAccount,
                        $sumFromPot, 'Prize Fund Top Up');
                    $transfer->run($lottoPayAccount, $prizeFundPayAccount,
                        $sumFromCompanyAccount, 'Prize Fund Top Up');
                });
            }
            $sumFromPot = $sumToPay - $prizeFundPayAccount->balance;
            $transfer->run($potPayAccount, $prizeFundPayAccount, $sumFromPot, 'Prize Fund Top Up');
            return;
        }
        return;
    }

    public function pay (Draw $draw) {
        $prizeFundPayAccount = PayAccount::where('draw_type_id', $draw->type_id)
            ->where('description', 'Prize fund')->first();
        $potPayAccount = PayAccount::where('draw_type_id', $draw->type_id)
            ->where('description', 'Pot')->first();
        $winnerTicketIds = Ticket::where('draw_id', $draw->id)->where('is_winner', true)->pluck('id')->toArray();
        $transfer = new Transfer();
        foreach ($winnerTicketIds as $id) {
            $ticket = Ticket::find($id);
            $user = $ticket->user()->first();
            $userPayAccount = PayAccount::where('user_id', $user->id)->first();
            $amount = $ticket->winning_sum;
            $transfer->run($prizeFundPayAccount, $userPayAccount, $amount, 'Prize Payment');
        }
        var_dump($prizeFundPayAccount->balance);
        $transfer->run($prizeFundPayAccount, $potPayAccount,
            $prizeFundPayAccount->balance, 'Pot Top Up');
    }

    public function newDraw (DrawType $drawType) {
        $generator = new NumberGenerator();
        $draw = Draw::create([
            'type_id' => $drawType->id,
            'values' => json_encode($generator->run($drawType->id, $drawType->min_of_values)),
            'is_played' => false
        ]);
    }

    public function play (string $type) {

        $draw_type = DrawType::where('type', $type)->first();
        $draw = Draw::where([
            ['type_id', $draw_type->id],
            ['is_played', '0']
        ])->first();

        $this->closeActiveDraw($draw);
        $this->fillNumbers($draw_type, $draw);
        $sumToPay = $this->updateTickets($draw);
        if ($sumToPay > 0) {
            $this->collectSum($draw, $sumToPay);
            $this->pay($draw);
        }
        $this->newDraw($draw_type);

    }
}
