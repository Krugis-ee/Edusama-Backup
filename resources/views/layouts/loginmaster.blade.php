<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon/favicon.jpg') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/flag-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/page-auth.css') }}" />
    <script src="{{ asset('assets/js/helpers.js')}}"></script>
    <script src="{{ asset('assets/js/template-customizer.js')}}"></script>
    <script src="assets/js/config.js"></script>
    @yield('jp_head_content')
  </head>
  <body>
  @yield('content')

  <script src="{{ asset('assets/js/jquery.js')}}"></script>
    <script src="{{ asset('assets/js/popper.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/js/node-waves.js')}}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('assets/js/hammer.js')}}"></script>
    <script src="{{ asset('assets/js/i18n.js')}}"></script>
    <script src="{{ asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/popular.min.js') }}"></script>
    <script src="{{ asset('assets/js/index.min.js') }}"></script>
    <script src="{{ asset('assets/js/autofocus_index.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/pages-auth.js')}}"></script>
  </body>
  </html>
