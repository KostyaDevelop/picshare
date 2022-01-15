<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Subscriber;
use App\Models\User;
use App\Services\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function userLogin(Request $request): JsonResponse
    {
       $credentials['email'] = $request['email'];
       $credentials['password'] = $request['password'];

        if (Auth::attempt($credentials)) {

            $userEmail = $request['email'];
            $userID = (integer)(User::getUserID($userEmail));
            $user['userID'] = $userID;
            $user['userToken'] = User::getUserToken($userID);

            return response()->json($user, 200);
        }

        return response()->json('Данные не верные - попробуйте еще раз', 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function userReg(Request $request): JsonResponse
    {
        $saveUser = User::сreate([
            'login' => $request['login'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'api_token' => Str::random(60)
        ]);

        return Status::successOrFailResp($saveUser);
    }

    /**
     * @param int $userID
     * @return JsonResponse
     */
    public function getUserInfo(int $userID): JsonResponse
    {
        $user = User::find($userID);

        if(!$user)
            return response()->json('Пользователь не найден', 200);

        $avatar = $user->getAvatar()->first();
        $avatar ? $userAvatarPath = $avatar->getAttribute('avatar') : $userAvatarPath = null;

        $userName = $user->getAttribute('name');
        $userLogin = $user->getAttribute('login');
        $userPhotoCount = $user->getPhotos()->count();
        $userCountPhotosLike = Photo::getUserAllLikeCount($userID);
        $userSubscribers = Subscriber::getUserSubscribers($userID);
        $userSubscriptions = Subscriber::getUserSubscriptions($userID);

        $userInfo['userName'] = $userName;
        $userInfo['userLogin'] = $userLogin;
        $userInfo['userAvatarPath'] = $userAvatarPath;
        $userInfo['userPostsCount'] = $userPhotoCount;
        $userInfo['userLikesCount'] = $userCountPhotosLike;
        $userInfo['userSubscribersCount'] = count($userSubscribers);
        $userInfo['userSubscriptionsCount'] = count($userSubscriptions);

        return response()->json($userInfo, 200);
    }

    /**
     * @return JsonResponse
     */
    public function getPeople(): JsonResponse
    {
        $people = User::getPeople();

        return response()->json($people, 200);
    }

    /**
     * @param int $userID
     * @return JsonResponse
     */
    public function getUserInfoForSettings(int $userID): JsonResponse
    {
        $userInfo = [];

        $userInfo['userLogin'] = User::getLogin($userID);
        $userInfo['userName'] = User::getName($userID);
        $userInfo['userEmail'] = User::getEmail($userID);

        return response()->json($userInfo, 200);
    }
}

