<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function payees()
    {
        return $this->belongsTo(User::class, 'payee_id', 'id');
    }

    public function payers()
    {
        return $this->belongsTo(User::class, 'payer_id', 'id');
    }
}
