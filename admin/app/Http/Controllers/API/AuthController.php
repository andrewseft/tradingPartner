<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\User as UserResource;
use App\User;
use App\PasswordReset;
use App\DummyUser;
use App\ReferralUse;
use Carbon\Carbon;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Constants\Constant;
use App\Helpers\Helper;
use App\Manager\EmailManager;
use App\Manager\CacheManager;
use App\Manager\NotificationManager;
use App\Http\Requests\API\SignUpRequest;
use App\Http\Requests\API\AuthRequest;
use App\Http\Requests\API\ForgotPasswordRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\API\CheckOtpRequest;


class AuthController extends BaseController
{
    private $user;
    private $notification;
    private $email;
    private $passwordReset;
    private $cache;
    private $dummyUser;
    private $referralUse;


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(ReferralUse $referralUse, DummyUser $dummyUser, User $user, EmailManager $email, NotificationManager $NotificationManager, CacheManager $cacheManager)
    {
        $this->user = $user;
        $this->email = $email;
        $this->passwordReset = new PasswordReset();
        $this->notification = $NotificationManager;
        $this->cache = $cacheManager;
        $this->dummyUser = $dummyUser;
        $this->referralUse = $referralUse;
    }

    /**
     * Register api
     *
     * 2=>User
     *
     *
     * {"name":"anil sharma","email":"anil@gmail.com","password":"Abc@123","number":"8866458588","device_type":"IOS","device_token":"123","investmentCapital":"3"}
     *
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function register(SignUpRequest $request)
    {
        try {
            
            $otp = Helper::__generateNumericOTP(4);
            $data = $this->dummyUser;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = $request->password;
            $data->request_data = json_encode($request->all());
            $data->save();
            $user = $this->dummyUser->where('email',$request->email)->first();

            /**
             * Send email
             */
            $this->email->sendOtp(Constant::OTP,$user,$otp);

