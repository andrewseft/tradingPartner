<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class CategoryTranslation extends Model
{
    use Cachable;
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }
}
