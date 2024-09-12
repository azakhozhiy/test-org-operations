<?php

namespace App\Http\Controllers;

use App\Helper\OperationHelper;
use App\Helper\RequestHelper;
use App\Http\Resources\OperationsResource;
use App\Repository\OrgRepository;
use App\Services\OperationService;
use App\Services\OrgService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function __construct(
        protected OperationService $operationService,
        protected OrgService       $orgService,
        protected OrgRepository    $orgRepository
    )
    {

    }

    public function getList(Request $request): JsonResponse
    {
        $perPage = RequestHelper::getPerPage($request);

        $operations = $this->operationService->getList($perPage);
        $orgIds = OperationHelper::getOrgIdsFromCollection($operations->getCollection());
        $organisations = $this->orgRepository->getByIds($orgIds->toArray());

        return response()->json((new OperationsResource($operations, $organisations))->build());
    }
}
