@extends($layoutPath)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin::base.edit')}} {{ucfirst($module->name)}}</h3>
        </div>
        @include('superUser::form',compact('model'))
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
