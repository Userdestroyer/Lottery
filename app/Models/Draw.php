<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    use HasFactory;

    public function draw_type() {
        return $this->belongsTo(DrawType::class);
    }

    public function tickets() {
        return $this->hasMany('App\Ticket', 'ticket_draw_id','draw_id');
    }

    protected $fillable = [
        'draw_type_id',
        'draw_values',
        'draw_pot',
        'draw_played',
    ];
}
