<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Helpers\Helper;
use App\SubscriptionHolding;
use App\User;
use App\Setting;
use App\ReferralList;

class SendReferralList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendReferralList';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get user referral list daily base';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::where('role_id',3)->where('status',1)->get();
        $currentMonth = date('m');
        $currentMonthName = date('F-Y');
        $setting = Setting::where('id',1)->first();
        
        if($user){
            foreach($user as $userValue){
                $user_id = $userValue->id;
                $account_converted = User::select('id')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->where('is_referral',$user_id)->get();
                if($account_converted->count() > 0){
                  $trade_active = SubscriptionHolding::select('user_id',"is_pay")
                                ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
                                ->whereIn('user_id',$account_converted->toArray())
                                ->where('is_pay',0)->groupBy(['user_id','is_pay'])
                                ->get()->count();
                  $flat_income = 0;
                  $gross_brokerage = SubscriptionHolding::whereIn('user_id',$account_converted->toArray())
                                    ->where('is_pay',0)
                                    ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
                                    ->sum('commission');
                  $net_sharing = ($setting->platform_commission / 100) * $gross_brokerage;
                  $total = round($flat_income + $net_sharing);

                  $data = ReferralList::where('user_id',$user_id)
                        ->whereRaw('MONTH(created_at) = ?',[$currentMonth])->first();
                  if(empty($data)){
                    $data = new ReferralList();
                  }
                  $data->user_id = $user_id;
                  $data->month = $currentMonth;
                  $data->month_name = $currentMonthName;
                  $data->account_converted = $account_converted->count();
                  $data->trade_active = $trade_active;
                  $data->flat_income = $flat_income;
                  $data->gross_brokerage = $gross_brokerage;
                  $data->net_sharing = $net_sharing;
                  $data->total = $total;
                  if($total > 0){
                    $data->save();
                  }
                  
                }
            }
        }
    }
}
