<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Constants\Constant;
use App\Http\Requests\PasswordResetRequest;
use App\PasswordReset;
use App\Faq;
use App\Page;
use App\User;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\Manager\NotificationManager;
use App\Manager\EmailManager;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Manager\CacheManager;
use App\Manager\UploadManager;
 

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Page $page, Faq $faq,UploadManager $upload,NotificationManager $NotificationManager,EmailManager $emailManager,CacheManager $cacheManager)
    {
        $this->middleware('guest');
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug = null)
    {
        
        if($slug == 'customer-queries'){
            $title = 'Customer Queries';
            return view('page.customerQueries', compact('title'));  
        }
        if (in_array($slug,Constant::PAGES_ARRAY)){
            $id = Constant::PAGES[$slug];
            if($id != 20){
                $data = $this->page->where('id',$id)->with(['detail'])->first();
                return view('page.index', compact('data'));
            }else{
                $data = $this->faq->sortable()->with(['detail'])->orderBy('index', 'asc')->get();
                return view('page.faq', compact('data'));
            } 
        }
        $data = $this->faq->sortable()->with(['detail'])->orderBy('index', 'asc')->get();
        $aboutUs = $this->page->where('id',1)->with(['detail'])->first();
        return view('home', compact('data','aboutUs'));
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

    

     
}
