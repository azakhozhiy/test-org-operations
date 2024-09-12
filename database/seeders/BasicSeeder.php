<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Org;
use App\Models\User;
use Database\Seeders\Fakers\OperationFaker;
use Database\Seeders\Fakers\OrgFaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class BasicSeeder extends Seeder
{
    public function __construct(protected OrgFaker $orgFaker, protected OperationFaker $operationFaker)
    {

    }

    /**
     * @throws Throwable
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();

            $this->orgFaker->create(100);
            $orgIds = Org::query()->orderBy('id', 'desc')->get()->pluck('id');

            $this->operationFaker->createForOrganisations($orgIds);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
