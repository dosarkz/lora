@extends($layoutPath)
@section('title') Редактировать элемент меню @endsection
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Редактировать элемент меню</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @include('lora::menu.item.form',compact('model'))
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="/plugins/timepicker/bootstrap-timepicker.css">
@endsection
@section('js-append')
    <script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="/plugins/datepicker/locales/bootstrap-datepicker.ru.js"></script>
    <script src="/plugins/timepicker/bootstrap-timepicker.js"></script>
    <script>
        $(document).ready(function() {
            $('#datepicker').datepicker({
                isRTL: false,
                format: 'yyyy-mm-dd',
                language: 'ru'
            });
        });
    </script>
@endsection
