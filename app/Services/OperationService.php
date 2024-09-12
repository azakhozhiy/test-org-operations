<?php

namespace App\Services;

use App\Models\Operation;
use App\Models\Org;
use Illuminate\Pagination\LengthAwarePaginator;

class OperationService
{
    public function __construct(){

    }

    public function getList(int $perPage): LengthAwarePaginator
    {
        return Operation::query()
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }
}
