<?php

namespace App\Http\Resources;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class Page extends JsonResource
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
            'title' => Helper::mb_strtolower($this->detail->title),
            'description' => $this->detail->description,
        ];
    }
}
