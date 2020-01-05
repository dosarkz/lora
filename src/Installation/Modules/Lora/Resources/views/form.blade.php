<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if($model->exists)
                {{ Form::open(array('url' => '/admin/superUser/'.$model->id,'method'=> 'PUT', 'name'=>'update-superUser', 'files' => true))}}
            @else
                {{ Form::open(array('url' => '/admin/superUser','method'=> 'POST', 'name'=>'post-superUser','files' => true))}}
            @endif

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="row">
                    <label for="name" class="col-md-4 control-label">{{trans('admin::base.name')}}</label>

                    <div class="col-md-6">
                        {{Form::text('name', $model->name, ['class' => 'form-control', 'placeholder' => trans('admin::base.name')])}}

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-4 control-label">{{trans('admin::base.login')}}</label>

                        <div class="col-md-6">
                            {{Form::text('username', $model->username, ['class' => 'form-control', 'placeholder' => trans('admin::base.login')])}}

                            @if ($errors->has('username'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                    <div class="row">
                        <label for="name" class="col-md-4 control-label">{{trans('admin::base.role')}}</label>

                        <div class="col-md-6">
                            {{Form::select('role_id', $model->roles, $model->role_id,
                            ['class' => 'form-control', 'placeholder' => trans('admin::base.choose')])}}

                            @if ($errors->has('role_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="row">
                    <label for="email" class="col-md-4 control-label">{{trans('admin::base.email')}}</label>
                    <div class="col-md-6">
                        {{Form::text('email', $model->email, ['class' => 'form-control', 'type'=>'email',
                          'placeholder' => trans('admin::base.email')])}}

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="row">
                    <label for="password" class="col-md-4 control-label">{{trans('admin::base.password')}}</label>

                    <div class="col-md-6">
                        {{Form::password('password', ['class' => 'form-control', 'type'=>'password', 'placeholder' => 'password'])}}

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">

               <div class="row">
                   <label for="password-confirm" class="col-md-4 control-label">{{trans('admin::base.password_again')}}</label>

                   <div class="col-md-6">
                       {{Form::password('password_confirmation', ['class' => 'form-control', 'type'=>'password', 'placeholder' => trans('admin::base.password_again')])}}
                   </div>
               </div>

            </div>

            <br>
            @if($model->exists)
                {{ Form::submit(trans('admin::base.update'), ['class' => 'btn btn-primary']) }}
            @else
                {{ Form::submit(trans('admin::base.create'), ['class' => 'btn btn-primary']) }}
            @endif

                <a class="btn btn-info" href="{{url()->previous()}}">{{trans('admin::base.back')}}</a>

        </div>
        {{ Form::close() }}

    </div>
</div>
