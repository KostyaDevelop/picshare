<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'login',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @param string $userEmail
     * @return int
     */
    protected static function getUserID(string $userEmail): int
    {
        $userID = self::where('email', $userEmail)
            ->first()
            ->id;

        return $userID;
    }

    /**
     * @param int $userID
     * @return string
     */
    protected static function getLogin(int $userID) : string
    {
        $login = self::where('id', $userID)
            ->first()
            ->login;

        return $login;
    }

    /**
     * @param int $userID
     * @return string
     */
    protected static function getEmail(int $userID) : string
    {
        $email = self::where('id', $userID)
            ->first()
            ->email;

        return $email;
    }

    /**
     * @param int $userID
     * @return string
     */
    public static function getName(int $userID): string
    {
        $name = self::where('id', $userID)
            ->first()
            ->name;

        return $name;
    }


    /**
     * @return string
     */
    public static function getPeople(): string
    {
        $people = self::get([
            'id AS userID',
            'login AS userLogin']
        );

        foreach ($people as $man){
            $userID = $man->userID;
            $userAvatar =  Avatar::where('user_id', $userID)
                ->pluck('avatar')
                ->first();
            $man->userAvatar = $userAvatar;
        }

        return $people;
    }

    /**
     * @param int $userID
     * @return string
     */
    public static function  getUserToken(int $userID): string
    {
        $apiToken = self::where('id', $userID)
            ->pluck('api_token')
            ->first();

        return $apiToken;
    }

    public function getAvatar(): HasOne
    {
        return $this->hasOne(Avatar::class);
    }

    public function getPhotos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
}
