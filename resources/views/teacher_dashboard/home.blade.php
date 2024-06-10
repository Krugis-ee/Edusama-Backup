<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
   <title>Teacher Dashboard</title>
   <meta name="description" content="" />
   @include('dashboard.header')
   <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    $student_avatar = !empty(App\Models\User::getStudentAvatarById($user_id)) ? App\Models\User::getStudentAvatarById($user_id) : '15.png';
    ?>

   <!-- teacher Dashboard -->
   <link rel="stylesheet" href="{{asset('assets/apex-charts/apex-charts.css')}}" />
   <link rel="stylesheet" href="{{asset('assets/swiper/swiper.css')}}" />
   <link rel="stylesheet" href="{{asset('assets/css/app-calendar.css')}}" />
   <link rel="stylesheet" href="{{asset('assets/fullcalendar/fullcalendar.css')}}" />
   <link rel="stylesheet" href="{{asset('assets/flatpickr/flatpickr.css')}}" />
   <link rel="stylesheet" href="{{asset('assets/select2/select2.css')}}" />
   <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
   <script type="text/javascript" src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
   <script src="{{asset('assets/js/helpers.js')}}"></script>
   <script src="{{asset('assets/js/template-customizer.js')}}"></script>
   <script src="{{asset('assets/js/config.js')}}"></script>
   <link rel="stylesheet" href="{{asset('assets/css/app-academy.css')}}" />
   <link rel="stylesheet" href="{{asset('assets/css/cards-advance.css')}}" />
   <link href="https://cdn.jsdelivr.net/npm/Bootstrap@5.2.2/dist/css/Bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/Bootstrap@5.2.2/dist/js/Bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/Bootstrap@5.2.2/dist/js/Bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
   </script>

   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <link href='https://fonts.googleapis.com/css?family=Roboto:400,900,700,500,300,100' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
   <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js'></script>

   <link rel="stylesheet" href="{{asset('assets/apex-charts/apex-charts.css')}}" />
   <link rel="stylesheet" href="{{asset('assets/swiper/swiper.css')}}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/ui-carousel.css')}}" />


   <style type="text/css">
      .dashboard_page .btn-primary {
         background-color: <?php echo $org_color; ?> !important;
         border-color: <?php echo $org_color; ?> !important;
      }

      .dashboard_page .app-brand-logo.demo {
         width: auto !important;
         height: auto !important;
      }

      .dashboard_page .form-check-input:checked,
      .dashboard_page .form-check-input[type=checkbox]:indeterminate {
         background-color: <?php echo $org_color; ?> !important;
         border-color: <?php echo $org_color; ?> !important;
      }

      .dashboard_page .form-check-input:focus {
         border-color: <?php echo $org_color; ?> !important;
      }

      .dashboard_page .bg-primary {
         background-color: <?php echo $org_color; ?> !important;
      }

      .dashboard_page .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
      .dashboard_page .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
      .dashboard_page .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
      .dashboard_page .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle) {
         background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
         color: #ffffff !important;
      }

      .dashboard_page .menu-vertical .app-brand {
         margin: 20px 0.875rem 20px 1rem;
      }

      .dashboard_page i {
         font-size: 17px !important;
      }

      #half_logo {
         display: none;
      }

      .layout-menu-collapsed .half_logo {
         margin-left: 3px !important;
      }

      .layout-navbar-fixed .layout-page:before {
         background: #0000000d;
         mask: none;
      }

      .dashboard_page #template-customizer .template-customizer-open-btn {
         display: none;
      }

      .dashboard_page line[y1="0"] {
         display: none;
      }

      .dashboard_page .side_panel .avatar-initial {
         background: #f4f2f6;
         color: #000;
         border: 1px solid #eee;
      }

      .dashboard_page .drag_icon {
         font-size: 20px !important;
      }

      td {
         box-shadow: none !important;
      }

      .table_admin select#dt-length-0 {
         margin-right: 10px !important;
      }

      .table_admin .dt-search .dt-input {
         margin-left: 14px !important;
      }

      .table_admin .dt-search .dt-input:focus,
      .table_admin .dt-length select.dt-input:focus {
         color: #6f6b7d;
         background-color: #fff;
         border-color: #7367f0;
         outline: 0;
         box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
      }

      .table_admin .dt-length select.dt-input {
         --bs-form-select-bg-img: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 7.5L10 12.5L15 7.5' stroke='%236f6b7d' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5 7.5L10 12.5L15 7.5' stroke='white' stroke-opacity='0.2' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
         padding: 0.422rem 2.45rem 0.422rem 0.875rem;
         font-size: 0.9375rem;
         font-weight: 400;
         line-height: 1.5;
         color: #6f6b7d;
         appearance: none;
         background-color: #fff;
         background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
         background-repeat: no-repeat;
         background-position: right 0.875rem center;
         background-size: 22px 20px;
         border: var(--bs-border-width) solid #dbdade;
         border-radius: var(--bs-border-radius);
         transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      }

      .drag_body .card-body {
         padding: 11px;
      }

      .drag_body .content-right p.mb-0 {
         font-size: 14px;
      }

      .drag_body .content-right {
         text-align: center;
         width: 75%;
      }

      .drag_body .bg-label-primary.p-2.rounded {
         width: 20%;
      }

      .mg-2 {
         margin-bottom: 10px;
      }

      .fc-dayGridMonth-button,
      .fc-timeGridWeek-button,
      .fc-timeGridDay-button,
      .fc-listMonth-button {
         display: none !important;
      }

      .fc-next-button {
         left: 22rem;
      }

      .fc-toolbar-title {
         left: 4rem;
         position: relative;
      }

      .app-academy .app-academy-img-height {
         height: 130px;
      }

      @media (min-width: 768px) {
         .app-academy .app-academy-md-25 {
            width: 25%;
         }
         .app-academy .app-academy-md-50 {
            width: 50%;
         }
         .app-academy .app-academy-md-80 {
            width: 80%;
         }
      }

      @media (min-width: 576px) {
         .app-academy .app-academy-sm-40 {
            width: 40% !important;
         }
         .app-academy .app-academy-sm-60 {
            width: 60% !important;
         }
      }

      @media (min-width: 1200px) {
         .app-academy .app-academy-xl-100 {
            width: 100% !important;
         }
         .app-academy .app-academy-xl-100 {
            width: 100% !important;
         }
      }

      #demo {
         text-align: center;
         font-style: italic;
         color: #e4232e;
         font-weight: bold;
         font-size: 45px;
         margin: 0px auto;
      }

      .text-left {
         text-align: left !important;
      }

      #student_dashboard .ti-xl {
         font-size: 2.25rem !important;
      }

      .my_courses .timeline .timeline-item {
         padding-left: 1.5rem;
      }

      .my_notification:hover {
         color: #f06767;
      }

      .flatpickr-calendar {
         margin: auto;
      }

      #earning_select {
         width: 45% !important;
         padding: 6px !important;
         font-size: 12px !important;
      }

      #earning_selectcol .col-md-3 {
         padding: 0px 8px !important;
         text-align: center;
      }

      .flatpickr-calendar {
         margin: auto;
      }

      .pad0 {
         padding: 0px;
      }

      .dayContainer,
      .flatpickr-days {
         max-width: 20rem !important;
         width: 20rem !important;
         height: 9.9rem;
      }

      .light-style .flatpickr-days,
      .light-style .flatpickr-calendar,
      .flatpickr-rContainer {
         width: 100% !important;
      }

      .light-style .flatpickr-days {
         width: 28rem !important;
         max-width: 28rem !important;
      }

      #categoryFilter select.form-control{
          display: inline;
          width: 200px;
          margin-left: 25px;
        }
        #categoryFilter{
          width: 60%;
          position: relative;
          left: 40%;
         }
      #filterTable_filter{
         display: -webkit-inline-box;
          position: relative;
          right: 25%;
      }
      #filterTable_filter label{
          position: relative;
          right: -44%;
      }
      #filterTable{
    padding-top: 30px;
}
#swiper-3d-cube-effect {
    max-width: 1000px !important;
    height: 430px;
}
.swiper .swiper-slide{
   background: #fff !important;
   box-shadow: 0 0.25rem 1.125rem rgba(75, 70, 92, 0.1);
}
#payment th {
    padding: 10px 5px !important;
    text-transform: math-auto;
    text-align: center;
}
#payment td{
   text-align: center;
   padding: 10px 5px !important;
}
</style>
</head>

