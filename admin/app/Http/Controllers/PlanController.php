<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Plan;
use App\PlanLog;
use App\Tag;
use App\User;
use App\wallet;
use App\Category;
use App\Http\Requests\PlanRequest;
use App\Manager\UploadManager;
use App\Constants\Constant;
use App\Manager\CacheManager;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Order;
use App\Charts\UserChart;
use App\Charts\PlanChart;
use App\Manager\NotificationManager;
use DB;
use App\SubscriptionHolding;
use App\Statement;
 

class PlanController extends Controller
{

    /** @var  Limit */
    private $limit;

    /** @var  Order */
    private $order;

    /** @var  PlanLog */
    private $planlog;

    /** @var  User */
    private $user;

    /** @var  NotificationManager */
    private $notification;

    /** @var  SubscriptionHolding */
    private $subscriptionHolding;

    /** @var  Statement */
    private $statement;

    /** @var  wallet */
    private $wallet;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(wallet $wallet, Statement $statement, SubscriptionHolding $subscriptionHolding, NotificationManager $NotificationManager, User $user, PlanLog $planlog, Order $order, Plan $plan,CacheManager $cacheManager, Tag $tag, Category $category)
    {
        $this->limit = Helper::setting()->admin_limit;
        $this->plan = $plan;
        $this->tag = $tag;
        $this->category = $category;
        $this->cache = $cacheManager;
        $this->order = $order;
        $this->planlog = $planlog;
        $this->user = $user;
        $this->notification = $NotificationManager;
        $this->subscriptionHolding = $subscriptionHolding;
        $this->statement = $statement;
        $this->wallet = $wallet;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = __('Plans');
        $plan = $this->plan;
        $planData = $this->plan->sortable()->with(['orderList'])->orderBy('position', 'asc');
        if ($request->query('status')) {
            $status = $request->query('status');
            if($status == 2){
                $status = 0;
            }
            $planData->where('status',$status);
        }
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $planData->where('title', 'LIKE', '%' . $keyword . '%');
        }
        $data = $planData->paginate($this->limit);
        $data->appends($request->query());
        $plan = $request->query();
       
