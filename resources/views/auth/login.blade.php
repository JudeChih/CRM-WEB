@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">


                    {{ Form::open(['action' => array('Auth\LoginController@login'),'class'=>'form_signin']) }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        {{ Form::label('使用者名稱','',['class'=>'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::text('username' ,'',['class'=>'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('使用者密碼','',['class'=>'col-md-4 control-label']) }}
                        <div class="col-md-6">
                            {{ Form::password('password' ,'',['class'=>'form-control']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">

                            {{ Form::submit('登入',['class'=>'btn btn-primary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}

                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>

<!--{{ phpinfo() }}-->
@endsection


@section('content')

{{ Form::open(['action' => array('Auth\LoginController@login'),'class'=>'form-horizontal']) }}


<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

    <div class="col-md-6">
        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-4 control-label">Password</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control" name="password" required>

        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-8 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Login
        </button>

        <a class="btn btn-link" href="{{ url('/password/reset') }}">
            Forgot Your Password?
        </a>
    </div>
</div>
</form>
@endsection