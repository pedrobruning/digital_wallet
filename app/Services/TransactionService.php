<?php

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function makeTransaction($value, $payeeId, $payerId)
    {

        $attributes = [
            'payee_id' => $payeeId,
            'payer_id' => $payerId,
            'value' => $value
        ];

        return $this->transactionRepository->makeTransaction($attributes);
    }
}
