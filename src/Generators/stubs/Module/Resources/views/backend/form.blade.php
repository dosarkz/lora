<div class="row">
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

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <div class="row">
                <label for="name" class="col-md-4 control-label">Название</label>


                <div class="col-md-6">
                    {{Form::text('title', $model->title, ['class' => 'form-control', 'placeholder' => 'Название'])}}

                    @if ($errors->has('title'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>


            </div>
            <div class="row">

                <div class="col-md-4"></div>
                <div class="col-md-6">
                    <p>Не больше 10 символов</p>
                </div>
            </div>
        </div>


        <div class="form-group{{ $errors->has('floor') ? ' has-error' : '' }}">
            <div class="row">
                <label for="name" class="col-md-4 control-label">Этаж</label>

                <div class="col-md-6">
                    {{Form::number('floor', $model->floor,
                    ['class' => 'form-control', 'placeholder' => 'Этаж'])}}

                    @if ($errors->has('floor'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('floor') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
            <div class="row">
                <label for="name" class="col-md-4 control-label">Номер</label>

                <div class="col-md-6">
                    {{Form::number('number', $model->number,
                    ['class' => 'form-control', 'placeholder' => 'Номер'])}}

                    @if ($errors->has('number'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
            <div class="row">
                <label for="area" class="col-md-4 control-label">Площадь</label>

                <div class="col-md-6">
                    {{Form::text('area', $model->area,
                    ['class' => 'form-control', 'placeholder' => 'Площадь'])}}

                    @if ($errors->has('area'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('area') }}</strong>
                                </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('auxiliary_area') ? ' has-error' : '' }}">
            <div class="row">
                <label for="area" class="col-md-4 control-label">С учетом вспомогательной площади</label>

                <div class="col-md-6">
                    {{Form::text('auxiliary_area', $model->auxiliary_area,
                    ['class' => 'form-control', 'placeholder' => 'С учетом вспомогательной площади'])}}

                    @if ($errors->has('auxiliary_area'))
                        <span class="help-block">
                                <strong>{{ $errors->first('auxiliary_area') }}</strong>
                            </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('coefficient_auxiliary_area') ? ' has-error' : '' }}">
            <div class="row">
                <label for="coefficient_auxiliary_area" class="col-md-4 control-label">Коэффициент вспомогательной площади</label>

                <div class="col-md-6">
                    {{Form::text('coefficient_auxiliary_area', $model->coefficient_auxiliary_area,
                    ['class' => 'form-control', 'placeholder' => 'Коэффициент вспомогательной площади'])}}

                    @if ($errors->has('coefficient_auxiliary_area'))
                        <span class="help-block">
                            <strong>{{ $errors->first('coefficient_auxiliary_area') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>




            <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            <div class="row">
                <label for="file" class="col-md-4 control-label">Планировка</label>

                <div class="col-md-6">
                    {{Form::file('file',  ['class' => 'form-control'])}}

                    @if ($errors->has('file'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                    @endif


                    @if($model->exists && $model->file)
                        <div class="form-group well" id="product-id-{{$model->id}}">

                            <a   href="{{url($model->file->getFile())}}">Файл</a>

                            <button type="button" class="btn btn-warning remove-product-image"
                                    data-action="/admin/office/{{$model->id}}/remove-file"
                                    data-toggle="modal" data-target="#remove-image">
                                <span  class="glyphicon glyphicon-remove"></span> удалить
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

            <div class="form-group{{ $errors->has('images') ? ' has-error' : '' }}">
                <div class="row">
                    <label for="name" class="col-md-4 control-label">Фотографии</label>

                    <div class="col-md-6">
                        {{Form::file('images[]',  ['class' => 'form-control', 'multiple' => true])}}

                        @if ($errors->has('images'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('images') }}</strong>
                                    </span>
                        @endif

                        @if($model->exists)
                            @foreach($model->officeImages as $officeImage)
                                @if($officeImage->image)
                                    <div class="form-group well" id="office-image-{{$officeImage->id}}">
                                        <img  src="{{url($officeImage->image->getThumb())}}" alt="" width="150" height="150">

                                        <button type="button" class="btn btn-warning remove-product-images"
                                                data-action="/admin/office/{{$model->id}}/remove-images/{{$officeImage->id}}"
                                                data-toggle="modal" data-target="#remove-image">
                                            <span  class="glyphicon glyphicon-remove"></span> удалить
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <p>Не больше 10 фотографии за раз</p>
                    </div>
                </div>
            </div>


        <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
            <div class="row">
                <label for="name" class="col-md-4 control-label">Статус</label>

                <div class="col-md-6">
                    {{Form::select('status_id', $model->statuses, $model->status_id, ['class' => 'form-control',
                     'placeholder' => 'Выберите статус'])}}

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
                {{ Form::submit('Обновить', ['class' => 'btn btn-primary']) }}
            @else
                {{ Form::submit('Добавить', ['class' => 'btn btn-primary']) }}
            @endif
        </div>



        {{ Form::close() }}
    </div>
</div>
