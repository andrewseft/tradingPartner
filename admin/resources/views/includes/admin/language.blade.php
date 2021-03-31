@if(Helper::language()->count() && Helper::language()->count() != 1)
<div class="card">
    <ul class="nav nav-tabs" role="tablist">
        @foreach(Helper::language() as $languagekey => $language)
                @php
                    $class="";
                    $errorClass="";
                    if($languagekey == App::getLocale()){
                        $class="active";
                    }
                    if ($errors->has('translation.'.$languagekey.'.title') || $errors->has('translation.'.$languagekey.'.description')){
                        $errorClass="nav_link_error"; 
                    }
                @endphp
            <li class="nav-item">
                <a class="nav-link {{ $class }} {{$errorClass}} show" id="home-{{$languagekey}}-tab" data-toggle="tab" href="#home-{{$languagekey}}" role="tab" aria-controls="home-{{$languagekey}}" aria-selected="true">{{__(Helper::mb_strtolower($language))}}</a>
            </li>
        @endforeach
    </ul>
</div>
@endif