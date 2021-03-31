<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\WithdrawalRequest;
use App\User;
use App\Exports\withdrawalExport;
use App\Manager\NotificationManager;
 

class WithdrawalController extends Controller
{
    /** @var  Limit */
    private $limit;

    /** @var  WithdrawalRequest */
    private $withdrawal;

    /** @var  User */
    private $user;

    /** @var  NotificationManager */
    private $notification;

    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct(WithdrawalRequest $withdrawal, User $user, NotificationManager $NotificationManager)
    {
        $this->withdrawal = $withdrawal;
        $this->limit = Helper::setting()->admin_limit;
        $this->user = $user;
        $this->notification = $NotificationManager;
    }

    /**
    * List 
    * 
    * @param $id
    * @method get
    *
    */
    public function index(Request $request){
        $title = __('Withdrawal Request');
        $withdrawalData = $this->withdrawal;
        $withdrawal = $this->withdrawal->sortable()->with(['user'])->orderBy('id', 'desc');
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $withdrawal->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->query('status')) {
            $status = $request->query('status');
            if($status == 2){
                $status = 0;
            }
            $withdrawal->where('status',$status);
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $withdrawal->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $withdrawal->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $withdrawal->whereDate('created_at', '=', $date);
        }                     
        $data = $withdrawal->paginate($this->limit);
        $data->appends($request->query());
        $withdrawalData = $request->query();
            $total = 0;
            $unPaid = 0;
            $paid = 0;
            foreach($data as $key => $value){
                $total += $value->amount;
                if($value->status == 0){
                    $unPaid += $value->amount;
                }
                if($value->status == 1){
                    $paid += $value->amount;
                }
            }
        return view('admin.withdrawal.index', compact('title', 'data', 'request', 'withdrawal','withdrawalData','total','unPaid','paid'));
            
    }

     /**
     * view
     * @param $id
     * @method get
     *
     */
    public function view ($id){
        $withdrawalData = $this->withdrawal->with(['user'])->where('id',Helper::decode($id))->orderBy('id', 'desc')->first();
        $response = [
            'status' => 200,
            'data' => view('admin.withdrawal.view',compact('withdrawalData'))->render(),
        ];
        return response()->json($response,200);
    }

    /**
     * withdrawal update
     */
    public function addAmount(Request $request){
        $withdrawal = $this->withdrawal->where('id',$request->id)->first();
        $user = $this->user->where('id',$withdrawal->user_id)->first();
        $this->withdrawal->where('id',$withdrawal->id)->update(['status'=>1,'description'=>$request->message]);
        
        /**
         * Send email for user
         */
        $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
        $meassge = trans('message.WITHDRAWAL_UPDATE',['AMOUNT'=>number_format($withdrawal->amount,2),"NOTE"=>$request->message]);
        $this->notification->send($user,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
        return  redirect()->back()->with('success', __('Withdrawal has been updated sucessfully'));
    }
}
