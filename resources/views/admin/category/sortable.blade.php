@extends('layouts.admin_short')
@section('content')
{{ Html::style('css/admin/jquery-nestable.css') }}

<div class="container-fluid pt-5">
        <!-- Draggable Handles -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">

                    <div class="body">
                        <div class="clearfix m-b-20">
                            <div class="dd nestable-with-handle">
                                <ol class="dd-list">
                                    @foreach ($data as $category)
                                        <li class="dd-item dd3-item" data-id="{{ $category->id }}">
                                            <div class="dd-handle dd3-handle"></div>
                                            <div class="dd3-content">{{ $category->detail->name }}</div>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Draggable Handles -->
    </div>
</div>
<!-- end row -->
{{ Html::script('js/admin/jquery.nestable.js', ['type' => 'text/javascript']) }}
<script>
    $(".dd").nestable({protectRoot: true,maxDepth: 1}),$(".dd").on("change",function(){var a=$(this),e=window.JSON.stringify($(a).nestable("serialize"));$.ajax({url:"{{route('admin.category.sortableSave')}}",data:{data:e},type:"post",success:function(a){}})});
</script>
@stop