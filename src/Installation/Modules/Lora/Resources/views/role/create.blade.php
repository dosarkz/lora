@extends($layoutPath)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('lora::base.add')}} Roles</h3>
        </div>
            @include('lora::role.form',compact('model'))
    </div>

@endsection

