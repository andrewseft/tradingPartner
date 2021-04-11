<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\Subscription;
use App\SubscriptionRedeem;
use App\Exports\RedeemExport;
use App\Statement;
use App\User;
use Excel;

class StatementController extends Controller
{
     /** @var  Limit */
     private $limit;

     /** @var  Subscription */
    private $subscription;

    /** @var  Statement */
    private $statement;
    

    /** @var  SubscriptionRedeem */
    private $subscriptionRedeem;
    
    /** @var  User */
    private $user;

 
     /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Statement $statement, SubscriptionRedeem $subscriptionRedeem, Subscription $subscription, User  $user)
    {
        $this->subscription = $subscription;
        $this->limit = Helper::setting()->admin_limit;
        $this->subscriptionRedeem = $subscriptionRedeem;
        $this->statement = $statement;
        $this->user = $user;
    }

     /**
     * @method get
     *
     * List of Users
     */
    public function index(Request $request)
    {
        $title = __('User Statement');
        $user = $this->statement;
        $query = $this->statement->with(['user','plan'])->sortable()->orderBy('id', 'desc');
        if ($request->get('keyword')) {
            $name = $request->get('keyword');
            $query->whereHas('user', function ($q) use ($name) {
                $q->WhereRaw("concat(first_name, ' ', last_name) LIKE '%{$name}%' ")
                ->orwhere('email', 'LIKE', "%{$name}%")->orwhere('number', 'LIKE', "%{$name}%");
            });
        }
         
        $data = $query->paginate($this->limit);
        
        $user = $request->query();
        return view('admin.statement.index', compact('title', 'data', 'request', 'user'));
    }

    /**
     * get view 
     */
    public function view(Request $request, $id){
        
        $resultData = $this->statement->with(['user','plan'])->where('id',$id)->sortable()->orderBy('id', 'desc')->first();
        $response = [
            'status' => 200,
            'data' => view('admin.statement.view',compact('resultData'))->render(),
        ];
        return response()->json($response,200);
    }

    /**
     * Excel
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function excel(Request $request){
        
        $redeem = $this->statement->sortable()->where('is_pay',$request->type)->where('user_id',$request->user_id)->where('plan_id',$request->plan_id)->with(['plan','user'])->orderBy('id', 'ASC');                    
        $data = $redeem->paginate($this->limit);
        if($data->count() != 0){
            $name = "statement/".time().'.xlsx';
            Excel::store(new RedeemExport($data), $name,'public');
            $file = Helper::getImageUrl($name);
            return \Redirect::to($file);
        }else{
            return  redirect()->back();
        }
        
    }

     /**
     * @method get
     *
     * List of Users
     */
    public function userStatement ($id, Request $request)
    {
        $title = __('User Statement');
        $userData = $this->statement;
        $user = $this->user->findOrFail(Helper::decode($id));
        $query = $this->statement->with(['user','plan'])->where('user_id',$user->id)->sortable()->orderBy('id', 'desc');
        if ($request->get('keyword')) {
            $name = $request->get('keyword');
            $query->whereHas('user', function ($q) use ($name) {
                $q->WhereRaw("concat(first_name, ' ', last_name) LIKE '%{$name}%' ")
                ->orwhere('email', 'LIKE', "%{$name}%")->orwhere('number', 'LIKE', "%{$name}%");
            });
        }
         
        $data = $query->paginate($this->limit);
        
        $userData = $request->query();
        return view('admin.statement.userStatement', compact('title', 'data', 'request', 'user','userData'));
    }
    
}
