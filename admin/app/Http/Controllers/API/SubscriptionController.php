<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\Subscription;
use App\Order;
use App\wallet;
use App\SubscriptionRedeem;
use Auth;
use App\User;
use App\PlanLog;
use App\SetRedeemAmount;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Subscription as SubscriptionResource;
use App\Http\Resources\SubscriptionHolding as SubscriptionHoldingResource;
use App\Http\Resources\OrderDetailsResource as OrderDetailsResource;
use App\Http\Resources\Statement as StatementResource;
use Exception;
use App\Manager\NotificationManager;
use App\Exports\SubscriptionRedeemExport;
use App\SubscriptionHolding;
use App\Statement;
use Session,Excel;


class SubscriptionController extends BaseController
{
     

    /** @var  Limit */
    private $limit;

     /** @var  User */
     private $user;

     /** @var  NotificationManager */
     private $notification;

     /** @var  wallet */
    private $wallet;

    /** @var  Subscription */
    private $subscription;

    /** @var  Order */
    private $order;

    /** @var  SubscriptionRedeem */
    private $subscriptionRedeem;

    /** @var  SetRedeemAmount */
    private $setRedeemAmount;

     /** @var  SubscriptionHolding */
     private $subscriptionHolding;

      /** @var  PlanLog */
    private $planLog;

