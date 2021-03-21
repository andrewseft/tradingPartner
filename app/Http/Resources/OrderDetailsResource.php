<?php

namespace App\Http\Resources;
use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Statement;
use App\Order;
 

class OrderDetailsResource extends JsonResource
{
    
    protected static $planLog = [];
    protected static $profitChart = [];
    protected static $lossChart = [];
    
    public static function planLog($planLog = []){
        static::$planLog = $planLog;
    }

    public static function profitChart($profitChart = []){
        static::$profitChart = $profitChart;
    }

    public static function lossChart($lossChart = []){
        static::$lossChart = $lossChart;
    }

     
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user_id = $this->user_id;
         
        $totalPl = Statement::where('user_id',$user_id)->where('plan_id',$this->plan_id)->where('is_pay',0)->sum('pl');
        $totalInvested = Order::where('user_id',$user_id)->where('plan_id',$this->plan_id)->where('type',1)->sum('amount');
        $total_charges = Statement::where('user_id',$user_id)->where('plan_id',$this->plan_id)->where('is_pay',0)->sum('total_commission');
        $charges = Statement::where('user_id',$user_id)->where('plan_id',$this->plan_id)->where('is_pay',0)->sum('chg');
       
        if($this->type == 1){
            
            return [
                'id' =>$this->id,
                'title' => ucfirst($this->plan->title),
                'description' => $this->plan->description,
                'currentAmount' => $this->plan->closing_balance >= 0 ? '+'.number_format($this->plan->closing_balance + $this->plan->amount,2):number_format($this->plan->closing_balance + $this->plan->amount,2),
                'amount' => $this->amount,
                'tag' => Tag::collection($this->plan->tagList),
                'category' => Category::collection($this->plan->categoryList),
                'type' => $this->plan->type,
                'pl_amount' => $this->plan->closing_balance >= 0 ? '+'.number_format($this->plan->closing_balance,2):number_format($this->plan->closing_balance,2),
                'pl_percentage' => $this->plan->closing_balance >= 0 ? '+'.number_format(($this->plan->closing_balance/$this->plan->amount) * 100,2).'%':number_format(($this->plan->closing_balance/$this->plan->amount) * 100,2).'%',
                'funds'=>number_format($this->amount,2),
                'currentValue'=>Helper::__numberFormat($totalPl + $totalInvested),
                'pl'=>$totalPl >= 0 ? '+'.Helper::__numberFormat($totalPl) :Helper::__numberFormat($totalPl),
                'chg'=>$charges >=  0 ? '+'.Helper::__numberFormat($charges).'%' :Helper::__numberFormat($charges).'%',
                'qty'=>number_format(($this->qty),2),
                'buyAvg' => number_format($this->plan->amount,2),
                'statements' => PlanLog::collection(static::$planLog),
                "profitChart"=>  static::$profitChart,
                "lossChart"=>  static::$lossChart,
                'total_charges' => $total_charges >=  0 ? '+'.Helper::__numberFormat($total_charges) :Helper::__numberFormat($total_charges).'%',
            ];
        }else{
            return [
                'id' =>$this->id,
                'title' => ucfirst($this->plan->title),
                'description' => $this->plan->description,
                'currentAmount' => $this->plan->closing_balance >= 0 ? '+'.number_format($this->plan->closing_balance + $this->plan->amount,2):number_format($this->plan->closing_balance + $this->plan->amount,2),
                'amount' => $this->amount,
                'tag' => Tag::collection($this->plan->tagList),
                'category' => Category::collection($this->plan->categoryList),
                'type' => $this->plan->type,
                'pl_amount' => $this->plan->closing_balance >= 0 ? '+'.number_format($this->plan->closing_balance,2):number_format($this->plan->closing_balance,2),
                'pl_percentage' => $this->plan->closing_balance >= 0 ? '+'.number_format(($this->plan->closing_balance/$this->plan->amount) * 100,2).'%':number_format(($this->plan->closing_balance/$this->plan->amount) * 100,2).'%',
                'funds'=>number_format($this->amount,2),
                'currentValue'=>Helper::__numberFormat($totalPl + $totalInvested),
                'pl'=>$totalPl >= 0 ? '+'.Helper::__numberFormat($totalPl) :Helper::__numberFormat($totalPl),
                'chg'=>$charges >=  0 ? '+'.Helper::__numberFormat($charges).'%' :Helper::__numberFormat($charges).'%',
                'qty'=>number_format(($this->qty),2),
                'buyAvg' => number_format($this->plan->amount,2),
                'statements' => PlanLog::collection(static::$planLog),
                "profitChart"=>  static::$profitChart,
                "lossChart"=>  static::$lossChart,
                'total_charges' => $total_charges >=  0 ? '+'.Helper::__numberFormat($total_charges) :Helper::__numberFormat($total_charges).'%',
            ];
        }
        
    }
}
