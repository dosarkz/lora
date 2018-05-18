<div class="box-body">
    <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#en" aria-controls="en" role="tab"
                                                      data-toggle="tab">{{trans('admin::base.in_english')}}</a></li>
            <li role="presentation"><a href="#ru" aria-controls="ru" role="tab"
                                       data-toggle="tab">{{trans('admin::base.in_russian')}}</a></li>
        </ul>


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

        <div class="tab-content">

            <div role="tabpanel" class="tab-pane  active" id="en">
                <br>
                <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-4 control-label">{{trans('admin::base.title')}}</label>

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


                <div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-4 control-label">{{trans('admin::base.alias')}}</label>

                        <div class="col-md-6">
                            {{Form::text('alias', $model->alias, ['class' => 'form-control', 'placeholder' => trans('admin::base.alias')])}}

                            @if ($errors->has('alias'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('alias') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div role="tabpanel" class="tab-pane" id="ru">
                <br>
                <div class="form-group{{ $errors->has('name_ru') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-4 control-label">{{trans('admin::base.title')}}</label>

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
        </div>

        <h3>Права доступа</h3>
        <div class="form-group well">
            <div class="row">
                <fieldset class="col-md-12">
                    <legend>Меню</legend>

                    @foreach($model->menus as $menu)
                        <div class="form-group">
                            <div class="row">
                                <label for="menu-{{$menu->alias}}" class="col-md-4 control-label">{{$menu->name}}</label>
                                <div class="col-md-6">
                                    {{Form::checkbox('menuRole[]', $menu->id,
                                    $menu->menuRole($model->id) ? true: false, ['id' => 'menu-'.$menu->alias])}}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </fieldset>

                <fieldset class="col-md-12">
                    <legend>Модули</legend>

                    @foreach($model->modules as $item)
                        <div class="form-group">
                            <div class="row">
                                <label for="module-{{$item->alias}}" class="col-md-4 control-label">{{$item->name}}</label>
                                <div class="col-md-6">
                                    {{Form::checkbox('roleModules[]', $item->id,
                                      $item->hasRoleModule($model->id) ? true: false, ['id' => 'module-'.$item->alias])}}

                                </div>
                            </div>
                        </div>
                    @endforeach

                </fieldset>


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

        <br>

        <div class="form-group">
            @if($model->exists)
                {{ Form::submit(trans('admin::base.update'), ['class' => 'btn btn-primary']) }}
            @else
                {{ Form::submit(trans('admin::base.create'), ['class' => 'btn btn-primary']) }}
            @endif
        </div>


        {{ Form::close() }}
    </div>
</div>