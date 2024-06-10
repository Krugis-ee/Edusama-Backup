<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>List Teachers</title>
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

        .students_list .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .students_list .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .students_list .form-check-input:checked,
        .students_list .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .students_list .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .students_list .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .students_list .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .students_list .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .students_list .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .students_list .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .students_list .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .students_list i {
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

        .students_list #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .students_list .card-title,
        .students_list .create-new {
            display: none !important;
        }

        .list_students th:nth-child(11) {
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

        table.dataTable.display tbody tr:hover>.sorting_1,
        table.dataTable.order-column.hover tbody tr:hover>.sorting_1,
        table.dataTable.display>tbody>tr:nth-child(odd)>.sorting_1,
        table.dataTable.order-column.stripe>tbody>tr:nth-child(odd)>.sorting_1 {
            box-shadow: none !important;
        }

        .dt-layout-row {
            padding-bottom: 20px;
        }
    </style>
</head>

<body class="students_list">
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
                                    <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">List Teachers</h4>
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

                                    if (in_array('teachersCreate', $privileges_arr)) {
                                        $show_add = 1;
                                    }
                                }
                                //Add


                                ?>
                                <?php if ($show_add == 1) { ?>
                                    <div class="d-flex align-content-center flex-wrap gap-3">
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('teacher_add') }}">
                                                <button class="btn btn-primary" type="button">
                                                    <span>
                                                        <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                                        <span class="d-none d-sm-inline-block">Add Teacher</span>
                                                    </span>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <input type="hidden" id="ajax_url" name="ajax_url" value="{{route('change_teacher_status')}}">
                        <?php
                        $user_id = session()->get('loginId');
                        $privileges = App\Models\UserPrivilege::getPrivilegesByUserId($user_id);
                        $all_privilege_arr = explode(',', $privileges);
                        $user_role_id = App\Models\User::getRoleID($user_id);
                        ?>

                        <p style="height: 2px;"></p>
                        <div class="card">

                            <div class="card-body table_admin text-nowrap">
                            @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
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
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email Address</th>
                                            <th>Mobile Number</th>
                                            <th>Branch</th>
                                            <th>Designation</th>
                                            <th>Status</th>
                                            <!-- <th>Department</th> -->
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($teachers as $teacher) {
                                            echo '<tr>';
                                            echo '<th>' . $teacher->first_name . '</th>';
                                            echo '<td>' . $teacher->last_name . '</td>';
                                            echo '<td>' . $teacher->email . '</td>';
                                            echo '<td>' . $teacher->mobile_number . '</td>';
                                            $branch_name = App\Models\Branch::getBranchNameByBranchId($teacher->branch_id);
                                            echo '<td>' . $branch_name . '</td>';
                                            echo '<td>' . $teacher->designation . '</td>';
                                            // echo '<td>' . $teacher->department . '</td>';
                                        ?>
                                            <td>
                                                <?php if ($teacher->type == 1) { ?>
                                                    <span class="badge rounded-pill bg-success">Active</span>
                                                <?php }
                                                if ($teacher->type == 2) {
                                                ?>
                                                    <span class="badge rounded-pill bg-danger" title="{{$teacher->suspend_msg}}" style="cursor: pointer;">Suspended</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($user_role_id == 1 || in_array('teachersUpdate', $all_privilege_arr)) { ?>
                                                    <a href="{{ route("teacher_edit", $teacher->id) }}">
                                                        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning">
                                                            <i class="ti ti-edit"></i>
                                                        </span>
                                                    </a>

                                                    <?php }
                                                if ($user_role_id == 1 || in_array('teachersDelete', $all_privilege_arr)) {
                                                    if ($teacher->type == 1) { ?>
                                                        <button style="border: none;">
                                                            <span data-bs-toggle="tooltip" title="Suspend" style="cursor: pointer; background-color:#ea5455" data-bs-placement="bottom" id="suspend" class="badge badge-center toggle-class" data-id="{{ $teacher->id }}" data-name="{{ $teacher->first_name.' '.$teacher->last_name}}" data-type="{{$teacher->type}}">
                                                                <i class="ti ti-droplet-exclamation"></i>
                                                            </span>
                                                        </button>
                                                    <?php }
                                                    if ($teacher->type == 2) {
                                                    ?>
                                                        <button style="border: none;">
                                                            <span data-bs-toggle="tooltip" title="Activate" style="cursor: pointer; background-color:#28c76f" data-bs-placement="bottom" id="suspend" class="badge badge-center toggle-class" data-id="{{ $teacher->id }}" data-name="{{ $teacher->first_name.' '.$teacher->last_name}}" data-type="{{$teacher->type}}">
                                                                <i class="ti ti-droplet-exclamation"></i>
                                                            </span>
                                                        </button>
                                                <?php }
                                                } ?>
                                            </td>
                                        <?php echo '</tr>';
                                        } ?>

                                        <!-- Active -->
                                        <div class="modal fade" id="org_suspend" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Activate <span class="name"></span></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('change_teacher_status')}}" method="POST">
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
                                                    <form action="{{route('change_teacher_status')}}" method="POST">
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
    <script type="text/javascript">
        new DataTable('#example', {
            scrollX: true
        });
    </script>
    <script>
        $(function() {
            // $('#suspend').on("click",function() {
            $("#example").on("click", ".toggle-class", function() {

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
