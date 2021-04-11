<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\Order;
use App\User;

class OrderController extends Controller
{
    /** @var  Limit */
    private $limit;

    /** @var  Order */
    private $order;

    /** @var  User */
    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Order $order, User $user)
    {
        $this->order = $order;
        $this->limit = Helper::setting()->admin_limit;
        $this->user = $user;
    }

    /**
     * List 
     * 
     * @param $id
     * @method get
     *
     */
    public function index(Request $request){
        $title = __('Orders');
        $orderData = $this->order;
        $order = $this->order->sortable()->with(['plan','user'])->orderBy('id', 'desc');
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $order->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            })->orwhereHas('plan', function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $order->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $order->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $order->whereDate('created_at', '=', $date);
        }                     
        $data = $order->paginate($this->limit);
        $data->appends($request->query());
        $orderData = $request->query(); 
        $totalQty = 0;
        $totalAmount = 0;
        $currentQty = 0;
        $currentAmount = 0; 
        foreach($data as $key => $value){
            $totalQty += $value->qty;
            $totalAmount += ($value->amount);
            if($value->type == 1){
                $currentQty += $value->qty;
                $currentAmount += ($value->amount);
            }
        }      
        return view('admin.order.index', compact('currentAmount','currentQty','title', 'data', 'request', 'order','orderData','totalQty','totalAmount'));
         
    }

    /**
     * List 
     * 
     * @param $id
     * @method get
     *
     */
    public function userOrder(Request $request, $id){
        $title = __('Orders');
        $user = $this->user->findOrFail(Helper::decode($id));
        $orderData = $this->order;
        $order = $this->order->sortable()->where('user_id',$user->id)->with(['plan'])->orderBy('id', 'desc');
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $order->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            })->orwhereHas('plan', function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $order->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $order->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $order->whereDate('created_at', '=', $date);
        }                     
        $data = $order->paginate($this->limit);
        $data->appends($request->query());
        $orderData = $request->query(); 
        $totalQty = 0;
        $totalAmount = 0;  
        foreach($data as $key => $value){
            $totalQty += $value->qty;
            $totalAmount += ($value->qty);
        }      
        return view('admin.order.userOrder', compact('user','title', 'data', 'request', 'order','orderData','totalQty','totalAmount'));
         
    }
}
