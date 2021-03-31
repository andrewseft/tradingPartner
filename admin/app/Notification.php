<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Constants\Constant;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
class Notification extends Model
{
    use Cachable;
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes

    public function getTitleAttribute($title)
    {
        return ucfirst($title);
    }
}
