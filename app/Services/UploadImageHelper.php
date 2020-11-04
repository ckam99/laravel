<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;


class UploadImageHelper
{
    public static function save(string $image, string $ext = 'jpg')
    {
        $manager = new ImageManager(['driver', 'gd' /* imagick*/]);
        $manager->make($image)
            ->save(storage_path() . '/app/public/' . uniqid() . "." . $ext);
    }


    public static function uploadMultiple(string $filename)
    {
        $images = request()->file($filename);
        $group = 'thumbails/' . Str::random(8);
        $position  = 0;
        foreach ($images as $image) {
            self::upload($image, $group, $position);
            $position++;
        }
    }

    public static function upload($image, string $folder, int $position = 0)
    {
        $extensions = ['webp', 'jpg', 'png'];
        $ext = $image->getClientOriginalExtension();
        if (in_array($ext, $extensions)) {
            $name = Str::random(8) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/' . $folder . '/', $name);
            $image = new Image();
            $image->url = $name;
            $image->position = $position;
            $image->is_main = $position === 0;
            $image->save();
            $position += 1;
        } else {
            return ['error' => 'invalid file format'];
        }
    }
}
