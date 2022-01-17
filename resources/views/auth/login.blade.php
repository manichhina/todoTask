@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      @if(\Session::has('message'))
            <p class="alert alert-info">
                {{ \Session::get('message') }}
            </p>
        @endif
      <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus placeholder="Email" value="{{ old('email', null) }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input class="form-check-input" name="remember" type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> 
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div> 
        </div>
      </form>
 

      <p class="mb-1">
        <a href="{{ route('password.request') }}">Forgot your password?</a>
      </p>       
    </div> 
  </div>
 
@endsection