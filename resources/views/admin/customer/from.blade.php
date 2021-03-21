
{{ Html::style('css/admin/bootstrap-select.min.css') }}
{{ Html::script('js/admin/bootstrap-select.min.js', ['type' => 'text/javascript']) }}
<div class="row">
    @if(Route::currentRouteName() == 'admin.customer.add' || Route::currentRouteName() == 'admin.customer.edit')
        <div class="col-xl-6">
                <div class="form-group">
                    {!! Html::decode(Form::label('First Name',__('Name').'<span class="text-danger">*</span>',['class'=>''])) !!}
                    {{ Form::text('first_name',null , array_merge(['class' => $errors->has('first_name') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,length','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#first_name_error','data-validation-length'=>'1-50','autofocus'=>'true'])) }}
                    <div class="invalid-feedback d-flex" id="first_name_error"></div>
                    @error('first_name')
                        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- <div class="form-group">
                    {!! Html::decode(Form::label('Last Name',__('Last Name').'<span class="text-danger">*</span>',['class'=>''])) !!}
                    {{ Form::text('last_name',null , array_merge(['class' => $errors->has('last_name') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,length','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#last_name_error','data-validation-length'=>'1-20','autofocus'=>'true'])) }}
                    <div class="invalid-feedback d-flex" id="last_name_error"></div>
                    @error('last_name')
                        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                    @enderror
                </div> -->
                <div class="form-group">
                    {!! Html::decode(Form::label('email',__('Email Address').'<span class="text-danger">*</span>',['class'=>''])) !!}
                    {{ Form::email('email',null , array_merge(['class' => $errors->has('email') ? 'form-control  has-error': 'form-control ','data-validation'=>'required,server','data-validation-url'=>route('checkEmail'),'data-validation-req-params'=>json_encode(['id'=>$user->id]),'data-validation-param-name'=>'email','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#email-error','autofocus'=>'true'])) }}
                    <div class="invalid-feedback d-flex" id="email-error"></div>
                    @error('email')
                        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Html::decode(Form::label('Mobile Number',__('Number').'<span class="text-danger">*</span>',['class'=>''])) !!}
                    {{ Form::text('number',null , array_merge(['id'=>'number','class' => $errors->has('number') ? 'allownumericwithdecimal form-control form-control-user has-error': 'allownumericwithdecimal form-control form-control-user','data-validation'=>'required,length','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#number_error','data-validation-length'=>'8-15','autofocus'=>'true'])) }}
                    <div class="invalid-feedback d-flex" id="number_error"></div>
                    @error('number')
                        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Html::decode(Form::label('investmentCapital',__('Investment Capital(Ex. 5K )').'<span class="text-danger">*</span>',['class'=>''])) !!}
                    {{ Form::select('investmentCapital',$investmentCapital,null, ['id'=>'country_select','data-live-search'=>'true','title'=>__('Choose Investment Capital'),'class' => $errors->has('investmentCapital') ? 'form-control show-tick z-index has-error select2-single': 'form-control show-tick z-index select2-single','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#description_error_category','multiple'=>false]) }}
                    <div class="invalid-feedback d-flex" id="description_error_category"></div>
                    @error('investmentCapital')
                        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                    @enderror
                </div>
        </div>
    @endif
        <div class="col-xl-6">
            @if(Route::currentRouteName() == 'admin.customer.add' || Route::currentRouteName() == 'admin.customer.chnagePassword')
                <div class="form-group">
                    {!! Html::decode(Form::label('Password',__('Password').'<span class="text-danger">*</span>',['class'=>''])) !!}
                    <div class="input-group">
                        {{Form::password('password', ['id'=>'password','class' =>$errors->has('password') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,custom,length','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#password_error','data-validation-length'=>'6-50','data-validation-regexp'=>'^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$','data-validation-error-msg-custom'=>__('PASSWORD_REGEXP'),'autofocus'=>'true'])}}
                        <div class="input-group-append">
                            <span class="input-group-text" class="password_view_icon" onclick="showHidePwd('password','eye_1');"><span toggle="#password-field" id="eye_1" class="fa fa-eye-slash field-icon toggle-password"></span></span>
                        </div>
                        <div class="invalid-feedback d-flex" id="password_error"></div>
                        @error('password')
                            <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    {!! Html::decode(Form::label('Password',__('Confirm Password').'<span class="text-danger">*</span>',['class'=>''])) !!}
                    <div class="input-group">
                        {{Form::password('password_confirmation', ['id'=>'password_confirmation','class' =>$errors->has('password_confirmation') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,length,confirmation','data-validation-confirm'=>'password','data-validation-error-msg-confirmation'=>__('Password and confirm password does not matched'),'data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#password_confirmation_error','data-validation-length'=>'6-50','autofocus'=>'true'])}}
                        <div class="input-group-append">
                            <span class="input-group-text" class="password_view_icon" onclick="showHidePwd('password_confirmation','eye_2');"><span toggle="#password-field" id="eye_2" class="fa fa-eye-slash field-icon toggle-password"></span></span>
                        </div>
                        <div class="invalid-feedback d-flex d-flex" id="password_confirmation_error"></div>
                        @error('password_confirmation')
                            <span class="invalid-feedback d-flex d-flex has-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif
            
            
            @if(Route::currentRouteName() == 'admin.customer.add' || Route::currentRouteName() == 'admin.customer.edit') 
            <div class="form-group">
                {!! Html::decode(Form::label('Address',__('Address').'<span class="text-danger">*</span>',['class'=>''])) !!}
                {{ Form::text('address',null , array_merge(['id'=>'service_area_branch','class' => $errors->has('address') ? 'form-control form-control-user has-error date': 'form-control form-control-user date','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#address_error','autofocus'=>'true'])) }}
                <div class="invalid-feedback d-flex" id="address_error"></div>
                @error('address')
                    <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                @enderror
            </div>
                <div class="form-group">
                    <div class="map" id="map" style="width: 100%; height: 400px;"></div>
                    {!! Form::hidden('latitude', null, ['id' => 'lat', 'class' => 'text text-hidden']) !!}
                    {!! Form::hidden('longitude', null, ['id' => 'lng', 'class' => 'text text-hidden']) !!}
                </div>
                <div class="col-xl-12">
                {!! Html::decode(Form::label('Profile Image',__('Profile Image (Max 1MB & Dimension 200x200-1000x1000)'),['class'=>''])) !!}
                    <div class="member-img store-logo">
                        <div class="edit_profile_sec">
                            <a href="javascript:viod(#);" class="" onclick="openFileOption('store_logo');return;">
                                @if(Helper::exists(Constant::USER_IMAGE_THUMB.$user->image) && $user->image != NULL)
                                    {!! Html::image(Helper::getImageUrl(Constant::USER_IMAGE_THUMB.$user->image),'user',['class'=>'rounded-circle','id'=>'store_logo_view','width'=>'100px'])  !!}
                                @else
                                    {!! Html::image('img/user.png','user',['class'=>'rounded-circle','id'=>'store_logo_view','width'=>'100px'])  !!}
                                @endif
                            </a>
                            <div class="change_profile_pic">{{ Form::file('image', ['id' => 'store_logo', 'name' => 'image', 'class' => 'file','accept'=>'image/*',' data-validation'=>'mime,dimension,size','data-validation-max-size'=>'1024kb','data-validation-error-msg-size'=>'You can not upload images larger than 1024kb','data-validation-error-msg-container'=>'#logo-error','data-validation-allowing'=>'jpg, png','data-validation-dimension'=>'200x200-1000x1000']) }}<i class="fas fa-camera"></i></div>
                        </div>
                        @error('image')
                            <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                        @enderror
                        <div class="invalid-feedback d-flex" id="logo-error"></div>
                    </div>
                </div> 
            @endif
        </div>
    @if(Route::currentRouteName() == 'admin.customer.add' || Route::currentRouteName() == 'admin.customer.edit')
        <div class="col-xl-6">
            
        </div>
    @endif
</div>
<script type="text/javascript" src="{{Constant::MAP_URL}}"></script>
<script>
function initialize() {

    var setzoom = '{{Constant::ZOOM}}';
    var lat = $('#lat').val();
    var lon = $('#lng').val();
    
    var latlng = new google.maps.LatLng(lat,lon);
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 8
    });
    var marker = new google.maps.Marker({
        map: map,
        position: latlng,
        draggable: true,
        anchorPoint: new google.maps.Point(0, -29)
    });

    var input = document.getElementById('service_area_branch');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();   
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
    });

    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {        
                    bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }

            }
        });

    });

}
function bindDataToForm(address,lat,lng){

    document.getElementById('service_area_branch').value = address;
    document.getElementById('lat').value = lat;
    document.getElementById('lng').value = lng;

}
google.maps.event.addDomListener(window, 'load', initialize);
 
</script>
<script>

    function openFileOption(e){document.getElementById(e).click()}$(function(){$(".select2-single").selectpicker(),$(".select2state").selectpicker()}),$(document).on("change","#country_select",function(e){e.preventDefault();var t=$(this).val();$(this),$.ajax({url:"{{route('getStatus')}}",type:"get",data:{country:t},success:function(e){$("#state_div").html(e),$(".select2state").selectpicker()}})}),$(document).on("change","#number_of_product",function(e){e.preventDefault();var t=$(this).val(),c=$("#setup_fee_per_product").val();if(1==t)var n=25*c;if(2==t)n=50*c;if(3==t||4==t)n=100*c;$("#set_up_charge").val(n)}),$("#image_1").change(function(e){document.getElementById("image_view_1").src=URL.createObjectURL(e.target.files[0])}),$("#image_2").change(function(e){document.getElementById("image_view_2").src=URL.createObjectURL(e.target.files[0])}),$("#image_3").change(function(e){document.getElementById("image_view_3").src=URL.createObjectURL(e.target.files[0])}),$("#image_4").change(function(e){document.getElementById("image_view_4").src=URL.createObjectURL(e.target.files[0])}),$("#store_logo").change(function(e){document.getElementById("store_logo_view").src=URL.createObjectURL(e.target.files[0])});
    function showHidePwd(e,t){var a=document.getElementById(e);"password"===a.type?(a.type="text",document.getElementById(t).className="fa fa-eye"):(a.type="password",document.getElementById(t).className="fa fa-eye-slash")}
</script>