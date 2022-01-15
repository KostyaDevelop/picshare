<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Avatar;
use App\Services\Image;
use App\Services\Status;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class AvatarController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function refreshAvatar(Request $request): JsonResponse
    {
        $userID = $request['userID'];

        $pathPhoto = Image::imageToStorage($request);

        if (!empty(Avatar::getAvatar($userID))){
            Avatar::deleteAvatar($userID);
        }

        $avatarStatus = Avatar::avatarSet($userID, $pathPhoto);

        return  Status::successOrFailResp($avatarStatus);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function setAvatar(Request $request): JsonResponse
    {
        $pathPhoto = Image::imageToStorage($request);
        $userID = $request['userID'];

        $avatarStatus = Avatar::avatarSet($userID, $pathPhoto);

        return  Status::successOrFailResp($avatarStatus);
    }

    /**
     * @param int $userID
     * @return JsonResponse
     */
    public function deleteAvatar(int $userID): JsonResponse
    {
        $imagePath = Avatar::getAvatar($userID);

        Image::imageDeleteFromStore($imagePath);

        $avatarStatus = Avatar::deleteAvatar($userID);

        return  Status::successOrFailResp($avatarStatus);
    }
}

