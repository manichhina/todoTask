@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Forgot Password</p>
      @if(\Session::has('message'))
            <p class="alert alert-info">
                {{ \Session::get('message') }}
            </p>
        @endif
      <form action="{{ route('password.email') }}" method="post">
        {{ csrf_field() }}
        
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" required="autofocus" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
            @if($errors->has('email'))
                <em class="invalid-feedback">
                    {{ $errors->first('email') }}
                </em>
            @endif
        </div>
        <div class="row">           
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
          </div> 
        </div>
      </form>
  
    </div> 
  </div>
@endsection