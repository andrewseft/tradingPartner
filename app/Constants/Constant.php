<?php

namespace App\Constants;

class Constant
{

    const APP_NAME = 'BANKNIFTY PMS';
    const REDIRECT_TO = '/admin/dashboard';
    const LOGIN_PATH = '/admin';
    const REDIRECT_AFTER_LOGOUT = '/admin/login';
    const REDIRECT_LOGIN = '/admin/login';
    const GUARD = 'admin';

    const NO_IMAGE_USER = 'user.png';

    

    
    const EXPIRE_DAY = 1;
    const SHOULD_QUEUE = 2;
    const CACHE_TIME = 12;
    const SUB_ADMIN = 2;
    const ATTEMPTS = 3;
    const LOCKOUT_MINITES = 10;
    const ADMIN = 1;
    const STATUS = 1;
    const DATE = 'd-m-Y';
    const DISK = 'public';
    const CACHE_STORE = 'redis';
    const REDIS_CACHE_TIME = 60 * 60 * 24 * 365;
    const NOTIFICATION_STATUS = [1=>'Unread',2=>'Read'];
    const ITEM_STATUS = [1=>'Active',2=>'Deactive'];
    const CURRENCY = "₹";
    const ITEM_STATUS_SHOW = ['false'=>0,'true'=>1];

    const WITHDRAWAL_STATUS = [1=>'Paid',2=>'Unpaid'];
    
    /**
     * User Image
     */
    const IMAGE_PATH = 'app/public/';
    const USER_IMAGE = 'user/';
    const USER_IMAGE_THUMB = 'user/thumb/';
    const USER_IMAGE_HEIGHT = 200;
    const USER_IMAGE_WIDTH = 200;

    const BANNER_IMAGE = 'banner/';
    const BANNER_IMAGE_THUMB = 'banner/thumb/';
    const BANNER_IMAGE_HEIGHT = 750;
    const BANNER_IMAGE_WIDTH = 350;

    

    /**
     * Contact us image
     */
    const CON_IMAGE = 'contact/';
    const CON_IMAGE_THUMB = 'contact/thumb/';
    const CON_IMAGE_HEIGHT = 200;
    const CON_IMAGE_WIDTH = 200;

    const DOC_IMAGE = 'doc/';
    const DOC_IMAGE_THUMB = 'doc/thumb/';
    const DOC_IMAGE_HEIGHT = 200;
    const DOC_IMAGE_WIDTH = 200;
    const PAGES_ARRAY = ['about-us','faq','how-it-work','privacy-policy','terms-conditions','refund-policy','cancellation-policy','return-policy','refund-policy'];
    const PAGES = ['about-us'=>1,'privacy-policy'=>2,'terms-conditions'=>3,'cancellation-policy'=>6,"return-policy"=>7,"refund-policy"=>8];
    
    /**
     * Email
     */
    const FORGOT_PASSWORD = 1;
    const RESET_PASSWORD =  2;
    const CREATE_ACCOUNT =  3;
    const OTP = 7;

    const MAP_URL = 'https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCVvIVJNXxge7xqWqEXTEaMiDLSOTYfOkA&libraries=places,drawing';
    const LAT = 28.5355161;
    const LON = 77.39102649999995;
    const ZOOM = 5;

    const FCM_KEY = "AAAAHomf_Vw:APA91bG3YysQxhyFTW04mw9WUBtxrRLLb8t3C5L8Cu5RGw3B6Mo6RBb_EBGrVDslRtidsmHwqK8YDz_VcWPKZRY2JCJUAy10Rq_Qf0apAM_zdJUz7HBBxG1a9eUYRjxJcqBfQIBKnVW_";
    const PLAN_TYPE = [1=>'Redeem',2=>'Trading',3=>'Auto'];

    const API_KEY = "rzp_test_JsWSlKngGfV7tm";
    const API_SECRET = "dbfHfQYKyIvITIlbYsg6O7Ox";




    





}
