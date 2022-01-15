<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_id',
        'com_text',
        'user_id'
    ];

    /**
     * @param int $photoID
     * @param string $photoCom
     * @param int $userID
     * @return object
     */
    protected static function setPhotoComment(int $photoID, string  $photoCom, int $userID): ?object
    {
        $photoComStatus = self::create([
            'photo_id' => $photoID,
            'user_id' => $userID,
            'com_text' => $photoCom
            ]);

        return $photoComStatus;
    }

    /**
     * @param int $photoID
     * @return array
     */
    protected static function  getPhotoComment(int $photoID): array
    {
        $photoComsRaw = self::where('photo_id', $photoID)
            ->pluck('com_text');

        $photoComs = [];
        $i = 0;

        if (count($photoComsRaw) > 0 ){
            foreach ($photoComsRaw as $photoCom){
                $data[$i]['photoComText'] =  $photoCom;

                $userIdCom = self::where('com_text', $photoCom)
                    ->pluck('user_id');

                $data[$i]['photoUserLogin'] = User::where('id', $userIdCom)
                    ->pluck('login')->first();
                $data[$i]['photoUserAvatar'] = Avatar::where('user_id', $userIdCom)
                    ->pluck('avatar')->first();
                $i++;
            }

        }
        return $photoComs;
    }
}
