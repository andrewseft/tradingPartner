<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Page as PageResource;
use App\Http\Resources\FaqData as FaqResource;
use App\Helpers\Helper;
use App\Constants\Constant;
use Validator;
use App\User;
use App\Page;
use App\Faq;
use App\ContactUs;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\API\Contact;
use App\Manager\NotificationManager;
use Exception;
use App\Manager\UploadManager;

class PageController extends BaseController
{
    private $page;

     /** @var  ContactUs */
     private $contactUs;

     /** @var  NotificationManager */
    private $notification;

    /** @var  User */
    private $user;

    /** @var  Faq */
    private $faq;

     /** @var  UploadManager */
    private $upload;


	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Faq $faq, User $user, Page $page, ContactUs $contactUs, NotificationManager $NotificationManager, UploadManager $upload)
    {
        $this->page = $page;
        $this->contactUs = $contactUs;
        $this->notification = $NotificationManager;
        $this->user = $user;
        $this->upload = $upload;
        $this->faq = $faq;
    }

    /**
     * Display a listing of the resource.
     *
     * 'about-us'=>'About US','privacy-policies'=>'Privacy Policy','contact-us'=>'Contact Us','delivery-policy'=>'Shipping and delivery policy','refunds-policy'=>'Refunds and cancellation policy','terms-of-us'=>'Terms of Use'
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        try {
            $slugArray = array('about-us'=>1,'privacy-policies'=>2,'terms-conditions'=>3,"cancellation-policy"=>6,"return-policy"=>7);
            $page = $this->page->with(['detail'])->where('id', $slugArray[$slug])->where('status',1)->first();
            
            if(!empty($page)){
                return $this->sendResponse(new PageResource($page), trans('message.GET_DATA'));
            }else{
                return $this->sendResponse("", trans('message.GET_DATA'));
            }
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * 
     */
    public function contactUs(Contact $request){
        try {
            $data = $this->contactUs;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->number = $request->number;
            $data->message = $request->message;
            if ($request->hasFile('image')) {
                $data->image = $this->upload->image($request->file('image'),null, Constant::CON_IMAGE, Constant::CON_IMAGE_THUMB, Constant::CON_IMAGE_HEIGHT, Constant::CON_IMAGE_WIDTH, false);
            }
            $data->save();

            /**
             * Send Notification
             * Sent Email
             */
            $ACCOUNT_STATUS = trans('message.CONTACT_US');
            $meassge = trans('message.CONTACT_US_MESSAGE',[
                'NAME'=>$request->get('name'),
                'EMAIL' => $request->get('email'),
                'NUMBER' => $request->get('number'),
                'MESSAGE' => $request->get('message')
            ]);
            $user = $this->user->where('id',1)->first();
            $this->notification->send($user,route('home'),$ACCOUNT_STATUS,$meassge);

            return $this->sendResponse(true,trans('message.SUBMIT_CONTACT_US'));
            
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get home page data
     */
    public function homePage(){
        try {
            $page = $this->page->with(['detail'])->where('id', 9)->where('status',1)->first();
            $why = $this->page->with(['detail'])->where('id', 10)->where('status',1)->first();
            $features = $this->page->with(['detail'])->where('id', 11)->where('status',1)->first();
            $faq = $this->faq->where('status',1)->with(['detail'])->get();
            $data['offer'] = new PageResource($page);
            $data['why'] = new PageResource($why);
            $data['features'] = new PageResource($features);
            $data['faq'] = FaqResource::collection($faq);
            return $this->sendResponse($data, trans('message.GET_DATA'));
        }catch (Exception $ex) {
            return $this->sendError($ex->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        } 
    }




}