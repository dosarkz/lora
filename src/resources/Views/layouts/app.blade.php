<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/vendor/laravel-admin/adminlte/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins -->

    <link rel="stylesheet" href="/vendor/laravel-admin/adminlte/css/skins/_all-skins.min.css">

    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('js')
</head>
<body class="hold-transition skin-blue sidebar-mini">


<div class="wrapper">
    <header class="main-header">


        <div class="logo-lg">
            <a href="/"><img src="/img/logo.svg" class="logo"></a>
        </div>



        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            @if(!auth()->guest())
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ Auth::user()->avatar ? "https://api.globalpay.kz/".Auth::user()->avatar : '/adminlte/img/user2-160x160.jpg'}}" class="user-image" alt="User Image">
                                @if(Auth::user()->userRole->role->alias == 'support')
                                    <span class="hidden-xs"> Менеджер GP</span>
                                @elseif(Auth::user()->userRole->role->alias == 'owner')
                                    <span class="hidden-xs"> {{Auth::user()->phone_number ? '+'.Auth::user()->phone_number : null}}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{ Auth::user()->avatar ? "https://api.globalpay.kz/".Auth::user()->avatar : '/adminlte/img/user2-160x160.jpg'}}" class="img-circle" alt="User Image">
                                    <p>
                                        @if(Auth::user()->userRole->role->alias == 'support')
                                            <span class="hidden-xs"> Менеджер GP</span>
                                        @elseif(Auth::user()->userRole->role->alias == 'owner')
                                            <span class="hidden-xs"> {{Auth::user()->phone_number ? '+'.Auth::user()->phone_number : null}}</span>
                                        @endif
                                        <small>Зарегистрирован  {{auth()->user()->created_at}}</small>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="/profile" class="btn btn-default btn-flat" style="margin-left: 0">Профиль</a>
                                    </div>
                                    <div class="pull-right">
                                        @if (Auth::guest())
                                            <a class="btn btn-default btn-flat" href="{{ secure_url_env('/login') }}">Войти</a>
                                        @else
                                            <a href="{{ secure_url_env('/logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Выйти</a>

                                            <form id="logout-form" action="{{ secure_url_env('/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->

                    </ul>
                </div>

            @endif
        </nav>
    </header>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title_page')
                <small>@yield('title_page_description')</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')

        </section>
        <!-- /.content -->
    </div>


</div>
<!-- Scripts -->
<script src="/js/app.js"></script>

<script src="/js/main.js"></script>

<!-- AdminLTE App -->
<script src="/vendor/laravel-admin/adminlte/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/vendor/laravel-admin/adminlte/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/vendor/laravel-admin/adminlte/js/demo.js"></script>

@yield('js-append')
</body>
</html>
