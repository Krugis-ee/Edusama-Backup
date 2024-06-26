<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Teacher Attendance</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.css') }}" />

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
    <style type="text/css">
        .list_attendance #logo_color {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .list_attendance .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .list_attendance .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .list_attendance .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .list_attendance .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .list_attendance .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .list_attendance .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .list_attendance .icon_resize {
            font-size: 17px !important;
        }

        .list_attendance #layout-menu .icon_resize {
            margin-right: 10px;
        }

        .layout-navbar-fixed .layout-page:before {
            background: #0000000d;
            mask: none;
        }

        .list_attendance #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .table_admin select#dt-length-0,
        .table_admin select#dt-length-1,
        .table_admin select#dt-length-2 {
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

        td {
            box-shadow: none !important;
        }

        .dt-layout-row {
            padding-bottom: 20px;
        }

        .table_admin th {
            color: #5d596c;
            font-weight: normal;
            text-transform: uppercase;
            font-size: 0.8125rem;
            letter-spacing: 1px;
        }

        .table_admin .dt-paging-button.current {
            background: rgba(75, 70, 92, 0.08);
            border: 1px solid #aaa;
        }

        .table_admin .dt-paging-button.current:active {
            color: #6f6b7d !important;
            background-color: #fff !important;
            border-color: #7367f0 !important;
            outline: 0 !important;
            box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3) !important;
        }

        .table_admin th {
            color: #5d596c !important;
            font-weight: normal !important;
            text-transform: uppercase !important;
            font-size: 0.8125rem !important;
            letter-spacing: 1px !important;
            text-align: center !important;
        }

        .table_admin td {
            text-align: center !important;
        }

        .table_admin .dt-paging-button.current {
            background: rgba(75, 70, 92, 0.08) !important;
            border: 1px solid #aaa !important;
        }

        .table_admin .dt-paging-button.current:active {
            color: #6f6b7d !important;
            background-color: #fff !important;
            border-color: #7367f0 !important;
            outline: 0 !important;
            box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3) !important;
        }

        tr td,
        tr th {
            text-align: left !important;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #fce4e4;
            border-color: #fce4e4;
            color: inherit !important;
        }

        .dropdown-item:not(.disabled).active,
        .dropdown-item:not(.disabled):active {
            background-color: <?php echo $org_color; ?>;
            color: #fff !important;
        }

        html:not(.layout-menu-collapsed) .bg-menu-theme .menu-inner .menu-item:not(.active)>.menu-link:hover {
            background-color: #fce4e4 !important;
            border-color: #fce4e4 !important;
            color: inherit !important;
        }

        #pagetitle,
        #modalCenterTitle,
        #exampleModalLabel5,
        .carousel-control-prev,
        .carousel-control-next,
        .carousel-control-prev:hover,
        .carousel-control-prev:focus,
        .carousel-control-next:hover,
        .carousel-control-next:focus {
            color: <?php echo $org_color; ?>;
        }

        .modal-onboarding .carousel-indicators [data-bs-target] {
            background-color: <?php echo $org_color; ?>;
        }

        .form-check-input:checked,
        .form-check-input[type=checkbox]:indeterminate {
            color: <?php echo $org_color; ?>;
            background-color: <?php echo $org_color; ?>;
            border-color: <?php echo $org_color; ?>;
        }

        .word_ellipsis {
            white-space: nowrap;
            /*      width: 100px;*/
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
            padding: 5px 10px;
            border-radius: 5px;
            margin: auto;
        }

        #adminattendance_lists:hover {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .grid {
            position: relative;
            border: 1px solid #000;
            padding-top: 37px;
            background: #e3071ec9;
            width: 100%;
        }

        table#student_attendance {
            border-spacing: 0;
            width: 100%;
        }

        #student_attendance td+#student_attendance td {
            border-left: 1px solid #000;
        }

        #student_attendance td,
        #student_attendance th {
            border-bottom: 1px solid #000;
            background: #fff;
            color: #000;
            padding: 10px 25px;
        }

        #student_attendance th {
            height: 0;
            line-height: 0;
            padding-top: 0;
            padding-bottom: 0;
            color: transparent;
            border: none;
            white-space: nowrap;
        }

        #student_attendance th div {
            position: absolute;
            background: transparent;
            color: #fff;
            font-weight: 700;
            padding: 9px 25px;
            top: 0;
            margin-left: -25px;
            line-height: normal;
            border-left: 1px solid #e3071ec9;
        }
    </style>
</head>

