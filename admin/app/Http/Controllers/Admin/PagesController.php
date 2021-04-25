<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Manager\PageManager;
use App\Http\Requests\PageRequest;
use App\Manager\CacheManager;


class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageManager $pageManager,CacheManager $cacheManager)
    {
        $this->page = $pageManager;
        $this->limit = Helper::setting()->admin_limit;
        $this->cache = $cacheManager;

    }

    /**
     * @method get
     *
     * List of static page
     */
    public function index(Request $request)
    {
        $title = __('CMS');
        $page = $this->page->page();
        $data = $this->page->list($request, $this->limit);
        $data->appends($request->query());
        $page = $request->query();
        return view('admin.page.index', compact('title', 'data', 'request', 'page'));
    }

    /**
     * @method get
     *
     * Create new page
     */
    public function add()
    {
        $title = __('CMS');
        $page = $this->page->page();
        return view('admin.page.add', compact('title', 'page'));
    }

    /**
     * @method post
     */
    public function create(PageRequest $request){
        $this->page->create($request);
        if (!empty($request->get('id'))) {
            $this->cache->clear('App\Page');
            return redirect()->route('admin.page')->with('success', __('Record has been updated successfully.'));
        }
        $this->cache->clear('App\Page');
        return redirect()->route('admin.page')->with('success', __('Record has been added successfully.'));
    }

    /**
     * Edit
     * @param $id
     * @method get
     *
     */
    public function edit ($id){
        $title = __('CMS');
        $page = $this->page->getbyId(Helper::decode($id));
        return view('admin.page.edit',compact('title','page'));
    }

    /**
     * update status
     * @param $id
     * @param $status
     */
    public function process ($id,$status,Request $request){
        $page = $this->page->get(Helper::decode($id));
        $this->page->update(Helper::decode($id),$request->get('status'));
        return true;
    }
}
