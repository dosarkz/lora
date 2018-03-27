@extends('admin::layouts.app')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Список страниц</h3>
        </div>
        @include('admin::modals.modal')
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-inverse">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Публичная ссылка</th>
                        <th>Статус</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->title }}</td>
                            <td>
                                @if($model->status_id == 1)
                                    <a href="/article/{{$model->url}}">{{$model->url}}</a>
                                @else
                                    <p >Ссылка будет доступна только при статусe <span class="label label-primary">активен</span></p>
                                @endif
                            </td>
                            <td>{{ $model->status }}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="/{{$url}}/{{ $model->id }}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                {{ Form::open(array('url' => '/'.$url.'/' . $model->id, 'class' => 'form-delete', 'style' => 'display:inline;')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <button class="btn btn-xs btn-danger delete" type="submit"><i class="fa fa-times" aria-hidden="true"></i></button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $models->links() }}
            </div>
        </div>
    </div>
@endsection