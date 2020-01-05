<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lora') }}</title>

    <!-- Styles -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/vendor/admin/adminlte/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins -->

    <link rel="stylesheet" href="/vendor/admin/adminlte/css/skins/_all-skins.min.css">
    <link href="/vendor/admin/adminlte/css/app.css" rel="stylesheet">

    @yield('css')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('js')
</head>
<body >

<section class="content">
    @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}</em></div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-warning"><span class="glyphicon glyphicon-error"></span><em> {!! session('error') !!}</em></div>
    @endif

    @yield('content')

</section>
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
