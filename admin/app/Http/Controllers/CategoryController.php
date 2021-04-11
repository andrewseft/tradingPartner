<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Category;
use App\CategoryTranslation;
use App\Http\Requests\CategoryRequest; 
use App\Constants\Constant;
use App\Manager\CacheManager;
use Carbon\Carbon;
 
 

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category,CategoryTranslation $categoryTranslation,CacheManager $cacheManager)
    {
        $this->limit = Helper::setting()->admin_limit;
        $this->category = $category;
        $this->categoryTranslation = $categoryTranslation;
        $this->cache = $cacheManager;

    }

    /**
     * @method get
     *
     * List of all category
     */
    public function index(Request $request)
    {
        $title = __('Categories');
        $category = $this->category;
        $categoryData = $this->category->with(['detail:category_id,name'])->sortable()->orderBy('position', 'asc');
        if ($request->has('keyword')) {
            $name = $request->query('keyword');
            $categoryData->whereHas('detail', function ($q) use ($name) {
                $q->where('name', 'LIKE', '%' . $name . '%');
            });
        }
        if ($request->query('status')) {
            $status = $request->query('status');
            if($status == 2){
                $status = 0;
            }
            $categoryData->where('status',$status);
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $categoryData->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $categoryData->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $categoryData->whereDate('created_at', '=', $date);
        }
        $data = $categoryData->paginate($this->limit);
        $data->appends($request->query());
        $category = $request->query();

        return view('admin.category.index', compact('title', 'data', 'request', 'category'));
    }

    /**
     * @method get
     *
     * category
     */
    public function add()
    {
        $title = __('Category');
        $category = $this->category;
        return view('admin.category.add', compact('title', 'category'));
    }

    /**
     * @method post
     *
     * create a new category
     */
    public function create(CategoryRequest $request){
        $data = $this->category;
        if (!empty($request->get('id'))) {
            $data = $this->category->findOrFail($request->get('id'));
        }
        $data->title = $request->get('translation')['en']['name'];
        $translation = [];
        if ($data->save()) {
            foreach ($request->translation as $value) {
                $item = new CategoryTranslation();
                if (!empty($value['id'])) {
                    $item = $this->categoryTranslation->findOrFail($value['id']);
                }
                $item->locale = $value['locale'];
                $item->name = $value['name'];
                $translation[] = $item;
            }
        }
        $data->translation()->saveMany($translation);
        $this->cache->clear('App\Category');
        if (!empty($request->get('id'))) {
            return redirect()->route('admin.category')->with('success', __('Record was updated successfully'));
        }
        return redirect()->route('admin.category')->with('success', __('Record was added successfully'));
    }

    /**
     * update status
     * @param $id
     * @param $status
     */
    public function process($id,$status,Request $request){
        $category = $this->category->findOrFail(Helper::decode($id));
        $category->update(['status'=>Constant::ITEM_STATUS_SHOW[$request->get('status')]]);
        return true;
    }

    /**
     * Edit
     * @param $id
     * @method get
     *
     */
    public function edit ($id){
        $title = __('category');
        $category = $this->category->with(['translation'])->findOrFail(Helper::decode($id));
        $array = [];
        if (!empty($category)) {
            foreach ($category->translation as $key => $value) {
                $array[$value->locale]['id'] = $value->id;
                $array[$value->locale]['locale'] = $value->locale;
                $array[$value->locale]['name'] = $value->name;
            }
            $category->translation = $array;
        }
        return view('admin.category.edit',compact('title','category'));
    }

    /**
     * sortable
     * @method sortable
     */
    public function sortable(){
        $title = __('Category');
        $data = $this->category->with(['detail:category_id,name'])->sortable()->orderBy('position', 'asc')->get();
        return view('admin.category.sortable', compact('title','data'));
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
            $this->category->where('id',$val->id)->update(['position'=>$i]);
            $i++;
        }
        return true;
    }

    

    /**
     * Delete
     * @param $id
     * @method get
     *
     */
    public function delete($id){
        $category = $this->category->findOrFail(Helper::decode($id));
        $category->delete();
        return  redirect()->back()->with('success', __('Record was deleted sucessfully'));
    }
}
