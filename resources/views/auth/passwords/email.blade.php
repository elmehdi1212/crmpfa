@extends('layouts.auth')
@section('content')
<header class="container animated fadeInDown" align="center">
    @if(\Session::has('status'))
        <p class="alert alert-info">
            {{ \Session::get('status') }}
        </p>
    @endif
    <div class="input">
    <form method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <h1>
            <div class="login-logo">
                <a href="{{route('login')}}">
                    CRM
                </a>
            </div>
        </h1>
        <p class="text-muted"></p>
        <div>
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control @if($errors->has('email')) is-invalid @endif" required="required"="autofocus" placeholder="{{ trans('global.login_email') }}">
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    {{ trans('global.reset_password') }}
                </button>
            </div>
        </div>
        <br>
        <br>
        <br>
    </form>
</div>
</header>
@endsection