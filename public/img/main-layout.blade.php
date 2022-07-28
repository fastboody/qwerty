<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
    <!-- Подключаем API -->
    <!-- Подробнее https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/load-docpage/ -->
    <!-- Стили -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  @yield('styles_page')
   <!--  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/reset.css') }}" />-->
  	<link rel="icon" href="{{ asset('img/3_1_1_1.ico') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  	<script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-1.11.2.min.js') }}"></script>
   	<script src="{{ asset('https://yastatic.net/share2/share.js')}}"></script>
    <title>@yield('title')</title>
</head>
<body class="landing is-preload">
  <a href="#" class="scrollup">Наверх</a>
<script type="text/javascript">
$(document).ready(function(){
 
$(window).scroll(function(){
if ($(this).scrollTop() > 100) {
$('.scrollup').fadeIn();
} else {
$('.scrollup').fadeOut();
}
});
 
$('.scrollup').click(function(){
$("html, body").animate({ scrollTop: 0 }, 600);
return false;
});
 
});
</script>
<!-- banned -->
@role('banned')
<script src="{{ asset('assets/js/modal.js') }}"></script>
<script>
    (function () {
        // создаём модальное окно
        var modal = $modal();
        // при клике по кнопке #show-modal

        // отобразим модальное окно
        modal.show();

    })();
</script>
@endrole
<!-- Header -->
<header id="header" class="header" @role('banned')style="visibility: hidden"@endrole>
    <img href="{{ asset('/') }}" src="{{ asset('img/3_1_1_1.png') }}" class="logo_header" >
    <h1><a href="/">Корпус За Чистые Выборы</a></h1>
    <nav id="nav">
        <ul>
            <li class="special">
                <a href="#menu" class="menuToggle"><span style="font-size: 3em;">≡</span></a>

                <div id="menu">
                    <ul>
                        <li><a href="{{ asset('/aboutus') }}">О нас</a></li>
                        <li><a href="{{ asset('/') }}">Новости</a></li>
                        <li><a href="{{ asset('/team') }}">Наша команда</a></li>
                        <li><a href="{{ asset('/doc') }}">Документы и материалы</a></li>
                        <li><a href="{{ asset('/video') }}">Видеоролики</a></li>
                      	<li><a href="{{ asset('/map') }}">Карта сообщений</a></li>
                        <li><a href="{{ asset('/faq') }}">Вопросы и ответы</a></li>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Зарегистрироваться') }}</a>
                                </li>
                            @endif
                        @else
                      		@role('user')
                            	<li>
                                  	<a href="/my_map_message/{{ Auth::user()->id }}">Мои сообщения</a>
                      			</li>
                            @endrole
                            @role('admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ asset('/admin') }}">{{ __('Администрирование') }}</a>
                                </li>
                      			<li>
                                 	 <a href="/my_map_message/{{ Auth::user()->id }}">Мои сообщения</a>
                      			</li>
                            @endrole
                            @role('expert')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('/expert') }}">{{ __('Сообщения') }}</a>
                            </li>
                      		<li class="nav-item">
                              	<a href="/my_map_message/{{ Auth::user()->id }}">Мои сообщения</a>
                            </li>
                            @endrole
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest

                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</header>
@yield('content')
<footer id="footer">
  <div>
    <div class="qwerty">Данный сайт носит информационно-аналитический характер <a href="https://www.youtube.com/watch?v=zIPq-dCuSrY">©</a></div>
    <div class="qwerty">E-mail: kzchv-volbi@yandex.ru</div>
  </div>
</footer>
<!-- Скрипты -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/jquery.scrollex.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrolly.min.js') }}"></script>
<script src="{{ asset('assets/js/browser.min.js') }}"></script>
<script src="{{ asset('assets/js/breakpoints.min.js') }}"></script>
<script src="{{ asset('assets/js/util.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/politics.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@yield('scripts_page')
