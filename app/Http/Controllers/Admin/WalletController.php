<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\Constant;
use App\Helpers\Helper;
use App\Manager\EmailManager;
use App\Manager\UploadManager;
use App\Manager\NotificationManager;
use App\User;
use App\wallet;
use Carbon\Carbon;

class WalletController extends Controller
{
    /** @var  Wallet */
    private $wallet;


    /** @var  Limit */
    private $limit;

    /** @var  User */
    private $user;

    /** @var  NotificationManager */
    private $notification;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(wallet $wallet, User $user, NotificationManager $NotificationManager)
    {
        $this->wallet = $wallet;
        $this->limit = Helper::setting()->admin_limit;
        $this->user = $user;
        $this->notification = $NotificationManager;
    }

    /**
     * @method get
     *
     * List of Users
     */
    public function index(Request $request)
    {
        $title = __('Customer Wallets');
        $user = $this->user;
        $userData = $this->user->where('role_id',3)->with(['wallet'])->where('status',true)->where('is_kyc',true)->sortable()->orderBy('created_at', 'desc');
        if ($request->query('keyword')) {
            $name = $request->query('keyword');
            $userData->where(function($q) use($name) {
                $q->WhereRaw("concat(first_name, ' ', last_name) LIKE '%{$name}%' ")
                  ->orwhere('email', 'LIKE', "%{$name}%")->orwhere('number', 'LIKE', "%{$name}%");
            });
        }
        $data = $userData->paginate($this->limit);
        $data->appends($request->query());
        $user = $request->query();
        return view('admin.wallet.index', compact('title', 'data', 'request', 'user'));
    }

    /**
     * view
     * @param $id
     * @method get
     *
     */
    public function view ($id){
        $title = __('Customer');
        $user = $this->user->findOrFail(Helper::decode($id));
        $amount = 0;
        $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
        if($walletData){
            $amount =  $walletData->closing_bal; 
        }
        $query = $this->wallet->where('user_id',$user->id)->sortable()->orderBy('id', 'desc');
        $result = $query->paginate($this->limit)->groupBy(function ($item) {
            return $item->created_at->format('M Y');
        });
        $response = [
            'status' => 200,
            'data' => view('admin.wallet.view',compact('title','user','result','walletData','amount'))->render(),
        ];
        return response()->json($response,200);
    }

    /**
     * Add amount on wallet 
     */
    public function addAmount(Request $request){
        $user = $this->user->where('id',$request->id)->first();
        
        $amount = 0;
        $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
        if($walletData){
            $amount =  $walletData->closing_bal; 
        }
        $data = $this->wallet;
        $data->user_id = $user->id;
        $data->amount = $request->point;
        $data->transaction_id = $request->transaction_id;
        $data->type = 1;
        $data->closing_bal = $request->point + $amount;
        $data->remark = "Administrator has been credit amount on wallet";
        $data->save();

        /**
         * Send email for user
         */
        $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
        $meassge = trans('message.WALLET_AMOUNT_USER_ADMIN',['TOTAL_AMOUNT'=>number_format($request->point + $amount,2),'AMOUNT'=>number_format($request->point,2)]);
        $this->notification->send($user,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
        return  redirect()->back()->with('success', __('Amount has been updated sucessfully'));
    }

    /**
     * debit amount on wallet 
     */
    public function debitAmount(Request $request){
        $user = $this->user->where('id',$request->id)->first();
        
        $amount = 0;
        $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
        if($walletData){
            $amount =  $walletData->closing_bal; 
        }
        if($request->point > $amount){
            return  redirect()->back()->with('Error', __('There is not enough balance in your wallet.'));
        }
        $data = $this->wallet;
        $data->user_id = $user->id;
        $data->amount = $request->point;
        $data->transaction_id = $request->transaction_id;
        $data->type = 2;
        $data->closing_bal = $amount - $request->point;
        $data->remark = "Administrator has been debit amount on wallet";
        $data->save();

        /**
         * Send email for user
         */
        $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
        $meassge = trans('message.WALLET_AMOUNT_USER_DEBIT',['TOTAL_AMOUNT'=>number_format($request->point + $amount,2),'AMOUNT'=>number_format($request->point,2)]);
        $this->notification->send($user,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
        return  redirect()->back()->with('success', __('Amount has been updated sucessfully'));
    }

    /**
     * view
     * @param $id
     * @method get
     *
     */
    public function userWallet($id){
        $title = __('Customer');
        $user = $this->user->findOrFail(Helper::decode($id));
        $amount = 0;
        $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
        if($walletData){
            $amount =  $walletData->closing_bal; 
        }
        $query = $this->wallet->where('user_id',$user->id)->sortable()->orderBy('id', 'desc');
        $result = $query->paginate($this->limit)->groupBy(function ($item) {
            return $item->created_at->format('M Y');
        });
        return view('admin.wallet.userWallet',compact('title','user','result','walletData','amount'));
    }
}
