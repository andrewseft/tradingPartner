{{ Form::hidden('translation['.$languagekey.'][locale]', $languagekey)}}
{{ Form::hidden('translation['.$languagekey.'][id]')}}
<div class="form-group">
    {!! Html::decode(Form::label('Title',__('Title').' ('.__($language).')'.'<span class="text-danger">*</span>',['class'=>''])) !!}
    {{ Form::text('translation['.$languagekey.'][title]',null , array_merge(['class' => $errors->has('translation.'.$languagekey.'.title') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#name_error_'.$languagekey,'autofocus'=>'true'])) }}
    <div class="invalid-feedback d-flex" id="name_error_{{$languagekey}}"></div>
    @error('translation.'.$languagekey.'.title')
        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    {!! Html::decode(Form::label('Subject',__('Subject').' ('.__($language).')'.'<span class="text-danger">*</span>',['class'=>''])) !!}
    {{ Form::text('translation['.$languagekey.'][subject]',null , array_merge(['class' => $errors->has('translation.'.$languagekey.'.subject') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#subject_error_'.$languagekey,'autofocus'=>'true'])) }}
    <div class="invalid-feedback d-flex" id="subject_error_{{$languagekey}}"></div>
    @error('translation.'.$languagekey.'.subject')
        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    {!! Html::decode(Form::label('Description',__('Description').' ('.__($language).')'.'<span class="text-danger">*</span>',['class'=>''])) !!}
    {{ Form::textarea('translation['.$languagekey.'][description]',null , array_merge(['id'=>'description_'.$languagekey,'class' => $errors->has('translation.'.$languagekey.'.description') ? 'form-control form-control-user has-error ckeditor': 'form-control form-control-user ckeditor','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#description_error_'.$languagekey,'autofocus'=>'true'])) }}
    <div class="invalid-feedback d-flex" id="description_error_{{$languagekey}}"></div>
    @error('translation.'.$languagekey.'.description')
        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
    @endif
</div>
@if(Route::currentRouteName() == 'admin.email.edit')
    <div class="form-group">
        {!! Html::decode(Form::label('Keword',__('Keword').' ('.__($language).')',['class'=>''])) !!}
        {!! Html::decode($email->translation[$languagekey]['keyword']) !!}
    </div>
@endif
@if(Route::currentRouteName() == 'admin.email.add')
    <div class="form-group">
        {!! Html::decode(Form::label('keyword',__('keyword').' ('.__($language).')',['class'=>''])) !!}
        {{ Form::textarea('translation['.$languagekey.'][keyword]',null , array_merge(['id'=>'keyword_'.$languagekey,'class' => $errors->has('translation.'.$languagekey.'.keyword') ? 'form-control form-control-user has-error ckeditor': 'form-control form-control-user ckeditor'])) }}
        <div class="invalid-feedback d-flex" id="keyword_error_{{$languagekey}}"></div>
        @error('translation.'.$languagekey.'.keyword')
            <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
        @endif
    </div>
@endif




