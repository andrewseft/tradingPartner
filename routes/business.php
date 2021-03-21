<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
Route::group(['middleware'=>'minifier'], function(){

    Route::group(['prefix' => 'tradingPartner-business', 'namespace' => 'Business'], function () {
         
        Route::get('logout', 'Auth\LoginController@logout')->name('business.logout');
        Route::any('/', function () {
            return redirect(route('business.login'));
        });
    });

    Route::group(['prefix' => 'tradingPartner-business', 'namespace' => 'Business', 'middleware' => ['guest:business']], function () {
        Route::get('login', 'Auth\LoginController@login')->name('business.login');
        Route::post('login', 'Auth\LoginController@dologin')->name('business.login');
        Route::get('forgot-password', 'Auth\ForgotPasswordController@forgotPassword')->name('business.forgotPassword');
        Route::post('forgot-password', 'Auth\ForgotPasswordController@doforgotPassword')->name('business.forgotPassword');
        Route::get('reset-password/{token}', 'Auth\ResetPasswordController@resetPassword')->name('business.resetPassword');
        Route::post('reset-password/{token}', 'Auth\ResetPasswordController@doresetPassword')->name('business.resetPassword');
    });

    Route::group(['prefix' => 'tradingPartner-business', 'middleware' => ['auth:business','Checkbusiness'], 'namespace' => 'business'], function () {

        Route::group(['middleware' => 'prevent-back-history'], function () {

            /**
             * Dashboard/Profile/changePassword
             */
            Route::any('dashboard', 'BookingController@index')->name('business.dashboard');
            Route::get('profile', 'HomeController@profile')->name('business.profile');
            Route::post('profile', 'HomeController@doprofile')->name('business.profile');
            Route::get('change-password', 'HomeController@changePassword')->name('business.changePassword');
            Route::post('change-password', 'HomeController@dochangePassword')->name('business.changePassword');
            Route::get('notification', 'HomeController@notificationList')->name('business.notificationList');
            Route::get('notification/delete/{id}', 'HomeController@notificationDelete')->name('business.notification.delete');
            Route::get('notification/deleteAll', 'HomeController@notificationDeleteAll')->name('business.notification.deleteAll');
            Route::get('notification/{id}', 'HomeController@notification')->name('business.notification');

            /**
             * Booking
             */
            Route::group(['prefix' => 'booking'], function () {
                Route::get('/index', 'BookingController@index')->name('business.booking');
                Route::get('view/{id}', 'BookingController@view')->name('business.booking.view');
                Route::get('cancel', 'BookingController@cancel')->name('business.booking.cancel');
                Route::get('add', 'BookingController@add')->name('business.booking.add');
                Route::post('create', 'BookingController@create')->name('business.booking.create');
                Route::get('/addMore', 'BookingController@addMore')->name('business.booking.addMore');

                Route::get('payment', 'BookingController@payment')->name('business.payment');
                Route::post('dopayment', 'BookingController@doPayment')->name('business.dopayment');
                
            });

        });
    });
});

 

 
