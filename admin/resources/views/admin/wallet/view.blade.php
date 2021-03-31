<div class="container-fluid pt-5">
    <div class="row clearfix">
        <div class="col-lg-4 col-md-12">
            <div class="card member-card">
                <div class="header l-cyan">
                    <h4 class="m-t-10">{{$user->fullName}}</h4>
                </div>
                <div class="member-img">

                        @if(Helper::exists(Constant::USER_IMAGE_THUMB.$user->image) && $user->image != NULL)
                            {!! Html::image(Helper::getImageUrl(Constant::USER_IMAGE_THUMB.$user->image),'user',['class'=>'rounded-circle'])  !!}
                        @else
                            {!! Html::image('img/user.png','user',['class'=>'rounded-circle'])  !!}
                        @endif

                </div>
                <div class="body">
                    <div class="col-12">
                        <p class="text-muted">{{$user->email}}</p>
                    </div>
                    <hr>
                    <div class="card-body">
                        <small class="text-muted">{{__('Available Balance')}}</small>
                        <h6>{{$amount}}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-2">
                            <table class="table table-hover">
                                <tbody>
                                    @foreach($result as $key => $value)
                                        <tr>
                                            <td style="width: 30%;"><b>{{$key}}</b></td>
                                        </tr>
                                        @foreach($value as $Ikey => $item)
                                            @if($item->type == 1)
                                                <tr class="Credit" style="background-color: #a0fea0a3;">
                                            @else
                                                <tr class="Credit" style="background-color: #f6c4c4;">
                                            @endif
                                                <td style="width: 30%;" class="pl-5">{{$item->amount}}</td>
                                                <td style="width: 30%;" class="pl-5">
                                                    {{$item->remark}}<br>
                                                    <small>{{$item->created_at}}</small>
                                                </td>
                                                <td style="width: 30%;" class="pl-5">{{$item->closing_bal}}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    
                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
