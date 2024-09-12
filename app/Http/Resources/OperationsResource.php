<?php

namespace App\Http\Resources;

use App\Models\Operation;
use App\Models\Org;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OperationsResource
{
    protected Collection $organisations;

    public function __construct(protected LengthAwarePaginator $operations, Collection $organisations)
    {
        $this->organisations = $organisations->keyBy('id');
    }

    public function build(): array
    {
        $operationsMapped = $this->operations->getCollection()->map(function (Operation $operation) {
            /** @var Org $seller */
            $seller = $this->organisations->get($operation->seller_id);

            /** @var Org $buyer */
            $buyer = $this->organisations->get($operation->buyer_id);

            $operation->setRelation('seller', $seller);
            $operation->setRelation('buyer', $buyer);

            return (new OperationResource($operation))->build();
        });

        $this->operations->setCollection($operationsMapped);

        return $this->operations->toArray();
    }
}
