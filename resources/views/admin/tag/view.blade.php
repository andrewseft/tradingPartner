<div class="form-group pt-3">
    @if(Helper::exists(Constant::BANNER_IMAGE_THUMB.$banner->image) && $banner->image != NULL)
        {!! Html::image(Helper::getImageUrl(Constant::BANNER_IMAGE_THUMB.$banner->image),'user',['class'=>''])  !!}
    @else
        {!! Html::image('img/photo.svg','user',['class'=>'','width'=>'50px'])  !!}
    @endif
</div>