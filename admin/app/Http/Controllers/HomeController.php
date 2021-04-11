<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\Constant;
use App\Http\Requests\UserRequest;
use App\Manager\NotificationManager;
use App\Manager\UserManager;
use App\Helpers\Helper;
use App\User;
use App\SubscriptionRedeem;
use App\Subscription;
use App\Order;
use App\wallet;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Charts\UserChart;
use App\Charts\SubscriptionRedeemsChart;
use App\SubscriptionHolding;
use App\Statement;
use App\Http\Requests\PasswordResetRequest;
use App\PasswordReset;
use App\Faq;
use App\Page;
use App\Manager\EmailManager;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Manager\CacheManager;
use App\Manager\UploadManager;
 

class HomeController extends Controller
{
    /** @var  SubscriptionRedeem */
    private $redeem;

    /** @var  Subscription */
    private $subscription;

     /** @var  Order */
     private $order;

     /** @var  wallet */
     private $wallet;

     /** @var  SubscriptionHolding */
    private $subscriptionHolding;

    /** @var  Statement */
    private $statement;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Statement $statement, SubscriptionHolding $subscriptionHolding, wallet $wallet, Order $order, Subscription $subscription, UserManager $user, NotificationManager $notification, SubscriptionRedeem $redeem ,Page $page, Faq $faq,UploadManager $upload,NotificationManager $NotificationManager,EmailManager $emailManager,CacheManager $cacheManager)
    {
        $this->guard = Constant::GUARD;
        $this->user = $user;
        $this->notification = $notification;
        $this->limit = Helper::setting()->admin_limit;
        $this->redeem = $redeem;
        $this->subscription = $subscription;
        $this->order = $order;
        $this->wallet = $wallet;
        $this->subscriptionHolding = $subscriptionHolding;
        $this->statement = $statement;

        $this->PasswordReset = new PasswordReset();
        $this->redirectTo = Constant::REDIRECT_LOGIN;
        $this->expireDay = Constant::EXPIRE_DAY;
        $this->userModel = new User();
        $this->email = $emailManager;
        $this->notification = $NotificationManager;
        $this->cache = $cacheManager;
        $this->upload = $upload;
        $this->faq = $faq;
        $this->page = $page;
         
    }

    /**
     * Admin Dashbord
     */
    public function index(Request $request){
        $title = __('Dashboard');
        $totalUser = $this->user->getUserCount(3,$request);
        $planform_fee = 0;
        $commission = 0;
        $total_charges = 0;
        $redeem = $this->statement->orderBy('id', 'desc')->get();
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $redeem = $this->statement->whereBetween('created_at', array($from_date, $end_date))->get();
            
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $redeem = $this->statement->whereDate('created_at', '=', $date)->get();
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $redeem = $this->statement->whereDate('created_at', '=', $date)->get();
        }  
       
        foreach($redeem as $key => $value){
            $planform_fee += $value->platform_fee;
            $commission += $value->commission;
            $total_charges += $value->total_commission;
        }
         
        $users = [];
        $usersData = User::where("created_at",">", Carbon::now()->subMonths(3))->where('role_id',3)->orderBy('created_at','desc')->select('id','created_at')->get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('M');
        })->toArray();
        foreach($usersData as $key => $val){
            $users[] = count($val);
        }

        /**
         * Line Chart Users
         */
        $date = Carbon::now();
        $chart = new UserChart;
        $chart->title('Last Three Months Records');
        $chart->labels([$date->format('F').'-'.$date->format('Y'), $date->startOfMonth()->subMonth()->format('F').'-'.$date->format('Y'), $date->startOfMonth()->subMonth(1)->format('F').'-'.$date->format('Y')]);
        $chart->dataset('Customers', 'line', $users)->options([
            'fill' => true,
            'color' =>'#28a745',
            'borderColor' => '#28a745'
        ]);

        /**
         * week
         */
        $now = Carbon::now();
        $startDate = $now->startOfWeek()->format('Y-m-d H:i');
        $endDate = $now->endOfWeek()->format('Y-m-d H:i');
        
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $dateRange = CarbonPeriod::create($from_date, $end_date)->toArray();
            foreach($dateRange as $key => $val){
               $day[] = $val->format('d-M');
           }
           $startDate = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
           $endDate = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
        }else{
            for ($i = 0; $i < 7; $i++) {
                $day[] = $now->startOfWeek()->addDays($i)->format('d-M');
            }
        }
        
        $query = $this->statement->whereBetween('created_at', array($startDate, $endDate))->sortable()->orderBy('id', 'desc');
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $query = $this->redeem->whereBetween('created_at', array($from_date, $end_date))->sortable()->orderBy('id', 'desc');
        }
        $result = $query->paginate(30)->groupBy(function ($item) {
            return $item->created_at->format('d-M');
        })->toArray();
        $planformFeeData = [];
        $commissionData = [];
        $totalChargesData = [];

        if($result){
            foreach($result as $key => $val){
                $planform_fee_key=0;
                $commission_key=0;
                $total_charges_key=0;
                foreach($val as $itemKey => $item){
                    $planform_fee_key += $item['platform_fee'];
                    $commission_key += $item['commission'];
                    $total_charges_key += $item['total_commission'];
                }
                $planformFeeData[$key] = Helper::__numberFormat($planform_fee_key,2);
                $commissionData[$key] = Helper::__numberFormat($commission_key,2); 
                $totalChargesData[$key] = Helper::__numberFormat($total_charges_key,2);  
            }
        }
        //pr($planformFeeData); die;
       
        foreach($day as $key => $val){
            $resultPlanformFeeData[] = isset($planformFeeData[$val]) ? $planformFeeData[$val] :Helper::__numberFormat(0,2);
            $resultcommissionData[] = isset($commissionData[$val]) ? $commissionData[$val] :Helper::__numberFormat(0,2);
            $resulttotalChargesData[] = isset($totalChargesData[$val]) ? $totalChargesData[$val] :Helper::__numberFormat(0,2);
        } 
        
        /**
         * Line Chart redeemsChart
         */
        $date = Carbon::now();
        $redeemsChart = new SubscriptionRedeemsChart;
        $redeemsChart->labels($day);
        $redeemsChart->dataset('Planform Fee', 'line', $resultPlanformFeeData)->options([
            'fill' => true,
            'color' =>'#28a745',
            'borderColor' => '#28a745'
        ]);
        $redeemsChart->dataset('Commission', 'line', $resultcommissionData)->options([
            'fill' => true,
            'color' =>'#000',
            'borderColor' => '#000'
        ]);
        $redeemsChart->dataset('Total Commission (Inc Taxes)', 'line', $resulttotalChargesData)->options([
            'fill' => true,
            'color' =>'#0062cc',
            'borderColor' => '#0062cc'
        ]);
        $planData = $this->user;
        $planData = $request->query();

        /**
         * Plan subscribed Qty
         */
        

        $subscriptionQty = $this->order->sum('qty');
        $redeemQty = $this->statement->where('is_pay',1)->sum('qty');
        $walletAmount = $this->wallet->where('type',1)->sum('amount');
        $invested = $this->statement->where('is_pay',0)->sum('capital_balance');
        $withdrawal = $this->statement->where('is_pay',1)->sum('realised_profit');
        $startPms = $this->order->where('is_pms',1)->count();
        $stopPms = $this->order->where('is_pms',0)->count();

        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $subscriptionQty = $this->order->whereBetween('created_at', array($from_date, $end_date))->sum('qty');
            $redeemQty = $this->redeem->whereBetween('created_at', array($from_date, $end_date))->sum('qty');
            $walletAmount = $this->wallet->whereBetween('created_at', array($from_date, $end_date))->where('type',1)->sum('amount');
            $orderAmount = $this->order->whereBetween('created_at', array($from_date, $end_date))->get();
            $withdrawal = $this->redeem->whereBetween('created_at', array($from_date, $end_date))->sum('final_pl');
            
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $subscriptionQty = $this->order->whereDate('created_at', '=', $date)->sum('qty');
            $redeemQty = $this->redeem->whereDate('created_at', '=', $date)->sum('qty');
            $walletAmount = $this->wallet->whereDate('created_at', '=', $date)->where('type',1)->sum('amount');
            $orderAmount = $this->order->whereDate('created_at', '=', $date)->get();
            $withdrawal = $this->redeem->whereDate('created_at', '=', $date)->sum('final_pl');


        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $subscriptionQty = $this->order->whereDate('created_at', '=', $date)->sum('qty');
            $redeemQty = $this->redeem->whereDate('created_at', '=', $date)->sum('qty');
            $walletAmount = $this->wallet->whereDate('created_at', '=', $date)->where('type',1)->sum('amount');
            $orderAmount = $this->order->whereDate('created_at', '=', $date)->get();
            $withdrawal = $this->redeem->whereDate('created_at', '=', $date)->sum('final_pl');
        }

         

        return view('admin.home.dashboard', compact('stopPms','startPms','withdrawal','invested','walletAmount','walletAmount','redeemQty','subscriptionQty','planData','title','totalUser','planform_fee','commission','total_charges','chart','redeemsChart'));
    }

    /**
     * @method get
     *
     * get user profile
     */
    public function profile()
    {
        $title = __('Profile');
        $user = auth()->guard($this->guard)->user();
        return view('admin.home.profile', compact('title', 'user'));
    }

    /**
     * @method post
     * update profile
     */
    public function doprofile(UserRequest $request)
    {
        $user = auth()->guard($this->guard)->user();
        $this->user->updateProfile($user, $request);
        return redirect()->route('admin.profile')->with('success', __('Profile has been changed successfully.'));
    }

    /**
     * @method get
     */
    public function changePassword()
    {
        $title = __('Change Password');
        $user = auth()->guard($this->guard)->user();
        return view('admin.home.password', compact('title', 'user'));
    }

    /**
     * @method post
     *
     * update current password
     */
    public function dochangePassword(UserRequest $request)
    {
        $user = auth()->guard($this->guard)->user();
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('admin.changePassword')->with('success', __('Password changed successfully.'));
    }

    /**
     * @method get
     *
     * Set Notification count
     *
     * @param $id
     */
    public function notification($id)
    {
        $data = $this->notification->findUpdate(Helper::decode($id));
        return redirect()->to($data->url);
    }

    /**
     * @method get
     *
     * Get all notification list
     */
    public function notificationList(Request $request)
    {
        $title = __('Notifications');
        $data = $this->notification->list($request, $this->limit, auth()->guard($this->guard)->user()->id);
        return view('admin.home.notification', compact('title', 'data', 'request'));

    }

    /**
     * @method get
     *
     * Get all notification list
     */
    public function notificationDelete($id)
    {
        $data = $this->notification->delete(Helper::decode($id));
        return redirect()->route('admin.notificationList')->with('success', __('Notification deleted successfully.'));
    }

    /**
     * @method get
     *
     * Get all notification list
     */
    public function notificationDeleteAll()
    {
        $id = auth()->guard($this->guard)->user()->id;
        $data = $this->notification->deleteAll($id);
        return redirect()->route('admin.notificationList')->with('success', __('Notification deleted successfully.'));
    }

    /**
     * @method get
     */
    public function permission(){

        $title = __('Permission');
        $user = auth()->guard($this->guard)->user();
        return view('admin.home.permission', compact('title', 'user'));
    }

    

    /**
     * Password Resset
     * @param $token
     * @method get
     */
    public function resetPassword($token)
    {
        $title = __('Reset Password');
        $passwordReset = $this->PasswordReset->where('token', $token)->firstOrfail();
        if (Carbon::parse($passwordReset->updated_at)->addDays($this->expireDay)->isPast()) {
            return redirect($this->redirectTo)->with('error', __('The reset password link expires after it has been used once'));
        }
        return view('auth.passwords.reset', compact('title', 'passwordReset'));
    }

    /**
     * Password Reset
     * @method post
     * @param $token
     */
    public function doresetPassword(PasswordResetRequest $request, $token)
    {
        $passwordReset = $this->PasswordReset->where('token', $token)->firstOrfail();
        $user = $this->userModel->userbyEmail($passwordReset->email);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        return redirect()->route('home')->with('success', __('Password changed successfully, Please login again.'));
    }

    /**
     * Check email valid
     */
    public function checkEmail(Request $request){
        $id = 0;
        if($request->get('id')){
            $id = $request->get('id');
        }
        $validator = Validator::make($request->all(), [
            'email' => ['sometimes','max:50','required','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', Rule::unique('users')->ignore($request->get('id'))->whereNull('deleted_at')],
            'current_password' => ['sometimes', 'required', 'min:6', function ($attribute, $value, $fail) use ($request) {
                $user = User::where('id', $request->id)->first();
                if ($request->get('current_password')) {
                    if (!Hash::check($request->current_password, $user->password)) {
                        return $fail(trans('passwords.current_password'));
                    }
                }
            }],
            'number'    => ['sometimes','required',Rule::unique('users')->ignore($request->get('id'))->whereNull('deleted_at')],
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages();
            foreach ( $errors->all() as $val=> $error ) {
                $message[] = $error;
            }
            $response = [
                'valid' => false,
                'message' => $message[0],
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'valid' => true
            ];
            return response()->json($response,200);
        }
    }

    /**
     * Check password valid
     */
    public function checkPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'sometimes|required|string|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:6|max:50|'
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages();
            foreach ( $errors->all() as $val=> $error ) {
                $message[] = $error;
            }
            $response = [
                'valid' => false,
                'message' => $message[0],
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'valid' => true
            ];
            return response()->json($response,200);
        }
    }

    /**
     * Check email exists or not
     */
    public function checkEmailExists(Request $request){
        $validator = Validator::make($request->all(), [
            'email'    => 'sometimes|required|email|exists:users',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages();
            foreach ( $errors->all() as $val=> $error ) {
                $message[] = $error;
            }
            $response = [
                'valid' => false,
                'message' => $message[0],
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'valid' => true
            ];
            return response()->json($response,200);
        }
    }

    

     /**
     * Account active
     *
     * @param $token
     */
    public function accountActive($token)
    {
        $user = $this->userModel->where('token', $token)->first();
        if(empty($user)){
            return redirect()->route('home')->with('error', __('The account verified link expires after it has been used once'));
        }
        if (Carbon::parse($user->updated_at)->addDays($this->expireDay)->isPast()) {
            return redirect()->route('home')->with('error', __('The account verified link expires after it has been used once'));
        }
        if($user->role_id == 5){
            $user->status = 2;
        }else{
            $user->status = 1;
        }
        $user->token = null;
        $user->email_verified_at = Carbon::now();
        $user->save();
        /**
         * Send Email
         */
        $this->email->sendEmail(4, $user, null,null);
        return redirect()->route('home')->with('success', __('Your account is verified. You can now login.'));
    }

    /**
     * getStatus
     *
     * @param id
     */
    public function getStatus(Request $request){
        $data = $this->states->where('country_id',$request->get('country'))->orderBy('name', 'ASC')->pluck('name','id');
        return view('states',compact('data'));
    }

    public function indexHome(){
        return redirect()->route('admin.login'); 
    }


    
}
