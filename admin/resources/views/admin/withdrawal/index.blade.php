@extends('layouts.admin')
@section('content')
{{ Html::style('css/admin/bootstrap-material-datetimepicker.css') }}
{{ Html::script('js/admin/moment.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/bootstrap-material-datetimepicker.js', ['type' => 'text/javascript']) }}
<div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>{{$title}}</h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="zmdi zmdi-home"></i>&nbsp; {{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-lg-12 col-md-12 col-sm-12 pt-2">
                    <div class="card">
                        <ul class="row profile_state list-unstyled">
                            <li class="col-lg-4 col-md-4 col-4">
                                <div class="body">
                                    <h4>{{number_format($total,2)}}</h4>
                                    <span>Total</span>
                                </div>
                            </li>
                            <li class="col-lg-4 col-md-4 col-4">
                                <div class="body">
                                    <h4>{{number_format($paid,2)}}</h4>
                                    <span>Paid</span>
                                </div>
                            </li>
                            <li class="col-lg-4 col-md-4 col-4">
                                <div class="body">
                                    <h4>{{number_format($unPaid,2)}}</h4>
                                    <span>Unpaid</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> 
            </div> 
        </div>
</div>
    <div class="container-fluid">
        @if($data->count() || $request->query('status') || $request->query('keyword') || $request->query('created_at_from') || $request->query('created_at_to'))
            <div class="row no-gutters">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            {{ Form::model($withdrawalData, ['url' => route('admin.withdrawal'),'class' => 'search_form','method'=>'get']) }}
                                <div class="row table_search_form align-items-center">
                                    <div class="col input_feild py-1">
                                        {{ Form::text('keyword',null , array_merge(['class' =>'form-control','placeholder'=>__('Search by user')])) }}
                                    </div>
                                    <div class="col status_feild py-1">
                                        {{ Form::select('status',Constant::WITHDRAWAL_STATUS,null, ['class'=>'form-control','placeholder'=>__('Search by Status')]) }}
                                    </div>
                                    <div class="col date_feild py-1">
                                        {{ Form::text('created_at_from',null , array_merge(['id'=>'date','class' =>'form-control date','placeholder'=>__('From'),'readonly'=>true])) }}
                                        <a href="javascript:void(0)" class="{{isset($withdrawalData['created_at_from']) ? 'date_feild_close_show': 'date_feild_close'}}"><i class="fas fa-times-circle"></i></a>
                                    </div>
                                    <div class="col date_feild py-1">
                                        {{ Form::text('created_at_to',null , array_merge(['class' =>'form-control date','placeholder'=>__('To'),'readonly'=>true])) }}
                                        <a href="javascript:void(0)" class="{{isset($withdrawalData['created_at_to']) ? 'date_feild_close_show': 'date_feild_close'}}"><i class="fas fa-times-circle"></i></a>
                                    </div>
                                    <div class="col py-1">{{ Form::button('<i class="fas fa-search"></i>',['class'=>'btn btn-secondary float-left','id'=>'submitButton','type'=>'submit']) }}</div>
                                    <div class="col py-1">{{ link_to( route('admin.withdrawal'),'<i class="fas fa-redo-alt"></i>',['class'=>'btn btn-danger'],null, false)}}</div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row clearfix">
            <div class="col-lg-12 pb-3">
                @if($data->count())
                    @include('includes.admin.pagination')
                @endif
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card product_item_list">
                    <div class="body table-responsive">
                    @if($data->count() || $request->query('status') || $request->query('keyword') || $request->query('created_at_from') || $request->query('created_at_to'))
                        @if($data->count())
                            <table class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>@sortablelink('amount',__('Amount '))</th>
                                        <th>@sortablelink('status',__('Status '))</th>
                                        <th>@sortablelink('created_at',__('created At '))</th>
                                        <th>{{__('Action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($data->count())
                                        @foreach($data as $key => $value)
                                            <tr>
                                                <td>{{$value->user->fullName}}</td>
                                                <td>{{number_format($value->amount,2)}}</td>
                                                <td>
                                                @if($value->status)
                                                    <p class="text-success">Paid</p>
                                                @else
                                                    <p class="text-danger">Unpaid</p>
                                                @endif 
                                                </td>
                                                <td>{{$value->created_at}}</td>
                                                <td>
                                                    {{ link_to('#javascript:void(0)','<i class="fa fa-eye"></i>',['data-title'=>'','data-url'=>route('admin.withdrawal.view', ['id' => Helper::encode($value->id)]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float item_view','data-toggle'=>'tooltip','data-original-title'=>__('View')],null, false)}}&nbsp;
                                                    @if(!$value->status)
                                                        {{ link_to('#javascript:void(0)','<i class="fas fa-plus-circle"></i>',['data-title'=>ucfirst($value->fullName),'data-url'=>route('admin.withdrawal.addAmount', ['id' => $value->id]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float add_point','data-toggle'=>'tooltip','data-original-title'=>__('Credit')],null, false)}}&nbsp;
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        @else
                            @include('includes.admin.notFound')
                        @endif
                    @else
                        <center class=" mb-4 mt-2">
                            {!! Html::image('img/confused.png','user',['class'=>'img-circle','width'=>60])  !!}
                            <h5 class="pt-4">{{__('There is No Records for Now')}}</h5>
                            
                        </center>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
 
<script>
    $(".date").bootstrapMaterialDatePicker({weekStart:0,time:!1}).on("change",function(e,t){$(this).focus(),$(this).next().removeClass("date_feild_close").addClass("date_feild_close_show")});
    $(document).on("click",".date_feild_close_show",function(){$(this).prev().val(""),$(this).removeClass("date_feild_close_show").addClass("date_feild_close")});
    $(document).on("change",".status_click",function(t){t.preventDefault();var c=$(this).data("url"),e=$(this).prop("checked");console.log($(this).prop("checked")),$.ajax({url:c,data:{status:e},type:"get",success:function(t){}})});
</script>

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
            content:'<div class="meme-image"><img src="{{URL::to("img/logo.png")}}" alt="furniche" style="width: 120px;"></div><div style="font-weight: bold;margin-top: 20px;"><b>'+title+'</b></div><div class="meme-text" style="font-weight: bold;margin-bottom: 20px;"></div><div><div class="price_sign_sec"><span class="counter_offer_view"></span><input type="textarea" placeholder="{{__('Enter notes for user')}}"  class="amount form-control" required/></div>',
            columnClass: "col-md-6 col-md-offset-3",
            buttons: {
                formSubmit: {
                    text: "{{__('Submit')}}",
                    btnClass: 'btn-blue',
                    action: function() {
                        var name = this.$content.find('.amount').val();
                        var numbers = /^[-+]?[0-9]+$/;
                        if (!name) {
                            $.alert("{{__('Notes is a required field')}}");
                            return false;
                        }
                        window.location.href = a + '&message=' + name;
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
     
@stop