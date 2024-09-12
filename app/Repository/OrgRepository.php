<?php

namespace App\Repository;

use App\Models\Org;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class OrgRepository
{
    public function query(): Builder
    {
        return Org::query();
    }

    public function getByIds(array $ids): Collection
    {
        return Org::query()->whereIn('id', $ids)->get();
    }
}
