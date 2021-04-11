<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Faq;
use App\FaqTranslation;
use App\Http\Requests\FaqRequest;
use App\Constants\Constant;
use App\Manager\CacheManager;
use Carbon\Carbon;

class FaqController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Faq $faq,FaqTranslation $faqTranslation,CacheManager $cacheManager)
    {
        $this->limit = Helper::setting()->admin_limit;
        $this->faq = $faq;
        $this->faqTranslation = $faqTranslation;
        $this->cache = $cacheManager;

    }

    /**
     * @method get
     *
     * List of all Faq
     */
    public function index(Request $request)
    {
        $title = __('Faqs');
        $faq = $this->faq;
        $faqData = $this->faq->sortable()->with(['detail'])->orderBy('index', 'asc');
        if ($request->query('status')) {
            $status = $request->query('status');
            if($status == 2){
                $status = 0;
            }
            $faqData->where('status',$status);
        }
        if ($request->query('code')) {
            $faqData->where('code',$request->query('code'));
        }
        if ($request->has('keyword')) {
            $name = $request->query('keyword');
            $faqData->whereHas('detail', function ($q) use ($name) {
                $q->where('title', 'LIKE', '%' . $name . '%');
            });
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $faqData->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $faqData->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $faqData->whereDate('created_at', '=', $date);
        }
        $data = $faqData->paginate($this->limit);
        $data->appends($request->query());
        $faq = $request->query();
        return view('admin.faq.index', compact('title', 'data', 'request', 'faq'));
    }

    /**
     * @method get
     *
     * faq
     */
    public function add()
    {
        $title = __('Faq');
        $faq = $this->faq;
        return view('admin.faq.add', compact('title', 'faq'));
    }

    /**
     * @method post
     *
     * create a new faq
     */
    public function create(FaqRequest $request){

        $data = $this->faq;
        if (!empty($request->get('id'))) {
            $data = $this->faq->findOrFail($request->get('id'));
        }
        $translation = [];
        if ($data->save()) {
            foreach ($request->translation as $value) {
                $item = new FaqTranslation();
                if (!empty($value['id'])) {
                    $item = $this->faqTranslation->findOrFail($value['id']);
                }
                $item->locale = $value['locale'];
                $item->description = $value['description'];
                $item->title = $value['title'];
                $translation[] = $item;
            }
        }
        $data->translation()->saveMany($translation);
        $this->cache->clear('App\Faq');
        if (!empty($request->get('id'))) {
            return redirect()->route('admin.faq')->with('success', __('Record has been updated successfully'));
        }
        return redirect()->route('admin.faq')->with('success', __('Record has been added successfully'));
    }

    /**
     * update status
     * @param $id
     * @param $status
    */
    public function process($id,$status,Request $request){
        $faq = $this->faq->findOrFail(Helper::decode($id));
        $faq->update(['status'=>Constant::ITEM_STATUS_SHOW[$request->get('status')]]);
        return true;
    }

    /**
     * Delete
     * @param $id
     * @method get
     *
     */
    public function delete($id){
        $faq = $this->faq->findOrFail(Helper::decode($id));
        $this->faqTranslation->where('faq_id',$faq->id)->delete();
        $faq->delete();
        return  redirect()->back()->with('success', __('Record has been deleted sucessfully'));
    }

    /**
     * Edit
     * @param $id
     * @method get
     *
     */
    public function edit ($id){
        $title = __('faq');
        $faq = $this->faq->with(['translation'])->findOrFail(Helper::decode($id));
        $array = [];
        if (!empty($faq)) {
            foreach ($faq->translation as $key => $value) {
                $array[$value->locale]['id'] = $value->id;
                $array[$value->locale]['title'] = $value->title;
                $array[$value->locale]['locale'] = $value->locale;
                $array[$value->locale]['description'] = $value->description;
            }
            $faq->translation = $array;
        }
        return view('admin.faq.edit',compact('title','faq'));
    }

    /**
     * sortable
     * @method sortable
     */
    public function sortable(){
        $title = __('Faqs');
        $data = $this->faq->with(['detail'])->sortable()->orderBy('index', 'asc')->get();
        return view('admin.faq.sortable', compact('title','data'));
    }

    /**
     * sortableSave
     *
     * @method post
     */
    public function sortableSave(Request $request){
        $data = json_decode($request->get('data'));
        $i = 1;
        foreach($data as $key => $val){
            $this->faq->where('id',$val->id)->update(['index'=>$i]);
            $i++;
        }
        return true;
    }
}
