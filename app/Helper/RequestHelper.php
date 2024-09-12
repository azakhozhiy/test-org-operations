<?php

namespace App\Helper;

use Illuminate\Http\Request;

class RequestHelper
{
    public static function getPerPage(Request $request, int $max = 5000): int
    {
        $perPage = (int)$request->get('per_page', 25);
        if ($perPage < 25) {
            $perPage = 25;
        }

        if ($perPage > $max) {
            $perPage = $max;
        }

        return $perPage;
    }
}
