<!-- Favicon -->
<?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
?>
<?php 
if(isset($org_logo)) { ?>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/organization_logo/'.$org_logo)}}" />
<?php  } else { ?>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/edusama_newlogo.png') }}" />
<?php } ?>
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
   href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
   rel="stylesheet" />
<!-- Icons -->
<link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/fonts/flag-icons.css') }}" />
<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/node-waves.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/typeahead.css') }}" />
<!--link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/jquery-timepicker/jquery-timepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/pickr/pickr-themes.css') }}" /-->

<link rel="stylesheet" href="{{asset('assets/bootstrap-maxlength/bootstrap-maxlength.css')}}" />

<!-- data table-->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
      
      <script type="text/javascript" src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
      
<!-- data table-->
<!-- Page CSS -->
<!-- Helpers -->
<script src="{{ asset('assets/js/helpers.js')}}"></script>
<script src="{{ asset('assets/js/template-customizer.js')}}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
