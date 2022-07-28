<!doctype html>
<html lang="en" class="light-theme">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/admin/assets/images/3.png') }}" type="image/png" />
    <link href="{{ asset('assets/admin/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('assets/admin/assets/css/pace.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/assets/css/header-colors.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <title>КЗЧВ - @yield('title')</title>
</head>
<body>
<div class="wrapper">
    <header class="top-header">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-icon fs-3">
                <i class="bi bi-list"></i>
            </div>
            <div class="top-navbar-right ms-auto">
                <ul class="navbar-nav align-items-center">

                    <li class="nav-item dropdown dropdown-user-setting">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                            <div class="user-setting d-flex align-items-center">
                                <img src="https://i.ibb.co/dD3gpVM/thumb.jpg" class="user-img" alt="">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">


                            <li>
                                <a class="dropdown-item" href="{{ route('index') }}">
                                    <div class="d-flex align-items-center">
                                        <div class=""><i class="bi bi-globe"></i></div>
                                        <div class="ms-3"><span>Вернуться на сайт</span></div>
                                    </div>
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <div class="d-flex align-items-center">
                                        <div class=""><i class="bi bi-lock-fill"></i></div>
                                        <div class="ms-3"><span>Выйти</span></div>
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!--end top header-->

    <!--start sidebar -->
    <aside class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <img src="{{ asset('assets/admin/assets/images/3.png') }}" class="logo-icon" alt="logo icon">
            </div>
            <div>
                <h4 class="logo-text">{{ __('КЗЧВ') }}</h4>
            </div>
            <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
            </div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-fill"></i>
                    </div>
                    <div class="menu-title">{{ __('Панель администратора') }}</div>
                </a>
                <ul>
                    <li> <a href="assign_role"><i class="bi bi-person-plus"></i>{{ __('Выдача ролей') }}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                    </div>
                    <div class="menu-title">{{ __('Разделы') }}</div>
                </a>
                <ul>
                    <li> <a href="add_tiding"><i class="bi bi-newspaper"></i>{{ __('Новости') }}</a>
                    </li>
                    <li> <a href="add_video"><i class="bi bi-file-play-fill"></i>{{ __('Видео') }}</a>
                    </li>
                    <li> <a href="add_teammate"><i class="bi bi-people-fill"></i>{{ __('Наша команда') }}</a>
                    </li>
                    <li> <a href="add_document"><i class="bi bi-file-earmark-pdf"></i>{{ __('Документы') }}</a>
                    </li>
                </ul>
            </li>
            <li class="menu-label">{{ __('Тематики') }}</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-support'></i>
                    </div>
                    <div class="menu-title">{{ __('Раздел FAQ') }}</div>
                </a>
                <ul>
                    <li> <a href="add_chapter"><i class="bi bi-layer-backward"></i>{{ __('Добавление раздела FAQ') }}</a>
                    </li>
                    <li> <a href="add_question"><i class="bi bi-layer-forward"></i>{{ __('Добавление вопроса FAQ') }}</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-chat'></i>
                    </div>
                    <div class="menu-title">{{ __('Обратная связь') }}</div>
                </a>
                <ul>
                    <li> <a href="question_expert"><i class="bi bi-telephone-inbound"></i>{{ __('Обратная связь') }}</a>
                    </li>
                    <li> <a href="sent_question_expert"><i class="bi bi-telephone-fill"></i>{{ __('Просмотр обратной связи') }}</a>
                    </li>
                </ul>
            </li>
            <li class="menu-label">{{ __('Работа с картой') }}</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-map-alt' ></i>
                    </div>
                    <div class="menu-title">{{ __('Карта сообщений') }}</div>
                </a>
                <ul>
                    <li> <a href="message_expert"><i class="bi bi-chat-dots"></i>{{ __('Ответить на сообщения') }}</a>
                    </li>
                    <li> <a href="sent_message_expert"><i class="bi bi-chat-dots-fill"></i>{{ __('Отвеченные сообщения') }}</a>
                    </li>
                    <li> <a href="add_status_message"><i class="bi bi-check2-square"></i>{{ __('Статус сообщения') }}</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!--end navigation-->
    </aside>
    <!--end sidebar -->
    <main class="page-content">
        <div class="row">
            @yield('content')
        </div>
    </main>
    <div class="overlay nav-toggle-icon"></div>
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <div class="switcher-body">

        <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <h6 class="mb-0">Theme Variation</h6>
                <hr>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme" value="option1" checked>
                    <label class="form-check-label" for="LightTheme">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme" value="option2">
                    <label class="form-check-label" for="DarkTheme">Dark</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme" value="option3">
                    <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
                </div>
                <hr>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme" value="option3">
                    <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
                </div>
                <hr/>
                <h6 class="mb-0">Header Colors</h6>
                <hr/>
                <div class="header-colors-indigators">
                    <div class="row row-cols-auto g-3">
                        <div class="col">
                            <div class="indigator headercolor1" id="headercolor1"></div>
                        </div>
                        <div class="col">
                            <div class="indigator headercolor2" id="headercolor2"></div>
                        </div>
                        <div class="col">
                            <div class="indigator headercolor3" id="headercolor3"></div>
                        </div>
                        <div class="col">
                            <div class="indigator headercolor4" id="headercolor4"></div>
                        </div>
                        <div class="col">
                            <div class="indigator headercolor5" id="headercolor5"></div>
                        </div>
                        <div class="col">
                            <div class="indigator headercolor6" id="headercolor6"></div>
                        </div>
                        <div class="col">
                            <div class="indigator headercolor7" id="headercolor7"></div>
                        </div>
                        <div class="col">
                            <div class="indigator headercolor8" id="headercolor8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('assets/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/pace.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
<script src="{{ asset('assets/admin/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/app.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/index.js') }}"></script>
<script>
    new PerfectScrollbar(".best-product")
</script>
</body>
</html>
