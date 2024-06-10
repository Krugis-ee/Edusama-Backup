<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>List Roles</title>
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

        .role-edit-modal:hover,
        .role-edit-modal {
            color: #7367f0 !important;
        }

        .role-suspend {
            color: <?php echo $org_color; ?> !important;
        }

        .role-suspend:hover {
            color: <?php echo $org_color; ?> !important;
            cursor: pointer;
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
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">List Roles </h4>
                            @error('role_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <p style="height: 2px;"></p>
                        <input type="hidden" id="ajax_url" name="ajax_url" value="{{route('change_user_role_status')}}">
                        <!-- Role cards -->
                        <div class="row g-4" id="example">
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
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card h-100">
                                    <div class="row h-100">
                                        <div class="col-sm-5">
                                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                                <img src="{{asset('assets/img/illustrations/add-new-roles.png')}}" class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="300" />
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="card-body text-sm-end text-center ps-sm-0">
                                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal" class="btn btn-primary mb-2 text-nowrap add-new-role">
                                                    Add New Role
                                                </button>
                                                <p class="mb-0 mt-1">Add role, if it does not exist</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                    <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editRoleModal_<?php echo $user_role->id; ?>" class="role-edit-modal"><span>Edit Role</span></a>
                                                </div>
                                                <?php if ($user_role->type == 1) { ?>
                                                    <span data-id="{{ $user_role->id }}" data-status="{{ $user_role->type }}" data-name="{{ $user_role->name }}" class="role-suspend"><span>Suspend Role</span></span>
                                                <?php }
                                                if ($user_role->type == 2) { ?>
                                                    <span data-id="{{ $user_role->id }}" data-status="{{ $user_role->type }}" data-name="{{ $user_role->name }}" class="text text-success role-activate"><span style="cursor: pointer;">Activate Role</span></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Active -->
                                <div class="modal fade" id="org_suspend" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Activate <span class="name_active"></span></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('change_user_role_status')}}" method="POST">
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
                                            <form action="{{route('change_user_role_status')}}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameWithTitle" class="form-label">Reason</label>
                                                            <textarea id="nameWithTitle" name="suspend_msg" class="form-control" placeholder="Enter Reason"></textarea>
                                                            <input type="hidden" id="status_suspend" name="status" value="2" />
                                                            <input type="hidden" id="id_suspend" name="id" />
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

                                <!-- Edit Role Modal -->
                                <div class="modal fade" id="editRoleModal_<?php echo $user_role->id; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                                        <div class="modal-content p-3 p-md-5">
                                            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <div class="modal-body">
                                                <div class="text-center mb-4">
                                                    <h3 class="role-title mb-2">Edit Role</h3>
                                                    <!--p class="text-muted">Set role permissions</p-->
                                                </div>
                                                <!-- Edit role form -->
                                                <form class="row g-3" method="POST" id="editRoleForm_<?php echo $user_role->id; ?>" action={{route('user_role_update');}} enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-12 mb-4">
                                                        <label class="form-label" for="modalRoleName">Role Name</label>
                                                        <input type="text" name="role_name" class="form-control" value="{{ $user_role->role_name; }}" placeholder="Enter a role name" tabindex="-1" />
                                                        <input type="hidden" name="id" id="id" value="{{ $user_role->id; }}" />
                                                    </div>
                                                    <div class="col-12 text-center mt-4">
                                                        <button type="submit" class="update_role btn btn-primary me-sm-3 me-1">Submit</button>
                                                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                            Discard
                                                        </button>
                                                    </div>
                                                </form>
                                                <!-- suspen msg -->
                                                <?php
                                                $sus_count = DB::table('suspension_roles')->where('role_id', '=', $user_role->id)->count();
                                                if ($sus_count > 0) {
                                                    $suspensions = DB::table('suspension_roles')->where('role_id', '=', $user_role->id)->get();
                                                ?>
                                                    <table class="display nowrap" style="width:100%">
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
                                                                //   echo '<td>' . $suspension->id . '</td>';
                                                                echo '<td title="' . $suspension->suspension_reason . '" style="cursor: pointer;" data-bs-toggle="tooltip">' . mb_strimwidth($suspension->suspension_reason, 0, 20, '...') . '</td>';
                                                                echo '<td>' . $suspension->suspension_date . '</td>';
                                                                echo '</tr>';
                                                            } ?>


                                                        </tbody>
                                                    </table>

                                                <?php } ?>
                                                <!--/ Edit role form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Edit Role Modal -->
                            <?php } ?>
                        </div>
                        <!--/ Role cards -->
                        <!-- Add Role Modal -->
                        <!-- Add Role Modal -->
                        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                                <div class="modal-content p-3 p-md-5">
                                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="modal-body">
                                        <div class="text-center mb-4">
                                            <h3 class="role-title mb-2">Add Role</h3>
                                            <!--p class="text-muted">Set role permissions</p-->
                                        </div>
                                        <!-- Add role form -->
                                        <form method="POST" action="{{route('user_role_add_new')}}" id="addRoleForm" class="row g-3" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="organization_id" value="<?php echo $org_id; ?>">
                                            <div class="col-12 mb-4">
                                                <label class="form-label" for="modalRoleName">Role Name</label>
                                                <input type="text" id="role_name" name="role_name" class="form-control" placeholder="Enter a role name" tabindex="-1" />
                                            </div>
                                            <div class="col-12 text-center mt-4">
                                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
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
                        <!--/ Add Role Modal -->
                        <!-- / Add Role Modal -->


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

    <script>
        $(function() {
            $(".role-suspend").on("click", function() {
                if ($(this).data('status') == 1) {
                    var user_id = $(this).data('id');
                    $("#id_suspend").val(user_id);
                    $(".name_suspend").html($(this).data('name'));
                    $("#org_active").modal('show');
                }
            });

            $(".role-activate").on("click", function() {
                if ($(this).data('status') == 2) {
                    var user_id = $(this).data('id');
                    $("#id_active").val(user_id);
                    $(".name_active").html($(this).data('name'));
                    $("#org_suspend").modal('show');
                }
            });
        });
    </script>
</body>

</html>
