<?php

namespace App\Http\Resources;
use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class PassBook extends JsonResource
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
            'amount' => number_format($this->amount,2,'.', ''),
            'closing_bal' => number_format($this->closing_bal,2,'.', ''),
            'remark' => $this->remark,
            'type' => $this->type == 1 ? 'Credit' : 'Debit',
            'date' => $this->created_at->format('Y-m-d H:i')
           
        ];
    }
}
