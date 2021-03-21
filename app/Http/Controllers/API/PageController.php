<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\Page as PageResource;
use App\Helpers\Helper;
use App\Constants\Constant;
use Validator;
use App\User;
use App\Page;
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

     /** @var  UploadManager */
    private $upload;


	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, Page $page, ContactUs $contactUs, NotificationManager $NotificationManager, UploadManager $upload)
    {
        $this->page = $page;
        $this->contactUs = $contactUs;
        $this->notification = $NotificationManager;
        $this->user = $user;
        $this->upload = $upload;
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
            $slugArray = array('about-us'=>1,'privacy-policies'=>2,'terms-conditions'=>3);
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




}