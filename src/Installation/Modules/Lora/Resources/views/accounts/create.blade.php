@extends($layoutPath)
@section('title')
    Добавить администратора
@endsection
@section('content')
    <div class="card card-default">
        <div class="card-body">
            @include('lora::accounts.form',compact('model'))
        </div>
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
