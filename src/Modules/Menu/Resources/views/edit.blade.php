@extends('admin::layouts.app')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Редактировать menu</h3>
        </div>
        @include($module->alias.'::form',compact('model'))
    </div>
@endsection

