<?php

namespace Database\Seeders\Fakers;

use Database\Seeders\BaseFaker;
use Decimal\Decimal;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OperationFaker extends BaseFaker
{
    public function createForOrganisations(Collection $orgIds, int $count = 10000): void
    {
        $items = [];

        for ($i = 0; $i < $count; $i++) {
            /** @var Collection $randomOrgIds */
            $randomOrgIds = $orgIds->random(2);

            $items[] = [
                'amount' => (new Decimal(static::faker()->randomNumber(4)))->toString(),
                'buyer_id' => $randomOrgIds[0],
                'seller_id' => $randomOrgIds[1],
            ];
        }

        DB::table('operations')->insert($items);
    }
}
