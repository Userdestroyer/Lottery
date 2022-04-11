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
        'draw_type',
        'draw_type_name',
        'draw_type_volume',
        'draw_type_min_of_values',
        'draw_type_max_of_values',
        'draw_type_image',
        'draw_type_description',
    ];
}
