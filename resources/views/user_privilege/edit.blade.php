<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Edit User Privileges</title>
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
        .user_privileges .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .user_privileges .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .user_privileges .form-control:focus,
        .user_privileges .form-select:focus,
        .user_privileges .input-group:focus-within .form-control,
        .user_privileges .input-group:focus-within .input-group-text {
            border-color: <?php echo $org_color; ?> !important;
        }

        .user_privileges .form-check-input:checked,
        .user_privileges .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .user_privileges .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .user_privileges .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .user_privileges .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .user_privileges .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .user_privileges i {
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

<body class="user_privileges">
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
                        <h4 class="mb-4" style="color: <?php echo $org_color; ?>;">Edit User Privileges</h4>
                        @error('user_privilege')
                        <span style="color:red;">{{ $message }}</span>
                        @enderror
                        <!-- Role cards -->
                        <div class="row g-4">

                            <div class="card">
                                <div class="card-body table_admin text-nowrap">
                                    <form id="addRoleForm_<?php echo $user_privilege->id; ?>" action="{{ route('user_privilege_update')}}" method="POST" class="row g-3">
                                        @csrf
                                        <input type="hidden" name="id" value="<?php echo $user_privilege->id; ?>">
                                        <div class="col-12">

                                            <?php
                                            $user_id = session()->get('loginId');
                                            $user_role_id = App\Models\User::getRoleID($user_id);
                                            if ($user_role_id == 1) {
                                                $site_config = App\Models\User::getSiteConfigs($user_id);
                                                $stie_config_arr = explode(',', $site_config);
                                            }
                                            $user_role_name = App\Models\User::getUserRoleNameByID($user_privilege->user_id);
                                            ?>
                                            <!-- Permission table -->
                                            <div class="table-responsive">
                                                <table class="table table-flush-spacing">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2" class="text-nowrap fw-medium">
                                                                <h5 style="color: <?php echo $org_color; ?> !important;"><b> <?php echo $user_role_name; ?></b>
                                                                    <?php
                                                                    $user_privilege->privileges;
                                                                    $user_privilege_arr = explode(',', $user_privilege->privileges);

                                                                    ?>
                                                                </h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input class="selectAll" type="checkbox" <?php if (count($user_privilege_arr) == 88) echo 'checked';  ?> data-id="{{ $user_privilege->id }}" id="selectAll_<?php echo $user_privilege->id; ?>" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="subjectsCreate" <?php if (in_array('subjectsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="subjectsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="subjectsRead" <?php if (in_array('subjectsRead', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="subjectsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="subjectsUpdate" <?php if (in_array('subjectsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="subjectsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="subjectsDelete" <?php if (in_array('subjectsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="departmentsCreate" <?php if (in_array('departmentsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="departmentsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="departmentsRead" <?php if (in_array('departmentsRead', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="departmentsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="departmentsUpdate" <?php if (in_array('departmentsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="departmentsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="departmentsDelete" <?php if (in_array('departmentsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="departmenstsDelete"> Suspend </label>
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="classsroomsCreate" <?php if (in_array('classsroomsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="classsroomsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="classsroomsRead" <?php if (in_array('classsroomsRead', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="classsroomsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="classsroomsUpdate" <?php if (in_array('classsroomsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="classsroomsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="classsroomsDelete" <?php if (in_array('classsroomsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="teachersCreate" <?php if (in_array('teachersCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="teachersCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="teachersRead" <?php if (in_array('teachersRead', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="teachersRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="teachersUpdate" <?php if (in_array('teachersUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="teachersUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="teachersDelete" <?php if (in_array('teachersDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="teachersDelete"> Suspend </label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <?php if (in_array('lecturers', $stie_config_arr)) { ?>
                                                            <tr>
                                                                <td class="text-nowrap fw-medium">Lecturers</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="lecturersCreate" <?php if (in_array('lecturersCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="studentsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="lecturersRead" <?php if (in_array('lecturersRead', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="studentsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="lecturersUpdate" <?php if (in_array('lecturersUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="studentsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="lecturersDelete" <?php if (in_array('lecturersDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="studentsCreate" <?php if (in_array('studentsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="studentsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="studentsRead" <?php if (in_array('studentsRead', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="studentsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="studentsUpdate" <?php if (in_array('studentsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="studentsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="studentsDelete" <?php if (in_array('studentsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="parentsCreate" <?php if (in_array('parentsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="parentsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="parentsRead" <?php if (in_array('parentsRead', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="parentsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="parentsUpdate" <?php if (in_array('parentsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="parentsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="parentsDelete" <?php if (in_array('parentsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="onlinecoursesCreate" <?php if (in_array('onlinecoursesCreate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="onlinecoursesCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="onlinecoursesRead" <?php if (in_array('onlinecoursesRead', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="onlinecoursesRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="onlinecoursesUpdate" <?php if (in_array('onlinecoursesUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="onlinecoursesUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="onlinecoursesDelete" <?php if (in_array('onlinecoursesDelete', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="materialsCreate" <?php if (in_array('materialsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="materialsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="materialsRead" <?php if (in_array('materialsRead', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="materialsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="materialsUpdate" <?php if (in_array('materialsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="materialsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="materialsDelete" <?php if (in_array('materialsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="quizzesandexamsCreate" <?php if (in_array('quizzesandexamsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="quizzesandexamsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="quizzesandexamsRead" <?php if (in_array('quizzesandexamsRead', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="quizzesandexamsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="quizzesandexamsUpdate" <?php if (in_array('quizzesandexamsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="quizzesandexamsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="quizzesandexamsDelete" <?php if (in_array('quizzesandexamsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="assignmentsCreate" <?php if (in_array('assignmentsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="assignmentsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="assignmentsRead" <?php if (in_array('assignmentsRead', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="assignmentsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="assignmentsUpdate" <?php if (in_array('assignmentsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="assignmentsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="assignmentsDelete" <?php if (in_array('assignmentsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="certificatesCreate" <?php if (in_array('certificatesCreate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="certificatesCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="certificatesRead" <?php if (in_array('certificatesRead', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="certificatesRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="certificatesUpdate" <?php if (in_array('certificatesUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="certificatesUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="certificatesDelete" <?php if (in_array('certificatesDelete', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="templatesCreate" <?php if (in_array('templatesCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="templatesCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="templatesRead" <?php if (in_array('templatesRead', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="templatesRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="templatesUpdate" <?php if (in_array('templatesUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="templatesUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="templatesDelete" <?php if (in_array('templatesDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="studentprogressCreate" <?php if (in_array('studentprogressCreate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="studentprogressCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="studentprogressRead" <?php if (in_array('studentprogressRead', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="studentprogressRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="studentprogressUpdate" <?php if (in_array('studentprogressUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="studentprogressUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="studentprogressDelete" <?php if (in_array('studentprogressDelete', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="branchesCreate" <?php if (in_array('branchesCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="branchesCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="branchesRead" <?php if (in_array('branchesRead', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="branchesRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="branchesUpdate" <?php if (in_array('branchesUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="branchesUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="branchesDelete" <?php if (in_array('branchesDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="humanresourcesCreate" <?php if (in_array('humanresourcesCreate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="humanresourcesCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="humanresourcesRead" <?php if (in_array('humanresourcesRead', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="humanresourcesRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="humanresourcesUpdate" <?php if (in_array('humanresourcesUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="humanresourcesUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="humanresourcesDelete" <?php if (in_array('humanresourcesDelete', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="accountingCreate" <?php if (in_array('accountingCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="accountingCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="accountingRead" <?php if (in_array('accountingRead', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="accountingRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="accountingUpdate" <?php if (in_array('accountingUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="accountingUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="accountingDelete" <?php if (in_array('accountingDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="agreementsCreate" <?php if (in_array('agreementsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="agreementsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="agreementsRead" <?php if (in_array('agreementsRead', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="agreementsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="agreementsUpdate" <?php if (in_array('agreementsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="agreementsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="agreementsDelete" <?php if (in_array('agreementsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="inventorylistsCreate" <?php if (in_array('inventorylistsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="inventorylistsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="inventorylistsRead" <?php if (in_array('inventorylistsRead', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="inventorylistsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="inventorylistsUpdate" <?php if (in_array('inventorylistsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="inventorylistsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="inventorylistsDelete" <?php if (in_array('inventorylistsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="servicesandproductsCreate" <?php if (in_array('servicesandproductsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                                            } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="servicesandproductsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="servicesandproductsRead" <?php if (in_array('servicesandproductsRead', $user_privilege_arr)) {
                                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                                            } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="servicesandproductsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="servicesandproductsUpdate" <?php if (in_array('servicesandproductsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                                            } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="servicesandproductsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="servicesandproductsDelete" <?php if (in_array('servicesandproductsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                                            } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="roleslistsCreate" <?php if (in_array('roleslistsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="roleslistsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="roleslistsRead" <?php if (in_array('roleslistsRead', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="roleslistsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="roleslistsUpdate" <?php if (in_array('roleslistsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="roleslistsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="roleslistsDelete" <?php if (in_array('roleslistsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="smartreportsCreate" <?php if (in_array('smartreportsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="smartreportsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="smartreportsRead" <?php if (in_array('smartreportsRead', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="smartreportsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="smartreportsUpdate" <?php if (in_array('smartreportsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="smartreportsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="smartreportsDelete" <?php if (in_array('smartreportsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="helpdeskCreate" <?php if (in_array('helpdeskCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="helpdeskCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="helpdeskRead" <?php if (in_array('helpdeskRead', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="helpdeskRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="helpdeskUpdate" <?php if (in_array('helpdeskUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="helpdeskUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="helpdeskDelete" <?php if (in_array('helpdeskDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="settingsCreate" <?php if (in_array('settingsCreate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="settingsCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="settingsRead" <?php if (in_array('settingsRead', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="settingsRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="settingsUpdate" <?php if (in_array('settingsUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="settingsUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="settingsDelete" <?php if (in_array('settingsDelete', $user_privilege_arr)) {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    } ?> name="user_privilege[]" />
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
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="modulesCreate" <?php if (in_array('modulesCreate', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="modulesCreate"> Create </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="modulesRead" <?php if (in_array('modulesRead', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="modulesRead"> Read </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="modulesUpdate" <?php if (in_array('modulesUpdate', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
                                                                            <label class="form-check-label" for="modulesUpdate"> Update </label>
                                                                        </div>
                                                                        <div class="form-check me-3 me-lg-5">
                                                                            <input class="form-check-input checkboxes_<?php echo $user_privilege->id; ?>" type="checkbox" value="modulesDelete" <?php if (in_array('modulesDelete', $user_privilege_arr)) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> name="user_privilege[]" />
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
                                            <button data-id="{{ $user_privilege->id }}" type="reset" class="btn btn-label-primary clear_all waves-effect me-sm-3 me-1">Clear All</button>
                                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                            <a href="{{route('user_privilege_list')}}" class="btn btn-label-secondary">
                                                Discard
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>

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



            <!-- User privilege  Modal -->
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
                var id = $(this).attr("data-id");
                if (this.checked) {
                    $(".checkboxes_" + id).prop("checked", true);
                } else {
                    $(".checkboxes_" + id).prop("checked", false);
                }
                // $('#addRoleForm_'+id).('input:checkbox').not(this).prop('checked', this.checked);
            });
            $('.clear_all').click(function() {
                var id = $(this).attr("data-id");

                $(".checkboxes_" + id).prop("checked", true);
                $(".checkboxes_" + id).removeAttr('checked');
                // $('#addRoleForm_'+id).('input:checkbox').not(this).prop('checked', this.checked);
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
