<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DrawTypeResource;
use Illuminate\Http\Request;
use App\Models\DrawType;

class DrawTypeController extends Controller
{
    public function listAll () {
        return DrawTypeResource::collection(DrawType::all());
    }
}
