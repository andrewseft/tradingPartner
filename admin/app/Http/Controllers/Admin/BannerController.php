<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Banner;
use App\Http\Requests\BannerRequest;
use App\Manager\UploadManager;
use App\Constants\Constant;
use App\Manager\CacheManager;
use Carbon\Carbon;

class BannerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Banner $banner,UploadManager $upload,CacheManager $cacheManager)
    {
        $this->limit = Helper::setting()->admin_limit;
        $this->banner = $banner;
        $this->upload = $upload;
        $this->cache = $cacheManager;

    }

    /**
     * @method get
     *
     * List of all banner
     */
    public function index(Request $request)
    {
        $title = __('Banners');
        $banner = $this->banner;
        $bannerData = $this->banner->sortable()->orderBy('created_at', 'desc');
        if ($request->query('status')) {
            $status = $request->query('status');
            if($status == 2){
                $status = 0;
            }
            $bannerData->where('status',$status);
        }
        $data = $bannerData->paginate($this->limit);
        $data->appends($request->query());
        $banner = $request->query();
        return view('admin.banner.index', compact('title', 'data', 'request', 'banner'));
    }

    /**
     * @method get
     *
     * banner
     */
    public function add()
    {
        $title = __('Banner');
        $banner = $this->banner;
        return view('admin.banner.add', compact('title', 'banner'));
    }

    /**
     * @method post
     *
     * create a new banner
     */
    public function create(BannerRequest $request){

        $data = $this->banner;
        if (!empty($request->get('id'))) {
            $data = $this->banner->findOrFail($request->get('id'));
        }
        $data->hyperlink = $request->get('hyperlink');
        if ($request->hasFile('image')) {
            $data->image = $this->upload->image($request->file('image'), $request->old_image, Constant::BANNER_IMAGE, Constant::BANNER_IMAGE_THUMB, Constant::BANNER_IMAGE_HEIGHT, Constant::BANNER_IMAGE_WIDTH, true);
        }
        $data->save();
        $this->cache->clear('App\Banner');
        if (!empty($request->get('id'))) {
            return redirect()->route('admin.banner')->with('success', __('Record has been updated successfully'));
        }
        return redirect()->route('admin.banner')->with('success', __('Record has been added successfully'));
    }

    /**
     * update status
     * @param $id
     * @param $status
     */
    public function process($id,$status,Request $request){
        $banner = $this->banner->findOrFail(Helper::decode($id));
        $banner->update(['status'=>Constant::ITEM_STATUS_SHOW[$request->get('status')]]);
        return true;
    }

     /**
     * Delete
     * @param $id
     * @method get
     *
     */
    public function delete($id){
        $banner = $this->banner->findOrFail(Helper::decode($id));
        /**
         * Unlink image
         */
        if ($banner->image != null) {
            $path = Constant::BANNER_IMAGE.$banner->image;
            $path_thum = Constant::BANNER_IMAGE_THUMB.$banner->image;
            Helper::removeImage($path,$path_thum);
        }
        $banner->delete();
        return  redirect()->back()->with('success', __('Record has been deleted sucessfully'));
    }

    /**
     * Edit
     * @param $id
     * @method get
     *
     */
    public function edit ($id){
        $title = __('Banner');
        $banner = $this->banner->findOrFail(Helper::decode($id));  
        return view('admin.banner.edit',compact('title','banner'));
    }

    /**
     * Edit
     * @param $id
     * @method get
     *
     */
    public function view ($id){
        $title = __('Banner');
        $banner = $this->banner->findOrFail(Helper::decode($id));
        $response = [
            'status' => 200,
            'data' => view('admin.banner.view',compact('title','banner'))->render()
        ];
        return response()->json($response,200);
    }
}
