<?php

namespace App\Http\Controllers\API;

use App\Constants\Constant;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\InvestmentCapital as InvestmentCapitalResource;
use Illuminate\Http\Request;
use App\InvestmentCapital;
 

class CommonController extends BaseController
{
    private $investmentCapital;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(InvestmentCapital $investmentCapital)
    {
        $this->investmentCapital = $investmentCapital;
    }

    /**
     * @method get
     * 
     * get getInvestmentCapital list
     * 
     */
    public function getInvestmentCapital(){
        try {
            $data = $this->investmentCapital->where('status',1)->get();
            return $this->sendResponse(InvestmentCapitalResource::collection($data), 'Data was retrieved successfully.');
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
