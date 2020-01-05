@extends($layoutPath)

@section('content')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">{{trans('admin::base.users')}}</a></li>
            <li class="pull-right"><a href="/admin/modules/superUser/settings" class="text-muted"><i class="fa fa-gear"></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">


                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <a class="btn btn-primary" href="/admin/superUser/create">{{trans('admin::base.create')}}</a>
                            </div>
                            <table class="table">
                                <thead class="thead-inverse">
                                <tr>
                                    <th>{{trans('admin::base.id')}}</th>
                                    <th>{{trans('admin::base.name')}}</th>
                                    <th>{{trans('admin::base.email')}}</th>
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
                                            <td>{{ $item->status }}</td>
                                            <td>

                                                <a class="btn btn-xs btn-primary" href="/admin/superUser/{{$item->id}}/edit">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                {{ Form::open(array('url' => '/admin/superUser/' . $item->id, 'style' => 'display:inline;')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}

                                                <button class="btn btn-xs btn-danger delete" type="button"
                                                        data-target="#confirm"  data-toggle="modal" data-user_id="{{$item->id}}"><i class="fa fa-times" aria-hidden="true"></i></button>

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

            modal.find('#removeForm').attr('action','/admin/superUser/' + button.data('user_id'))
        })
    </script>
    @endsection
