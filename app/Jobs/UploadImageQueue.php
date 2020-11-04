<?php

namespace App\Jobs;

use App\Services\UploadImageHelper;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadImageQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $image;
    private string $ext;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $image, string $ext = 'jpg')
    {
        $this->image = $image;
        $this->ext = $ext;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // UploadImageHelper::save($this->image, $this->ext);


        // $manager = new ImageManager(['driver', 'gd' /* imagick*/]);
        // $manager->make($this->image)
        //     ->save(storage_path() . '/app/public/' . uniqid() . "." . $this->ext);


        $s3 = Storage::disk('s3');
        $s3->put('videos' . $this->image, 'public');
        // composer require league/flysystem-aws-s3-v3
    }
}
