<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\ReferralLog;
use App\ReferralUse;

class ReferralController extends Controller
{
    /** @var  Limit */
    private $limit;

    /** @var  ReferralLog */
    private $log;

    /** @var  ReferralUse */
    private $use;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(ReferralLog $log, ReferralUse $use)
    {
        $this->log = $log;
        $this->use = $use;
        $this->limit = Helper::setting()->admin_limit;
    }

    /**
     * List 
     * 
     * @param $id
     * @method get
     *
     */
    public function index(Request $request){
        $title = __('Referral');
        $useData = $this->use;
        $use = $this->use->sortable()->with(['user','from'])->orderBy('id', 'desc');
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $use->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            })->orwhereHas('plan', function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $use->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $use->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $use->whereDate('created_at', '=', $date);
        }                     
        $data = $use->paginate($this->limit);
        $data->appends($request->query());
      
        $useData = $request->query();
        return view('admin.referral.index', compact('title', 'data', 'request', 'use','useData'));
         
    }

    /**
     * List 
     * 
     * @param $id
     * @method get
     *
     */
    public function referralUse(Request $request){
        $title = __('Referral');
        $useData = $this->log;
        $use = $this->log->sortable()->with(['user'])->orderBy('id', 'desc');
        if ($request->query('keyword')) {
            $keyword = $request->query('keyword');
            $use->whereHas('user', function ($q) use ($keyword) {
                $q->where('first_name', 'LIKE', '%' . $keyword . '%');
            })->orwhereHas('plan', function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%');
            });
        }
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            $use->whereBetween('created_at', array($from_date, $end_date));
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $use->whereDate('created_at', '=', $date);
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            $use->whereDate('created_at', '=', $date);
        }                     
        $data = $use->paginate($this->limit);
        $data->appends($request->query());
      
        $useData = $request->query();
        return view('admin.referral.referralUse', compact('title', 'data', 'request', 'use','useData'));
         
    }
}
