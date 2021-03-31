<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class Country extends Model
{
    use Sortable,Cachable;
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes
    public $sortable  = ['id', 'status', 'created_at', 'updated_at','phonecode'];
    protected $fillable = [ 'id', 'status'];
}
