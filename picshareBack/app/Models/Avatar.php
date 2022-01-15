<?php

namespace App\Models;

use App\Services\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Avatar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar'
    ];

    /**
     * @param int $userID
     * @return object
     */
    public static function getAvatar(int $userID)
    {
        $avatar = self::where('user_id', $userID)
            ->pluck('avatar');

        return $avatar;
    }


    /**
     * @param int $userID
     * @return string
     */
    public static function deleteAvatar(int $userID): string
    {
        $avatarStatus =  self::where('user_id', $userID)
            ->delete();

        return Status::successOrFail($avatarStatus);
    }


    /**
     * @param int $userID
     * @param string $avatarPath
     * @return string
     */
    public static function avatarRefresh(int $userID, string $avatarPath): string
    {
        try{
            DB::beginTransaction();

            self::where('user_id', $userID)
                ->delete();

            self::create([
                'user_id' => $userID,
                'avatar' => $avatarPath
            ]);

            DB::commit();

            return Status::$SUCCESS;

        } catch(\Exception $exception){

            DB::rollBack();

            return Status::$FAIL;
        }

    }

    /**
     * @param int $userID
     * @param string $avatarPath
     * @return string
     */
    public static function avatarSet(int $userID, string $avatarPath): string
    {
        $avatarStatus = self::create([
            'user_id' => $userID,
            'avatar' => $avatarPath
        ]);

        return Status::successOrFail($avatarStatus);
    }
}
