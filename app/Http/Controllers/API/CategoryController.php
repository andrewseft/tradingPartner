<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Category;
use App\Constants\Constant;
use App\Helpers\Helper;
use Illuminate\Http\JsonResponse;
use Exception;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends BaseController
{
    private $category;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @method get
     *
     * @return array
     *
     * @param $id
     *
     * @param $type {mobile,web}
     */
    public function index(Request $request){
        try {
            $data = $this->category->with(['detail:category_id,name'])->where('status',1)->orderby('position','asc')->get();
            return $this->sendResponse(CategoryResource::collection($data),trans('message.GET_DATA'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

     
}
