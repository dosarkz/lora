<div class="modal fade" id="remove-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('admin::base.confirmation_of_deletion')}}</h4>
            </div>
            <div class="modal-body">
                <p>{{trans('admin::base.would_you_like_sure_delete_this')}}?</p>
            </div>

            <div class="modal-footer">
                {{ Form::open(array('url' => '', 'id' => 'removeImageForm', 'name'=>'removeSlideImage'))}}
                {{ Form::hidden('_method', 'DELETE') }}

                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('admin::base.no_i_accidentally')}}</button>
                <button type="submit" class="btn btn-primary">{{trans('admin::base.delete')}}</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>