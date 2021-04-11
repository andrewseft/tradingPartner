<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\ContactUs;
use App\Constants\Constant;
use App\Manager\CacheManager;
use Carbon\Carbon;

class ContactUsController extends Controller
{
    /** @var  ContactUs */
   private $contactUs;

   /** @var  Limit */
   private $limit;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ContactUs $contactUs)
    {
        $this->limit = Helper::setting()->admin_limit;
        $this->contactUs = $contactUs;
    }

    /**
     * @method get
     *
     * List of all Contact Us
     */
    public function index(Request $request)
    {
        $title = __("Contact Us");
        $contactUs = $this->contactUs;
        $contactUsData = $this->contactUs->sortable()->orderBy('id', 'desc');
        if ($request->has('keyword')) {
            $name = $request->query('keyword');
            $contactUsData->where('name', 'ILIKE', '%' . $name . '%')->orwhere('email', 'ILIKE', "%{$name}%")->orwhere('number', 'ILIKE', "%{$name}%");
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $contactUsData->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $contactUsData->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $contactUsData->whereDate('created_at', '=', $date);
        }
        $data = $contactUsData->paginate($this->limit);
        $data->appends($request->query());
        $contactUs = $request->query();
        return view('admin.contactUs.index', compact('title', 'data', 'request', 'contactUs'));
    }

    /**
     * Delete
     * @param $id
     * @method get
     *
     */
    public function delete($id){
        $contactUs = $this->contactUs->findOrFail(Helper::decode($id));
        $contactUs->delete();
        return  redirect()->back()->with('success', __('Record is deleted sucessfully..'));
    }

    /**
     * view
     * @param $id
     * @method get
     *
     */
    public function view ($id){
        $contactUs = $this->contactUs->findOrFail(Helper::decode($id));
        $response = [
            'status' => 200,
            'data' => view('admin.contactUs.view',compact('contactUs'))->render(),
        ];
        return response()->json($response,200);
    }

}
