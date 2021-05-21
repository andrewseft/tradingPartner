<?php

namespace App\Http\Resources;
use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;
use App\SubscriptionHolding;

class ReferralListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $trade = SubscriptionHolding::where('user_id',$this->id)->where('is_pay',0)->count();
        return [
            'name' => $this->fullName,
            'email' => $this->email,
            'number' => $this->number,
            "trade_active" => $trade > 0 ? true : false,
            "city" => "N/A"
        ];
    }
}
