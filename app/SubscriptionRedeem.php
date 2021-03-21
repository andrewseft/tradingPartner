<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class SubscriptionRedeem extends Model
{
    use Sortable,Cachable;
    protected $fillable = [ 'id', 'status','is_move' ];
    public $sortable  = ['id', 'status', 'created_at', 'updated_at'];
    protected  $primaryKey = 'id';
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes
    private $language;


     /**
     * order to plan
     */
    public function plan() {
        return $this->hasOne(Plan::class, 'id','plan_id')->with('planStatus');
    }

    /**
     * order to User
     */
    public function user() {
        return $this->hasOne(User::class,'id','user_id');
    }
}
