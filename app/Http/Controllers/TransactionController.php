<?php

namespace App\Http\Controllers;

use App\Http\Resources\MakeTransactionResource;
use App\Models\User;
use App\Http\Requests\MakeTransactionRequest;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function makeTransaction(MakeTransactionRequest $request, User $payee)
    {
        $transaction = $this->transactionService->makeTransaction($request->value, $payee->id, auth()->id());
        return new MakeTransactionResource($transaction->payer);
    }
}
