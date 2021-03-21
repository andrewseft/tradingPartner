{{ Html::style('css/admin/bootstrap-select.min.css') }}
{{ Html::script('js/admin/bootstrap-select.min.js', ['type' => 'text/javascript']) }}
{{ Html::style('css/admin/bootstrap-material-datetimepicker.css') }}
{{ Html::script('js/admin/moment.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/bootstrap-material-datetimepicker.js', ['type' => 'text/javascript']) }}

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="form-group">
            {!! Html::decode(Form::label('type',__('Type').'<span class="text-danger">*</span>',['class'=>''])) !!}
            {{ Form::select('type',[1 =>'Redeem' ,2 => 'Trading',3 => 'Auto'],null, ['id'=>'plan_type','data-live-search'=>'true','title'=>__('Choose Plan Type'),'class' => $errors->has('type') ? 'form-control show-tick z-index has-error select2-single': 'form-control show-tick z-index select2-single','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#description_error_type','multiple'=>false]) }}
            <div class="invalid-feedback d-flex" id="description_error_type"></div>
            @error('type')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('Title',__('Title').'<span class="text-danger">*</span>',['class'=>''])) !!}
            {{ Form::text('title',null , array_merge(['class' => $errors->has('title') ? ' form-control form-control-user has-error': ' form-control form-control-user','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#title_error','autofocus'=>'true'])) }}
            <div class="invalid-feedback d-flex" id="title_error"></div>
            @error('title')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('category',__('Category').'<span class="text-danger"></span>',['class'=>''])) !!}
            {{ Form::select('category[]',$category,null, ['id'=>'country_select','data-live-search'=>'true','title'=>__('Choose Category'),'class' => $errors->has('category') ? 'form-control show-tick z-index has-error select2-single': 'form-control show-tick z-index select2-single','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#description_error_category','multiple'=>true]) }}
            <div class="invalid-feedback d-flex" id="description_error_category"></div>
            @error('category')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('tag',__('Tag').'<span class="text-danger"></span>',['class'=>''])) !!}
            {{ Form::select('tag[]',$tag,null, ['id'=>'country_select','data-live-search'=>'true','title'=>__('Choose Tag'),'class' => $errors->has('tag') ? 'form-control show-tick z-index has-error select2-single': 'form-control show-tick z-index select2-single','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#description_error_tag','multiple'=>true]) }}
            <div class="invalid-feedback d-flex" id="description_error_tag"></div>
            @error('tag')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('Description',__('Description').'<span class="text-danger">*</span>',['class'=>''])) !!}
            {{ Form::textarea('description',null , array_merge(['id'=>'description','class' => $errors->has('description') ? 'form-control form-control-user has-error ckeditor': 'form-control form-control-user ckeditor','placeholder'=>__('Description'),'data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#description_error','autofocus'=>'true'])) }}
            <div class="invalid-feedback d-flex" id="description_error"></div>
            @error('description')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="form-group">
            {!! Html::decode(Form::label('Amount',__('Amount').'<span class="text-danger">*</span>',['class'=>''])) !!}
            {{ Form::text('amount',null , array_merge(['class' => $errors->has('amount') ? 'allownumericwithdecimal form-control form-control-user has-error': 'allownumericwithdecimal form-control form-control-user','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#amount_error','autofocus'=>'true'])) }}
            <div class="invalid-feedback d-flex" id="amount_error"></div>
            @error('amount')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group min_qty_div">
            {!! Html::decode(Form::label('min_qty',__('Minimum sold qty').'<span class="text-danger">*</span>',['class'=>''])) !!}
            {{ Form::text('min_qty',null , array_merge(['class' => $errors->has('min_qty') ? 'allownumericwithdecimal form-control form-control-user has-error': 'allownumericwithdecimal form-control form-control-user','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#min_qty_error','autofocus'=>'true'])) }}
            <div class="invalid-feedback d-flex" id="min_qty_error"></div>
            @error('min_qty')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {!! Html::decode(Form::label('qty',__('Qty').'<span class="text-danger">*</span>',['class'=>''])) !!}
            {{ Form::text('qty',null , array_merge(['class' => $errors->has('qty') ? 'allownumericwithdecimal form-control form-control-user has-error': 'allownumericwithdecimal form-control form-control-user','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#qty_error','autofocus'=>'true'])) }}
            <div class="invalid-feedback d-flex" id="qty_error"></div>
            @error('qty')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div> 
        <!-- <div class="form-group">
            {!! Html::decode(Form::label('market_cap',__('Market Cap').'<span class="text-danger">*</span>',['class'=>''])) !!}
            {{ Form::text('market_cap',null , array_merge(['class' => $errors->has('market_cap') ? 'allownumericwithdecimal form-control form-control-user has-error': 'allownumericwithdecimal form-control form-control-user','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#market_cap_error','autofocus'=>'true'])) }}
            <div class="invalid-feedback d-flex" id="market_cap_error"></div>
            @error('market_cap')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>  -->
        <div class="form-group">
            {!! Html::decode(Form::label('closing_balance',__('Closing balance').'<span class="text-danger">*</span>',['class'=>''])) !!}
            {{ Form::text('closing_balance',null , array_merge(['class' => $errors->has('closing_balance') ? 'allownumericwithdecimal form-control form-control-user has-error': 'allownumericwithdecimal form-control form-control-user','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#closing_balance_error','autofocus'=>'true'])) }}
            <div class="invalid-feedback d-flex" id="closing_balance_error"></div>
            @error('closing_balance')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group planType">
            {!! Html::decode(Form::label('start_time',__('Start Time(24H format)').'<span class="text-danger">*</span>',['class'=>''])) !!}
            {{ Form::text('start_time',null , array_merge(['class' => $errors->has('start_time') ? 'form-control form-control-user has-error date': 'date form-control form-control-user','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#start_time_error','autofocus'=>'true','readonly'=>true])) }}
            <div class="invalid-feedback d-flex" id="start_time_error"></div>
            @error('start_time')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group planType">
            {!! Html::decode(Form::label('end_time',__('End Time(24H format)').'<span class="text-danger">*</span>',['class'=>''])) !!}
            {{ Form::text('end_time',null , array_merge(['class' => $errors->has('end_time') ? 'form-control form-control-user has-error date': 'date form-control form-control-user','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#end_time_error','autofocus'=>'true','readonly'=>true])) }}
            <div class="invalid-feedback d-flex" id="end_time_error"></div>
            @error('end_time')
                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<script type="text/javascript">
    var plan_type = $("#plan_type").val();
    if(plan_type == 2 || plan_type == 3){
        $(".date").show();
        $(".planType").show();
    }else{
        $(".date").hide();
        $(".planType").hide();
    }

    if(plan_type != 3){
        $(".min_qty_div").show();
    }else{
        $(".min_qty_div").hide();
    }
    
    $('#plan_type').change(function(){
      var val = $(this).val();
        if(val == 2 || val == 3){
            $(".date").show();
            $(".planType").show();
        }else{
            $(".date").hide();
            $(".planType").hide();
        }
        if(val != 3){
            $(".min_qty_div").show();
        }else{
            $(".min_qty_div").hide();
        }
    });
    $(".date").bootstrapMaterialDatePicker({ date: false,format: 'HH:mm'}).on("change",function(e,t){$(this).focus(),$(this).next().removeClass("date_feild_close").addClass("date_feild_close_show")});
