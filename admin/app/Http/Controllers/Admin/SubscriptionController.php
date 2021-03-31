<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\Subscription;
use App\User;
use App\Order;
use App\Statement;

class SubscriptionController extends Controller
{
    /** @var  Limit */
    private $limit;

    /** @var  Subscription */
    private $subscription;

    /** @var  User */
    private $user;

    /** @var  Order */
    private $order;

    /** @var  Statement */
    private $statement;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Statement $statement, Order $order, Subscription $subscription, User  $user)
    {
        $this->subscription = $subscription;
        $this->limit = Helper::setting()->admin_limit;
        $this->user = $user;
        $this->order = $order;
        $this->statement = $statement;
    }

    /**
     * List 
     * 
     * @param $id
     * @method get
     *
     */
    public function index(Request $request){
        $title = __('Start Subscriptions');
        $subscriptionData = $this->order;
        $subscription = $this->order->sortable()->with(['plan','user'])->where('is_pms',1)->where('type',1)->orderBy('id', 'desc');
        $totalPl = $this->statement->where('is_pay',0)->sum('pl');
        $chg = $this->statement->where('is_pay',0)->sum('chg');
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $subscription->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            })->orwhereHas('plan', function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $subscription->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $subscription->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $subscription->whereDate('created_at', '=', $date);
        }                     
        $data = $subscription->paginate($this->limit);
        $data->appends($request->query());
        $subscriptionData = $request->query();
        
        $totalInvested = 0;
        $currentInvested = 0;
        $pl_amount = $totalPl;
        $pl_percentage = $chg;
        foreach($data as $key => $value){
            if($value->type == 1){
                $totalInvested += ($value->amount);
            }
        }
        $currentInvested = $totalInvested + $pl_amount;
        
        return view('admin.subscription.index', compact('title', 'data', 'request', 'subscription','subscriptionData','totalInvested','currentInvested','pl_amount','pl_percentage'));
         
    }

     /**
     * List 
     * 
     * @param $id
     * @method get
     *
     */
    public function stopIndex(Request $request){
        $title = __('Stop Subscriptions');
        $subscriptionData = $this->order;
        $subscription = $this->order->sortable()->with(['plan','user'])->where('is_pms',0)->where('type',2)->orderBy('id', 'desc');
        $totalPl = $this->statement->where('is_pay',1)->sum('pl');
        $chg = $this->statement->where('is_pay',1)->sum('chg');
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $subscription->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            })->orwhereHas('plan', function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $subscription->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $subscription->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $subscription->whereDate('created_at', '=', $date);
        }                     
        $data = $subscription->paginate($this->limit);
        $data->appends($request->query());
        $subscriptionData = $request->query();
        
        $totalInvested = 0;
        $currentInvested = 0;
        $pl_amount = $totalPl;
        $pl_percentage = $chg;
        foreach($data as $key => $value){
            if($value->type == 2){
                $totalInvested += ($value->amount*$value->qty);
            }
        }
        $currentInvested = $totalInvested + $pl_amount;
        
        return view('admin.subscription.index', compact('title', 'data', 'request', 'subscription','subscriptionData','totalInvested','currentInvested','pl_amount','pl_percentage'));
         
    }

    /**
     * List 
     * 
     * @param $id
     * @method get
     *
     */
    public function userSubscription($id, Request $request){
        $title = __('Subscriptions');
        $subscriptionData = $this->order;
        $user = $this->user->findOrFail(Helper::decode($id));
        $subscription = $this->order->sortable()->with(['plan','user'])->where('user_id',$user->id)->where('is_pms',1)->where('type',1)->orderBy('id', 'desc');
        $totalPl = $this->statement->where('is_pay',0)->sum('pl');
        $chg = $this->statement->where('is_pay',0)->sum('chg');

        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $subscription->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            })->orwhereHas('plan', function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $subscription->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $subscription->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $subscription->whereDate('created_at', '=', $date);
        }                     
        $data = $subscription->paginate($this->limit);
        $data->appends($request->query());
        $subscriptionData = $request->query();
        
        $totalInvested = 0;
        $currentInvested = 0;
        $pl_amount = $totalPl;
        $pl_percentage = $chg;
        foreach($data as $key => $value){
            if($value->type == 1){
                $totalInvested += ($value->amount);
            }
        }
        $currentInvested = $totalInvested + $pl_amount;
        
        return view('admin.subscription.userSubscription', compact('user','title', 'data', 'request', 'subscription','subscriptionData','totalInvested','currentInvested','pl_amount','pl_percentage'));         
    }

    /**
     * View subscription
     * 
     * @param $id
     */
    public function view($id){
        $title = __('subscription');
        $subscription = $this->order->findOrFail(Helper::decode($id));
        if(isset($subscription->planlogs->id) && $subscription->created_at->format('Y-m-d') < Carbon::now()->format('Y-m-d')){
            $totalPl =   $this->statement->where('user_id',$subscription->user_id)->where('plan_id',$subscription->plan_id)->where('is_pay',0)->sum('realised_profit');
            $totalInvested = $subscription->amount;
            $currentPrice = number_format($subscription->plan->closing_balance + $subscription->plan->amount,2,'.', '');
             
        }else{
            $totalPl =   0;
            $totalInvested = $subscription->amount;
            $currentPrice = number_format($subscription->plan->amount,2,'.', '');
        }
        $response = [
            'status' => 200,
            'data' => view('admin.subscription.view',compact('title','subscription','totalPl','totalInvested','currentPrice'))->render(),
        ];
        return response()->json($response,200);
    }
}
