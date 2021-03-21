<?php

namespace App\Manager;

use App\Language;
use App\Manager\CacheManager;

class LanguageManager
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Language $language, CacheManager $cacheManager)
    {
        $this->language = $language;
        $this->cache = $cacheManager;
    }

    /**
     * @return Language
     */
    public function language()
    {
        return $this->language;
    }

    /**
     * List of all Language
     * @param $request
     * @param $limit
     */
    function list($request, int $limit) {
        $data = $this->cache->get('language');
        if (empty($data)) {
            $language = $this->language->orderBy('created_at', 'desc');
            $data = $language->paginate($limit);
            $this->cache->put('language', $data);
        }
        return $data;
    }

    /**
     * Get first
     * @param $id
     */
    public function get($id)
    {
        return $this->language->findOrFail($id);
    }

    /**
     * @param $request
     */
    public function create($request)
    {
        $response = $this->is_json($request->description);
        if ($response) {
            $data = $this->language;
            if ($request->id != null) {
                $data = $this->get($request->id);
            }
            $data->name = trim($request->name);
            $data->description = json_encode($request->description);
            $data->code = trim($request->code);
            $url = base_path('resources/lang/' . $request->get('code') . '.json');
            \File::put($url, $request->get('description'));
            $data->save();
            return true;
        } else {
            return false;
        }

    }

    /**
     * check json valid or not
     */
    public function is_json($string, $return_data = false)
    {
        $data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : true) : false;
    }

    /**
     * remove cache
     */
    public function removeCache(){
        $this->cache->delete('language');
    }

}
