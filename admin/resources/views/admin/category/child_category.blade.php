<ul class="card-body publications_list_body p-0 collapse" id="collapse_{{$childCategory->category_id}}">
    <li>
        <div class="publications_list_header">
            <div class="d-flex align-items-center border-left-0 border-right-0 position-relative">
                <div class="accordian-folder-line d-inline-flex align-items-center justify-content-end pr-3" style="min-width: {{3.42*$i.'rem'}}"><span></span></div>
                <div class="card-header accordian-arrow d-inline-flex align-items-center justify-content-center" data-toggle="collapse" data-target="#collapse_{{$childCategory->id}}" aria-expanded="true" aria-controls="collapseinnerOne">
                    @if($childCategory->categories->count())
                        <span><i class="fas fa-caret-right"></i></span>
                    @endif
                </div>
                <div class="d-block d-md-inline-flex align-items-center flex-fill">
                    <div class="d-inline-flex align-items-center">
                        <a class="folder_icon d-inline-flex pl-4 mx-2" href="javascript:void(0)">
                            @if(Helper::exists(Constant::CAT_IMAGE.$childCategory->logo) && $childCategory->logo != NULL)
                                {!! Html::image(Helper::getImageUrl(Constant::CAT_IMAGE.$childCategory->logo),'user',['class'=>'','width'=>'30px'])  !!}
                            @else
                                {!! Html::image('img/photo.svg','user',['class'=>'','width'=>'30px'])  !!}
                            @endif
                        </a>
                        <div class="publications_list_name  d-block d-md-inline-flex px-4 flex-column">
                            <div class="list-name-title">
                                <div class="list-name-title-inner" id="listtitle01">{{ $childCategory->detail->name }}</div>
                            </div>
                            <div class="created-date text-capitalize">Created: <span>{{Helper::date($childCategory->created_at)}}</span></div>
                        </div>
                    </div>
                    <div class="d-block d-md-inline-flex justify-content-end flex-fill pl-3 pl-sm-2 pl-md-4 ml-3 ml-sm-2 mr-2 mr-lg-5">
                        <div class="publications_list_image_count d-inline-flex align-items-center">
                            @if($child_category->categories->count() > 0)
                                <i class="fas fa-folder mt-1 mr-2"></i>{{$child_category->categories->count()}}
                            @else
                                <i class="far fa-folder mt-1 mr-2"></i>{{$child_category->categories->count()}}
                            @endif
                        </div>
                        <div class="publications_list_image_count d-inline-flex align-items-center">
                            @if($child_category->status ==1)
                                {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>true,'data-url'=>route('admin.category.process', ['id' => Helper::encode($child_category->id),'status'=>0]))) }}
                            @else
                                {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>false,'data-url'=>route('admin.category.process', ['id' => Helper::encode($child_category->id),'status'=>1]))) }}
                            @endif
                        </div>
                    </div>
                    <div class="mr-md-5 mr-4 mt-3 mt-md-0">
                        <div class="manage-images-edit-icons w-auto mr-4">
                            <ul class="manage-images-edit-icons-inner">
                                {!! Html::decode(link_to_route('admin.category.edit','<i class="fa fa-edit"></i>', ['id' => Helper::encode($child_category->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('Edit')])) !!}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($child_category->categories->count())
                @foreach ($child_category->categories as $childCategory)
                    @php
                        $i++;
                    @endphp
                    @include('admin.category.child_category', ['child_category' => $childCategory])
                @endforeach
        @endif
    </li>
</ul>