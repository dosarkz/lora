@extends('layouts.main')

@section('title')
    Товары
@endsection

@section('content-header-h1')
    Товары
    <small></small>
@endsection

@section('breadcrumb')
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Главная</a></li>
    <li class="active"><a href="/admin/products">Товары</a></li>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border form-group">
            <h3 class="box-title">Товары</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                      <a class="btn btn-primary" href="/admin/products/create">Добавить</a>
                  </div>
                    <table class="table">
                        <thead class="thead-inverse">
                        <tr>
                            <th>id</th>
                            <th>Название</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($model))
                            @foreach($model as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{ $item->title }}</td>
                                    <td><a class="btn btn-primary" href="/admin/products/{{$item->id}}/edit">Редактировать</a>
                                 {{ Form::open(array('url' => '/admin/products/' . $item->id, 'class' => 'pull-right')) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::submit('удалить', array('class' => 'btn btn-warning')) }}
                                        {{ Form::close() }}

                                    </td>

                                </tr>

                            @endforeach


                        @endif


                        </tbody>
                    </table>

                </div>

                <div class="col-md-10">
                    <div class="form-group">
                        {{ $model->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection