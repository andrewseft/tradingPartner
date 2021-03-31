<div class="row">
    <div class="col-xl-12">
        @foreach(Helper::language() as $languagekey => $language)
            <div class="tab-pane fade py-3 {{ $languagekey == App::getLocale() ? ' active' : '' }} show" id="home-{{$languagekey}}" role="tabpanel" aria-labelledby="home-{{$languagekey}}-tab">
                {{ Form::hidden('translation['.$languagekey.'][locale]', $languagekey)}}
                {{ Form::hidden('translation['.$languagekey.'][id]')}}
                <div class="form-group">
                    {!! Html::decode(Form::label('Title',__('Title').' ('.__($language).')'.'<span class="text-danger">*</span>',['class'=>''])) !!}
                    {{ Form::text('translation['.$languagekey.'][name]',null , array_merge(['class' => $errors->has('translation.'.$languagekey.'.name') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#name_error_'.$languagekey,'autofocus'=>'true'])) }}
                    <div class="invalid-feedback d-flex" id="name_error_{{$languagekey}}"></div>
                    @error('translation.'.$languagekey.'.name')
                        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>
</div>
 


