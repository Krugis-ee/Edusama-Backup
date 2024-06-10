<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add User Privilege</title>
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
        .user_roles .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .user_roles .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .user_roles .form-control:focus,
        .user_roles .form-select:focus,
        .user_roles .input-group:focus-within .form-control,
        .user_roles .input-group:focus-within .input-group-text {
            border-color: <?php echo $org_color; ?> !important;
        }

        .user_roles .form-check-input:checked,
        .user_roles .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .user_roles .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .user_roles .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .user_roles .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .user_roles .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .user_roles i {
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

        #roles_capabilities .form-check {
            width: 22%;
        }

        .template-customizer-open-btn {
            display: none !important;
        }

        a:hover,
        .role-edit-modal {
            color: <?php echo $org_color; ?> !important;
        }
    </style>

</head>

<body class="user_roles">
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
                        <h4 class="mb-4" style="color: <?php echo $org_color; ?>;">Add User Privilege</h4>

                        <!-- Role cards -->
                        <div class="row g-4">
                            @if (\Session::has('message'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('message') !!}</li>
                                </ul>
                            </div>
                            @endif
                            @if($errors->any())
                            @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                            @endif
                            <?php foreach ($user_role as $user_role) { ?>
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="fw-normal mb-2">Total <?php echo $count2 = DB::table('users')->where('user_role_id', '=', $user_role->id)->where('organization_id', $org_id)->where('type', 1)->count(); ?> users</h6>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-end mt-1">
                                                <div class="role-heading">
                                                    <h4 class="mb-1"><?php echo $user_role->role_name; ?></h4>
                                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editUserPrivileges_<?php echo $user_role->id; ?>" class="role-edit-modal"><span>Add User Privilege</span></a>
                                                </div>
                                                <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php

                                $users_list = App\Models\UserRole::getUsersByRoleID($user_role->id);
                                // print_r($users_list);
                                ?>
                                <!-- User privilege  Modal -->
                                <div class="modal fade" id="editUserPrivileges_<?php echo $user_role->id; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                                        <div class="modal-content p-3 p-md-5" style="padding: 3rem 0rem !important;">
                                            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <div class="modal-body">
                                                <div class="text-center mb-4">
                                                    <h3 class="role-title mb-2" style="color: <?php echo $org_color; ?>;">Add User Privileges</h3>
                                                </div>
                                                <!-- Add role form -->
                                                <form id="addRoleForm_<?php echo $user_role->id; ?>" action="{{ route('user_privilege_add')}}" method="POST" class="row g-3">
                                                    @csrf
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="usernamelist" class="form-label"><b>User Name</b></label>
                                                            <select class="form-select" id="usernamelist" name="user_id" aria-label="Default select example">
                                                                <option value=''>User Name List</option>
                                                                @foreach ($users_list as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <?php
                                                        $user_id = session()->get('loginId');
                                                        $user_role_id = App\Models\User::getRoleID($user_id);
                                                        if ($user_role_id == 1) {
                                                            $site_config = App\Models\User::getSiteConfigs($user_id);
                                                            $stie_config_arr = explode(',', $site_config);
                                                        } ?>
                                                        <!-- Permission table -->
                                                        <div class="table-responsive">
                                                            <table class="table table-flush-spacing">
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="2" class="text-nowrap fw-medium">
                                                                            <h5 style="color: <?php echo $org_color; ?> !important;"><b><?php echo $user_role->role_name; ?></b></h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>

                                                                        <td>
                                                                            <div class="form-check">
                                                                                <input class="selectAll" type="checkbox" data-roleid="{{ $user_role->id }}" id="selectAll_<?php echo $user_role->id; ?>" />
                                                                                <label class="form-check-label" for="selectAll"> Select All </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="background-color: #d3d3d34a;">
                                                                        <td class="text-nowrap fw-medium"><small class="text-light fw-medium text-uppercase">&nbsp;&nbsp;&nbsp;Academy Section</small></td>
                                                                        <td>
                                                                        </td>
                                                                    </tr>
                                                                    <?php if (in_array('subjects', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Subjects</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="subjectsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="subjectsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="subjectsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="subjectsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="subjectsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="subjectsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="subjectsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="subjectsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('departments', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Departments</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="departmentsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="departmentsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="departmentsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="departmentsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="departmentsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="departmentsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="departmentsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="departmentsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('classrooms', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Classsrooms</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="classsroomsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="classsroomsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="classsroomsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="classsroomsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="classsroomsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="classsroomsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="classsroomsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="classsroomsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('teachers', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Teachers</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="teachersCreate"  name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="teachersRead"  name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="teachersUpdate"  name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="teachersDelete"  name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('students', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Students</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="studentsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="studentsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="studentsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="studentsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('parents', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Parents</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="parentsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="parentsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="parentsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="parentsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="parentsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="parentsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="parentsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="parentsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('online_courses', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Online Courses</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="onlinecoursesCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="onlinecoursesCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="onlinecoursesRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="onlinecoursesRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="onlinecoursesUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="onlinecoursesUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="onlinecoursesDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="onlinecoursesDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('materials', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Materials</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="materialsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="materialsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="materialsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="materialsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="materialsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="materialsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="materialsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="materialsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('quizzes_and_exams', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Quizzes and Exams</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="quizzesandexamsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="quizzesandexamsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="quizzesandexamsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="quizzesandexamsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="quizzesandexamsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="quizzesandexamsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="quizzesandexamsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="quizzesandexamsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('assignments', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Assignments</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="assignmentsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="assignmentsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="assignmentsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="assignmentsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="assignmentsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="assignmentsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="assignmentsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="assignmentsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('certificates', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Certificates</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="certificatesCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="certificatesCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="certificatesRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="certificatesRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="certificatesUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="certificatesUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="certificatesDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="certificatesDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
																	<?php if (in_array('templates', $stie_config_arr)) { ?>
											<tr>
												<td class="text-nowrap fw-medium">Templates</td>
												<td>
													<div class="d-flex">
														<div class="form-check me-3 me-lg-5">
															<input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="templatesCreate" name="user_privilege[]" />
															<label class="form-check-label" for="templatesCreate"> Create </label>
														</div>
														<div class="form-check me-3 me-lg-5">
															<input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="templatesRead" name="user_privilege[]" />
															<label class="form-check-label" for="templatesRead"> Read </label>
														</div>
														<div class="form-check me-3 me-lg-5">
															<input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="templatesUpdate" name="user_privilege[]" />
															<label class="form-check-label" for="templatesUpdate"> Update </label>
														</div>
														<div class="form-check me-3 me-lg-5">
															<input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="templatesDelete" name="user_privilege[]" />
															<label class="form-check-label" for="templatesDelete"> Suspend </label>
														</div>
													</div>
												</td>
											</tr>
										<?php } ?>
                                                                    <?php if (in_array('student_progress', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Student Progress</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="studentprogressCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentprogressCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="studentprogressRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentprogressRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="studentprogressUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentprogressUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="studentprogressDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="studentprogressDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <tr style="background-color: #d3d3d34a;">
                                                                        <td class="text-nowrap fw-medium"><small class="text-light fw-medium text-uppercase">&nbsp;&nbsp;&nbsp;Management Section</small></td>
                                                                        <td>
                                                                        </td>
                                                                    </tr>
                                                                    <?php if (in_array('branches', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Branches</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="branchesCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="branchesCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="branchesRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="branchesRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="branchesUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="branchesUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="branchesDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="branchesDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('human_resources', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Human Resources</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="humanresourcesCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="humanresourcesCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="humanresourcesRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="humanresourcesRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="humanresourcesUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="humanresourcesUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="humanresourcesDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="humanresourcesDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('accounting', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Accounting</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="accountingCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="accountingCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="accountingRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="accountingRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="accountingUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="accountingUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="accountingDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="accountingDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('agreements', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Agreements</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="agreementsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="agreementsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="agreementsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="agreementsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="agreementsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="agreementsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="agreementsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="agreementsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('inventory_lists', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Inventory Lists</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="inventorylistsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="inventorylistsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="inventorylistsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="inventorylistsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="inventorylistsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="inventorylistsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="inventorylistsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="inventorylistsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('services_and_products', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Services and Products</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="servicesandproductsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="servicesandproductsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="servicesandproductsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="servicesandproductsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="servicesandproductsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="servicesandproductsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="servicesandproductsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="servicesandproductsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('users_and_roles', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Roles Lists</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="roleslistsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="roleslistsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="roleslistsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="roleslistsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="roleslistsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="roleslistsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="roleslistsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="roleslistsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('smart_reports', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Smart Reports</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="smartreportsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="smartreportsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="smartreportsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="smartreportsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="smartreportsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="smartreportsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="smartreportsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="smartreportsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <tr style="background-color: #d3d3d34a;">
                                                                        <td class="text-nowrap fw-medium"><small class="text-light fw-medium text-uppercase">&nbsp;&nbsp;&nbsp;Support Section</small></td>
                                                                        <td>
                                                                        </td>
                                                                    </tr>
                                                                    <?php if (in_array('help_desk', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Help Desk</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="helpdeskCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="helpdeskCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="helpdeskRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="helpdeskRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="helpdeskUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="helpdeskUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="helpdeskDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="helpdeskDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('settings', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Settings</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="settingsCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="settingsCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="settingsRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="settingsRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="settingsUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="settingsUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="settingsDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="settingsDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php if (in_array('modules', $stie_config_arr)) { ?>
                                                                        <tr>
                                                                            <td class="text-nowrap fw-medium">Modules</td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="modulesCreate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="modulesCreate"> Create </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="modulesRead" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="modulesRead"> Read </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="modulesUpdate" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="modulesUpdate"> Update </label>
                                                                                    </div>
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input class="form-check-input checkboxes_<?php echo $user_role->id; ?>" type="checkbox" value="modulesDelete" name="user_privilege[]" />
                                                                                        <label class="form-check-label" for="modulesDelete"> Suspend </label>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- Permission table -->
                                                    </div>
                                                    <div class="col-12 text-center mt-4">
                                                        <button type="reset" class="btn btn-label-primary waves-effect me-sm-3 me-1">Clear All</button>
                                                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                            Discard
                                                        </button>
                                                    </div>
                                                </form>
                                                <!--/ Add role form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ User privilege  Modal -->
                            <?php } ?>



                        </div>
                        <!--/ Role cards -->



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
    @include('dashboard.footer')
    <script type="text/javascript">
        new DataTable('#example', {
            scrollX: true
        });
    </script>
    <script>
        $(function() {
            $('.selectAll').click(function() {
                var roleid = $(this).attr("data-roleid");
                if (this.checked) {
                    $(".checkboxes_" + roleid).prop("checked", true);
                } else {
                    $(".checkboxes_" + roleid).prop("checked", false);
                }
                // $('#addRoleForm_'+roleid).('input:checkbox').not(this).prop('checked', this.checked);
            });
            $('.form-check-input').click(function() {
                var numberOfChecked = $('.form-check-input:checked').length;
                var totalCheckboxes = $('.form-check-input').length;

                if (numberOfChecked == 88)
                    $('.selectAll').prop('checked', true);
                else
                    $('.selectAll').prop('checked', false);
                /*if(totalCheckboxes == numberOfChecked)
   $('#all').prop('checked', true);
else
$('#all').prop('checked', false);*/

            });
        });
    </script>
</body>

</html>
