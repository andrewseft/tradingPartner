@if($data->count())
    @foreach($data as $key => $value)
        <tr>
            <td class="footable-first-visible" style="display: table-cell;">
                {{ucfirst($value->name)}}
            </td>
            <td>{{$value->number}}</td>
            <td>{{$value->email}}</td>
            <td>{{Helper::date($value->created_at)}}</td>
            <td>
                {{ link_to('#javascript:void(0)','<i class="fa fa-eye"></i>',['data-title'=>ucfirst($value->name),'data-url'=>route('admin.contactUs.view', ['id' => Helper::encode($value->id)]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float item_view','data-toggle'=>'tooltip','data-original-title'=>__('View')],null, false)}}&nbsp;
                {{ link_to('#javascript:void(0)','<i class="fa fa-trash"></i>',['data-title'=>$value->name,'data-url'=>route('admin.contactUs.delete', ['id' => Helper::encode($value->id)]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect waves-float delete_item','data-toggle'=>'tooltip','data-original-title'=>__('Delete')],null, false)}}
            </td>
        </tr>
    @endforeach
@endif

