<?php

namespace App\Helper;

use App\Models\Operation;
use Illuminate\Support\Collection as BaseCollection;

class OperationHelper
{
    public static function getOrgIdsFromCollection(BaseCollection $operations): BaseCollection
    {
        $orgIds = collect();

        /** @var Operation $operation */
        foreach ($operations as $operation) {
            $orgIds->push($operation->seller_id);
            $orgIds->push($operation->buyer_id);
        }

        $orgIds->unique();

        return $orgIds;
    }
}
