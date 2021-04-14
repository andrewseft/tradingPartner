<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\Plan;
use App\Page;
use App\PlanLog;
use App\Tag;
use App\Category;
use App\Statement;
use App\Http\Resources\Statement as StatementResource;
use App\Order;
use App\wallet;
use Illuminate\Http\JsonResponse;
use Exception;
use App\Http\Resources\PlanResource as PlanResource;
use App\Http\Resources\PlanDetailsResource as PlanDetailsResource;
use Auth;

class PlanController extends BaseController
{
    
    private $plan;

    /** @var  Limit */
    private $limit;

    /** @var  PlanLog */
    private $planLog;

    /** @var  Order */
    private $order;

    /** @var  wallet */
    private $wallet;

    /** @var  page */
    private $page;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(page $page, wallet $wallet, Order $order, PlanLog $planLog, Plan $plan, Tag $tag, Category $category)
    {
        $this->plan = $plan;
        $this->tag = $tag;
        $this->category = $category;
        $this->planLog = $planLog;
        $this->wallet = $wallet;
        $this->order = $order;
        $this->limit = Helper::setting()->admin_limit;
        $this->page = $page;
    }

    /**
     * Get plan list
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $planData = $this->plan->where('status',1)->with(['planStatus'])->sortable()->orderBy('position', 'asc');
            if ($request->has('keyword')) {
                $keyword = $request->get('keyword');
                $planData->where('title', 'LIKE', '%' . $keyword . '%');
            }
            $data = $planData->paginate($this->limit);
            $tag = $this->tag->where('status',1)->pluck('name','id');
            $category = $this->category->where('status',1)->with(['detail'])->get()->pluck('detail.name','id');
            return $this->sendResponse(PlanResource::collection($data), 'Data was retrieved successfully.');
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

     /**
     * Get plan detail
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(int $id, Request $request)
    {
        try {
            $user = Auth::user();
            $data = $this->plan->where('status',1)->where('id',$id)->sortable()->orderBy('position', 'asc')->first();
            $wallet = $this->wallet->where('user_id',$user->id)->orderBy('id', 'DESC')->first();
            $order = $this->order->where('user_id',$user->id)->where('plan_id',$id)->where('type',1)->first();
            $orderQty = $this->order->where('user_id',$user->id)->where('plan_id',$id)->where('type',1)->sum('qty');
            $planLog = $this->planLog->where('plan_id',$id)->orderBy('id', 'DESC')->limit($this->limit)->get();
            $profitChart = $this->graph($data->id,1);
            $lossChart = $this->graph($data->id,0);
            $page = $this->page->with(['detail'])->where('id', 5)->where('status',1)->first();
            $statement = Statement::where('user_id',$user->id)->where('plan_id',$data->id)->orderBy('id', 'desc')->get();
            PlanDetailsResource::wallet($wallet);
            PlanDetailsResource::order($order);
            PlanDetailsResource::planLog($statement);
            PlanDetailsResource::profitChart($profitChart);
            PlanDetailsResource::lossChart($lossChart);
            PlanDetailsResource::page($page);
            PlanDetailsResource::QTY($orderQty);
            return $this->sendResponse(new PlanDetailsResource($data), 'Data was retrieved successfully.');
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get plan detail
     *
     * @return \Illuminate\Http\Response
     */
    public function detailSlug(string $id, Request $request)
    {
        try {
            $user = Auth::user();
            $data = $this->plan->where('status',1)->where('slug',$id)->sortable()->orderBy('position', 'asc')->first();
            $wallet = $this->wallet->where('user_id',$user->id)->orderBy('id', 'DESC')->first();
            $order = $this->order->where('user_id',$user->id)->where('plan_id',$data->id)->where('type',1)->first();
            $orderQty = $this->order->where('user_id',$user->id)->where('plan_id',$data->id)->where('type',1)->sum('qty');
            $planLog = $this->planLog->where('plan_id',$data->id)->orderBy('id', 'DESC')->limit($this->limit)->get();
            $profitChart = $this->graphWeb($data->id,1);
            $lossChart = $this->graphWeb($data->id,0);
            $page = $this->page->with(['detail'])->where('id', 5)->where('status',1)->first();
           
            $statement = Statement::where('user_id',$user->id)->where('plan_id',$data->id)->orderBy('id', 'desc')->get();
            PlanDetailsResource::wallet($wallet);
            PlanDetailsResource::order($order);
            PlanDetailsResource::planLog($statement);
            PlanDetailsResource::profitChart($profitChart);
            PlanDetailsResource::lossChart($lossChart);
            PlanDetailsResource::page($page);
            PlanDetailsResource::QTY($orderQty);
            return $this->sendResponse(new PlanDetailsResource($data), 'Data was retrieved successfully.');
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * get graph data
     * 
     * @return \Illuminate\Http\Response
     */
    public function graph($id,$type)
    {
        try {
            $user = Auth::user();
            $now = Carbon::now();
            $resultData = [];
            $startDate = $now->startOfWeek()->format('Y-m-d H:i');
            $endDate = $now->endOfWeek()->format('Y-m-d H:i');
            for ($i = 0; $i < 7; $i++) {
                $day[] = $now->startOfWeek()->addDays($i)->format('d-M');
            }
            $query = Statement::where('plan_id',$id)->where('user_id',$user->id)->whereBetween('created_at', array($startDate, $endDate))->sortable()->orderBy('id', 'desc');
            $result = $query->paginate(30)->groupBy(function ($item) {
                return $item->created_at->format('d-M');
            })->toArray();
            $data = [];
            if($result){
                foreach($result as $key => $val){
                    $amount=0;
                    $plPercent=0;
                    foreach($val as $itemKey => $item){
                        $amount += $item['pl'];
                        $plPercent += $item['chg'];
                    }
                    $data[$key]['amount'] = number_format($amount,2,'.', '');
                    $data[$key]['plPercent'] = number_format($plPercent,2,'.', '');
                    $data[$key]['date'] = $key;  
                }
            }
            foreach($day as $key => $val){
                $itemData['amount'] = number_format(0,2,'.', '');
                $itemData['date'] = $val;
                $resultData[] = isset($data[$val]) ? $data[$val] :$itemData;
            }
           return $resultData;
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * get graph data
     * 
     * @return \Illuminate\Http\Response
     */
    public function graphWeb($id,$type)
    {
        try {
            $user = Auth::user();
            $now = Carbon::now();
            $resultData = [];
            $startDate = $now->startOfWeek()->format('Y-m-d H:i');
            $endDate = $now->endOfWeek()->format('Y-m-d H:i');
            for ($i = 0; $i < 7; $i++) {
                $day[] = $now->startOfWeek()->addDays($i)->format('d-M');
            }
            $query = Statement::where('plan_id',$id)->where('user_id',$user->id)->whereBetween('created_at', array($startDate, $endDate))->sortable()->orderBy('id', 'desc');
            $result = $query->paginate(30)->groupBy(function ($item) {
                return $item->created_at->format('d-M');
            })->toArray();
            $data = [];
            if($result){
                foreach($result as $key => $val){
                    $amount=0;
                    $plPercent=0;
                    foreach($val as $itemKey => $item){
                        $amount += $item['pl'];
                        $plPercent += $item['chg'];
                    }
                    $data[$key]['y'] = number_format($amount,2,'.', '');
                    $data[$key]['label'] = $key;  
                }
            }
            foreach($day as $key => $val){
                $itemData['y'] = number_format(0,2,'.', '');
                $itemData['label'] = $val;
                $resultData[] = isset($data[$val]) ? $data[$val] :$itemData;
            }
           return $resultData;
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

   
}
