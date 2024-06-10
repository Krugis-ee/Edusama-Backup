<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Subject</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
	$branch_id_jp=0;
	 $branch_id_jp = App\Models\User::getBranchID($user_id);
	 $user_role_id = App\Models\User::getRoleID($user_id);
    //$org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    //  $org_name = App\Models\Organization::getOrgNameById($org_id);
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
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">Add Subject</h4>
                        </div>
                        <form action="{{ route('subject_add') }}" name="add_subject" method="post">
                            @csrf
                            <input type="hidden" name="organization_id" value="{{$org_id}}" />
                            <input type="hidden" name="admin_id" value="{{$user_id}}" />
                            <!-- Add Product -->
                            <p style="height: 2px;"></p>
                            <div class="row add_org">
                                <!-- Flat Picker -->
                                <div class="col-12 mb-4 col-lg-8 col-xl-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
												<div class="col-md-6 col-lg-12 col-xl-12 col-12 mb-4">
                                              <label class="form-label" for="branch_id">Branch</label><span class="text-danger">*</span>
                                            <select id="branch_id" name="branch_id" class="select2 form-select form-control">
                                                <option value="">Select Branch</option>
                                                @foreach ($branches as $branch)
                                                <?php if (old('branch_id') == $branch->id)
                                                    $sele = 'selected';
                                                else
                                                    $sele = '';
                                                ?>
												<?php
												$primary_roles = array(1, 2, 3, 4);
												if (!in_array($user_role_id, $primary_roles)) {
													if($branch_id_jp==$branch->id)
														$sele = 'selected';
													else
														$sele = '';
												}
												?>
                                                <option <?php echo $sele; ?> value="{{$branch->id}}">{{$branch->branch_name}} </option>
                                                @endforeach
                                            </select>
                                            @error('branch_id')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                                      </div>
                                                <!-- Range Picker-->
                                                <div class="col-md-6 col-lg-12 col-xl-12 col-12 mb-4">
                                                    <div class="mb-3">
                                                        <label for="subject_name" required class="form-label">Subject Name</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" id="subject_name" name="subject_name" placeholder="Subject" value="{{ old('subject_name')}}" aria-describedby="defaultFormControlHelp" />
                                                        @error('subject_name')
                                                        <span style="color:red;">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
												               <div class="col-md-6 col-lg-12 col-xl-12 col-12 mb-4">
                                                    <div class="mb-3">
                                                        <label for="short_code" required class="form-label">Subject Short Code</label><span class="text-danger">*</span>
                                                        <input type="text" class="form-control" id="short_code" name="short_code" placeholder="Subject" value="{{ old('short_code')}}" aria-describedby="defaultFormControlHelp" />
                                                        @error('short_code')
                                                        <span style="color:red;">{{ $message }}</span>
                                                        @enderror
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
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>

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

</body>

</html>
