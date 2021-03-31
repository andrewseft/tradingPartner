
@extends('layouts.admin')
@section('content')
    <div class="row" >
        <div class="col-md-12 m-b-30">
            <!-- begin page title -->
            <div class="d-block d-sm-flex flex-nowrap align-items-center">
                <div class="page-title mb-2 mb-sm-0">
                    <h1>{{$title}}</h1>
                </div>
                <div class="ml-auto d-flex align-items-center">
                    <nav>
                        <ol class="breadcrumb p-0 m-b-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}"><i class="ti ti-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.language')}}">{{$title}}</a>
                            </li>
                            <li class="breadcrumb-item  text-primary" aria-current="page">List</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12 m-b-30">
            <div class="card card-statistics h-100 mb-0">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-heading">
                        <h4 class="card-title">&nbsp;</h4>
                    </div>
                </div>
                @if($data->count() || $request->query('title'))
                    <div class="card-body scrollbar scroll_dark pt-0" style="max-height: 350px;">
                        <div class="datatable-wrapper table-responsive">
                            @if($data->count())
                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@sortablelink('name',__('Title'))</th>
                                            <th>@sortablelink('status',__('Status'))</th>
                                            <th>@sortablelink('created_at',__('created At'))</th>
                                            <th>{{__('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ajax_reload">
                                        @include('admin.language.list')
                                    </tbody>
                                </table>
                            @else
                                @include('includes.admin.notFound')
                            @endif
                        </div>
                        @include('includes.admin.pagination')
                    </div>
                @else
                    <center class=" mb-4 mt-2">
                        {!! Html::image('img/confused.png','user',['class'=>'img-circle','width'=>60])  !!}
                        <h5 class="pt-4">{{__('There is No Records for Now')}}</h5>
                    </center>
                @endif
            </div>
        </div>
    </div>
    <script>
        $(document).on("click",".status_click",function(t){t.preventDefault();var a=$(this).data("url"),s=$(this).data("id"),i=$(this);$.ajax({url:a,type:"get",beforeSend:function(){i.html('<i class="fa fa-spinner fa-spin"></i>')},success:function(t){$("#status_"+s).html(t)}})});
    </script>

@stop
