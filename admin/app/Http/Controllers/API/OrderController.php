<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\Order;
use App\Plan;
use App\PlanLog;
use App\wallet;
use App\SubscriptionHolding;
use App\Statement;
use Auth;
use App\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\API\OrderRequest;
use App\Http\Requests\API\ImageRequest;
use App\Http\Requests\API\PlanRequest;
use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\OrderDetailsResource as OrderDetailsResource;
use Exception;
use App\Manager\NotificationManager;

class OrderController extends BaseController
{
    private $order;

    /** @var  Limit */
    private $limit;

    /** @var  Plan */
    private $plan;

     /** @var  User */
     private $user;

     /** @var  NotificationManager */
     private $notification;

     /** @var  wallet */
    private $wallet;

    /** @var  PlanLog */
    private $planLog;

    /** @var  SubscriptionHolding */
    private $subscriptionHolding;

    /** @var  Statement */
    private $statement;

    

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Statement $statement, SubscriptionHolding $subscriptionHolding, PlanLog $planLog, Order $order, Plan $plan, User $user, NotificationManager $NotificationManager,wallet $wallet)
    {
        $this->order = $order;
        $this->plan = $plan;
        $this->limit = Helper::setting()->admin_limit;
        $this->user = $user;
        $this->notification = $NotificationManager;
        $this->wallet = $wallet;
        $this->planLog = $planLog;
        $this->subscriptionHolding = $subscriptionHolding;
        $this->statement = $statement;
    }

    /**
     * Get bye plan and save data on order table
     * 
     * @method post
     *
     * @return \Illuminate\Http\Response
     * 
     * {"plan_id" : "2","amount" : "10000","type":"1"}
     */
    public function buyPlan(PlanRequest $request)
    {
        try {
            $user = Auth::user();
            if($user->is_kyc == 0){
                return $this->sendError("Your KYC is complete, otherwise awaiting approval.");
            }
            /**
             * PMS Start
             */
            if($request->type == 1){
                $planData = $this->plan->where('status',1)->where('id',$request->plan_id)->where('qty','!=',0)->first();
                if(empty($planData)){
                    return $this->sendError("plan not found");
                }
                if($planData->qty <= 0){
                    return $this->sendError("Extremely Sorry! but we are full and hence closed taking new orders. Keep watching, the plan will re-open soon. Thanks for your love and support");
                }
                $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first(); 
                if(empty($walletData)){
                    return $this->sendError("There is no amount in your wallet to buy this plan, please add amount in your wallet and get this plan");
                }
                 
                if($walletData->closing_bal == 0 || $walletData->closing_bal < $request->amount){
                    return $this->sendError("There is no amount in your wallet to buy this plan, please add amount in your wallet and get this plan");
                }

                $amount = $request->amount;
                $qty = ($request->amount/$planData->amount);
                if($planData->qty <= $qty){
                    return $this->sendError("Extremely Sorry! but we are full and hence closed taking new orders. Keep watching, the plan will re-open soon. Thanks for your love and support ;)");
                }
                $data = $this->order;
                $pre = $this->order->where('user_id',$user->id)->where('type',1)->where('plan_id',$planData->id)->first();
                if($pre){
                    $data = $pre;
                }
                $data->user_id = $user->id;
                $data->plan_id = $planData->id;
                $data->status = 1;
                $data->type = 1;

                if($pre){
                    $totalAmount = $amount + $pre->amount;
                    $totalQty = $qty + $pre->qty;
                    $data->amount = $totalAmount;
                    $data->qty = $totalQty;
                }else{
                    $data->amount = $amount;
                    $data->qty = $qty;
                }
                $data->remark = "Waiting for funds allocation";
                $data->is_pms = 1;
                $data->save();
                $this->plan->where('id',$request->plan_id)->update(['qty'=>$planData->qty - $qty]);

                /**
                 * subscriptionHolding
                 */

                $subscriptionHolding = $this->subscriptionHolding;
                $subscriptionHolding->user_id = $user->id;
                $subscriptionHolding->plan_id = $request->plan_id;
                $subscriptionHolding->qty = $qty;
                $subscriptionHolding->amount = $planData->amount;
                $subscriptionHolding->totalAmount = $planData->amount *$qty;
                $subscriptionHolding->pl = 0;
                $subscriptionHolding->commission = 0;
                $subscriptionHolding->platform_fee = 0;
                $subscriptionHolding->total_tax = 0;
                $subscriptionHolding->total_commission = 0;
                $subscriptionHolding->expense = 0;
                $subscriptionHolding->realised_profit = 0;
                $subscriptionHolding->profit_change = 0;
                $subscriptionHolding->save();

                /**
                 * user Statement
                 */
                $statement = $this->statement;
                $statement->user_id = $user->id;
                $statement->plan_id = $request->plan_id;
                $statement->buy_avg = $planData->amount;
                $statement->sell_avg = $planData->amount;
                $statement->amount_chg = 0;
                $statement->chg = 0;
                $statement->qty = $qty;
                $statement->pl = 0;
                $statement->invested = $planData->amount *$qty;
                $statement->current_value = $planData->amount *$qty;
                $statement->PL_balance = 0;
                $statement->capital_balance = $planData->amount *$qty;
                $statement->commission = 0;
                $statement->platform_fee = 0;
                $statement->total_commission = 0;
                $statement->realised_profit = 0;
                $statement->save();

                /**
                 * update wallet
                 */
                $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
                $amount =  $walletData->closing_bal; 
                $totalAmount = $request->amount;
                
                $data = $this->wallet;
                $data->user_id = $user->id;
                $data->amount = $request->amount;
                $data->transaction_id = null;
                $data->type = 2;
                $data->closing_bal = $amount  - $totalAmount;
                $data->remark = "Bought a new plan";
                $data->save();

                /**
                 * Send email for user
                 */
                $ACCOUNT_STATUS = trans('message.PLAN_STATUS');
                $meassge = trans('message.BYE_PLAN',['NAME'=>ucfirst($user->first_name),'PLAN_NAME'=>$planData->title,'QTY'=>$qty]);
                $this->notification->send($user,route('home'),$ACCOUNT_STATUS,$meassge);

                /**
                 * Send Email for admin
                 */
                $adminUser = $this->user->findOrFail(1);
                $ACCOUNT_STATUS = trans('message.PLAN_STATUS');
                $meassge = trans('message.USER_BYE_PLAN',['NAME'=>ucfirst($user->first_name),'PLAN_NAME'=>$planData->title,'QTY'=>$qty]);
                $this->notification->send($adminUser,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
                return $this->sendResponse(true, trans('message.BYE_ORDER'));

            }
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * pms Stop
     * 
     * {"plan_id" : "2","type":"2"}
     */
    public function pmsStop(Request $request){
         
        try {
            $user = Auth::user();
            $order = $this->order->where('user_id',$user->id)->where('type',1)->where('plan_id',$request->plan_id)->where('is_pms',1)->first();
            if(empty($order)){
                return $this->sendResponse(true,'Your pms stopped');
            }
            
            if($user->is_kyc == 0){
                return $this->sendError("Your KYC is complete, otherwise awaiting approval.");
            }
            $planData = $this->plan->where('status',1)->where('id',$request->plan_id)->where('qty','!=',0)->first();
            if(empty($planData)){
                return $this->sendError("plan not found");
            }
            $currentTime = Carbon::now()->format('H:i');
             
            // if ($planData->end_time >= $currentTime && $planData->start_time <= $currentTime){
            //     return $this->sendError("Plan can start anytime, but can not stop during 9am to 3.30pm (Monday to Friday)");
            // }
            
              
                /**
                * Find order 
                */
                $statement = $this->statement->where('user_id',$user->id)->where('plan_id',$planData->id)->where('is_pay',0)->sum('realised_profit');
                $invested = $this->order->where('user_id',$user->id)->where('plan_id',$planData->id)->where('type',1)->sum('amount');
                $realisedProfit = $invested + $statement;
                $this->order->where('user_id',$user->id)->where('plan_id',$planData->id)->update(['type'=>2]);
                $this->subscriptionHolding->where('user_id',$user->id)->where('plan_id',$planData->id)->update(['is_pay'=>1]);
                
                 
                /**
                 * Add amount on wallet
                 */
            
                $amount = 0;
                $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
                if($walletData){
                    $amount =  $walletData->closing_bal; 
                }

                $data = $this->wallet;
                $data->user_id = $user->id;
                $data->amount = $realisedProfit;
                $data->transaction_id = 0;
                $data->type = 1;
                $data->closing_bal = $amount + $realisedProfit;
                $data->remark = "Sell Plan";
                $data->save();

                $this->statement->where('user_id',$user->id)->where('plan_id',$planData->id)->update(['is_pay'=>1]);

                /**
                 * Send email for user
                 */
                $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
                $meassge = trans('message.WALLET_AMOUNT_USER',['TOTAL_AMOUNT'=>number_format($amount + $realisedProfit,2,'.', ''),'AMOUNT'=>number_format($realisedProfit,2,'.', '')]);
                $this->notification->send($user,route('admin.customer'),$ACCOUNT_STATUS,$meassge);

                /**
                 * Send Email for admin
                 */
                $adminUser = $this->user->findOrFail(1);
                $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
                $meassge = trans('message.USER_WALLET_AMOUNT',['NAME'=>ucfirst($user->first_name),'AMOUNT'=>number_format($realisedProfit,2,'.', '')]);
                $this->notification->send($adminUser,route('admin.customer'),$ACCOUNT_STATUS,$meassge);

                /**
                 * Create a stop order
                 */
                $data = $this->order;
                $data->user_id = $user->id;
                $data->plan_id = $planData->id;
                $data->status = 1;
                $data->type = 2;
                if($planData->closing_balance > 0){
                    $data->amount = ($planData->amount + $planData->closing_balance);
                }else{
                    $data->amount = ($planData->closing_balance);
                }
                
                $data->qty = $order->qty;

                $data->remark = "PMS Stop";
                $data->is_pms = 0;
                $data->save();

                return $this->sendResponse(true,'Your pms stopped');
           
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

     

    /**
     * Get list
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        try {
            $user = Auth::user();
            $query = $this->order->where('user_id',$user->id)->whereDate('created_at', Carbon::today())->with(['plan'])->where('is_move',0)->sortable()->orderBy('id', 'desc');
            if ($request->get('keyword')) {
                $keyword = $request->get('keyword');
                $query->whereHas('plan', function ($q) use ($keyword) {
                    $q->where('title', 'LIKE', '%' . $keyword . '%');
                });
            }
            if ($request->query('from') && $request->get('to')) {
                $from_date = Carbon::createFromFormat('Y-m-d', $request->get('from'))->format('Y-m-d').' 00:00:00';
                $end_date = Carbon::createFromFormat('Y-m-d', $request->get('to'))->format('Y-m-d').' 23:59:59';
                $query->whereBetween('created_at', array($from_date, $end_date));
            } else if ($request->get('from')) {
                $date = Carbon::createFromFormat('Y-m-d', $request->get('from'))->format('Y-m-d').' 00:00:00';
                $query->whereDate('created_at', '=', $date);
            } else if ($request->get('to')) {
                $date = Carbon::createFromFormat('Y-m-d', $request->get('to'))->format('Y-m-d').' 00:00:00';
                $query->whereDate('created_at', '=', $date);
            }
            $result = $query->paginate($this->limit);
            
            return $this->sendResponse(($this->__paginate(OrderResource::collection($result), $result)), __('Data was retrieved successfully.'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

     /**
     * Get order detail
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(int $id, Request $request)
    {
        try {
            $user = Auth::user();
            $data = $this->order->where('user_id',$user->id)->with(['plan'])->where('id',$id)->first();
            $planLog = $this->planLog->where('plan_id',$data->plan_id)->orderBy('id', 'DESC')->limit(15)->get();
            $profitChart = $this->graph($data->plan_id,1);
            $lossChart = $this->graph($data->plan_id,0);
            $statement = Statement::where('user_id',$user->id)->where('plan_id',$data->id)->orderBy('id', 'desc')->get();
            OrderDetailsResource::planLog($statement);
            OrderDetailsResource::profitChart($profitChart);
            OrderDetailsResource::lossChart($lossChart);
            return $this->sendResponse(new OrderDetailsResource($data), 'Data was retrieved successfully.');
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
                $itemData['plPercent'] = number_format(0,2,'.', '');
                $itemData['date'] = $val;
                $resultData[] = isset($data[$val]) ? $data[$val] :$itemData;
            }
           return $resultData;
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
}
