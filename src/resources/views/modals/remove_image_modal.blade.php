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
                {{ Form::open(array('url' => '', 'id' => 'removeImageForm', 'name'=>'removeSlideImage'))}}
                {{ Form::hidden('_method', 'DELETE') }}

                <button type="button" class="btn btn-default" data-dismiss="modal">Нет, я случайно</button>
                <button type="submit" class="btn btn-primary">Удалить</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>