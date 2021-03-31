<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Requests\PasswordResetRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\PasswordReset;
use App\Constants\Constant;
use App\Manager\EmailManager;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Use user model
     *
     * @var string
     */

    private $userModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user,EmailManager $emailManager)
    {
        $this->middleware('guest:admin')->except('logout');
        $this->userModel = $user;
        $this->PasswordReset = new PasswordReset();
        $this->email = $emailManager;
    }

    /**
      * @method Get
      * @return View
      * @param  string $title
      *
      * This function are forgot password request
      *
      */
    public function forgotPassword(){
        $title = __('Forgot Password');
        $user = $this->userModel;
        return view('admin.auth.passwords.forgot-password',compact('title','user'));
    }

    /**
     * @method Post
     */
    public function doforgotPassword (PasswordResetRequest $request){
        $user = $this->userModel->userbyEmail($request->email);
        $passwordReset=$this->PasswordReset->PasswordReset($user);
        $url = route('admin.resetPassword',$passwordReset->token);
        $this->email->sendEmail(Constant::FORGOT_PASSWORD,$user,$url,null);
        $request->session()->flash('success', __("We've sent you an email to reset your password. Follow the instructions and update your account information."));
        return redirect()->back()->withInput();
    }



}
