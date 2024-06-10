<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Template</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    $branch_id_jp = 0;
    $branch_id_jp = App\Models\User::getBranchID($user_id);
    $user_role_id = App\Models\User::getRoleID($user_id);
    ?>
    <?php
    if (isset($org_logo)) { ?>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/organization_logo/'.$org_logo)}}" />
    <?php  } else { ?>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/edusama_newlogo.png') }}" />
    <?php } ?>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />
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


    <!-- Template -->
    <link rel="stylesheet" href="{{ asset('assets/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/jquery-timepicker/jquery-timepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/pickr/pickr-themes.css') }}" />
    <!-- Template -->

    <script src="{{ asset('assets/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <style type="text/css">
        .list_templates .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .list_templates .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .list_templates .form-check-input:checked,
        .list_templates .form-check-input[type=checkbox]:indeterminate,
        {
        background-color: <?php echo $org_color; ?> !important;
        border-color: <?php echo $org_color; ?> !important;
        }

        .list_templates .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .list_templates .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .list_templates .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .list_templates .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .list_templates .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .list_templates .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .list_templates .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .list_templates i {
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

        .list_templates #template-customizer .template-customizer-open-btn {
            display: none;
        }
    </style>
</head>

<body class="list_templates">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('dashboard.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('dashboard.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="app-ecommerce">
                            <div class="d-flex flex-column justify-content-center">
                                <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">Add Template</h4>
                            </div>
                            <p style="height: 2px;"></p>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card mb-4">
                                        <p style="height: 2px;"></p>
                                        <form method="POST" action="{{route('template_add')}}" id="form_submit" onsubmit="return false">
                                            @csrf
                                            <div class="bs-stepper wizard-icons wizard-icons-example">
                                                <div class="bs-stepper-header" style="padding-top: 0px;">
                                                    <div class="step" data-target="#step_1">
                                                        <button type="button" class="step-trigger">
                                                            <span class="bs-stepper-label">Properties</span>
                                                        </button>
                                                    </div>
                                                    <div class="line">
                                                        <i class="ti ti-chevron-right"></i>
                                                    </div>
                                                    <div class="step" data-target="#step_2">
                                                        <button type="button" class="step-trigger">
                                                            <span class="bs-stepper-label">Settings</span>
                                                        </button>
                                                    </div>
                                                    <div class="line">
                                                        <i class="ti ti-chevron-right"></i>
                                                    </div>
                                                    <div class="step" data-target="#step_3">
                                                        <button type="button" class="step-trigger">
                                                            <span class="bs-stepper-label">Timing</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="bs-stepper-content">
                                                    <form onSubmit="return false">
                                                        <div id="step_1" class="content">
                                                            <div class="row g-3">
                                                                <div class="col-sm-6">
                                                                    <label class="form-label" for="branch_id">Branch</label><span class="text-danger">*</span>
                                                                    <select id="branch_id" name="branch_id" class="select2 form-select">
                                                                        <option value="">Select Branch</option>
                                                                        @foreach ($branches as $branch)
                                                                        <?php if (old('branch_id') == $branch->id)
                                                                            $sele = 'selected';
                                                                        else
                                                                            $sele = '';
                                                                        ?>
                                                                        <?php
                                                                        $primary_roles = array(1, 2, 3, 4);
                                                                        if (!in_array($user_role_id, $primary_roles)) {
                                                                            if ($branch_id_jp == $branch->id)
                                                                                $sele = 'selected';
                                                                            else
                                                                                $sele = '';
                                                                        }
                                                                        ?>
                                                                        <option <?php echo $sele; ?> value="{{$branch->id}}">{{$branch->branch_name}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('branch_id')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="template_name" class="form-label">Template Name</label>
                                                                    <input class="form-control" type="text" id="template_name" name="template_name" placeholder="Template Name" value="{{old('template_name')}}" autofocus />
                                                                    @error('template_name')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-6 mb-3">
                                                                    <label for="tempduration" class="form-label">Duration</label>
                                                                    <select class="form-select" name="duration" id="duration">
                                                                        <option value="">Select Duration</option>
                                                                        <option <?php if (old('duration') == '3 Months') echo 'selected'; ?> value="3 Months">3 Months</option>
                                                                        <option <?php if (old('duration') == '6 Months') echo 'selected'; ?> value="6 Months">6 Months</option>
                                                                        <option <?php if (old('duration') == '1 Year') echo 'selected'; ?> value="1 Year">1 year</option>
                                                                    </select>
                                                                    @error('duration')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-6 mb-3">
                                                                    <label for="bs-rangepicker-single" class="form-label">Start Date</label>
                                                                    <input type="text" id="flatpickr-date1" name="start_date" class="form-control" value="{{ old('start_date') }}" placeholder="DD-MM-YYYY" />
                                                                    @error('start_date')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-6 mb-3">
                                                                    <label for="bs-rangepicker-single" class="form-label">End Date</label>
                                                                    <input type="text" id="flatpickr-date2" name="end_date" class="form-control" value="{{ old('end_date')}}" placeholder="DD-MM-YYYY" />
                                                                    @error('end_date')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button class="btn btn-primary btn-next">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                                        <i class="ti ti-arrow-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="step_2" class="content">
                                                            <div class="row g-3">
                                                                <div class="col-sm-6">
                                                                    <label for="offline_course_module" class="form-label">Offline Course Module</label>

                                                                    <select class="form-select" name="offline_course_module">
                                                                        <option value="">Select</option>
                                                                        <option <?php if (old('offline_course_module') == 1) echo 'selected' ?> value="1">Yes</option>
                                                                        <option <?php if (old('offline_course_module') == 2) echo 'selected' ?> value="2">No</option>
                                                                    </select>
                                                                    @error('offline_course_module')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="quiz_exam_module" class="form-label">Quiz and Exam Module</label>
                                                                    <select class="form-select" name="quiz_exam_module">
                                                                        <option value="">Select</option>
                                                                        <option <?php if (old('quiz_exam_module') == 1) echo 'selected' ?> value="1">Yes</option>
                                                                        <option <?php if (old('quiz_exam_module') == 2) echo 'selected' ?> value="2">No</option>
                                                                    </select>
                                                                    @error('quiz_exam_module')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="assessment_course_module" class="form-label">Assesments Module</label>
                                                                    <select class="form-select" name="assessment_course_module">
                                                                        <option value="">Select</option>
                                                                        <option <?php if (old('assessment_course_module') == 1) echo 'selected' ?> value="1">Yes</option>
                                                                        <option <?php if (old('assessment_course_module') == 2) echo 'selected' ?> value="2">No</option>
                                                                    </select>
                                                                    @error('assessment_course_module')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="library_module" class="form-label">Library Module</label>
                                                                    <select class="form-select" name="library_module">
                                                                        <option value="">Select</option>
                                                                        <option <?php if (old('library_module') == 1) echo 'selected' ?> value="1">Yes</option>
                                                                        <option <?php if (old('library_module') == 2) echo 'selected' ?> value="2">No</option>
                                                                    </select>
                                                                    @error('library_module')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="attendance_module" class="form-label">Attendance Module</label>
                                                                    <select class="form-select" name="attendance_module">
                                                                        <option value="">Select</option>
                                                                        <option <?php if (old('attendance_module') == 1) echo 'selected' ?> value="1">Yes</option>
                                                                        <option <?php if (old('attendance_module') == 2) echo 'selected' ?> value="2">No</option>
                                                                    </select>
                                                                    @error('attendance_module')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label for="online_course_module" class="form-label">Online Course Module</label>
                                                                    <select class="form-select" name="online_course_module">
                                                                        <option value="">Select</option>
                                                                        <option <?php if (old('online_course_module') == 1) echo 'selected' ?> value="1">Yes</option>
                                                                        <option <?php if (old('online_course_module') == 2) echo 'selected' ?> value="2">No</option>
                                                                    </select>
                                                                    @error('online_course_module')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button class="btn btn-label-secondary btn-prev">
                                                                        <i class="ti ti-arrow-left me-sm-1"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button class="btn btn-primary btn-next">
                                                                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                                        <i class="ti ti-arrow-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="step_3" class="content">
                                                            @error('week_days_status')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <div class="row g-3">
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-3 col-form-label" for="classmonday">Monday</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="hidden" name="weak_days[]" value="monday" />
                                                                        <input type="time" class="form-control" name="start[]" placeholder="" value="{{ old('start.0') }}" />

                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" id="mondayend" name="end[]" placeholder="" value="{{ old('end.0') }}" />
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <p style="margin-bottom: 7px;"></p>
                                                                        <input type="checkbox" class="form-check-input" id="mondaycheck" name="week_days_status[]" value="1" placeholder="" />
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-3 col-form-label" for="classtuesday">Tuesday</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="hidden" name="weak_days[]" value="tuesday" />

                                                                        <input type="time" class="form-control" id="tuesdaystart" name="start[]" placeholder="" value="{{ old('start.1') }}" />
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" id="tuesdayend" name="end[]" placeholder="" value="{{ old('end.1') }}" />
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <p style="margin-bottom: 7px;"></p>
                                                                        <input type="checkbox" class="form-check-input" id="tuesdaycheck" name="week_days_status[]" value="2" placeholder="" />
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-3 col-form-label" for="classwednesday">Wednesday</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="hidden" name="weak_days[]" value="wednesday" />

                                                                        <input type="time" class="form-control" id="wednesdaystart" name="start[]" placeholder="" value="{{ old('start.2') }}" />
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" id="wednesdayend" name="end[]" placeholder="" value="{{ old('end.2') }}" />
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <p style="margin-bottom: 7px;"></p>
                                                                        <input type="checkbox" class="form-check-input" id="wednesdaycheck" name="week_days_status[]" value="3" placeholder="" />
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-3 col-form-label" for="classthursday">Thursday</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="hidden" name="weak_days[]" value="thursday" />

                                                                        <input type="time" class="form-control" id="thursdaystart" name="start[]" placeholder="" value="{{ old('start.3') }}" />
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" id="thursdayend" name="end[]" placeholder="" value="{{ old('end.3') }}" />
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <p style="margin-bottom: 7px;"></p>
                                                                        <input type="checkbox" class="form-check-input" id="thursdaycheck" name="week_days_status[]" value="4" placeholder="" />
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-3 col-form-label" for="classfriday">Friday</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="hidden" name="weak_days[]" value="friday" />

                                                                        <input type="time" class="form-control" id="fridaystart" name="start[]" placeholder="" value="{{ old('start.4') }}" />
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" id="fridayend" name="end[]" placeholder="" value="{{ old('end.4') }}" />
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <p style="margin-bottom: 7px;"></p>
                                                                        <input type="checkbox" class="form-check-input" id="fridaycheck" name="week_days_status[]" value="5" placeholder="" />
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-3 col-form-label" for="classsaturday">Saturday</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="hidden" name="weak_days[]" value="saturday" />

                                                                        <input type="time" class="form-control" id="saturdaystart" name="start[]" placeholder="" value="{{ old('start.5') }}" />
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" id="saturdayend" name="end[]" placeholder="" value="{{ old('end.5') }}" />
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <p style="margin-bottom: 7px;"></p>
                                                                        <input type="checkbox" class="form-check-input" id="saturdaycheck" name="week_days_status[]" value="6" placeholder="" />
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-3 col-form-label" for="classsunday">Sunday</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="hidden" name="weak_days[]" value="sunday" />

                                                                        <input type="time" class="form-control" id="sundaystart" name="start[]" placeholder="" value="{{ old('start.6') }}" />
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="time" class="form-control" id="sundayend" name="end[]" placeholder="" value="{{ old('end.6') }}" />
                                                                    </div>
                                                                    <div class="col-sm-1">
                                                                        <p style="margin-bottom: 7px;"></p>
                                                                        <input type="checkbox" class="form-check-input" id="sundaycheck" name="week_days_status[]" value="7" placeholder="" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 d-flex justify-content-between">
                                                                    <button class="btn btn-label-secondary btn-prev">
                                                                        <i class="ti ti-arrow-left me-sm-1"></i>
                                                                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                    </button>
                                                                    <button onclick="myFunction()" class="btn btn-success btn-submit">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </form>
                                        <!-- /Account -->
                                    </div>
                                </div>
                                <!-- /Second column -->
                                <!-- Second column -->
                                <!-- /Second column -->
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->
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
    <script src="{{ asset('assets/js/jquery.js')}}"></script>
    <script src="{{ asset('assets/js/popper.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/js/node-waves.js')}}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('assets/js/hammer.js')}}"></script>
    <script src="{{ asset('assets/js/i18n.js')}}"></script>
    <script src="{{ asset('assets/js/typeahead.js')}}"></script>
    <script src="{{ asset('assets/js/menu.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Template -->
    <script src="{{ asset('assets/js/form-basic-inputs.js')}}"></script>
    <script src="{{ asset('assets/bs-stepper/bs-stepper.js')}}"></script>
    <script src="{{ asset('assets/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{ asset('assets/select2/select2.js')}}"></script>
    <script src="{{ asset('assets/js/form-wizard-icons.js')}}"></script>
    <script src="{{ asset('assets/moment/moment.js')}}"></script>
    <script src="{{ asset('assets/flatpickr/flatpickr.js')}}"></script>
    <script src="{{ asset('assets/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('assets/bootstrap-daterangepicker/bootstrap-daterangepicker.js')}}"></script>
    <script src="{{ asset('assets/jquery-timepicker/jquery-timepicker.js')}}"></script>
    <script src="{{ asset('assets/pickr/pickr.js')}}"></script>

    <script src="{{ asset('assets/flatpickr/flatpickr.js')}}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#flatpickr-date1').change(function() {
                var start_date = this.value;
                var duration = $('#duration').val();
                //alert(start_date+duration);
                var add_month;
                if (duration == '3 Months')
                    add_month = 3;
                if (duration == '6 Months')
                    add_month = 6;
                if (duration == '1 Year')
                    add_month = 12;

                var date_jp = new Date(this.value.replace(/(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));

                var Monthsafter = date_jp.setMonth(date_jp.getMonth() + add_month);

                const date = new Date(Monthsafter);

                const day = date.getDate();
                const month = date.getMonth()+1; // JavaScript months are zero-indexed
                const year = date.getFullYear();

                const formattedDate = `${day}-${month}-${year}`;
                // var end_dd = date.toISOString().split('T')[0];


                // const month = date.format('M');

                $('#flatpickr-date2').val(formattedDate);

            });

        });
        $(function() {
            var bsRangePickerTime = $('.bs-rangepicker-time'),
                bsRangePickerCancelBtn = document.getElementsByClassName('cancelBtn');


            if (bsRangePickerTime.length) {
                bsRangePickerTime.daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    locale: {
                        format: 'MM/DD/YYYY h:mm A'
                    },
                    opens: isRtl ? 'left' : 'right'
                });
            }
            for (var i = 0; i < bsRangePickerCancelBtn.length; i++) {
                bsRangePickerCancelBtn[i].classList.remove('btn-default');
                bsRangePickerCancelBtn[i].classList.add('btn-label-primary');
            }




        });

        function myFunction() {
            //alert("test");
            document.getElementById('form_submit').setAttribute('onsubmit', '')

        }
    </script>
</body>

</html>
