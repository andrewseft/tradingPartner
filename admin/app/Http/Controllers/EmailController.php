<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Manager\EmailManager;
use App\Http\Requests\EmailRequest;
use App\Manager\CacheManager;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmailManager $emailManager,CacheManager $cacheManager)
    {
        $this->email = $emailManager;
        $this->limit = Helper::setting()->admin_limit;
        $this->cache = $cacheManager;
    }

    /**
     * @method get
     *
     * List of email template
     */
    public function index(Request $request)
    {
        $title = __('Email Templates');
        $email = $this->email->email();
        $data = $this->email->list($request, $this->limit);
        $data->appends($request->query());
        $email = $request->query();
        return view('admin.email.index', compact('title', 'data', 'request', 'email'));
    }

    /**
     * @method get
     *
     * Create new email
     */
    public function add()
    {
        $title = __('Email Template');
        $email = $this->email->email();
        return view('admin.email.add', compact('title', 'email'));
    }

    /**
     * @method post
     */
    public function create(EmailRequest $request){
        $this->email->create($request);
        if (!empty($request->get('id'))) {
            $this->cache->clear('App\Email');
            return redirect()->route('admin.email')->with('success', __('Record has been updated successfully.'));
        }
        $this->cache->clear('App\Email');
        return redirect()->route('admin.email')->with('success', __('Record has been added successfully.'));
    }

    /**
     * Edit
     * @param $id
     * @method get
     *
     */
    public function edit ($id){
        $title = __('Email Template');
        $email = $this->email->getbyId(Helper::decode($id));
        return view('admin.email.edit',compact('title','email'));
    }
}
