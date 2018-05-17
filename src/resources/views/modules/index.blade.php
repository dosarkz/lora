@extends('admin::layouts.app')
@section('title_page')Modules @endsection
@section('content')
    <div class="row">
        @foreach($modules as $module)
            <div class="col-md-4 col-sm-6 col-xs-12 box">

                <div class="box-header with-border">
                    <h3 class="box-title"><a href="/admin/{{$module->alias}}">{{$module->name}}</a></h3>

                    @if($module->status_id == $module::STATUS_DISABLE)
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-module-id="{{$module->id}}"
                                    data-target="#confirm" data-toggle="modal"><i class="fa fa-times"></i></button>
                        </div>
                    @endif
                </div>

                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-th-large"></i></span>

                    <div class="info-box-content">
                        <a href="/admin/modules/{{$module->alias}}/settings">{{__('admin::base.settings')}}</a>
                        <span class="info-box-number"></span>
                    </div>
                    <!-- /.info-box-content -->

                </div>
                <!-- /.info-box -->
            </div>
        @endforeach

    </div>


    @include('admin::modals.base_modal')
@endsection


@section('js-append')

    <script>

        $('#confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            modal.find('#removeForm').attr('action', '/admin/modules/' + button.data('module-id'))
        })
    </script>
@endsection