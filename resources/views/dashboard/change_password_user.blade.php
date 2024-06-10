<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Change Password</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.css')}}" />
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id)
    ?>
    <style type="text/css">
        .add_student .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_student .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .add_student .form-check-input:checked,
        .add_student .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_student .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_student .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .add_student .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_student .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_student .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_student .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .add_student .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .add_student i {
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

        .add_student #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .add_student .card-title,
        .add_student .create-new {
            display: none !important;
        }

        .addstudent.nav-pills .nav-link.active,
        .addstudent.nav-pills .nav-link.active:hover,
        .addstudent.nav-pills .nav-link.active:focus {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #fff;
        }

        .class,
        .gender,
        .birthday,
        .blood_group,
        .address,
        .section,
        .student_parent {
            display: none;
        }
    </style>
</head>

<body class="add_student">
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
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">Change Password</h4>
                        </div>
                        <p style="height: 2px;"></p>
                        <!-- Pills -->
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="nav-align-top mb-4">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="navs-pills-justified-single" role="tabpanel">
                                            <div class="col-12 col-lg-12">
                                                <div class="mb-4">
                                                    <div class="card-body">
                                                        @if(session()->has('success'))
                                                        <div class="alert alert-success">
                                                            {{ session()->get('success') }}
                                                        </div>
                                                        @endif
                                                        @if(session()->has('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session()->get('error') }}
                                                        </div>
                                                        @endif
                                                        <form id="formAccountSettings" method="POST" action="{{route('change_password_process_user')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <p style="height: 2px;"></p>
                                                            <div class="mb-3 col-md-12">
                                                                <input type="hidden" name="organization_id" value="<?php echo $org_id; ?>">
                                                                <label for="old_password" class="form-label">Old Password</label>
                                                                <input class="form-control" type="text" id="old_password" name="old_password" autofocus />
                                                                @error('old_password')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3 col-md-12">
                                                                <input type="hidden" name="organization_id" value="<?php echo $org_id; ?>">
                                                                <!-- <input type="hidden" -->
                                                                <label for="new_password" class="form-label">New Password</label>
                                                                <input class="form-control" type="text" id="new_password" name="new_password" autofocus />
                                                                @error('new_password')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="mb-3 col-md-12">
                                                                <input type="hidden" name="organization_id" value="<?php echo $org_id; ?>">
                                                                <!-- <input type="hidden" -->
                                                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                                                <input class="form-control" type="text" id="confirm_password" name="confirm_password" autofocus />
                                                                @error('confirm_password')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>

                                                            <div class="mt-6">
                                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                                <a href="{{route('my_profile_user')}}" class="btn btn-label-secondary">Discard</a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Pills -->
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
                    @include('dashboard.footer')
                    <script src="{{asset('assets/jquery-repeater/jquery-repeater.js')}}"></script>
                    <script src="{{ asset('assets/flatpickr/flatpickr.js')}}"></script>
                    <script src="{{ asset('assets/js/forms-pickers.js')}}"></script>

</body>

</html>
