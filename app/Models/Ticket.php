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
        'type_id',
        'draw_id',
        'number',
        'values',
        'price',
        'is_winner',
        'matches',
        'number_of_matches',
        'winning_sum',
        'user_id',
    ];
}
