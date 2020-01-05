@extends($layoutPath)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans('admin::base.add')}} {{ucfirst($module->name)}}</h3>
        </div>
            @include('role::role.form',compact('model'))
    </div>

@endsection
