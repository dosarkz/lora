@extends($layoutPath)
@section('title')
    {{trans('lora::base.add')}} меню
@endsection
@section('content')
  <div class="card card-default">
      @include('lora::menu.form',compact('model'))
  </div>
@endsection
