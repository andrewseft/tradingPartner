<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AuthRequest;
use App\Manager\CacheManager;


use App\Constants\Constant;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Use user model
     *
     * @var string
     */

    private $User;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Where to redirect users  login.
     *
     * @var string
     */

    protected $loginPath;
    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirectAfterLogout;
    /**
     * set guard
     *
     * @var string
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, User $user,CacheManager $cacheManager)
    {
        $this->middleware('guest:admin')->except('logout');
        $this->remember = unserialize(Cookie::get('remember_me'));
        $this->loginPath = Constant::LOGIN_PATH;
        $this->redirectAfterLogout = route('admin.login');
        $this->guard = Constant::GUARD;
        $this->User = $user;
        $this->request = $request;
        $this->attempts = Constant::ATTEMPTS;
        $this->lockoutMinites = Constant::LOCKOUT_MINITES;
        $this->cache = $cacheManager;
    }

    /**
     * Set Guard
     * @return Guard name
     */
    protected function guard()
    {
        return Auth::guard($this->guard);
    }

    /**
     * @return string
     */
    public function redirectTo()
    {
        return $this->redirectTo ?? route('admin.dashboard');

    }

    /**
     * @method get
     * @return Admin/auth/login
     */
    public function login()
    {
        
        $title = __('Login');
        $user = $this->remember;
        return view('admin.auth.login', compact('title', 'user'));
    }

    /**
     * @method  Post
     * @cookie  remember_me
     */
    public function dologin(AuthRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            if ($request->get('remember_me')) {
                $cookie['email'] = $request->email;
                $cookie['remember_me'] = $request->remember_me;
                setcookie('remember_me', serialize($cookie), time() + (86400 * 30), "/");
            } else {
                setcookie('remember_me', serialize($request->all()), time() - (86400 * 30), "/");
            }
            $this->cache->clear('App\User');
            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        $request->session()->flash('error', __('Invalid email and password, please try again'));
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param array|$user
     * Check user status and role
     */
    protected function authenticated($request, $user)
    {
        if ($user->status == 0) {
            Auth::guard($this->guard)->logout();
            $request->session()->flash('error', __('Your account is not activated, please activate your acccount from your email firstly.'));
            return redirect()->back()->withInput($request->all());
        }
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp(),
            'device_token' => $request->get('device_token')
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(\Illuminate\Http\Request $request)
    {
        return ['email' => $request->email, 'password' => $request->password,'role_id'=>[1]];
    }

    /**
     * Check Login Attempts
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->attempts, $this->lockoutMinites
        );
    }

    /**
     * @param $guard|admin
     * Delete session
     * Logout User
     */
    public function logout()
    {
        Auth::guard($this->guard)->logout();
        return Redirect::to($this->redirectAfterLogout);
    }
}
