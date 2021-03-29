<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\wallet;
use App\WithdrawalRequest;
use Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\API\Withdrawal;
use App\Http\Resources\PassBook as PassbookResource;
use Exception;
use App\User;
use App\Manager\NotificationManager;

class WithdrawalController extends BaseController
{
    
    /** @var  Limit */
    private $limit;

    /** @var  wallet */
    private $wallet;

    /** @var  User */
    private $user;

    /** @var  WithdrawalRequest */
    private $withdrawal;

    /** @var  NotificationManager */
    private $notification;

     /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(wallet $wallet, User $user, NotificationManager $NotificationManager, WithdrawalRequest $withdrawal){
        $this->wallet = $wallet;
        $this->limit = Helper::setting()->admin_limit;
        $this->user = $user;
        $this->notification = $NotificationManager;
        $this->withdrawal = $withdrawal;
    }

    /**
     * save withdrawal request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Withdrawal $request)
    {
        try {
            $user = Auth::user();
            if($user->is_kyc == 0){
                return $this->sendError("Your KYC is complete, otherwise awaiting approval.");
            }
            $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
            $amount = 0;
            if($walletData){
              $amount =  $walletData->closing_bal; 
            }
            if($request->amount >= $amount){
                return $this->sendError("Don't have much amount in your wallet");
            }

            /**
             * Update wallet 
             */

            $data = $this->wallet;
            $data->user_id = $user->id;
            $data->amount = $request->amount;
            $data->type = 2;
            $data->closing_bal = $amount - $request->amount;
            $data->remark = "Withdrawal request";
            $data->save();

            /**
             * Save Withdrawal request
             */

            $withdrawalData = $this->withdrawal;
            $withdrawalData->user_id = $user->id;
            $withdrawalData->amount = $request->amount;
            $withdrawalData->status = 0;
            $withdrawalData->save();

            /**
             * Send email for user
             */
            $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
            $meassge = trans('message.WITHDRAWAL_REQUEST',['TOTAL_AMOUNT'=>number_format($amount - $request->amount ,2),'AMOUNT'=>number_format($request->amount,2)]);
            $this->notification->send($user,route('admin.customer'),$ACCOUNT_STATUS,$meassge);

            /**
             * Send Email for admin
             */
            $adminUser = $this->user->findOrFail(1);
            $ACCOUNT_STATUS = trans('message.WITHDRAWAL_STATUS');
            $meassge = trans('message.USER_WITHDRAWAL_REQUEST',['NAME'=>ucfirst($user->first_name),'AMOUNT'=>number_format($request->amount,2)]);
            $this->notification->send($adminUser,route('admin.withdrawal'),$ACCOUNT_STATUS,$meassge);
            return $this->sendResponse(true, 'Your withdrawal request has been successfully submitted');

        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
