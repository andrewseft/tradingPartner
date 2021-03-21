@if($data->count())
    @foreach($data as $key => $value)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{__(Helper::mb_strtolower($value->name))}}</td>
            <td id="status_{{$value->id}}">
                @if ($value->code != \App::getLocale())
                    @if($value->status ==1)
                        {{ link_to('#javascript:void(0)','<span class="badge badge-success-inverse">'.__('Enable').'</span>',['data-id'=>$value->id,'data-url'=>route('admin.language.process', ['id' => Helper::encode($value->id),'status'=>0]),'onclick'=>'return false;','class'=>'mr-3 status_click'],null, false)}}
                    @endif
                    @if($value->status ==0)
                        {{ link_to('#javascript:void(0)','<span class="badge badge-danger-inverse">'.__('Disable').'</span>',['data-id'=>$value->id,'data-url'=>route('admin.language.process', ['id' => Helper::encode($value->id),'status'=>1]),'onclick'=>'return false;','class'=>'mr-3 status_click'],null, false)}}
                    @endif
                @endif
            </td>
            <td>{{Helper::date($value->updated_at)}}</td>
            <td>
                {!! Html::decode(link_to_route('admin.language.edit','<i class="fa fa-edit"></i>', ['id' => Helper::encode($value->id)], ['class'=>'mr-3','data-toggle'=>'tooltip','data-original-title'=>__('Edit')])) !!}
            </td>

        </tr>
    @endforeach
@endif