<body class="dashboard_page">
   <!-- Layout wrapper -->
   <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
         <!-- Menu -->
         @include('teacher_dashboard.sidebar')
         <div class="layout-page">
            <!-- Navbar -->
            @include('teacher_dashboard.navbar')
            <!-- / Navbar -->
            <!-- Content wrapper -->
            <div class="content-wrapper">
               <!-- Content -->
               <div class="container-xxl flex-grow-1 container-p-y" id="student_dashboard">
                  <h3 class="mt-3 mb-4">Welcome Back, <?php $user_id = Session()->get('loginId');
                                        echo $user_name = App\Models\User::getTeacherNameByID($user_id);
                                        ?></h3></h3>
                  <div class="row">
                     <div class="col-12 col-xl-7 col-md-6 mb-3">
                        <div class="col-12 col-xl-12 col-md-6 mb-4 pad0">
                           <div class="row mb-4" id="sortable-cards">
                              <div class="col-lg-4 col-md-6 col-sm-12 pad0">
                                 <div class="card drag-item cursor-move card-border-shadow-primary">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                       <div class="card-title mb-0">
                                          <h5 class="mb-0 me-2">35000</h5>
                                          <small>Total Students</small>
                                       </div>
                                       <div class="card-icon">
                                          <span class="badge bg-label-primary rounded-pill p-2">
                                             <i class="ti ti-users ti-sm"></i>
                                             </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-4 col-md-6 col-sm-12">
                                 <div class="card drag-item cursor-move card-border-shadow-warning">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                       <div class="card-title mb-0">
                                          <h5 class="mb-0 me-2">50</h5>
                                          <small>Total Exams</small>
                                       </div>
                                       <div class="card-icon">
                                          <span class="badge bg-label-warning rounded-pill p-2">
                                             <i class="ti ti-edit ti-sm"></i>
                                             </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-4 col-md-6 col-sm-12 pad0">
                                 <div class="card drag-item cursor-move card-border-shadow-success h-100">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                       <div class="card-title mb-0">
                                          <h5 class="mb-0 me-2">100</h5>
                                          <small>Total Courses</small>
                                       </div>
                                       <div class="card-icon">
                                          <span class="badge bg-label-success rounded-pill p-2">
                                             <i class="ti ti-certificate-2 ti-sm"></i>
                                             </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-xl-12 col-md-6 pad0">
                           <div class="d-flex justify-content-between mb-2">
                              <h4 class="card-title m-0 mb-3" style="color: <?php echo $org_color; ?>;">Upcoming Courses</h4>
                              <small class="text-muted">View All</small>
                           </div>
                           <div class="row">
                              <div class="col-12 col-xl-6 col-md-6 mb-1">
                                 <div class="card mb-4">
                                    <div class="card-body">
                                       <ul class="p-0 m-0">
                                          <li class="d-flex">
                                             <div class="chart-progress me-3" data-color="primary" data-series="72" data-progress_variant="true">
                                             </div>
                                             <div class="row w-100 align-items-center">
                                                <div class="col-12">
                                                   <div class="me-2">
                                                      <h6 class="mb-2">N4 Advanced</h6>
                                                   </div>
                                                   <div class="d-flex justify-content-between mb-3">
                                                      <small class="text-muted"><i class="tf-icons ti ti-notebook"></i>&nbsp;21 lessons</small>
                                                      <small class="text-muted" style="text-align: left;position: relative;left: -28px;"><i class="tf-icons ti ti-clock-2"></i>&nbsp;50 mins</small>
                                                   </div>
                                                   <div class="d-flex justify-content-between mb-4">
                                                      <small class="text-muted"><i class="tf-icons ti ti-notes"></i>&nbsp;2 Assignments</small>
                                                      <small class="text-muted"><i class="tf-icons ti ti-school"></i>&nbsp;35 Students</small>
                                                   </div>
                                                   <button type="button" class="btn btn-primary waves-effect waves-light" style="float:right;">Join Now</button>
                                                </div>
                                             </div>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12 col-xl-6 col-md-6 mb-1">
                                 <div class="card">
                                    <div class="card-body">
                                       <ul class="p-0 m-0">
                                          <li class="d-flex">
                                             <div class="chart-progress me-3" data-color="primary" data-series="72" data-progress_variant="true">
                                             </div>
                                             <div class="row w-100 align-items-center">
                                                <div class="col-12">
                                                   <div class="me-2">
                                                      <h6 class="mb-2">N4 Advanced</h6>
                                                   </div>
                                                   <div class="d-flex justify-content-between mb-3">
                                                      <small class="text-muted"><i class="tf-icons ti ti-notebook"></i>&nbsp;21 lessons</small>
                                                      <small class="text-muted" style="text-align: left;position: relative;left: -28px;"><i class="tf-icons ti ti-clock-2"></i>&nbsp;50 mins</small>
                                                   </div>
                                                   <div class="d-flex justify-content-between mb-3">
                                                      <small class="text-muted"><i class="tf-icons ti ti-notes"></i>&nbsp;2 Assignments</small>
                                                      <small class="text-muted"><i class="tf-icons ti ti-school"></i>&nbsp;35 Students</small>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                       </ul>
                                       <div class="alert alert-primary" style="margin-bottom: 0px;" role="alert"><small>Next Class Starting in 01:30hr</small></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-12 col-xl-12 col-12 mb-4">
                           <div class="card">
                             <div class="card-header header-elements">
                               <h4 class="card-title m-0 mb-3" style="color: <?php echo $org_color; ?>;">Student Attendance</h4>
                               <div class="card-header-elements ms-auto py-0 dropdown">
                                 <button
                                   type="button"
                                   class="btn dropdown-toggle hide-arrow p-0"
                                   id="heat-chart-dd"
                                   data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                   <i class="ti ti-dots-vertical"></i>
                                 </button>
                                 <div class="dropdown-menu dropdown-menu-end" aria-labelledby="heat-chart-dd">
                                   <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                   <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                   <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                 </div>
                               </div>
                             </div>
                             <div class="card-body">
                               <canvas id="polarChart" class="chartjs" data-height="337"></canvas>
                             </div>
                           </div>
                        </div>
                        <div class="col-12 col-xl-12 col-md-3 mb-4 pad0">
                           <div class="d-flex justify-content-between mb-2">
                              <h4 class="card-title m-0 mb-3" style="color: <?php echo $org_color; ?>;">My Classes</h4>
                              <small class="text-muted">View All</small>
                           </div>
                           <div class="swiper" id="swiper-3d-cube-effect">
                             <div class="swiper-wrapper">
                               <div class="swiper-slide">
                                 <h5 class="card-title m-0 mb-3" style="color: #1f08e0;text-align: left;margin-left: 25px !important;font-style: italic;font-weight: bold;text-transform: uppercase;">
                                    <span class="badge bg-label-dark" style="background-color: #1f08e03b !important;color: #1f08e0 !important;">Today</span>
                                 </h5>
                                 <div class="table-responsive text-nowrap">
                                    <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th>Subject</th>
                                          <th>Classroom</th>
                                          <th>Date</th>
                                          <th>Duration</th>
                                          <th>Time</th>
                                        </tr>
                                      </thead>
                                      <tbody class="table-border-bottom-0">
                                        <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                      </tbody>
                                    </table>
                                  </div>
                               </div>
                               <div class="swiper-slide">
                                 <h5 class="card-title m-0 mb-3" style="color: #1f08e0;text-align: left;margin-left: 25px !important;font-style: italic;font-weight: bold;text-transform: uppercase;">
                                    <span class="badge bg-label-dark" style="background-color: #1f08e03b !important;color: #1f08e0 !important;">Tomorrow</span>
                                 </h5>
                                 <div class="table-responsive text-nowrap">
                                    <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th>Subject</th>
                                          <th>Classroom</th>
                                          <th>Date</th>
                                          <th>Duration</th>
                                          <th>Time</th>
                                        </tr>
                                      </thead>
                                      <tbody class="table-border-bottom-0">
                                        <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                      </tbody>
                                    </table>
                                  </div>
                               </div>
                               <div class="swiper-slide">
                                 <h5 class="card-title m-0 mb-3" style="color: #1f08e0;text-align: left;margin-left: 25px !important;font-style: italic;font-weight: bold;text-transform: uppercase;">
                                    <span class="badge bg-label-dark" style="background-color: #1f08e03b !important;color: #1f08e0 !important;">April 01</span>
                                 </h5>
                                 <div class="table-responsive text-nowrap">
                                    <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th>Subject</th>
                                          <th>Classroom</th>
                                          <th>Date</th>
                                          <th>Duration</th>
                                          <th>Time</th>
                                        </tr>
                                      </thead>
                                      <tbody class="table-border-bottom-0">
                                        <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                      </tbody>
                                    </table>
                                  </div>
                               </div>
                               <div class="swiper-slide">
                                 <h5 class="card-title m-0 mb-3" style="color: #1f08e0;text-align: left;margin-left: 25px !important;font-style: italic;font-weight: bold;text-transform: uppercase;">
                                    <span class="badge bg-label-dark" style="background-color: #1f08e03b !important;color: #1f08e0 !important;">April 02</span>
                                 </h5>
                                 <div class="table-responsive text-nowrap">
                                    <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th>Subject</th>
                                          <th>Classroom</th>
                                          <th>Date</th>
                                          <th>Duration</th>
                                          <th>Time</th>
                                        </tr>
                                      </thead>
                                      <tbody class="table-border-bottom-0">
                                        <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                      </tbody>
                                    </table>
                                  </div>
                               </div>
                               <div class="swiper-slide">
                                 <h5 class="card-title m-0 mb-3" style="color: #1f08e0;text-align: left;margin-left: 25px !important;font-style: italic;font-weight: bold;text-transform: uppercase;">
                                    <span class="badge bg-label-dark" style="background-color: #1f08e03b !important;color: #1f08e0 !important;">April 03</span>
                                 </h5>
                                 <div class="table-responsive text-nowrap">
                                    <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th>Subject</th>
                                          <th>Classroom</th>
                                          <th>Date</th>
                                          <th>Duration</th>
                                          <th>Time</th>
                                        </tr>
                                      </thead>
                                      <tbody class="table-border-bottom-0">
                                        <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                       <tr>
                                          <td><small>N4 Advanced</small></td>
                                          <td><small>A</small></td>
                                          <td><small>02-04-2024</small></td>
                                          <td><small>30mins</small></td>
                                          <td><small>10AM</small></td>
                                       </tr>
                                      </tbody>
                                    </table>
                                  </div>
                               </div>
                             </div>
                             <div class="swiper-pagination"></div>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-xl-5 col-md-6">
                         <div class="card mb-4">
                              <div class="card-body" style="padding: 10px 5px;">
                                    <div class="col-12 col-xl-12 col-md-3 pad0">
                                             <div class="table-responsive text-nowrap" id="payment">
                                                <table class="table table-hover">
                                                  <thead>
                                                    <tr>
                                                      <th>Payment Date</th>
                                                      <th>Amount</th>
                                                      <th>Status</th>
                                                      <th>Payroll Download</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <td><small>02-04-2024</small></td>
                                                      <td><small>30$</small></td>
                                                      <td><small><span class="badge rounded-pill bg-label-success">Paid</span></small></td>
                                                      <td><small><span class="badge badge-center bg-dark bg-glow"><i class="ti ti-download"></i></span></small></td>
                                                   </tr>
                                                   <tr>
                                                      <td><small>02-04-2024</small></td>
                                                      <td><small>30$</small></td>
                                                      <td><small><span class="badge rounded-pill bg-label-warning">Waiting</span></small></td>
                                                      <td><small><span class="badge badge-center bg-dark bg-glow"><i class="ti ti-download"></i></span></small></td>
                                                   </tr>
                                                  </tbody>
                                                  <tfoot class="table-border-bottom-0">
                                                   <tr>
                                                      <td colspan="4" style="text-align:right;"><small>View All</small></td>
                                                   </tr>
                                                </tfoot>
                                                </table>
                                              </div>
                                      <!--  <div class="card">
                                          <div class="card-header d-flex justify-content-between">
                                             <h5 class="card-title mb-0">Your Earnings</h5>
                                             <select id="earning_select" class="form-select">
                                                <option>All Courses</option>
                                                <option value="1">N4</option>
                                                <option value="2">N5</option>
                                                <option value="3">Speech</option>
                                             </select>
                                          </div>
                                          <div class="card-body pt-2" id="earning_selectcol">
                                             <div class="row gy-3">
                                                <div class="col-md-3 col-6">
                                                   <div class="align-items-center">
                                                      <div class="card-info">
                                                         <h5 class="mb-0">$10</h5>
                                                         <small>Today</small>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-3 col-6">
                                                   <div class="align-items-center">
                                                      <div class="card-info">
                                                         <h5 class="mb-0">$110</h5>
                                                         <small>Refunds</small>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-3 col-6">
                                                   <div class="align-items-center">
                                                      <div class="card-info">
                                                         <h5 class="mb-0">$20</h5>
                                                         <small>Pending</small>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="col-md-3 col-6">
                                                   <div class="align-items-center">
                                                      <div class="card-info">
                                                         <h5 class="mb-0">$9745</h5>
                                                         <small>Total</small>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div> -->
                                    </div>
                                 </div>
                              </div>
                        <div class="col-12 col-xl-12 col-md-3 mb-4 pad0">
                           <div class="card">
                              <div class="card-body">
                                 <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                       <div class="card-title mb-auto">
                                          <h5 class="mb-1 text-nowrap">Course Taken</h5>
                                          <small>Monthly Report</small>
                                       </div>
                                       <div class="chart-statistics">
                                          <small class="text-success text-nowrap fw-medium">
                                             <i class="ti ti-chevron-right me-1"></i> View All Courses
                                          </small>
                                       </div>
                                    </div>
                                    <div id="generatedLeadsChart"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-xl-12 col-md-3 mb-4 pad0">
                           <div class="card">
                              <div class="col-lg-12" style="padding:10px;">
                                 <small class="text-light fw-medium">Announcements</small>
                                 <small class="text-light fw-medium" style="float: right;"><a href="" style="color: <?php echo $org_color; ?>;">View All</a></small>
                                 <div class="demo-inline-spacing mt-3">
                                    <div class="list-group">
                                       <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between my_notification" style="padding: 10px;">
                                          <div class="li-wrapper d-flex justify-content-start align-items-center">
                                             <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial rounded-circle bg-label-success" style="padding: 16px;">M</span>
                                             </div>
                                             <div class="list-content">
                                                <small class="mb-1">List group item heading</small>
                                             </div>
                                          </div>
                                          <small>3 days ago</small>
                                       </a>
                                       <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between my_notification" style="padding: 10px;">
                                          <div class="li-wrapper d-flex justify-content-start align-items-center">
                                             <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial rounded-circle bg-label-danger" style="padding: 16px;">B</span>
                                             </div>
                                             <div class="list-content">
                                                <small class="mb-1">List group item heading</small>
                                             </div>
                                          </div>
                                          <small>1 day ago</small>
                                       </a>
                                       <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between my_notification" style="padding: 10px;">
                                          <div class="li-wrapper d-flex justify-content-start align-items-center">
                                             <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial rounded-circle bg-label-primary" style="padding: 16px;">V</span>
                                             </div>
                                             <div class="list-content">
                                                <small class="mb-1">List group item heading</small>
                                             </div>
                                          </div>
                                          <small>5 days ago</small>
                                       </a>
                                       <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between my_notification" style="padding: 10px;">
                                          <div class="li-wrapper d-flex justify-content-start align-items-center">
                                             <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial rounded-circle bg-label-primary" style="padding: 16px;">V</span>
                                             </div>
                                             <div class="list-content">
                                                <small class="mb-1">List group item heading</small>
                                             </div>
                                          </div>
                                          <small>5 days ago</small>
                                       </a>
                                       <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between my_notification" style="padding: 10px;">
                                          <div class="li-wrapper d-flex justify-content-start align-items-center">
                                             <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial rounded-circle bg-label-primary" style="padding: 16px;">V</span>
                                             </div>
                                             <div class="list-content">
                                                <small class="mb-1">List group item heading</small>
                                             </div>
                                          </div>
                                          <small>5 days ago</small>
                                       </a>
                                       <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between my_notification" style="padding: 10px;">
                                          <div class="li-wrapper d-flex justify-content-start align-items-center">
                                             <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial rounded-circle bg-label-primary" style="padding: 16px;">V</span>
                                             </div>
                                             <div class="list-content">
                                                <small class="mb-1">List group item heading</small>
                                             </div>
                                          </div>
                                          <small>5 days ago</small>
                                       </a>
                                       <a href="javascript:void(0);" class="list-group-item list-group-item-action d-flex justify-content-between my_notification" style="padding: 10px;">
                                          <div class="li-wrapper d-flex justify-content-start align-items-center">
                                             <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial rounded-circle bg-label-primary" style="padding: 16px;">V</span>
                                             </div>
                                             <div class="list-content">
                                                <small class="mb-1">List group item heading</small>
                                             </div>
                                          </div>
                                          <small>5 days ago</small>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-xl-12 col-md-3 mb-4 pad0">
                           <div class="card">
                              <div class="card-header d-flex justify-content-between">
                                 <h5 class="card-title m-0 me-2 pt-1 mb-2 d-flex align-items-center">
                                    <i class="ti ti-list-details ms-n1 me-2"></i> Activity Timeline
                                 </h5>
                                 <div class="dropdown">
                                    <button
                                       class="btn p-0"
                                       type="button"
                                       id="timelineWapper"
                                       data-bs-toggle="dropdown"
                                       aria-haspopup="true"
                                       aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineWapper">
                                       <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                       <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                       <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                    </div>
                                 </div>
                              </div>
                              <div class="card-body pb-0">
                                 <ul class="timeline ms-1 mb-0">
                                    <li class="timeline-item timeline-item-transparent ps-4">
                                       <span class="timeline-point timeline-point-warning"></span>
                                       <div class="timeline-event">
                                          <div class="timeline-header">
                                             <h6 class="mb-0">Teacher Meeting</h6>
                                             <small class="text-muted">Today</small>
                                          </div>
                                          <p class="mb-2" style="font-style: italic;">Teachers meeting<br> with Pricipal @10:15am</p>
                                       </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent ps-4">
                                       <span class="timeline-point timeline-point-primary"></span>
                                       <div class="timeline-event">
                                          <div class="timeline-header">
                                             <h6 class="mb-0">Create a new assignment</h6>
                                             <small class="text-muted">2 Day Ago</small>
                                          </div>
                                          <p class="mb-0" style="font-style: italic;"> N4 Advanced</p>
                                       </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent ps-4">
                                       <span class="timeline-point timeline-point-info"></span>
                                       <div class="timeline-event">
                                          <div class="timeline-header">
                                             <h6 class="mb-0">Shared 2 New Course Files</h6>
                                             <small class="text-muted">6 Day Ago</small>
                                          </div>
                                          <p class="mb-2" style="font-style: italic;">Sent by Mollie Dixon</p>
                                       </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent ps-4">
                                       <span class="timeline-point timeline-point-danger"></span>
                                       <div class="timeline-event">
                                          <div class="timeline-header">
                                             <h6 class="mb-0">Shared Exam Modules</h6>
                                             <small class="text-muted">8 Day Ago</small>
                                          </div>
                                          <p class="mb-2" style="font-style: italic;">Sent by Mollie Dixon</p>
                                       </div>
                                    </li>
                                    <li class="timeline-item timeline-item-transparent ps-4 border-transparent">
                                       <span class="timeline-point timeline-point-secondary"></span>
                                       <div class="timeline-event pb-0">
                                          <div class="timeline-header">
                                             <h6 class="mb-0">Course status updated</h6>
                                             <small class="text-muted">10 Day Ago</small>
                                          </div>
                                          <p class="mb-0" style="font-style: italic;">N4 Advanced Completed</p>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-12 col-xl-12 col-md-6">
                        <div class="card">
                           <div class="card-header d-flex align-items-center justify-content-between">
                              <div>
                                <h4 class="card-title m-0 mb-3" style="color: <?php echo $org_color; ?>;">Student Lists</h4>
                              </div>
                           </div>
                           <div class="card-body">
                              <div class="category-filter">
                                 <select id="categoryFilter" class="form-control">
                                    <option value="">Show All</option>
                                    <option value="N4 Advanced">N4 Advanced</option>
                                    <option value="N5 Intermediate">N5 Intermediate</option>
                                    <option value="Speech Class">Speech Class</option>
                                 </select>
                              </div>

                              <!-- Set up the datatable -->
                              <table class="table" id="filterTable">
                                 <thead>
                                    <tr>
                                       <th scope="col">Student Pic</th>
                                       <th scope="col">Student Name</th>
                                       <th scope="col">Classroom</th>
                                       <th scope="col">Subject Name</th>
                                       <th scope="col">Assignment</th>
                                       <th scope="col">Exam result</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td scope="col">
                                          <div class="avatar avatar-online">
                                             <img src="assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                                          </div>
                                       </td>
                                       <td scope="col">Public Enemy</td>
                                       <td scope="col">A</td>
                                       <td scope="col">N5 Intermediate</td>
                                       <td scope="col">
                                          <span class="badge rounded-pill bg-success">Submitted</span>
                                       </td>
                                       <td scope="col">
                                          80%
                                       </td>
                                    </tr>
                                    <tr>
                                       <td scope="col">
                                          <div class="avatar avatar-online">
                                             <img src="assets/img/avatars/2.png" alt class="h-auto rounded-circle" />
                                          </div>
                                       </td>
                                       <td scope="col">Billie Holiday</td>
                                       <td scope="col">A</td>
                                       <td scope="col">N5 Intermediate</td>
                                       <td scope="col">
                                          <span class="badge rounded-pill bg-danger">Yet to Submit</span>
                                       </td>
                                       <td scope="col">
                                          80%
                                       </td>
                                    </tr>
                                    <tr>
                                       <td scope="col">
                                          <div class="avatar avatar-online">
                                             <img src="assets/img/avatars/3.png" alt class="h-auto rounded-circle" />
                                          </div>
                                       </td>
                                       <td scope="col">Chet Baker</td>
                                       <td scope="col">C</td>
                                       <td scope="col">N4 Advanced</td>
                                       <td scope="col">
                                          <span class="badge rounded-pill bg-success">Submitted</span>
                                       </td>
                                       <td scope="col">
                                          80%
                                       </td>
                                    </tr>
                                    <tr>
                                       <td scope="col">
                                          <div class="avatar avatar-online">
                                             <img src="assets/img/avatars/4.png" alt class="h-auto rounded-circle" />
                                          </div>
                                       </td>
                                       <td scope="col">Jurrasic 5</td>
                                       <td scope="col">B</td>
                                       <td scope="col">Speech Class</td>
                                       <td scope="col">
                                          <span class="badge rounded-pill bg-danger">Yet to Submit</span>
                                       </td>
                                       <td scope="col">
                                          80%
                                       </td>
                                    </tr>
                                   <tr>
                                       <td scope="col">
                                          <div class="avatar avatar-online">
                                             <img src="assets/img/avatars/5.png" alt class="h-auto rounded-circle" />
                                          </div>
                                       </td>
                                       <td scope="col">Onyx</td>
                                       <td scope="col">A</td>
                                       <td scope="col">N4 Advanced</td>
                                       <td scope="col">
                                          <span class="badge rounded-pill bg-success">Submitted</span>
                                       </td>
                                       <td scope="col">
                                          80%
                                       </td>
                                    </tr>
                                    <tr>
                                       <td scope="col">
                                          <div class="avatar avatar-online">
                                             <img src="assets/img/avatars/6.png" alt class="h-auto rounded-circle" />
                                          </div>
                                       </td>
                                       <td scope="col">Vivaldi</td>
                                       <td scope="col">B</td>
                                       <td scope="col">Speech Class</td>
                                       <td scope="col">
                                          <span class="badge rounded-pill bg-danger">Yet to Submit</span>
                                       </td>
                                       <td scope="col">
                                          80%
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Content -->
            <div class="content-backdrop fade"></div>
         </div>
         <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
   </div>
   <!-- Overlay -->
   <div class="layout-overlay layout-menu-toggle"></div>
   <!-- Drag Target Area To SlideIn Menu On Small Screens -->
   <div class="drag-target"></div>
   </div>
   <!-- / Layout wrapper -->
   <!-- Core JS -->
   <!-- build:js assets/vendor/js/core.js -->
   @include('dashboard.footer')
   <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
   <!-- endbuild -->
   <!-- Vendors JS -->
   <script src="{{asset('assets/sortablejs/sortable.js')}}"></script>
   <!-- Main JS -->
   <script src="{{asset('assets/js/main.js')}}"></script>
   <!-- Page JS -->
   <script src="{{asset('assets/js/extended-ui-drag-and-drop.js')}}"></script>
   <script type="text/javascript">
      (function() {
         const cardEl = document.getElementById('sortable-cards')

         if (cardEl) {
            Sortable.create(cardEl);
         }

      });
   </script>
   <!-- Page JS -->
   <script src="{{asset('assets/js/app-ecommerce-dashboard.js')}}"></script>
   <script src="{{asset('assets/js/charts-apex.js')}}"></script>
   <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
   <script src="{{asset('assets/js/app-calendar-events.js')}}"></script>
   <script src="{{asset('assets/js/app-calendar.js')}}"></script>
   <script src="{{asset('assets/fullcalendar/fullcalendar.js')}}"></script>
   <script src="{{asset('assets/select2/select2.js')}}"></script>
   <script src="{{asset('assets/flatpickr/flatpickr.js')}}"></script>
   <script src="{{asset('assets/moment/moment.js')}}"></script>
   <script src="{{asset('assets/js/app-academy-dashboard.js')}}"></script>
   <script src="{{asset('assets/apex-charts/apexcharts.js')}}"></script>
   <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
   <script src="{{asset('assets/js/extended-ui-perfect-scrollbar.js')}}"></script>
   <script src="{{asset('assets/js/app-academy-dashboard.js')}}"></script>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

   <script src="{{asset('assets/apex-charts/apexcharts.js')}}"></script>
   <script src="{{asset('assets/js/charts-apex.js')}}"></script>
   <script src="{{asset('assets/chartjs/chartjs.js')}}"></script>
   <script src="{{asset('assets/js/charts-chartjs.js')}}"></script>
   <script src="{{asset('assets/js/app-ecommerce-dashboard.js')}}"></script>
   <script>
      new DataTable('#example', {
         pagingType: 'simple_numbers'
      });
   </script>
   <script>
      // Set the date we're counting down to
      var countDownDate = new Date("Apr 17, 2024 15:37:25").getTime();

      // Update the count down every 1 second
      var x = setInterval(function() {

         // Get today's date and time
         var now = new Date().getTime();

         // Find the distance between now and the count down date
         var distance = countDownDate - now;

         // Time calculations for days, hours, minutes and seconds
         var days = Math.floor(distance / (1000 * 60 * 60 * 24));
         var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
         var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
         var seconds = Math.floor((distance % (1000 * 60)) / 1000);

         // Output the result in an element with id="demo"
         document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

         document.getElementById("demo1").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

         // If the count down is over, write some text
         if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
            document.getElementById("demo1").innerHTML = "EXPIRED";
         }
      }, 1000);
   </script>
   <script>
      var ctx = document.getElementById("myLineChart").getContext("2d");
      var myChart = new Chart(ctx, {
         type: "line",
         data: {
            labels: [
               "January",
               "February",
               "March",
               "April",
               "May",
               "June",
               "July",
               "August",
               "September",
               "October",
               "November",
               "Decemebr",
            ],
            datasets: [{
               label: "Course Attended",
               data: [2, 45, 36, 10, 69, 8, 33, 9, 3, 17, 6, 3],
               backgroundColor: "#e6374169",
            }, {
               label: "Course Missed",
               data: [2, 5, 8, 6, 4, 3, 2, 5, 5, 2, 1, 10],
               backgroundColor: "#e95ba3",
            }, ],
         },
      });
   </script>
   <script type="text/javascript">
      $(document).ready(function() {

         google.charts.load('current', {
            'packages': ['corechart']
         });
         google.charts.setOnLoadCallback(drawChart);

         function drawChart() {

            var data = google.visualization.arrayToDataTable([
               ['Task', 'Hours per Day'],
               ['Study', 11],
               ['Playing', 2],
               ['Watch TV', 2],
               ['Tution', 2],
               ['Sleep', 7]
            ]);

            var options = {
               title: 'My Day Schedule',
               is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart3d'));

            chart.draw(data, options);
         }


      });
   </script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->

   <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
   <script src="assets/swiper/swiper.js"></script>
    <script src="assets/js/ui-carousel.js"></script>

   <script>
      $("document").ready(function() {

         $("#filterTable").dataTable({
            "searching": true
         });

         //Get a reference to the new datatable
         var table = $('#filterTable').DataTable();

         //Take the category filter drop down and append it to the datatables_filter div.
         //You can use this same idea to move the filter anywhere withing the datatable that you want.
         $("#filterTable_filter.dataTables_filter").append($("#categoryFilter"));

         //Get the column index for the Category column to be used in the method below ($.fn.dataTable.ext.search.push)
         //This tells datatables what column to filter on when a user selects a value from the dropdown.
         //It's important that the text used here (Category) is the same for used in the header of the column to filter
         var categoryIndex = 0;
         $("#filterTable th").each(function(i) {
            if ($($(this)).html() == "Subject Name") {
               categoryIndex = i;
               return false;
            }
         });

         //Use the built in datatables API to filter the existing rows by the Category column
         $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
               var selectedItem = $('#categoryFilter').val()
               var category = data[categoryIndex];
               if (selectedItem === "" || category.includes(selectedItem)) {
                  return true;
               }
               return false;
            }
         );

         //Set the change event for the Category Filter dropdown to redraw the datatable each time
         //a user selects a new filter.
         $("#categoryFilter").change(function(e) {
            table.draw();
         });

         table.draw();
      });
   </script>

</body>

</html>
