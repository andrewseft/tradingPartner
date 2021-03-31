<?php

namespace App\Http\Resources;
use App\Constants\Constant;
use App\Helpers\Helper;
use App\Statement;
use App\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanDetailsResource extends JsonResource
{
    protected static $wallet = [];
    protected static $order = [];
    protected static $planLog = [];
    protected static $profitChart = [];
    protected static $lossChart = [];
    protected static $page = [];
    protected static $QTY = [];

    public static function wallet($wallet = []){
        static::$wallet = $wallet;
    }

    public static function order($order = []){
        static::$order = $order;
    }

    public static function planLog($planLog = []){
        static::$planLog = $planLog;
    }

    public static function profitChart($profitChart = []){
        static::$profitChart = $profitChart;
    }

    public static function lossChart($lossChart = []){
        static::$lossChart = $lossChart;
    }

    public static function page($page = []){
        static::$page = $page;
    }

    public static function QTY($QTY = []){
        static::$QTY = $QTY;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user_id = 0;
        if(isset(static::$order->qty)){
            $user_id = static::$order->user_id;
        }
        $totalPl = Statement::where('user_id',$user_id)->where('plan_id',$this->id)->where('is_pay',0)->sum('pl');
        $totalInvested = Order::where('user_id',$user_id)->where('plan_id',$this->id)->where('type',1)->sum('amount');
        $total_charges = Statement::where('user_id',$user_id)->where('plan_id',$this->id)->where('is_pay',0)->sum('total_commission');
        $charges = Statement::where('user_id',$user_id)->where('plan_id',$this->id)->where('is_pay',0)->sum('chg');
        return [
            'id' =>$this->id,
            'title' => ucfirst($this->title),
            'description' => $this->description,
            'currentAmount' => number_format($this->closing_balance + $this->amount,2),
            'amount' => $this->amount,
            'tag' => Tag::collection($this->tagList),
            'category' => Category::collection($this->categoryList),
            'type' => $this->type,
            'pl_amount' => $this->closing_balance >= 0 ? '+'.number_format($this->closing_balance,2):number_format($this->closing_balance,2),
            'pl_percentage' => $this->closing_balance >= 0 ? '+'.number_format(($this->closing_balance/$this->amount) * 100,2).'%' : number_format(($this->closing_balance/$this->amount) * 100,2).'%',
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'walletAmount'=>isset(static::$wallet->closing_bal)?number_format(static::$wallet->closing_bal,2,'.', ''):0,
            'funds'=>isset(static::$order->amount)?number_format(static::$order->amount,2):0,
            'currentValue'=>Helper::__numberFormat($totalPl + $totalInvested),
            'pl'=>$totalPl >= 0 ? '+'.Helper::__numberFormat($totalPl) :Helper::__numberFormat($totalPl),
            'chg'=>$charges >=  0 ? '+'.Helper::__numberFormat($charges).'%' :Helper::__numberFormat($charges).'%',
            'qty'=>isset(static::$order->qty)?number_format((static::$QTY),2):0,
            'buyAvg' => number_format($this->amount,2),
            'isPms'=>isset(static::$order->is_pms)?static::$order->is_pms:0,
            'statements' => PlanLog::collection(static::$planLog),
            "profitChart"=>  static::$profitChart,
            "lossChart"=>  static::$lossChart,
            "pmsPage"=>  static::$page->detail->description,
            'total_charges' => $total_charges >=  0 ? '+'.Helper::__numberFormat($total_charges) :Helper::__numberFormat($total_charges).'%',
            
        ];
    }
}
