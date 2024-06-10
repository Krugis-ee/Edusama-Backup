<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>My_profile</title>
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
        .add_admin .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_admin .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .add_admin .form-check-input:checked,
        .add_admin .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_admin .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_admin .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .add_admin .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_admin .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_admin .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_admin .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
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
            @include('dashboard.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('dashboard.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->

                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">My Profile</h4>
                    </div>

                    <div class="content-wrapper">
                      @if(session()->has('success'))
                         <div class="alert alert-success">
                             {{ session()->get('success') }}
                         </div>
                      @endif
                        <div class="d-flex align-content-center flex-wrap gap-3">
                            <div class="d-flex gap-3">
                                <a href="{{ route('edit_my_profile_user') }}">
                                    <button class="btn btn-primary" type="button">
                                        <span>
                                            <!-- <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> -->
                                            <span class="d-none d-sm-inline-block">Edit</span>
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('change_password_user') }}">
                                    <button class="btn btn-primary" type="button">
                                        <span>
                                            <!-- <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> -->
                                            <span class="d-none d-sm-inline-block">Change Password</span>
                                        </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('other_user_update') }}" name="edit_admin" method="post">
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
                                                @if($errors->any())
                                                @foreach($errors->all() as $error)
                                                <div class="alert alert-danger">
                                                    {{ $error }}
                                                </div>
                                                @endforeach
                                                @endif
                                                <!-- Range Picker-->
                                                <div class="col-md-6 col-lg-12 col-xl-12 col-12 mb-4">
                                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="flatpickr-range" style="display:none;" />
                                                    <div class="mb-3">
                                                        <label for="adminname" required class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="adminname" name="name" value="{{ $user->name; }}" placeholder="John Doe" aria-describedby="defaultFormControlHelp" readonly/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="adminemail" class="form-label">Email address</label>
                                                        <input type="email" class="form-control" id="adminemail" name="email" value="{{ $user->email; }}" placeholder="name@example.com" readonly/>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="mobile_number" class="form-label">Mobile Phone</label>
                                                        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="{{ $user->mobile_number; }}" placeholder="90-(164)-188-556" readonly/>
                                                    </div>
                                                    <div class="mb-3" id="branch">
                                                        <label for="branch" class="form-label">Branch</label>
                                                        <input class="form-control" type="text" value="{{ App\Models\Branch::getBranchNameByBranchId($user->branch_id) }}" name="country" readonly />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="orgFormControlSelect" class="form-label">User Role</label>
                                                        <input type="text" class="form-control" id="user_role_id" name="user_role_id" value="{{ App\Models\UserRole::getRoleNameByID($user->user_role_id) }}" readonly/>
                                                        <!-- <select class="form-select" name="user_role_id" id="orgFormControlSelect" aria-label="Select Organisation">
                                                            <option>Select User Role</option>

                                                            @foreach ($user_roles as $user_role)
                                                            <?php if ($user->user_role_id == $user_role->id)
                                                                $selected = 'selected';
                                                            else {
                                                                $selected = '';
                                                            }
                                                            ?>
                                                            <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="{{ $user->mobile_number; }}" placeholder="90-(164)-188-556" />
                                                            <?php echo '<option ' . $selected . ' value="' . $user_role->id . '">' . $user_role->role_name . '</option>'; ?>
                                                            @endforeach
                                                        </select> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--suspension msg-->

                                <p style="height: 2px;"></p>
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                    <div class="d-flex align-content-center flex-wrap gap-3">

                                    </div>
                                </div>
                                <!-- /Flatpickr -->
                                <!-- Color Picker -->
                                <!-- /Color Picker-->
                            </div>
                        </form>

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
