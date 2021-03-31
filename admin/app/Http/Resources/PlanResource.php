<?php

namespace App\Http\Resources;
use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         
        return [
            'id' =>$this->id,
            'title' => ucfirst($this->title),
            'price' => number_format($this->amount,2,'.', ''),
            'amount' => number_format($this->amount+$this->closing_balance,2),
            'tag' => Tag::collection($this->tagList),
            'category' => Category::collection($this->categoryList),
            'type' => $this->type,
            'pl_amount' => $this->closing_balance >= 0 ? '+'.number_format($this->closing_balance,2):number_format($this->closing_balance,2),
            'pl_percentage' => $this->closing_balance >=0 ? '+'.number_format(($this->closing_balance/$this->amount) * 100,2).'%' : number_format(($this->closing_balance/$this->amount) * 100,2).'%',
            'start_time' => $this->start_time,
            'end_time' => $this->end_time
        ];
    }
}
