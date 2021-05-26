<?php

namespace App\Http\Controllers;

use App\Models\User;

class TransactionController extends Controller
{
    public function test(User $payee)
    {
        return $payee;
    }
}
