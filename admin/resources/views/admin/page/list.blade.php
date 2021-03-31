@if($data->count())
    @foreach($data as $key => $value)
        <tr>
            <td>{{Helper::mb_strtolower($value->detail->title)}}</td>
            <td>
                @if($value->status ==1)
                    {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>true,'data-url'=>route('admin.page.process', ['id' => Helper::encode($value->id),'status'=>0]))) }}
                @else
                    {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>false,'data-url'=>route('admin.page.process', ['id' => Helper::encode($value->id),'status'=>1]))) }}
                @endif
            </td>
            <td>{{Helper::date($value->detail->created_at)}}</td>
            <td>
            @if(Helper::permissionAction('PagesController@edit'))
                {!! Html::decode(link_to_route('admin.page.edit','<i class="fa fa-edit"></i>', ['id' => Helper::encode($value->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('Edit')])) !!}
            @endif
            </td>
        </tr>
    @endforeach
@endif

