@extends('admin::layouts.app')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Редактировать офис</h3>
        </div>
        <div class="box-body">
            @include($module->alias.'::backend.form',compact('model'))
        </div>
    </div>

    @include('admin::modals.remove_image_modal')
@endsection



@section('js-append')
    <script>
        $(document).ready(function() {

            $('#remove-image').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#removeImageForm').attr('action', button.data('action'))
            });


        });
    </script>
@endsection


