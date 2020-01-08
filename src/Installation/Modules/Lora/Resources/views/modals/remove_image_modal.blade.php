<div class="modal fade" id="remove-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
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

            <div class="modal-footer justify-content-between">
                <form id="removeImageForm" name="removeSlideImage" method="post">
                    @method('delete')
                    @csrf
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('lora::base.no_i_accidentally')}}</button>
                <button type="submit" class="btn btn-danger">{{trans('lora::base.delete')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
