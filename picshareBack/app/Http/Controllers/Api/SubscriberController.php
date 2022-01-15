<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use App\Services\Status;
use Illuminate\Http\JsonResponse;

class SubscriberController extends Controller
{
    /**
     * @param int $userID
     * @return JsonResponse
     */
    public function getUserSubscribers(int $userID): JsonResponse
    {
        $userSubs = Subscriber::getUserSubscribers($userID);

        return  response()->json($userSubs, 200);
    }

    /**
     * @param int $userID
     * @return JsonResponse
     */
    public function getUserSubscriptions(int $userID): JsonResponse
    {
        $userSubs = Subscriber::getUserSubscriptions($userID);

        return  response()->json($userSubs, 200);
    }

    /**
     * @param int $userID
     * @param int $userSubsID
     * @return JsonResponse
     */
    public function setUserSubs(int $userID, int $userSubsID): JsonResponse
    {
        $userSubStatus = Subscriber::setUserSubs($userID, $userSubsID);

        return Status::successOrFailResp($userSubStatus);
    }
}
