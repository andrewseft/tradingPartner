<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Constants\Constant;
use App\Helpers\Helper;
use App\Http\Requests\UserRequest;
use App\Manager\EmailManager;
use App\Manager\UploadManager;
use App\Manager\NotificationManager;
use App\User;
use App\InvestmentCapital;
use Carbon\Carbon;
use App\Manager\CacheManager;
use App\Jobs\PushNotificationios;
 

class CustomerController extends Controller
{
    public function __construct(InvestmentCapital $investmentCapital, User $user,EmailManager $emailManager,NotificationManager $NotificationManager,UploadManager $upload,CacheManager $cacheManager)
    {
        $this->limit = Helper::setting()->admin_limit;
        $this->email = $emailManager;
        $this->notification = $NotificationManager;
        $this->upload = $upload;
        $this->user = $user;
        $this->cache = $cacheManager;
        $this->investmentCapital = $investmentCapital;

    }

    /**
     * @method get
     *
     * Get customer Form
     */
    public function add()
    {
        $title = __('Customer');
        $user = $this->user;
        $user->latitude = Constant::LAT;
        $user->longitude = Constant::LON;
        $investmentCapital = $this->investmentCapital->where('status',1)->get()->pluck('name','id');
        return view('admin.customer.add', compact('title','user','investmentCapital'));
    }

    /**
     * Create new user
     *
     * @method post
     */
    public function create(UserRequest $request){
        
        $data = $this->user;
        if (!empty($request->get('id'))) {
            $data = $this->user->findOrFail($request->get('id'));
        }
        if (empty($request->get('id'))){
            $data->role_id = 3;
            $data->status = 1;
            $data->token = \Str::uuid();
            $data->referral_code = Helper::__generateNumericOTP(8);
        }
        $data->first_name = $request->get('first_name');
        $data->last_name = $request->get('last_name');
        $data->email = $request->get('email');
        $data->address = $request->get('address');
        $data->latitude = $request->get('latitude');
        $data->longitude = $request->get('longitude');
        $data->investmentCapital = $request->get('investmentCapital');
        if($request->get('password')){
            $data->password = bcrypt($request->get('password'));
        }
        $data->number = $request->get('number');
        if ($request->hasFile('image')) {
            $data->image = $this->upload->image($request->file('image'), $request->old_image, Constant::USER_IMAGE, Constant::USER_IMAGE_THUMB, Constant::USER_IMAGE_HEIGHT, Constant::USER_IMAGE_WIDTH, true);
        }
        $data->save();
        if (empty($request->get('id'))){
            /**
             * Send Email
             */
            $userEmail = $this->user->where('email',$request->email)->first();
            $userEmail->show_password = $request->password;
            $url = route('account.active', $userEmail->token);
            $this->email->sendEmail(Constant::CREATE_ACCOUNT, $userEmail, $url,null);
        }
        if (!empty($request->get('id'))){
            $this->cache->clear('App\User');
                /**
                 * Send Notification
                 * Sent Email
                 */
                $ACCOUNT_STATUS = trans('message.ACCOUNT_STATUS');
                $meassge = trans('message.ACCOUNT_MESSAGE_UPDATE');
                $this->notification->send($data,route('home'),$ACCOUNT_STATUS,$meassge);
                return redirect()->route('admin.customer')->with('success', __('Recode has been changed sucessfull.'));

            }
        $this->cache->clear('App\User');
        return redirect()->route('admin.customer')->with('success', __('Record has been added successfully.'));
    }

    /**
     * @method get
     *
     * List of Users
     */
    public function index(Request $request)
    {
        $title = __('Customers');
        $user = $this->user;
        $userData = $this->user->where('role_id',3)->sortable()->orderBy('created_at', 'desc');
        if ($request->query('keyword')) {
            $name = $request->query('keyword');
            $userData->where(function($q) use($name) {
                $q->WhereRaw("concat(first_name, ' ', last_name) LIKE '%{$name}%' ")
                  ->orwhere('email', 'LIKE', "%{$name}%")->orwhere('number', 'LIKE', "%{$name}%");
            });
        }
        if ($request->query('status')) {
            $name = $request->query('status');
            if($name == 2){
                $name = 0;
            }
            $userData->where('status',$name);
        }
        if ($request->query('is_kyc')) {
            $name = $request->query('is_kyc');
            if($name == 3){
                $name = 0;
            }
            $userData->where('is_kyc',$name);
        }
        if ($request->query('investmentCapital')) {
            $name = $request->query('investmentCapital');
            $userData->where('investmentCapital',$name);
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $userData->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $userData->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $userData->whereDate('created_at', '=', $date);
        }
        $data = $userData->paginate($this->limit);
        $data->appends($request->query());
        $user = $request->query();
        return view('admin.customer.index', compact('title', 'data', 'request', 'user'));
    }


