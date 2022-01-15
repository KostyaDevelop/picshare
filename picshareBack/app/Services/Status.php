<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use phpDocumentor\Reflection\Types\Mixed_;
use Illuminate\Http\JsonResponse;

class Status
{
    public static $SUCCESS = 'SUCCESS';
    public static $FAIL = 'FAIL';

    /**
     * @param object $status
     * @return string
     */
    public static function successOrFail(object $status): string
    {
        if ($status)
            return self::$SUCCESS;
        else
            return self::$FAIL;
    }

    /**
     * @param string $status
     * @return JsonResponse
     */
    public static function successOrFailResp(string $status = ''): JsonResponse
    {
        if ($status)
            return response()->json(self::$SUCCESS, 200);
        else
            return response()->json(self::$FAIL, 500);
    }
}
