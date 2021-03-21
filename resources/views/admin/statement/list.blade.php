@if($data->count())
    @foreach($data as $key => $value)
        <tr>
            <td>
                <b>{{$value->user->fullName}}</b><br>
                <small>{{$value->user->email}}</small><br>
                <small>{{$value->user->number}}</small>
            </td>
            <td>{{$value->plan->title}}</td>
            <td>{{$value->capital_balance}}</td>
            <td>{{$value->realised_profit}}</td>
            <td>
                @if(!$value->is_pay)
                    <p class="text-success">Start</p>
                @else
                    <p class="text-danger">Stop</p>
                @endif 
            </td>
            <td>{{Helper::date($value->created_at)}}</td>
            <td>
                {{ link_to('#javascript:void(0)','<i class="fa fa-eye"></i>',['data-title'=>$value->user->fullName,'data-url'=>route('admin.statement.view', ['id' =>$value->id]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float item_view','data-toggle'=>'tooltip','data-original-title'=>__('View')],null, false)}}&nbsp;
            </td>
        </tr>
    @endforeach
@endif
 

