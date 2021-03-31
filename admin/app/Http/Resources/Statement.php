<?php

namespace App\Http\Resources;
use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class Statement extends JsonResource
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
            'date' => $this->created_at->format('d-m-Y'),
            'capital'=>Helper::__numberFormat($this->invested),
            'pl'=>$this->pl >= 0 ? '+'.Helper::__numberFormat($this->pl) : Helper::__numberFormat($this->pl),
            'chg'=>$this->chg >= 0 ? '+'.Helper::__numberFormat($this->chg).'%' : Helper::__numberFormat($this->chg).'%'
        ];
    }
}
