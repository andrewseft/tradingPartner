<?php

namespace App\Http\Resources;
use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferralUse extends JsonResource
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
            'month' => $this->month_name,
            'account_converted' => $this->account_converted,
            'trade_active' => $this->trade_active,
            'flat_income' => $this->flat_income,
            'gross_brokerage' => $this->gross_brokerage,
            'net_sharing' => $this->net_sharing,
            'total' => $this->total
        ];
    }
}