    /**
     * update status
     * @param $id
     * @param $status
     */
    public function process ($id,$status,Request $request){
        $user = $this->user->findOrFail(Helper::decode($id));
        $this->user->where('id', Helper::decode($id))
                ->update(['status' => Constant::ITEM_STATUS_SHOW[$request->get('status')]]);
        /**
         * Send Notification
         * Sent Email
         */
        $ACCOUNT_STATUS = trans('message.ACCOUNT_STATUS');
        $meassge = trans('message.ACCOUNT_MESSAGE_ACITVE');
        if($status == 0){
            $meassge = trans('message.ACCOUNT_MESSAGE_DEACITVE');
        }
        $this->notification->send($user,route('home'),$ACCOUNT_STATUS,$meassge);
        return true;
    }

    /**
     * update kyc 
     * @param $id
     * @param $status
     */
    public function kycProcess ($id,$status,Request $request){
        $user = $this->user->findOrFail(Helper::decode($id));
        $this->user->where('id', Helper::decode($id))
                ->update(['is_kyc' => $status]);
        /**
         * Send Notification
         * Sent Email
         */
       
        $ACCOUNT_STATUS = trans('message.ACCOUNT_STATUS');
        $meassge = trans('message.ACCOUNT_MESSAGE_ACITVE_KYC');
        if($status == 2){
            $meassge = trans('message.ACCOUNT_MESSAGE_REJECT_KYC',[ 'MESSAGE' => $request->message ]);
        }
         
        $this->notification->send($user,route('home'),$ACCOUNT_STATUS,$meassge);
        return redirect()->route('admin.customer')->with('success', __('Recode is changed sucessfull.'));
    }

     

    /**
     * Edit
     * @param $id
     * @method get
     *
     */
    public function edit ($id){
        $title = __('Edit Customer');
        $user = $this->user->findOrFail(Helper::decode($id));
        $investmentCapital = $this->investmentCapital->where('status',1)->get()->pluck('name','id');
        return view('admin.customer.edit',compact('title','user','investmentCapital'));
    }

    /**
     * Change password form
     * @param $id
     * @method get
     *
     */
    public function chnagePassword($id){
        $title = __('Change Password');
        $user = $this->user->findOrFail(Helper::decode($id));
        return view('admin.customer.chnagePassword',compact('title','user'));
    }

    /**
     * doUpdatePassword
     * @method post
     */
    public function doUpdatePassword(UserRequest $request){
        $user = $this->user->findOrFail($request->get('id'));
        $user->password = bcrypt($request->get('password'));
        $user->save();
        /**
         * Send Notification
         * Push Notification
         * Sent Email
         */
        $ACCOUNT_STATUS = trans('message.ACCOUNT_STATUS');
        $meassge = trans('message.PASSWORD_CHANGED_ADMIN',[ 'PASSWORD' => $request->get('password') ]);
        $this->notification->send($user,route('home'),$ACCOUNT_STATUS,$meassge);
        return redirect()->route('admin.customer')->with('success', __('Recode is changed sucessfull.'));
    }

    /**
     * Delete
     * @param $id
     * @method get
     *
     */
    public function delete($id){
        $user = $this->user->findOrFail(Helper::decode($id));
        $booking = $this->booking->where('user_id',$user->id)->first();
        if($booking){
            return  redirect()->back()->with('error', __("We can't delete this customer, because it has made some bookings"));
        }
        /**
         * Unlink image
         */
        if ($user->image != null) {
            $path = Constant::USER_IMAGE.$banner->image;
            $path_thum = Constant::USER_IMAGE_THUMB.$banner->image;
            Helper::removeImage($path,$path_thum);
        }
        $user->delete();
        return  redirect()->back()->with('success', __('Record is deleted sucessfully..'));
    }

    /**
     * view
     * @param $id
     * @method get
     *
     */
    public function view ($id){
        $title = __('View Profile');
        $user = $this->user->findOrFail(Helper::decode($id));
        $investmentCapital = $this->investmentCapital->where('status',1)->get()->pluck('name','id');
        return view('admin.customer.view',compact('title','user','investmentCapital'));
    }
}
