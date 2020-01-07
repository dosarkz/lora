@extends($layoutPath)

@section('content')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">{{trans('lora::base.menu')}}</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <a class="btn btn-primary" href="{{route('lora.menus.create')}}">{{trans('lora::base.create')}}</a>
                            </div>
                            <table class="table">
                                <thead class="thead-inverse">
                                <tr>
                                    <th>{{trans('lora::base.id')}}</th>
                                    <th>{{trans('lora::base.name')}}</th>
                                    <th>{{trans('lora::base.items')}}</th>
                                    <th>{{trans('lora::base.status')}}</th>
                                    <th>{{trans('lora::base.actions')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($models))
                                    @foreach($models as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><a href="{{route('lora.menus.items.index',$item->id)}}">{{$item->menuItems->count()}}</a></td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <a class="btn btn-xs btn-primary"  href="{{route('lora.menus.edit', $item->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <form action="{{route('lora.menus.destroy', $item->id)}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-xs btn-danger delete" data-target="#confirm"
                                                            data-toggle="modal" data-action="/admin/menu/{{$item->id}}"
                                                            type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
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
                                {{ $models->links() }}
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
