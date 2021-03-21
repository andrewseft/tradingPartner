<?php

namespace App\Http\Controllers\API;

use App\Constants\Constant;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;
use App\Setting;
use Auth;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Setting as SettingResource;
use Illuminate\Support\Facades\DB;
use Exception;

class SettingController extends BaseController
{
    private $user;
    private $setting;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(User $user, Setting $setting)
    {
        $this->user = $user;
        $this->setting = $setting;
        
    }

     

    /**
     * @method get
     *
     * get setting details
     */
    public function index(Request $request)
    {
        try {
            $data = $this->setting->where('id',1)->get();
            return $this->sendResponse(SettingResource::collection($data),trans('message.GET_DATA'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

     
     
}
