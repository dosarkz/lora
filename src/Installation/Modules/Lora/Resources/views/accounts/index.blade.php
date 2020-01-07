@extends($layoutPath)

@section('content')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">{{trans('lora::base.users')}}</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">


                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <a class="btn btn-primary" href="{{route('lora.accounts.create')}}">{{trans('lora::base.create')}}</a>
                            </div>
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

                                                <a class="btn btn-xs btn-primary" href="{{route('lora.accounts.edit', $item->id)}}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                <form action="{{route('lora.accounts.destroy', $item->id)}}">
                                                    @method('delete')

                                                <button class="btn btn-xs btn-danger delete" type="button"
                                                        data-target="#confirm"  data-toggle="modal" data-user_id="{{$item->id}}"><i class="fa fa-times" aria-hidden="true"></i></button>

                                                </form>
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

            modal.find('#removeForm').attr('action','/admin/superUser/' + button.data('user_id'))
        })
    </script>
    @endsection
