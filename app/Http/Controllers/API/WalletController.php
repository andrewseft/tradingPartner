<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\wallet;
use Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\API\WalletRequest;
use App\Http\Resources\PassBook as PassbookResource;
use Exception;
use App\User;
use App\Manager\NotificationManager;

class WalletController extends BaseController
{
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
     * Get wallet amount
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user = Auth::user();
            $amount = 0;
            $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
            if($walletData){
                $amount =  $walletData->closing_bal; 
            }
            return $this->sendResponse(number_format($amount,2), 'Data was retrieved successfully.');
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * add amount on wallet
     * 
     * {"amount":500}
     * 
     * @method post
     *
     * @return \Illuminate\Http\Response
     */
    public function add(WalletRequest $request)
    {
        try {
            $user = Auth::user();
            if($user->is_kyc == 0){
                //return $this->sendError("Your KYC is complete, otherwise awaiting approval.");
            }
            $amount = 0;
            $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
            if($walletData){
              $amount =  $walletData->closing_bal; 
            }
            $data = $this->wallet;
            $data->user_id = $user->id;
            $data->amount = $request->amount;
            $data->transaction_id = $request->transaction_id;
            $data->type = 1;
            $data->closing_bal = $request->amount + $amount;
            $data->remark = "Add amount on wallet";
            $data->save();

            /**
             * Send email for user
             */
            $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
            $meassge = trans('message.WALLET_AMOUNT_USER',['TOTAL_AMOUNT'=>number_format($request->amount + $amount,2),'AMOUNT'=>number_format($request->amount,2)]);
            $this->notification->send($user,route('admin.customer'),$ACCOUNT_STATUS,$meassge);

           
            /**
             * Send Email for admin
             */
            $adminUser = $this->user->findOrFail(1);
            $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
            $meassge = trans('message.USER_WALLET_AMOUNT',['NAME'=>ucfirst($user->first_name),'AMOUNT'=>number_format($request->amount,2)]);
            $this->notification->send($adminUser,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
            return $this->sendResponse(number_format($request->amount + $amount,2), 'Data was retrieved successfully.');
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get passbook
     *
     * @return \Illuminate\Http\Response
     */
    public function passbook(Request $request)
    {
        try {
            $user = Auth::user();
            $query = $this->wallet->where('user_id',$user->id)->sortable()->orderBy('id', 'desc');
            if ($request->query('keyword')) {
                $name = $request->query('keyword');
                $query->where('title', 'LIKE', '%' . $name . '%');
            }
            $result = $query->paginate($this->limit)->groupBy(function ($item) {
                return $item->created_at->format('M Y');
            });
            $data = [];
            $count = 0;
            foreach($result as $key => $value){
                $data[$count]['month'] = $key;
                $data[$count]['transactions'] = PassbookResource::collection($value);
                $count++;
            }
            return $this->sendResponse($data, __('Data was retrieved successfully.'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
