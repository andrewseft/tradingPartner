{{ Html::style('css/admin/bootstrap-material-datetimepicker.css') }}
{{ Html::script('js/admin/moment.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/bootstrap-material-datetimepicker.js', ['type' => 'text/javascript']) }}
    @if( Route::currentRouteName() == 'admin.banner.add')
        <div class="form-group pt-3">
            {!! Html::decode(Form::label('image',__('Image').'<span class="text-danger">* Max 2mb & dimensions 1920 * 950 - 2560 * 1080</span>',['class'=>''])) !!}<br>
            {{ Form::file('image', ['id' => 'image', 'name' => 'image', 'class' => 'file','accept'=>'image/*',' data-validation'=>'required,mime,dimension,size','data-validation-max-size'=>'2048kb','data-validation-error-msg-size'=>'You can not upload images larger than 2048kb','data-validation-error-msg-container'=>'#image-error','data-validation-allowing'=>'jpg, png']) }}
            @error('image')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
            <div class="invalid-feedback d-flex" id="image-error"></div>
        </div>
    @endif
    @if( Route::currentRouteName() == 'admin.banner.edit')
        <div class="form-group pt-3">
            {!! Html::decode(Form::label('image',__('Image').'<span class="text-danger"> Max 2mb & dimensions 1920 * 950</span>',['class'=>''])) !!}<br>
            {{ Form::file('image', ['id' => 'image', 'name' => 'image', 'class' => 'file','accept'=>'image/*',' data-validation'=>'mime,dimension,size','data-validation-max-size'=>'2048kb','data-validation-error-msg-size'=>'You can not upload images larger than 2048kb','data-validation-error-msg-container'=>'#image-error','data-validation-allowing'=>'jpg, png','data-validation-dimension'=>'1920x950-2560x1080']) }}
            @error('image')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
            <div class="invalid-feedback d-flex" id="image-error"></div>
        </div>
    @endif

    <div class="form-group pt-3">
        {!! Html::decode(Form::label('Hyperlink',__('Hyperlink(https://www.hnicalls.com)').'<span class="text-danger">*</span>',['class'=>''])) !!}
        {{ Form::text('hyperlink',null , array_merge(['class' => $errors->has('hyperlink') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,url','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#hyperlink_error','autofocus'=>'true'])) }}
        <div class="invalid-feedback d-flex" id="hyperlink_error"></div>
        @error('hyperlink')
            <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
        @enderror
    </div>
   
  

