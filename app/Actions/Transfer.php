<?php

namespace App\Actions;
use App\Exceptions\NegativeAmountException;
use App\Exceptions\NotEnoughMoneyException;
use App\Exceptions\TransferSameIdException;
use App\Models\PayAccount;
use App\Models\Transaction;
use http\Exception;

class Transfer {

    public function run(int $sender_id,int $receiver_id,int $amount,string $message) {
        // VALIDATION
        if ($sender_id == $receiver_id) {
            throw new TransferSameIdException('Same Id for sender and receiver');
        } else if ($amount < 0) {
            throw new NegativeAmountException('Transfer amount cannot be negative');
        }
        //FETCHING
        $sender = PayAccount::findOrFail($sender_id);
        $receiver = PayAccount::findOrFail($receiver_id);

        \DB::transaction(function () use ($sender_id, $receiver_id, $amount, $message){
            $sender = PayAccount::findOrFail($sender_id);
            $receiver = PayAccount::findOrFail($receiver_id);
            if ($sender->balance < $amount) {
                throw new NotEnoughMoneyException('Not enough money on sender balance');
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
