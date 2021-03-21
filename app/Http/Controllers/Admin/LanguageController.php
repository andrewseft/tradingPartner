<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Manager\LanguageManager;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LanguageManager $languageManager)
    {
        $this->limit = Helper::setting()->admin_limit;
        $this->language = $languageManager;

    }

    /**
     * @method get
     * List of all Language
     */
    public function index(Request $request)
    {
        $title = __('Languages');
        $data = $this->language->list($request, $this->limit);
        return view('admin.language.index', compact('title', 'data'));
    }

    /**
     * @method get
     * @param $id
     * @param $status
     */
    public function process($id, $status, Request $request)
    {
        $data = $this->language->get(Helper::decode($id));
        if ($data->code != \App::getLocale()) {
            $data->status = $status;
            $data->save();
            $this->language->removeCache();
        }
        if($status == 0){
            $url = link_to('#javascript:void(0)','<span class="badge badge-danger-inverse">'.__('Disable').'</span>',['data-id'=>$data->id,'data-url'=>route('admin.language.process', ['id' => Helper::encode($data->id),'status'=>1]),'onclick'=>'return false;','class'=>'mr-3 status_click'],null, false);
        }else{
            $url = link_to('#javascript:void(0)','<span class="badge badge-success-inverse">'.__('Enable').'</span>',['data-id'=>$data->id,'data-url'=>route('admin.language.process', ['id' => Helper::encode($data->id),'status'=>0]),'onclick'=>'return false;','class'=>'mr-3 status_click'],null, false);
        }
        return $url;
    }

    /**
     * @method get
     * @param $id
     */
    public function edit($id)
    {
        $title = __('Edit language');
        $data = $this->language->get(Helper::decode($id));
        $data->description = json_decode($data->description);
        return view('admin.language.edit', compact('title', 'data'));
    }

    /**
     * @method post
     * Create/Update recode
     */
    public function update(LanguageRequest $request)
    {
        if ($this->language->create($request)) {
            $this->language->removeCache();
            return redirect()->route('admin.language')->with('success', __('Record has been updated successfully.'));
        } else {
            return redirect()->back()->withInput()->with('error', __('An error occured, Please try again.'));
        }

    }

    /**
     * @method get
     */
    public function add()
    {
        $title = __('Add language');
        $data = $this->language->language();
        return view('admin.language.add', compact('title', 'data'));
    }
}
