<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile (){
        return response(User::find(auth()->user()->id), 200);
    }

    public function paymentHistory (){

    }
}
