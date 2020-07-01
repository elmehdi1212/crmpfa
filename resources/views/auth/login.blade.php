@extends('layouts.auth')
@section('content')
<header class="container animated fadeInDown" align="center">
    @if(\Session::has('message'))
    <p class="alert alert-info">
        {{ \Session::get('message') }}
    </p>
    @endif
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
    <br>
    <div class="title">
        <img src="css/images/user.png">
        <h1>Login to you account</h1>
    </div>
    <div class="input">
        <input name="email" type="text" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="{{ trans('global.login_email') }}" required autofocus>
        @if($errors->has('email'))
        <em class="invalid-feedback">
            {{ $errors->first('email') }}
        </em>
        @endif
        <br>
        <input name="password" type="password"  class="form-control @if($errors->has('password')) is-invalid @endif"  placeholder="{{ trans('global.login_password') }}" >
        @if($errors->has('password'))
        <em class="invalid-feedback">
            {{ $errors->first('password') }}
        </em>
         @endif
        <br>
    </div>
    <div class="submit">
        <input type="submit" class="button" value='{{ trans('global.login') }}'>
        <label class="ml-2">
            <input name="remember" type="checkbox" /> {{ trans('global.remember_me') }}
        </label>
        <p><a href="{{ route('password.request') }}">{{ trans('global.forgot_password') }}</a></p><br>
    </div>
    <div class="login-using">
        <p>Login Using</p>
    </div>
    <div class="login-option">
        <a href="#" class="facebook">Facebook</a>
        <a href="#" class="google">Google </a><br>
    </div>
    </form>
    <br>
<p><a href="{{route('register')}}">Create a new account</a></p><br>
</header>

@endsection