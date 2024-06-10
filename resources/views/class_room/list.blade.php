<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>List Classrooms</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>
    <style type="text/css">
        tr td,
        tr th {
            text-align: left !important;
        }

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
            background-color: #7367f0 !important;
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
    <style type="text/css">
        .list_classroom .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .list_classroom .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .list_classroom .form-check-input:checked,
        .list_classroom .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .list_classroom .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        /*.list_classroom .bg-primary{
         background-color: #7367f0 !important;
         }*/
        .list_classroom .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .list_classroom .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .list_classroom .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .list_classroom .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .list_classroom .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .list_classroom i {
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

        .list_classroom #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .list_classroom .card-title,
        .list_classroom .create-new {
            display: none !important;
        }

        .admin_list th:nth-child(6),
        .admin_list th:nth-child(7),
        .admin_list th:nth-child(8),
        .admin_list th:nth-child(9),
        .admin_list th:nth-child(10) {
            display: none !important;
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

        .custom-tooltip {
            --bs-tooltip-bg: #a8aaae !important;
            cursor: pointer;
        }

        .module_tooltip:hover {
            cursor: pointer;
        }

        #list_classroom_wrapper .avatar-initial {
            font-size: 12px;
        }

        #list_classroom_wrapper tr td,
        #list_classroom_wrapper tr th {
            text-align: left !important;
        }

        #list_classroom_wrapper th {
            padding-left: 5px !important;
            padding-right: 20px !important;
            width: 12%;
        }

        .class_integrations {
            color: inherit;
        }

        .class_integrations:hover {
            background-color: <?php echo $org_color; ?>;
            color:#ffffff;
            border-radius: 5px;
            padding: 10px;
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
                        <div class="app-ecommerce mb-4">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">List Classrooms</h4>
                                </div>
                                <?php
                                $show_add = 0;
                                $show_edit = 0;
                                $show_suspend = 0;
                                $user_id = session()->get('loginId');
                                $user_role_id = App\Models\User::getRoleID($user_id);
                                $privileges = App\Models\UserPrivilege::getPrivilegesByUserId($user_id);
                                $privileges_arr = explode(',', $privileges);
                                //Add
                                if ($user_role_id == 1)
                                    $show_add = 1;
                                $primary_roles = array(1, 2, 3, 4);
                                if (!in_array($user_role_id, $primary_roles)) {

                                    if (in_array('classsroomsCreate', $privileges_arr)) {
                                        $show_add = 1;
                                    }
                                }
                                //Add
                                //edit
                                if ($user_role_id == 1)
                                    $show_edit = 1;
                                //$primary_roles = array(1, 2, 3, 4);
                                if (!in_array($user_role_id, $primary_roles)) {

                                    if (in_array('classsroomsUpdate', $privileges_arr)) {
                                        $show_edit = 1;
                                    }
                                }
                                //edit
                                //Suspend
                                if ($user_role_id == 1)
                                    $show_suspend = 1;
                                //$primary_roles = array(1, 2, 3, 4);
                                if (!in_array($user_role_id, $primary_roles)) {

                                    if (in_array('classsroomsDelete', $privileges_arr)) {
                                        $show_suspend = 1;
                                    }
                                }
                                //Suspend
                                ?>
                                <?php if ($show_add == 1) { ?>
                                    <div class="d-flex align-content-center flex-wrap gap-3">
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('class_room_add_get','manual_creation') }}">
                                                <button class="btn btn-primary" type="button">
                                                    <span>
                                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                                        <span class="d-none d-sm-inline-block">Add Classroom</span>
                                                    </span>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <span class="alert-icon text-warning me-2">
                                <i class="ti ti-bell ti-xs"></i>
                            </span>
                            Click on <b>&nbsp;Classroom Name&nbsp;</b> to assign students.
                        </div>
                        <div class="card">
                            <div class="card-body table_admin text-nowrap">
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

                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif

                                @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session()->get('error') }}
                                </div>
                                @endif
                                <input type="hidden" id="ajax_url" name="ajax_url" value="{{route('change_class_room_status')}}">
                                <div class="card-body table_admin text-nowrap">
                                <table id="list_classroom" class="display example" style="width:100%">
                                    <thead>
                                        <tr style="background-color: #f5c6cb30;">
                                            <th>Classroom</th>
                                            <th>Branch</th>
                                            <th>Duration</th>
                                            <th>Subject</th>
                                            <th>Status</th>
                                            <th>Teacher</th>
                                            <!--th>Student</th-->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($class_rooms as $classroom)
                                        <tr>
                                            @if($classroom->type == 1)
                                            <td><a data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Click to Manage Classroom" href="{{route('manage_class_room',$classroom->id)}}" class="class_integrations">{{ $classroom->class_room_name }}</a></td>
                                            @endif
                                            @if($classroom->type ==2)
                                            <td><a data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="This classroom is suspended,please activate classroom before assigning students." href="" class="class_integrations">{{ $classroom->class_room_name }}</a></td>
                                            @endif
                                            <td>
                                                <?php $branch_name = App\Models\Branch::getBranchNameByBranchId($classroom->branch_id);
                                                echo $branch_name;
                                                ?></td>
                                            <td>{{ $classroom->duration }}</td>
                                            <td>
                                                <div class="d-flex avatar-group my-3">
                                                    <?php
                                                    $subjects_teachers = App\Models\ClassRoomSubjectTeachers::where('class_room_id', $classroom->id)->get();
                                                    if ($subjects_teachers) {
                                                        $count_subjects = count($subjects_teachers);
                                                        $i = 0;
                                                        foreach ($subjects_teachers as $subjects_teacher) {

                                                            $subject_id = $subjects_teacher->subject_id;
                                                            $subject_obj = App\Models\Subject::find($subject_id);
                                                            if ($i < 2) {
                                                                $subject_short_name = '';
                                                                $subject_name = '';
                                                                if ($subject_obj) {
                                                                    $subject_short_name = $subject_obj->short_code;
                                                                    $subject_name = $subject_obj->subject_name;
                                                                }
                                                    ?>
                                                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="{{ $subject_name }}" class="avatar pull-up">
                                                                    <span class="avatar-initial rounded-circle bg-label-success">{{ $subject_short_name}}</span>
                                                                </div>
                                                    <?php $i++;
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    $remain_count = $count_subjects - $i; ?>
                                                    <?php if ($remain_count > 0) { ?>
                                                        <div class="avatar">
                                                            <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $remain_count.' more' }}">+{{$remain_count}}</span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if ($classroom->type == 1) { ?>
                                                    <span class="badge rounded-pill bg-success">Active</span>
                                                <?php }
                                                if ($classroom->type == 2) {
                                                ?>
                                                    <span class="badge rounded-pill bg-danger" title="{{$classroom->suspend_msg}}" style="cursor: pointer;">Suspended</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="d-flex avatar-group my-3">
                                                    <?php
                                                    $teachers = App\Models\ClassRoomSubjectTeachers::where('class_room_id', $classroom->id)->get();
                                                    if ($teachers) {
                                                        $count_teachers = count($teachers);
                                                        $i = 0;
                                                        foreach ($teachers as $teacher) {

                                                            $teacher_id = $teacher->teacher_id;
                                                            $teacher_obj = App\Models\User::find($teacher_id);
                                                            if ($i < 2) {
                                                                $teacher_avatar_name = !empty($teacher_obj->teacher_avatar) ? $teacher_obj->teacher_avatar : "3.png";
                                                    ?>
                                                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="{{ $teacher_obj->first_name.' '.$teacher_obj->last_name }}" class="avatar pull-up">
                                                                    <img src="{{ asset('assets/img/teacher_avatar/'.$teacher_avatar_name)}}" alt="Avatar" class="rounded-circle pull-up" />
                                                                </div>
                                                    <?php
                                                                $i++;
                                                            }
                                                        }
                                                    } ?>
                                                    <?php
                                                    $remain_count = $count_teachers - $i; ?>
                                                    <?php if ($remain_count > 0) { ?>
                                                        <div class="avatar">
                                                            <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $remain_count.' more' }}">+{{$remain_count}}</span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <!--td>
                                                <div class="d-flex avatar-group my-3">
                                                    <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Darcey Nooner" class="avatar pull-up">
                                                        <img src="{{ asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle pull-up" />
                                                    </div>
                                                    <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol" class="avatar pull-up">
                                                        <img src="{{ asset('assets/img/avatars/12.png')}}" alt="Avatar" class="rounded-circle pull-up" />
                                                    </div>
                                                    <div class="avatar">
                                                        <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="bottom" title="3 more">+3</span>
                                                    </div>
                                                </div>
                                            </td-->
                                            <td>
                                                <?php
                                                $id = $classroom->id;
                                                if ($classroom->add_type == 1)
                                                    $add_type = 'manual_updation';
                                                if ($classroom->add_type == 2)
                                                    $add_type = 'using_template';
                                                ?>
                                                <?php if ($show_edit == 1) { ?>
                                                    <a href="{{ route('class_room_edit',[$id,$add_type]) }}">
                                                        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning">
                                                            <i class="ti ti-edit"></i>
                                                        </span>
                                                    </a>
                                                <?php } ?>
                                                <?php if ($show_suspend == 1) {
                                                    if ($classroom->type == 1) { ?>
                                                        <button style="border: none;">
                                                            <span data-bs-toggle="tooltip" title="Suspend" style="cursor: pointer; background-color:#ea5455" data-bs-placement="bottom" id="suspend" class="badge badge-center toggle-class" data-id="{{ $id }}" data-name="{{$classroom->class_room_name}}" data-type="{{$classroom->type}}">
                                                                <i class="ti ti-droplet-exclamation"></i>
                                                            </span>
                                                        </button>
                                                    <?php }
                                                    if ($classroom->type == 2) {
                                                    ?>
                                                        <button style="border: none;">
                                                            <span data-bs-toggle="tooltip" title="Activate" style="cursor: pointer; background-color:#28c76f" data-bs-placement="bottom" id="suspend" class="badge badge-center toggle-class" data-id="{{ $id }}" data-name="{{$classroom->class_room_name}}" data-type="{{$classroom->type}}">
                                                                <i class="ti ti-droplet-exclamation"></i>
                                                            </span>
                                                        </button>
                                                <?php }
                                                } ?>
                                                <?php if ($user_role_id == 1) {
                                                    if ($classroom->zoom_start_url) {
                                                ?>
                                                        <a target="_blank" href="{{ $classroom->zoom_start_url }}">
                                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" title="Zoom Meeting" class="badge badge-center bg-primary">
                                                                <i class="ti ti-brand-zoom"></i>
                                                            </span>
                                                        </a>
                                                    <?php }  ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        @endforeach

                                        <!-- Active -->
                                        <div class="modal fade" id="org_suspend" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Activate <span class="name"></span></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('change_class_room_status')}}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <span>Are you sure, you want to activate <b class="name">Edusama</b></span>
                                                                    <input type="hidden" id="status_active" name="status" value="1" />
                                                                    <input type="hidden" id="id_active" name="id" />
                                                                    <input type="hidden" id="suspend_msg" name="suspend_msg" value="" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">
                                                                No
                                                            </button>
                                                            <button type="submit" id="logo_color" class="btn btn-primary">Yes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Suspend -->

                                        <div class="modal fade" id="org_active" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Suspend <span class="name"></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('change_class_room_status')}}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameWithTitle" class="form-label">Reason</label>
                                                                    <textarea id="nameWithTitle" name="suspend_msg" class="form-control" placeholder="Enter Reason"></textarea>
                                                                    <input type="hidden" id="status" name="status" value="2" />
                                                                    <input type="hidden" id="id" name="id" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="submit" id="logo_color" class="btn btn-primary">Suspend</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                     </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                        <!-- Modal to add new record -->
                    </div>
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
    <script src="{{ asset('assets/js/tables-datatables-extensions.js') }}"></script>
    <script>
        new DataTable('#list_classroom', {
            scrollX: true
        });
    </script>
    <script>
        $(function() {
            // $('#suspend').on("click",function() {
           $("#list_classroom").on("click", ".toggle-class", function() {

                if ($(this).data('type') == 1) {
                    var user_id = $(this).data('id');
                    $("#id").val(user_id);
                    $(".name").html($(this).data('name'));
                    $("#org_active").modal('show');
                } else if ($(this).data('type') == 2) {
                    var user_id = $(this).data('id');
                    $("#id_active").val(user_id);
                    $(".name").html($(this).data('name'));
                    $("#org_suspend").modal('show');
                }
            });
        });
    </script>
</body>

</html>
