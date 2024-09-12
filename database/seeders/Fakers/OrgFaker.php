<?php

namespace Database\Seeders\Fakers;

use Database\Seeders\BaseFaker;
use Illuminate\Support\Facades\DB;

class OrgFaker extends BaseFaker
{
    public function create(int $count)
    {
        $items = [];

        for ($i = 0; $i < $count; $i++) {
            $items[] = [
                'name' => static::faker()->company
            ];
        }

        DB::table('orgs')->insert($items);

        return $items;
    }
}
