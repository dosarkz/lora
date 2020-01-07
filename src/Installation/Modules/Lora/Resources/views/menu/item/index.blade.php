@extends($layoutPath)
@section('title') Элементы меню @endsection
@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="form-group">
                <a class="btn btn-primary" href="{{route('lora.menus.items.create', $menu->id)}}">{{trans('lora::base.create')}}</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-inverse">
                <tr>
                    <th>{{trans('lora::base.id')}}</th>
                    <th>{{trans('lora::base.title')}}</th>
                    <th>{{trans('lora::base.url')}}</th>
                    <th>{{trans('lora::base.status')}}</th>
                    <th>{{trans('lora::base.actions')}}</th>
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
                                   href="{{route('lora.menus.items.edit',[$item->menu_id, $item->id])}}">Редактировать</a>

                            </td>

                        </tr>

                    @endforeach
                @endif


                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-10">
        <div class="form-group">
            {{ $model->links() }}
        </div>
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
