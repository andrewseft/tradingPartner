<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class Tag extends Model
{
    use Sortable,Cachable;
    protected $fillable = [ 'id', 'status' ];
    public $sortable  = ['id', 'status', 'created_at', 'updated_at'];
    protected  $primaryKey = 'id';
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes
    private $language;

}
