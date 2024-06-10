<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Parent</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
	$branch_id_jp=0;
	 $branch_id_jp = App\Models\User::getBranchID($user_id);
	 $user_role_id = App\Models\User::getRoleID($user_id);
    ?>
    <style type="text/css">
        .add_parent .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .add_parent .form-check-input:checked,
        .add_parent .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .add_parent .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .add_parent i {
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

        .add_parent #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .add_org .form-label {
            font-size: 17px;
        }
    </style>
</head>

<body class="add_parent">
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
                            <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">Add Parent</h4>
                        </div>
                        <!-- Add Product -->
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                                <div class="card-body">
                                    <form id="formAccountSettings" method="POST" action={{route('parent_add_new');}} enctype="multipart/form-data"">
                                        @csrf
                                        <div class=" row">
                                        <div class="mb-3 col-md-6">

                                            <input type="hidden" name="organization_id" value="<?php echo $org_id; ?>">
                                            <label for="firstName" class="form-label">First Name</label><span class="text-danger">*</span>
                                            <input class="form-control" type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" placeholder="John" autofocus />
                                            @error('firstName')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="lastName" class="form-label">Last Name</label><span class="text-danger">*</span>
                                            <input class="form-control" type="text" name="lastName" value="{{ old('lastName') }}" id="lastName" placeholder="Doe" />
                                            @error('lastName')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label><span class="text-danger">*</span>
                                            <input class="form-control" type="text" id="email" name="email" value="{{ old('email') }}" placeholder="john.doe@example.com" />
                                            @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="phoneNumber">Phone Number</label><span class="text-danger">*</span>
                                            <div class="input-group input-group-merge">
                                                <input type="text" id="mobileNumber" name="mobileNumber" value="{{ old('mobileNumber') }}" class="form-control" placeholder="202 555 0111" />
                                            </div>
                                            @error('mobileNumber')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">Address</label><span class="text-danger">*</span>
                                            <textarea class="form-control" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                                            @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="state" class="form-label">City</label><span class="text-danger">*</span>
                                            <input class="form-control" type="text" id="city" name="city" placeholder="xxx" value="{{ old('city') }}" />
                                            @error('city')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="country">Country</label><span class="text-danger">*</span>
                                            <select id="country" name="country" class="select2 form-select">
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                <?php if (old('country') == $country->id)
                                                    $sele = 'selected';
                                                else
                                                    $sele = '';
                                                echo '<option ' . $sele . ' value="' . $country->id. '">' . $country->name .'-'. $country->shortname . '</option>'; ?>
                                                @endforeach
                                            </select>
                                            @error('country')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="branch_id">Branch</label><span class="text-danger">*</span>
                                            <select id="branch_id" name="branch_id" class="select2 form-select">
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

                                        <div class="mb-3 col-md-6">
                                            <label for="zipCode" class="form-label">Zip Code</label><span class="text-danger">*</span>
                                            <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" value="{{ old('zipCode') }}" />
                                            @error('zipCode')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- /Flatpickr -->
                        <!-- Color Picker -->
                        <!-- /Color Picker-->
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
    @include('dashboard.footer')
</body>

</html>
