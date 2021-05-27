<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MakeTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'message' => 'Transaction made Successfully!',
            'data' => [
                'new_balance' => $this->balance
            ]
        ];
    }
}
