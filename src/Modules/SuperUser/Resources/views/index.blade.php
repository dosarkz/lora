@extends('admin::layouts.app')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border form-group">
            <h3 class="box-title">{{trans('superUser::crud.title_page_index')}}</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                      <a class="btn btn-primary" href="/admin/products/create">{{trans('admin::base.create')}}</a>
                  </div>
                    <table class="table">
                        <thead class="thead-inverse">
                        <tr>
                            <th>{{trans('admin::base.id')}}</th>
                            <th>{{trans('admin::base.name')}}</th>
                            <th>{{trans('admin::base.email')}}</th>
                            <th>{{trans('admin::base.roles')}}</th>
                            <th>{{trans('admin::base.status')}}</th>
                            <th>{{trans('admin::base.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($model))
                            @foreach($model as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->roles }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td><a class="btn btn-primary" href="/admin/admin-users/{{$item->id}}/edit">Редактировать</a>
                                 {{ Form::open(array('url' => '/admin/admin-users/' . $item->id, 'class' => 'pull-right')) }}
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