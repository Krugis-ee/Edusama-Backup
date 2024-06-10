<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Edit ClassRoom</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>

    <link rel="stylesheet" href="{{ asset('assets/bs-stepper/bs-stepper.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-select/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/select2/select2.css')}}" />

    <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.css')}}" />
    <style type="text/css">
        .add_class .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_class .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .add_class .form-check-input:checked,
        .add_class .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_class .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_class .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .add_class .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_class .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_class .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_class .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .add_class .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .add_class i {
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

        .add_class #template-customizer .template-customizer-open-btn {
            display: none;
        }

        #formAccountSettings .content {
            text-align: left;
        }

        .classduration .controls {
            top: 43% !important;
            left: 86% !important;
        }

        .classduration .scroll-btn:nth-child(1) {
            top: -10px !important;
            min-height: 10px !important;
            height: 10px !important;
        }

        .classduration .scroll-btn:nth-child(2) {
            top: 4px !important;
            min-height: 10px !important;
            height: 10px !important;
            transform: translateY(0px);
        }

        .html-duration-picker {
            display: block !important;
            width: 100% !important;
            padding: 0.422rem 0.875rem !important;
            font-size: 0.9375rem !important;
            font-weight: 400 !important;
            line-height: 1.5 !important;
            color: #6f6b7d !important;
            appearance: none !important;
            background-color: #fff !important;
            background-clip: padding-box !important;
            border: var(--bs-border-width) solid #dbdade !important;
            border-radius: var(--bs-border-radius) !important;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
        }

        .html-duration-picker-input-controls-wrapper {
            width: auto !important;
        }

        .html-duration-picker:focus {
            color: #6f6b7d;
            background-color: #fff;
            border-color: #7367f0;
            outline: 0;
            box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
        }

        .html-duration-picker-input-controls-wrapper .html-duration-picker {
            text-align: left !important;
        }

        .add_class .nav-pills .nav-link.active,
        .add_class .nav-pills .nav-link.active:hover,
        .add_class .nav-pills .nav-link.active:focus {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .add_class .nav-pills .nav-link:hover {
            color: <?php echo $org_color; ?> !important;
        }

        .add_class .bs-stepper .step.crossed .step-trigger .bs-stepper-circle {
            background-color: #fef3f3 !important;
            color: <?php echo $org_color; ?> !important;
        }

        .add_class .bs-stepper .step.active .bs-stepper-circle {
            background-color: <?php echo $org_color; ?>;
            color: #fff;
        }

        .remove_button {
            border-color: transparent !important;
            color: #ea5455 !important;
            margin-top: 26px;
        }
    </style>
</head>

<body class="add_class">
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
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">Edit ClassRoom</h4>
                                </div>
                            </div>
                            <!-- Add Product -->
                            <p style="height: 2px;"></p>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="nav-align-top mb-4">
                                        <ul class="nav nav-pills mb-3 nav-fill addstudent" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($slug == 'manual_updation') echo 'active'; ?>">
                                                    <i class="menu-icon tf-icons ti ti-smart-home"></i>&nbsp; Manual Updation </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if ($slug == 'using_template') echo 'active'; ?>">
                                                    <i class="menu-icon tf-icons ti ti-brand-slack"></i>&nbsp; Using Template </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade <?php if ($slug == 'manual_updation') echo 'show active'; ?>" id="navs-pills-justified-manual" role="tabpanel">
                                                <div class="col-12 col-lg-12">
                                                    <div class="mb-4">
                                                        <div class="card-body">
                                                            @if(session()->has('success'))
                                                            <div class="alert alert-success">
                                                                {{ session()->get('success') }}
                                                            </div>
                                                            @endif
                                                            @if(session()->has('error'))
                                                            <div class="alert alert-danger">
                                                                {{ session()->get('error') }}
                                                            </div>
                                                            @endif
                                                            <form id="form_submit" method="POST" action="{{route('update_by_manual_updation');}}" onsubmit="return false">
                                                                @csrf
                                                                <input type="hidden" id="ajax_url_jp" value="{{URL::to('/')}}" />
                                                                <input type="hidden" name="record_id" id="record_id" value="{{ $class_room->id }}" />
                                                                <div class="col-12 mb-4">
                                                                    <div class="bs-stepper wizard-vertical wizard-numbered vertical mt-2">
                                                                        <div class="bs-stepper-header">
                                                                            <div class="step" data-target="#class-details-1">
                                                                                <button type="button" class="step-trigger">
                                                                                    <span class="bs-stepper-circle">1</span>
                                                                                    <span class="bs-stepper-label">
                                                                                        <span class="bs-stepper-title">Class Details</span>
                                                                                        <span class="bs-stepper-subtitle">Setup Class Details</span>
                                                                                    </span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="line"></div>
                                                                            <div class="step" data-target="#class-module-1">
                                                                                <button type="button" class="step-trigger">
                                                                                    <span class="bs-stepper-circle">2</span>
                                                                                    <span class="bs-stepper-label">
                                                                                        <span class="bs-stepper-title">Modules</span>
                                                                                        <span class="bs-stepper-subtitle">Choose Class Modules</span>
                                                                                    </span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="line"></div>
                                                                            <div class="step" data-target="#class-schedule-1">
                                                                                <button type="button" class="step-trigger">
                                                                                    <span class="bs-stepper-circle">3</span>
                                                                                    <span class="bs-stepper-label">
                                                                                        <span class="bs-stepper-title">Schedule</span>
                                                                                        <span class="bs-stepper-subtitle">Schedule Class</span>
                                                                                    </span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="line"></div>
                                                                            <div class="step" data-target="#class-integration-1">
                                                                                <button onclick="getValue()" type="button" class="step-trigger">
                                                                                    <span class="bs-stepper-circle">4</span>
                                                                                    <span class="bs-stepper-label">
                                                                                        <span class="bs-stepper-title">Integration</span>
                                                                                        <span class="bs-stepper-subtitle">Assign Subject & Teachers</span>
                                                                                    </span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="line"></div>

                                                                        </div>
                                                                        <div class="bs-stepper-content">
                                                                            <!-- Account Details -->
                                                                            <div id="class-details-1" class="content">
                                                                                <div class="content-header mb-3"></div>
                                                                                <div class="row g-3">
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <label class="form-label" for="branch_id">Branch</label>
                                                                                        <select id="branch_id_mc" name="branch_id" class="form-select">
                                                                                            <option value="">Select Branch</option>
                                                                                            @foreach ($branches as $branch)
                                                                                            <?php
                                                                                            $sele = '';
                                                                                            // if (isset($_GET['branch_id'])) {
                                                                                            if ((isset($_GET['branch_id']) ? $_GET['branch_id'] : $class_room->branch_id) == $branch->id)
                                                                                                $sele = 'selected';
                                                                                            else
                                                                                                $sele = '';
                                                                                            // }

                                                                                            echo '<option ' . $sele . ' value="' . $branch->id . '">' . $branch->branch_name . '</option>'; ?>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        @error('branch_id')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <label for="addclassroom" class="form-label">Classroom Name</label>
                                                                                        <input class="form-control" type="text" name="classroom_name" value="{{ $class_room->class_room_name }}" id="addclassroom" />
                                                                                        @error('classroom_name')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-6 mb-3">
                                                                                        <label for="tempduration" class="form-label">Duration</label>
                                                                                        <select class="form-select" name="duration" id="duration">
                                                                                            <option value="">Select Duration</option>
                                                                                            <option <?php if ($class_room->duration == '3 Months') echo 'selected'; ?> value="3 Months">3 Months</option>
                                                                                            <option <?php if ($class_room->duration == '6 Months') echo 'selected'; ?> value="6 Months">6 Months</option>
                                                                                            <option <?php if ($class_room->duration == '1 Year') echo 'selected'; ?> value="1 Year">1 year</option>
                                                                                        </select>
                                                                                        @error('duration')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <label for="bs-rangepicker-single" class="form-label">Start Date</label>
                                                                                        <input type="text" name="start_date" class="form-control" value="{{date('d-m-Y',strtotime($class_room->start_date))}}" placeholder="DD-MM-YYYY" id="flatpickr-date1" />
                                                                                        @error('start_date')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="mb-3 col-md-6">
                                                                                        <label for="bs-rangepicker-single" class="form-label">End Date</label>
                                                                                        <input type="text" name="end_date" class="form-control" value="{{date('d-m-Y',strtotime($class_room->end_date))}}" placeholder="DD-MM-YYYY" id="flatpickr-date2"/>
                                                                                        @error('end_date')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-6 mb-3">
                                                                                        <label class="form-label">Number of students</label>
                                                                                        <input type="text" id="number_of_students_mc" name="number_of_students_mc" value="{{$class_room->number_of_students}}" class="form-control" />
                                                                                        @error('number_of_students_mc')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-12">
                                                                                        <button class="btn btn-primary btn-next" style="float: right;">
                                                                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                                                            <i class="ti ti-arrow-right"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Personal Info -->
                                                                            <div id="class-module-1" class="content">
                                                                                <div class="content-header mb-3"></div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-sm-6 mb-3">
                                                                                        <label for="offlinecoursemodule" class="form-label">Offline Course Module</label>
                                                                                        <select class="form-select" name="offline_course_module" id="offlinecoursemodule">
                                                                                            <option value="">Select</option>
                                                                                            <option <?php if ($class_room->offline_course_module == 1) echo 'selected' ?> value="1">Yes</option>
                                                                                            <option <?php if ($class_room->offline_course_module == 2) echo 'selected' ?> value="2">No</option>
                                                                                        </select>
                                                                                        @error('offline_course_module')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-6 mb-3">
                                                                                        <label for="quizexammodule" class="form-label">Quiz and Exam Module</label>
                                                                                        <select class="form-select" name="quiz_exam_module" id="quizexammodule">
                                                                                            <option value="">Select</option>
                                                                                            <option <?php if ($class_room->quiz_exam_module == 1) echo 'selected' ?> value="1">Yes</option>
                                                                                            <option <?php if ($class_room->quiz_exam_module == 2) echo 'selected' ?> value="2">No</option>
                                                                                        </select>
                                                                                        @error('quiz_exam_module')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-6 mb-3">
                                                                                        <label for="assesmentsmodule" class="form-label">Assesments Module</label>
                                                                                        <select class="form-select" name="assessment_course_module" id="assesmentsmodule">
                                                                                            <option value="">Select</option>
                                                                                            <option <?php if ($class_room->assessment_course_module == 1) echo 'selected' ?> value="1">Yes</option>
                                                                                            <option <?php if ($class_room->assessment_course_module == 2) echo 'selected' ?> value="2">No</option>
                                                                                        </select>
                                                                                        @error('assessment_course_module')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-6 mb-3">
                                                                                        <label for="librarymodule" class="form-label">Library Module</label>
                                                                                        <select class="form-select" name="library_module" id="librarymodule">
                                                                                            <option value="">Select</option>
                                                                                            <option <?php if ($class_room->library_module == 1) echo 'selected' ?> value="1">Yes</option>
                                                                                            <option <?php if ($class_room->library_module == 2) echo 'selected' ?> value="2">No</option>
                                                                                        </select>
                                                                                        @error('library_module')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-6 mb-3">
                                                                                        <label for="attendancemodule" class="form-label">Attendance Module</label>
                                                                                        <select class="form-select" name="attendance_module" id="attendancemodule">
                                                                                            <option value="">Select</option>
                                                                                            <option <?php if ($class_room->attendance_module == 1) echo 'selected' ?> value="1">Yes</option>
                                                                                            <option <?php if ($class_room->attendance_module == 2) echo 'selected' ?> value="2">No</option>
                                                                                        </select>
                                                                                        @error('attendance_module')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-sm-6 mb-3">
                                                                                        <label for="onlinecoursemodule" class="form-label">Online Course Module</label>
                                                                                        <select class="form-select" name="online_course_module" id="onlinecoursemodule">
                                                                                            <option value="">Select</option>
                                                                                            <option <?php if ($class_room->online_course_module == 1) echo 'selected' ?> value="1">Yes</option>
                                                                                            <option <?php if ($class_room->online_course_module == 2) echo 'selected' ?> value="2">No</option>
                                                                                        </select>
                                                                                        @error('online_course_module')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="col-12 d-flex justify-content-between">
                                                                                        <button class="btn btn-label-secondary btn-prev">
                                                                                            <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                                        </button>
                                                                                        <button class="btn btn-primary btn-next">
                                                                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                                                            <i class="ti ti-arrow-right"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Social Links -->
                                                                            <div id="class-schedule-1" class="content">
                                                                                <div class="content-header mb-3"></div>
                                                                                <div class="row g-3">
                                                                                    @error('day_status')
                                                                                    <p class="text-danger">{{ $message }}</p>
                                                                                    @enderror
                                                                                    <!-- JP -->
                                                                                    <?php
                                                                                    $weakdays = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
                                                                                    for ($i = 0; $i < 7; $i++) {
                                                                                        $from_time = '';
                                                                                        $to_time = '';
                                                                                        $check_status = '';
                                                                                        foreach ($subj_timings as $subj_timing) {

                                                                                            if ($subj_timing['weakday'] == $weakdays[$i]) {
                                                                                                $from_time = $subj_timing['from_time'];
                                                                                                $to_time = $subj_timing['to_time'];
                                                                                                $check_status = 'checked';
                                                                                            }
                                                                                        }
                                                                                    ?>

                                                                                        <div class="row mb-3">
                                                                                            <label class="col-sm-3 col-form-label" for="classmonday"><?php echo ucfirst($weakdays[$i]); ?></label>
                                                                                            <div class="col-sm-4">
                                                                                                <input type="time" class="form-control" id="" name="from_time[]" value="{{ $from_time }}" />
                                                                                            </div>
                                                                                            <div class="col-sm-4">
                                                                                                <input type="time" class="form-control" id="" name="to_time[]" value="{{ $to_time }}" />
                                                                                            </div>
                                                                                            <div class="col-sm-1">
                                                                                                <p style="margin-bottom: 7px;"></p>
                                                                                                <input type="hidden" name="week_days[]" value="<?php echo $weakdays[$i]; ?>" />
                                                                                                <input type="checkbox" class="form-check-input" name="day_status[]" id="mondaycheck" <?php echo $check_status; ?> value="<?php echo $i + 1; ?>" />
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                    <!-- JP -->
                                                                                    <div class="col-12 d-flex justify-content-between">
                                                                                        <button class="btn btn-label-secondary btn-prev">
                                                                                            <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                                        </button>
                                                                                        <button onclick="getValue()" class="btn btn-primary btn-next">
                                                                                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                                                            <i class="ti ti-arrow-right"></i>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="class-integration-1" class="content">
                                                                                <div class="content-header mb-3"></div>
                                                                                <div class="row">
                                                                                    <div class="group-a" id="group_manual">
                                                                                        <div class="group-b">

                                                                                            <?php
                                                                                            $count = 0;
                                                                                            $subject_ids = $subj_teachers;
                                                                                            if ($subj_teachers)
                                                                                                $count = count($subj_teachers);

                                                                                            if ($count == 0) {
                                                                                            ?>
                                                                                                <div class="row repeat_row">
                                                                                                    <div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0">
                                                                                                        <label for="subject_id_mc" class="form-label">Subject Name</label>
                                                                                                        <select class="form-select subject_id_mc" name="subject_id_mc[]" aria-label="Default select example">
                                                                                                            <option value="">Select Subject</option>
                                                                                                            <?php
                                                                                                            if (count($subjects) > 0) {
                                                                                                                foreach ($subjects as $subject) {
                                                                                                                    if ($subject->id == old('subject_id_mc.0'))
                                                                                                                        $sel = 'selected';
                                                                                                                    else
                                                                                                                        $sel = '';
                                                                                                                    echo '<option ' . $sel . ' value="' . $subject->id . '">' . $subject->subject_name . '</option>';
                                                                                                                }
                                                                                                            } ?>
                                                                                                        </select>
                                                                                                        @error('subject_id_mc.0')
                                                                                                        <span style="color:red;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                    <div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0">
                                                                                                        <label for="teacher_id_mc" class="form-label">Teacher Name</label>
                                                                                                        <select class="form-select teacher_id_mc" name="teacher_id_mc[]" aria-label="Default select example">
                                                                                                            <option value="">Select Teacher</option>
                                                                                                            <?php
                                                                                                            if (count($teachers) > 0) {
                                                                                                                foreach ($teachers as $teacher) {
                                                                                                                    if ($teacher->id == old('teacher_id_mc.0'))
                                                                                                                        $sel = 'selected';
                                                                                                                    else
                                                                                                                        $sel = '';
                                                                                                                    echo '<option ' . $sel . ' value="' . $teacher->id . '">' . $teacher->first_name . ' ' . $teacher->last_name . '</option>';
                                                                                                                }
                                                                                                            } ?>
                                                                                                        </select>
                                                                                                        @error('teacher_id_mc.0')
                                                                                                        <span style="color:red;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                    
                                                                                                </div>
                                                                                            <?php } ?>
                                                                                            <?php
                                                                                            if ($count > 0) {
                                                                                                for ($i = 0; $i < $count; $i++) {
                                                                                            ?>
                                                                                                    <div class="row repeat_row">
                                                                                                        <div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0">
                                                                                                            <label for="subject_id_mc" class="form-label">Subject Name</label>
                                                                                                            <select class="form-select subject_id_mc" name="subject_id_mc[]" aria-label="Default select example">
                                                                                                                <option value="">Select Subject</option>
                                                                                                                <?php
                                                                                                                if (count($subjects) > 0) {
                                                                                                                    foreach ($subjects as $subject) {
                                                                                                                        if ($subject->id == $subj_teachers[$i]['subject_id'])
                                                                                                                            $sel = 'selected';
                                                                                                                        else
                                                                                                                            $sel = '';
                                                                                                                        echo '<option ' . $sel . ' value="' . $subject->id . '">' . $subject->subject_name . '</option>';
                                                                                                                    }
                                                                                                                } ?>
                                                                                                            </select>
                                                                                                            @error('subject_id_mc.'.$i)
                                                                                                            <span style="color:red;">{{ $message }}</span>
                                                                                                            @enderror
                                                                                                        </div>
                                                                                                        <div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0">
                                                                                                            <label for="teacher_id_mc" class="form-label">Teacher Name</label>
                                                                                                            <select class="form-select teacher_id_mc" name="teacher_id_mc[]" aria-label="Default select example">
                                                                                                                <option value="">Select Teacher</option>
                                                                                                                <?php
                                                                                                                if (count($teachers) > 0) {
                                                                                                                    foreach ($teachers as $teacher) {
                                                                                                                        if ($teacher->id == $subj_teachers[$i]['teacher_id'])
                                                                                                                            $sel = 'selected';
                                                                                                                        else
                                                                                                                            $sel = '';
                                                                                                                        echo '<option ' . $sel . ' value="' . $teacher->id . '">' . $teacher->first_name . ' ' . $teacher->last_name . '</option>';
                                                                                                                    }
                                                                                                                } ?>
                                                                                                            </select>
                                                                                                            @error('teacher_id_mc.'.$i)
                                                                                                            <span style="color:red;">{{ $message }}</span>
                                                                                                            @enderror
                                                                                                        </div>
																										<?php if($i!=0) { ?>
                                                                                                        <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                                                                                                            <br><a href="javascript:void(0);" class="remove_button remove_button_manual"><i class="fa-solid fa-circle-minus"></i></a>
                                                                                                        </div>
                                                                                                        <hr />
																										<?php } ?>
                                                                                                    </div>
                                                                                            <?php }
                                                                                            } ?>


                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="mb-4">
                                                                                        <button type="button" id="add_button_manual" class="add_button btn btn-success" style="float: right;">
                                                                                            <i class="ti ti-plus me-1"></i>
                                                                                            <span class="align-middle">Add</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="col-12 d-flex justify-content-between">
                                                                                        <button class="btn btn-label-secondary btn-prev">
                                                                                            <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                                        </button>
                                                                                        <!--button class="btn btn-primary btn-next">
                                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                                                    <i class="ti ti-arrow-right"></i>
                                                </button-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="class-zoomlink-1" class="content">
                                                                                <div class="content-header mb-3"></div>
                                                                                <div class="row g-3">

                                                                                    <div class="mb-3 col-md-6"></div>

                                                                                    <div class="col-12 d-flex justify-content-between">
                                                                                        <button class="btn btn-label-secondary btn-prev">
                                                                                            <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                                                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <button type="submit" onclick="myFunction()" class="btn btn-primary me-2">Submit</button>
                                                                    <a href="{{route('index_list')}}" class="btn btn-label-secondary">Cancel</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade <?php if ($slug == 'using_template') echo 'show active'; ?>" id="navs-pills-justified-template" role="tabpanel">
                                                <div class="col-12 col-lg-12">
                                                    <div class="row mb-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                @if(session()->has('success'))
                                                                <div class="alert alert-success">
                                                                    {{ session()->get('success') }}
                                                                </div>
                                                                @endif
                                                                @if(session()->has('error'))
                                                                <div class="alert alert-danger">
                                                                    {{ session()->get('error') }}
                                                                </div>
                                                                @endif
                                                                <form id="nameform" method="POST" action="{{ route('update_using_template') }}">
                                                                    @csrf
                                                                    <input type="hidden" id="ajax_url_jp" value="{{URL::to('/')}}" />
                                                                    <input type="hidden" name="record_id" id="record_id" value="{{ $class_room->id }}" />
                                                                    <div class="group-a" id="group_template">
                                                                        <div class="group-b">
                                                                            <div class="row">
                                                                                <div class="mb-3 col-md-6">
                                                                                    <label for="branch_id_ut" class="form-label">Branch</label>
                                                                                    <select class="form-select" id="branch_id_ut" name="branch_id_ut" aria-label="Select Branch">
                                                                                        <option value="">Select Branch</option>
                                                                                        @foreach ($branches as $branch)
                                                                                        <?php
                                                                                        $sele = '';
                                                                                        if (isset($_GET['branch_id'])) {
                                                                                            if ($_GET['branch_id'] == $branch->id)
                                                                                                $sele = 'selected';
                                                                                            else
                                                                                                $sele = '';
                                                                                        } else {
                                                                                            if ($class_room->branch_id == $branch->id)
                                                                                                $sele = 'selected';
                                                                                            else
                                                                                                $sele = '';
                                                                                        }
                                                                                        ?>
                                                                                        <option <?php echo $sele; ?> value="{{$branch->id}}">{{$branch->branch_name}} </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('branch_id_ut')
                                                                                    <p class="text-danger">{{ $message }}</p>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="mb-3 col-md-6">
                                                                                    <label for="class_room_name_ut" class="form-label">Classroom Name</label>
                                                                                    <input class="form-control" type="text" name="class_room_name_ut" id="class_room_name_ut" value="{{ $class_room->class_room_name }}" placeholder="" />
                                                                                    @error('class_room_name_ut')
                                                                                    <p class="text-danger">{{ $message }}</p>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="mb-3 col-md-6">
                                                                                    <label for="template_id_ut" class="form-label">Select Template</label>
                                                                                    <select class="form-select" name="template_id_ut" id="template_id_ut">
                                                                                        <option value="">Select Template</option>
                                                                                        <?php
                                                                                        if (count($templates) > 0) {
                                                                                            foreach ($templates as $template) {
                                                                                                if ($class_room->template_id == $template->id)
                                                                                                    $sel = 'selected';
                                                                                                else
                                                                                                    $sel = '';
                                                                                                echo '<option ' . $sel . ' value="' . $template->id . '">' . $template->template_name . '</option>';
                                                                                            }
                                                                                        } ?>
                                                                                    </select>
                                                                                    @error('template_id_ut')
                                                                                    <p class="text-danger">{{ $message }}</p>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="col-sm-6 mb-3">
                                                                                    <label class="form-label">Number of students</label>
                                                                                    <input type="text" id="number_of_students_ut" name="number_of_students_ut" value="{{$class_room->number_of_students}}" class="form-control" />
                                                                                    @error('number_of_students_ut')
                                                                                    <p class="text-danger">{{ $message }}</p>
                                                                                    @enderror
                                                                                </div>
                                                                                <!--div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                                                                                    <label for="temp_generate_link" class="form-label">Zoom Meeting Link</label><br>
                                                                                    <button type="button" id="temp_generate_link" class="temp_generate_link btn btn-facebook waves-effect waves-light">
                                                                                        <i class="tf-icons ti ti-brand-zoom ti-xs me-1"></i> Generate Link
                                                                                    </button>
                                                                                </div-->
                                                                                <div class="mb-3 col-lg-6 col-xl-6 mb-0"></div>
                                                                                <!--div class="mb-3 col-lg-6 col-xl-6 col-md-12" style="border-bottom: 1px solid #dbdade;">
                                                                                    <a class="tempclassZoommeeting" id="tempclassZoommeeting" href="" alt="Zoom Meeting" style="color: <?php echo $org_color; ?>;"></a>
                                                                                </div-->
                                                                                <div class="divider text-start-center">
                                                                                    <div class="divider-text" style="color:#ff9f43;">
                                                                                        <i class="ti ti-brand-codepen"></i>&nbsp;Integration(Map Subject & Teacher)
                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                                $count = 0;
                                                                                $subject_ids = $subj_teachers;
                                                                                if ($subj_teachers)
                                                                                    $count = count($subj_teachers);

                                                                                if ($count == 0) {
                                                                                ?>
                                                                                    <div class="row_jp" style="display:flex">
                                                                                        <div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0">
                                                                                            <label for="subject_id_ut" class="form-label">Subject Name</label>
                                                                                            <select class="form-select subject_id_ut" name="subject_id_ut[]" aria-label="Default select example">
                                                                                                <option value="">Select Subject</option>
                                                                                                <?php
                                                                                                if (count($subjects) > 0) {
                                                                                                    foreach ($subjects as $subject) {
                                                                                                        if ($subject->id == old('subject_id_ut.0'))
                                                                                                            $sel = 'selected';
                                                                                                        else
                                                                                                            $sel = '';
                                                                                                        echo '<option ' . $sel . ' value="' . $subject->id . '">' . $subject->subject_name . '</option>';
                                                                                                    }
                                                                                                } ?>
                                                                                            </select>
                                                                                            @error('subject_id_ut.0')
                                                                                            <span style="color:red;">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        <div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0">
                                                                                            <label for="teacher_id_ut" class="form-label">Teacher Name</label>
                                                                                            <select class="form-select teacher_id_ut" name="teacher_id_ut[]" aria-label="Default select example">
                                                                                                <option value="">Select Teacher</option>
                                                                                                <?php
                                                                                                if (count($teachers) > 0) {
                                                                                                    foreach ($teachers as $teacher) {
                                                                                                        if ($teacher->id == old('teacher_id_ut.0'))
                                                                                                            $sel = 'selected';
                                                                                                        else
                                                                                                            $sel = '';
                                                                                                        echo '<option ' . $sel . ' value="' . $teacher->id . '">' . $teacher->first_name . ' ' . $teacher->last_name . '</option>';
                                                                                                    }
                                                                                                } ?>
                                                                                            </select>
                                                                                            @error('teacher_id_ut.0')
                                                                                            <span style="color:red;">{{ $message }}</span>
                                                                                            @enderror
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                <?php } ?>
                                                                                <?php
                                                                                if ($count > 0) {
                                                                                    for ($i = 0; $i < $count; $i++) {
                                                                                ?>
                                                                                        <div class="row_jp" style="display:flex">
                                                                                            <div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0">
                                                                                                <label for="subject_id_ut" class="form-label">Subject Name</label>
                                                                                                <select class="form-select subject_id_ut" name="subject_id_ut[]" aria-label="Default select example">
                                                                                                    <option value="">Select Subject</option>
                                                                                                    <?php
                                                                                                    if (count($subjects) > 0) {

                                                                                                        foreach ($subjects as $subject) {
                                                                                                            if ($subject->id == $subj_teachers[$i]['subject_id'])
                                                                                                                $sel = 'selected';
                                                                                                            else
                                                                                                                $sel = '';
                                                                                                            echo '<option ' . $sel . ' value="' . $subject->id . '">' . $subject->subject_name . '</option>';
                                                                                                        }
                                                                                                    } ?>
                                                                                                </select>
                                                                                                @error('subject_id_ut.'.$i)
                                                                                                <span style="color:red;">{{ $message }}</span>
                                                                                                @enderror
                                                                                            </div>
                                                                                            <div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0">
                                                                                                <label for="teacher_id_ut" class="form-label">Teacher Name</label>
                                                                                                <select class="form-select teacher_id_ut" name="teacher_id_ut[]" aria-label="Default select example">
                                                                                                    <option value="">Select Teacher</option>
                                                                                                    <?php
                                                                                                    if (count($teachers) > 0) {
                                                                                                        foreach ($teachers as $teacher) {
                                                                                                            if ($teacher->id == $subj_teachers[$i]['teacher_id'])
                                                                                                                $sel = 'selected';
                                                                                                            else
                                                                                                                $sel = '';
                                                                                                            echo '<option ' . $sel . ' value="' . $teacher->id . '">' . $teacher->first_name . ' ' . $teacher->last_name . '</option>';
                                                                                                        }
                                                                                                    } ?>
                                                                                                </select>
                                                                                                @error('teacher_id_ut.'.$i)
                                                                                                <span style="color:red;">{{ $message }}</span>
                                                                                                @enderror
                                                                                            </div>
																							<?php if($i!=0) { ?>
                                                                                            <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                                                                                                <br><a href="javascript:void(0);" class="remove_button jp_remove_button"><i class="fa-solid fa-circle-minus"></i></a>
                                                                                            </div>
                                                                                            <hr />
																							<?php } ?>
                                                                                        </div>
                                                                                <?php }
                                                                                } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-0">
                                                                        <button type="button" id="add_button_template" class="add_button btn btn-success" style="float: right;">
                                                                            <i class="ti ti-plus me-1"></i>
                                                                            <span class="align-middle">Add</span>
                                                                        </button>
                                                                    </div>
                                                                    <p style="height:4px;"></p>
                                                                    <div class="mt-2">
                                                                        <button type="submit" form="nameform" class="btn btn-primary me-2">Submit</button>
                                                                        <a href="{{route('index_list')}}" class="btn btn-label-secondary">Cancel</a>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--suspension msg-->
                                    <?php $sus_count = $suspensions->count();
                                    if ($sus_count > 0) {
                                    ?>
                                        <div class="col-12 mb-4 col-lg-12 col-xl-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">Suspension Details</h5>
                                                    <table id="example" data-order='[[ 0, "desc" ]]' class="display nowrap" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <!-- <th>ID</th> -->
                                                                <th>Reason</th>
                                                                <th> Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                            <?php foreach ($suspensions as $suspension) {
                                                                echo '<tr>';
                                                                //    echo '<td>' . $suspension->id . '</td>';
                                                                echo '<td title="' . $suspension->suspension_reason . '" style="cursor: pointer;" data-bs-toggle="tooltip">' . mb_strimwidth($suspension->suspension_reason, 0, 20, '...') . '</td>';
                                                                echo '<td>' . $suspension->suspension_date . '</td>';
                                                                echo '</tr>';
                                                            } ?>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!--suspension msg-->
                                </div>
                                <div class="modal-onboarding modal fade animate__animated" id="template_1" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content text-center">
                                            <div class="modal-header border-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div id="modalCarouselControls" class="carousel slide pb-4 mb-2" data-bs-interval="false">
                                                <div class="carousel-indicators">
                                                    <button type="button" data-bs-target="#modalCarouselControls" data-bs-slide-to="0" class="active"></button>
                                                    <button type="button" data-bs-target="#modalCarouselControls" data-bs-slide-to="1"></button>
                                                    <button type="button" data-bs-target="#modalCarouselControls" data-bs-slide-to="2"></button>
                                                </div>
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <div class="onboarding-content">
                                                            <h4 class="onboarding-title text-body">Class Details</h4>
                                                            <form>
                                                                <div class="row">
                                                                    <div class="col-sm-6 mb-3">
                                                                        <label for="templateName" class="form-label">Template Name</label>
                                                                        <input class="form-control" type="text" id="templateName" name="templateName" value="Template Name 1" autofocus readonly />
                                                                    </div>
                                                                    <div class="col-sm-6 mb-3">
                                                                        <label for="tempduration" class="form-label">Duration</label>
                                                                        <input class="form-control" type="text" id="tempduration" name="tempduration" value="3 Months" autofocus readonly />
                                                                    </div>
                                                                    <!-- <div class="col-sm-6 mb-3">
                                    <label for="tempduration" class="form-label">Duration</label>
                                    <select class="form-select" id="tempduration">
                                      <option value="select_duration">Select Duration</option>
                                      <option selected value="3months">3 Months</option>
                                      <option value="6months">6 Months</option>
                                      <option value="1 year">1 year</option>
                                    </select>
                                  </div> -->
                                                                    <div class="col-sm-6 mb-3">
                                                                        <label for="bs-rangepicker-single" class="form-label">Start Date</label>
                                                                        <input type="text" id="startdate" class="form-control" value="21-03-2024" readonly />
                                                                    </div>
                                                                    <div class="col-sm-6 mb-3">
                                                                        <label for="bs-rangepicker-single" class="form-label">End Date</label>
                                                                        <input type="text" id="enddate" class="form-control" value="21-06-2024" readonly />
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="onboarding-content">
                                                            <h4 class="onboarding-title text-body">Modules</h4>
                                                            <form>
                                                                <div class="row">
                                                                    <div class="col-sm-6 mb-3">
                                                                        <label for="offlinecoursemodule" class="form-label">Offline Course Module</label>
                                                                        <input class="form-control" type="text" name="offlinecoursemodule" id="offlinecoursemodule" value="Yes" readonly />
                                                                    </div>
                                                                    <div class="col-sm-6 mb-3">
                                                                        <label for="quizexammodule" class="form-label">Quiz and Exam Module</label>
                                                                        <input class="form-control" type="text" name="quizexammodule" id="quizexammodule" value="Yes" readonly />
                                                                    </div>
                                                                    <div class="col-sm-6 mb-3">
                                                                        <label for="assesmentsmodule" class="form-label">Assesments Module</label>
                                                                        <input class="form-control" type="text" name="assesmentsmodule" id="assesmentsmodule" value="No" readonly />
                                                                    </div>
                                                                    <div class="col-sm-6 mb-3">
                                                                        <label for="librarymodule" class="form-label">Library Module</label>
                                                                        <input class="form-control" type="text" name="librarymodule" id="librarymodule" value="Yes" readonly />
                                                                    </div>
                                                                    <div class="col-sm-6 mb-3">
                                                                        <label for="attendancemodule" class="form-label">Attendance Module</label>
                                                                        <input class="form-control" type="text" name="attendancemodule" id="attendancemodule" value="Yes" readonly />
                                                                    </div>
                                                                    <div class="col-sm-6 mb-3">
                                                                        <label for="onlinecoursemodule" class="form-label">Online Course Module</label>
                                                                        <input class="form-control" type="text" name="onlinecoursemodule" id="onlinecoursemodule" value="No" readonly />
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="onboarding-content">
                                                            <h4 class="onboarding-title text-body">Schedule</h4>
                                                            <form>
                                                                <div class="row">
                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-3 col-form-label" for="classmonday" style="text-align: right;">Monday</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="mondaystart" placeholder="" value="18:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="mondayend" placeholder="" value="19:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <p style="margin-bottom: 7px;"></p>
                                                                            <input type="checkbox" class="form-check-input" id="mondaycheck" placeholder="" checked />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-3 col-form-label" for="classtuesday" style="text-align: right;">Tuesday</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="tuesdaystart" value="18:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="tuesdayend" value="19:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <p style="margin-bottom: 7px;"></p>
                                                                            <input type="checkbox" class="form-check-input" id="tuesdaycheck" placeholder="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-3 col-form-label" for="classwednesday" style="text-align: right;">Wednesday</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="wednesdaystart" value="18:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="wednesdayend" value="19:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <p style="margin-bottom: 7px;"></p>
                                                                            <input type="checkbox" class="form-check-input" id="wednesdaycheck" placeholder="" checked />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-3 col-form-label" for="classthursday" style="text-align: right;">Thursday</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="thursdaystart" value="18:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="thursdayend" value="19:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <p style="margin-bottom: 7px;"></p>
                                                                            <input type="checkbox" class="form-check-input" id="thursdaycheck" placeholder="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-3 col-form-label" for="classfriday" style="text-align: right;">Friday</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="fridaystart" value="18:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="fridayend" value="19:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <p style="margin-bottom: 7px;"></p>
                                                                            <input type="checkbox" class="form-check-input" id="fridaycheck" placeholder="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-3 col-form-label" for="classsaturday" style="text-align: right;">Saturday</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="saturdaystart" value="18:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="saturdayend" value="19:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <p style="margin-bottom: 7px;"></p>
                                                                            <input type="checkbox" class="form-check-input" id="saturdaycheck" placeholder="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label class="col-sm-3 col-form-label" for="classsunday" style="text-align: right;">Sunday</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="sundaystart" value="18:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input type="time" class="form-control" id="sundayend" value="19:00" readonly />
                                                                        </div>
                                                                        <div class="col-sm-1">
                                                                            <p style="margin-bottom: 7px;"></p>
                                                                            <input type="checkbox" class="form-check-input" id="sundaycheck" placeholder="" checked />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#modalCarouselControls" role="button" data-bs-slide="prev">
                                                    <i class="ti ti-chevrons-left me-2"></i><span>Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#modalCarouselControls" role="button" data-bs-slide="next">
                                                    <span>Next</span><i class="ti ti-chevrons-right ms-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    @include('dashboard.footer')
    <script src="{{ asset('assets/bs-stepper/bs-stepper.js')}}"></script>
    <script src="{{ asset('assets/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{ asset('assets/select2/select2.js')}}"></script>
    <script src="{{ asset('assets/js/form-wizard-numbered.js')}}"></script>
    <script src="{{ asset('assets/js/form-wizard-validation.js')}}"></script>

    <script src="{{ asset('assets/flatpickr/flatpickr.js')}}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js')}}"></script>
    <!-- Using Manual  -->
    <script>
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('#add_button_manual'); //Add button selector
            var wrapper = $('#group_manual'); //Input field wrapper
            var x = 1; //Initial field counter is 1

            // Once add button is clicked
            $(addButton).click(function() {
                // $(wrapper).append(fieldHTML);
                $(".repeat_row:first").clone().appendTo(wrapper).append('<div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button remove_button_manual"><i class="fa-solid fa-circle-minus"></i></a></div><hr />');
                                                                                                    
                                                                                                    
            });

            $(wrapper).on('click', '.remove_button_manual', function(e) {
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
            });
        });
    </script>
    <!-- Using Template -->
    <script>
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('#add_button_template'); //Add button selector
            var wrapper = $('#group_template'); //Input field wrapper
            //var fieldHTML = '<div class="row"> <div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0"><label for="classSubjectName" class="form-label">Subject Name</label><select class="form-select subject_id_ut" name="subject_id_ut[]" aria-label="Default select example"><option value="">Select Subject</option></select></div><div class="mb-3 col-lg-6 col-xl-5 col-12 mb-0"><label for="classTeacherName" class="form-label">Teacher Name</label><select class="form-select teacher_id_ut" name="teacher_id_ut[]" aria-label="Default select example"><option value="">Select Teacher</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"> <br><a href="javascript:void(0);" id="remove_button_manual" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a> </div> <hr /> </div>'; //New input field html

            var x = 1; //Initial field counter is 1

            // Once add button is clicked
            $(addButton).click(function() {
                // $(wrapper).append(fieldHTML);
                $(".row_jp:first").clone().appendTo(wrapper).append('<div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button jp_remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr />');
            });

            $(wrapper).on('click', '.jp_remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#generate_link').click(function() {
                $(".classZoommeeting").attr("href", "https://zoom.us/j/96576334898?pwd=MHZiOENrZWFabVgxTWwySHJENytLUT09");

                $("#classZoommeeting").text("https://zoom.us/j/96576334898?pwd=MHZiOENrZWFabVgxTWwySHJENytLUT09");
            });
            $('#temp_generate_link').click(function() {
                $(".tempclassZoommeeting").attr("href", "https://zoom.us/j/96576334898?pwd=MHZiOENrZWFabVgxTWwySHJENytLUT09");

                $("#tempclassZoommeeting").text("https://zoom.us/j/96576334898?pwd=MHZiOENrZWFabVgxTWwySHJENytLUT09");
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("select.classTemplate").change(function() {
                var classTemplate = $(this).children("option:selected").val();
                $('#' + classTemplate).modal('show');
            });
        });

        function myFunction() {
            // alert("test");
            document.getElementById('form_submit').setAttribute('onsubmit', '')

        }
    </script>
    <!-- Generate Button Disable -->
    <script>
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
            //jp
            $('#branch_id_mc').change(function() {
                var branch_id = this.value;
                var ajax_url_jp = $('#ajax_url_jp').val() + '/admin/class_room/edit/' + id + '/manual_updation?branch_id=' + branch_id;

                window.location = ajax_url_jp;
            });
            //jp
            $('#branch_id_ut').change(function() {
                var branch_id = this.value;
                var id = $('#record_id').val()
                var ajax_url_jp = $('#ajax_url_jp').val() + '/admin/class_room/edit/' + id + '/using_template?branch_id=' + branch_id;

                window.location = ajax_url_jp;
                /*
				var branch_id=this.value;
				var ajax_url_jp=$('#ajax_url_jp').val()+'/admin/template/get_templates/'+branch_id;


				var options_template='<option value="">Select Template</option>';
				$.ajax({
                  type: "GET",
                  dataType: "json",
                  url: ajax_url_jp,
                  success: function(data){
					  $.each(data, function(index, item) {

                            options_template += '<option value="' + item.id + '">' + item.template_name + '</option>';
                        });

						$('#template_id_ut').html(options_template);
				  }
				});
				//
				var ajax_url_teachers=$('#ajax_url_jp').val()+'/admin/teachers/get_teachers/'+branch_id;
				var options_teacher='<option value="">Select Teacher</option>';
				$.ajax({
                  type: "GET",
                  dataType: "json",
                  url: ajax_url_teachers,
                  success: function(data){
					   $.each(data, function(index, item) {

                            options_teacher += '<option value="' + item.id + '">' + item.first_name + '</option>';
                        });

						$('.teacher_id_ut').html(options_teacher);
				  }
				});
				//
				//
				var ajax_url_subjects=$('#ajax_url_jp').val()+'/admin/subject/get_subjects/'+branch_id;
				var options_subject='<option value="">Select Subject</option>';

				$.ajax({
                  type: "GET",
                  dataType: "json",
                  url: ajax_url_subjects,
                  success: function(data){
					   $.each(data, function(index, item) {

                            options_subject += '<option value="' + item.id + '">' + item.subject_name + '</option>';
                        });

						$('.subject_id_ut').html(options_subject);
				  }
				});
				//
				*/
            });
            //jp
            $('.temp_generate_link').attr('disabled', true);

            $("select.classTeacherStudent").change(function() {
                var student_name = $('.classStudentName').children("option:selected").val();
                var teacher_name = $('.classTeacherName').children("option:selected").val();

                if (student_name != "" && teacher_name != "") {
                    $('.temp_generate_link').attr('disabled', false);
                } else {
                    $('.temp_generate_link').attr('disabled', true);
                }
            });
        });
    </script>
    <script type="text/javascript">
        new DataTable('#example', {
            scrollX: true
        });
    </script>
</body>

</html>
