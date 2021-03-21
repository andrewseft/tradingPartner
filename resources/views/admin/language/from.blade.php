
<div class="form-group">
    {!! Html::decode(Form::label('Title',__('Title').'&nbsp;<span class="text-danger">*</span>',['class'=>'col-md-12'])) !!}
    <div class="col-md-12">
        {{ Form::text('name',null , array_merge(['class' => $errors->has('name') ? 'form-control form-control-line has-error': 'form-control form-control-line','placeholder'=>__('Title'),'data-validation'=>'required','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#site_name_error'])) }}
        <div class="invalid-feedback" id="site_name_error"></div>
        @error('name')
            <span class="invalid-feedback has-error">{{ $message }}</span>
        @endif
    </div>
</div>
@if(Route::currentRouteName() == 'admin.language.add')
<div class="form-group">
    {!! Html::decode(Form::label('code',__('Code').'&nbsp;<span class="text-danger">*</span>',['class'=>'col-md-12'])) !!}
    <div class="col-md-12">
        {{ Form::text('code',null , array_merge(['class' => $errors->has('code') ? 'form-control form-control-line has-error': 'form-control form-control-line','placeholder'=>__('Code'),'data-validation'=>'required','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#code_error'])) }}
        <div class="invalid-feedback" id="code_error"></div>
        @error('code')
            <span class="invalid-feedback has-error">{{ $message }}</span>
        @endif
    </div>
</div>
@endif
<div class="form-group">
    <div class="col-md-12">
        {{ Form::textarea('description',null , array_merge(['size'=>'30x30','class' => $errors->has('description') ? 'form-control form-control-line has-error ': 'form-control form-control-line ','placeholder'=>__('Description'),'data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#description_error'])) }}
        <div class="invalid-feedback" id="description_error"></div>
        @error('description')
            <span class="invalid-feedback has-error">{{ $message }}</span>
        @endif
    </div>
</div>