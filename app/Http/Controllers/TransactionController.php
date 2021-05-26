<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\MakeTransactionRequest;

class TransactionController extends Controller
{
    public function test(MakeTransactionRequest $request, User $payee)
    {
        return $payee;
    }
}
