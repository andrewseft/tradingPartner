<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\SubscriptionRedeem;
use App\Setting;
use App\wallet;
use App\ReferralLog;
use App\Manager\NotificationManager;

class Referral extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'referral';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'set referral';

    /**
     * Create a new command instance.
     *
     * @return void
     */

     /** @var  NotificationManager */
    private $notification;

    public function __construct(NotificationManager $NotificationManager)
    {
        parent::__construct();
        $this->notification = $NotificationManager;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::select('id','is_referral')->where('is_referral','!=',null)->get();
        $currentMonth = date('m');
        if($user){
            foreach($user as $userValue){
                $subscriptionRedeem = SubscriptionRedeem::where('user_id',$userValue->id)->whereRaw('MONTH(created_at) = ?',[$currentMonth])->sum('commission');
                if($subscriptionRedeem > 0){
                    /**
                     * Add amount on wallet 
                     */
                    $amount = 0;
                    $walletData = wallet::where('user_id',$userValue->is_referral)->orderBy('id', 'desc')->first();
                    if($walletData){
                        $amount =  $walletData->closing_bal; 
                    }
                    $data = new wallet();
                    $data->user_id = $userValue->is_referral;
                    $data->amount = $subscriptionRedeem;
                    $data->transaction_id = 0;
                    $data->type = 1;
                    $data->closing_bal = $subscriptionRedeem + $amount;
                    $data->remark = "Referral amount received for ".date('M') .' month';
                    $data->save();

                    /**
                     * ReferralLog
                     */
                    $referralLog = new ReferralLog();

                    $referralLog->to_user = $userValue->is_referral;
                    $referralLog->from_user = $userValue->id;
                    $referralLog->amount = $subscriptionRedeem;
                    $referralLog->save();

                    /**
                     * Send email for user
                     */
                    $user = User::where('id',$userValue->is_referral)->first();
                    $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
                    $meassge = trans('message.REFERRAL_AMOUNT',['MONTH'=>date('M'),'TOTAL_AMOUNT'=>number_format($subscriptionRedeem + $amount,2),'AMOUNT'=>number_format($subscriptionRedeem,2)]);
                    $this->notification->send($user,route('admin.customer'),$ACCOUNT_STATUS,$meassge);

                    /**
                     * Send Email for admin
                     */
                    $adminUser = User::findOrFail(1);
                    $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
                    $meassge = trans('message.REFERRAL_AMOUNT_ADMIN',['MONTH'=>date('M'),'NAME'=>ucfirst($user->first_name),'AMOUNT'=>number_format($subscriptionRedeem,2)]);
                    $this->notification->send($adminUser,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
                    
                }
                
            }
        }
    }
}
