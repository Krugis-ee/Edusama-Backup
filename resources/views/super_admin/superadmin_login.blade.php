@extends('layouts.loginmaster');
@section('title','Login')

@section('jp_head_content')
<!-- Charu -->
<style type="text/css">
    .login_page .btn-primary{
      background-color: #e00814 !important;
      border-color: #e00814 !important;
      }
      .login_page .app-brand-logo.demo {
        width: auto !important;
        height: auto !important;
      }
      a:hover, a{
        color: #e00814 !important;
      }
      .login_page .form-control:focus, .login_page .form-select:focus,.login_page .input-group:focus-within .form-control, .login_page .input-group:focus-within .input-group-text{
        color: #e00814 !important;
        border-color: #e00814 !important;
      }
      .login_page .form-check-input:checked,.login_page .form-check-input[type=checkbox]:indeterminate{
        background-color: #e00814 !important;
        border-color: #e00814 !important;
      }
      .login_page .form-check-input:focus{
        border-color: #e00814 !important;
      }
  </style>
@endsection

@section('content')

    <!-- Content -->
<div class="login_page">
    <div class="authentication-wrapper authentication-cover authentication-bg">
      <div class="authentication-inner row">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-6 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <!-- Charu -->
            <img
              src="{{ asset('assets/img/edusama_2.png') }}"
              alt="auth-login-cover"
              class="img-fluid my-5 auth-illustration"
              data-app-light-img="edusama_2.png"
              data-app-dark-img="edusama_2.png" />

            <!-- <img
              src="../../assets/img/illustrations/bg-shape-image-light.png"
              alt="auth-login-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" /> -->
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-6 align-items-center p-sm-5 p-4">
          <div class="w-px-400 mx-auto">
            <!-- Logo -->
            <div class="app-brand mb-4">
              <a href="https://www.edusama.com/" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                <!--Charu-->      
                  <img src="{{ asset('assets/logo/edusamanewlogo.png')}}" class="main-logo" width="170" height="52" alt="Edusama">         
                </span>
              </a>
            </div>
            <!-- /Logo -->
            <h3 class="mb-1">Welcome to Edusama 👋</h3>
            <p class="mb-4">Please sign-in to your account</p>

            <form id="formAuthentication" class="mb-3" action="{{ route('super_login_process'); }}" method="POST">
              <div class="mb-3">
                @if(Session::has('success'))
              <div class='alert alert-success'>{{ Session::get('success') }}</div>
              @endif
              @if(Session::has('fail'))
              <div class='alert alert-danger'>{{ Session::get('fail') }}</div>
              @endif
                <label for="email" class="form-label">Email</label>
                @csrf

                <input
                  type="text"
                  class="form-control login_input"
                  id="email"
                  name="email"
                  placeholder="Enter your email"
                  autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  
                </div>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control login_input"
                    name="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>
              <!--div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
              </div-->
              <button type="submit" class="btn btn-primary d-grid w-100">Sign in</button>
            </form>

            <!-- <p class="text-center">
              <span>New on our platform?</span>
              <a href="auth-register-cover.html">
                <span>Create an account</span>
              </a>
            </p> -->
            <!-- Charu -->
            <!-- <div class="divider my-4">
              <div class="divider-text">or</div>
            </div>

            <div class="d-flex justify-content-center">
              <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                <i class="tf-icons fa-brands fa-google fs-5"></i>
              </a>

              <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                <i class="tf-icons fa-brands fa-twitter fs-5"></i>
              </a>
            </div> -->
          </div>
        </div>
        <!-- /Login -->
      </div>
    </div>
  </div>
    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    
  
@endsection