<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetRedeemAmount extends Model
{
    /**
     * paln to log
     */
    public function planStatus() {
        
        return $this->hasOne(PlanLog::class, 'plan_id','plan_id')->orderBy('id','desc');
    }
}
