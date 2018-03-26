@extends('admin::layouts.app')
@section('title')
    Настройки
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Настройки</h3>
        </div>

        <div class="container">

                <div class="col-md-8">

                    <div class="form-group">
                        <form class="form-horizontal" enctype="multipart/form-data"
                              role="form" method="POST" action="{{ url('/admin/settings') }}">

                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                <label class="cab-def control-label">Старый пароль</label>

                                <div class="cab-def">
                                    <input type="password" class="form-control" name="old_password" value="{{ old('old_password') }}">

                                    @if ($errors->has('old_password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="cab-def control-label">Новый пароль</label>

                                <div class="cab-def">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="cab-def control-label">Повторите новый пароль</label>
                                <div class="cab-def">
                                    <input type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label class="cab-def control-label">Аватар</label>
                                    {{Form::file('image')}}
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif




                            </div>
                            @if($image = auth()->guard('admin')->user()->image)
                                <div class="form-group well">
                                    <img  src="{{url($image->getThumb())}}" alt="" width="150" height="150">

                                    <button type="button" class="btn btn-warning remove-product-image"
                                            data-action="/admin/settings/remove-image"
                                            data-toggle="modal" data-target="#remove-image">
                                        <span  class="glyphicon glyphicon-remove"></span> удалить
                                    </button>
                                </div>
                            @endif


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
    </div>
    @include('admin::modals.remove_image_modal')
@endsection


@section('js-append')
    <script>
        $(document).ready(function() {
            $('#remove-image').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var modal = $(this);

                modal.find('#removeImageForm').attr('action', button.data('action'))
            });

        });
    </script>
@endsection