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
                {{ Form::open(array('url' => '/admin/'.$module->alias.'/'.$menu->id.'/items/'.$model->id,'method'=> 'PUT', 'name'=>'update-superUser', 'files' => true))}}
            @else
                {{ Form::open(array('url' => '/admin/'.$module->alias.'/'.$menu->id.'/items','method'=> 'POST', 'name'=>'post-superUser','files' => true))}}
            @endif

            <div class="form-group{{ $errors->has('title_ru') ? ' has-error' : '' }}">
                <div class="row">
                    <label for="name" class="col-md-4 control-label">title ru</label>

                    <div class="col-md-6">
                        {{Form::text('title_ru', $model->title_ru, ['class' => 'form-control', 'placeholder' => 'title ru'])}}

                        @if ($errors->has('title_ru'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('title_ru') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>

                <div class="form-group{{ $errors->has('title_en') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-4 control-label">title en</label>

                        <div class="col-md-6">
                            {{Form::text('title_en', $model->title_en, ['class' => 'form-control', 'placeholder' => 'title en'])}}

                            @if ($errors->has('title_en'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('title_en') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-4 control-label">url</label>

                        <div class="col-md-6">
                            {{Form::text('url', $model->url, ['class' => 'form-control', 'placeholder' => 'url'])}}

                            @if ($errors->has('url'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="icon" class="col-md-4 control-label">icon</label>

                        <div class="col-md-6">
                            {{Form::text('icon', $model->icon, ['class' => 'form-control', 'placeholder' => 'icon'])}}

                            @if ($errors->has('icon'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('icon') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="icon" class="col-md-4 control-label">parent_id</label>

                        <div class="col-md-6">
                            {{Form::select('parent_id', $model->parents($menu->id), $model->parent_id, ['class' => 'form-control', 'placeholder' => 'parent_id'])}}

                            @if ($errors->has('parent_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('parent_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="icon" class="col-md-4 control-label">position</label>

                        <div class="col-md-6">
                            {{Form::number('position', $model->position, ['class' => 'form-control', 'placeholder' => 'position'])}}

                            @if ($errors->has('position'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
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


        </div>
        {{ Form::close() }}

    </div>
</div>
