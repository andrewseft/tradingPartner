<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Tag;
use App\Http\Requests\TagRequest; 
use App\Constants\Constant;
use App\Manager\CacheManager;
use Carbon\Carbon;
 
 

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Tag $tag,CacheManager $cacheManager)
    {
        $this->limit = Helper::setting()->admin_limit;
        $this->tag = $tag;
        $this->cache = $cacheManager;

    }

    /**
     * @method get
     *
     * List of all tag
     */
    public function index(Request $request)
    {
        $title = __('Tages');
        $tag = $this->tag;
        $tagData = $this->tag->sortable()->orderBy('position', 'asc');
        if ($request->has('keyword')) {
            $name = $request->query('keyword');
            $tagData->where('name', 'LIKE', '%' . $name . '%');
        }
        if ($request->query('status')) {
            $status = $request->query('status');
            if($status == 2){
                $status = 0;
            }
            $tagData->where('status',$status);
        }
        $data = $tagData->paginate($this->limit);
        $data->appends($request->query());
        $tag = $request->query();

        return view('admin.tag.index', compact('title', 'data', 'request', 'tag'));
    }

    /**
     * @method get
     *
     * tag
     */
    public function add()
    {
        $title = __('Tag');
        $tag = $this->tag;
        return view('admin.tag.add', compact('title', 'tag'));
    }

    /**
     * @method post
     *
     * create a new tag
     */
    public function create(TagRequest $request)
    {
        $data = $this->tag;
        if (!empty($request->get('id'))) {
            $data = $this->tag->findOrFail($request->get('id'));
        }
        $data->name = $request->get('name');
        $data->save();
        $this->cache->clear('App\Tag');
        if (!empty($request->get('id'))) {
            return redirect()->route('admin.tag')->with('success', __('Record has been updated successfully'));
        }
        return redirect()->route('admin.tag')->with('success', __('Record has been added successfully'));
    }

    /**
     * update status
     * @param $id
     * @param $status
     */
    public function process($id,$status,Request $request){
        $tag = $this->tag->findOrFail(Helper::decode($id));
        $tag->update(['status'=>Constant::ITEM_STATUS_SHOW[$request->get('status')]]);
        return true;
    }

    /**
     * Edit
     * @param $id
     * @method get
     *
     */
    public function edit ($id){
        $title = __('Tag');
        $tag = $this->tag->findOrFail(Helper::decode($id));  
        return view('admin.tag.edit',compact('title','tag'));
    }

     
    /**
     * Delete
     * @param $id
     * @method get
     *
     */
    public function delete($id){
        $tag = $this->tag->findOrFail(Helper::decode($id));
        $tag->delete();
        return  redirect()->back()->with('success', __('Record was deleted sucessfully'));
    }
}
