<div class="modal" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Подтверждение удаления</h4>
            </div>
            <div class="modal-body">
                <p>Вы деиствительно хотели удалить?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Удалить</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Отмена</button>
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