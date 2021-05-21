<?php

namespace App\Http\Controllers\API;

use App\Constants\Constant;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserLocation as UserLocationResource;
use App\Manager\UploadManager;
use App\User;
use App\Notification;
use App\UserProfile;
use Auth;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\ReferralUse;
use App\Manager\CacheManager;
use App\Manager\EmailManager;
use App\ReferralLog;
use App\ReferralList;
use App\Banner;
use App\wallet;
use App\Manager\NotificationManager;
use App\Http\Requests\API\ChangePasswordRequest;
use App\Http\Requests\API\UpdateProfileRequest;
use App\Http\Requests\API\SettingRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ReferralUse as ReferralUseResource;
use App\Http\Resources\ReferralListResource as ReferralListResource;
use App\Http\Resources\Notification as NotificationResource;
use App\Http\Resources\Banner as BannerResource;
use App\Http\Resources\Statement as StatementResource;
use Exception;
use App\SubscriptionHolding;
use App\Statement;
use App\Order;

class UserController extends BaseController
{
    private $user;
    private $notification;
    private $upload;
    private $language;
    private $email;
    private $cache;
    private $userProfile;
    private $referralUse;
    private $notificationList;
    private $referralLog;
    private $referralList;
    private $banner;



    /** @var  wallet */
    private $wallet;

    /** @var  SubscriptionHolding */
    private $subscriptionHolding;

    /** @var  Order */
    private $order;

    /** @var  Limit */
    private $limit;

