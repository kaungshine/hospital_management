@extends('layouts.authentication')
@section('title', 'Login')
@section('content')
<style type="text/css">
  .copyrights{
    display: none;
  }
  .login-page::before{
    background-color: #83c7d5;
    z-index: 4;
    background-image: none;
    filter: blur(60px);
  }
</style>
<div class="row">
    <!-- Logo & Information Panel-->
    <div class="col-lg-6" style="position: 100%;">
      <div class="" style="position:absolute;   width: 100%; height: 100%;overflow: hidden;">
          {{-- <div class="logo">
            <h1>Hospital Management System</h1>
          </div>
          <p>Hospital Management Systems provide the benefits of streamlined operations, enhanced administration & control, superior patient care.</p> --}}
          <img src="{{asset('admin_template/img/login.jpg')}}" alt="..." class="img-fluid" style="position: absolute; width: 100%;height: 100%; background-position: center;background-size: cover;">
      </div>
    </div>
    <!-- Form Panel    -->
    <div class="col-lg-6 bg-white">
      <div class="form d-flex align-items-center">
        <div class="content">
          <form method="POST" action="{{ route('login') }}" class="form-validate">
            @csrf
            <div class="form-group">
              <input id="email" type="email" data-msg="Please enter your email" class="input-material @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              <label for="email" class="label-material text-info">User Name</label>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <input id="password" type="password" data-msg="Please enter your password" class="input-material @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              <label for="password" class="label-material text-info">Password</label>
            </div><button type="submit" id="login" class="btn btn-info btn-block">Login</button>
            <!-- This should be submit button but I replaced it with <a> for demo purposes-->
          </form><a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password?</a>
        </div>
      </div>
    </div>
</div>
@endsection