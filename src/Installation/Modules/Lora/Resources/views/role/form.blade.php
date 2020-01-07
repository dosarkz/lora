<div class="card-header d-flex p-0">
    <ul class="nav nav-pills ml-auto p-2" role="tablist">
        <li role="presentation" class="nav-item">
            <a class="nav-link" href="#en" aria-controls="en" role="tab"
                                                  data-toggle="tab">{{trans('lora::base.in_english')}}</a></li>
        <li role="presentation" class="nav-item"><a href="#ru" aria-controls="ru" role="tab" class="nav-link"
                                   data-toggle="tab">{{trans('lora::base.in_russian')}}</a></li>
    </ul>
</div>
@if($model->exists)
    <form action="{{route('lora.roles.update', $model->id)}}" id="" method="POST" enctype="multipart/form-data">
        @method('put')
        @else
            <form action="{{route('lora.roles.store', $model->id)}}" id="" method="POST" enctype="multipart/form-data">
                @endif
                @csrf

                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane  active" id="en">
                            <br>
                            <div class="form-group{{ $errors->has('name_en') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="name_en"
                                           class="col-md-4 control-label">{{trans('lora::base.title')}}</label>

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


                            <div class="form-group{{ $errors->has('alias') ? ' has-error' : '' }}">
                                <div class="row">
                                    <label for="alias"
                                           class="col-md-4 control-label">{{trans('lora::base.alias')}}</label>

                                    <div class="col-md-6">
                                        <input type="text" id="alias" name="alias" value="{{$model->alias}}"
                                               class="form-control">

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
                                    <label for="name_ru"
                                           class="col-md-4 control-label">{{trans('lora::base.title')}}</label>

                                    <div class="col-md-6">
                                        <input type="text" id="name_ru" name="name_ru" value="{{$model->name_ru}}"
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
                    </div>

                    <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                        <div class="row">
                            <label for="status_id" class="col-md-4 control-label">{{trans('lora::base.status')}}</label>

                            <div class="col-md-6">

                                <select name="status_id" id="status_id" class="form-control">
                                    @foreach($model->statuses as  $i => $status)
                                        <option value="{{$i}}">{{$status}}</option>
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
                </div>

                <div class="card-footer">
                    <div class="form-group">
                        @if($model->exists)
                            <button type="submit" class="btn btn-primary">{{trans('lora::base.update')}}</button>
                        @else
                            <button type="submit" class="btn btn-primary">{{trans('lora::base.create')}}</button>
                        @endif
                    </div>
                </div>
            </form>
