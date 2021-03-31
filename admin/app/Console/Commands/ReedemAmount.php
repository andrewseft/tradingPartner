<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Helpers\Helper;
use App\SetRedeemAmount;
use App\Subscription;
use App\SubscriptionRedeem;
use App\wallet;
use App\User;
use App\Manager\NotificationManager;

class ReedemAmount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoreedem';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'set auto reedem';

    /** @var  User */
    private $user;

    /** @var  NotificationManager */
    private $notification;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(User $user, NotificationManager $NotificationManager)
    {
        parent::__construct();
        $this->user = $user;
        $this->notification = $NotificationManager;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = SetRedeemAmount::with(['planStatus'])->get();
        foreach($data as $key => $val){
            if($val->planStatus->current_balance == $val->amount){
                $subscription = Subscription::where('user_id',$val->user_id)->with(['plan'])->where('plan_id',$val->plan_id)->first();
                $currentAmount = $val->planStatus->current_balance * $val->qty;

                /**
                 * Save data on subscriptionRedeem
                 */
                $realized = ($subscription->plan->planStatus->current_balance*$val->qty) - ($subscription->plan->amount * $val->qty);
                $setting = Helper::setting();
                $commission = 0;
                if($realized != 0){
                    $commission = ($setting->commission / 100) * $realized;
                }
                $sebi = ($setting->sebi / 100) * $realized;
                $sgst = ($setting->sgst / 100) * $realized;
                $stamp_duty = ($setting->stamp_duty / 100) * $realized;
                $stt = ($setting->stt / 100) * $realized;
                $igst = ($setting->igst / 100) * $realized;
                $cgst = ($setting->cgst / 100) * $realized;
                $exchange_transaction_tax = ($setting->exchange_transaction_tax / 100) * $realized;
                $total_charges = ($setting->planform_fee + $commission + $sebi + $sgst + $stamp_duty + $stt + $igst + $cgst + $exchange_transaction_tax);
                $final_pl = ($realized - $total_charges);

                $subscriptionRedeemData = new SubscriptionRedeem;
                $subscriptionRedeemData->user_id = $val->user_id;
                $subscriptionRedeemData->amount = $subscription->plan->planStatus->current_balance;
                $subscriptionRedeemData->plan_id = $val->plan_id;
                $subscriptionRedeemData->qty = $val->qty;
                $subscriptionRedeemData->remark = "Subscription Redeem";
                $subscriptionRedeemData->status = 1;
                $subscriptionRedeemData->type = 2;
                $subscriptionRedeemData->realized = $realized;
                $subscriptionRedeemData->planform_fee = $setting->planform_fee;

                $subscriptionRedeemData->commission = $commission;
                $subscriptionRedeemData->sebi = $sebi;
                $subscriptionRedeemData->sgst = $sgst;
                $subscriptionRedeemData->stamp_duty = $stamp_duty;
                $subscriptionRedeemData->stt = $stt;
                $subscriptionRedeemData->igst = $igst;
                $subscriptionRedeemData->cgst = $cgst;
                $subscriptionRedeemData->exchange_transaction_tax = $exchange_transaction_tax;
                $subscriptionRedeemData->total_charges = $total_charges;
                $subscriptionRedeemData->final_pl = $final_pl;
                $subscriptionRedeemData->save();

                /**
                 * Save data on wallet
                 */
                $amount = 0;
                $walletData = wallet::where('user_id',$val->user_id)->orderBy('id', 'desc')->first();
                if($walletData){
                    $amount =  $walletData->closing_bal; 
                }
                $data = new wallet();
                $data->user_id = $val->user_id;
                $data->amount = $final_pl;
                $data->transaction_id = 0;
                $data->type = 1;
                $data->closing_bal = $final_pl + $amount;
                $data->remark = "Plan Redeem";
                $data->save();

                /**
                 * Send email for user
                 */
                $user = $this->user->findOrFail($val->user_id);
                $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
                $meassge = trans('message.WALLET_AMOUNT_USER',['TOTAL_AMOUNT'=>number_format($final_pl + $amount,2),'AMOUNT'=>number_format($currentAmount,2)]);
                $this->notification->send($user,route('admin.customer'),$ACCOUNT_STATUS,$meassge);

                /**
                 * Send Email for admin
                 */
                $adminUser = $this->user->findOrFail(1);
                $ACCOUNT_STATUS = trans('message.WALLET_STATUS');
                $meassge = trans('message.USER_WALLET_AMOUNT',['NAME'=>ucfirst($user->first_name),'AMOUNT'=>number_format($final_pl,2)]);
                $this->notification->send($adminUser,route('admin.customer'),$ACCOUNT_STATUS,$meassge);
                SetRedeemAmount::where('id',$val->id)->delete();
            }
        }
    }
}