    /** @var  Statement */
    private $statement;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(ReferralList $referralList, Statement $statement, Order $order, SubscriptionHolding $subscriptionHolding, wallet $wallet, Banner $banner, ReferralLog $referralLog, Notification $notificationList, ReferralUse $referralUse, UserProfile $userProfile, NotificationManager $NotificationManager, User $user, UploadManager $upload, EmailManager $email, CacheManager $cacheManager)
    {
        $this->user = $user;
        $this->upload = $upload;
        $this->language = \App::getLocale();
        $this->email = $email;
        $this->notification = $NotificationManager;
        $this->cache = $cacheManager;
        $this->userProfile = $userProfile;
        $this->referralUse = $referralUse;
        $this->notificationList = $notificationList;
        $this->referralLog = $referralLog;
        $this->banner = $banner;
        $this->wallet = $wallet;
        $this->subscriptionHolding = $subscriptionHolding;
        $this->order = $order;
        $this->limit = Helper::setting()->admin_limit;
        $this->statement = $statement;
        $this->referralList = $referralList;
    }

     
    /**
     * Change Password Api
     *
     * {"current_password":"","password":"","password_confirmation":""}
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = Auth::user();
            $user->password = bcrypt($request->password);
            $user->save();
            $this->cache->clear('App\User');
            return $this->sendResponse([], trans('message.PASSWORD_UPDATE'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Updated Profile Api
     *
     * {"first_name":"anil","last_name":"","address":"","latitude":"1","longitude":"1","email":"","mobile":""}
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            
            $user = Auth::user();
            $user->first_name = $request->get('name');
            $user->email = $request->get('email');
            $user->number = $request->get('number');
            $user->is_kyc = 0;
            if($request->get('is_kyc')){
                $user->is_kyc = 1;
            }
            $user->investmentCapital = $request->get('investmentCapital');
            if ($request->hasFile('image')) {
                $user->image = $this->upload->image($request->file('image'), $user->image, Constant::USER_IMAGE, Constant::USER_IMAGE_THUMB, Constant::USER_IMAGE_HEIGHT, Constant::USER_IMAGE_WIDTH, true);
            }
            $user->save();

            /**
             * Profile update
             */
            $profile = $this->userProfile->where('user_id',$user->id)->first();
            if(empty($profile)){
                $profile = $this->userProfile;   
            }
            $profile->bank_name = $request->bank_name;
            $profile->account_number = $request->account_number;
            $profile->ifsc_code = $request->ifsc_code;
            $profile->adahr_card_number = $request->adahr_card_number;
            $profile->pan_cart_number = $request->pan_cart_number;
            if ($request->hasFile('adahr_card_image')) {
                $profile->adahr_card_image = $this->upload->image($request->file('adahr_card_image'), $profile->adahr_card_image, Constant::DOC_IMAGE, Constant::DOC_IMAGE_THUMB, Constant::DOC_IMAGE_HEIGHT, Constant::DOC_IMAGE_WIDTH, true);
            }
            if ($request->hasFile('pan_cart_image')) {
                $profile->pan_cart_image = $this->upload->image($request->file('pan_cart_image'), $profile->pan_cart_image, Constant::DOC_IMAGE, Constant::DOC_IMAGE_THUMB, Constant::DOC_IMAGE_HEIGHT, Constant::DOC_IMAGE_WIDTH, true);
            }
            $user->profile()->save($profile);
            $this->cache->clear('App\User');
            return $this->sendResponse(new UserResource($user),trans('message.PROFILE_UPDATE'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

     
    /**
     * Logout user
     *
     *  @return \Illuminate\Http\Response
     *
     */
    public function logout(Request $request)
    {
        try {
            $user = Auth::user();
            if($user){
                $user->AauthAcessToken()->delete();
                $user->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'online' => false
                ]);
            }
            return $this->sendResponse([],trans('message.LOGOUT'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     *  Get Referral code
     *
     *  @return \Illuminate\Http\Response
     *
     */
    public function getReferral(Request $request){
        try {
            $user = Auth::user();
            $data = $this->referralList->where('user_id',$user->id)->get();
            $totalUser = $this->user->where('is_referral',$user->id)->count();
            $referralUserList = $this->user->where('is_referral',$user->id)->get();

            $referralLog = $this->referralLog->where('to_user',$user->id)->sum('amount');
            $result['referralID'] = $user->referral_code;
            $result['referralAmount'] = Helper::setting()->platform_commission;
            $result['receivedReferralAmount'] = $referralLog;
            $result['totalFriends'] = $totalUser;
            $result['linkList'] = ReferralUseResource::collection($data);
            $result['userReferralList'] = ReferralListResource::collection($referralUserList);
            
            return $this->sendResponse($result, trans('message.GET_DATA'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Profile Api
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {
        try {
            $user = Auth::user();
            return $this->sendResponse(new UserResource($user),trans('message.PROFILE_UPDATE'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Notification Api
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotification()
    {
        try {
            $user = Auth::user();
            $data = $this->notificationList->where('user_id',$user->id)->orderBy('id','desc')->get();
            return $this->sendResponse(NotificationResource::collection($data),trans('message.PROFILE_UPDATE'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Updated Profile Api
     *
     * {"notification":true}
     *
     * @return \Illuminate\Http\Response
     */
    public function notificationUpdate(Request $request)
    {
        try {
            
            $user = Auth::user();
            $user->notification = $request->get('notification');
            $user->save();
            $this->cache->clear('App\User');
            return $this->sendResponse(new UserResource($user),trans('message.PROFILE_UPDATE'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Notification Api
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function removeNotification()
    {
        try {
            $user = Auth::user();
            $data = $this->notificationList->where('id',$user->id)->delete();
            return $this->sendResponse([],trans('message.NOTIFICATION_REMOVED'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * homePage PMS Api
     *
     *  
     *
     * @return \Illuminate\Http\Response
     */
    public function homePage(Request $request)
    {
        try {
            $user = Auth::user();
            $banner = $this->banner->where('status',true)->get();
            $amount = 0;
            $walletData = $this->wallet->where('user_id',$user->id)->orderBy('id', 'desc')->first();
            if($walletData){
              $amount =  $walletData->closing_bal; 
            }

            $query = $this->order->where('user_id',$user->id)->with(['plan'])->with('subscriptionHolding')->where('is_move',0)->sortable()->orderBy('id', 'desc');
            $totalPl = Statement::where('user_id',$user->id)->where('is_move',0)->sum('pl');
            $result = $query->paginate($this->limit);
            $totalInvested = Order::where('user_id',$user->id)->where('type',1)->sum('amount');
            $pl_percentage = 0;
            $currentInvested = Statement::where('user_id',$user->id)->where('is_move',0)->sum('capital_balance');
            $charges = Statement::where('user_id',$user->id)->where('is_move',0)->sum('total_commission');
            
            $process = User::where('is_referral',$user->id)->where("created_at",">", Carbon::now()->subMonths(3))->orderBy('created_at','desc')->select('id','created_at')->get()->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('F');
            })->toArray();
            $notInterested = [0,0,0];
            $processCount = [];
            $convertedCount = [];
            $date = Carbon::now();
            $month = [$date->format('F'),$date->startOfMonth()->subMonth()->format('F'),$date->startOfMonth()->subMonth(1)->format('F')];
            foreach($month as $key => $val){
                if(isset($process[$val])){
                    $processCount[] = count($process[$val]);
                }else{
                    $processCount[]  = 0;  
                }
                
            }
            $account_converted = User::select('id')->where('is_referral',$user->id)->get();
            $converted = SubscriptionHolding::whereIn('user_id',$account_converted->toArray())
                        ->where("created_at",">", Carbon::now()->subMonths(3))->orderBy('created_at','desc')->select('id','created_at')->get()->groupBy(function ($val) {
                            return Carbon::parse($val->created_at)->format('F');
                        })->toArray();
            
            foreach($month as $key => $val){
                if(isset($converted[$val])){
                    $convertedCount[] = count($converted[$val]);
                }else{
                    $convertedCount[]  = 0;  
                }
                
            }
             
            /**
             * referrlCount
             */
            $referrlCount = [
                ["Not Interested", "Not Interested", "Lead In Process", "Leads Converted"],
                [$month[0], $notInterested[0], $processCount[0], $convertedCount[0]],
                [$month[1], $notInterested[1], $processCount[1], $convertedCount[1]],
                [$month[2], $notInterested[2], $processCount[2], $convertedCount[2]],
            ];

            /**
             * Referrl Payout
             */
            $brokerageData = [];
            $referralPayout = ReferralList::where("created_at",">", Carbon::now()->subMonths(3))->where('user_id',$user->id)->orderBy('created_at','desc')->select('total','created_at')->get()->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('F');
            })->toArray();
            
            foreach($month as $key => $val){
                if(isset($referralPayout[$val])){
                    $count = 0;
                    foreach($referralPayout[$val] as $amountKey => $amountReferral){
                        $count += $amountReferral['total'];
                    }
                    $brokerageData[]  = $count;
                }else{
                    $brokerageData[]  = 0;  
                }
                
            }
            $referrlPayoutData = [
                ["x", "Brokerage", "Fixed"],
                [$month[0], $brokerageData[0], 0],
                [$month[1], $brokerageData[1], 0],
                [$month[2], $brokerageData[2], 0],
            ];

            /**
             * Trade Status
             */
            $activeTrade = SubscriptionHolding::where('user_id',$user->id)->where('is_pay',0)->get()->count();
            $inActiveTrade = SubscriptionHolding::where('user_id',$user->id)->where('is_pay',1)->get()->count();
            $tradeStatus =[
                ["Task", "Hours per Day"],
                ["Active", $activeTrade],
                ["InActive", $inActiveTrade],
            ];
            $statement = $this->statement->where('user_id',$user->id)->orderBy('id', 'desc')->get();
            $chg = Statement::where('user_id',$user->id)->where('is_move',0)->sum('chg');
            $totalHolding = $this->order->where('user_id',$user->id)->where('is_move',0)->where('is_pms',1)->count();
            $data['banner'] = BannerResource::collection($banner);
            $data['walletAmount'] = Helper::__numberFormat($amount);
            $data['totalInvested'] = Helper::__numberFormat($totalInvested);
            $data['currentInvested'] = Helper::__numberFormat($totalPl + $totalInvested);
            $data['PL'] =  $totalPl >= 0 ? '+'.Helper::__numberFormat($totalPl) :Helper::__numberFormat($totalPl);
            $data['charges'] = $charges >=  0 ? '+'.Helper::__numberFormat($charges) :Helper::__numberFormat($charges);
            $data['chg'] = $chg >=  0 ? '+'.Helper::__numberFormat($chg).'%' :Helper::__numberFormat($chg).'%';
            $data['totalStartPms'] = $this->order->where('user_id',$user->id)->where('is_pms',1)->count();
            $data['totalStopPms'] = $this->order->where('user_id',$user->id)->where('is_pms',0)->count();
            $data['statement'] = StatementResource::collection($statement);
            $data['totalHolding'] = $totalHolding;
            $data['referrlCount'] = $referrlCount;
            $data['referrlPayout'] = $referrlPayoutData;
            $data['tradeStatus'] = $tradeStatus;
            return $this->sendResponse($data, 'Data was retrieved successfully.');
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    








}