            $this->cache->put('otp',$otp);
            $this->cache->put('userRegister',$request->all());
            $userData['otp'] = $otp;
            $userData['email'] = $request->email;
            return $this->sendResponse(true,trans('message.OTP_SENT'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * checkOtp
     *
     * {"email":"0012345785","otp":""}
     *
     * @return \Illuminate\Http\Response
     */
    public function checkOtp(CheckOtpRequest $request){
        try {
            if($this->cache->has('userRegister')){
                $request = (object)$this->cache->get('userRegister');
                $referralUse = $this->referralUse;
                $user = $this->user;
                $user->first_name = $request->name;
                $user->email = $request->email;
                $user->number = $request->number;
                $user->investmentCapital = $request->investmentCapital;
                $user->token = \Str::uuid();
                $user->referral_code = Helper::__generateNumericOTP(8);
                $user->role_id = 3;
                $user->status = 1;
                $user->notification = 1;
                $user->device_token = isset($request->device_token) ? $request->device_token : "";
                $user->password = bcrypt($request->password);
                if(isset($request->referral_code)){
                    $dataUser = $this->user->where('referral_code',$request->referral_code)->first();
                    if($dataUser){
                        $referralUse->from_user = $dataUser->id;
                        $user->is_referral = $dataUser->id;
                    }
                }
                $user->save();
                if(isset($request->referral_code)){
                    $referralUse->to_user = $user->id;
                    $referralUse->referral_commission = Helper::setting()->platform_commission;
                    $referralUse->save();
                }

                /**
                 * Send Email and notification for admin
                 */
                $adminUser = $this->user->where('id',1)->first();

                $ACCOUNT_STATUS = trans('message.NEW_CUSTOMER');
                $meassge = trans('message.CUSTOMER_REGISTER',['USER_NAME' => $request->name]);
                $this->notification->send($adminUser,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
                $this->cache->clear('App\User');
                $this->cache->delete('userRegister');
                $this->cache->delete('otp');
                $this->dummyUser->where('email',$request->email)->delete();

                $userEmail = $this->user->where('email',$request->email)->first();
                $token = $userEmail->createToken('token')->accessToken;
                $userEmail->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'device_token' => isset($request->device_token) ? $request->device_token : "",
                    'device_type' => isset($request->device_type) ? $request->device_type : "",
                    'api_token' => $token,
                    'notification' => 1
                ]);

                /**
                 * Send email to user
                 */
                $ACCOUNT_STATUS = trans('message.NEW_CUSTOMER');
                $meassge = trans('message.CUSTOMER_REGISTER_MSG',['USER_NAME' => $request->name]);
                $this->notification->send($userEmail,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
                return $this->sendResponse(new UserResource($userEmail),trans('message.CUSTOMER_REGISTER_MSG'));
            }else{
                return $this->sendError(trans('message.WRONG'));
            }
            return $this->sendResponse(true,trans('message.OTP_VERIFIED'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * resendOtp
     *
     * {"email":"anil01@gmail.com"}
     *
     * @return \Illuminate\Http\Response
     */
    public function resendOtp(Request $request){
        try {
            $otp = Helper::__generateNumericOTP(4);
            $user = $this->dummyUser->where('email',$request->email)->first();
           

            /**
             * Send email
             */
            $this->email->sendOtp(Constant::OTP,$user,$otp);

            $this->cache->put('otp',$otp);
            $userData['otp'] = $otp;
            $userData['email'] = $request->email;
            return $this->sendResponse($userData,trans('message.OTP_SENT'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Forgot Password api
     *
     * {"email":"anil@gmail.com"}
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'number';
            $user = User::where($fieldType, $request->email)->first();
            if($user->status == 0){
                return $this->sendError(trans('message.ACCOUNT_MESSAGE_DEACITVE'));
            }
            if(request()->header('Device-Type') == "web"){
                $otp = Helper::__generateNumericOTP(4);
                $this->user->where('id',$user->id)->update(['token'=>$otp]);
                $this->email->sendOtp(Constant::OTP,$user,$otp);
                return $this->sendResponse([], trans('message.FORGOT_PASSWORD_OTP'));
            }else{
                $passwordReset = $this->passwordReset->PasswordReset($user);
                $url = route('front.resetPassword', $passwordReset->token);
                $this->email->sendEmail(Constant::FORGOT_PASSWORD,$user,$url,null);
            }
            return $this->sendResponse([], trans('message.FORGOT_PASSWORD'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Login api
     *
     * {"email":"8866458584","password":"Octal@123","device_token":"001","device_type":"IOS"}
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AuthRequest $request)
    {
         
        try {
            $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'number';
            if (Auth::attempt([$fieldType => $request->email, 'password' => $request->password,'role_id'=>[3] ])) {
                $user = Auth::user();
                if($user->status == 0 || $user->status == 3){
                    return $this->sendError(trans('message.ACCOUNT_MESSAGE_DEACITVE'));
                }
                if($user->status == 2){
                    return $this->sendError(trans('message.ACCOUNT_MESSAGE_UNDER_REVIEW'));
                }
                //$user->AauthAcessToken()->delete();
                $token = $user->createToken('token')->accessToken;
               
                $user->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp(),
                    'device_token' =>$request->device_token,
                    'device_type' => $request->device_type,
                    'api_token' => $token,
                    'notification' => 1
                ]);
                
                return $this->sendResponse(new UserResource($user),trans('message.USER_LOGIN'));
            } else {
                return $this->sendError(trans('message.EMAIL_INVALID'));
            }
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function resetPassword(Request $request){
        try {
            $user = $this->user->where('email', $request->email)->where('token',$request->otp)->first();
            if(empty($user)){
                return $this->sendError(trans('message.OTP_UNVERIFIED'));
            }
            $user->password = bcrypt($request->password);
            $user->token = null;
            $user->save();
            return $this->sendResponse([], trans('message.PASSWORD_UPDATED'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    






}
