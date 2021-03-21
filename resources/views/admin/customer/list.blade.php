@if($data->count())
    @foreach($data as $key => $value)
        <tr>
            <td>{{$value->fullName}}</td>
            <td>{{$value->email}}</td>
            <td>{{$value->number}}</td>
            
            <td>
                @if($value->status ==1)
                    {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>true,'data-url'=>route('admin.customer.process', ['id' => Helper::encode($value->id),'status'=>0]))) }}
                @else
                    {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>false,'data-url'=>route('admin.customer.process', ['id' => Helper::encode($value->id),'status'=>1]))) }}
                @endif
            </td>
            <td>
                @if($value->is_kyc == 1)
                    <span class="text-success">Approved</span>
                @elseif($value->is_kyc == 2)
                    <span class="text-danger">Rejected</<span>
                @else
                    <span class="text-danger">Pending</<span>
                @endif
            </td>
            <td>{{Helper::date($value->created_at)}}</td>
            <td>
                @if($value->is_kyc == 0)
                    {{ link_to('#javascript:void(0)','<i class="fas fa-check"></i>',['data-title'=>$value->fullName,'data-url'=>route('admin.customer.kycProcess', ['id' => Helper::encode($value->id),'status'=>1]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect waves-float booking_item','data-toggle'=>'tooltip','data-original-title'=>__('KYC Approve')],null, false)}}&nbsp;
                    {{ link_to('#javascript:void(0)','<i class="fas fa-times"></i>',['data-title'=>$value->fullName,'data-url'=>route('admin.customer.kycProcess', ['id' => Helper::encode($value->id),'status'=>2]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect waves-float add_point','data-toggle'=>'tooltip','data-original-title'=>__('KYC Reject')],null, false)}}&nbsp;
                @endif
                {!! Html::decode(link_to_route('admin.customer.edit','<i class="fa fa-edit"></i>', ['id' => Helper::encode($value->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('Edit')])) !!}&nbsp;
                {!! Html::decode(link_to_route('admin.customer.chnagePassword','<i class="fa fa-key"></i>', ['id' => Helper::encode($value->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('Change Password')])) !!}&nbsp;
                {{ link_to('#javascript:void(0)','<i class="fa fa-trash"></i>',['data-title'=>$value->fullName,'data-url'=>route('admin.customer.delete', ['id' => Helper::encode($value->id)]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect waves-float delete_item','data-toggle'=>'tooltip','data-original-title'=>__('Delete')],null, false)}}&nbsp;
                {!! Html::decode(link_to_route('admin.customer.view','<i class="fa fa-eye"></i>', ['id' => Helper::encode($value->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('View')])) !!}&nbsp;
            </td>
        </tr>
    @endforeach
@endif
<script>
    $(".add_point").click(function() {
        let a = $(this).data("url");
        let title = $(this).data("title");
        $.confirm({
            theme: "modern",
            closeIcon: !0,
            animation: "scale",
            type: "blue",
            backgroundDismiss: !0,
            columnClass: "col-md-6 col-md-offset-3",
            title: !1,
            content:'<div class="meme-image"><img src="{{URL::to("img/logo.png")}}" alt="tradingPartner" style="width: 120px;"></div><div style="font-weight: bold;margin-top: 20px;"><b>'+title+'</b></div><div class="meme-text" style="font-weight: bold;margin-bottom: 20px;"></div><div><div class="price_sign_sec"><span class="counter_offer_view"></span><input type="text" placeholder="{{__('Enter reject reason')}}" class="cancel_reason form-control" required/></div>',
            columnClass: "col-md-6 col-md-offset-3",
            closeIcon: !0,
            buttons: {
                formSubmit: {
                    text: "{{__('Submit')}}",
                    btnClass: 'btn-blue',
                    action: function() {
                        var name = this.$content.find('.cancel_reason').val();
                        if (!name) {
                            $.alert("{{__('Reject reason is a required field')}}");
                            return false;
                        }
                        window.location.href = a + '?message=' + name;
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
</script>

