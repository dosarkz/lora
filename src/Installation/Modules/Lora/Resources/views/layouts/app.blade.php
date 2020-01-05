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
    <link href="/vendor/admin/adminlte/css/app.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/vendor/admin/adminlte/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins -->

    <link rel="stylesheet" href="/vendor/admin/adminlte/css/skins/_all-skins.min.css">


    @yield('css')

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


        <a href="/admin" class="logo">
            <span class="logo-mini">DCMS</span>
            <span class="logo-lg"><b>Lora</b>cms</span>
        </a>



        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            @if(!auth()->guard('admin')->guest())
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if(auth()->guard('admin')->user()->avatar)
                                    <img src="{{url(auth()->guard('admin')->user()->image->getThumb())}}" class="user-image" alt="User Image">
                                @else
                                    <img src="/vendor/admin/adminlte/img/sheldon_cooper.png" class="user-image" alt="User Image">
                                @endif
                                <span class="hidden-xs"> {{auth()->guard('admin')->user()->name}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">

                                    @if(auth()->guard('admin')->user()->avatar)
                                        <img src="{{url(auth()->guard('admin')->user()->image->getThumb())}}" class="img-circle" alt="User Image">
                                    @else
                                    <img src="/vendor/admin/adminlte/img/sheldon_cooper.png" class="img-circle" alt="User Image">
                                    @endif
                                    <p>
                                        <span class="hidden-xs"> {{auth()->guard('admin')->user()->name}}</span>
                                    </p>
                                </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="/admin/settings" class="btn btn-default btn-flat">{{trans('lora::base.settings')}}</a>
                                    </div>
                                    <div class="pull-right">
                                        @if (auth()->guard('admin')->guest())
                                            <a class="btn btn-default btn-flat" href="{{ route('admin.getLogin') }}">{{trans('lora::base.sign_in')}}</a>
                                        @else
                                            <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{trans('lora::base.log_out')}}</a>

                                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
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

    @if(!auth()->guard('admin')->guest())
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                @include('lora::layouts.menu.left_menu')
            </section>
            <!-- /.sidebar -->
        </aside>
    @endif

    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            @if(Session::has('success'))
                <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}</em></div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-warning"><span class="glyphicon glyphicon-error"></span><em> {!! session('error') !!}</em></div>
            @endif

            @yield('content')

        </section>
        <!-- /.content -->
    </div>


</div>
<!-- Scripts -->
<script src="/vendor/admin/jquery/jquery-3.2.1.min.js"></script>
<script src="/vendor/admin/bootstrap/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="/vendor/admin/adminlte/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/vendor/admin/adminlte/js/demo.js"></script>

@yield('js-append')
</body>
</html>
