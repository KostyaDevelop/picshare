<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Photo;
use App\Services\Image;
use App\Services\Status;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PhotoController extends Controller
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getUserPhotos(int $userID): JsonResponse
    {
        $userPhotos = [];
        $i = 0;
        $photosUser = Photo::getPhotos($userID);

        if(count($photosUser)){

            foreach ($photosUser as $photoUser) {

                $photoID = Photo::getPhotoId($photoUser['photo_path']);
                $photoComments = Comment::getPhotoComment($photoID);
                $photoLike = Like::getPhotoLikeCount($photoID);
                $photoName = explode(env('DOMEN_NAME') . 'storage/', $photoUser['photo_path']);
                $photoName = array_pop($photoName);

                $userPhotos[$i]['photoID'] = $photoID;
                $userPhotos[$i]['photoComments'] = $photoComments;
                $userPhotos[$i]['photoComCount'] = count($photoComments);
                $userPhotos[$i]['photoName'] = $photoName;
                $userPhotos[$i]['photoPath'] = $photoUser['photo_path'];
                $userPhotos[$i]['photoLike'] = $photoLike;
                $i++;
            }
        }

        return response()->json($userPhotos, 200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getPhotoInfo(int $id): JsonResponse
    {
        $photoPath = Photo::getPhotoPath($id);
        $photoLike = Photo::getPhotoLike($id);
        $photoComment = Comment::getComment($id);

        $photoInfo['photoPath'] = $photoPath;
        $photoInfo['photoComment'] = $photoComment;
        $photoInfo['photoLike'] = $photoLike;

        return response()->json($photoInfo, 200);
    }


    /**
     * @param int $photoID
     * @param string $userLogID
     * @return JsonResponse
     */
    public function setOrDelPhotoLike(int $photoID, string $userLogID): JsonResponse
    {
        $likeStatus = Like::setOrDelPhotoLike($photoID, $userLogID);

        if ($likeStatus === 'del')
            return  response()->json('del', 200);
        if ($likeStatus === 'add')
            return  response()->json('add', 200);

        else return  Status::successOrFailResp();

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function setPhotoComment(Request $request): JsonResponse
    {
        $userID  = $request['userID'];
        $photoID  = $request['photoID'];
        $photoCom  = $request['photoCom'];

        $com = Comment::setPhotoComment($photoID, $photoCom, $userID);

        if ($com)
            return  response()->json('Комментарий успешно добавлен', 200);
        else
            return  response()->json('Ошибка при добавлении комментария', 500);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getPhotoComment(int $id): JsonResponse
    {
        $photoComments = Comment::getPhotoComment($id);

        return response()->json($photoComments, 200);
    }

    /**
     * @param int $photoID
     * @return JsonResponse
     */
    public function photoDelete(int $photoID): JsonResponse
    {
        $photoStatusDel = Photo::photoDelete($photoID);

        return Status::successOrFailResp($photoStatusDel);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addUserPhoto(Request $request): JsonResponse
    {
        $pathPhoto = Image::imageToStorage($request);
        $userID = $request['userID'];

        $photoStatusAdd = Photo::addUserPhoto($userID, $pathPhoto);

        return Status::successOrFailResp($photoStatusAdd);
    }

    /**
     * @param int $userID
     * @return JsonResponse
     */
    public static function getFriendsPhotos(int $userID): JsonResponse
    {
        $friendsPhotos = Photo::getFriendsPhotos($userID);

        return response()->json($friendsPhotos, 200);
    }
}

