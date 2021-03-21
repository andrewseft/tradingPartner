<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\Statement;
use App\Exports\RedeemExport;
use Excel;

class EarningController extends Controller
{
       /** @var  Limit */
       private $limit;

       /** @var  Statement */
       private $redeem;
   
       /**
        * Create a new controller instance.
        *
        * @return void
        */
   
       public function __construct(Statement $redeem)
       {
           $this->redeem = $redeem;
           $this->limit = Helper::setting()->admin_limit;
       }
   
       /**
        * List 
        * 
        * @param $id
        * @method get
        *
        */
       public function index(Request $request){
           $title = __('Earnings');
           $redeemData = $this->redeem;
           $redeem = $this->redeem->sortable()->with(['plan'])->orderBy('id', 'desc');
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

            $planform_fee = 0;
            $commission = 0;
            $total_charges = 0;
            foreach($data as $key => $value){
                $planform_fee += $value->platform_fee;
                $commission += $value->commission;
                $total_charges += $value->total_commission;
            }
   
           return view('admin.earning.index', compact('title', 'data', 'request', 'redeem','redeemData','planform_fee','commission','total_charges'));
            
       }
   
    
}
