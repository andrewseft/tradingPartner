<div class="container-fluid pt-5">
    <div class="row clearfix">
         
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-2">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td width="25%">Withdrawal amount</td>
                                        <td>{{$withdrawalData->amount}}</td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Name</td>
                                        <td>{{$withdrawalData->user->fullName}}</td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Email</td>
                                        <td>{{$withdrawalData->user->email}}</td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Number</td>
                                        <td>{{$withdrawalData->user->number}}</td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Bank</td>
                                        <td>{{isset($withdrawalData->user->profile->bank_name) ? $withdrawalData->user->profile->bank_name : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Account number</td>
                                        <td>{{isset($withdrawalData->user->profile->account_number) ? $withdrawalData->user->profile->account_number : "N/A"}}</td>
                                    </tr>
                                    <tr>
                                        <td width="25%">IFSC code</td>
                                        <td>{{isset($withdrawalData->user->profile->ifsc_code) ? $withdrawalData->user->profile->ifsc_code : "N/A"}}</td>
                                    </tr>

                                    <tr>
                                        <td width="25%">Note</td>
                                        <td>{{$withdrawalData->description ? $withdrawalData->description : "N/A"}}</td>
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
