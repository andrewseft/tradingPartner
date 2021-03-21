<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Constants\Constant;
use App\Helpers\Helper;
use Auth;
use App\User;
use App\wallet;
use App\Order;
use App\Plan;
use App\Bid;
use App\BidUser;
use Exception;
use App\Manager\NotificationManager;


class TradingController extends BaseController
{
    
    /** @var  Order */
    private $order;

    /** @var  Limit */
    private $limit;

    /** @var  Plan */
    private $plan;

    /** @var  User */
    private $user;

    /** @var  NotificationManager */
    private $notification;

     /** @var  wallet */
    private $wallet;

    /** @var  Bid */
    private $bid;

    /** @var  BidUser */
    private $bidUser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(BidUser $bidUser, Bid $bid, Order $order, Plan $plan, User $user, NotificationManager $NotificationManager,wallet $wallet)
    {
        $this->order = $order;
        $this->plan = $plan;
        $this->limit = Helper::setting()->admin_limit;
        $this->user = $user;
        $this->notification = $NotificationManager;
        $this->wallet = $wallet;
        $this->bidUser = $bidUser;
        $this->bid = $bid;
    }

    /**
     * trading for plan
     * 
     * @type    1 => Buy 2 => Sell
     * @option  1=> Market 2 => Limit 
     * 
     * @method post
     *
     * @return \Illuminate\Http\Response
     * 
     * {"plan_id":"1","type":"1","qty":"10","price":"300","option":"2"}
     */
    public function trading(Request $request)
    {
        try {
            $user = Auth::user();
            
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
