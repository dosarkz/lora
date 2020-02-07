<div class="modal" id="confirm">
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
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">{{trans('lora::base.delete')}}</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">{{trans('lora::base.no_i_accidentally')}}</button>
            </div>
        </div>
    </div>
</div>

@section('js-append')
<script>
    jQuery(document).ready(function () {
        $('form.form-delete').on('click', function(e){
            e.preventDefault();
            var $form=$(this);
            $('#confirm').modal({ backdrop: 'static', keyboard: false })
                .on('click', '#delete-btn', function(){
                    $form.submit();
                });
        });
    });
</script>
@endsection
