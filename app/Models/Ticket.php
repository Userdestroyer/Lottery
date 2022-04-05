<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'ticket_type',
        'ticket_draw_number',
        'ticket_values',
        'ticket_is_winner',
        'ticket_winning_sum',
    ];
}
