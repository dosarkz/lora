<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lora') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/vendor/admin/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/vendor/admin/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/vendor/admin/adminlte/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('js')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('lora.dashboard.index')}}" class="nav-link">{{trans('lora::base.main')}}</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input name="q" class="form-control form-control-navbar" value="{{request('q')}}" type="search" placeholder="{{trans('lora::base.search')}}" aria-label="{{trans('lora::base.search')}}">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            @if(!auth()->guard('admin')->guest())
                        <li class="nav-item dropdown user-menu">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                @if(auth()->guard('admin')->user()->image)
                                    <img src="{{url(auth()->guard('admin')->user()->image->getThumb())}}" class="user-image img-circle elevation-2" alt="User Image">
                                @else
                                    <img src="/vendor/admin/adminlte/dist/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                                @endif

                                <span class="d-none d-md-inline">{{auth()->guard('admin')->user()->name}}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <!-- User image -->
                                <li class="user-header bg-primary">
                                    @if(auth()->guard('admin')->user()->image)
                                        <img src="{{url(auth()->guard('admin')->user()->image->getThumb())}}" class="img-circle elevation-2" alt="User Image">
                                    @else
                                        <img src="/vendor/admin/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                                    @endif
                                    <p>
                                        <span class="hidden-xs"> {{auth()->guard('admin')->user()->name}}</span>
                                    </p>

                                </li>

                                <li class="user-footer">
                                    <a href="{{route('lora.accounts.settings.index')}}" class="btn btn-default btn-flat">{{trans('lora::base.settings')}}</a>
                                    @if (auth()->guard('admin')->guest())
                                        <a class="btn btn-default btn-flat float-right" href="{{ route('lora.auth.show') }}">{{trans('lora::base.sign_in')}}</a>
                                    @else
                                        <a href="{{ route('lora.logout') }}" class="btn btn-default btn-flat float-right" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{trans('lora::base.log_out')}}</a>

                                        <form id="logout-form" action="{{ route('lora.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    @endif
                                </li>

                            </ul>
                        </li>
            @endif
        </ul>
    </nav>

    @if(!auth()->guard('admin')->guest())
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('lora.dashboard.index')}}" class="brand-link">
                <span class="brand-text font-weight-light align-items-center">Lora CMS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    @include('lora::layouts.menu.left_menu')
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    @endif

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
{{--                        <ol class="breadcrumb float-sm-right">--}}
{{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                            <li class="breadcrumb-item active">Dashboard v2</li>--}}
{{--                        </ol>--}}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

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

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/vendor/admin/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/vendor/admin/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/vendor/admin/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/vendor/admin/adminlte/dist/js/adminlte.js"></script>

@yield('js-append')
</body>
</html>
