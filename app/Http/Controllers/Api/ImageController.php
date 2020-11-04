<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\UploadImageQueue;
use App\Http\Controllers\Controller;
use App\Services\UploadImageHelper;
use Intervention\Image\ImageManager;

use function PHPUnit\Framework\directoryExists;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'max:2000|mimes:png,jpeg,jpg,webp'
        ]);
        if ($request->hasFile('images')) {
            $otp = [];
            foreach ($request->file('images') as $image) {
                $ext = $image->getClientOriginalExtension();
                $this->dispatch(new UploadImageQueue($image->getRealPath(), $ext));
            }
            return $otp;

            return ['message' => 'Images successfully uploaded'];
        } else {
            return response(['error' => 'Only images files allowed'], 422);
        }
    }
}
