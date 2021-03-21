@if($data->count())
    @foreach($data as $key => $value)
        @php
            $qty = 0;
            foreach($value['orderList'] as $k => $order){
                 
                $qty += $order['qty'];
            }
        @endphp
        <tr>
            <td> {{ucfirst($value->title)}}</td>
            <td> {{Constant::PLAN_TYPE[$value->type]}}</td>
            <td>
                @php
                    $amount = $value->amount + $value->closing_balance;
                @endphp
                @if($amount > $value->amount)
                    <p class="text-success">{{number_format($amount,2)}}</p>
                @else
                    <p class="text-danger">{{number_format($amount,2)}}</p>
                @endif 
            </td>
            <td> {{$qty}}/&nbsp;{{$value->market_cap+$qty}}</td>
            <td class="update_closing_balance">
                @if($value->type == 1 || $value->type == 2)
                    @if($value->order_count > 0)
                        {{ link_to('#javascript:void(0)',$value->closing_balance,['data-title'=>ucfirst($value->title),'data-url'=>route('admin.plan.closingBalance', ['id' => $value->id]),'onclick'=>'return false;','class'=>'add_point','data-toggle'=>'tooltip','data-original-title'=>__('Add Closing Balance')],null, false)}}
                    @else
                        {{$value->closing_balance}}
                    @endif
                @else
                    @if($value->pl > $value->amount)
                        <p class="text-success">{{number_format($value->pl,2)}}</p>
                    @else
                        <p class="text-danger">{{number_format($value->pl,2)}}</p>
                    @endif 
                     
                @endif
            </td>
            <td>
                @if($value->status ==1)
                    {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>true,'data-url'=>route('admin.plan.process', ['id' => Helper::encode($value->id),'status'=>0]))) }}
                @else
                    {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>false,'data-url'=>route('admin.plan.process', ['id' => Helper::encode($value->id),'status'=>1]))) }}
                @endif
            </td>
            <td>{{Helper::date($value->created_at)}}</td>
            <td>
                @if($value->type == 3)
                    {{ link_to('#javascript:void(0)','<i class="fas fa-rupee-sign"></i>',['data-title'=>ucfirst($value->title),'data-url'=>route('admin.plan.addProfit', ['id' => $value->id]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float add_profit','data-toggle'=>'tooltip','data-original-title'=>__('Add profit')],null, false)}}&nbsp;
                    {{ link_to('#javascript:void(0)','<i class="fas fa-rupee-sign"></i>',['data-title'=>ucfirst($value->title),'data-url'=>route('admin.plan.addLoss', ['id' => $value->id]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float add_loss','data-toggle'=>'tooltip','data-original-title'=>__('Add loss')],null, false)}}&nbsp;
                @endif
                {!! Html::decode(link_to_route('admin.plan.edit','<i class="fa fa-edit"></i>', ['id' => Helper::encode($value->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('Edit')])) !!}&nbsp;
                @if($value->type == 1 || $value->type == 2)
                    {!! Html::decode(link_to_route('admin.plan.view','<i class="fa fa-eye"></i>', ['id' => Helper::encode($value->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('View')])) !!}&nbsp;
                @else
                    {!! Html::decode(link_to_route('admin.plan.viewPMS','<i class="fa fa-eye"></i>', ['id' => Helper::encode($value->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('View')])) !!}&nbsp;
                @endif
                {{ link_to('#javascript:void(0)','<i class="fa fa-trash"></i>',['data-title'=>'plan ?','data-url'=>route('admin.plan.delete', ['id' => Helper::encode($value->id)]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float delete_item','data-toggle'=>'tooltip','data-original-title'=>__('Delete')],null, false)}}&nbsp;

            </td>
        </tr>
    @endforeach
@endif

<script>
    $(".add_point").click(function() {
        let a = $(this).data("url");
        let amount = $(this).data("point");
        let title = '';
        $.confirm({
            theme: "modern",
            animation: "scale",
            type: "blue",
            backgroundDismiss: !0,
            columnClass: "col-md-6 col-md-offset-3",
            title: !1,
            content:'<div class="meme-image"><img src="{{URL::to("img/logo.png")}}" alt="furniche" style="width: 120px;"></div><div style="font-weight: bold;margin-top: 20px;"><b>'+title+'</b></div><div class="meme-text" style="font-weight: bold;margin-bottom: 20px;"></div><div><div class="price_sign_sec"><span class="counter_offer_view"></span><input type="text" placeholder="{{__('Enter Closing Balance')}}" onkeypress="return isNumberKey(event)" class="amount form-control" required/></div>',
            columnClass: "col-md-6 col-md-offset-3",
            buttons: {
                formSubmit: {
                    text: "{{__('Submit')}}",
                    btnClass: 'btn-blue',
                    action: function() {
                        var name = this.$content.find('.amount').val();
                        var numbers = /^[-+]?[0-9]+$/;
                        if (!name) {
                            $.alert("{{__('Closing balance is a required field')}}");
                            return false;
                        }
                        if (name.match(numbers)) {
                            window.location.href = a + '&point=' + name;
                        } else {
                            $.alert("{{__('Enter valid closing balance')}}");
                            return false;
                        }
                    }
                },
                no: {
                    text: "{{__('Cancel')}}",
                    btnClass: "btn-danger",
                    keys: ["enter"]
                }
            },
        });
    });
    $(".add_profit").click(function() {
        let a = $(this).data("url");
        let amount = $(this).data("point");
        let title = '';
        $.confirm({
            theme: "modern",
            animation: "scale",
            type: "blue",
            backgroundDismiss: !0,
            columnClass: "col-md-6 col-md-offset-3",
            title: !1,
            content:'<div class="meme-image"><img src="{{URL::to("img/logo.png")}}" alt="furniche" style="width: 120px;"></div><div style="font-weight: bold;margin-top: 20px;"><b>'+title+'</b></div><div class="meme-text" style="font-weight: bold;margin-bottom: 20px;"></div><div><div class="price_sign_sec"><span class="counter_offer_view"></span><input type="text" placeholder="{{__('Enter Profit Amount')}}" onkeypress="return isNumberKey(event)" class="amount form-control" required/></div>',
            columnClass: "col-md-6 col-md-offset-3",
            buttons: {
                formSubmit: {
                    text: "{{__('Submit')}}",
                    btnClass: 'btn-blue',
                    action: function() {
                        var name = this.$content.find('.amount').val();
                        var numbers = /^[-+]?[0-9]+$/;
                        if (!name) {
                            $.alert("{{__('Profit amount is a required field')}}");
                            return false;
                        }
                        if (name.match(numbers)) {
                            window.location.href = a + '&point=' + name;
                        } else {
                            $.alert("{{__('Enter valid profit amount')}}");
                            return false;
                        }
                    }
                },
                no: {
                    text: "{{__('Cancel')}}",
                    btnClass: "btn-danger",
                    keys: ["enter"]
                }
            },
        });
    });
    $(".add_loss").click(function() {
        let a = $(this).data("url");
        let amount = $(this).data("point");
        let title = '';
        $.confirm({
            theme: "modern",
            animation: "scale",
            type: "blue",
            backgroundDismiss: !0,
            columnClass: "col-md-6 col-md-offset-3",
            title: !1,
            content:'<div class="meme-image"><img src="{{URL::to("img/logo.png")}}" alt="furniche" style="width: 120px;"></div><div style="font-weight: bold;margin-top: 20px;"><b>'+title+'</b></div><div class="meme-text" style="font-weight: bold;margin-bottom: 20px;"></div><div><div class="price_sign_sec"><span class="counter_offer_view"></span><input type="text" placeholder="{{__('Enter Profit Amount')}}" onkeypress="return isNumberKey(event)" class="amount form-control" required/></div>',
            columnClass: "col-md-6 col-md-offset-3",
            buttons: {
                formSubmit: {
                    text: "{{__('Submit')}}",
                    btnClass: 'btn-blue',
                    action: function() {
                        var name = this.$content.find('.amount').val();
                        var numbers = /^[-+]?[0-9]+$/;
                        if (!name) {
                            $.alert("{{__('Profit amount is a required field')}}");
                            return false;
                        }
                        if (name.match(numbers)) {
                            window.location.href = a + '&point=' + name;
                        } else {
                            $.alert("{{__('Enter valid profit amount')}}");
                            return false;
                        }
                    }
                },
                no: {
                    text: "{{__('Cancel')}}",
                    btnClass: "btn-danger",
                    keys: ["enter"]
                }
            },
        });
    });
    function isNumberKey(evt){ if ((evt.which != 46 || $(this).val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {  event.preventDefault();}}
</script>

