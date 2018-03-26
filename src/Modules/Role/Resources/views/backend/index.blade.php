@extends('admin::layouts.app')

@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Роли</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">


                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <a class="btn btn-primary" href="/admin/{{$module->alias}}/create">{{trans('admin::base.create')}}</a>
                            </div>
                            <table class="table">
                                <thead class="thead-inverse">
                                <tr>
                                    <th>{{trans('admin::base.id')}}</th>
                                    <th>{{trans('admin::base.name')}}</th>
                                    <th>Alias</th>
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
                                            <td>{{ $item->alias }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td><a class="btn btn-primary" href="/admin/{{$module->alias}}/{{$item->id}}/edit">Редактировать</a>
                                                @if($item->status_id != $item::STATUS_DEFAULT)

                                                    {{ Form::button('удалить', array('class' => 'btn btn-warning',
                                                    'data-target' => '#confirm', 'data-toggle' => 'modal', 'data-action' =>
                                                    "/admin/$module->alias/$item->id")) }}


                                                 @endif
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
        </div>
        <!-- /.tab-content -->
    </div>

    @include('admin::modals.base_modal')
@endsection



@section('js-append')
    <script>
        $(document).ready(function() {
            $('#confirm').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#removeForm').attr('action', button.data('action'))
            });

        });
    </script>
@endsection