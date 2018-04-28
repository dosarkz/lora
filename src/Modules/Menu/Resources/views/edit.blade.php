@extends('admin::layouts.app')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin::base.edit')}} {{ucfirst($module->name)}}</h3>
        </div>
        <div class="box-body">
            @include($module->alias.'::form',compact('model'))
        </div>
    </div>
@endsection

