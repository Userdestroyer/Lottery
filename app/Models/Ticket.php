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

    public function draw() {
        return $this->belongsTo(Draw::class);
    }

    protected $fillable = [
        'ticket_draw_type_id',
        'ticket_draw_id',
        'ticket_number',
        'ticket_values',
        'ticket_price',
        'ticket_is_winner',
        'ticket_winning_sum',
        'ticket_user_id',
    ];
}
