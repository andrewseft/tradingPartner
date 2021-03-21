<div class="form-group pt-3">
    {!! Html::decode(Form::label('Amount',__('Amount(Ex. 10K)').'<span class="text-danger">*</span>',['class'=>''])) !!}
    {{ Form::text('name',null , array_merge(['class' => $errors->has('name') ? 'allownumericwithdecimal form-control form-control-user has-error': 'allownumericwithdecimal form-control form-control-user','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#name_error','autofocus'=>'true'])) }}
    <div class="invalid-feedback d-flex" id="name_error"></div>
    @error('name')
        <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
    @enderror
</div>
   
  

