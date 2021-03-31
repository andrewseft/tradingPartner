<?php

namespace App\Manager;
use App\Manager\CacheManager;
use App\Module;

class ModuleManager
{
   /**
     * Use Module
     *
     * @var string
     */

    private $module;
    private $cache;

     /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Module $module ,CacheManager $cacheManager)
    {
        $this->module = $module;
        $this->cache = $cacheManager;
    }



    /**
     *  Get Moduledata
     */
    public function get()
    {
        $data = $this->module->get();
        return $data;

    }
}
