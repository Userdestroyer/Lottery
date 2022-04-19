<?php

namespace App\Actions;
use App\Exceptions\NegativeOrZeroAmountException;
use App\Exceptions\NotEnoughMoneyException;
use App\Exceptions\TransferSameIdException;
use App\Models\PayAccount;
use App\Models\Transaction;
use http\Exception;

class Transfer {

    public function run(PayAccount $sender,PayAccount $receiver,int $amount,string $message) {
        // VALIDATION
        if ($sender->id == $receiver->id) {
            throw new TransferSameIdException('Same Id for sender and receiver');
        } else if ($amount <= 0) {
            throw new NegativeOrZeroAmountException('Transfer amount cannot be zero or negative');
        }

        \DB::transaction(function () use ($sender, $receiver, $amount, $message){
            /*$sender = PayAccount::findOrFail($sender_id);
            $receiver = PayAccount::findOrFail($receiver_id);*/
            if ($sender->balance < $amount) {
                throw new NotEnoughMoneyException('Not enough money on sender balance');
            }
            $transaction = Transaction::create([
                'hash' => '',
                'message' => $message
            ]);
            $transaction->operation()->create([
                'pay_account_id' => $sender->id,
                'balance_before' => $sender->balance,
                'amount' => $amount,
                'balance_after' => $sender->balance - $amount,
            ]);
            $transaction->operation()->create([
                'pay_account_id' => $receiver->id,
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
