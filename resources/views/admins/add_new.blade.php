<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Admin</title>
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
                            <h4 class="mb-1 mt-3" style="color: #e00814;">Add Admin</h4>
                        </div>
                        <form action="{{ route('user_add') }}" name="add_admin" method="post">
                            @csrf

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
                                                        <input type="text" class="form-control" id="adminname" name="name" value="{{ old('name')}}" placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                                                        @error('name')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="adminemail" class="form-label">Email address</label><span class="text-danger">*</span>
                                                        <input type="email" class="form-control" id="adminemail" name="email" value="{{ old('email')}}" placeholder="name@example.com" />
                                                        @error('email')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="mobile_number" class="form-label">Mobile Phone</label><span class="text-danger">*</span>
                                                        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number')}}" placeholder="90-(164)-188-556" />
                                                        @error('mobile_number')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="orgFormControlSelect" class="form-label">Select Organisation</label><span class="text-danger">*</span>
                                                        <select class="select2 form-select" name="organization_id" id="orgFormControlSelect" aria-label="Select Organisation">
                                                            <option value="">Select Organisation</option>
                                                            @foreach ($organizations as $organization)
                                                            <?php if (old('organization_id') == $organization->id)
                                                                $selec = 'selected';
                                                            else
                                                                $selec = '';
                                                            echo '<option ' . $selec . ' value="' . $organization->id . '">' . $organization->name . ' - ' . $organization->vat_no . '</option>'
                                                            ?>
                                                            @endforeach
                                                        </select>
                                                        @error('organization_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="adminname" class="form-label">Admin Privileges</label>
                                                        <input type="text" class="form-control" id="siteconfig" name="siteconfig" value="{{ old('siteconfig')}}" data-bs-target="#addRoleModal" data-bs-toggle="modal" placeholder="Click to choose Admin Privileges" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p style="height: 2px;"></p>
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                    <div class="d-flex align-content-center flex-wrap gap-3">
                                        <div class="d-flex gap-3">
                                            <input type="submit" class="btn btn-primary" value="Submit" />

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
                                                                            <input class="selectAll" type="checkbox" name="config[]" value="all" id="all" />
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
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="classrooms" name="config[]" id="Classsrooms" />
                                                                            <label class="form-check-label" for="Classrooms"> Classrooms </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="teachers" id="teachers" />
                                                                            <label class="form-check-label" for="teachers"> Teachers </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="students" id="Students" />
                                                                            <label class="form-check-label" for="Students"> Students </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="parents" id="Parents" />
                                                                            <label class="form-check-label" for="Parents"> Parents </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="student_attendance" id="student_attendance" />
                                                                            <label class="form-check-label" for="student_attendance"> Student Attendance </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="recorded_live_classes" id="recorded_live_classes" />
                                                                            <label class="form-check-label" for="recorded_live_classes"> Recorded Live Classes </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="video_course" id="video_course" />
                                                                            <label class="form-check-label" for="video_course"> Video Course </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="materials" id="Materials" />
                                                                            <label class="form-check-label" for="Materials"> Materials </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="quizzes_and_exams" id="Quizzes and Exams" />
                                                                            <label class="form-check-label" for="Quizzes and Exams"> Quizzes and Exams </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="assignments" id="Assignments" />
                                                                            <label class="form-check-label" for="Assignments"> Assignments </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="certificates" id="Certificates" />
                                                                            <label class="form-check-label" for="Certificates"> Certificates </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="templates" id="templates" />
                                                                            <label class="form-check-label" for="templates"> Templates </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="subjects" name="config[]" id="Subjects" />
                                                                            <label class="form-check-label" for="Subjects"> Subjects </label>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="departments" name="config[]" id="Departments" />
                                                                            <label class="form-check-label" for="Departments"> Departments </label>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="departments" name="config[]" id="Assessments" />
                                                                            <label class="form-check-label" for="assessments"> Assessments </label>
                                                                        </div>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                            <tr style="background-color: #d3d3d34a;">
                                                                <td class="text-nowrap fw-medium" colspan="4"><small class="text-light fw-medium text-uppercase">&nbsp;&nbsp;&nbsp;AI Section</small></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="student_progress" id="Student Progress" />
                                                                            <label class="form-check-label" for="Student Progress"> Student Progress </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="ai_chan" id="ai_chan" />
                                                                            <label class="form-check-label" for="ai_chan"> AI Chan (Chat Bot) </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="games" id="games" />
                                                                            <label class="form-check-label" for="games"> Games </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr style="background-color: #d3d3d34a;">
                                                                <td class="text-nowrap fw-medium" colspan="4"><small class="text-light fw-medium text-uppercase">&nbsp;&nbsp;&nbsp;Management Section</small></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="live_stream_settings" id="live_stream_settings" />
                                                                            <label class="form-check-label" for="live_stream_settings"> Live Stream Settings </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="human_resources" id="Human Resources" />
                                                                            <label class="form-check-label" for="Human Resources"> Human Resources </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="accounting" id="Accounting" />
                                                                            <label class="form-check-label" for="Accounting"> Accounting </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="agreements" id="Agreements" />
                                                                            <label class="form-check-label" for="Agreements"> Agreements </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="smart_reports" id="Smart Reports" />
                                                                            <label class="form-check-label" for="Smart Reports"> Smart Reports </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="services_and_products" id="Services and Products" />
                                                                            <label class="form-check-label" for="Services and Products"> Services and Products </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="users" id="users" />
                                                                            <label class="form-check-label" for="Users"> Users </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="roles" id="roles" />
                                                                            <label class="form-check-label" for="Roles"> Roles </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="user_privileges" id="user_privileges" />
                                                                            <label class="form-check-label" for="User Privileges"> User Privileges </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="inventory_lists" id="Inventory Lists" />
                                                                            <label class="form-check-label" for="Inventory Lists"> Inventory Lists </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="online_store" id="online_store" />
                                                                            <label class="form-check-label" for="online_store"> Online Store </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="payment_gateways" id="payment_gateways" />
                                                                            <label class="form-check-label" for="payment_gateways"> Payment Gateways </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" value="inventory_lists" id="Inventory Lists" />
                                                                            <label class="form-check-label" for="Inventory Lists"> Inventory Lists </label>
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
                                                                            <input class="form-check-input" type="checkbox" name="config[]" id="Help Desk" value="help_desk" />
                                                                            <label class="form-check-label" for="Help Desk"> Help Desk </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" id="Settings" value="settings" />
                                                                            <label class="form-check-label" for="Settings"> Settings </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input" type="checkbox" name="config[]" id="Modules" value="modules" />
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
                                                <button type="reset" class="btn btn-label-primary waves-effect me-sm-3 me-1">Clear All</button>
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
<link rel="stylesheet" href="{{ asset('assets/select2/select2.css') }}" /></script>
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

        });
    </script>
</body>

</html>
