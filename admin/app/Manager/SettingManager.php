<?php

namespace App\Manager;
use App\Setting;
use App\Manager\CacheManager;

class SettingManager
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Setting $setting,CacheManager $cacheManager)
    {
       $this->setting = $setting;
       $this->cache = $cacheManager;
    }

    /**
     * Get data id
     */
    public function get(){
        $data = $this->setting->findOrFail(1);
        return $data;
    }

    /**
     * Save recode
     *
     * @param $request
     * @param $data
     */
    public function save($request,$data){
         
        $data->name = $request->get('name');
        $data->email = $request->get('email');
        $data->support_email = $request->get('support_email');
        $data->number = $request->get('number');
        $data->address = $request->get('address');
        $data->copy_right = $request->get('copy_right');
        $data->about_us = $request->get('about_us');
        $data->google_link = $request->get('google_link');
        $data->apple_link = $request->get('apple_link');
        $data->admin_limit = $request->get('admin_limit');
        $data->front_limit = $request->get('front_limit');
        $data->planform_fee = $request->get('planform_fee');
        $data->commission = $request->get('commission');
        $data->sebi = $request->get('sebi');
        $data->sgst = $request->get('sgst');
        $data->stamp_duty = $request->get('stamp_duty');
        $data->stt = $request->get('stt');
        $data->igst = $request->get('igst');
        $data->cgst = $request->get('cgst');
        $data->platform_commission = $request->get('platform_commission');
        $data->exchange_transaction_tax = $request->get('exchange_transaction_tax');
        $data->wallet_charge = $request->get('wallet_charge');
        $data->save();
    }




}
