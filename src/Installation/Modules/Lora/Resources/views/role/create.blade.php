@extends($layoutPath)
@section('title') {{trans('lora::base.add')}} роль @endsection
@section('content')
    <div class="card card-default">
            @include('lora::role.form',compact('model'))
    </div>
@endsection

