<?php

namespace App\Services;

use App\Helper\RequestHelper;
use App\Models\Org;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class OrgService
{
    public function getList(int $perPage = 25): LengthAwarePaginator
    {
        return Org::query()
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }

    public function getStats(Request $request): LengthAwarePaginator
    {
        $perPage = RequestHelper::getPerPage($request, 100);
        $minTotalPurchases = $request->input('min_total_purchases');
        $maxTotalPurchases = $request->input('max_total_purchases');
        $minTotalSales = $request->input('min_total_sales');
        $maxTotalSales = $request->input('max_total_sales');
        $orgIds = $request->input('org_ids', []);

        $orderBy = $request->input('order_by', 'total_purchases');
        $orderDirection = $request->input('order_direction', 'desc');

        $validOrderByFields = ['total_purchases', 'total_sales'];
        if (!in_array($orderBy, $validOrderByFields, true)) {
            $orderBy = 'total_purchases';
        }

        $validOrderDirections = ['asc', 'desc'];
        if (!in_array($orderDirection, $validOrderDirections, true)) {
            $orderDirection = 'desc';
        }

        $query = DB::table('orgs as o')
            ->leftJoinSub(
                DB::table('operations')
                    ->select('buyer_id', DB::raw('SUM(amount) as total_purchases'))
                    ->groupBy('buyer_id'),
                'buy',
                'o.id',
                '=',
                'buy.buyer_id'
            )
            ->leftJoinSub(
                DB::table('operations')
                    ->select('seller_id', DB::raw('SUM(amount) as total_sales'))
                    ->groupBy('seller_id'),
                'sell',
                'o.id',
                '=',
                'sell.seller_id'
            )
            ->select(
                'o.id',
                'o.name',
                DB::raw('COALESCE(buy.total_purchases, 0) as total_purchases'),
                DB::raw('COALESCE(sell.total_sales, 0) as total_sales')
            );

        $havingConditions = [];

        if ($minTotalPurchases !== null) {
            $havingConditions[] = 'total_purchases >= ?';
            $query->addBinding($minTotalPurchases, 'having');
        }
        if ($maxTotalPurchases !== null) {
            $havingConditions[] = 'total_purchases <= ?';
            $query->addBinding($maxTotalPurchases, 'having');
        }
        if ($minTotalSales !== null) {
            $havingConditions[] = 'total_sales >= ?';
            $query->addBinding($minTotalSales, 'having');
        }
        if ($maxTotalSales !== null) {
            $havingConditions[] = 'total_sales <= ?';
            $query->addBinding($maxTotalSales, 'having');
        }

        if (!empty($orgIds)) {
            $query->whereIn('o.id', $orgIds);
        }

        if (!empty($havingConditions)) {
            $query->havingRaw(implode(' AND ', $havingConditions));
        }

        $query->orderBy($orderBy, $orderDirection);

        return $query->paginate($perPage);
    }
}
