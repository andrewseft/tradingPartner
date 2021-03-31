

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
                                            <td>{{ucfirst($redeem->plan->title)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Qty</td>
                                            <td>{{number_format($redeem->qty)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Buy Value</td>
                                            <td>{{number_format($redeem->plan->amount,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Sell Value</td>
                                            <td>{{number_format($redeem->amount,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Buy Average</td>
                                            <td>{{number_format($redeem->plan->amount,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Sell Average</td>
                                            <td>{{number_format($redeem->amount,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Realized P&L</td>
                                            <td>{{number_format($redeem->realized,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Planform fee</td>
                                            <td>{{number_format($redeem->planform_fee,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Commission</td>
                                            <td>{{number_format($redeem->commission,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Sebi</td>
                                            <td>{{number_format($redeem->sebi,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Sgst</td>
                                            <td>{{number_format($redeem->sgst,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Stamp Duty</td>
                                            <td>{{number_format($redeem->stamp_duty,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Stt</td>
                                            <td>{{number_format($redeem->stt,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Igst</td>
                                            <td>{{number_format($redeem->igst,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Cgst</td>
                                            <td>{{number_format($redeem->cgst,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Exchange transaction tax</td>
                                            <td>{{number_format($redeem->exchange_transaction_tax,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Total Charges</td>
                                            <td>{{number_format($redeem->total_charges,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Final P&L</td>
                                            <td>{{number_format($redeem->final_pl,2)}}</td>
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
