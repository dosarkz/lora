<div class="modal fade" id="confirm">
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
                {{ Form::open(array('url' => '', 'id' => 'removeForm', 'name'=>'removeForm'))}}
                {{ Form::hidden('_method', 'DELETE') }}

                <button type="button" class="btn btn-default" data-dismiss="modal">Нет, я случайно</button>
                <button type="submit" class="btn btn-primary">Удалить</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>