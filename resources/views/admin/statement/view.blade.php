<div class="container-fluid pt-5">
        <div class="row clearfix">
             
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-2">
                                <table class="table table-hover">
                                    <tbody>
                                        
                                        <tr>
                                            <td style="width: 30%;">PMS</td>
                                            <td>
                                                @if(!$resultData->is_pay)
                                                    <p class="text-success">Start</p>
                                                @else
                                                    <p class="text-danger">Stop</p>
                                                @endif 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Type</td>
                                            <td>AUTO</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Buy Avg</td>
                                            <td>{{$resultData->buy_avg}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Sell Avg</td>
                                            <td>{{$resultData->sell_avg}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Amount Chg</td>
                                            <td>{{$resultData->amount_chg}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">% Chg</td>
                                            <td>{{$resultData->chg}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Qty</td>
                                            <td>{{$resultData->qty}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Profit/Loss</td>
                                            <td>{{$resultData->pl}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Invested</td>
                                            <td>{{$resultData->invested}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Current Value</td>
                                            <td>{{$resultData->current_value}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">P&L Balance</td>
                                            <td>{{$resultData->PL_balance}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Capital Balance</td>
                                            <td>{{$resultData->capital_balance}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Commission (-5%)</td>
                                            <td>{{$resultData->commission}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Platform Fee</td>
                                            <td>{{$resultData->platform_fee}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Total Commission (Inc Taxes)</td>
                                            <td>{{$resultData->total_commission}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Realised Profit</td>
                                            <td>{{$resultData->realised_profit}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Date & Time</td>
                                            <td>{{$resultData->created_at}}</td>
                                        </tr>
                                        
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
