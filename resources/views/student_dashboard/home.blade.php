<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Student Dashboard</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    $student_avatar = !empty(App\Models\User::getStudentAvatarById($user_id)) ? App\Models\User::getStudentAvatarById($user_id) : '15.png';
    ?>
    <!-- Student Dashboard -->
    <link rel="stylesheet" href="assets/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="assets/swiper/swiper.css" />
    <link rel="stylesheet" href="assets/css/app-calendar.css" />
    <link rel="stylesheet" href="assets/fullcalendar/fullcalendar.css" />
    <link rel="stylesheet" href="assets/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="assets/select2/select2.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="assets/js/helpers.js"></script>
    <script src="assets/js/template-customizer.js"></script>
    <script src="assets/js/config.js"></script>
    <link rel="stylesheet" href="assets/css/app-academy.css" />
    <link rel="stylesheet" href="assets/css/cards-advance.css" />
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

    <link rel="stylesheet" href="assets/apex-charts/apex-charts.css" />

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

        .dashboard_page .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .dashboard_page .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .dashboard_page .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .dashboard_page .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
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
    </style>
</head>

<body class="dashboard_page">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('student_dashboard.sidebar')
            <div class="layout-page">
                <!-- Navbar -->
                @include('student_dashboard.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y" id="student_dashboard">
                        <div class="row">
                            <div class="col-12 col-xl-9 col-md-6 mb-3">
                                <div class="row" id="sortable-cards">
                                    <div class="col-lg-4 col-md-6 col-sm-12 padding_0 mb-3">
                                        <div class="card card-border-shadow-primary drag-item cursor-move mb-lg-0 mb-4">
                                            <div class="card-body text-center" style="padding: 12px 16px;">
                                                <div class="d-flex align-items-center mb-2 pb-1">
                                                    <div class="avatar me-2">
                                                        <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-device-laptop ti-xl"></i></span>
                                                    </div>
                                                    <h4 class="ms-1 mb-0">46hrs</h4>
                                                </div>
                                                <p class="mb-1 text-left">Hours Spent</p>
                                                <p class="mb-0 text-left">
                                                    <span class="fw-medium me-1">+8.2%</span>
                                                    <small class="text-muted">than last week</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 padding_0 mb-3">
                                        <div class="card drag-item cursor-move mb-lg-0 mb-4 card-border-shadow-warning">
                                            <div class="card-body text-center" style="padding: 12px 16px;">
                                                <div class="d-flex align-items-center mb-2 pb-1">
                                                    <div class="avatar me-2">
                                                        <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-discount-check ti-xl"></i></span>
                                                    </div>
                                                    <h4 class="ms-1 mb-0">85%</h4>
                                                </div>
                                                <p class="mb-1 text-left">Attendance</p>
                                                <p class="mb-0 text-left">
                                                    <span class="fw-medium me-1">-8.7%</span>
                                                    <small class="text-muted">than last week</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 padding_0 mb-3">
                                        <div class="card drag-item cursor-move mb-lg-0 mb-4 card-border-shadow-danger">
                                            <div class="card-body text-center" style="padding: 12px 16px;">
                                                <div class="d-flex align-items-center mb-2 pb-1">
                                                    <div class="avatar me-2">
                                                        <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-bulb ti-xl"></i></span>
                                                    </div>
                                                    <h4 class="ms-1 mb-0">82%</h4>
                                                </div>
                                                <p class="mb-1 text-left">Test Results</p>
                                                <p class="mb-0 text-left">
                                                    <span class="fw-medium me-1">+4.3%</span>
                                                    <small class="text-muted">than last week</small>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
                                        <div class="card drag-item cursor-move overflow-hidden mb-4">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <div>
                                                    <h5 class="card-title m-0 me-2">Monthly Progress</h5>
                                                </div>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti ti-calendar"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider" />
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <div id="lineAreaChart"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12 mb-4">
                                        <div class="card drag-item cursor-move overflow-hidden">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="card-title m-0 me-2">Assignment Progress</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="p-0 m-0">
                                                    <li class="d-flex mb-3 pb-1">
                                                        <div class="chart-progress me-3" data-color="primary" data-series="72" data-progress_variant="true"></div>
                                                        <div class="row w-100 align-items-center">
                                                            <div class="col-9">
                                                                <div class="me-2">
                                                                    <h6 class="mb-2">User experience Design</h6>
                                                                    <small>120 Tasks</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                                                    <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-3 pb-1">
                                                        <div class="chart-progress me-3" data-color="success" data-series="48" data-progress_variant="true"></div>
                                                        <div class="row w-100 align-items-center">
                                                            <div class="col-9">
                                                                <div class="me-2">
                                                                    <h6 class="mb-2">Basic fundamentals</h6>
                                                                    <small>32 Tasks</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                                                    <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-3 pb-1">
                                                        <div class="chart-progress me-3" data-color="danger" data-series="15" data-progress_variant="true"></div>
                                                        <div class="row w-100 align-items-center">
                                                            <div class="col-9">
                                                                <div class="me-2">
                                                                    <h6 class="mb-2">React native components</h6>
                                                                    <small>182 Tasks</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                                                    <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-3 pb-1">
                                                        <div class="chart-progress me-3" data-color="info" data-series="24" data-progress_variant="true"></div>
                                                        <div class="row w-100 align-items-center">
                                                            <div class="col-9">
                                                                <div class="me-2">
                                                                    <h6 class="mb-2">Basic of music theory</h6>
                                                                    <small>56 Tasks</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                                                    <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-3 pb-1">
                                                        <div class="chart-progress me-3" data-color="danger" data-series="15" data-progress_variant="true"></div>
                                                        <div class="row w-100 align-items-center">
                                                            <div class="col-9">
                                                                <div class="me-2">
                                                                    <h6 class="mb-2">React native components</h6>
                                                                    <small>182 Tasks</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                                                    <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex">
                                                        <div class="chart-progress me-3" data-color="info" data-series="24" data-progress_variant="true"></div>
                                                        <div class="row w-100 align-items-center">
                                                            <div class="col-9">
                                                                <div class="me-2">
                                                                    <h6 class="mb-2">Basic of theory</h6>
                                                                    <small>56 Tasks</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                                                                    <i class="ti ti-chevron-right scaleX-n1-rtl"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12 mb-4 ">
                                        <div class="card drag-item cursor-move">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="card-title m-0 me-2">Performance Tracker</h5>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="doughnutChart" class="chartjs mb-4" data-height="350"></canvas>
                                                <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                                                    <li class="ct-series-0 d-flex flex-column">
                                                        <h5 class="mb-0">N4</h5>
                                                        <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(102, 110, 232); width: 35px; height: 6px"></span>
                                                        <div class="text-muted">80 %</div>
                                                    </li>
                                                    <li class="ct-series-1 d-flex flex-column">
                                                        <h5 class="mb-0">N5</h5>
                                                        <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(40, 208, 148); width: 35px; height: 6px"></span>
                                                        <div class="text-muted">10 %</div>
                                                    </li>
                                                    <li class="ct-series-2 d-flex flex-column">
                                                        <h5 class="mb-0">Speech</h5>
                                                        <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(253, 172, 52); width: 35px; height: 6px"></span>
                                                        <div class="text-muted">10 %</div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-12 col-lg-12 col-sm-12 mb-4">
                                        <div class="card drag-item cursor-move mb-lg-0">
                                            <div class="card-body">
                                                <div class="row mb-3 g-3">
                                                    <div class="col-lg-4">
                                                        <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                                                            <img class="img-fluid" src="assets/img/illustrations/girl-with-laptop.png" alt="Card girl image" width="140" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <h4 class="mb-2 pb-1">Upcoming Course</h4>
                                                        <h6 style="color:#dd3333;">
                                                            Japanese Speech Class
                                                        </h6>
                                                        <p>Japanese online speaking lessons are additional courses planned to improve our students' speaking and listening skills, focusing on fluency and communication skills.</p>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="d-flex">
                                                                    <div class="avatar flex-shrink-0 me-2">
                                                                        <span class="avatar-initial rounded bg-label-primary">
                                                                            <i class="ti ti-calendar-event ti-md"></i>
                                                                        </span>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-0 text-nowrap">17 April 24</h6>
                                                                        <small>Date</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="d-flex">
                                                                    <div class="avatar flex-shrink-0 me-2">
                                                                        <span class="avatar-initial rounded bg-label-primary">
                                                                            <i class="ti ti-clock ti-md"></i>
                                                                        </span>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-0 text-nowrap">32 minutes</h6>
                                                                        <small>Duration</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="text-align:center;">
                                                    <span id="demo" style=""></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12 mb-3">
                                        <div class="card drag-item cursor-move">
                                            <div class="card-header d-flex align-items-center justify-content-between mb-3">
                                                <h5 class="card-title m-0 me-2">My Courses</h5>
                                            </div>
                                            <div class="card-body my_courses">
                                                <ul class="timeline mb-0">
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-primary"></span>
                                                        <div class="timeline-event">
                                                            <div class="timeline-header mb-3">
                                                                <h6 class="mb-0">N4 Advanced</h6>
                                                                <span class="text-muted">3rd April</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-success"></span>
                                                        <div class="timeline-event">
                                                            <div class="timeline-header mb-sm-0 mb-3">
                                                                <h6 class="mb-0">N5 Intemediate</h6>
                                                                <span class="text-muted">4th April</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-danger"></span>
                                                        <div class="timeline-event">
                                                            <div class="timeline-header mb-sm-0 mb-3">
                                                                <h6 class="mb-0">N4 Advanced</h6>
                                                                <span class="text-muted">4th April</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-info"></span>
                                                        <div class="timeline-event">
                                                            <div class="timeline-header">
                                                                <h6 class="mb-0">N5 Intemediate</h6>
                                                                <span class="text-muted">6th April</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="timeline-item timeline-item-transparent">
                                                        <span class="timeline-point timeline-point-dark"></span>
                                                        <div class="timeline-event">
                                                            <div class="timeline-header">
                                                                <h6 class="mb-0">Speech Class</h6>
                                                                <span class="text-muted">6th April</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="timeline-item timeline-item-transparent border-transparent">
                                                        <span class="timeline-point timeline-point-warning"></span>
                                                        <div class="timeline-event">
                                                            <div class="timeline-header">
                                                                <h6 class="mb-0">Speech Class</h6>
                                                                <span class="text-muted">7th April</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-xl-3 col-md-6" style="padding: 0px;">
                                <div class="card mb-4">
                                    <div class="card-body text-center" style="padding:10px;">
                                        <div class="user-avatar-section">
                                            <div class="d-flex align-items-center flex-column">
                                                <img class="img-fluid rounded mb-3 rounded-circle" src="{{asset('assets/img/student_avatar/'.$student_avatar)}}" alt class="h-auto rounded-circle" height="100" width="100" alt="User avatar" />
                                                <div class="user-info text-center">
                                                <h4 class="mb-2"><?php $user_id = Session()->get('loginId');
                                                                        echo $user_name = App\Models\User::getStudentNameByID($user_id);
                                                                        ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex align-items-center justify-content-around my-3 py-1">
                                            <div>
                                                <h6 class="mb-0" style="color:#ff00e0;">Courses</h6>
                                                <small><b>250</b></small>
                                            </div>
                                            <div>
                                                <h6 class="mb-0" style="color:#ff00e0;">Completed</h6>
                                                <small><b>140</b></small>
                                            </div>
                                            <div>
                                                <h6 class="mb-0" style="color:#ff00e0;">Awards</h6>
                                                <small><b>4</b></small>
                                            </div>
                                        </div>
                                        <hr>
                                        <ul class="p-0 m-0 mb-4">
                                            <li class="d-flex mb-3 pb-1 align-items-center">
                                                <div class="badge bg-label-primary me-3 rounded p-2">
                                                    <i class="ti ti-target-arrow ti-sm"></i>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Goal</h6>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <a class="badge badge-center rounded-pill bg-label-primary" href="javascript:void(0);"><i class="ti ti-chevron-right ti-xs"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-3 pb-1 align-items-center">
                                                <div class="badge bg-label-success me-3 rounded p-2">
                                                    <i class="ti ti-notes ti-sm"></i>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Monthly Plan</h6>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <a class="badge badge-center rounded-pill bg-label-success" href="javascript:void(0);"><i class="ti ti-chevron-right ti-xs"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-3 pb-1 align-items-center">
                                                <div class="badge bg-label-info me-3 rounded p-2">
                                                    <i class="ti ti-user-cog ti-sm"></i>
                                                </div>
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Users</h6>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <a class="badge badge-center rounded-pill bg-label-info" href="javascript:void(0);"><i class="ti ti-chevron-right ti-xs"></i></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="app-calendar-wrapper">
                                        <div class="row g-0">
                                            <!-- Calendar Sidebar -->
                                            <div class="">
                                                <!-- inline calendar (flatpicker) -->
                                                <div class="inline-calendar"></div>
                                                <!-- Filter -->
                                                <div class="mb-3 ms-3" style="display:none;">
                                                    <small class="text-small text-muted text-uppercase align-middle">Filter</small>
                                                </div>
                                                <div class="form-check mb-2 ms-3" style="display:none;">
                                                    <input class="form-check-input select-all" type="checkbox" id="selectAll" data-value="all" checked />
                                                    <label class="form-check-label" for="selectAll">View All</label>
                                                </div>
                                                <div class="app-calendar-events-filter ms-3" style="display:none;">
                                                    <div class="form-check form-check-danger mb-2">
                                                        <input class="form-check-input input-filter" type="checkbox" id="select-personal" data-value="personal" checked />
                                                        <label class="form-check-label" for="select-personal">Personal</label>
                                                    </div>
                                                    <div class="form-check mb-2" style="display:none;">
                                                        <input class="form-check-input input-filter" type="checkbox" id="select-business" data-value="business" checked />
                                                        <label class="form-check-label" for="select-business">Business</label>
                                                    </div>
                                                    <div class="form-check form-check-warning mb-2" style="display:none;">
                                                        <input class="form-check-input input-filter" type="checkbox" id="select-family" data-value="family" checked />
                                                        <label class="form-check-label" for="select-family">Family</label>
                                                    </div>
                                                    <div class="form-check form-check-success mb-2" style="display:none;">
                                                        <input class="form-check-input input-filter" type="checkbox" id="select-holiday" data-value="holiday" checked />
                                                        <label class="form-check-label" for="select-holiday">Holiday</label>
                                                    </div>
                                                    <div class="form-check form-check-info" style="display:none;">
                                                        <input class="form-check-input input-filter" type="checkbox" id="select-etc" data-value="etc" checked />
                                                        <label class="form-check-label" for="select-etc">ETC</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Calendar Sidebar -->
                                        <!-- Calendar & Modal -->
                                        <div class="col app-calendar-content">
                                            <div class="shadow-none border-0">
                                                <div class="card-body pb-0" style="display:none;">
                                                    <!-- FullCalendar -->
                                                    <div id="calendar"></div>
                                                </div>
                                            </div>
                                            <div class="app-overlay"></div>
                                            <!-- FullCalendar Offcanvas -->
                                            <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addEventSidebar" aria-labelledby="addEventSidebarLabel">
                                                <div class="offcanvas-header my-1">
                                                    <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Event</h5>
                                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                </div>
                                                <div class="offcanvas-body pt-0">
                                                    <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="eventTitle">Title</label>
                                                            <input type="text" class="form-control" id="eventTitle" name="eventTitle" placeholder="Event Title" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="eventLabel">Label</label>
                                                            <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                                                                <option data-label="primary" value="Business" selected>Business</option>
                                                                <option data-label="danger" value="Personal">Personal</option>
                                                                <option data-label="warning" value="Family">Family</option>
                                                                <option data-label="success" value="Holiday">Holiday</option>
                                                                <option data-label="info" value="ETC">ETC</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="eventStartDate">Start Date</label>
                                                            <input type="text" class="form-control" id="eventStartDate" name="eventStartDate" placeholder="Start Date" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="eventEndDate">End Date</label>
                                                            <input type="text" class="form-control" id="eventEndDate" name="eventEndDate" placeholder="End Date" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="switch">
                                                                <input type="checkbox" class="switch-input allDay-switch" />
                                                                <span class="switch-toggle-slider">
                                                                    <span class="switch-on"></span>
                                                                    <span class="switch-off"></span>
                                                                </span>
                                                                <span class="switch-label">All Day</span>
                                                            </label>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="eventURL">Event URL</label>
                                                            <input type="url" class="form-control" id="eventURL" name="eventURL" placeholder="https://www.google.com" />
                                                        </div>
                                                        <div class="mb-3 select2-primary">
                                                            <label class="form-label" for="eventGuests">Add Guests</label>
                                                            <select class="select2 select-event-guests form-select" id="eventGuests" name="eventGuests" multiple>
                                                                <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                                                                <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                                                                <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                                                <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                                                                <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                                                                <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="eventLocation">Location</label>
                                                            <input type="text" class="form-control" id="eventLocation" name="eventLocation" placeholder="Enter Location" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="eventDescription">Description</label>
                                                            <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
                                                        </div>
                                                        <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4">
                                                            <div>
                                                                <button type="submit" class="btn btn-primary btn-add-event me-sm-3 me-1">Add</button>
                                                                <button type="reset" class="btn btn-label-secondary btn-cancel me-sm-0 me-1" data-bs-dismiss="offcanvas">
                                                                    Cancel
                                                                </button>
                                                            </div>
                                                            <div>
                                                                <button class="btn btn-label-danger btn-delete-event d-none">Delete</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Calendar & Modal -->
                                    </div>
                                </div>
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
                                            </div>
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
            <!-- Core JS -->
            <!-- build:js assets/vendor/js/core.js -->
            <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
            <!-- endbuild -->
            <!-- / Layout page -->
            @include('dashboard.footer')
            <!-- Vendors JS -->
            <script src="assets/sortablejs/sortable.js"></script>
            <!-- Main JS -->
            <script src="assets/js/main.js"></script>
            <!-- Page JS -->
            <!-- Page JS -->
            <script src="assets/js/extended-ui-drag-and-drop.js"></script>
            <script type="text/javascript">
                (function() {
                    const cardEl = document.getElementById('sortable-cards')

                    if (cardEl) {
                        Sortable.create(cardEl);
                    }

                });
            </script>
            <!-- Page JS -->
            <script src="assets/js/app-ecommerce-dashboard.js"></script>
            <script src="assets/js/charts-apex.js"></script>
            <script src="assets/js/dashboards-analytics.js"></script>
            <script src="assets/js/app-calendar-events.js"></script>
            <script src="assets/js/app-calendar.js"></script>
            <script src="assets/fullcalendar/fullcalendar.js"></script>
            <script src="assets/select2/select2.js"></script>
            <script src="assets/flatpickr/flatpickr.js"></script>
            <script src="assets/moment/moment.js"></script>
            <script src="assets/js/app-academy-dashboard.js"></script>
            <script src="assets/apex-charts/apexcharts.js"></script>
            <script src="assets/js/dashboards-analytics.js"></script>
            <script src="assets/js/extended-ui-perfect-scrollbar.js"></script>
            <script src="assets/js/app-academy-dashboard.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <script src="assets/apex-charts/apexcharts.js"></script>
            <script src="assets/js/charts-apex.js"></script>
            <script src="assets/chartjs/chartjs.js"></script>
            <script src="assets/js/charts-chartjs.js"></script>
            <script>
                new DataTable('#example', {
                    pagingType: 'simple_numbers'
                });
            </script>
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


</body>

</html>
