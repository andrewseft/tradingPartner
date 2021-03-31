<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{ Html::style('css/home/bootstrap.min.css') }}
    {{ Html::style('css/home/media.css') }}
    {{ Html::style('css/home/owl.carousel.min.css') }}
    {{ Html::style('css/home/slick.css') }}
    {{ Html::style('css/home/style.css') }}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg" sizes="16x16" href="{{URL::to('img/logo.png')}}" />
    <title>Trading Partner</title>
  </head>
  <body>
    <div id="scrollUp" title="Scroll To Top"><i class="fas fa-arrow-up"></i></div>
    @include('includes.home.header')
        @yield('content')
    @include('includes.home.footer')
    {{ Html::script('js/home/jquery-3.4.1.js', ['type' => 'text/javascript']) }}
    {{ Html::script('js/home/popper.min.js', ['type' => 'text/javascript']) }}
    {{ Html::script('js/home/bootstrap.min.js', ['type' => 'text/javascript']) }}
    {{ Html::script('js/home/owl.carousel.js', ['type' => 'text/javascript']) }}
    {{ Html::script('js/home/custom.js', ['type' => 'text/javascript']) }}
  </body>
</html>