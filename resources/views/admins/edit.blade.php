<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Edit Admin</title>
    <meta name="description" content="" />
    @include('super_admin.header')
    <style type="text/css">
        .add_admin .btn-primary {
            background-color: #e00814 !important;
            border-color: #e00814 !important;
        }

        .add_admin .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .add_admin .form-check-input:checked,
        .add_admin .form-check-input[type=checkbox]:indeterminate {
            background-color: #e00814 !important;
            border-color: #e00814 !important;
        }

        .add_admin .form-check-input:focus {
            border-color: #e00814 !important;
        }

        .add_admin .bg-primary {
            background-color: #e00814 !important;
        }

        .add_admin .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_admin .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_admin .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_admin .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, #e00814 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
            color: #ffffff !important;
        }

        .add_admin .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .add_admin i {
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

        .add_admin #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .add_org .form-label {
            font-size: 17px;
        }
    </style>
</head>

<body class="add_admin">
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('super_admin.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('super_admin.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3" style="color: #e00814;">Edit Admin</h4>
                        </div>
                        <form action="{{ route('user_update') }}" name="edit_admin" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id; }}" />
                            <!-- Add Product -->
                            <p style="height: 2px;"></p>
                            <div class="row add_org">
                                <!-- Flat Picker -->
                                <div class="col-12 mb-4 col-lg-8 col-xl-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- Range Picker-->
                                                <div class="col-md-6 col-lg-12 col-xl-12 col-12 mb-4">
                                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="flatpickr-range" style="display:none;" />
                                                    <div class="mb-3">
                                                        <label for="adminname" required class="form-label">Name</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" id="adminname" name="name" value="{{ $user->name; }}" placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                                                        @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="adminemail" class="form-label">Email address</label><span class="text-danger">*</span>
                                                        <input type="email" class="form-control" id="adminemail" name="email" value="{{ $user->email; }}" placeholder="name@example.com" />
                                                        @error('email')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="mobile_number" class="form-label">Mobile Phone</label><span class="text-danger">*</span>
                                                        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="{{ $user->mobile_number; }}" placeholder="90-(164)-188-556" />
                                                        @error('mobile_number')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="orgFormControlSelect" class="form-label">Select Organisation</label><span class="text-danger">*</span>
                                                        <select class="select2 form-select" name="organization_id" id="orgFormControlSelect" aria-label="Select Organisation">

                                                            @foreach ($organizations as $organization)
                                                            <?php if ($user->organization_id == $organization->id)
                                                                $selected = 'selected';
                                                            else {
                                                                $selected = '';
                                                            }
                                                            ?>

                                                            <?php echo '<option ' . $selected . ' value="' . $organization->id . '">' . $organization->name . ' - ' . $organization->vat_no . '</option>'; ?>
                                                            @endforeach
                                                        </select>
                                                        @error('organization_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="adminname" class="form-label">Admin Privileges </label>
                                                        <input type="text" value="{{ $user->siteconfig }}" class="form-control" id="siteconfig" name="siteconfig" data-bs-target="#addRoleModal" data-bs-toggle="modal" placeholder="Click to choose Admin Privileges" />
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
                                    <div class="col-12 mb-4 col-lg-4 col-xl-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="mb-1 mt-3" style="color: #e00814;">Suspension Details</h5>
                                                <table id="example" data-order='[[ 0, "desc" ]]' class="display nowrap" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Reason</th>
                                                            <th> Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                        <?php foreach ($suspensions as $suspension) {
                                                            echo '<tr>';
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
                                <p style="height: 2px;"></p>
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                    <div class="d-flex align-content-center flex-wrap gap-3">
                                        <div class="d-flex gap-3">
                                            <input type="submit" class="btn btn-primary" value="Submit" />
                                            <a href="{{route('user_index')}}" class="btn btn-label-secondary">Discard</a>
                                        </div>

                                    </div>
                                </div>
                                <!-- /Flatpickr -->
                                <!-- Color Picker -->
                                <!-- /Color Picker-->
                            </div>
                        </form>
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
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="assessments" <?php if (in_array('assessments', $site_config_arr)) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?> id="templates" />
                                                                            <label class="form-check-label" for="assessments"> Assessments </label>
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
                                                <button type="reset" id="clear_all" class="btn btn-label-primary waves-effect me-sm-3 me-1">Clear All</button>
                                                <button type="submit" id="config_submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
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
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->

                    <!-- / Footer -->
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
    @include('super_admin.footer')
    <!--Select 2-->
    <link rel="stylesheet" href="{{ asset('assets/select2/select2.css') }}" />
    </script>
    <script src="{{ asset('assets/select2/select2.js')}}"></script>
    <script src="{{ asset('assets/js/form-wizard-icons.js')}}"></script>

    <!--Select 2--->
    <script type="text/javascript">
        $(document).ready(function() {

            $("#config_submit").click(function() {
                const configs = [];
                var list = $("input[name='config[]']:checked").map(function() {
                    configs.push(this.value);
                }).get();
                var config_val = configs.join(',');
                $("#siteconfig").val(config_val);
                $('#addRoleModal').modal('toggle');
            });

            $('#all').click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
                $('#dashboard').prop('checked', true);
                $('#profile').prop('checked', true);
                $('#branches').prop('checked', true);
            });

            $('.form-check-input').click(function() {
                var numberOfChecked = $('.form-check-input:checked').length;
                var totalCheckboxes = $('.form-check-input').length;

                if (totalCheckboxes == numberOfChecked)
                    $('#all').prop('checked', true);
                else
                    $('#all').prop('checked', false);

            });


            $('#clear_all').click(function() {
                $('input:checkbox').removeAttr('checked');
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
