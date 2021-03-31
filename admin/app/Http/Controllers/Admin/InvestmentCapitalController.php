<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\InvestmentCapital;
use App\Http\Requests\InvestmentCapitalRequest;
use App\Manager\UploadManager;
use App\Constants\Constant;
use App\Manager\CacheManager;
use Carbon\Carbon;

class InvestmentCapitalController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(InvestmentCapital $investmentCapital,CacheManager $cacheManager)
    {
        $this->limit = Helper::setting()->admin_limit;
        $this->investmentCapital = $investmentCapital;
        $this->cache = $cacheManager;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = __('InvestmentCapital');
        $investmentCapital = $this->investmentCapital;
        $investmentCapitalData = $this->investmentCapital->sortable()->orderBy('created_at', 'asc');
        if ($request->query('status')) {
            $status = $request->query('status');
            if($status == 2){
                $status = 0;
            }
            $investmentCapitalData->where('status',$status);
        }
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $investmentCapitalData->where('name', 'LIKE', '%' . $keyword . '%');
        }
        $data = $investmentCapitalData->paginate($this->limit);
        $data->appends($request->query());
        $investmentCapital = $request->query();
        return view('admin.investmentCapital.index', compact('title', 'data', 'request', 'investmentCapital'));
    }

    /**
     * @method get
     *
     * InvestmentCapital
     */
    public function add()
    {
        $title = __('InvestmentCapital');
        $investmentCapital = $this->investmentCapital;
        return view('admin.investmentCapital.add', compact('title', 'investmentCapital'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(InvestmentCapitalRequest $request)
    {
        $data = $this->investmentCapital;
        if (!empty($request->get('id'))) {
            $data = $this->investmentCapital->findOrFail($request->get('id'));
        }
        $data->name = $request->get('name');
        $data->save();
        $this->cache->clear('App\InvestmentCapital');
        if (!empty($request->get('id'))) {
            return redirect()->route('admin.investmentCapital')->with('success', __('Record has been updated successfully'));
        }
        return redirect()->route('admin.investmentCapital')->with('success', __('Record has been added successfully'));
    }

    /**
     * update status
     * @param $id
     * @param $status
    */
    public function process($id,$status,Request $request){
        $investmentCapital = $this->investmentCapital->findOrFail(Helper::decode($id));
        $investmentCapital->update(['status'=>Constant::ITEM_STATUS_SHOW[$request->get('status')]]);
        return true;
    }

     /**
     * Edit
     * @param $id
     * @method get
     *
     */
    public function edit ($id){
        $title = __('InvestmentCapital');
        $investmentCapital = $this->investmentCapital->findOrFail(Helper::decode($id));  
        return view('admin.investmentCapital.edit',compact('title','investmentCapital'));
    }

     /**
     * Delete
     * @param $id
     * @method get
     *
     */
    public function delete($id){
        $investmentCapital = $this->investmentCapital->findOrFail(Helper::decode($id));
        $investmentCapital->delete();
        return  redirect()->back()->with('success', __('Record has been deleted sucessfully'));
    }
 
}
