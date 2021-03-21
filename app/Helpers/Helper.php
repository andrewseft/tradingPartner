<?php

namespace App\Helpers;

use App\Language;
use App\Manager\CacheManager;
use Illuminate\Support\Facades\Storage;
use App\Notification;
use App\Setting;
use Crypt;
use App\Constants\Constant;
use App\Country;
use App\Statement;
use Illuminate\Contracts\Encryption\DecryptException;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class Helper
{

    /**
     * @param $name |array
     * @return class
     */
    public static function activeController(array $name)
    {
        $currentAction = \Route::currentRouteAction();
        list($controller, $action) = explode('@', $currentAction);
        $controller = preg_replace('/.*\\\/', '', $controller);
        $current = $controller;
        $class = "";
        if (in_array($current, $name)) {
            $class = "show";
        }
        return $class;
    }

    /**
     * @param $name |array
     * @return class
     */
    public static function activeAction(array $name)
    {
        $currentAction = \Route::currentRouteAction();
        list($controller, $action) = explode('@', $currentAction);
        $controller = preg_replace('/.*\\\/', '', $controller);
        $current = $controller . '@' . $action;
        $class = "";
        if (in_array($current, $name)) {
            $class = "active";
        }
        return $class;
    }

    /**
     * @param $name |array
     * @return class
     */
    public static function activeActionUl(array $name)
    {
        $currentAction = \Route::currentRouteAction();
        list($controller, $action) = explode('@', $currentAction);
        $controller = preg_replace('/.*\\\/', '', $controller);
        $current = $controller;
        $class = "collapsed";
        if (in_array($current, $name)) {
            $class = "";
        }
        return $class;
    }

    /**
     * Get Setting
     */
    public static function setting()
    {
        $data = Setting::findOrFail(1);
        return $data;
    }

    /**
     * @param $string
     * @return string ucfirst
     */
    public static function mb_strtolower($string)
    {
        $encoding = 'utf8';
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }

    /**
     * @param date
     * @return Date
     */
    public static function date($date)
    {
        setlocale(LC_TIME, \App::getLocale() . '.utf8');
        return \Carbon\Carbon::parse($date)->formatLocalized('%d %B %Y');
    }

    /**
     * @value
     * return encode
     */
    public static function encode($value)
    {
        return Crypt::encrypt($value);
    }

    /**
     * @param $value
     * return decode
     */
    public static function decode($value)
    {
        try {
            return Crypt::decrypt($value);
        } catch (DecryptException $exception) {
            return 0;
        }
    }

    public static function __failedValidation($msg){
        $response = [
            'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $msg,
            'data' => (object) array(),
        ];
        throw new HttpResponseException(
            response()->json($response, JsonResponse::HTTP_CREATED)
        );
    }

    /**
     * Get Language
     */
    public static function language()
    {
        $data = CacheManager::get('languageList');
        if (empty($data)) {
            $data = Language::orderBy('created_at', 'asc')->pluck('name', 'code');
            CacheManager::put('languageList', $data);
        }
        return $data;
    }

    /**
     * Notification Count
     *
     * @param $userId
     */
    public static function notificationCount($id)
    {
        return Notification::where('user_id', $id)->where('status', 1)->orderBy('created_at', 'desc')->count();
    }

    

    /**
     * Notification List
     *
     * @param $userId
     */
    public static function notificationList($id)
    {
        return Notification::where('user_id', $id)->where('status', 1)->orderBy('created_at', 'desc')->take(10)->get();
    }

    /**
     * @param $str string
     * @return $data | String
     */
    public static function slug($str)
    {
        $data = preg_replace('/\s+/', '-', $str);
        return mb_strtolower($data);
    }

    /**
     * Get page id
     * @param $slug
     */
    public static  function pageId($slug){
        $page = array('about-us'=>1,'how-to-works'=>2,'faqs'=>3,'privacy-policy'=>4,'terms-conditions'=>5,'contact'=>6,'delivery-policy'=>7,'refund-policy'=>8,'cancellation-policy'=>9);
        if(isset($page[$slug])){
            return $page[$slug];
        }
        return 0;
    }


    /**
     * Send FCM Notification
     * @param $token
     * @param $notification array('body':'','title':'')
     */
    public static  function notification($token,$notification,$sendUrl){
        
        $server_key = Constant::FCM_KEY;
        $url = 'https://fcm.googleapis.com/fcm/send';

	    $data = [
				"title"=> Constant::APP_NAME,
				"body"=> $notification,
				"icon" => '/logo.png',
				"url" => $sendUrl,
		];
        $fields = array (
                'registration_ids' => [$token],
                'data' => $data,
                "notification" => $data
        );
	    $fields = json_encode ( $fields );
        $headers = array (
                'Authorization: key='.$server_key,
                'Content-Type: application/json'
        );
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        $result = curl_exec ( $ch );
        curl_close ( $ch );
        return true;
         
    }

    /**
	 *  Get userPermission
	 *  @param string $type
	 *  @param int $user
	 *  @type controller|action
	 */
	public static function userPermission($type,$user){
		$roleId = $user->role_id;
		$controller = [];
		$action = [];
		if(!empty($user)){
            $data = json_decode($user->permission);
            if(!empty($data)){
                    foreach($data as $key => $value){
                        $controller[$key] = $key;
                        foreach($value as $actionKey => $actionValue){
                        $action[$key.'@'.$actionValue] = $key.'@'.$actionValue;
                        }
                    }
            }
		}
		if($type == "controller"){
			return $controller;
		}else if($type == "action"){
			return $action;
		}
    }

    /**
	 *  Check user permission on controller
	 *  @return true|false
	 *  @param $name|string
	 */
	public static function permissionController(string $name)
	{
		$id = auth()->guard(Constant::GUARD)->user()->id;
        $roleId = auth()->guard(Constant::GUARD)->user()->role_id;
        $user = auth()->guard(Constant::GUARD)->user();
		$return = true;
		if($roleId == Constant::SUB_ADMIN){
            $data = static::userPermission('controller',$user);
            $return = false;
			if(in_array($name,$data)){
				$return = true;
			}
		}
		return $return;
    }

    /**
	 *  @param request()->route()->getAction()
	 *  @return Controller@action
	 */
	public static function currentAction(){
        $currentAction = \Route::currentRouteAction();
        $segment = \Request::segment(3);
        $name =  request()->route()->getAction()['as'];
		list($controller, $action) = explode('@', $currentAction);
		$controller = preg_replace('/.*\\\/', '', $controller);
        $current = $controller.'@'.$segment;
		return $current;
    }

    /**
	 *  Check user permission on action
	 *  @return true|false
	 *  @param $name|string
	 */
	public static function permissionAction(string $name){
		$id = auth()->guard(Constant::GUARD)->user()->id;
        $roleId = auth()->guard(Constant::GUARD)->user()->role_id;
        $user = auth()->guard(Constant::GUARD)->user();
		$return = true;
		if($roleId == Constant::SUB_ADMIN){
			$data = static::userPermission('action',$user);
			$return = false;
			if(in_array($name,$data)){
				$return = true;
			}
		}
		return $return;
    }

    /**
     * check image exists or not on storage
     * @param $name|string
     */
    public static function exists($name){
        return Storage::disk(Constant::DISK)->exists($name);
    }

    /**
     * get image url
     * @param $name|string
     */
    public static function getImageUrl($name){
        return Storage::disk(Constant::DISK)->url($name);
    }

    /**
     * Remove image on storage
     */
    public static function removeImage($path,$thum_path){
        Storage::disk(Constant::DISK)->delete([$path,$thum_path]);
    }

    /**
     * get country
     */
    public static function country(){
        return Country::orderBy('name', 'ASC')->pluck('name','id');
    }

    /**
     * @param $number
     * @param $message
     */
    public static function __sendOtp($number,$message){

        $accountSid = Constant::TWILIO_ACCOUNT_SID;
        $authToken  = Constant::TWILIO_AUTH_TOKEN;
        $client = new Client($accountSid, $authToken);
        try{
            $client->messages->create(
                $number,
                array(
                    'from' => Constant::TWILIO_FROM,
                    'body' => $meassge
                )
            );
            return true;
        }catch (\Exception $e){
            return true;
        }
    }

    /**
     * create random strings
     */
    public static function _random_strings($length_of_string)
    {

        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),0, $length_of_string);
    }

    /**
     * Function to generate OTP
     */
    public static function __generateNumericOTP($n) {
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        return $result;
    }

    /**
     * Number for format
     */
    public static function __numberFormat($amount){
        //return number_format($amount,2,'.', '');
        return number_format($amount,2);
    }

    /**
     * user Statement
     */
    public static function __statement($userId,$planId){
        $data = [];
        $data = Statement::where('user_id',$userId)->where('plan_id',$planId)->where('is_pay',0)->orderBy('id', 'ASC')->get();
        return $data;
    }

    /**
     * user Statement stop
     */
    public static function __statementStop($userId,$planId){
        $data = [];
        $data = Statement::where('user_id',$userId)->where('plan_id',$planId)->where('is_pay',1)->orderBy('id', 'ASC')->get();
        return $data;
    }

    


     


}
