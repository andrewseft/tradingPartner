<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class Plan extends Model
{
    use Sortable,Cachable;
    protected $fillable = [ 'id', 'status'];
    public $sortable  = ['id', 'status', 'created_at', 'updated_at','name','amount'];
    protected  $primaryKey = 'id';
    protected $cacheCooldownSeconds = Constant::REDIS_CACHE_TIME; // 5 minutes


    public function tag(){
    	return $this->belongsToMany('App\Tag');
    }

    public function category(){
    	return $this->belongsToMany('App\Category');
    }

    public function categoryList(){
    	return $this->belongsToMany('App\Category')->limit(1);
    }

    public function tagList(){
    	return $this->belongsToMany('App\Tag')->limit(2);
    }

    /**
     * paln to log
     */
    public function planStatus() {
        return $this->hasOne(PlanLog::class, 'plan_id')->orderBy('id', 'desc');
    }

    /**
     * paln to order
     */
    public function order() {
        return $this->hasOne(Order::class, 'plan_id')->orderBy('id', 'desc');
    }

     /**
     * paln to order
     */
    public function orderList() {
        return $this->hasMany(Order::class, 'plan_id')->orderBy('id', 'desc');
    }
 
}
