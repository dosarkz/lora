<div class="modal fade" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">{{trans('admin::base.confirmation_of_deletion')}}</h4>
            </div>
            <div class="modal-body">
                <p>{{trans('admin::base.would_you_like_sure_delete_this')}}?</p>
            </div>
            <div class="modal-footer">
                <form id="removeForm" name="removeForm">
                    @csrf
                    @method('delete')

                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('admin::base.no_i_accidentally')}}</button>
                <button type="submit" id="remove-btn" class="btn btn-primary">{{trans('admin::base.delete')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
