<?php

namespace App\Http\Resources;
use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Statement;

class SubscriptionHolding extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $realised_profit = Statement::where('user_id',$this->user_id)->where('plan_id',$this->plan_id)->sum('pl');
        if($this->type == 1){
            $profitPercentage = 0;
            if($this->amount == 0){
                $profitPercentage = $this->amount <= $realised_profit || $realised_profit == 0 ? '+'.number_format((0)*100,2).'%' :number_format((0)*100,2).'%';
            }else{
                $profitPercentage =  $this->amount <= $realised_profit || $realised_profit == 0 ? '+'.number_format(($realised_profit/$this->amount)*100,2).'%' :number_format(($realised_profit/$this->amount)*100,2).'%';
            }
            return [
                'subscription_id'=>$this->id,
                'plan_id'=>$this->plan_id,
                'qty' => number_format($this->qty,2,'.', ''),
                'avg' => $this->plan->amount,
                'title' => ucfirst($this->plan->title),
                'invested' => number_format($this->amount,2),
                'price' => $this->plan->closing_balance >= 0 ?number_format($this->plan->closing_balance + $this->plan->amount,2):number_format($this->plan->closing_balance + $this->plan->amount,2),
                'pricePercentage' => $this->plan->closing_balance >= 0 ?'+'.number_format(($this->plan->closing_balance/$this->plan->amount) * 100,2).'%':number_format(($this->plan->closing_balance/$this->plan->amount) * 100,2).'%',
                "profitPercentage" => $profitPercentage,
                'profit' => $this->amount <= $realised_profit || $realised_profit == 0 ? '+'.number_format($realised_profit,2) :number_format($realised_profit,2),
                "color" => $this->amount <= $realised_profit || $realised_profit == 0 ? true : false
                
            ];
        }else{
            $profitPercentage = 0;
            if($this->amount == 0){
                 
                $profitPercentage = $this->amount <= $realised_profit || $realised_profit == 0 ? '+'.number_format((0)*100,2).'%' :number_format((0)*100,2).'%';
            }else{
                $profitPercentage =  $this->amount <= $realised_profit || $realised_profit == 0 ? '+'.number_format(($realised_profit/$this->amount)*100,2).'%' :number_format(($realised_profit/$this->amount)*100,2).'%';
            }
            return [
                'subscription_id'=>$this->id,
                'plan_id'=>$this->plan_id,
                'qty' => 0,
                'avg' => $this->plan->amount,
                'title' => ucfirst($this->plan->title),
                'invested' => number_format($this->amount,2,'.', ''),
                'price' => $this->plan->closing_balance >= 0 ?number_format($this->plan->closing_balance + $this->plan->amount,2):number_format($this->plan->closing_balance + $this->plan->amount,2),
                'profit' => $this->amount <= $realised_profit || $realised_profit == 0 ? '+'.number_format($realised_profit,2) :number_format($realised_profit,2),
                'pricePercentage' => $this->plan->closing_balance >= 0 ?'+'.number_format(($this->plan->closing_balance/$this->plan->amount) * 100,2).'%':number_format(($this->plan->closing_balance/$this->plan->amount) * 100,2).'%',
                "profitPercentage" => $profitPercentage,
                "color" => $this->amount <= $realised_profit || $realised_profit == 0 ? true : false,
                
            ];
        }
        
    }
}
