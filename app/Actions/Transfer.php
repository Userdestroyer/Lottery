<?php

namespace App\Actions;
use App\Models\PayAccount;
use App\Models\Transaction;
use http\Exception;

class Transfer {

    public function run(int $sender_id,int $receiver_id,int $amount,string $message) {
        $sender = PayAccount::findOrFail($sender_id);
        $receiver = PayAccount::findOrFail($receiver_id);
        if ($sender_id == $receiver_id) {
            throw new \Exception();
        } else if ($amount < 0) {
            throw new \Exception();
        }
        \DB::transaction(function () use ($sender_id, $receiver_id, $amount, $message){
            $sender = PayAccount::findOrFail($sender_id);
            $receiver = PayAccount::findOrFail($receiver_id);
            if ($sender->balance < $amount) {
                throw new \Exception();
            }
            $transaction = Transaction::create([
                'hash' => '',
                'message' => $message
            ]);
            $transaction->operation()->create([
                'pay_account_id' => $sender_id,
                'balance_before' => $sender->balance,
                'amount' => $amount,
                'balance_after' => $sender->balance - $amount,
            ]);
            $transaction->operation()->create([
                'pay_account_id' => $receiver_id,
                'balance_before' => $receiver->balance,
                'amount' => $amount,
                'balance_after' => $receiver->balance + $amount,
            ]);
            $sender->balance -= $amount;
            $sender->save();
            $receiver->balance += $amount;
            $receiver->save();

        });
    }
}
