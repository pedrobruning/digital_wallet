<?php


namespace App\Repositories;


use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionRepository extends BaseRepository
{
    public function __construct(Transaction $transaction)
    {
        parent::__construct($transaction);
    }

    public function makeTransaction($attributes)
    {
        return DB::transaction(function() use ($attributes){
            $transaction = $this->save($attributes);
            $transaction->payee->deposit($attributes['value']);
            $transaction->payer->withdraw($attributes['value']);
            return $transaction;
        });
    }
}
