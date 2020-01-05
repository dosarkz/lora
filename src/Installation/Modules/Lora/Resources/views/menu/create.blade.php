@extends('lora::layouts.app')
@section('title')
    {{trans('lora::base.add')}}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('lora::base.create')}} Menu</h3>
        </div>
        <div class="box-body">
            @include('lora::menu.form',compact('model'))
        </div>

    </div>

@endsection
