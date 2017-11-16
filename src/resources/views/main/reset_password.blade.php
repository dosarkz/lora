@extends('admin::layouts.app')
@section('title')
    Смена пароля
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Смена пароля</h3>
        </div>

        <div class="container">

                <div class="col-md-8">

                    <div class="form-group">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/reset-password') }}">

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

                            <div class="cab-btn-wrap">
                                <button type="submit" class="cab-btn">Сменить пароль</button>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
    </div>

@endsection