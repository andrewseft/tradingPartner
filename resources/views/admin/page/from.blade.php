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
    {!! Html::decode(Form::label('Description',__('Description').' ('.__($language).')'.'<span class="text-danger">*</span>',['class'=>''])) !!}
    {{ Form::textarea('translation['.$languagekey.'][description]',null , array_merge(['id'=>'description_'.$languagekey,'class' => $errors->has('translation.'.$languagekey.'.description') ? 'form-control form-control-user has-error ckeditor': 'form-control form-control-user ckeditor','placeholder'=>__('Description'),'data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#description_error_'.$languagekey,'autofocus'=>'true'])) }}
    <div class="invalid-feedback d-flex" id="description_error_{{$languagekey}}"></div>
    @error('translation.'.$languagekey.'.description')
        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    {!! Html::decode(Form::label('Meta Title',__('Meta Title').' ('.__($language).')',['class'=>''])) !!}
    {{ Form::text('translation['.$languagekey.'][meta_title]',null , array_merge(['class' => $errors->has('translation.'.$languagekey.'.meta_title') ? 'form-control form-control-user has-error': 'form-control form-control-user','autofocus'=>'true'])) }}
    @error('translation.'.$languagekey.'.meta_title')
        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
    @enderror
</div>
<div class="form-group">
    {!! Html::decode(Form::label('Meta Keyword',__('Meta Keyword').' ('.__($language).')',['class'=>''])) !!}
    {{ Form::text('translation['.$languagekey.'][meta_keyword]',null , array_merge(['class' => $errors->has('translation.'.$languagekey.'.meta_keyword') ? 'form-control form-control-user has-error': 'form-control form-control-user','autofocus'=>'true'])) }}
    @error('translation.'.$languagekey.'.meta_keyword')
        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Html::decode(Form::label('Meta Description',__('Meta Description').' ('.__($language).')',['class'=>''])) !!}
    {{ Form::text('translation['.$languagekey.'][meta_description]',null , array_merge(['class' => $errors->has('translation.'.$languagekey.'.meta_description') ? 'form-control form-control-user has-error': 'form-control form-control-user','autofocus'=>'true'])) }}
    @error('translation.'.$languagekey.'.meta_description')
        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
    @enderror
</div>
