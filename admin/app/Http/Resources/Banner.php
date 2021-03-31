<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\Helper;
use App\Constants\Constant;

class Banner extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if(Helper::exists(Constant::BANNER_IMAGE_THUMB.$this->image) && $this->image != NULL){
            $image = Helper::getImageUrl(Constant::BANNER_IMAGE_THUMB.$this->image);
        } else {
            $image = url(Constant::NO_IMAGE_BANNER);
        }
        return [
            'hyperlink' => $this->hyperlink,
            'image' => $image
        ];
    }
}
