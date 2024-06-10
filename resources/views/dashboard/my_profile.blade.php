<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>My Profile</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    $admin_name = App\Models\User::getOrgAdminNameById($user_id);
    ?>
    <style type="text/css">
        .index_page .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .index_page .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .index_page .form-control:focus,
        .index_page .form-select:focus,
        .index_page .input-group:focus-within .form-control,
        .index_page .input-group:focus-within .input-group-text {
            color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .index_page .form-check-input:checked,
        .index_page .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .index_page .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .index_page .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .index_page .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .index_page .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .index_page .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .index_page .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .index_page .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .index_page i {
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

        .index_page #template-customizer .template-customizer-open-btn {
            background-color: <?php echo $org_color; ?> !important;
        }

        .index_page .nav-pills .nav-link.active,
        .index_page .nav-pills .nav-link.active:hover,
        .index_page .nav-pills .nav-link.active:focus {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .index_page .nav-pills .nav-link:hover {
            color: <?php echo $org_color; ?> !important;
        }
    </style>
</head>

<body class="index_page">
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
                    <p style="height: 2px;"></p>
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="app-ecommerce mb-4">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">My Profile</h4>
                                </div>
                            </div>
                            <p style="height: 2px;"></p>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="nav-align-top mb-4">
                                        <ul class="nav nav-pills mb-3 nav-fill addstudent" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-manual" aria-controls="navs-pills-justified-manual" aria-selected="true">
                                                    <i class="menu-icon fa fa-user"></i>&nbsp; Admin </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-template" aria-controls="navs-pills-justified-template" aria-selected="false">
                                                    <i class="menu-icon fa fa-building"></i>&nbsp; Organization </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="navs-pills-justified-manual" role="tabpanel">
                                                <div class="col-12 col-lg-12">
                                                    <div class="mb-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                @if(session()->has('success'))
                                                                <div class="alert alert-success">
                                                                    {{ session()->get('success') }}
                                                                </div>
                                                                @endif
                                                                @if(session()->has('fail'))
                                                                <div class="alert alert-danger">
                                                                    {{ session()->get('fail') }}
                                                                </div>
                                                                @endif

                                                                <div class="d-flex align-content-center flex-wrap gap-3">
                                                                    <div class="d-flex gap-3">
                                                                        <a href="edit_my_profile_admin">
                                                                            <button class="btn btn-primary" type="button">
                                                                                <span>
                                                                                    <!-- <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> -->
                                                                                    <span class="d-none d-sm-inline-block">Edit</span>
                                                                                </span>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                    <div class="d-flex gap-3">
                                                                        <a href="change_password_admin">
                                                                            <button class="btn btn-primary" type="button">
                                                                                <span>
                                                                                    <!-- <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> -->
                                                                                    <span class="d-none d-sm-inline-block">Change Password</span>
                                                                                </span>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                                <form id="form_submit" method="POST" action="#" onsubmit="return false">
                                                                    @csrf
                                                                    <div class="col-12 mb-4">
                                                                        <div class="bs-stepper wizard-vertical wizard-numbered vertical mt-2">
                                                                            <div class="bs-stepper-header">
                                                                                <div class="col-md-6 col-lg-12 col-xl-12 col-12 mb-4">
                                                                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="flatpickr-range" style="display:none;" />
                                                                                    <div class="mb-3">
                                                                                        <label for="adminname" required class="form-label">Name</label>
                                                                                        <input type="text" class="form-control" id="adminname" name="name" value="{{$user-> name}}" placeholder="John Doe" aria-describedby="defaultFormControlHelp" readonly />
                                                                                        @error('name')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="adminemail" class="form-label">Email address</label>
                                                                                        <input type="email" class="form-control" id="adminemail" name="email" value="{{$user->email}}" placeholder="name@example.com" readonly />
                                                                                        @error('email')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="mobile_number" class="form-label">Mobile Phone</label>
                                                                                        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="{{$user->mobile_number}}" placeholder="90-(164)-188-556" readonly />
                                                                                        @error('mobile_number')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="orgFormControlSelect" class="form-label">Organisation</label>
                                                                                        <input type="tel" class="form-control" id="organization" name="organization" value="{{ App\Models\Organization::getOrgNameByID($user->organization_id)}}" readonly />
                                                                                        @error('organization_id')
                                                                                        <p class="text-danger">{{ $message }}</p>
                                                                                        @enderror
                                                                                    </div>
                                           
                                                                                    <div class="mb-3">
                                                                                        <label for="adminname" class="form-label">Admin Privileges</label>
                                                                                        <input type="text" class="form-control" id="siteconfig" name="siteconfig" value="{{$user->siteconfig}}" data-bs-target="#addRoleModal" data-bs-toggle="modal" placeholder="Click to View Admin Privileges" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- <div class="mt-2">
                                                                    <button type="submit" onclick="myFunction()" class="btn btn-primary me-2">Submit</button>
                                                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                                                </div> -->
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                                                    <div class="modal-content p-3 p-md-5" style="padding: 3rem 0rem !important;">
                                                        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        <div class="modal-body">
                                                            <div class="text-center mb-4">
                                                                <h3 class="role-title mb-2">Choose Admin Privileges</h3>
                                                                <?php
                                                                $site_config_string = $user->siteconfig;
                                                                $site_config_arr = explode(',', $site_config_string);
                                                                ?>
                                                            </div>
                                                            <!-- Add role form -->
                                                            <form id="addRoleForm" class="row g-3" onsubmit="return false">
                                                                <div class="col-12">
                                                                    <!-- Permission table -->
                                                                    <div class="table-responsive">
                                                                        <table class="table table-flush-spacing">
                                                                            <tbody>

                                                                                <tr>
                                                                                    <td colspan="4">
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="selectAll" type="checkbox" name="config[]" <?php if (in_array('all', $site_config_arr)) {
                                                                                                                                                                echo 'checked';
                                                                                                                                                            } ?> value="all" id="all" />
                                                                                                <label class="form-check-label" for="all"> Select All </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" checked name="config[]" disabled value="dashboard" id="dashboard" />
                                                                                                <label class="form-check-label" for="dashboard"> Dashboard </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" checked name="config[]" disabled value="profile" id="profile" />
                                                                                                <label class="form-check-label" for="profile"> Profile </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" checked name="config[]" disabled value="branches" id="branches" />
                                                                                                <label class="form-check-label" for="branches"> Branches </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="background-color: #d3d3d34a;">
                                                                                    <td class="text-nowrap fw-medium" colspan="4"><small class="text-light fw-medium text-uppercase">&nbsp;&nbsp;&nbsp;Academy Section</small></td>
                                                                                    <td>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" <?php if (in_array('classrooms', $site_config_arr)) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?> value="classrooms" name="config[]" id="Classsrooms" />
                                                                                                <label class="form-check-label" for="Classsrooms"> Classsrooms </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" <?php if (in_array('teachers', $site_config_arr)) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?> value="teachers" id="teachers" />
                                                                                                <label class="form-check-label" for="teachers"> Teachers </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="students" <?php if (in_array('students', $site_config_arr)) {
                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                    } ?> id="students" />
                                                                                                <label class="form-check-label" for="students"> Students </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="parents" <?php if (in_array('parents', $site_config_arr)) {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } ?> id="Parents" />
                                                                                                <label class="form-check-label" for="Parents"> Parents </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>

                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="student_attendance" <?php if (in_array('student_attendance', $site_config_arr)) {
                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                            } ?> id="student_attendance" />
                                                                                                <label class="form-check-label" for="student_attendance"> Student Attendance </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="recorded_live_classes" <?php if (in_array('recorded_live_classes', $site_config_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> id="recorded_live_classes" />
                                                                                                <label class="form-check-label" for="recorded_live_classes"> Recorded Live Classes </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="video_course" <?php if (in_array('video_course', $site_config_arr)) {
                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                        } ?> id="video_course" />
                                                                                                <label class="form-check-label" for="video_course"> Video Course </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="materials" <?php if (in_array('materials', $site_config_arr)) {
                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                    } ?> id="Materials" />
                                                                                                <label class="form-check-label" for="Materials"> Materials </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="quizzes_and_exams" <?php if (in_array('quizzes_and_exams', $site_config_arr)) {
                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                            } ?> id="Quizzes and Exams" />
                                                                                                <label class="form-check-label" for="Quizzes and Exams"> Quizzes and Exams </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="assignments" <?php if (in_array('assignments', $site_config_arr)) {
                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                    } ?> id="Assignments" />
                                                                                                <label class="form-check-label" for="Assignments"> Assignments </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="certificates" <?php if (in_array('certificates', $site_config_arr)) {
                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                        } ?> id="Certificates" />
                                                                                                <label class="form-check-label" for="Certificates"> Certificates </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="templates" <?php if (in_array('templates', $site_config_arr)) {
                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                    } ?> id="templates" />
                                                                                                <label class="form-check-label" for="templates"> Templates </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" <?php if (in_array('subjects', $site_config_arr)) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?> value="subjects" name="config[]" id="Subjects" />
                                                                                                <label class="form-check-label" for="Subjects"> Subjects </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>

                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" <?php if (in_array('departments', $site_config_arr)) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?> value="departments" name="config[]" id="Departments" />
                                                                                                <label class="form-check-label" for="Departments"> Departments </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="background-color: #d3d3d34a;">
                                                                                    <td class="text-nowrap fw-medium" colspan="4"><small class="text-light fw-medium text-uppercase">&nbsp;&nbsp;&nbsp;AI Section</small></td>
                                                                                    <td>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="student_progress" <?php if (in_array('student_progress', $site_config_arr)) {
                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                            } ?> id="Student Progress" />
                                                                                                <label class="form-check-label" for="Student Progress"> Student Progress </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="ai_chan" <?php if (in_array('ai_chan', $site_config_arr)) {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } ?> id="ai_chan" />
                                                                                                <label class="form-check-label" for="ai_chan"> AI Chan (Chat Bot) </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="games" <?php if (in_array('games', $site_config_arr)) {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } ?> id="games" />
                                                                                                <label class="form-check-label" for="games"> Games </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="background-color: #d3d3d34a;">
                                                                                    <td class="text-nowrap fw-medium" colspan="4"><small class="text-light fw-medium text-uppercase">&nbsp;&nbsp;&nbsp;Management Section</small></td>
                                                                                    <td>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="accounting" <?php if (in_array('accounting', $site_config_arr)) {
                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                    } ?> id="Accounting" />
                                                                                                <label class="form-check-label" for="Accounting"> Accounting </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="live_stream_settings" <?php if (in_array('live_stream_settings', $site_config_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> id="live_stream_settings" />
                                                                                                <label class="form-check-label" for="live_stream_settings"> Live Stream Settings </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="human_resources" <?php if (in_array('human_resources', $site_config_arr)) {
                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                        } ?> id="Human Resources" />
                                                                                                <label class="form-check-label" for="Human Resources"> Human Resources </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="agreements" <?php if (in_array('agreements', $site_config_arr)) {
                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                    } ?> id="Agreements" />
                                                                                                <label class="form-check-label" for="Agreements"> Agreements </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="smart_reports" <?php if (in_array('smart_reports', $site_config_arr)) {
                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                        } ?> id="Smart Reports" />
                                                                                                <label class="form-check-label" for="Smart Reports"> Smart Reports </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="services_and_products" <?php if (in_array('services_and_products', $site_config_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> id="Services and Products" />
                                                                                                <label class="form-check-label" for="Services and Products"> Services and Products </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="users" <?php if (in_array('users', $site_config_arr)) {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } ?> id="Users" />
                                                                                                <label class="form-check-label" for="Users and Roles"> Users </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="roles" <?php if (in_array('roles', $site_config_arr)) {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } ?> id="Roles" />
                                                                                                <label class="form-check-label" for="Users and Roles"> Roles </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="user_privileges" <?php if (in_array('user_privileges', $site_config_arr)) {
                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                        } ?> id="User Privileges" />
                                                                                                <label class="form-check-label" for="User Privileges"> User Privileges </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="inventory_lists" <?php if (in_array('inventory_lists', $site_config_arr)) {
                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                        } ?> id="Inventory Lists" />
                                                                                                <label class="form-check-label" for="Inventory Lists"> Inventory Lists </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="online_store" <?php if (in_array('online_store', $site_config_arr)) {
                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                        } ?> id="online_store" />
                                                                                                <label class="form-check-label" for="online_store"> Online Store </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" value="payment_gateways" <?php if (in_array('payment_gateways', $site_config_arr)) {
                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                            } ?> id="payment_gateways" />
                                                                                                <label class="form-check-label" for="payment_gateways"> Payment Gateways </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="background-color: #d3d3d34a;">
                                                                                    <td class="text-nowrap fw-medium" colspan="4"><small class="text-light fw-medium text-uppercase">&nbsp;&nbsp;&nbsp;Support Section</small></td>
                                                                                    <td>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" id="Help Desk" <?php if (in_array('help_desk', $site_config_arr)) {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } ?> value="help_desk" />
                                                                                                <label class="form-check-label" for="Help Desk"> Help Desk </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" id="Settings" <?php if (in_array('settings', $site_config_arr)) {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } ?> value="settings" />
                                                                                                <label class="form-check-label" for="Settings"> Settings </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div class="form-check me-3 me-lg-5">
                                                                                                <input class="form-check-input" type="checkbox" name="config[]" id="Modules" <?php if (in_array('modules', $site_config_arr)) {
                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                } ?> value="modules" />
                                                                                                <label class="form-check-label" for="Modules"> Modules </label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>

                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- Permission table -->
                                                                </div>
                                                                <div class="col-12 text-center mt-4">
                                                                    <!-- <button type="reset" id="clear_all" class="btn btn-label-primary waves-effect me-sm-3 me-1">Clear All</button>
                                                                                <button type="submit" id="config_submit" class="btn btn-primary me-sm-3 me-1">Submit</button> -->
                                                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                                        Cancel
                                                                    </button>
                                                                </div>
                                                            </form>
                                                            <!--/ Add role form -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade " id="navs-pills-justified-template" role="tabpanel">
                                                <div class="col-12 col-lg-12">
                                                    <div class="row mb-4">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                @if(session()->has('success'))
                                                                <div class="alert alert-success">
                                                                    {{ session()->get('success') }}
                                                                </div>
                                                                @endif
                                                                @if(session()->has('fail'))
                                                                <div class="alert alert-danger">
                                                                    {{ session()->get('fail') }}
                                                                </div>
                                                                @endif
                                                                <div class="d-flex align-content-center flex-wrap gap-3">
                                                                    <div class="d-flex gap-3">
                                                                        <a href="edit_my_profile_organization">
                                                                            <button class="btn btn-primary" type="button">
                                                                                <span>
                                                                                    <!-- <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> -->
                                                                                    <span class="d-none d-sm-inline-block">Edit</span>
                                                                                </span>
                                                                            </button>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <form id="nameform" method="POST" action="#">
                                                                    @csrf
                                                                    <div class="col-12 mb-4">
                                                                        <div class="bs-stepper wizard-vertical wizard-numbered vertical mt-2">
                                                                            <div class="bs-stepper-header">
                                                                                <div class="step" data-target="#class-details-1">
                                                                                    <div class="row">
                                                                                        <!-- Range Picker-->
                                                                                        <div class="col-md-6 col-lg-12 col-xl-12 col-12 mb-4">
                                                                                            <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="flatpickr-range" style="display:none;" />
                                                                                            <div class="mb-3">
                                                                                                <label for="defaultFormControlInput" class="form-label">Name</label>
                                                                                                <input type="text" class="form-control" name="name" id="defaultFormControlInput" value="{{ $data->name }}" placeholder="Name" aria-describedby="defaultFormControlHelp" readonly />
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                                                                                <input type="email" class="form-control" name="email" id="exampleFormControlInput1" value="{{ $data->email; }}" placeholder="name@example.com" readonly />
                                                                                            </div>

                                                                                            <div class="mb-3">
                                                                                                <label for="bs-rangepicker-single" class="form-label">Start Date</label>
                                                                                                <input type="text" id="flatpickr-date1" name="start_date" class="form-control" value="{{!empty($data->start_date)?$data->start_date->format('d/m/Y'):NULL; }}" placeholder="DD-MM-YYYY" readonly />
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="bs-rangepicker-single" class="form-label">End Date</label>
                                                                                                <input type="text" id="flatpickr-date2" name="end_date" class="form-control" value="{{!empty($data->end_date)?$data->end_date->format('d/m/Y'):NULL; }}" placeholder="DD-MM-YYYY" readonly />
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="org_color" class="form-label" style="padding-right: 10px;">Color</label>
                                                                                                <input class="form-control" type="color" name="color" value="{{ $data->color; }}" id="org_color" disabled />
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="formFile" class="form-label">Logo</label>
                                                                                                <img width="170" height="52" src="{{asset('assets/img/organization_logo/'.$data->logo)}}">
                                                                                                <p class='text-success'> File size should be less than  5mb and  dimension must be less than 170 px*52 px </p>
                                                                                                <input type="hidden" name="id" id="id" value="{{ $data->id; }}" />
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="address" class="form-label">Address</label>
                                                                                                <textarea class="form-control" id="address" name="address" rows="3" readonly>{{ $data->address }}</textarea>
                                                                                                @error('address')
                                                                                                <p class="text-danger">{{ $message }}</p>
                                                                                                @enderror
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="defaultFormControlInput" class="form-label">VAT No</label>
                                                                                                <input type="text" class="form-control" name="vat_no" value="{{ $data->vat_no }}" id="defaultFormControlInput" placeholder="VAT No" aria-describedby="defaultFormControlHelp" readonly />
                                                                                                @error('vat_no')
                                                                                                <span style="color:red;">{{ $message }}</span>
                                                                                                @enderror
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="defaultFormControlInput" class="form-label">Contact No</label>
                                                                                                <input type="text" class="form-control" name="contact_no" value="{{  $data->contact_no }}" id="defaultFormControlInput" placeholder="Contact No" aria-describedby="defaultFormControlHelp" readonly />
                                                                                                @error('contact_no')
                                                                                                <span style="color:red;">{{ $message }}</span>
                                                                                                @enderror
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <p style="height:4px;"></p>
                                                                    <!-- <div class="mt-2">
                                                                <button type="submit" form="nameform" class="btn btn-primary me-2">Submit</button>
                                                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                                            </div> -->
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Content wrapper -->
                            </div>
                        </div>
                    </div>

                    <!-- / Layout page -->
                </div>
                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
                <!-- Drag Target Area To SlideIn Menu On Small Screens -->
                <div class="drag-target"></div>
            </div>
        </div>
        <!-- / Layout wrapper -->
        @include('dashboard.footer')
</body>

</html>
