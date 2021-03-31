<?php

namespace App\Http\Resources;
use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Statement;

class Subscription extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $totalPlData =   Statement::where('user_id',$this->user_id)->where('plan_id',$this->plan_id)->whereDate('created_at', Carbon::today())->orderBy('id', 'DESC')->first();
         
        $totalPl = 0;
        if($totalPlData){
            $totalPl = $totalPlData->pl; 
        }
        $totalInvested = $this->amount;
        if($this->type == 1){
            return [
                'subscription_id'=>$this->id,
                'plan_id'=>$this->plan_id,
                'title' => ucfirst($this->plan->title),
                'tag' => Tag::collection($this->plan->tagList),
                'category' => Category::collection($this->plan->categoryList),
                'type' => $this->plan->type,
                'currentAmount' => number_format($this->plan->closing_balance + $this->plan->amount,2),
                'qty'=>number_format($this->qty,2,'.', ''),
                'totalAmount' => $totalPl >= 0 ? '+'.number_format($totalPl,2) :number_format($totalPl,2)
            ];
        }else{
            return [
                'subscription_id'=>$this->id,
                'plan_id'=>$this->plan_id,
                'title' => ucfirst($this->plan->title),
                'tag' => Tag::collection($this->plan->tagList),
                'category' => Category::collection($this->plan->categoryList),
                'type' => $this->plan->type,
                'currentAmount' => number_format($this->plan->closing_balance + $this->plan->amount,2),
                'qty'=>number_format(0,2,'.', ''),
                'totalAmount' => $totalPl >= 0 ? '+'.number_format($totalPl,2) :number_format($totalPl,2)
            ]; 
        }
    }
}
