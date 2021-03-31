@if($data->count())
    @foreach($data as $key => $value)
        <tr>
            <td>{{$value->name}}</td>
            <td>+{{$value->phonecode}}</td>
            <td>
                @if($value->status ==1)
                    {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>true,'data-url'=>route('admin.country.process', ['id' => Helper::encode($value->id),'status'=>0]))) }}
                @else
                    {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>false,'data-url'=>route('admin.country.process', ['id' => Helper::encode($value->id),'status'=>1]))) }}
                @endif
            </td>
            <td>{{Helper::date($value->created_at)}}</td>
        </tr>
    @endforeach
@endif

