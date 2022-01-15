<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'userSubs_id'
    ];

    /**
     * @param int $userID
     * @return array
     */
    public static function getUserSubscriptions(int $userID): array
    {
        $userSubsID = self::where('userSubs_id', $userID)
            ->pluck('user_id');

        if (count($userSubsID) === 0 ){
            $userSubs = [];
        } else {

            $i = 0;

            foreach ($userSubsID as $userSubID){

                $userSubs[$i]['id'] = $userSubID;
                $userSubs[$i]['login'] = User::getLogin($userSubID);
                $userSubs[$i]['avatar'] = Avatar::getAvatar($userSubID)->first();

                $i++;
            }
        }

        return $userSubs;
    }

    /**
     * @param int $userID
     * @return array
     */
    public static function getUserSubscribers(int $userID): array
    {
        $userSubsID = self::where('user_id', $userID)
            ->pluck('userSubs_id');

        if (count($userSubsID) === 0 ){
            $userSubs = [];
        } else {

            $i = 0;

            foreach ($userSubsID as $userSubID){

                $userSubs[$i]['id'] = $userSubID;
                $userSubs[$i]['login'] = User::getLogin($userSubID);
                $userSubs[$i]['avatar'] = Avatar::getAvatar($userSubID)->first();

                $i++;
            }
        }

        return $userSubs;
    }
}
