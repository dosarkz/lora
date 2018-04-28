@extends('admin::layouts.app')
@section('title')
    {{trans('admin::base.add')}} {{ucfirst($module->name)}}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin::base.create')}} {{ucfirst($module->name)}}</h3>
        </div>
        <div class="box-body">
            @include($module->alias.'::form',compact('model'))
        </div>

    </div>

@endsection
