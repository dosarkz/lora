@extends('admin::layouts.app')

@section('content')
    <div class="box box-primary">

        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <td>{{trans('admin::base.title')}}:</td>
                    <td>{{$model->title}}</td>
                </tr>

                <tr>
                    <td>{{trans('admin::base.photo')}}:</td>
                    <td><img src="{{url($model->image ? $model->image->getThumb() : "")}}" alt=""></td>
                </tr>

                <tr>
                    <td>{{trans('admin::base.date')}}:</td>
                    <td>{!!$model->created_at !!}</td>
                </tr>

                <tr>
                    <td>{{trans('admin::base.short_description')}}:</td>
                    <td>{!!  $model->short_description!!}</td>
                </tr>

                <tr>
                    <td>{{trans('admin::base.description')}}:</td>
                    <td>{!!$model->description !!}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection