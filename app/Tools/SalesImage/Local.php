<?php

namespace App\Tools\SalesImage;

use App\Sale;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class Local
{
    protected $disk = "sales_image";


    public function sayHello()
    {
        echo "Hello World";
    }

    public function disk($disk){
        $this->disk = $disk;
        return $this;
    }

    public function upload($file, Sale $sale = null)
    {
        if ($sale){
            $path = "{$sale->token}";
        }else{
            $path = "/";
        }
        $full_path = Storage::disk($this->disk)->putFile($path."/full", $file);
        $this->createThumb($full_path, 1024, 1024);

        $preview_path = Storage::disk($this->disk)->putFile($path."/preview", $file);
        $this->createThumb($preview_path, 320, 320);

        return [
            'full' => $full_path,
            'preview' => $preview_path
        ];
    }

    function getURL($token)
    {
        return Storage::disk($this->disk)->url($token);
    }

    public function createThumb($filePath, $width, $height){
        $fullPath = Storage::disk($this->disk)->path($filePath);
        $image = Image::make($fullPath);
        $image->resize($width, $height, function($constraint){
            $constraint->aspectRatio();
        })->save($fullPath);
    }
}
