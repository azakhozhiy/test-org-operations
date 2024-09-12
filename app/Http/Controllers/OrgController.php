<?php

namespace App\Http\Controllers;

use App\Helper\RequestHelper;
use App\Services\OrgService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrgController extends Controller
{
    public function __construct(protected OrgService $orgService)
    {

    }

    public function getList(Request $request): JsonResponse
    {
        $perPage = RequestHelper::getPerPage($request);
        $organisations = $this->orgService->getList($perPage);

        return response()->json($organisations);
    }

    public function getStats(Request $request): JsonResponse
    {
        $stats = $this->orgService->getStats($request);

        return response()->json($stats);
    }
}
