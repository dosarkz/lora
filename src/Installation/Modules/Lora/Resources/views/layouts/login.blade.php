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
<body class="hold-transition login-page">

<section class="content">
    @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}</em></div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-warning"><span class="glyphicon glyphicon-error"></span><em> {!! session('error') !!}</em></div>
    @endif

    @yield('content')

</section>
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
