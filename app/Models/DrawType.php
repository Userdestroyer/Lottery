<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrawType extends Model
{
    use HasFactory;

    public function draws(){
        return $this->hasMany(Draw::class, 'type_id','id');
    }

    protected $fillable = [
        'type',
        'name',
        'volume',
        'min_of_values',
        'max_of_values',
        'image',
        'description',
    ];
}
