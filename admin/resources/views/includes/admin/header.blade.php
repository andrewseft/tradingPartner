<div class="col-12">
        <div class="navbar-header" >
            <a href="javascript:void(#);" class="bars"></a>
            <a class="navbar-brand" href="{{route('admin.dashboard')}}">
                {!! Html::image('img/logo.png',null,['width'=>'50px','class'=>"login_logo"]) !!}
            </a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right slideDown">
                        @if(Helper::notificationList(auth()->guard(Constant::GUARD)->user()->id)->count())
                            <li class="header">{{__('Notifications')}}</li>
                        @else
                            <li class="header">{{__('No Notifications')}}</li>
                        @endif
                        <li class="body">
                            <ul class="menu list-unstyled">
                                @foreach(Helper::notificationList(auth()->guard(Constant::GUARD)->user()->id) as $key => $value)
                                    <li> <a href="javascript:void(#);">
                                        <div class="menu-info">
                                            <h4>{{$value->message}}</h4>
                                            <p><i class="zmdi zmdi-time"></i> {{$value->created_at->diffForHumans()}} </p>
                                        </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @if(Helper::notificationList(auth()->guard(Constant::GUARD)->user()->id)->count())
                            <li class="footer"> <a href="{{route('admin.notificationList')}}">{{__('View All Notifications')}}</a> </li>
                        @endif
                    </ul>
                </li>
           
            <li>
                {{ link_to('#javascript:void(0)','<i class="zmdi zmdi-power"></i>',['class'=>'mega-menu logout','data-url'=>route('admin.logout'),'onclick'=>'return false;','data-toggle'=>'tooltip','title'=>__('Logout')],null, false)}}
            </li>
        </ul>
</div>