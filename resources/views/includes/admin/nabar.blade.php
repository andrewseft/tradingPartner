<div class="menu">
    <ul class="list">
        <li>
            <div class="user-info">
                <div class="image">
                <div>
                    @if(Helper::exists(Constant::USER_IMAGE_THUMB.auth()->guard(Constant::GUARD)->user()->image) && auth()->guard(Constant::GUARD)->user()->image != NULL)
                        {!! Html::image(Helper::getImageUrl(Constant::USER_IMAGE_THUMB.auth()->guard(Constant::GUARD)->user()->image),'user',['class'=>'rounded-circle','id'=>'','width'=>'100px'])  !!}
                    @else
                        {!! Html::image('img/user.png','user',['class'=>'rounded-circle','id'=>'','width'=>'100px'])  !!}
                    @endif
                </div></div>
                <div class="detail">
                    <h4>{{ auth()->guard(Constant::GUARD)->user()->fullName }}</h4>
                    <small>{{auth()->guard(Constant::GUARD)->user()->email }}</small>
                </div>
                {!! Html::decode(link_to_route('admin.profile','<i class="fa fa-user pr-2"></i>',null,['data-toggle'=>'tooltip','title'=>__('My Profile')])) !!}
                {!! Html::decode(link_to_route('admin.changePassword','<i class="fa fa-key pr-2"></i>',null,['data-toggle'=>'tooltip','title'=>__('Change Password')])) !!}
                {!! Html::decode(link_to_route('admin.setting','<i class="fa fa-cogs pr-2"></i>',null,['data-toggle'=>'tooltip','title'=>__('Setting')])) !!}
            </div>
        </li>
        <li class="{{Helper::activeAction(['HomeController@index'])}}">
            {!! Html::decode(link_to_route('admin.dashboard','<i class="nav-icon fa fa-home"></i> <span class="nav-title">'. __('Dashboard').'</span>',null,['class'=>'waves-effect waves-block '])) !!}
        </li>
        
        <li class="{{Helper::activeAction(['StatementController@userStatement','WalletController@userWallet','SubscriptionRedeemController@userRedeem','SubscriptionController@userSubscription','OrderController@userOrder','CustomerController@index','CustomerController@add','CustomerController@edit','CustomerController@chnagePassword','CustomerController@view'])}}">
            <a href="javascript:void(0);" class="menu-toggle"><i class="fas fa-users"></i><span>{{__('Users')}}</span></a>
            <ul class="ml-menu {{Helper::activeActionUl(['CustomerController'])}}">
                <li class="{{Helper::activeAction(['StatementController@userStatement','WalletController@userWallet','SubscriptionRedeemController@userRedeem','SubscriptionRedeemController@userRedeem','SubscriptionController@userSubscription','OrderController@userOrder','CustomerController@index','CustomerController@edit','CustomerController@chnagePassword','CustomerController@view','CustomerController@add'])}}"> {!! Html::decode(link_to_route('admin.customer', __('Customers'),null,['class'=>'collapse-item '.Helper::activeAction(['CustomerController@chnagePassword','CustomerController@view','CustomerController@index','CustomerController@edit'])])) !!} </li>
            </ul>
        </li>
        <li class="{{Helper::activeAction(['PlanController@statementViewStop','PlanController@statementView','PlanController@viewPMS','PlanController@index','PlanController@edit','PlanController@add','PlanController@view'])}}">
            {!! Html::decode(link_to_route('admin.plan','<i class="fas fa-sign-language"></i> <span class="nav-title">'. __('Plans').'</span>',null,['class'=>'nav-link '])) !!}
        </li>
        <li class="{{Helper::activeAction(['InvestmentCapitalController@index','InvestmentCapitalController@edit','InvestmentCapitalController@add'])}}">
            {!! Html::decode(link_to_route('admin.investmentCapital','<i class="fas fa-rupee-sign"></i> <span class="nav-title">'. __('Investment Capitals').'</span>',null,['class'=>'nav-link '])) !!}
        </li>
        <li class="{{Helper::activeAction(['SubscriptionController@stopIndex','StatementController@index','OrderController@index','SubscriptionController@index','SubscriptionRedeemController@index'])}}">
            <a href="javascript:void(0);" class="menu-toggle"><i class="far fa-file-word"></i><span>{{__('Reports')}}</span></a>
            <ul class="ml-menu">
                <li class="{{Helper::activeAction(['OrderController@index'])}}"> {!! Html::decode(link_to_route('admin.order',__('Orders'),null,['class'=>'collapse-item '.Helper::activeAction(['OrderController@index'])])) !!}  </li>
                <li class="{{Helper::activeAction(['SubscriptionController@index'])}}"> {!! Html::decode(link_to_route('admin.subscription',__('Start Subscriptions'),null,['class'=>'collapse-item '.Helper::activeAction(['SubscriptionController@index'])])) !!}  </li>
                <li class="{{Helper::activeAction(['SubscriptionController@stopIndex'])}}"> {!! Html::decode(link_to_route('admin.subscription.stopIndex',__('Stop Subscriptions'),null,['class'=>'collapse-item '.Helper::activeAction(['SubscriptionController@stopIndex'])])) !!}  </li>
                <!-- <li class="{{Helper::activeAction(['StatementController@index'])}}"> {!! Html::decode(link_to_route('admin.statement',__('User Statement'),null,['class'=>'collapse-item '.Helper::activeAction(['StatementController@index'])])) !!}  </li> -->
            </ul>
        </li>
         
         
        <li class="{{Helper::activeAction(['TagController@sortable','TagController@index','TagController@add','TagController@edit','TagController@sortable','CategoryController@sortable','CategoryController@index','CategoryController@add','CategoryController@edit','CategoryController@sortable','FaqController@index','FaqController@edit','FaqController@add','PagesController@index','PagesController@edit','PagesController@add'])}}">
            <a href="javascript:void(0);" class="menu-toggle"><i class="far fa-file"></i><span>{{__('CMS')}}</span></a>
            <ul class="ml-menu {{Helper::activeActionUl(['SettingController'])}}">
                <li class="{{Helper::activeAction(['PagesController@index','PagesController@edit','PagesController@add'])}}"> {!! Html::decode(link_to_route('admin.page',__('Static Pages'),null,['class'=>'collapse-item '.Helper::activeAction(['SettingController@index'])])) !!}  </li>
                <li class="{{Helper::activeAction(['FaqController@index','FaqController@edit','FaqController@add'])}}"> {!! Html::decode(link_to_route('admin.faq',__('Faqs'),null,['class'=>'collapse-item '.Helper::activeAction(['SettingController@index'])])) !!}  </li>
                <li class="{{Helper::activeAction(['CategoryController@sortable','CategoryController@index','CategoryController@add','CategoryController@edit','CategoryController@sortable'])}}"> {!! Html::decode(link_to_route('admin.category',__('Categories'),null,['class'=>'collapse-item '])) !!}  </li>
                <li class="{{Helper::activeAction(['TagController@sortable','TagController@index','TagController@add','TagController@edit','TagController@sortable'])}}"> {!! Html::decode(link_to_route('admin.tag',__('Tages'),null,['class'=>'collapse-item '])) !!}  </li>      
            </ul>
        </li>

        <li class="{{Helper::activeAction(['ReferralController@index','ReferralController@referralUse'])}}">
            <a href="javascript:void(0);" class="menu-toggle"><i class="fas fa-user-tag"></i><span>{{__('Referral')}}</span></a>
            <ul class="ml-menu">
                <li class="{{Helper::activeAction(['ReferralController@index'])}}"> {!! Html::decode(link_to_route('admin.referral',__('Used'),null,['class'=>'collapse-item '.Helper::activeAction(['ReferralController@referralUse'])])) !!}  </li>
                <li class="{{Helper::activeAction(['ReferralController@referralUse'])}}"> {!! Html::decode(link_to_route('admin.referralUse',__('Received'),null,['class'=>'collapse-item '.Helper::activeAction(['ReferralController@index'])])) !!}  </li>
            </ul>
        </li>

        <li class="{{Helper::activeAction(['EmailController@index','EmailController@edit','EmailController@add'])}}">
            {!! Html::decode(link_to_route('admin.email','<i class="nav-icon fa fa-envelope"></i> <span class="nav-title">'. __('Email Templates').'</span>',null,['class'=>'nav-link '])) !!}
        </li>

        <li class="{{Helper::activeAction(['WalletController@index'])}}">
            {!! Html::decode(link_to_route('admin.wallet','<i class="fas fa-wallet"></i> <span class="nav-title">'. __('Wallet').'</span>',null,['class'=>'nav-link '])) !!}
        </li>

        <li class="{{Helper::activeAction(['EarningController@index'])}}">
            {!! Html::decode(link_to_route('admin.earning','<i class="fas fa-rupee-sign"></i> <span class="nav-title">'. __('Earnings').'</span>',null,['class'=>'nav-link '])) !!}
        </li>

        
         
        <li class="{{Helper::activeAction(['SettingController@index','BannerController@index','BannerController@add','BannerController@edit','BannerController@view'])}}">
            <a href="javascript:void(0);" class="menu-toggle"><i class="nav-icon fa fa-cogs"></i><span>{{__('Platform Settings')}}</span></a>
            <ul class="ml-menu {{Helper::activeActionUl(['SettingController'])}}">
                <li class="{{Helper::activeAction(['SettingController@index'])}}"> {!! Html::decode(link_to_route('admin.setting',__('Settings'),null,['class'=>'collapse-item '.Helper::activeAction(['SettingController@index'])])) !!}  </li>
                <li class="{{Helper::activeAction(['BannerController@index','BannerController@add','BannerController@edit','BannerController@view'])}}"> {!! Html::decode(link_to_route('admin.banner',__('Banners'),null,['class'=>'collapse-item '.Helper::activeAction(['SettingController@index'])])) !!}  </li>
            </ul>
        </li>
        <li class="{{Helper::activeAction(['ContactUsController@index','MeetingController@index'])}}">
            <a href="javascript:void(0);" class="menu-toggle"><i class="fas fa-question"></i><span>{{__('Enquiries')}}</span></a>
            <ul class="ml-menu {{Helper::activeActionUl(['ContactUsController'])}}">
                <li class="{{Helper::activeAction(['ContactUsController@index'])}}">{!! Html::decode(link_to_route('admin.contactUs','<span class="nav-title">'. __('Contact Us').'</span>',null,['class'=>'nav-link '])) !!}</li>
            </ul>
        </li>
         
        <li class="{{Helper::activeAction(['HomeController@notificationList'])}}">
            {!! Html::decode(link_to_route('admin.notificationList','<i class="far fa-bell"></i> <span class="nav-title">'. __('Notifications').'</span><span class="notification_count">'.Helper::notificationCount(auth()->guard(Constant::GUARD)->user()->id).'</span>',null,['class'=>'nav-link '])) !!}
        </li>
        <!-- <li class="{{Helper::activeAction(['LanguageController@index','LanguageController@edit','LanguageController@add'])}}">
            {!! Html::decode(link_to_route('admin.language','<i class="nav-icon fa fa-language"></i> <span class="nav-title">'. __('Languages').'</span>',null,['class'=>'nav-link '])) !!}
        </li> -->
    </ul>
</div>