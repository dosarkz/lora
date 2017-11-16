@extends('admin::layouts.app')
@section('title_page')Modules @endsection
@section('content')
    <div class="row">
        @foreach($modules as $module)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                    <div class="info-box-content">
                        <a href="/admin/{{$module->alias}}" class="info-box-text">{{$module->name}}</a>
                        <span class="info-box-number">-</span>

                        <span>{{trans('admin::base.status')}}: {{$module->status}} </span>
                    </div>
                    <!-- /.info-box-content -->

                </div>
                <!-- /.info-box -->
            </div>
        @endforeach

    </div>
@endsection