@extends($layoutPath)
@section('title_page')Modules @endsection
@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-cog"></i>

                <h3 class="box-title">{{trans('lora::base.settings')}} {{$model->name}}</h3>
            </div>
            <div class="box-body">
                @if($model->exists)
                    <form method="put" action="{{route('modules.update', $model->id)}}" enctype="multipart/form-data">
                    @method('put')
                @else
                    <form method="post" action="{{route('modules')}}" enctype="multipart/form-data">
                    @method('post')
                @endif

                <div class="form-group{{ $errors->has('menu_active') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="menu_active" class="col-md-4 control-label">{{trans('lora::base.show_in_menu')}}</label>

                        <div class="col-md-6">
                            <input type="checkbox" name="menu_active" id="menu_active" value="{{$model->menu_active}}">

                            @if ($errors->has('menu_active'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('menu_active') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

                <br>
                @if($model->exists)
                    <button type="submit" class="btn btn-primary">Обновить</button>
                @else
                    <button type="submit" class="btn btn-primary">Добавить</button>
                @endif

                <a class="btn btn-info" href="{{url()->previous()}}">{{trans('admin::base.back')}}</a>

            </div>
            </form>


        </div>
        <!-- /.box -->
    </div>
@endsection
