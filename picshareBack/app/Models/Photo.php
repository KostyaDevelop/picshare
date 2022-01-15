<?php

namespace App\Models;

use App\Services\Image;
use App\Services\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use phpDocumentor\Reflection\Types\Integer;
use Illuminate\Support\Facades\DB;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_id',
        'user_id',
        'photo_path',
        'like_id'
    ];

    /**
     * @param int $photoID
     * @return object
     */
    public static function getPhotos(int $photoID): object
    {
        $photos = self::where('user_id', $photoID)
            ->get();

        return $photos;
    }

    /**
     * @param string $photoPath
     * @return mixed
     */
    public static function getPhotoId(string $photoPath): int
    {
        $photoID = self::where('photo_path', $photoPath)
            ->pluck('photo_id');

        return $photoID[0];
    }

    /**
     * @param int $photoID
     * @return mixed
     */
    public static function getPhotoPath(int $photoID): string
    {
        $photoPath = self::where('photo_id', $photoID)
            ->pluck('photo_path');

        return $photoPath;
    }

    /**
     * @param int $userID
     * @return int|mixed
     */
    public static function getUserAllLikeCount(int $userID): int
    {
        $serAllLikeCount =  Like::getUserAllLikeCount($userID);

        return $serAllLikeCount;
    }

    /**
     * @param int $userID
     * @param string $photoPath
     */
    public static function addUserPhoto(int $userID, string $photoPath): string
    {
        $newPhoto = self::create([
            'user_id' => $userID,
            'photo_path' => $photoPath]
        );

        return Status::successOrFail($newPhoto);
    }

    /**
     * @param int $userID
     * @return array
     */
    public static function getFriendsPhotos(int $userID): array
    {
        $friends = Subscriber::where('user_id', $userID)
            ->pluck('userSubs_id')->toArray();

        $friendsPhotos = self::select('photo_id', 'photo_path', 'created_at')
            ->whereIn('user_id',  $friends)
            ->get()
            ->toArray();

        ksort($friendsPhotos);

        return $friendsPhotos;
    }

    public static function getPhotoDateCreate(int $photoID): object
    {
        $photoDate = self::select('created_at')
            ->whereIn('photo_id',  $photoID)
            ->get();

        return $photoDate;
    }

    protected static function photoDelete(int $photoID): string
    {
        try{
            DB::beginTransaction();

            Image::imageDeleteFromStore($photoID);

            Photo::where('photo_id', $photoID)
                ->delete();

            Like::where('photo_id', $photoID)
                ->delete();

            Comment::where('photo_id', $photoID)
                ->delete();

            DB::commit();

            return Status::$SUCCESS;

        } catch(\Exception $exception){

            DB::rollBack();

            return Status::$FAIL;
        }
    }
}
