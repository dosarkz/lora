@extends($layoutPath)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('lora::base.edit')}} Roles</h3>
        </div>
        <div class="box-body">
            @include('lora::backend.form',compact('model'))
        </div>
    </div>
@endsection



