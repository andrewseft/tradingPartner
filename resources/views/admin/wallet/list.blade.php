@if($data->count())
    @foreach($data as $key => $value)
        <tr>
            <td>{{$value->fullName}}</td>
            <td>{{$value->email}}</td>
            <td>{{$value->number}}</td>
            <td>
                @if(isset($value->wallet->closing_bal))
                    {{number_format($value->wallet->closing_bal,2)}}
                @else
                    0.00
                @endif
            </td>
            <td>{{Helper::date($value->created_at)}}</td>
            <td>
                @if(isset($value->wallet->closing_bal))
                    {{ link_to('#javascript:void(0)','<i class="fa fa-eye"></i>',['data-title'=>'','data-url'=>route('admin.wallet.view', ['id' => Helper::encode($value->id)]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float item_view','data-toggle'=>'tooltip','data-original-title'=>__('View')],null, false)}}&nbsp;
                @endif
                {{ link_to('#javascript:void(0)','<i class="fas fa-plus-circle"></i>',['data-title'=>ucfirst($value->fullName),'data-url'=>route('admin.wallet.addAmount', ['id' => $value->id]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float add_point','data-toggle'=>'tooltip','data-original-title'=>__('Credit')],null, false)}}&nbsp;
                @if(isset($value->wallet->closing_bal))
                    {{ link_to('#javascript:void(0)','<i class="fas fa-plus-circle"></i>',['data-title'=>ucfirst($value->fullName),'data-url'=>route('admin.wallet.debitAmount', ['id' => $value->id]),'onclick'=>'return false;','class'=>'btn btn-dange waves-effect  waves-float add_point','data-toggle'=>'tooltip','data-original-title'=>__('Debit')],null, false)}}
                @endif
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
            content:'<div class="meme-image"><img src="{{URL::to("img/logo.png")}}" alt="furniche" style="width: 120px;"></div><div style="font-weight: bold;margin-top: 20px;"><b>'+title+'</b></div><div class="meme-text" style="font-weight: bold;margin-bottom: 20px;"></div><div><div class="price_sign_sec"><span class="counter_offer_view"></span><input type="text" placeholder="{{__('Enter amount')}}" onkeypress="return isNumberKey(event)" class="amount form-control" required/></div>',
            columnClass: "col-md-6 col-md-offset-3",
            buttons: {
                formSubmit: {
                    text: "{{__('Submit')}}",
                    btnClass: 'btn-blue',
                    action: function() {
                        var name = this.$content.find('.amount').val();
                        var numbers = /^[-+]?[0-9]+$/;
                        if (!name) {
                            $.alert("{{__('amount is a required field')}}");
                            return false;
                        }
                        if (name.match(numbers)) {
                            window.location.href = a + '&point=' + name;
                        } else {
                            $.alert("{{__('Enter valid amount')}}");
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
</script