    /** @var  Statement */
    private $statement;



    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Statement $statement, PlanLog $planLog, SubscriptionHolding $subscriptionHolding, SetRedeemAmount $setRedeemAmount, SubscriptionRedeem $subscriptionRedeem, Order $order, Subscription $subscription, User $user, NotificationManager $NotificationManager,wallet $wallet)
    {
        $this->subscription = $subscription;
        $this->limit = Helper::setting()->admin_limit;
        $this->user = $user;
        $this->notification = $NotificationManager;
        $this->wallet = $wallet;
        $this->order = $order;
        $this->subscriptionRedeem = $subscriptionRedeem;
        $this->setRedeemAmount = $setRedeemAmount;
        $this->subscriptionHolding = $subscriptionHolding;
        $this->planLog = $planLog;
        $this->statement = $statement;
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
            $query = $this->subscription->where('user_id',$user->id)->with(['plan','redeemAmount'])->sortable()->orderBy('id', 'desc');
            if ($request->query('keyword')) {
                $name = $request->query('keyword');
                $query->where('title', 'LIKE', '%' . $name . '%');
            }
            $result = $query->paginate($this->limit);
            $totalInvested = 0;
            $currentInvested = 0;
            $pl_amount = 0;
            $pl_percentage = 0;
            foreach($result as $key => $value){
                 
                $currentInvested += ($value->qty * $value->plan->planStatus->current_balance);
                $totalInvested += ($value->qty * $value->amount);

                $currentInvestedC = ($value->qty * $value->plan->planStatus->current_balance);
                $totalInvestedC = ($value->qty * $value->amount);

                if($totalInvestedC != 0 && $currentInvestedC != 0){
                    $pl_amount_c = ($currentInvestedC - $totalInvestedC);
                    $pl_percentage_c = ($pl_amount_c/$totalInvestedC)*100;
                    $value->update([
                        'name'=>$value->plan->title,
                        'pl_amount'=>number_format($pl_amount_c,'.', ''),
                        'pl_percentage'=>number_format($pl_percentage_c,'.', '')
                    ]);
                }else{
                    $value->update([
                        'name'=>$value->plan->title,
                        'pl_amount'=>0,
                        'pl_percentage'=>0
                    ]);
                }
                
            }
            $pl_amount = ($currentInvested - $totalInvested);
            $pl_percentage = 0;
            
            if($result->count() != 0){
                if($pl_amount != 0 && $totalInvested != 0){
                    $pl_percentage = ($pl_amount/$totalInvested)*100;
                }
                
            }
            
            $resultData['totalInvested'] = number_format($totalInvested,2,'.', '');
            $resultData['currentInvested'] = $currentInvested > 0 ? '+'.number_format($currentInvested,2,'.', '') :number_format($currentInvested,2,'.', '');
            $resultData['pl_amount'] = $pl_amount > 0 ? '+'.number_format($pl_amount,2,'.', '') :number_format($pl_amount,2,'.', '');
            $resultData['pl_percentage'] = $pl_percentage > 0 ? '+'.number_format($pl_percentage,2,'.', '').'%' :number_format($pl_percentage,2,'.', '').'%';
            $resultData['data'] = $this->__paginate(SubscriptionResource::collection($result),$result);
             
            return $this->sendResponse($resultData, __('Data was retrieved successfully.'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * redeem plan amount
     * 
     * @return \Illuminate\Http\Response
     */
    public function redeem(Request $request){
        try {
            $user = Auth::user();
            $data = $this->subscription->where('user_id',$user->id)->where('plan_id',$request->plan_id)->sum('qty');
            if($data != 0 && $data >= $request->qty){
                $subscription = $this->subscription->where('user_id',$user->id)->with(['plan'])->where('plan_id',$request->plan_id)->first();
                $currentAmount = $subscription->plan->planStatus->current_balance * $request->qty;
                
                
                /**
                 * Save data on subscriptionRedeem
                 */
                $realized = ($subscription->plan->planStatus->current_balance*$request->qty) - ($subscription->plan->amount * $request->qty);
                $setting = Helper::setting();
                $commission = 0;
                if($realized != 0){
                    $commission = ($setting->commission / 100) * $realized;
                }
                
                $sebi = ($setting->sebi / 100) * $realized;
                $sgst = ($setting->sgst / 100) * $realized;
                $stamp_duty = ($setting->stamp_duty / 100) * $realized;
                $stt = ($setting->stt / 100) * $realized;
                $igst = ($setting->igst / 100) * $realized;
                $cgst = ($setting->cgst / 100) * $realized;
                $exchange_transaction_tax = ($setting->exchange_transaction_tax / 100) * $realized;
                $total_charges = ($setting->planform_fee + $commission + $sebi + $sgst + $stamp_duty + $stt + $igst + $cgst + $exchange_transaction_tax);
                $final_pl = ($realized - $total_charges);
                
                $subscriptionRedeemData = $this->subscriptionRedeem;
                $subscriptionRedeemData->user_id = $user->id;
                $subscriptionRedeemData->amount = $subscription->plan->planStatus->current_balance;
                $subscriptionRedeemData->plan_id = $request->plan_id;
                $subscriptionRedeemData->qty = $request->qty;
                $subscriptionRedeemData->remark = "Subscription Redeem";
                $subscriptionRedeemData->status = 1;
                $subscriptionRedeemData->type = 2;
                $subscriptionRedeemData->realized = $realized;
                $subscriptionRedeemData->planform_fee = $setting->planform_fee;

                $subscriptionRedeemData->commission = $commission;
                $subscriptionRedeemData->sebi = $sebi;
                $subscriptionRedeemData->sgst = $sgst;
                $subscriptionRedeemData->stamp_duty = $stamp_duty;
                $subscriptionRedeemData->stt = $stt;
                $subscriptionRedeemData->igst = $igst;
                $subscriptionRedeemData->cgst = $cgst;
                $subscriptionRedeemData->exchange_transaction_tax = $exchange_transaction_tax;
                $subscriptionRedeemData->total_charges = $total_charges;
                $subscriptionRedeemData->final_pl = $final_pl;
                $subscriptionRedeemData->save();

                /**
                 * Save data on wallet
                 */
                $amount = 0;
                $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
                if($walletData){
                    $amount =  $walletData->closing_bal; 
                }
                $data = $this->wallet;
                $data->user_id = $user->id;
                $data->amount = $final_pl;
                $data->transaction_id = 0;
                $data->type = 1;
                $data->closing_bal = $final_pl + $amount;
                $data->remark = "Plan Redeem";
                $data->save();

                /**
                 * update subscription
                 */
                $this->subscription->where('id',$subscription->id)->update(['qty'=>$subscription->qty - $request->qty]);

                /**
                 * Send email for user
                 */
                $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
                $meassge = trans('message.WALLET_AMOUNT_USER',['TOTAL_AMOUNT'=>number_format($final_pl + $amount,2,'.', ''),'AMOUNT'=>number_format($currentAmount,2,'.', '')]);
                $this->notification->send($user,route('admin.customer'),$ACCOUNT_STATUS,$meassge);

                 /**
                 * Send Email for admin
                 */
                $adminUser = $this->user->findOrFail(1);
                $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
                $meassge = trans('message.USER_WALLET_AMOUNT',['NAME'=>ucfirst($user->first_name),'AMOUNT'=>number_format($final_pl,2,'.', '')]);
                $this->notification->send($adminUser,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
                return $this->sendResponse(number_format($final_pl + $amount,2,'.', ''), 'Data was retrieved successfully.');

            }else{
                return $this->sendError(trans('message.WRONG'));
            } 
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get my statement
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function statement(Request $request){
        try{
            $user = Auth::user();
            $query = $this->statement->where('user_id',$user->id)->orderBy('id', 'desc');
            if ($request->get('start_date') && $request->get('end_date')) {
                $from_date = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->format('Y-m-d').' 00:00:00';
                $end_date = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->format('Y-m-d').' 23:59:59';
                $query->whereBetween('created_at', array($from_date, $end_date));
            }
            $result = $query->paginate($this->limit);
            return $this->sendResponse(StatementResource::collection($result), __('Data was retrieved successfully.'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Excel
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function excel(Request $request){
        try{
            $user = Auth::user();
            $redeemQuery = $this->statement->where('user_id',$user->id)->orderBy('id', 'desc');
            if ($request->get('start_date') && $request->get('end_date')) {
                $from_date = Carbon::createFromFormat('Y-m-d', $request->get('start_date'))->format('Y-m-d').' 00:00:00';
                $end_date = Carbon::createFromFormat('Y-m-d', $request->get('end_date'))->format('Y-m-d').' 23:59:59';
                $redeemQuery->whereBetween('created_at', array($from_date, $end_date));
            }
            $redeemResult = $redeemQuery->get();
            if($redeemResult->count()){
                Excel::store(new SubscriptionRedeemExport($user->id,$request), "statement/".$user->id.'.xlsx','public'); 
                $file = Helper::getImageUrl("statement/".$user->id.'.xlsx');
                return $this->sendResponse($file, __('Data was retrieved successfully.'));
            }else{
                return $this->sendResponse("",__('Data not found'));
            }
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * 
     * set Redeem Amount
     */
    public function setRedeem(Request $request){
        try{
            $subscription = $this->subscription->where('id',$request->subscription_id)->where('qty','!=',0)->first();
            if($subscription){
                $user = Auth::user();
                $data = $this->setRedeemAmount->where('user_id',$user->id)->where('plan_id',$request->plan_id)->first();
                if(empty($data)){
                    $data = $this->setRedeemAmount;
                    $data->qty = $request->qty;
                }else{
                    $data->qty = $request->qty + $data->qty;
                }
                $data->user_id = $user->id;
                $data->plan_id = $request->plan_id;
                $data->amount = $request->amount;
                $data->save();
                $this->subscription->where('id',$request->subscription_id)->update(['qty'=>$subscription->qty - $request->qty ]);
                return $this->sendResponse(true, 'Data saved successfully.');
            }else{
                return $this->sendError('You have already set redeem amount');
            }
             
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * cancelRedeem
     */
    public function cancelRedeem(Request $request){
        $data = $this->setRedeemAmount->where('id',$request->redeem_amount_id)->first();
        if($data){
            $user = Auth::user();
            $subscription = $this->subscription->where('user_id',$user->id)->where('plan_id',$data->plan_id)->first();
            $this->subscription->where('id',$subscription->id)->update(['qty'=>$data->qty]);
            $this->setRedeemAmount->where('id',$request->redeem_amount_id)->delete();
            return $this->sendResponse(true, 'Data saved successfully.');
        }else{
            return $this->sendError('Sorry we have not found any data');  
        }
    }

    /**
     * Get holding list
     *
     * @return \Illuminate\Http\Response
     */
    public function holding(Request $request)
    {
        try {
            $user = Auth::user();
            $query = $this->order->where('user_id',$user->id)->with(['plan'])->with('statement')->where('is_move',0)->where('is_pms',1)->sortable()->orderBy('id', 'desc');
            $totalPl = $this->statement->where('user_id',$user->id)->where('is_move',0)->sum('pl');

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
            $totalInvested = 0;
            $pl_percentage = 0;
            $currentInvested = 0;
            $charges = 0;
            foreach($result as $key => $value){
                $totalInvested += ($value->amount);
            }
            $currentInvested = $totalPl + $totalInvested;

            $totalInvested = Statement::where('user_id',$user->id)->where('is_pay',0)->sum('invested');;
            $currentInvested = Statement::where('user_id',$user->id)->where('is_pay',0)->sum('pl');
            
            if($totalInvested != 0){
                $charges = number_format(($totalPl/$totalInvested)*100,2);
            }
           
            $resultData['totalInvested'] = number_format($totalInvested,2);
            $resultData['currentInvested'] = $totalInvested <= $totalPl || $totalPl == 0 ? '+'.number_format($totalInvested + $currentInvested,2) :number_format($totalInvested + $currentInvested,2);
            $resultData['PL'] = $totalInvested <= $totalPl || $totalPl == 0 ? '+'.number_format($totalPl,2) :number_format($totalPl,2);
            $resultData['charges'] = $charges >= 0 ?"+".$charges.'%':$charges.'%';
            $resultData['color'] = $charges >= 0 ?true:false;
            $resultData['data'] = $this->__paginate(SubscriptionHoldingResource::collection($result),$result);
           
            return $this->sendResponse($resultData, __('Data was retrieved successfully.'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get position listing 
     * 
     */
    public function position(Request $request){
        try {
            $user = Auth::user();
            $query = $this->order->where('user_id',$user->id)->with(['plan','planlogs'])->where('is_move',0)->where('is_pms',1)->sortable()->orderBy('id', 'desc');
            if ($request->query('keyword')) {
                $name = $request->query('keyword');
                $query->where('title', 'LIKE', '%' . $name . '%');
            }
            $result = $query->paginate($this->limit);
            $totalPl = Statement::where('user_id',$user->id)->where('is_move',0)->sum('pl');
            $totalInvested = Statement::where('user_id',$user->id)->where('is_move',0)->sum('invested');
            
            $resultData['totalPl'] = $totalInvested <= $totalPl || $totalPl >= 0 ?'+'.number_format($totalPl,2, '.', ''):number_format($totalPl,2,'.', '');
            $resultData['data'] = $this->__paginate(SubscriptionResource::collection($result),$result);
            return $this->sendResponse($resultData, __('Data was retrieved successfully.'));
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

            OrderDetailsResource::planLog($planLog);
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
            
            $now = Carbon::now();
            $resultData = [];
            $startDate = $now->startOfWeek()->format('Y-m-d H:i');
            $endDate = $now->endOfWeek()->format('Y-m-d H:i');
            for ($i = 0; $i < 7; $i++) {
                $day[] = $now->startOfWeek()->addDays($i)->format('d-M');
            }
            $query = $this->planLog->where('plan_id',$id)->where('type',$type)->whereBetween('created_at', array($startDate, $endDate))->sortable()->orderBy('id', 'desc');
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
                        $plPercent += $item['pl_p'];
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
