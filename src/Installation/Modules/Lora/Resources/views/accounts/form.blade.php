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
                    <form action="{{route('accounts', $model->id)}}" enctype="multipart/form-data" method="put" class="update-account">
                @method('put')

            @else
                    <form action="{{route('lora.account')}}" enctype="multipart/form-data" method="post" class="update-account">
                    @method('post')
            @endif
                @csrf
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="row">
                    <label for="name" class="col-md-4 control-label">{{trans('lora::base.name')}}</label>

                    <div class="col-md-6">
                        <input type="text" id="name" name="name" value="{{$model->name}}" class="form-control">

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
                        <label for="username" class="col-md-4 control-label">{{trans('lora::base.login')}}</label>

                        <div class="col-md-6">
                            <input type="text" id="username" name="username" value="{{$model->username}}" class="form-control">

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
                        <label for="role_id" class="col-md-4 control-label">{{trans('lora::base.role')}}</label>

                        <div class="col-md-6">
                            <select name="role_id" id="role_id" class="form-control">
                                @foreach($model->roles as $i => $role)
                                    <option value="{{$i}}">{{$role}}</option>
                                @endforeach
                            </select>

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
                    <label for="email" class="col-md-4 control-label">{{trans('lora::base.email')}}</label>
                    <div class="col-md-6">
                        <input type="email" id="email" name="email" value="{{$model->email}}" class="form-control">

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
                    <label for="password" class="col-md-4 control-label">{{trans('lora::base.password')}}</label>

                    <div class="col-md-6">
                        <input type="password" id="password" name="password" class="form-control">
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
                   <label for="password_confirmation" class="col-md-4 control-label">{{trans('lora::base.password_again')}}</label>

                   <div class="col-md-6">
                       <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                   </div>
               </div>

            </div>

            <br>
            @if($model->exists)
                <button type="submit" class="btn btn-primary">{{trans_url('lora::base.update')}}</button>
            @else
                <button type="submit" class="btn btn-primary">{{trans_url('lora::base.create')}}</button>
            @endif

                <a class="btn btn-info" href="{{url()->previous()}}">{{trans('admin::base.back')}}</a>

        </div>
        </form>

    </div>
</div>
