@if($data->count())
    @foreach($data as $key => $value)
        <tr>
            <td>
                {{$value->name}}
            </td>
            <td>
                @if($value->status ==1)
                    {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>true,'data-url'=>route('admin.tag.process', ['id' => Helper::encode($value->id),'status'=>0]))) }}
                @else
                    {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>false,'data-url'=>route('admin.tag.process', ['id' => Helper::encode($value->id),'status'=>1]))) }}
                @endif
            </td>
            <td>{{Helper::date($value->created_at)}}</td>
            <td>
                {!! Html::decode(link_to_route('admin.tag.edit','<i class="fa fa-edit"></i>', ['id' => Helper::encode($value->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('Edit')])) !!}&nbsp;
                {{ link_to('#javascript:void(0)','<i class="fa fa-trash"></i>',['data-title'=>'tag ?','data-url'=>route('admin.tag.delete', ['id' => Helper::encode($value->id)]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float delete_item','data-toggle'=>'tooltip','data-original-title'=>__('Delete')],null, false)}}
            </td>
        </tr>
    @endforeach
@endif

