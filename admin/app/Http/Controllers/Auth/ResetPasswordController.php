<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Constants\Constant;
use App\Http\Requests\PasswordResetRequest;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\Manager\NotificationManager;
use App\Manager\EmailManager;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NotificationManager $NotificationManager,EmailManager $emailManager)
    {
        $this->middleware('guest');
        $this->PasswordReset = new PasswordReset();
        $this->redirectTo = Constant::REDIRECT_LOGIN;
        $this->expireDay = Constant::EXPIRE_DAY;
        $this->userModel = new User();
        $this->email = $emailManager;
        $this->notification = $NotificationManager;

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
        return view('admin.auth.passwords.reset', compact('title', 'passwordReset'));
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
        $PASSWORD_RESET = Helper::translateLanguage('PASSWORD_RESET',[],$user->language);
        $PASSWORD_CHANGED = Helper::translateLanguage('PASSWORD_CHANGED',[],$user->language);
        $this->notification->send($user,route('admin.dashboard'),$PASSWORD_RESET,$PASSWORD_CHANGED);

        return redirect()->route('admin.login')->with('success', __('Password changed successfully, Please login again.'));

    }
}
