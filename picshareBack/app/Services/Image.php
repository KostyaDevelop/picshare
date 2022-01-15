<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Image
{
    const PHOTO_PATH = 'images';

    /**
     * @param Request $request
     * @return string
     */
    public static function imageToStorage(Request $request): string
    {
        $img = (head($request->file()));
        $remoteImgName = $img->store(self::PHOTO_PATH, 's3');
        $imgURL = Storage::disk('s3')
            ->url($remoteImgName);

        return $imgURL;
    }

    /**
     * @param $imagePath
     * @return string
     */
    public static function imageDeleteFromStore($imagePath)
    {
        $imageStatusDel = Storage::disk('s3')
            ->delete(self::PHOTO_PATH, $imagePath);
    }
}
