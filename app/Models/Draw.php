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
        return $this->hasMany(Ticket::class, 'draw_id','id');
    }

    protected $fillable = [
        'type_id',
        'values',
        'received',
        'paid',
        'is_played',
    ];
}
