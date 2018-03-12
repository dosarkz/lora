@extends('admin::layouts.app')

@section('content')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Офисы</a></li>
            <li class="pull-right"><a href="/admin/modules/{{$module->alias}}/settings" class="text-muted"><i class="fa fa-gear"></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                @if(request()->has('type'))
                                    <a class="btn btn-primary" href="/admin/{{$module->alias}}/create?type={{request()->input('type')}}">
                                        {{trans('admin::base.create')}}</a>
                                @endif
                            </div>
                            <table class="table">
                                <thead class="thead-inverse">
                                <tr>
                                    <th>{{trans('admin::base.id')}}</th>
                                    <th>Название</th>
                                    <th>Дата</th>
                                    <th>Фото</th>
                                    <th>{{trans('admin::base.status')}}</th>
                                    <th>{{trans('admin::base.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($model))
                                    @foreach($model as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->created_at}}</td>
                                            <td>@if($item->officeImages) <img width="150" src="{{url($item->officeImages->first() ?
                                            $item->officeImages->first()->image->getThumb(): "")}}" alt="">@endif</td>
                                            <td>{{ $item->status }}</td>
                                            <td><a class="btn btn-primary" href="/admin/{{$module->alias}}/{{$item->id}}/edit">Редактировать</a>
                                                {{ Form::open(array('url' => '/admin/'.$module->alias.'/' . $item->id, 'class' => 'pull-right')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::button('удалить', array('class' => 'btn btn-warning',
                                                'data-target' => '#confirm', 'data-toggle' => 'modal', 'data-action' => '/admin/'.$module->alias.'/' . $item->id)) }}
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
        <!-- /.tab-content -->
    </div>

    @include('admin::modals.base_modal')
@endsection

@section('js-append')

    <script>

        $('form.form-delete').on('click', function(e){
            e.preventDefault();
            var $form=$(this);
            $('#confirm').modal({ backdrop: 'static', keyboard: false })
                    .on('click', '#delete-btn', function(){
                        $form.submit();
                    });
        });

        $('#confirm').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            modal.find('#removeForm').attr('action', button.data('action'))
        })
    </script>
@endsection