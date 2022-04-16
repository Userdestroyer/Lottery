<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draw extends Model
{
    use HasFactory;

    public function draw_type() {
        return $this->belongsTo(DrawType::class, 'type_id', 'id');
    }

    public function tickets() {
        return $this->hasMany(Ticket::class, 'draw_id','id');
    }

    public function prizeChart()
    {
        return $this->hasOne(PrizeChart::class, 'draw_type_id', 'type_id');
    }

    protected $fillable = [
        'type_id',
        'values',
        'is_played',
    ];
}
