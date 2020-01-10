@extends($layoutPath)
@section('title') Пользователи системы @endsection
@section('content')
            <div class="card card-default">
                <div class="card-header">
                    <div class="form-group float-right">
                        <a class="btn btn-primary" href="{{route('lora.accounts.create')}}">{{trans('lora::base.create')}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-inverse">
                        <tr>
                            <th>{{trans('lora::base.id')}}</th>
                            <th>{{trans('lora::base.name')}}</th>
                            <th>{{trans('lora::base.email')}}</th>
                            <th>{{trans('lora::base.status')}}</th>
                            <th>{{trans('lora::base.actions')}}</th>
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
                                        <a class="btn btn-sm btn-primary" href="{{route('lora.accounts.edit', $item->id)}}">
                                            <i class="fas fa-edit" aria-hidden="true"></i></a>

                                        @if($item->currentUser($item->id))
                                            <button class="btn btn-sm btn-danger delete" type="button"
                                               data-target="#confirm"
                                               data-toggle="modal" data-action="{{route('lora.accounts.destroy', $item->id)}}">
                                                <i class="fas fa-times" aria-hidden="true"></i></button>
                                        @endif
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
