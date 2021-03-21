@foreach(Helper::language() as $languagekey => $language)
    <div class="tab-pane fade py-3 {{ $languagekey == App::getLocale() ? ' active' : '' }} show" id="home-{{$languagekey}}" role="tabpanel" aria-labelledby="home-{{$languagekey}}-tab">
        {{ Form::hidden('translation['.$languagekey.'][locale]', $languagekey)}}
        {{ Form::hidden('translation['.$languagekey.'][id]')}}
            <div class="form-group">
                {!! Html::decode(Form::label('Title',__('Question').' ('.__($language).')'.'<span class="text-danger">*</span>',['class'=>''])) !!}
                {{ Form::text('translation['.$languagekey.'][title]',null , array_merge(['class' => $errors->has('translation.'.$languagekey.'.title') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#name_error_'.$languagekey,'autofocus'=>'true'])) }}
                <div class="invalid-feedback d-flex" id="name_error_{{$languagekey}}"></div>
                @error('translation.'.$languagekey.'.title')
                    <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                {!! Html::decode(Form::label('Description',__('Answer').' ('.__($language).')'.'<span class="text-danger">*</span>',['class'=>''])) !!}
                {{ Form::textarea('translation['.$languagekey.'][description]',null , array_merge(['id'=>'description_'.$languagekey,'class' => $errors->has('translation.'.$languagekey.'.description') ? 'form-control form-control-user has-error ckeditor': 'form-control form-control-user ckeditor','placeholder'=>__('Description'),'data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#description_error_'.$languagekey,'autofocus'=>'true'])) }}
                <div class="invalid-feedback d-flex" id="description_error_{{$languagekey}}"></div>
                @error('translation.'.$languagekey.'.description')
                    <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                @enderror
            </div>
    </div>
@endforeach
@include('includes.admin.ckedit')
 
 


 
 
