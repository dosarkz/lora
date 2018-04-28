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
            {{ Form::open(array('url' => sprintf('/%s/%s',$url, $model->id),'method'=> 'PUT', 'name'=>'update-article', 'files' => true))}}
        @else
            {{ Form::open(array('url' => sprintf('/%s',$url),'method'=> 'POST', 'name'=>'create-article', 'files' => true))}}
        @endif


        <div class="box-body">
            <div class="form-group">
                <label class="control-label" for="title">{{trans('admin::base.title')}}</label>
                {{Form::text('title',$model->title, ['class' => 'form-control','onKeyUp' => 'translit()', 'id'  => 'title']) }}
            </div>


            <div class="form-group">
                <label class="control-label" for="title">{{trans('admin::base.date')}}</label>
                {{Form::text('created_at',$model->created_at, ['id' => 'datepicker','class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label class="control-label" for="title">{{trans('admin::base.short_description')}}</label>
                {{Form::textarea('short_description',$model->short_description, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                <label class="control-label" for="title">{{trans('admin::base.description')}}</label>
                {{Form::textarea('description',$model->description, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label class="control-label" for="preview">{{trans('admin::base.photo')}}</label>
                <input type="file" id="image_id" name="image_id">
            </div>

            @if($model->exists)
                @if($model->image)
                    <img width="120" src="/{{$model->image->getThumb()}}" alt=""/>

                    <button type="button" class="btn btn-warning remove-image"
                            data-page-id="{{$model->id}}"
                            data-toggle="modal" data-target="#remove-image">
                        <span  class="glyphicon glyphicon-remove"></span> {{trans('admin::base.delete')}}
                    </button>
                @endif
            @endif

            <div class="form-group">
                <label class="control-label" for="view_path">{{trans('admin::base.view')}}</label>
                {{Form::text('view_path',$model->view_path, ['class' => 'form-control', 'id'  => 'view_path']) }}
            </div>

            <div class="form-group">
                <label class="control-label" for="title">{{trans('admin::base.status')}}</label>
                {{Form::select('status_id', $model->statuses,$model->status_id,
                ['class'   => 'form-control' ,'placeholder' =>  trans('admin::base.choose')])}}
            </div>
            <br>

            <div class="form-group">
                @if($model->exists)
                    {{ Form::submit(trans('admin::base.update'), ['class' => 'btn btn-primary']) }}
                @else
                    {{ Form::submit(trans('admin::base.create'), ['class' => 'btn btn-primary']) }}
                @endif
            </div>

        </div>


        {{ Form::close() }}
    </div>
</div>