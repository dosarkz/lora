@extends('lora::layouts.app')
@section('title_page') Главная @endsection
@section('title_page_description')система управления сайтом @endsection
@section('content')
    <section class="content">
        <!-- Info boxes -->


        <div class="row">

            @if(auth()->guard('admin')->user()->hasRole('admin'))
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <a href="/admin/superUser" class="info-box-text">{{trans('lora::base.count_of_superusers')}}</a>
                            <span class="info-box-number">{{$countSuperUsers}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            @endif

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                    <div class="info-box-content">
                        <a href="/admin/settings" class="info-box-text">{{trans('lora::base.settings')}}</a>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            @if(auth()->guard('admin')->user()->hasRole('admin'))
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-th-large"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{trans('lora::base.modules')}}</span>
                            <span class="info-box-number">{{$count_modules}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
        @endif
        <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <!-- /.col -->

            <!-- /.col -->
        </div>
        <!-- /.row -->


    </section>
@endsection