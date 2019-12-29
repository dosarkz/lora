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
                {{ Form::open(array('url' => '/admin/products/'.$model->id,'method'=> 'PUT', 'name'=>'updateProduct', 'files' => true))}}
            @else
                {{ Form::open(array('url' => '/admin/products','method'=> 'POST', 'name'=>'postProduct','files' => true))}}
            @endif

            <div class="form-group">
                <label class="control-label" for="title">Название</label>
                {{Form::text('title',$model->title, ['class' => 'form-control']) }}
            </div>

            {{--<div class="form-group">--}}
            {{--<label class="control-label" for="title">Описание</label>--}}
            {{--{{Form::textarea('description',$model->description, ['class' => 'form-control']) }}--}}
            {{--</div>--}}

            <div class="form-group">
                <label class="control-label" for="preview">Фото</label>
                <input type="file" id="image_id" name="image_id">
            </div>
            @if($model->exists and $model->image)
                <img src="{{url($model->image->getThumb())}}" alt="">
                <button type="button" class="btn btn-warning remove-image"
                        data-slide_id="{{$model->id}}" data-image_id="{{$model->image->id}}"
                        data-toggle="modal" data-target="#remove-image">
                    <span  class="glyphicon glyphicon-remove"></span> удалить
                </button>
            @endif


            {{--<div class="form-group">--}}
            {{--<label class="control-label" for="title">Фотографии</label>--}}
            {{--{{Form::file('images[]', ['multiple'=>true,--}}
            {{--'class' => 'form-control', 'placeholder' => 'Не выбран']) }}--}}
            {{--</div>--}}

            {{--@if($model->exists)--}}
            {{--@if($model->images)--}}
            {{--@foreach($model->images as $image)--}}
            {{--@if($image->image)--}}
            {{--<img width="120" src="/{{$image->image->getThumb()}}" alt=""/>--}}

            {{--<button type="button" class="btn btn-warning remove-image"--}}
            {{--data-product-image-id="{{$image->id}}"--}}
            {{--data-toggle="modal" data-target="#remove-image">--}}
            {{--<span  class="glyphicon glyphicon-remove"></span> удалить--}}
            {{--</button>--}}
            {{--@endif--}}
            {{--@endforeach--}}
            {{--@endif--}}


            {{--@endif--}}

            <div class="form-group">
                <label class="control-label" for="title">Дата завершения</label>
                {{Form::text('date_end',$model->date_end, ['class' => 'form-control','id' => 'datepicker']) }}
            </div>

            <div class="well">

                <div class="form-group">
                    <label class="control-label" for="title">Цена</label>
                    {{Form::text('cost',$model->cost, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <label class="control-label" for="title">Новая цена</label>
                    {{Form::text('new_cost',$model->new_cost, ['class' => 'form-control']) }}
                </div>
            </div>

            <div class="form-group">
                <label class="control-label" for="title">Категория</label>
                {{Form::select('category_id',$categories, $model->category_id, ['class' => 'form-control','placeholder' => 'Не выбрано']) }}
            </div>

            <div class="form-group">
                <label class="control-label" for="title">Позиция</label>
                {{Form::text('position',$model->position, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label class="control-label" for="title">На главной</label>
                <br>
                @if($model->exists)
                    {{Form::checkbox('on_main', null, $model->on_main, ['data-toggle' => 'toggle', 'data-on' => 'Да',
                    'data-off' => 'Нет']) }}
                @else
                    {{Form::checkbox('on_main',null,null,['data-toggle' => 'toggle', 'data-on' => 'Да',
                    'data-off' => 'Нет']) }}
                @endif
            </div>

            <div class="form-group">
                <label class="control-label" for="title">Статус</label>
                {{Form::select('status_id', [1=> 'Активен', 0 => 'Не активен'],$model->status_id,['class'   => 'form-control', 'placeholder' => 'Не выбрано'])}}
            </div>

            <br>
            @if($model->exists)
                {{ Form::submit('Обновить', ['class' => 'btn btn-primary']) }}
            @else
                {{ Form::submit('Добавить', ['class' => 'btn btn-primary']) }}
            @endif
            <br> <br>

        </div>
        {{ Form::close() }}

    </div>
</div>

<div class="modal fade" id="remove-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Удаление фото</h4>
            </div>
            <div class="modal-body">
                Вы действительно хотите удалить фото?
            </div>
            <div class="modal-footer">
                {{ Form::open(array('url' => '/admin/products/'.$model->id.'/remove-image','method'=> 'POST', 'name'=>'removeImage'))}}
                <button type="button" class="btn btn-default" data-dismiss="modal">Нет, я случайно</button>
                <button type="submit" class="btn btn-primary">Удалить</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>