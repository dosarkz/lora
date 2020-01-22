@if($model->exists)
    <form class="form-horizontal" method="POST" action="{{ route('lora.menus.update', $model->id) }}"
          enctype="multipart/form-data">
        @method('put')
        @else
            <form class="form-horizontal" method="POST" action="{{ route('lora.menus.store')}}"
                  enctype="multipart/form-data">
                @method('post')
                @endif
                @csrf

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


             <div class="card-header  d-flex p-0">
                 <ul class="nav nav-pills ml-auto p-2" role="tablist">
                     <li role="presentation" class="nav-item">
                         <a class="nav-link" href="#en" aria-controls="en" role="tab"
                            data-toggle="tab">{{trans('lora::base.in_english')}}</a></li>
                     <li role="presentation" class="nav-item"><a href="#ru" aria-controls="ru" role="tab" class="nav-link"
                                                                 data-toggle="tab">{{trans('lora::base.in_russian')}}</a></li>
                 </ul>
             </div>


                <div class="card-body">
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane  active" id="en">
                            <br>
                            <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="name_en" class="col-md-4 control-label">{{trans('lora::base.name')}}</label>

                                    <div class="col-md-6">
                                        <input type="text" id="name_en" name="name_en" value="{{$model->name_en}}"
                                               class="form-control">

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
                                    <label for="type_id" class="col-md-4 control-label">{{trans('lora::base.type')}}</label>

                                    <div class="col-md-6">
                                        <select name="type_id" id="type_id" class="form-control">
                                            @foreach($model->types as $k => $type)
                                                <option value="{{$k}}">{{$type}}</option>
                                            @endforeach
                                        </select>

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
                                    <label for="module_id"
                                           class="col-md-4 control-label">{{trans('lora::base.module')}}</label>

                                    <div class="col-md-6">

                                        <select name="module_id" id="module_id" class="form-control">
                                            @foreach($model->modules as $k => $module)
                                                <option value="{{$k}}">{{$module}}</option>
                                            @endforeach
                                        </select>

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
                                    <label for="position"
                                           class="col-md-4 control-label">{{trans('lora::base.position')}}</label>

                                    <div class="col-md-6">
                                        <input type="number" name="position" id="position" value="{{$model->position}}"
                                               class="form-control">

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
                                    <label for="status_id"
                                           class="col-md-4 control-label">{{trans('lora::base.status')}}</label>

                                    <div class="col-md-6">
                                        <select name="status_id" id="status_id" class="form-control">
                                            @foreach($model->statuses as $k => $status)
                                                <option value="{{$k}}">{{$status}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('status_id'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('status_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            @foreach($roles as $role)
                                <div class="form-group">
                                    <div class="row">
                                        <label for="role-{{$role->alias}}"
                                               class="col-md-4 control-label">{{$role->name}}</label>
                                        <div class="col-md-6">
                                            @if(\Dosarkz\Lora\Installation\Modules\Lora\Models\MenuRole::where('menu_id', $model->id)
                                            ->where('role_id', $role->id)->first())
                                                <input type="checkbox" name="menuRole[{{$role->id}}]" checked="true"
                                                       id="role-{{$role->alias}}">
                                            @else
                                                <input type="checkbox" name="menuRole[{{$role->id}}]" checked="false"
                                                       id="role-{{$role->alias}}">
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
                                    <label for="name_ru"
                                           class="col-md-4 control-label">{{trans('admin::base.name')}}</label>

                                    <div class="col-md-6">
                                        <input id="name_ru" type="text" name="name_ru" value="{{$model->name_ru}}"
                                               class="form-control">

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
                            <button type="submit" class="btn btn-primary">{{trans('lora::base.update')}}</button>
                        @else
                            <button type="submit" class="btn btn-primary">{{trans('lora::base.create')}}</button>
                        @endif


                    </div>
                </div>

            </form>