<body class="list_attendance">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('teacher_dashboard.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('teacher_dashboard.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y" id="lists_attendance_admin">
                        <div class="app-ecommerce mb-4">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <h4 class="mb-1 mt-3" id="pagetitle">Student Attendance List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4" id="filter_table">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4" id="classroom_attendance">
                                        <label class="form-label">Classroom</label>
                                        <select id="attendance_classroom" class="form-select class_room_id" name="class_room_id">
                                            <option value="">Select Classroom</option>
                                            <option value="all">All</option>
                                            @foreach ($class_rooms as $class_room)
                                            <option value="<?php isset($class_room) ? print_r($class_room->class_room_id) : '' ?>">{{App\Models\ClassRooms::getClassRoomNameById($class_room->class_room_id)}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" class="teacher_id" value="{{$teacher_id}}">
                                    </div>
                                    <!-- Group -->
                                    <div class="col-md-4" id="subject_attendance">
                                        <label class="form-label">Subject</label>
                                        <select id="attendance_subject" class="form-select subject_id" name="subject_id">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card col-12" id="admin_stdcertificate_lists">
                            <div class="card-body table_admin text-nowrap">
                                <table id="adminattendacelists" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr style="background-color: #f5c6cb30;">
                                            <th>Classroom Name</th>
                                            <th>Subject Name</th>
                                            <th>Total No. Of Students</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="word_ellipsis adminattendance_lists" id="adminattendance_lists" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Classroom 1" style="cursor:pointer;" data-value="create">Classroom 1</div>
                                            </td>
                                            <td>Subject 1</td>
                                            <td>50</td>
                                            <td>
                                                <span data-bs-toggle="modal" data-bs-target="#preview_template">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Preview" class="badge bg-primary badge-center">
                                                        <i class="ti ti-eye"></i>
                                                    </span>
                                                </span>
                                                <div class="modal fade" id="preview_template" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                    Branch Name
                                                                </h5>
                                                            </div>
                                                            <div class="modal-body" style="text-align: left;">
                                                                <div class="row g-2">
                                                                    <div class="col mb-2">
                                                                        <label for="firstname" class="form-label">Classroom</label>
                                                                        <input type="text" class="form-control" id="Classroom" placeholder="" value="Classroom 1" readonly />
                                                                    </div>
                                                                    <div class="col mb-2">
                                                                        <label for="lastname" class="form-label">Subject</label>
                                                                        <input type="text" class="form-control" id="Classroom" placeholder="" value="Subject 1" readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="row g-2">
                                                                    <div class="col mb-2">
                                                                        <label for="exampleFormControlInput1" class="form-label">Duration</label>
                                                                        <input type="text" class="form-control" id="Teacher" value="3months" readonly />
                                                                    </div>
                                                                    <div class="col mb-2">
                                                                        <label for="mobile" class="form-label">No. Of Students</label>
                                                                        <input type="text" class="form-control" id="Students" placeholder="" value="50" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-label-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning adminattendance_lists" data-value="edit">
                                                    <i class="ti ti-edit"></i>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="word_ellipsis adminattendance_lists" id="adminattendance_lists" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Classroom 2" style="cursor:pointer;">Classroom 2</div>
                                            </td>
                                            <td>Subject 2</td>
                                            <td>30</td>
                                            <td>
                                                <span data-bs-toggle="modal" data-bs-target="#preview_template">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Preview" class="badge bg-primary badge-center">
                                                        <i class="ti ti-eye"></i>
                                                    </span>
                                                </span>
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning">
                                                    <i class="ti ti-edit"></i>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="word_ellipsis adminattendance_lists" id="adminattendance_lists" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Classroom 3" style="cursor:pointer;">Classroom 3</div>
                                            </td>
                                            <td>Subject 3</td>
                                            <td>60</td>
                                            <td>
                                                <span data-bs-toggle="modal" data-bs-target="#preview_template">
                                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Preview" class="badge bg-primary badge-center">
                                                        <i class="ti ti-eye"></i>
                                                    </span>
                                                </span>
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning">
                                                    <i class="ti ti-edit"></i>
                                                </span>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="container-xxl flex-grow-1 container-p-y" id="student_attendances">
                        <div class="app-ecommerce mb-3">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <h4 class="mb-1 mt-3" id="pagetitle">Student Lists</h4>
                                </div>
                                <div class="d-flex align-content-center flex-wrap gap-3">
                                    <button class="btn btn-label-secondary btn-prev waves-effect" id="adminattendancelist">
                                        <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                        <span class="align-middle d-sm-inline-block d-none">Back</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="row mb-4 mt-4">
                                    <div class="d-flex align-content-center flex-wrap col-3">
                                        <label for="flatpickr-date" class="form-label">Filter By Date</label>
                                        <input type="text" class="form-control" placeholder="DD-MM-YYYY" id="flatpickr-date" />
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn rounded-pill btn-label-success waves-effect mt-4" id="show_attendance">Show</button>
                                    </div>
                                    <div class="col-5"></div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-label-dark waves-effect mt-4" id="export_attendance" style="float:right;display: none !important;">Export&nbsp;<i class="icon_resize ti ti-file-arrow-right ti-sm"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="grid" id="attendance_grid">
                                <div class="grid-container">
                                    <table id="student_attendance">
                                        <thead>
                                            <tr class="header">
                                                <th>Student Name
                                                    <div>Student Name</div>
                                                </th>
                                                <th>Present
                                                    <div>Present</div>
                                                </th>
                                                <th>Absent
                                                    <div>Absent</div>
                                                </th>
                                                <th>Half Day
                                                    <div>Half Day</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Suresh Dasari</td>
                                                <td class="form-check-success">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[1][]" id="customCheckSuccess" />&nbsp;Present
                                                    </label>
                                                </td>
                                                <td class="form-check-danger">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[1][]" id="customCheckDanger" />&nbsp;Absent
                                                    </label>
                                                </td>
                                                <td class="form-check-warning">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[1][]" id="customCheckWarning" />&nbsp;Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Rohini Dasari</td>
                                                <td class="form-check-success">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[2][]" id="customCheckSuccess" />&nbsp;Present
                                                    </label>
                                                </td>
                                                <td class="form-check-danger">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[2][]" id="customCheckDanger" />&nbsp;Absent
                                                    </label>
                                                </td>
                                                <td class="form-check-warning">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[2][]" id="customCheckWarning" />&nbsp;Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Madhav Sai</td>
                                                <td class="form-check-success">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[3][]" id="customCheckSuccess" />&nbsp;Present
                                                    </label>
                                                </td>
                                                <td class="form-check-danger">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[3][]" id="customCheckDanger" />&nbsp;Absent
                                                    </label>
                                                </td>
                                                <td class="form-check-warning">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[3][]" id="customCheckWarning" />&nbsp;Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Praveen Kumar</td>
                                                <td class="form-check-success">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[4][]" id="customCheckSuccess" />&nbsp;Present
                                                    </label>
                                                </td>
                                                <td class="form-check-danger">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[4][]" id="customCheckDanger" />&nbsp;Absent
                                                    </label>
                                                </td>
                                                <td class="form-check-warning">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[4][]" id="customCheckWarning" />&nbsp;Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mahendra Dasari</td>
                                                <td class="form-check-success">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[5][]" id="customCheckSuccess" />&nbsp;Present
                                                    </label>
                                                </td>
                                                <td class="form-check-danger">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[5][]" id="customCheckDanger" />&nbsp;Absent
                                                    </label>
                                                </td>
                                                <td class="form-check-warning">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[5][]" id="customCheckWarning" />&nbsp;Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nagaraju Dasari</td>
                                                <td class="form-check-success">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[6][]" id="customCheckSuccess" />&nbsp;Present
                                                    </label>
                                                </td>
                                                <td class="form-check-danger">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[6][]" id="customCheckDanger" />&nbsp;Absent
                                                    </label>
                                                </td>
                                                <td class="form-check-warning">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[6][]" id="customCheckWarning" />&nbsp;Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mahendra Dasari</td>
                                                <td class="form-check-success">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[5][]" id="customCheckSuccess" />&nbsp;Present
                                                    </label>
                                                </td>
                                                <td class="form-check-danger">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[5][]" id="customCheckDanger" />&nbsp;Absent
                                                    </label>
                                                </td>
                                                <td class="form-check-warning">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[5][]" id="customCheckWarning" />&nbsp;Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nagaraju Dasari</td>
                                                <td class="form-check-success">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[6][]" id="customCheckSuccess" />&nbsp;Present
                                                    </label>
                                                </td>
                                                <td class="form-check-danger">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[6][]" id="customCheckDanger" />&nbsp;Absent
                                                    </label>
                                                </td>
                                                <td class="form-check-warning">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[6][]" id="customCheckWarning" />&nbsp;Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mahendra Dasari</td>
                                                <td class="form-check-success">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[5][]" id="customCheckSuccess" />&nbsp;Present
                                                    </label>
                                                </td>
                                                <td class="form-check-danger">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[5][]" id="customCheckDanger" />&nbsp;Absent
                                                    </label>
                                                </td>
                                                <td class="form-check-warning">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[5][]" id="customCheckWarning" />&nbsp;Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nagaraju Dasari</td>
                                                <td class="form-check-success">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[6][]" id="customCheckSuccess" />&nbsp;Present
                                                    </label>
                                                </td>
                                                <td class="form-check-danger">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[6][]" id="customCheckDanger" />&nbsp;Absent
                                                    </label>
                                                </td>
                                                <td class="form-check-warning">
                                                    <label>
                                                        <input type="checkbox" class="radio form-check-input" value="1" name="fooby[6][]" id="customCheckWarning" />&nbsp;Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="pt-4" style="float: right;" id="attendance_submit">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                <button type="reset" class="btn btn-label-danger waves-effect">Cancel</button>
                            </div>

                        </div>
                        <!-- Content -->
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
    <script src="{{asset('assets/moment/moment.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/pickr/pickr-themes.css')}}" />

    <script src="{{asset('assets/js/forms-pickers.js')}}"></script>

    <script>
        $(document).ready(function() {
            $("#attendance_grid").hide();
            $("#attendance_submit").hide();
            $("#export_attendance").hide();

            $("#show_attendance").click(function() {
                $("#attendance_grid").show();
                $("#attendance_submit").show();
                $("#export_attendance").show();
            });

        });


        $(document).ready(function() {
            $("#student_attendances").hide();

            $(".adminattendance_lists").click(function() {

                var edit_create = $(this).attr("data-value");

                if (edit_create == "create") {

                    $("#lists_attendance_admin").hide();
                    $("#student_attendances").show();
                } else if (edit_create == "edit") {
                    $("#lists_attendance_admin").hide();
                    $("#student_attendances").show();
                    $("#attendance_grid").show();
                    $("#attendance_submit").show();
                    $("#export_attendance").show();
                    $("#flatpickr-date").val('11-06-2024');
                }
            });

            $("#adminattendancelist").click(function() {
                $("#student_attendances").hide();
                $("#lists_attendance_admin").show();
            });
        });

        $(document).ready(function() {
            $('#admin_stdcertificate_lists').hide();
            $('#subject_attendance').hide();

            $('#attendance_classroom').change(function() {

                $(this).find("option:selected").each(function() {
                    var optionValue2 = $(this).attr("value");
                    if (optionValue2) {
                        $('#subject_attendance').show();
                        $('#admin_stdcertificate_lists').show();
                    } else {
                        $('#subject_attendance').hide();
                        $('#admin_stdcertificate_lists').hide();
                    }

                });
            });
        });
    </script>
    <script>
        $('.class_room_id').change(function() {
            var class_room_id = $(this).val();
            var teacher_id = $('.teacher_id').val();
            // $('input[name="id_branch"]').val(branch_id);
            // $('#subject_div').css('display', 'block');
            $.ajax({
                url: '{{ route("get_subjects_by_classroom_id_teacher") }}',
                type: 'GET',
                data: {
                    'class_room_id': class_room_id,
                    'teacher_id': teacher_id,
                },
                success: function(response) {
                    console.log(response);
                    var subjects = response['subjects'];
                    var select_content = '<option value="">Select Subject</option>';
                    select_content = select_content + '<option value="all">All</option>';
                    for (i = 0; i < subjects.length; i++) {
                        var subject_id = subjects[i].subject_id;
                        var subject_name = subjects[i].subject_name;
                        select_content = select_content + '<option value="' + subject_id + '">' + subject_name + '</option>';
                    }
                    $('.subject_id').html(select_content);
                }
            });
        });

        $('.subject_id').change(function() {
                    var class_room_id = $('.class_room_id').val();
                    var subject_id = $(this).val();
                    // $('input[name="id_branch"]').val(branch_id);
                    // $('#subject_div').css('display', 'block');
                    $.ajax({
                            url: '{{ route("list_classroom") }}',
                            type: 'GET',
                            data: {
                                'class_room_id': class_room_id,
                                'subject_id': subject_id,
                            },
                            success: function(response) {
                                console.log(response);
                                var items = '';
                                if (response['class_room_list']) {

                                    $.each(response['class_room_list'], function(i, item) {
                                        var rows = "<tr>" +
                                        '<td><div class="word_ellipsis adminattendance_lists" id="adminattendance_lists" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Classroom 1" style="cursor:pointer;" data-value="create">"'+ item.class_room_id+'"</div></td>'+
                                        '<td>"'+item.subject_id+'"</td>'+
                                        '<td>"'+item.students_id+'"</td>'+
                                        '<td><span data-bs-toggle="modal" data-bs-target="#preview_template"><span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Preview" class="badge bg-primary badge-center"><i class="ti ti-eye"></i></span></span><div data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning adminattendance_lists" data-value="edit"><i class="ti ti-edit"></i></div></td>'+
                                        "</tr>";
                                        $('#admin_stdcertificate_lists tbody').append(rows);
                                    })
                                }
                            }
                            });
                    });
    </script>
    <script type="text/javascript">
        new DataTable('#adminattendacelists', {
            scrollX: true
        });
    </script>

    <script type="text/javascript">
        $("#student_attendance input:checkbox").on('click', function() {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {
                // the name of the box is retrieved using the .attr() method
                // as it is assumed and expected to be immutable
                var group = "input:checkbox[name='" + $box.attr("name") + "']";
                // the checked state of the group/box on the other hand will change
                // and the current value is retrieved using .prop() method
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });
    </script>

</body>

</html>
