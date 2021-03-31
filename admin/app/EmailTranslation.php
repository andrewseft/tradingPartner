<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class EmailTranslation extends Model
{
    use Cachable;
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes
}
