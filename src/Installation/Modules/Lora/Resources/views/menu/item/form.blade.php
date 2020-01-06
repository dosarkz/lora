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
                <form class="form-horizontal" method="PUT" action="{{ route('menu.items.update', [$menu->id, $model->id]) }}"
                  enctype="multipart/form-data">
                @method('put')
            @else
                <form class="form-horizontal" method="POST" action="{{ route('menu.items.store', $menu->id)}}"
                  enctype="multipart/form-data">
                @method('post')
            @endif
                @csrf

            <div class="form-group{{ $errors->has('title_ru') ? ' has-error' : '' }}">
                <div class="row">
                    <label for="title_ru" class="col-md-4 control-label">title ru</label>
                    <div class="col-md-6">
                        <input type="text" id="title_ru" name="title_ru" value="{{$model->title_ru}}" class="form-control">

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
                        <label for="title_en" class="col-md-4 control-label">title en</label>

                        <div class="col-md-6">
                            <input type="text" id="title_en" name="title_en" value="{{$model->title_en}}" class="form-control">
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
                        <label for="url" class="col-md-4 control-label">url</label>

                        <div class="col-md-6">
                            <input type="text" id="url" name="url" value="{{$model->url}}" class="form-control">

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
                            <input type="text" id="icon" name="icon" value="{{$model->icon}}" class="form-control">

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
                        <label for="parent_id" class="col-md-4 control-label">parent_id</label>

                        <div class="col-md-6">
                            <select name="parent_id" id="parent_id" class="form-control">
                                @foreach($model->parents($menu->id) as $i => $item)
                                    <option value="{{$i}}">{{$item}}</option>
                                @endforeach
                            </select>

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
                        <label for="position" class="col-md-4 control-label">position</label>

                        <div class="col-md-6">
                            <input type="number" id="position" class="form-control" value="{{$model->position}}">

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
                        <label for="status_id" class="col-md-4 control-label">Status</label>

                        <div class="col-md-6">
                            <select name="status_id" id="status_id" class="form-control">
                                @foreach($model->statuses as $i => $item)
                                    <option value="{{$i}}">{{$item}}</option>
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


            <br>
            @if($model->exists)
                <button type="submit" class="btn btn-primary">Обновить</button>
            @else
              <button type="submit" class="btn btn-primary">Добавить</button>
            @endif

                </form>
        </div>


    </div>
</div>
