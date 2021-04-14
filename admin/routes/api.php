<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


 
Route::group(['prefix' => 'v1'], function () {
    Route::post('register', 'API\AuthController@register');
    Route::post('checkOtp', 'API\AuthController@checkOtp');
    Route::post('resendOtp', 'API\AuthController@resendOtp');
    Route::post('resetPassword', 'API\AuthController@resetPassword');
    Route::post('login', 'API\AuthController@login');
    Route::post('forgotPassword', 'API\AuthController@forgotPassword');
    Route::get('getInvestmentCapital', 'API\CommonController@getInvestmentCapital');
    Route::post('contactUs', 'API\PageController@contactUs')->name('contactUs');
    Route::get('setting', 'API\SettingController@index')->name('setting');
    Route::get('home_page', 'API\PageController@homePage')->name('homePage');
    
    
    /**
     * Page
     */
    Route::group(['prefix' => 'pages'], function () {
        Route::get('{slug}', 'API\PageController@index')->name('page');
    });

   
    Route::group(['prefix' => 'user'], function () {
        Route::get('/logout', 'API\UserController@logout');
    });
    
    Route::group(['middleware' => ['auth:api']], function () {
        Route::group(['middleware' => ['CheckUser']], function () {

            /**
             * Users
             */
            Route::group(['prefix' => 'user'], function () {
                Route::post('/changePassword', 'API\UserController@changePassword');
                Route::post('/profile', 'API\UserController@updateProfile');
                Route::get('/referral', 'API\UserController@getReferral');
                Route::get('/profile', 'API\UserController@getProfile');
                Route::get('/notification', 'API\UserController@getNotification');
                Route::post('/notificationUpdate', 'API\UserController@notificationUpdate');
                Route::get('/removeAllNotification', 'API\UserController@removeNotification');
                Route::get('/pms', 'API\UserController@homePage');
            });

            /**
             * wallet
             */
            Route::group(['prefix' => 'wallet'], function () {
                Route::get('/', 'API\WalletController@index')->name('wallet');
                Route::post('add', 'API\WalletController@add')->name('wallet.add');
                Route::get('passbook', 'API\WalletController@passbook')->name('wallet.passbook');
                 
            });

             /**
             * plan
             */
            Route::group(['prefix' => 'plan'], function () {
                Route::post('/', 'API\PlanController@index')->name('plan');
                Route::get('/details/{id}', 'API\PlanController@detail')->name('planDetails');
                Route::get('/detailsSlug/{id}', 'API\PlanController@detailSlug')->name('detailSlug');
                Route::post('/graph', 'API\PlanController@graph')->name('graph');
                Route::post('/buy', 'API\OrderController@buyPlan')->name('plan.buy');
                Route::post('/pmsStop', 'API\OrderController@pmsStop')->name('plan.pmsStop');
            });

            /**
             * order
             */
            Route::group(['prefix' => 'order'], function () {
                Route::post('/list', 'API\OrderController@list')->name('order.list');
                Route::get('/details/{id}', 'API\OrderController@detail')->name('order.details');
            });

            /**
             * subscription
             */
            Route::group(['prefix' => 'subscription'], function () {
                Route::post('/position', 'API\SubscriptionController@position')->name('subscription.position');
                Route::post('/holding', 'API\SubscriptionController@holding')->name('subscription.holding');
                Route::post('/redeem', 'API\SubscriptionController@redeem')->name('subscription.redeem');
                Route::post('/statement', 'API\SubscriptionController@statement')->name('subscription.statement');
                Route::post('/excel', 'API\SubscriptionController@excel')->name('subscription.excel');
                Route::post('/setRedeem', 'API\SubscriptionController@setRedeem')->name('subscription.setRedeem');
                Route::post('/cancelRedeem', 'API\SubscriptionController@cancelRedeem')->name('subscription.cancelRedeem');
                Route::get('/details/{id}', 'API\SubscriptionController@detail')->name('subscription.details');
            });

            /**
             * Trading
             */
            Route::group(['prefix' => 'trading'], function () {
                Route::post('/', 'API\TradingController@trading')->name('order.trading');
            });

            /**
             * Withdrawal
             */
            Route::group(['prefix' => 'withdrawal'], function () {
                Route::post('/', 'API\WithdrawalController@index')->name('withdrawal');
            });
           
             

        });
    });
        

});
