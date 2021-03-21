<?php

namespace App\Http\Resources;

use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\InvestmentCapital;
use App\wallet;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if(Helper::exists(Constant::USER_IMAGE_THUMB.$this->image) && $this->image != NULL){
            $image = Helper::getImageUrl(Constant::USER_IMAGE_THUMB.$this->image);
        } else {
            $image = url(Constant::NO_IMAGE_USER);
        }

        if(isset($this->profile->adahr_card_image) && Helper::exists(Constant::DOC_IMAGE_THUMB.$this->profile->adahr_card_image) && $this->profile->adahr_card_image != NULL){
            $adahr_card_image = Helper::getImageUrl(Constant::DOC_IMAGE_THUMB.$this->profile->adahr_card_image);
        } else {
            $adahr_card_image = url(Constant::NO_IMAGE_USER);
        }

        if(isset($this->profile->pan_cart_image) && Helper::exists(Constant::DOC_IMAGE_THUMB.$this->profile->pan_cart_image) && $this->profile->pan_cart_image != NULL){
            $pan_cart_image = Helper::getImageUrl(Constant::DOC_IMAGE_THUMB.$this->profile->pan_cart_image);
        } else {
            $pan_cart_image = url(Constant::NO_IMAGE_USER);
        }

        $data = InvestmentCapital::where('status',1)->get()->pluck('name','id')->toArray();

        $amount = 0;
        $walletData = wallet::where('user_id',$this->id)->orderBy('id', 'desc')->first();
        if($walletData){
            $amount =  $walletData->closing_bal; 
        }
        return [
            'userId' => 'U-'.$this->id,
            'name' => $this->first_name,
            'investmentCapital' => (int)$this->investmentCapital,
            'investmentCapitalTitle' => isset($data[$this->investmentCapital]) ?$data[$this->investmentCapital].'K':$data[1].'K',
            'email' => $this->email,
            'number' => $this->number,
            'notification' => $this->notification,
            'api_token' => $this->api_token,
            'role_id' => $this->role_id,
            'image' => $image,
            'last_login_at' => $this->last_login_at,
            'bank_name' => $this->profile->bank_name ?? '',
            'ifsc_code' => $this->profile->ifsc_code ?? '',
            'adahr_card_number' => $this->profile->adahr_card_number ?? '',
            'pan_cart_number' => $this->profile->pan_cart_number ?? '',
            'account_number' => $this->profile->account_number ?? '',
            'pan_cart_image' => $pan_cart_image,
            'adahr_card_image' => $adahr_card_image,
            'walletAmount' => $amount,
            'is_kyc' => $this->is_kyc,
            'referral_code' => $this->referral_code
        ];
    }
}
