<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrawType extends Model
{
    use HasFactory;

    public function draws(){
        return $this->hasMany('App\Draw', 'draw_type_id','draw_type_id');
    }

    protected $fillable = [
        'ticket_type',
        'ticket_draw_number',
        'ticket_values',
        'ticket_is_winner',
        'ticket_winning_sum',
    ];
}
