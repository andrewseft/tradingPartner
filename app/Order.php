<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;
use Carbon\Carbon;

class Order extends Model
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
        return $this->hasOne(Plan::class, 'id','plan_id');
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
    public function redeemAmount() {
        
        return $this->hasOne(SetRedeemAmount::class, 'plan_id','plan_id');
    }

    /**
     * order to wallet
     */
    public function wallet() {
        return $this->hasOne(wallet::class, 'user_id','user_id')->orderBy('id','desc');
    }

     /**
     * order to planlogs
     */
    public function planlogs() {
        return $this->hasOne(PlanLog::class, 'plan_id','plan_id')->where('created_at', '>=', Carbon::now());
    }

    /**
     * order to planlogs
     */
    public function subscriptionHolding() {
        return $this->hasOne(SubscriptionHolding::class, 'plan_id','plan_id');
    }

    /**
     * order to planlogs
     */
    public function statement() {
        return $this->hasOne(SubscriptionHolding::class, 'plan_id','plan_id');
    }
}
