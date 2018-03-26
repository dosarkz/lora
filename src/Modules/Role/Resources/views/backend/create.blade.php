@extends('admin::layouts.app')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Добавить роль</h3>
        </div>
            @include('role::backend.form',compact('model'))
    </div>

@endsection

