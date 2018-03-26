<div class="box-body">
    <div class="col-md-12">
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
            {{ Form::open(array('url' => '/admin/'.$module->alias.'/'.$model->id,'method'=> 'PUT', 'name'=>'update-office', 'files' => true))}}
        @else
            {{ Form::open(array('url' => '/admin/'.$module->alias,'method'=> 'POST', 'name'=>'post-office','files' => true))}}
        @endif

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="row">
                    <label for="name" class="col-md-4 control-label">Название</label>

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


            <div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
                <div class="row">
                    <label for="name" class="col-md-4 control-label">Алиас</label>

                    <div class="col-md-6">
                        {{Form::text('alias', $model->alias, ['class' => 'form-control', 'placeholder' => 'alias'])}}

                        @if ($errors->has('alias'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('alias') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>



        <br>

        <div class="form-group">
            @if($model->exists)
                {{ Form::submit('Обновить', ['class' => 'btn btn-primary']) }}
            @else
                {{ Form::submit('Добавить', ['class' => 'btn btn-primary']) }}
            @endif
        </div>



        {{ Form::close() }}
    </div>
</div>