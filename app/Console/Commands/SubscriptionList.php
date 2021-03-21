<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use App\Subscription;
use App\Statement;


class SubscriptionList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'set subscription list';

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
        $order = Order::where('qty','=',0)->get();
        if($order->count()){
          foreach($order as $key => $item){
            Order::where('id',$item->id)->update(['is_move'=>1]);   
          }
        }
        
        /**
         * is_move
         */
        $subscription = Statement::where('is_pay',1)->get();
        if($subscription->count()){
          foreach($subscription as $key => $item){
            Statement::where('id',$item->id)->update(['is_move'=>1]);   
          }
        }
    }
}
