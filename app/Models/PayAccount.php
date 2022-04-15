<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayAccount extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function draw() {
        return $this->belongsTo(Draw::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    protected $fillable = [
        'user_id',
        'draw_type_id',
        'company_id',
        'description',
        'balance',
    ];
}
