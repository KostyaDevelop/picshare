<?php

namespace App\Models;

use http\Env\Response;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'like_id',
        'photo_id',
        'user_id'
    ];

    /**
     * @param int $photoID
     * @return mixed
     */
    public static function getPhotoLikeCount(int $photoID)
    {
        $photoLikeCount = self::where('likes.photo_id',  $photoID)
            ->leftJoin('photos','photos.photo_id','=','likes.photo_id')
            ->get();

        if (count($photoLikeCount) === 0){
            $photoLikeCount = 0;
        } else {
            $photoLikeCount = count($photoLikeCount);
        }

        return $photoLikeCount;
    }

    /**
     * @param int $photoID
     * @return mixed
     */
    public static function getUserAllLikeCount(int $userID): int
    {
        $photoLikeCount = self::where('user_id',  $userID)
            ->get();

        if (count($photoLikeCount) === 0){
            $photoLikeCount = 0;
        } else {
            $photoLikeCount = count($photoLikeCount);
        }

        return $photoLikeCount;
    }

    /**
     * @param int $photoID
     */
    public static function setOrDelPhotoLike(int $photoID, int $userLogID)
    {
        $userLikeID = self::where('photo_id', $photoID)
            ->pluck('user_id')
            ->first();

        $photoLikeCount = self::getPhotoLikeCount($photoID);
        $likeStatus = '';

        if ($userLikeID === $userLogID){
            self::where([
                    ['user_id', '=', $userLikeID],
                    ['photo_id', '=', $photoID]
                ])->delete();
            return $likeStatus = 'del';
        } else {
            self::create([
                    'user_id' => $userLogID,
                    'photo_id' => $photoID
                ]);
            return $likeStatus = 'add';
        }
    }
}
