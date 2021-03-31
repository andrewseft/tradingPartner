<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\SubscriptionRedeem;
use App\User;
use App\Exports\RedeemExport;
use Excel;

class SubscriptionRedeemController extends Controller
{
       /** @var  Limit */
       private $limit;

       /** @var  SubscriptionRedeem */
       private $redeem;

       /** @var  User */
       private $user;
   
       /**
        * Create a new controller instance.
        *
        * @return void
        */
   
       public function __construct(SubscriptionRedeem $redeem, User $user)
       {
           $this->redeem = $redeem;
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
           $title = __('Redeem Plan');
           $redeemData = $this->redeem;
           $redeem = $this->redeem->sortable()->with(['plan','user'])->orderBy('id', 'desc');
           if ($request->query('keyword')) {
               $keyword = $request->query('keyword');
               $redeem->whereHas('user', function ($q) use ($keyword) {
                   $q->where('first_name', 'LIKE', '%' . $keyword . '%');
               })->orwhereHas('plan', function ($q) use ($keyword) {
                   $q->where('title', 'LIKE', '%' . $keyword . '%');
               });
           }
           if ($request->query('created_at_from') && $request->query('created_at_to')) {
               $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
               $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
               $redeem->whereBetween('created_at', array($from_date, $end_date));
           } else if ($request->query('created_at_from')) {
               $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
               $redeem->whereDate('created_at', '=', $date);
           } else if ($request->query('created_at_to')) {
               $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
               $redeem->whereDate('created_at', '=', $date);
           }                     
           $data = $redeem->paginate($this->limit);
           $data->appends($request->query());
           $redeemData = $request->query();
   
           return view('admin.redeem.index', compact('title', 'data', 'request', 'redeem','redeemData'));
            
       }
   
       /**
        * View redeem
        * 
        * @param $id
        */
       public function view($id){
           $title = __('redeem');
           $redeem = $this->redeem->findOrFail(Helper::decode($id));
           $response = [
               'status' => 200,
               'data' => view('admin.redeem.view',compact('title','redeem'))->render(),
           ];
           return response()->json($response,200);
       }

    /**
     * Excel
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function excel(Request $request){
        $redeem = $this->redeem->sortable()->with(['plan','user'])->orderBy('id', 'desc');
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $redeem->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            })->orwhereHas('plan', function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $redeem->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $redeem->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $redeem->whereDate('created_at', '=', $date);
        }                     
        $data = $redeem->paginate($this->limit);
        if($data->count() != 0){
            $name = "statement/".time().'.xlsx';
            Excel::store(new RedeemExport($request), $name,'public');
            $file = Helper::getImageUrl($name);
            return \Redirect::to($file);
        }else{
            return  redirect()->back();
        }
        
    }

    /**
    * List 
    * 
    * @param $id
    * @method get
    *
    */
    public function userRedeem(Request $request, $id){
        $title = __('Redeem Plan');
        $redeemData = $this->redeem;
        $user = $this->user->findOrFail(Helper::decode($id));
        $redeem = $this->redeem->sortable()->where('user_id',$user->id)->with(['plan'])->orderBy('id', 'desc');
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $redeem->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            })->orwhereHas('plan', function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $redeem->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $redeem->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $redeem->whereDate('created_at', '=', $date);
        }                     
        $data = $redeem->paginate($this->limit);
        $data->appends($request->query());
        $redeemData = $request->query();
        return view('admin.userRedeem.index', compact('title', 'data', 'request', 'redeem','redeemData','user'));
            
    }
}
