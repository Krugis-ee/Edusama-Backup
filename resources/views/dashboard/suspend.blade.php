<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Not Authorized</title>
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
         href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
         rel="stylesheet" />
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon/favicon.jpg')}}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.css')}}" />
      <link rel="stylesheet" href="{{ asset('assets/fonts/flag-icons.css')}}" />
      <!-- Core CSS -->
      <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
      <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />
      <link rel="stylesheet" href="{{ asset('assets/css/page-misc.css')}}" />
  </head>

  <body>
    <!-- Content -->
<center>
    <!-- Not Authorized -->
    <div class="container-xxl container-p-y">
      <div class="misc-wrapper" style="min-height: auto;">
        <h2 class="mb-1 mx-2">You are not authorized!</h2>
        <p class="mb-4 mx-2">
          Your Organisation/Admin seems to be suspended. Please contact your administrator to resolve this issue.
        </p>
        <a href="{{route('common_logout')}}" class="btn btn-primary mb-4" style="background-color: #e00814 !important;border-color: #e00814 !important;">Back to home</a>
        <div class="">
          <img
            src="{{ asset('assets/img/suspend.png')}}"
            alt="page-misc-not-authorized"
            width="300"
            class="img-fluid" />
        </div>
      </div>
    </div>
  </center>
  </body>
</html>
