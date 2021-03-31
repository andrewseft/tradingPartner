<?php

namespace App\Exports;

use App\Statement;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Constants\Constant;

class SubscriptionRedeemExport implements FromCollection,WithHeadings
{
    /** @var  Request */
    private $request;

    /** @var  userId */
    private $userId;

    public function __construct($userId, $request){
        $this->request = $request;
        $this->userId = $userId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        $redeemQuery = Statement::where('user_id',$this->userId)->with(['plan']);
        if (!empty($this->request->get('start_date')) && !empty($this->request->get('end_date'))) {
            $from_date = Carbon::createFromFormat('Y-m-d', $this->request->get('start_date'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $this->request->get('end_date'))->format('Y-m-d').' 23:59:59';
            $redeemQuery->whereBetween('created_at', array($from_date, $end_date))->get();
        }
        $data = $redeemQuery->get();
        
        $newData   = [];
		if(!empty($data)){
			foreach($data as $item){

				$newData[]    =  [
                    'Date' => $item->created_at,
                    'Plan' => ucfirst($item->plan->title),
                    'Type' => "Auto",
                    'Buy Avg' => number_format($item->buy_avg,2),
                    'Sell Avg' => number_format($item->sell_avg,2),
                    'Amount Chg' => number_format($item->amount_chg,2),
                    '% Chg' => number_format($item->chg,2),				
                    'Qty' => $item->qty,
                    'Profit/Loss' => number_format($item->pl,2),
                    'Invested' => number_format($item->invested,2),
                    'Current Value' => number_format($item->current_value,2),
                    'P&L Balance' => number_format($item->PL_balance,2),
                    'Capital Balance' => number_format($item->capital_balance,2),
                    'Commission (-5%)' => number_format($item->commission,2),
                    'Platform Fee' => number_format($item->platform_fee,2),
                    'Total Commission (Inc Taxes)' => number_format($item->total_commission,2),
                    'Realised Profit' => number_format($item->realised_profit,2),				
				];
			}
			
        }
        $collection = new Collection($newData);
		return $collection;
    }

    public function headings(): array
	{
		return [
            'Date',
            'Plan' ,
            'Type',
            'Buy Avg' ,
            'Sell Avg',
            'Amount Chg' ,
            '% Chg' ,			
            'Qty',
            'Profit/Loss' ,
            'Invested',
            'Current Value' ,
            'P&L Balance' ,
            'Capital Balance' ,
            'Platform Fee' ,
            'Total Commission (Inc Taxes)' ,
            'Realised Profit'
		];
	}
}
