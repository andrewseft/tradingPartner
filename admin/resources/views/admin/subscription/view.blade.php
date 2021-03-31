@php
    $invested = $subscription->amount * $subscription->qty;
    $current = $subscription->plan->closing_balance * $subscription->qty;
    $currentAmount = $current - $invested;
    $pl = 0;
    if($currentAmount !=0 && $invested != 0){
        $pl = ($currentAmount/$invested)*100;
    }
    $amount = $subscription->plan->planStatus->current_balance - $subscription->plan->planStatus->pre_closing_balance;
    $changed = ($amount / $subscription->plan->planStatus->current_balance)*100;
@endphp

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
                                            <td style="width: 30%;">Plan</td>
                                            <td>{{ucfirst($subscription->plan->title)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Qty</td>
                                            <td>{{$subscription->qty}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Avg</td>
                                            <td>{{number_format($currentPrice,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Total Invested</td>
                                            <td>{{number_format($totalInvested,2)}}</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 30%;">P&L</td>
                                            <td>{{number_format($totalPl,2)}}</td>
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
