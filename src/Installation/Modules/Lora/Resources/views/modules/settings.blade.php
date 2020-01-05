@extends('admin::layouts.app')
@section('title_page')Modules @endsection
@section('content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <i class="fa fa-cog"></i>

                <h3 class="box-title">{{trans('admin::base.settings')}} {{$model->name}}</h3>
            </div>
            <div class="box-body">
                @if($model->exists)
                    {{ Form::open(array('url' => '/admin/modules/'.$model->id,'method'=> 'PUT', 'name'=>'update-modules', 'files' => true))}}
                @else
                    {{ Form::open(array('url' => '/admin/modules','method'=> 'POST', 'name'=>'post-modules','files' => true))}}
                @endif

                <div class="form-group{{ $errors->has('menu_active') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="menu_active" class="col-md-4 control-label">{{trans('admin::base.show_in_menu')}}</label>

                        <div class="col-md-6">
                            {{Form::checkbox('menu_active',null, $model->menu_active, ['id' => 'menu_active'])}}

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
                    {{ Form::submit('Обновить', ['class' => 'btn btn-primary']) }}
                @else
                    {{ Form::submit('Добавить', ['class' => 'btn btn-primary']) }}
                @endif

                <a class="btn btn-info" href="{{url()->previous()}}">{{trans('admin::base.back')}}</a>

            </div>
            {{ Form::close() }}


        </div>
        <!-- /.box -->
    </div>
    </div>




@endsection