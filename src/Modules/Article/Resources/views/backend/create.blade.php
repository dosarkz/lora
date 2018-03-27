@extends('admin::layouts.app')
@section('content')
    <div class="box box-body">
        <div class="box-header with-border">
            <h3 class="box-title">Добавить страницу</h3>
        </div>

        @include("{$viewPath}.form")
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/vendor/admin/datepicker/datepicker3.css">
@endsection

@section('js')
    <script src="/vendor/admin/ckeditor/ckeditor.js"></script>
@endsection
@section('js-append')
    <script src="/vendor/admin/datepicker/bootstrap-datepicker.js"></script>
    <script src="/vendor/admin/datepicker/locales/bootstrap-datepicker.ru.js"></script>
    <script>
        $(document).ready(function() {
            $('#datepicker').datepicker({
                isRTL: false,
                format: 'yyyy-mm-dd',
                language: 'ru',
                autoclose: true
            });
        });

        CKEDITOR.replace('description');
        CKEDITOR.replace('short_description');
    </script>
@endsection

