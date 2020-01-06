<div class="modal fade" id="remove-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{trans('lora::base.confirmation_of_deletion')}}</h4>
            </div>
            <div class="modal-body">
                <p>{{trans('lora::base.would_you_like_sure_delete_this')}}?</p>
            </div>

            <div class="modal-footer">
                <form id="removeImageForm" name="removeSlideImage">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">

                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('lora::base.no_i_accidentally')}}</button>
                <button type="submit" class="btn btn-primary">{{trans('lora::base.delete')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>
