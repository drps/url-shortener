<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImgViewer
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function random():string
    {
        $images = Storage::allFiles($this->path);
        return $images[array_rand($images)];
    }
}
