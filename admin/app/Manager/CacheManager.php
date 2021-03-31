<?php

namespace App\Manager;
use App\Constants\Constant;
use Illuminate\Support\Facades\Cache;

class CacheManager
{
    /**
     * Get
     * @param $name
     */
    public static function get($name){
        return Cache::get($name);
    }

    /**
     * Put
     * @param $name
     * @param $data
     */
    public static function put($name,$data){
        Cache::put($name,$data, now()->addMinutes(60));
    }

    /**
     * Delete
     * @param $name
     */
    public static function delete($name){
        Cache::forget($name);
    }

    /**
     * clear model cache
     * @param $name
     */
    public function clear($name){
        \Artisan::call('modelCache:clear', ['--model' => $name]);
    }

    /**
     * Delete
     * @param $name
     */
    public static function has($name){
        if (Cache::has($name)) {
            return true;
        }else{
            return false;
        }
    }


}