        return view('admin.plan.index', compact('title', 'data', 'request', 'plan'));
    }

    /**
     * @method get
     *
     * plan
     */
    public function add()
    {
        $title = __('Add New Plan');
        $plan = $this->plan;
        $tag = $this->tag->where('status',1)->pluck('name','id');
        $category = $this->category->where('status',1)->with(['detail'])->get()->pluck('detail.name','id');
        return view('admin.plan.add', compact('title', 'plan','tag','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(PlanRequest $request)
    {
        $data = $this->plan;
        $plan = new PlanLog();
        if (!empty($request->get('id'))) {
            $data = $this->plan->findOrFail($request->get('id'));
            $data->closing_balance = $request->get('closing_balance');
            $plan->pre_closing_balance = $data->amount;
            if($data->closing_balance != $request->get('closing_balance')){
                $plan->pre_closing_balance = $data->closing_balance;
            }
            $plan->current_balance = $request->get('closing_balance');
        }else{
            $data->opening_balance = $request->get('amount');
            $data->closing_balance = $request->get('closing_balance');
            $plan->pre_closing_balance = $request->get('amount');
            $plan->current_balance = $request->get('amount');
            $plan->closing_balance = 0;
            $plan->earningPerShare = 0;
            $plan->change = 0;

        }
        $data->title = $request->get('title');
        $data->amount = $request->get('amount');
        $data->min_qty = $request->get('min_qty');
        $data->qty = $request->get('qty');
        $data->type = $request->get('type');
        $data->start_time = $request->get('start_time');
        $data->end_time = $request->get('end_time');
        $data->description = $request->get('description');
        $data->market_cap = 0;
        $data->save();
        $data->tag()->sync($request->tag);
        $data->category()->sync($request->category);
        $this->cache->clear('App\Plan');
        if($request->get('type') == 1 || $request->get('type') == 2){
            $plan->plan_id = $data->id;
            $plan->save();
        }
        

        if (!empty($request->get('id'))) {
            return redirect()->route('admin.plan')->with('success', __('Record has been updated successfully'));
        }
        return redirect()->route('admin.plan')->with('success', __('Record has been added successfully'));
    }

    /**
     * Edit
     * @param $id
     * @method get
     *
     */
    public function edit ($id){
        $title = __('Edit Plan');
        $plan = $this->plan->findOrFail(Helper::decode($id));
        $tag = $this->tag->where('status',1)->pluck('name','id');
        $category = $this->category->where('status',1)->with(['detail'])->get()->pluck('detail.name','id');  
        return view('admin.plan.edit',compact('title','plan','tag','category'));
    }

   /**
     * update status
     * @param $id
     * @param $status
    */
    public function process($id,$status,Request $request){
        $plan = $this->plan->findOrFail(Helper::decode($id));
        $plan->update(['status'=>Constant::ITEM_STATUS_SHOW[$request->get('status')]]);
        return true;
    }

    /**
     * Delete
     * @param $id
     * @method get
     *
     */
    public function delete($id){
        $plan = $this->plan->findOrFail(Helper::decode($id));
        $plan->delete();
        return  redirect()->back()->with('success', __('Record has been deleted sucessfully'));
    } 

    /**
     * sortable
     * @method sortable
     */
    public function sortable(){
        $title = __('plans');
        $data = $this->plan->sortable()->orderBy('position', 'asc')->get();
        return view('admin.plan.sortable', compact('title','data'));
    }

    /**
     * sortableSave
     *
     * @method post
     */
    public function sortableSave(Request $request){
        $data = json_decode($request->get('data'));
        $i = 1;
        foreach($data as $key => $val){
            $this->plan->where('id',$val->id)->update(['position'=>$i]);
            $i++;
        }
        return true;
    }

    /**
     * view
     * @param $id
     * @method get
     *
     */
    public function view (Request $request, $id){
        $title = __('Plan View');
        $planData = $this->plan;
        $plan = $this->plan->findOrFail(Helper::decode($id));
        $totalSale = $this->order->where('plan_id',$plan->id)->sum('qty');
        $orderData = $this->order->where('plan_id',$plan->id)->with(['user'])->sortable()->orderBy('id', 'desc');

        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $orderData->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            });
        }

        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $orderData->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $orderData->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $orderData->whereDate('created_at', '=', $date);
        }
                               
        $data = $orderData->paginate($this->limit);
        $data->appends($request->query());
        $planData = $request->query();

        /**
         * week
         */
        $now = Carbon::now();
        $startDate = $now->startOfWeek()->format('Y-m-d H:i');
        $endDate = $now->endOfWeek()->format('Y-m-d H:i');
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $dateRange = CarbonPeriod::create($from_date, $end_date)->toArray();
            foreach($dateRange as $key => $val){
               $day[] = $val->format('d-M');
           }
           $startDate = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
           $endDate = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
        }else{
            for ($i = 0; $i < 7; $i++) {
                $day[] = $now->startOfWeek()->addDays($i)->format('d-M');
            }
        }
        $query = $this->planlog->where('plan_id',$plan->id)->whereBetween('created_at', array($startDate, $endDate))->sortable()->orderBy('id', 'desc');
        $result = $query->paginate(30)->groupBy(function ($item) {
            return $item->created_at->format('d-M');
        })->toArray();
        $logData = [];
        if($result){
            foreach($result as $key => $val){
                $amount=0;
                foreach($val as $itemKey => $item){
                    $amount += $item['current_balance'];
                }
                $logData[$key] = number_format($amount,2); 
            }
        }
       
        foreach($day as $key => $val){
            $resultData[] = isset($logData[$val]) ? $logData[$val] :number_format(0,2);
        }
       
        /**
         * Line Chart Users
         */
        $date = Carbon::now();
        $chart = new UserChart;
        $chart->title('Current Week Records');
        $chart->labels($day);
        $chart->dataset('Closing Balance', 'line', $resultData)->options([
            'fill' => true,
            'color' =>'#FFC107',
            'borderColor' => '#FFC107'
        ]);
        $closingBal = $this->planlog->where('plan_id',$plan->id)->orderBy('id','desc')->first();
         
        return view('admin.plan.view', compact('title', 'data', 'request', 'plan','totalSale','planData','chart','closingBal'));
         
    }

     /**
     * update plan close 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function closingBalance(Request $request){

        $data = $this->plan->findOrFail($request->id);
        $plan = PlanLog::where('plan_id',$data->id)->whereDate('created_at', Carbon::today())->first();
        if(empty($plan)){
            $plan = new PlanLog();
        }
        $plan->pre_closing_balance = $data->closing_balance;
        $data->closing_balance = $request->point;
        $data->save();
        $plan->current_balance = $request->point;
        $plan->plan_id = $data->id;
        $plan->save();
        return  redirect()->back()->with('success', __('Closing has been updated sucessfully'));
    }

    /**
     * update plan profit
     * 
     * @return \Illuminate\Http\Response 
     */
    public function addProfit(Request $request){
       
        $data = $this->plan->findOrFail($request->id);
        $currentAmount = $data->amount;
        $totalOrder = $this->order->where('plan_id',$data->id)->where('type',1)->where('is_pms',1)->sum('amount');
        $orderList = $this->order->where('plan_id',$data->id)->where('type',1)->where('is_pms',1)->get();
        
        $plAmount = $request->point;
        $earningPerShare = 0;
        $change = 0;
        if($totalOrder){
            $totalSupply = round($totalOrder/$data->amount,2);
            $earningPerShare = round($plAmount/$totalSupply,2);
            $currentPrice = $earningPerShare + $data->amount;
            $change = round(($earningPerShare/$data->amount)*100,2);
        }
         
        /**
         * Find P&L
         */
        $data->closing_balance = $earningPerShare;
        $data->earningPerShare = $earningPerShare;
        if($earningPerShare < $currentAmount){
            $data->closing_balance = $earningPerShare;
            $data->earningPerShare = $earningPerShare;  
        }
        $data->change = $change;
        $data->pl = $request->point;
        $data->save();
        
        $plan = PlanLog::where('plan_id',$data->id)->whereDate('created_at', Carbon::today())->first();
        if(empty($plan)){
            $plan = new PlanLog();
        }

        $plan->current_balance = $request->point;
        $plan->pre_closing_balance = $request->point;
        $plan->pl = $earningPerShare;
        
        $plan->pl_p = $change;
        $plan->type = 1;
        $plan->plan_id = $data->id;
        $plan->save();
        $setting = Helper::setting();

        foreach($orderList as $key => $val){
            $unrealisedProfit = ($earningPerShare *$val->qty);
            $commission = ($unrealisedProfit*$setting->commission)/100;
            $platformFee = $setting->planform_fee;
            $totalTaxes = (($commission*$setting->exchange_transaction_tax)/100)+(($platformFee*$setting->exchange_transaction_tax)/100)+(($unrealisedProfit*1)/100);
            $totalCommission = $commission+$platformFee+$totalTaxes;
            $expense = round(($totalCommission/$unrealisedProfit)*100,2);
            $realisedProfit = round(($unrealisedProfit - $totalCommission),2);
            $profitChange = round(($realisedProfit/$val->amount)*100,2);
             
            $subscriptionHolding = SubscriptionHolding::where('user_id',$val->user_id)->where('plan_id',$val->plan_id)->where('is_pay',0)->whereDate('created_at', Carbon::today())->first();
            if(empty($subscriptionHolding)){
                $subscriptionHolding = new SubscriptionHolding();
            }
            $subscriptionHolding->user_id = $val->user_id;
            $subscriptionHolding->plan_id = $val->plan_id;
            $subscriptionHolding->qty = $val->qty;
            $subscriptionHolding->amount = $earningPerShare;
            $subscriptionHolding->totalAmount = $earningPerShare *$val->qty;
            $subscriptionHolding->pl = $unrealisedProfit;
            $subscriptionHolding->commission = $commission;
            $subscriptionHolding->platform_fee = $platformFee;
            $subscriptionHolding->total_tax = $totalTaxes;
            $subscriptionHolding->total_commission = $totalCommission;
            $subscriptionHolding->expense = $expense;
            $subscriptionHolding->realised_profit = $realisedProfit;
            $subscriptionHolding->profit_change = $profitChange;
            $subscriptionHolding->save();

            /**
             * user Statement
             */
            $statement = Statement::where('user_id',$val->user_id)->where('plan_id',$val->plan_id)->where('is_pay',0)->whereDate('created_at', Carbon::today())->first();
            //pr($statement); die;
            if(empty($statement)){
                $statement = new Statement();
            }
            

            $preStatement = Statement::where('user_id',$val->user_id)->where('plan_id',$val->plan_id)->where('is_pay',0)->orderBy('id', 'desc')->first();
            $statement->user_id = $val->user_id;
            $statement->plan_id = $val->plan_id;

            $buy_avg = $currentAmount;
            $sell_avg = $currentAmount + $earningPerShare;
            $amount_chg = ($sell_avg - $buy_avg);
            $chg = ($amount_chg/$buy_avg)*100;
            $qty = $val->qty;
            $pl = ($val->qty*$amount_chg);
            $invested = $currentAmount *$qty;
            $current_value = $qty*$sell_avg;
            $PL_balance = $pl;
            $capital_balance = $invested+$pl;
            if(!empty($statement) && isset($statement->capital_balance)){
                if($statement->created_at->format('Y-m-d') != Carbon::today()->format('Y-m-d')){
                    $PL_balance = $PL_balance + $statement->PL_balance;
                    $capital_balance = $statement->capital_balance+$pl;
                }
            }
            $commission = ($pl*$setting->commission)/100;;
            $platform_fee = $setting->planform_fee;
            $total_commission = ($commission+($commission*$setting->exchange_transaction_tax)/100)+($platform_fee+($platform_fee*$setting->exchange_transaction_tax)/100)+(($pl*1)/100);
            $realised_profit = $pl-$total_commission;
            if(!empty($statement) && isset($statement->capital_balance)){
                if($statement->created_at->format('Y-m-d') != Carbon::today()->format('Y-m-d')){
                    $realised_profit = $statement->realised_profit+($pl-$total_commission);
                }
            }

            $statement->buy_avg = $buy_avg;
            $statement->sell_avg = $sell_avg;
            $statement->amount_chg = $amount_chg;
            $statement->chg = $chg;
            $statement->qty = $qty;
            $statement->pl = $pl;
            $statement->invested = $invested;
            $statement->current_value = $current_value;
            $statement->PL_balance = $PL_balance;
            $statement->capital_balance = $capital_balance;
            $statement->commission = $commission;
            $statement->platform_fee = $platform_fee;
            $statement->total_commission = $total_commission;
            $statement->realised_profit = $realised_profit;
             
            $statement->save();
        }

        return  redirect()->back()->with('success', __('Profit has been updated sucessfully'));
    }

    /**
     * update plan profit
     * 
     * @return \Illuminate\Http\Response 
     */
    public function addLoss(Request $request){
       
        $data = $this->plan->findOrFail($request->id);
        $totalOrder = $this->order->where('plan_id',$data->id)->where('type',1)->where('is_pms',1)->sum('amount');
        
        $plAmount = "-".$request->point;
        $earningPerShare = 0;
        $change = 0;
        if($totalOrder){
            $totalSupply = round($totalOrder/$data->amount,2);
            $earningPerShare = round($plAmount/$totalSupply,2);
            $currentPrice = $earningPerShare + $data->amount;
            $change = round(($earningPerShare/$data->amount)*100,2);
        }
        $currentAmount = $data->amount;
       
        /**
        * Find P&L
        */
       $data->closing_balance = $earningPerShare;
       $data->earningPerShare = $earningPerShare;
       $data->change = $change;
       $data->pl = $plAmount;
       $data->save();
      
        $plan = PlanLog::where('plan_id',$data->id)->whereDate('created_at', Carbon::today())->first();
        if(empty($plan)){
            $plan = new PlanLog();
        }
        $plan->current_balance = $request->point;
        $plan->pre_closing_balance = $request->point;
        $plan->pl = $earningPerShare;
        $plan->pl_p = $change;
        $plan->type = 0;
        $plan->plan_id = $data->id;
        $plan->save();
        $setting = Helper::setting();

        /**
         * check user data
         */
        
        $orderList = $this->order->where('plan_id',$data->id)->with(['wallet'])->where('type',1)->where('is_pms',1)->get();
        foreach($orderList as $key => $val){

            $unrealisedProfit = ($earningPerShare *$val->qty);
             
            $commission = 0;
            //$platformFee = $setting->planform_fee;
            $platformFee = 0;
            //$totalTaxes = (($commission*$setting->exchange_transaction_tax)/100)+(($platformFee*$setting->exchange_transaction_tax)/100)+(($unrealisedProfit*1)/100);
            $totalTaxes = 0;
           // $totalCommission = $commission+$platformFee+$totalTaxes;
            $totalCommission = 0;
            $expense = round(($totalCommission/$unrealisedProfit)*100,2);
            $realisedProfit = round(($unrealisedProfit - $totalCommission),2);
            $profitChange = round(($realisedProfit/$val->amount)*100,2);
            $subscriptionHolding = SubscriptionHolding::where('user_id',$val->user_id)->where('plan_id',$val->plan_id)->where('is_pay',0)->whereDate('created_at', Carbon::today())->first();
            if(empty($subscriptionHolding)){
                $subscriptionHolding = new SubscriptionHolding();
            }
            $subscriptionHolding->user_id = $val->user_id;
            $subscriptionHolding->plan_id = $val->plan_id;
            $subscriptionHolding->qty = $val->qty;
            $subscriptionHolding->amount = $earningPerShare;
            $subscriptionHolding->totalAmount = $earningPerShare *$val->qty;
            $subscriptionHolding->pl = $unrealisedProfit;
            $subscriptionHolding->commission = $commission;
            $subscriptionHolding->platform_fee = $platformFee;
            $subscriptionHolding->total_tax = $totalTaxes;
            $subscriptionHolding->total_commission = $totalCommission;
            $subscriptionHolding->expense = $expense;
            $subscriptionHolding->realised_profit = $realisedProfit;
            $subscriptionHolding->profit_change = $profitChange;
            $subscriptionHolding->save();

            /**
            * user Statement
            */
            $statement = Statement::where('user_id',$val->user_id)->where('plan_id',$val->plan_id)->where('is_pay',0)->whereDate('created_at', Carbon::today())->first();
            if(empty($statement)){
                $statement = new Statement();
            }
            $preStatement = Statement::where('user_id',$val->user_id)->where('plan_id',$val->plan_id)->where('is_pay',0)->orderBy('id', 'desc')->first();
            $statement->user_id = $val->user_id;
            $statement->plan_id = $val->plan_id;

             
            $buy_avg = $currentAmount;
            $sell_avg = $earningPerShare;
            $amount_chg = ($earningPerShare);
             
            $chg = ($amount_chg/$buy_avg)*100;
            $qty = $val->qty;
            $pl = ($val->qty*$amount_chg);
            $invested = $currentAmount *$qty;
            $current_value = $qty*$sell_avg;
            $PL_balance = $pl;
            $capital_balance = $invested+$pl;
             
            if(!empty($statement) && isset($statement->capital_balance)){
                if($statement->created_at->format('Y-m-d') != Carbon::today()->format('Y-m-d')){
                    $PL_balance = $PL_balance + $preStatement->PL_balance;
                    $capital_balance = $preStatement->capital_balance+$pl;
                } 
            }
            
            $commission = 0;
            $total_commission = 0;
            $platform_fee = 0;
            //$platform_fee = $setting->planform_fee;
            //$total_commission = ($commission+($commission*$setting->exchange_transaction_tax)/100)+($platform_fee+($platform_fee*$setting->exchange_transaction_tax)/100)+(($pl*1)/100);
            $realised_profit = $pl-$total_commission;
            if(!empty($statement) && isset($statement->capital_balance)){
                if($statement->created_at->format('Y-m-d') != Carbon::today()->format('Y-m-d')){
                    $realised_profit = $preStatement->realised_profit+($pl-$total_commission);
                } 
            }
            
            $statement->buy_avg = $buy_avg;
            $statement->sell_avg = $sell_avg;
            $statement->amount_chg = $amount_chg;
            $statement->chg = $chg;
            $statement->qty = $qty;
            $statement->pl = $pl;
            $statement->invested = $invested;
            $statement->current_value = $current_value;
            $statement->PL_balance = $PL_balance;
            $statement->capital_balance = $capital_balance;
            $statement->commission = $commission;
            $statement->platform_fee = $platform_fee;
            $statement->total_commission = $total_commission;
            $statement->realised_profit = $realised_profit;
             
            $statement->save();

            $profitChange = round(($realisedProfit/$val->amount)*100,2);
            if(isset($value->wallet->amount)){ 
                if($capital_balance < 0){

                    $this->order->where('id',$value->id)->update(['is_pms'=>0,'remark'=>'PMS Auto stop, beacuse your wall amount is very low']);
                    $this->order->where('user_id',$value->user_id)->where('plan_id',$value->plan_id)->update(['type'=>2,'is_pms'=>0]);
                    $this->subscriptionHolding->where('user_id',$user->id)->where('plan_id',$value->plan_id)->update(['is_pay'=>1]);
                    $this->statement->where('user_id',$user->id)->where('plan_id',$value->plan_id)->update(['is_pay'=>1]);

                    $data = new wallet();
                    $data->user_id = $value->user_id;
                    $data->amount = $realised_profit + $value->wallet->closing_bal;
                    $data->transaction_id = 0;
                    $data->type = 1;
                    $data->closing_bal = $realised_profit + $value->wallet->closing_bal;
                    $data->remark = "PMS Auto stop, beacuse your wall amount is very low";
                    $data->save();
                    $user = $this->user->where('id',$value->user_id)->first();

                     /**
                     * Send email for user
                     */
                    $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
                    $meassge = trans('message.WALLET_AMOUNT_USER',['TOTAL_AMOUNT'=>number_format($userAmount + $value->wallet->closing_bal,2),'AMOUNT'=>number_format($userAmount + $value->wallet->closing_bal,2)]);
                    $this->notification->send($user,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
                }
            }
        }
        return  redirect()->back()->with('success', __('Loss has been updated sucessfully'));
    }

    /**
     * view
     * @param $id
     * @method get
     *
     */
    public function viewPMS (Request $request, $id){
        $title = __('Plan View');
        $planData = $this->plan;
        $plan = $this->plan->findOrFail(Helper::decode($id));

        /**
         * week
         */
        $now = Carbon::now();
        $startDate = $now->startOfWeek()->format('Y-m-d H:i');
        $endDate = $now->endOfWeek()->format('Y-m-d H:i');

        for ($i = 0; $i < 7; $i++) {
            $day[] = $now->startOfWeek()->addDays($i)->format('d-M');
        }

        $query = $this->order->where('plan_id',$plan->id)->where('type',1)->where('is_pms',1)->whereBetween('created_at', array($startDate, $endDate))->sortable()->orderBy('id', 'desc');
        $result = $query->paginate(30)->groupBy(function ($item) {
            return $item->created_at->format('d-M');
        })->toArray();

        $planlogQuery = $this->planlog->where('plan_id',$plan->id)->whereBetween('created_at', array($startDate, $endDate))->sortable()->orderBy('id', 'desc');
        $planlogResulty = $planlogQuery->paginate(30)->groupBy(function ($item) {
            return $item->created_at->format('d-M');
        })->toArray();

        
       
        $subscribedFunds = [];
        $profitArray = [];
        $chgArray = [];

        if($planlogResulty){
            foreach($planlogResulty as $key => $val){
                $chg=0;
                $profit = 0;
                foreach($val as $itemKey => $item){
                    $chg += $item['pl_p'];
                    $profit += $item['pl'];
                }
                $profitArray[$key] = Helper::__numberFormat($profit);
                $chgArray[$key] = Helper::__numberFormat($chg);
            }   
        }
        if($result){
            foreach($result as $key => $val){
                $amount=0;
                foreach($val as $itemKey => $item){
                    $amount += $item['amount'];
                }
                $subscribedFunds[$key] = Helper::__numberFormat($amount);
            }
        }
         
        foreach($day as $key => $val){        
            $resultDataFunds[] = isset($subscribedFunds[$val]) ? $subscribedFunds[$val] :number_format(0,2);
            $resultDataProfit[] = isset($profitArray[$val]) ? $profitArray[$val] :number_format(0,2);
            $resultDataChg[] = isset($chgArray[$val]) ? $chgArray[$val] :number_format(0,2);
        }
        
    
        /**
         * Line Chart Users
         */
        
        $chart = new UserChart;
        $chart->title('Current Week Records');
        $chart->labels($day);
        $chart->dataset('Subscribed Funds', 'line', $resultDataFunds)->options([
            'fill' => true,
            'color' =>'#00bcd4',
            'borderColor' => '#00bcd4'
        ]);
        $chart->dataset('Profit', 'line', $resultDataProfit)->options([
            'fill' => true,
            'color' =>'#28a745',
            'borderColor' => '#28a745'
        ]);
        $chart->dataset('% Chg', 'line', $resultDataChg)->options([
            'fill' => true,
            'color' =>'#ff3636',
            'borderColor' => '#ff3636'
        ]);

        $borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            "rgba(255, 99, 132, 0.2)",
            "rgba(22,160,133, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(51,105,232, 0.2)",
            "rgba(244,67,54, 0.2)",
            "rgba(34,198,246, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"

        ];

        $planChart = new PlanChart;
        //$planChart->minimalist(true);
        $planChart->labels(['Subscribed Funds','Profit','% Chg']);
        $planChart->dataset('Subscribed Funds', 'doughnut', [array_sum($resultDataFunds),array_sum($resultDataProfit),array_sum($resultDataChg)]) ->color($borderColors)
            ->backgroundcolor($fillColors);

        $resultData = [];
        $totalwalletFunds = $this->wallet->where('type',1)->sum('amount');
        $subscribedFunds = $this->order->where('type',1)->where('plan_id',$plan->id)->where('is_pms',1)->sum('amount');
        $marketCapTotal = $this->order->where('plan_id',$plan->id)->sum('qty');
        $issuePrice = $plan->amount;
        $totalSupply = $subscribedFunds/$plan->amount;
        $pl = $plan->pl;
        $earningPerShare = 0;
        if($totalSupply != 0){
            $earningPerShare = $pl/$totalSupply;
        }
        $change = $plan->change;
        $userSubscribed = $this->order->where('plan_id',$plan->id)->where('type',1)->where('is_pms',1)->count();
        $userStop = $this->order->where('plan_id',$plan->id)->where('type',2)->where('is_pms',0)->count();
        $marketCap = $plan->market_cap;
        $maxSupply = $plan->qty;
        $commision = 0;
        $taxes = 0;
        $finalProfit = 0;
        $currentPrice = $issuePrice + $earningPerShare;
        $amountChg = $currentPrice - $issuePrice;
        $chg = ($amountChg/$issuePrice)*100;
        $subscriptionHolding = $this->subscriptionHolding->where('plan_id',$plan->id)->get();
        if($subscriptionHolding){
            foreach($subscriptionHolding as $key => $val){
                $commision += $val['commission'];
                $finalProfit += $val['realised_profit'];
                $taxes += $val['total_commission'];
            }
        }

        $resultData['totalwalletFunds'] = $totalwalletFunds;
        $resultData['subscribedFunds'] = $subscribedFunds;
        $resultData['issuePrice'] = $issuePrice;
        $resultData['totalSupply'] = $totalSupply;
        $resultData['pl'] = $pl;
        $resultData['earningPerShare'] = $earningPerShare;
        $resultData['change'] = $change;
        $resultData['userSubscribed'] = $userSubscribed;
        $resultData['userStop'] = $userStop;
        $resultData['marketCap'] = $plan->qty - $marketCapTotal;
        $resultData['maxSupply'] = $maxSupply;
        $resultData['taxes'] = $taxes;
        $resultData['commision'] = $commision;
        $resultData['finalProfit'] = $finalProfit;
        $resultData['currentPrice'] = $currentPrice;
        $resultData['amountChg'] = $amountChg;
        $resultData['chg'] = $chg;
         
        $user = $this->subscriptionHolding;
        $query = $this->order->with(['user'])->where('plan_id',$plan->id)->where('type',1)->where('is_pms',1)->sortable()->orderBy('is_pms', 'asc');
        if ($request->get('keyword')) {
            $name = $request->get('keyword');
            $query->whereHas('user', function ($q) use ($name) {
                $q->WhereRaw("concat(first_name, ' ', last_name) LIKE '%{$name}%' ")
                ->orwhere('email', 'LIKE', "%{$name}%")->orwhere('number', 'LIKE', "%{$name}%");
            });
        }
        $data = $query->paginate($this->limit);
        $user = $request->query();
        return view('admin.plan.viewPMS', compact('title',  'request','chart','planChart','resultData','data','user','plan'));

    }

    /**
     * get view 
     */
    public function statementView(Request $request, $id){
        $value = $this->order->with(['user','plan'])->where('id',$id)->sortable()->orderBy('id', 'desc')->first();
        $title = $value->plan->title.'( '.$value->user->fullName.' )';
        return view('admin.plan.statementView', compact('title',  'value'));
    }

    /**
     * get view 
     */
    public function statementViewStop(Request $request, $id){
        $value = $this->order->with(['user','plan'])->where('id',$id)->sortable()->orderBy('id', 'desc')->first();
        $title = $value->plan->title.'( '.$value->user->fullName.' )';
        return view('admin.plan.statementViewStop', compact('title',  'value'));
    }
    
   
}
