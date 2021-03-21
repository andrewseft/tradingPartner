@if($data->count())
    @foreach($data as $key => $value)
        <tr>
            <td>{{Helper::mb_strtolower($value->detail->title)}}</td>
            <td>{{Helper::mb_strtolower($value->detail->subject)}}</td>
            <td>{{Helper::date($value->detail->created_at)}}</td>
            <td>
            @if(Helper::permissionAction('EmailController@edit'))
                {!! Html::decode(link_to_route('admin.email.edit','<i class="fa fa-edit"></i>', ['id' => Helper::encode($value->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('Edit')])) !!}
            @endif
            </td>
        </tr>
    @endforeach
@endif

