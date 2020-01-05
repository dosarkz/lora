@extends($layoutPath)
@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Пункты меню</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <a class="btn btn-primary" href="/admin/menu/{{$menu->id}}/items/create">{{trans('admin::base.create')}}</a>
                            </div>
                            <table class="table">
                                <thead class="thead-inverse">
                                <tr>
                                    <th>{{trans('admin::base.id')}}</th>
                                    <th>{{trans('admin::base.title')}}</th>
                                    <th>{{trans('admin::base.url')}}</th>
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
                                            <td>{{ $item->url }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td><a class="btn btn-primary"
                                                   href="{{route('menu.items.update',[$item->menu_id, $item->id])}}">Редактировать</a>

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

    @include('lora::modals.base_modal')
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
