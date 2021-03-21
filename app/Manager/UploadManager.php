<?php

namespace App\Manager;

use App\Constants\Constant;
use Illuminate\Support\Facades\Storage;
use Image;

class UploadManager
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->path = Constant::IMAGE_PATH;
        $this->storage = Storage::disk(Constant::DISK);

    }

    /**
     * Image upload
     *
     * @param $image
     * @param $old_image
     * @param $path
     * @param $path_thum
     * @param $height
     * @param $widh
     * @param $resize
     *
     */
    public function image($image, $old_image, $path, $path_thum, $height, $widh, $resize)
    {
        $name = \Str::uuid() .'.'. $image->getClientOriginalExtension();
        $this->storage->put($path.$name, file_get_contents($image));
        if ($resize) {
            /**
             * Move Thum Image
             */
            $url = $this->storage->url($path.$name);
            $thumbnailImage = Image::make($url);
            $thumbnailImage->resize($height, $widh)->encode('png',80);
            $this->storage->put($path_thum.$name,$thumbnailImage);
        }
        /**
         * Image Delete
         */
        if ($old_image != null) {
            $this->storage->delete([$path.$old_image,$path_thum.$old_image]);
        }
        return $name;
    }

    /**
     * @param $oldPath
     * @param $newPath
     */
    public function copy($oldPath,$newPath){
        $this->storage->copy($oldPath, $newPath);
    }
    
    /**
     * Delete folder
     * 
     * @param $name
     */
    public function removeFolder($name){
        $this->storage->deleteDirectory($name);
    }
}
