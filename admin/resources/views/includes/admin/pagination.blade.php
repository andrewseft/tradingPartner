@if($data->total() != 0)
    <div class="pagination_sec d-flex align-items-center p-3">
        <div class="px-2 mr-auto">
            @if($data->total() > ($data->currentpage()*$data->perpage()))
                {{__('Showing')}} {{($data->currentpage()-1)*$data->perpage()+1}} {{__('to')}} {{$data->currentpage()*$data->perpage()}} {{__('of')}}  {{$data->total()}} {{__('entries')}}
            @else
                {{__('Showing')}} {{($data->currentpage()-1)*$data->perpage()+1}} {{__('to')}} {{$data->total()}} {{__('of')}}  {{$data->total()}} {{__('entries')}}
            @endif
        </div>

        @if($data->total() != 0)
            <div class="px-2 ml-auto">
                {{ $data->onEachSide(1)->links() }}
            </div>
        @endif
    </div>
@endif
