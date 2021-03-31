<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Setting extends JsonResource
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
            'wallet_charge' => $this->wallet_charge,
            'support_email' => $this->support_email,
            'number' => $this->number,
            'address' => $this->address,
            'copy_right' => $this->copy_right,
            'about_us' => $this->about_us
        ];
    }
}
