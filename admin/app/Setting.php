<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Constants\Constant;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
class Setting extends Model
{
    use Cachable;
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes



}
