
@if($model->exists)
    {{ Form::open(array('url' => '/admin/'.$module->alias.'/'.$model->id,'method'=> 'PUT', 'name'=>'update-superUser', 'files' => true))}}
@else
    {{ Form::open(array('url' => '/admin/'.$module->alias,'method'=> 'POST', 'name'=>'post-superUser','files' => true))}}
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#en" aria-controls="en" role="tab" data-toggle="tab">{{trans('admin::base.in_english')}}</a></li>
    <li role="presentation"><a href="#ru" aria-controls="ru" role="tab" data-toggle="tab">{{trans('admin::base.in_russian')}}</a></li>
</ul>


<div class="tab-content">

    <div role="tabpanel" class="tab-pane  active" id="en">
        <br>
        <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
            <div class="row">
                <label for="name" class="col-md-4 control-label">{{trans('admin::base.name')}}</label>

                <div class="col-md-6">
                    {{Form::text('name_en', $model->name_en, ['class' => 'form-control', 'placeholder' => trans('admin::base.title')])}}

                    @if ($errors->has('name_en'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name_en') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
            <div class="row">
                <label for="name" class="col-md-4 control-label">{{trans('admin::base.type')}}</label>

                <div class="col-md-6">
                    {{Form::select('type_id', $model->types, $model->type_id, ['class' => 'form-control',
                     'placeholder' => trans('admin::base.choose')])}}

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
                <label for="name" class="col-md-4 control-label">{{trans('admin::base.module')}}</label>

                <div class="col-md-6">
                    {{Form::select('module_id', $model->modules, $model->module_id, ['class' => 'form-control',
                     'placeholder' => trans('admin::base.choose')])}}

                    @if ($errors->has('type_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('type_id') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
            <div class="row">
                <label for="icon" class="col-md-4 control-label">{{trans('admin::base.position')}}</label>

                <div class="col-md-6">
                    {{Form::number('position', $model->position, ['class' => 'form-control', 'placeholder' =>
                    trans('admin::base.position')])}}

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
                <label for="name" class="col-md-4 control-label">{{trans('admin::base.status')}}</label>

                <div class="col-md-6">
                    {{Form::select('status_id', $model->statuses, $model->status_id, ['class' => 'form-control',
                     'placeholder' => trans('admin::base.status')])}}

                    @if ($errors->has('status_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('status_id') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>


        <h3>{{trans('admin::base.visible')}}</h3>

        @foreach($roles as $role)
            <div class="form-group">
                <div class="row">
                    <label for="role-{{$role->alias}}" class="col-md-4 control-label">{{$role->name}}</label>
                    <div class="col-md-6">
                        @if(\App\Modules\Menu\Models\MenuRole::where('menu_id', $model->id)
                        ->where('role_id', $role->id)->first())
                            {{Form::checkbox('menuRole['.$role->id.']', true, true, ['id' => 'role-'.$role->alias])}}
                        @else
                            {{Form::checkbox('menuRole['.$role->id.']', false, false, ['id' => 'role-'.$role->alias])}}
                        @endif

                    </div>
                </div>
            </div>
         @endforeach




    </div>

    <div role="tabpanel" class="tab-pane" id="ru">
        <br>
        <div class="form-group{{ $errors->has('name_ru') ? ' has-error' : '' }}">
            <div class="row">
                <label for="name_ru" class="col-md-4 control-label">{{trans('admin::base.name')}}</label>

                <div class="col-md-6">
                    {{Form::text('name_ru', $model->name_ru, ['class' => 'form-control', 'placeholder' => trans('admin::base.title')])}}

                    @if ($errors->has('name_ru'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name_ru') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <br>
    @if($model->exists)
        {{ Form::submit(trans('admin::base.update'), ['class' => 'btn btn-primary']) }}
    @else
        {{ Form::submit(trans('admin::base.create'), ['class' => 'btn btn-primary']) }}
    @endif

    <a class="btn btn-info" href="{{url()->previous()}}">{{trans('admin::base.back')}}</a>

</div>

{{ Form::close() }}


