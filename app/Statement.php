<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Constants\Constant;

class Statement extends Model
{
    use Sortable,Cachable;
    
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
}
