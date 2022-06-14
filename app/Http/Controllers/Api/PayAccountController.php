<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayAccount;

class PayAccountController extends Controller
{
    public function payAccountInfo (){
        $payAccount = PayAccount::select('description','balance')
        ->where('user_id',  auth()->user()->id)->get();
        return response($payAccount, 200);
    }
}
