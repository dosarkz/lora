<div class="modal fade" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{trans('lora::base.confirmation_of_deletion')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{trans('lora::base.would_you_like_sure_delete_this')}}?</p>
            </div>
            <div class="modal-footer">
                <form id="removeForm" name="removeForm" method="post">
                    @csrf
                    @method('delete')

                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('lora::base.no_i_accidentally')}}</button>
                <button type="submit" id="remove-btn" class="btn btn-primary">{{trans('lora::base.delete')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
