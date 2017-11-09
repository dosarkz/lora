@extends('admin::layouts.app')
@section('title_page')Modules @endsection
@section('content')
    <div class="row">
        @foreach($modules as $module)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{$module->getLocaleName()}}</span>
                        <span class="info-box-number">1,410</span>

                        <span>{{trans('admin::base.status')}}: {{$module->getEnabled()}} </span>
                    </div>
                    <!-- /.info-box-content -->

                </div>
                <!-- /.info-box -->
            </div>
        @endforeach

    </div>
@endsection