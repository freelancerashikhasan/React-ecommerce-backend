<?php

namespace App\Helpers\Traits;
use Intervention\Image\Facades\Image;

trait ImageTrait{
    public function img($file, $path){
        $fileSize = ($file->getSize() / 1024); // convert bytes to kilobytes, 1 KB = 1024 bytes

        switch (true) {
            case ($fileSize >= (0) && $fileSize < (1 * 1024)):
                $quality = 80;
                break;
            case ($fileSize >= (1 * 1024) && $fileSize < (2 * 1024)):
                $quality = 80;
                break;
            case ($fileSize >= (2 * 1024) && $fileSize < (3 * 1024)):
                $quality = 50;
                break;
            case ($fileSize >= (3 * 1024) && $fileSize < (4 * 1024)):
                $quality = 30;
                break;
            case ($fileSize >= (4 * 1024) && $fileSize < (5 * 1024)):
                $quality = 15;
                break;
            case ($fileSize >= (5 * 1024) && $fileSize < (6 * 1024)):
                $quality = 12;
                break;
            case ($fileSize >= (6 * 1024) && $fileSize < (7 * 1024)):
                $quality = 10;
                break;
            case ($fileSize >= (7 * 1024) && $fileSize < (8 * 1024)):
                $quality = 8;
                break;
            case ($fileSize >= (8 * 1024) && $fileSize < (9 * 1024)):
                $quality = 6;
                break;
            case ($fileSize >= (9 * 1024) && $fileSize < (10 * 1024)):
                $quality = 5;
                break;
            default:
                $quality = 3;
                break;
        }

        $image = Image::make($file)->save(public_path($path), $quality);
        if($image == true){
            return true;
        }
        else{
            return false;
        }

    }
}
