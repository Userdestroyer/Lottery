<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function transaction () {
        return $this->belongsTo(Transaction::class);
    }

    public function payAccount () {
        return $this->belongsTo(PayAccount::class);
    }


    protected $fillable = [
        'transaction_id',
        'pay_account_id',
        'balance_before',
        'amount',
        'balance_after'
    ];


}
