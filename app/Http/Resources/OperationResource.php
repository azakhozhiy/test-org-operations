<?php

namespace App\Http\Resources;

use App\Models\Operation;

class OperationResource
{
    public function __construct(protected Operation $operation)
    {

    }

    public function build(): array
    {
        return [
            'id' => $this->operation->getKey(),
            'amount' => $this->operation->amount,
            'seller' => [
                'id' => $this->operation->seller->getKey(),
                'name' => $this->operation->seller->name,
            ],
            'buyer' => [
                'id' => $this->operation->buyer->getKey(),
                'name' => $this->operation->buyer->name
            ]
        ];
    }
}
