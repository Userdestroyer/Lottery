<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrizeChart extends Model
{
    use HasFactory;

    public function drawType() {
        return $this->belongsTo(DrawType::class);
    }

    public function draw() {
        return $this->belongsTo(Draw::class);
    }

    protected $fillable = [
        'draw_type_id',
        'winner_after',
        '1_match_level',
        '2_match_level',
        '3_match_level',
        '4_match_level',
        '5_match_level',
        '6_match_level',
        '7_match_level',
        '8_match_level',
        '9_match_level',
        '10_match_level'
    ];
}
