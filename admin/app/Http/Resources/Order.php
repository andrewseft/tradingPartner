<?php

namespace App\Http\Resources;
use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->is_pms == 1){
            return [
                'id' => $this->id,
                'avg' => number_format($this->plan->amount,2,'.', ''),
                'subscription' => number_format($this->amount,2,'.', ''),
                'plan' => ucfirst($this->plan->title),
                'qty' => $this->qty,
                'remark' => $this->remark,
                'status' => $this->status == 1 ? 'COMPLETE' : 'STOP',
                'pmsStatus' => $this->is_pms == 1 ? 'START' : 'STOP',
                'date' => $this->created_at->format('Y-m-d H:i')
               
            ];
        }else{
            return [
                'id' => $this->id,
                'avg' => number_format($this->amount,2,'.', ''),
                'subscription' => number_format($this->amount * $this->qty,2,'.', ''),
                'plan' => ucfirst($this->plan->title),
                'qty' => $this->qty,
                'remark' => $this->remark,
                'status' => $this->status == 1 ? 'COMPLETE' : 'STOP',
                'pmsStatus' => $this->is_pms == 1 ? 'START' : 'STOP',
                'date' => $this->created_at->format('Y-m-d H:i')
               
            ];
        }
        
    }
}
