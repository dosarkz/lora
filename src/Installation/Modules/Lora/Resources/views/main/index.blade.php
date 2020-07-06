@extends($layoutPath)
@section('title') Панель инструментов @endsection
@section('title_page_description')система управления сайтом @endsection
@section('content')
    <section class="content">
        <div class="row">
            @if(auth()->guard('admin')->user()->hasRole('admin'))
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{route('lora.accounts.index')}}" class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{trans('lora::base.count_of_superusers')}}</span>
                            <span class="info-box-number">{{$countSuperUsers}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </a>
                    <!-- /.info-box -->
                </div>
            @endif

            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{route('lora.accounts.settings.index')}}" class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{trans('lora::base.settings')}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

{{--            <div class="col-12 col-sm-6 col-md-3">--}}
{{--                <div class="info-box mb-3">--}}
{{--                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>--}}

{{--                    <div class="info-box-content">--}}
{{--                        <span class="info-box-text">{{trans('lora::base.sales')}}</span>--}}
{{--                        <span class="info-box-number">760</span>--}}
{{--                    </div>--}}
{{--                    <!-- /.info-box-content -->--}}
{{--                </div>--}}
{{--                <!-- /.info-box -->--}}
{{--            </div>--}}

            <div class="clearfix visible-sm-block"></div>
        </div>
    </section>
@endsection
