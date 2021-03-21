<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class Subscription extends Model
{
    use Sortable,Cachable;
    protected $fillable = [ 'id', 'status','is_move','name','pl_amount','pl_percentage','changes' ];
    public $sortable  = ['id', 'status', 'created_at', 'updated_at','amount','name','pl_amount','pl_percentage','changes'];
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

    /**
     * paln to log
     */
    public function planStatus() {
        
        return $this->hasOne(PlanLog::class, 'plan_id');
    }

    /**
     * paln to log
     */
    public function redeemAmount() {
        
        return $this->hasOne(SetRedeemAmount::class, 'plan_id','plan_id');
    }
}
