@extends('admin::layouts.app')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Редактировать роль </h3>
        </div>
        <div class="box-body">
            @include($module->alias.'::backend.form',compact('model'))
        </div>
    </div>

@endsection



