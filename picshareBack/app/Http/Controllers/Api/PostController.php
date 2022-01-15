<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * @param $userID
     * @return JsonResponse
     */
    public function getUserPosts($userID): JsonResponse
    {
        $posts = Photo::getFriendsPhotos($userID);

        return response()->json($posts, 200);
    }
}
