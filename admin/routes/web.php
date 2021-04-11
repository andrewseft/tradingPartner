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

Route::get('/clear_cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return "Cache is cleared";
});
Route::get('/removeFolder', 'HomeController@removeFolder')->name('removeFolder');

Route::group(['middleware'=>'minifier'], function(){
    Route::get('/', 'HomeController@indexHome')->name('home');
    Route::post('/checkEmail', 'HomeController@checkEmail')->name('checkEmail');
    Route::post('/checkOtp', 'HomeController@checkOtp')->name('checkOtp');
    Route::post('/checkPassword', 'HomeController@checkPassword')->name('checkPassword');
    Route::get('/account/active/{token}', 'HomeController@accountActive')->name('account.active');
    Route::get('reset-password/{token}', 'HomeController@resetPassword')->name('front.resetPassword');
    Route::post('reset-password/{token}', 'HomeController@doresetPassword')->name('front.resetPassword');
    Route::post('checkEmailExists', 'HomeController@checkEmailExists')->name('checkEmailExists');
    Route::get('country/status', 'HomeController@getStatus')->name('getStatus');
    Route::post('/contact/save', 'PageController@sendContact')->name('page.contact');
    Route::get('/checkSubscription', 'PageController@checkSubscription')->name('page.checkSubscription');

});


/**
 * Pr function
 * @param string
 * @return string
 *
 */
function pr($string)
{
    echo "<pre>";
    print_r($string);
    echo "</pre>";
    die;
}

