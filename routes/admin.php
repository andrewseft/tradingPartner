<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>'minifier'], function(){

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');
        Route::any('/', function () {
            return redirect(route('admin.login'));
        });
    });
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['guest:admin']], function () {
        Route::get('login', 'Auth\LoginController@login')->name('admin.login');
        Route::post('login', 'Auth\LoginController@dologin')->name('admin.login');
        Route::get('forgot-password', 'Auth\ForgotPasswordController@forgotPassword')->name('admin.forgotPassword');
        Route::post('forgot-password', 'Auth\ForgotPasswordController@doforgotPassword')->name('admin.forgotPassword');
        Route::get('reset-password/{token}', 'Auth\ResetPasswordController@resetPassword')->name('admin.resetPassword');
        Route::post('reset-password/{token}', 'Auth\ResetPasswordController@doresetPassword')->name('admin.resetPassword');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin'], 'namespace' => 'Admin'], function () {
        Route::group(['middleware' => 'prevent-back-history'], function () {

            /**
             * Dashboard/Profile/changePassword
             */
            Route::any('dashboard', 'HomeController@index')->name('admin.dashboard');
            Route::get('profile', 'HomeController@profile')->name('admin.profile');
            Route::post('profile', 'HomeController@doprofile')->name('admin.profile');
            Route::get('change-password', 'HomeController@changePassword')->name('admin.changePassword');
            Route::post('change-password', 'HomeController@dochangePassword')->name('admin.changePassword');
            Route::get('notification', 'HomeController@notificationList')->name('admin.notificationList');
            Route::get('notification/delete/{id}', 'HomeController@notificationDelete')->name('admin.notification.delete');
            Route::get('notification/deleteAll', 'HomeController@notificationDeleteAll')->name('admin.notification.deleteAll');
            Route::get('notification/{id}', 'HomeController@notification')->name('admin.notification');
            Route::get('washerList', 'HomeController@washerList')->name('admin.washerList');

            /**
             * Setting
             */
            Route::group(['prefix' => 'setting'], function () {
                Route::get('/index', 'SettingController@index')->name('admin.setting');
                Route::post('setting', 'SettingController@doindex')->name('admin.setting.update');
            });

            /**
             * InvestmentCapital
             */
            Route::group(['prefix' => 'investmentCapital'], function () {
                Route::get('/index', 'InvestmentCapitalController@index')->name('admin.investmentCapital');
                Route::get('add', 'InvestmentCapitalController@add')->name('admin.investmentCapital.add');
                Route::post('edit/create', 'InvestmentCapitalController@create')->name('admin.investmentCapital.create');
                Route::get('edit/{id}', 'InvestmentCapitalController@edit')->name('admin.investmentCapital.edit');
                Route::post('edit/update', 'InvestmentCapitalController@updateRecode')->name('admin.investmentCapital.update');
                Route::get('edit/process/{id}/{status}', 'InvestmentCapitalController@process')->name('admin.investmentCapital.process');
                Route::get('delete/{id}', 'InvestmentCapitalController@delete')->name('admin.investmentCapital.delete');
            });

            /**
             * plan
             */
            Route::group(['prefix' => 'plan'], function () {
                Route::get('/index', 'PlanController@index')->name('admin.plan');
                Route::get('add', 'PlanController@add')->name('admin.plan.add');
                Route::post('edit/create', 'PlanController@create')->name('admin.plan.create');
                Route::get('edit/{id}', 'PlanController@edit')->name('admin.plan.edit');
                Route::get('view/{id}', 'PlanController@view')->name('admin.plan.view');
                Route::post('edit/update', 'PlanController@updateRecode')->name('admin.plan.update');
                Route::get('edit/process/{id}/{status}', 'PlanController@process')->name('admin.plan.process');
                Route::get('delete/{id}', 'PlanController@delete')->name('admin.plan.delete');
                Route::get('sortable', 'PlanController@sortable')->name('admin.plan.sortable');
                Route::post('sortable/save', 'PlanController@sortableSave')->name('admin.plan.sortableSave');
                Route::get('add/closingBalance', 'PlanController@closingBalance')->name('admin.plan.closingBalance');
                Route::get('add/addProfit', 'PlanController@addProfit')->name('admin.plan.addProfit');
                Route::get('add/addLoss', 'PlanController@addLoss')->name('admin.plan.addLoss');
                Route::get('view/{id}', 'PlanController@viewPMS')->name('admin.plan.viewPMS');
                Route::get('statementView/{id}', 'PlanController@statementView')->name('admin.plan.statementView');
                Route::get('statementViewStop/{id}', 'PlanController@statementViewStop')->name('admin.plan.statementViewStop');
            });

            /**
             * EmailTemplate
             */
            Route::group(['prefix' => 'email'], function () {
                Route::get('/index', 'EmailController@index')->name('admin.email');
                Route::get('add', 'EmailController@add')->name('admin.email.add');
                Route::post('edit/create', 'EmailController@create')->name('admin.email.create');
                Route::get('edit/{id}', 'EmailController@edit')->name('admin.email.edit');
                Route::post('edit/update', 'EmailController@updateRecode')->name('admin.email.update');
            });

            /**
             * Page
             */
            Route::group(['prefix' => 'page'], function () {
                Route::get('/index', 'PagesController@index')->name('admin.page');
                Route::get('add', 'PagesController@add')->name('admin.page.add');
                Route::post('edit/create', 'PagesController@create')->name('admin.page.create');
                Route::get('edit/process/{id}/{status}', 'PagesController@process')->name('admin.page.process');
                Route::get('edit/{id}', 'PagesController@edit')->name('admin.page.edit');
                Route::post('edit/update', 'PagesController@updateRecode')->name('admin.page.update');
            });

            /**
             * Customer
             */
            Route::group(['prefix' => 'customer'], function () {
                Route::get('/index', 'CustomerController@index')->name('admin.customer');
                Route::get('process/{id}/{status}', 'CustomerController@process')->name('admin.customer.process');
                Route::get('kycProcess/{id}/{status}', 'CustomerController@kycProcess')->name('admin.customer.kycProcess');
                Route::get('edit/{id}', 'CustomerController@edit')->name('admin.customer.edit');
                Route::post('edit/update', 'CustomerController@create')->name('admin.customer.update');
                Route::get('add', 'CustomerController@add')->name('admin.customer.add');
                Route::post('create', 'CustomerController@create')->name('admin.customer.create');
                Route::get('delete/{id}', 'CustomerController@delete')->name('admin.customer.delete');
                Route::get('view/{id}', 'CustomerController@view')->name('admin.customer.view');
                Route::get('chnagePassword/{id}', 'CustomerController@chnagePassword')->name('admin.customer.chnagePassword');
                Route::post('chnagePassword/doUpdatePassword', 'CustomerController@doUpdatePassword')->name('admin.customer.doUpdatePassword');
            });

            /**
             * Language
             */
            Route::group(['prefix' => 'language'], function () {
                Route::get('/index', 'LanguageController@index')->name('admin.language');
                Route::get('edit/process/{id}/{status}', 'LanguageController@process')->name('admin.language.process');
                Route::get('edit/{id}', 'LanguageController@edit')->name('admin.language.edit');
                Route::post('edit/update', 'LanguageController@update')->name('admin.language.update');
                Route::get('add', 'LanguageController@add')->name('admin.language.add');
            });
 

            /**
             * Banner
             */
            Route::group(['prefix' => 'banner'], function () {
                Route::get('/index', 'BannerController@index')->name('admin.banner');
                Route::get('process/{id}/{status}', 'BannerController@process')->name('admin.banner.process');
                Route::get('edit/{id}', 'BannerController@edit')->name('admin.banner.edit');
                Route::get('add', 'BannerController@add')->name('admin.banner.add');
                Route::post('edit/create', 'BannerController@create')->name('admin.banner.create');
                Route::get('delete/{id}', 'BannerController@delete')->name('admin.banner.delete');
                Route::get('view/{id}', 'BannerController@view')->name('admin.banner.view');
            });

           

            /**
             * Faq
             */
            Route::group(['prefix' => 'faq'], function () {
                Route::get('/index', 'FaqController@index')->name('admin.faq');
                Route::get('process/{id}/{status}', 'FaqController@process')->name('admin.faq.process');
                Route::get('edit/{id}', 'FaqController@edit')->name('admin.faq.edit');
                Route::get('add', 'FaqController@add')->name('admin.faq.add');
                Route::post('edit/create', 'FaqController@create')->name('admin.faq.create');
                Route::get('delete/{id}', 'FaqController@delete')->name('admin.faq.delete');
                Route::get('sortable', 'FaqController@sortable')->name('admin.faq.sortable');
                Route::post('sortable/save', 'FaqController@sortableSave')->name('admin.faq.sortableSave');
            });

            
            /**
             * category
             */
            Route::group(['prefix' => 'category'], function () {
                Route::get('/index', 'CategoryController@index')->name('admin.category');
                Route::get('edit/process/{id}/{status}', 'CategoryController@process')->name('admin.category.process');
                Route::get('edit/{id}', 'CategoryController@edit')->name('admin.category.edit');
                Route::post('edit/update', 'CategoryController@update')->name('admin.category.update');
                Route::get('add', 'CategoryController@add')->name('admin.category.add');
                Route::post('edit/create', 'CategoryController@create')->name('admin.category.create');
                Route::get('sortable', 'CategoryController@sortable')->name('admin.category.sortable');
                Route::post('sortable/save', 'CategoryController@sortableSave')->name('admin.category.sortableSave');
                Route::get('delete/{id}', 'CategoryController@delete')->name('admin.category.delete');
            });

            /**
             * tag
             */
            Route::group(['prefix' => 'tag'], function () {
                Route::get('/index', 'TagController@index')->name('admin.tag');
                Route::get('edit/process/{id}/{status}', 'TagController@process')->name('admin.tag.process');
                Route::get('edit/{id}', 'TagController@edit')->name('admin.tag.edit');
                Route::post('edit/update', 'TagController@update')->name('admin.tag.update');
                Route::get('add', 'TagController@add')->name('admin.tag.add');
                Route::post('edit/create', 'TagController@create')->name('admin.tag.create');
                Route::get('delete/{id}', 'TagController@delete')->name('admin.tag.delete');
            });


            /**
             * order
             */
            Route::group(['prefix' => 'order'], function () {
                Route::get('/', 'OrderController@index')->name('admin.order');
                Route::get('/user/{id}', 'OrderController@userOrder')->name('admin.order.userOrder');
            });

            /**
             * subscription
             */
            Route::group(['prefix' => 'subscription'], function () {
                Route::get('/', 'SubscriptionController@index')->name('admin.subscription');
                Route::get('/stop', 'SubscriptionController@stopIndex')->name('admin.subscription.stopIndex');
                Route::get('view/{id}', 'SubscriptionController@view')->name('admin.subscription.view');
                Route::get('/user/{id}', 'SubscriptionController@userSubscription')->name('admin.subscription.userSubscription');
            });

             /**
             * Redeem
             */
            Route::group(['prefix' => 'redeem'], function () {
                Route::get('/', 'SubscriptionRedeemController@index')->name('admin.redeem');
                Route::get('view/{id}', 'SubscriptionRedeemController@view')->name('admin.redeem.view');
                Route::get('user/{id}', 'SubscriptionRedeemController@userRedeem')->name('admin.redeem.userRedeem');
            });

            /**
             * Redeem
             */
            Route::group(['prefix' => 'statement'], function () {
                Route::get('/', 'StatementController@index')->name('admin.statement');
                Route::get('view/{id}', 'StatementController@view')->name('admin.statement.view');
                Route::get('excel', 'StatementController@excel')->name('admin.redeem.excel');
                Route::get('user/{id}', 'StatementController@userStatement')->name('admin.statement.userStatement');
                Route::get('excel/user/{id}', 'StatementController@userExcel')->name('admin.userExcel.excel');
            });

            /**
             * Wallet
             */
            Route::group(['prefix' => 'wallet'], function () {
                Route::get('/', 'WalletController@index')->name('admin.wallet');
                Route::get('view/{id}', 'WalletController@view')->name('admin.wallet.view');
                Route::get('addAmount', 'WalletController@addAmount')->name('admin.wallet.addAmount');
                Route::get('debitAmount', 'WalletController@debitAmount')->name('admin.wallet.debitAmount');
                Route::get('/user/{id}', 'WalletController@userWallet')->name('admin.userWallet');
            });

            /**
             * Earnings
             */
            Route::group(['prefix' => 'earning'], function () {
                Route::get('/', 'EarningController@index')->name('admin.earning');
            });

            /**
             * Earnings
             */
            Route::group(['prefix' => 'referral'], function () {
                Route::get('/use', 'ReferralController@index')->name('admin.referral');
                Route::get('/received', 'ReferralController@referralUse')->name('admin.referralUse');
            });

            /**
             * contactUs
             */
            Route::group(['prefix' => 'contactUs'], function () {
                Route::get('/index', 'ContactUsController@index')->name('admin.contactUs');
                Route::get('delete/{id}', 'ContactUsController@delete')->name('admin.contactUs.delete');
                Route::get('view/{id}', 'ContactUsController@view')->name('admin.contactUs.view');
            });

             /**
             * Withdrawal
             */
            Route::group(['prefix' => 'withdrawal'], function () {
                Route::get('/', 'WithdrawalController@index')->name('admin.withdrawal');
                Route::get('view/{id}', 'WithdrawalController@view')->name('admin.withdrawal.view');
                Route::get('addAmount', 'WithdrawalController@addAmount')->name('admin.withdrawal.addAmount');
            });

             
            
        });
    });

});





