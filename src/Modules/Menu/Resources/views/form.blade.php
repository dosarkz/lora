<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if($model->exists)
                {{ Form::open(array('url' => '/admin/'.$module->alias.'/'.$model->id,'method'=> 'PUT', 'name'=>'update-superUser', 'files' => true))}}
            @else
                {{ Form::open(array('url' => '/admin/'.$module->alias,'method'=> 'POST', 'name'=>'post-superUser','files' => true))}}
            @endif

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="row">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        {{Form::text('name', $model->name, ['class' => 'form-control', 'placeholder' => 'name'])}}

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>

                <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-4 control-label">Type</label>

                        <div class="col-md-6">
                            {{Form::select('type_id', $model->types, $model->type_id, ['class' => 'form-control',
                             'placeholder' => 'Select a type'])}}

                            @if ($errors->has('type_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="form-group{{ $errors->has('module_id') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-4 control-label">Module</label>

                        <div class="col-md-6">
                            {{Form::select('module_id', $model->modules, $model->module_id, ['class' => 'form-control',
                             'placeholder' => 'Select the module'])}}

                            @if ($errors->has('type_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-4 control-label">Status</label>

                        <div class="col-md-6">
                            {{Form::select('status_id', $model->statuses, $model->status_id, ['class' => 'form-control',
                             'placeholder' => 'Select the status'])}}

                            @if ($errors->has('status_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('status_id') }}</strong>
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
</div>
