<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class ReferralUse extends Model
{
    use Sortable,Cachable;
    protected $fillable = [ 'id', 'status' ];
    public $sortable  = ['id', 'status', 'created_at', 'updated_at'];
    protected  $primaryKey = 'id';
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes
    private $language;

    /**
     * user
     */
    public function user() {
        return $this->hasOne(User::class, 'id','from_user');
    }

    /**
     * user
     */
    public function from() {
        return $this->hasOne(User::class, 'id','to_user');
    }
}
