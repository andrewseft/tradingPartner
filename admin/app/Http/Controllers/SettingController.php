<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Manager\SettingManager;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(SettingManager $setting)
    {
        $this->setting = $setting;
    }


    /**
     * @method get
     */
    public function index(){
        $title = __('Settings');
        $data = $this->setting->get();
        return view('admin.setting.index', compact('title', 'data'));
    }


    /**
     * @method post
     */
    public function doindex(SettingRequest $request){
        $setting = $this->setting->get();
        $this->setting->save($request,$setting);
        return redirect()->route('admin.setting')->with('success', __('Setting has been changed successfully'));
    }


}