</script>













 


@include('includes.admin.ckedit')
<script>
     
    function openFileOption(e){document.getElementById(e).click()}$(function(){$(".select2-single").selectpicker(),$(".select2state").selectpicker()}),$(document).on("change","#country_select",function(e){e.preventDefault();var t=$(this).val();$(this),$.ajax({url:"{{route('getStatus')}}",type:"get",data:{country:t},success:function(e){$("#state_div").html(e),$(".select2state").selectpicker()}})}),$(document).on("change","#number_of_product",function(e){e.preventDefault();var t=$(this).val(),c=$("#setup_fee_per_product").val();if(1==t)var n=25*c;if(2==t)n=50*c;if(3==t||4==t)n=100*c;$("#set_up_charge").val(n)}),$("#image_1").change(function(e){document.getElementById("image_view_1").src=URL.createObjectURL(e.target.files[0])}),$("#image_2").change(function(e){document.getElementById("image_view_2").src=URL.createObjectURL(e.target.files[0])}),$("#image_3").change(function(e){document.getElementById("image_view_3").src=URL.createObjectURL(e.target.files[0])}),$("#image_4").change(function(e){document.getElementById("image_view_4").src=URL.createObjectURL(e.target.files[0])}),$("#store_logo").change(function(e){document.getElementById("store_logo_view").src=URL.createObjectURL(e.target.files[0])});
    $("#category_image").change(function(e){document.getElementById("category_image_view").src=URL.createObjectURL(e.target.files[0])});
</script>
   
  

