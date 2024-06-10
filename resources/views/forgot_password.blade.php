@extends('layouts.loginmaster')
@section('title','Forgot Password')

@section('jp_head_content')
<!-- Charu -->
<!-- Charu -->
<style type="text/css">
  .forgot_pass .btn-primary{
    background-color: #e00814 !important;
    border-color: #e00814 !important;
    }
    .forgot_pass .app-brand-logo.demo {
      width: auto !important;
      height: auto !important;
    }
    a:hover, a{
      color: #e00814 !important;
    }
    .forgot_pass .form-check-input:checked,.forgot_pass .form-check-input[type=checkbox]:indeterminate{
      background-color: #e00814 !important;
      border-color: #e00814 !important;
    }
    .forgot_pass .form-check-input:focus{
      border-color: #e00814 !important;
    }
</style>
@endsection

@section('content')
<div class="forgot_pass">
  <!-- Content -->

  <div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-6 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img
            src="assets/img/forgot_pass.jpg"
            alt="auth-forgot-password-cover"
            class="img-fluid my-5 auth-illustration"
            data-app-light-img="forgot_pass.jpg"
            data-app-dark-img="forgot_pass.jpg" />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Forgot Password -->
      <div class="d-flex col-12 col-lg-6 align-items-center p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
          <!-- Logo -->
          <div class="app-brand mb-4">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <img src="assets/logo/edusamanewlogo.png" class="main-logo" width="170" height="52" alt="Edusama">
              </span>
            </a>
          </div>
          <!-- /Logo -->
          <h3 class="mb-1">Forgot Password? 🔒</h3>
          <p class="mb-4">Enter your email registered with us</p>
          <form id="formAuthentication" class="mb-3" action="{{ route('common_forgot_password'); }}" method="POST">
            @if(Session::has('success'))
              <div class='alert alert-success'>{{ Session::get('success') }}</div>
              @endif
              @if(Session::has('fail'))
              <div class='alert alert-danger'>{{ Session::get('fail') }}</div>
              @endif
            <div class="mb-3">
              @csrf
              <label for="email" class="form-label">Enter the registered email address</label>
              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                placeholder="Enter Registered Email Address"
                autofocus />
            </div>
            <button class="btn btn-primary d-grid w-100">Reset password</button>
          </form>
          <div class="text-center">
            <a href="{{ route('login'); }}" class="d-flex align-items-center justify-content-center">
              <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
              Back to login
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>

</div>




 @endsection
