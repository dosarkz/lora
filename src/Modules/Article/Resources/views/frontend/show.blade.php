@extends('admin::layouts.app')

@section('content')
    <div class="box box-primary">

        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <td>Название:</td>
                    <td>{{$model->title}}</td>
                </tr>

                <tr>
                    <td>Фото:</td>
                    <td><img src="{{url($model->image ? $model->image->getThumb() : '')}}" alt=""></td>
                </tr>

                <tr>
                    <td>Дата:</td>
                    <td>{!!$model->created_at !!}</td>
                </tr>

                <tr>
                    <td>Короткое описание:</td>
                    <td>{!!  $model->short_description!!}</td>
                </tr>

                <tr>
                    <td>Подробное описание:</td>
                    <td>{!!$model->description !!}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection