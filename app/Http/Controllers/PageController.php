<?php

namespace App\Http\Controllers;
use App\Manager\PageManager;
use App\User;
use App\Order;
use App\Subscription;
use App\Statement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Manager\EmailManager;

class PageController extends Controller
{
    private $page;
    private $user;
    private $order;
    private $statement;
    private $subscription;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Statement $statement, Subscription $subscription, Order $order, PageManager $pageManager,User $user ,EmailManager $emailManager)
    {
        $this->page = $pageManager;
        $this->user = $user;
        $this->email = $emailManager;
        $this->order = $order;
        $this->statement = $statement;
        $this->subscription = $subscription;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        
        $page = $this->page->getSlug($slug);
        $title = $page->detail->title;
        return view('front.page.index', compact('title','page'));
    }

    /**
     * @method post
     *
     * send contact us message
     */
    public function sendContact(Request $request){
        /**
         * Send Email to Admin
         */
        $user = $this->user->where('role_id',1)->first();
        $user->contact_name = $request->get('name');
        $user->contact_email = $request->get('email');
        $user->contact_subject = $request->get('subject');
        $user->contact_message_info = $request->get('message_info');
        //$this->email->sendEmail(12, $user, null);
        return redirect()->route('homePage','#contact')->with('success', __('Your message was sent successfully'));
    }

    /**
     * @method get
     * 
     * if user has been stop plan then move 
     */
    public function checkSubscription(Request $request){
        try {
            $order = $this->order->where('qty','=',0)->get();
            if($order->count()){
                foreach($order as $key => $item){
                    $this->order->where('id',$item->id)->update(['is_move'=>1]);   
                }
            }

            /**
             * is_move
             */
            $subscription = $this->statement->where('is_pay',1)->get();
            if($subscription->count()){
                foreach($subscription as $key => $item){
                    $this->statement->where('id',$item->id)->update(['is_move'=>1]);   
                }
            }
            $response = [
                'status' => JsonResponse::HTTP_OK,
                'message' =>'Data was retrieved successfully.',
                'data' => [],
            ];
            return response()->json($response, JsonResponse::HTTP_OK);
        }catch (Exception $ex) {
            $response = [
                'status' => JsonResponse::HTTP_CREATED,
                'message' => $ex->getMessage(),
                'data' => (object) array(),
            ];
            return response()->json($response, JsonResponse::HTTP_CREATED);
        }
    }
}
