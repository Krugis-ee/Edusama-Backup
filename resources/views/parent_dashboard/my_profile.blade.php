<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>My Profile</title>
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
            @include('parent_dashboard.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('parent_dashboard.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>">My Profile</h4>
                        </div>
                        <div class="d-flex align-content-center flex-wrap gap-3">
                            <div class="d-flex gap-3">
                                <a href="{{ route('edit_my_profile_parent') }}">
                                    <button class="btn btn-primary" type="button">
                                        <span>
                                            <!-- <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> -->
                                            <span class="d-none d-sm-inline-block">Edit</span>
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('change_password_parent') }}">
                                    <button class="btn btn-primary" type="button">
                                        <span>
                                            <!-- <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i> -->
                                            <span class="d-none d-sm-inline-block">Change Password</span>
                                        </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <p style="height: 2px;"></p>
                        <!-- Add Product -->
                        <div class="col-12 col-lg-12">
                            <div class="card mb-4">
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
                                <div class="card-body">
                                    <form id="formAccountSettings" method="POST" action={{route('parent_update');}} enctype="multipart/form-data"">
                                        @csrf
                                        <div class=" row">
                                        <div class="mb-3 col-md-6">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input class="form-control" type="text" value="{{ $data->first_name; }}" id="firstName" name="firstName" placeholder="John" autofocus readonly />
                                            @error('firstName')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input class="form-control" type="text" value="{{ $data->last_name; }}" name="lastName" id="lastName" placeholder="Doe" readonly />
                                            @error('lastName')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="text" value="{{ $data->email; }}" id="email" name="email" placeholder="john.doe@example.com" readonly />
                                            @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" id="mobileNumber" value="{{ $data->mobile_number; }}" name="mobileNumber" class="form-control" placeholder="202 555 0111" readonly />
                                            </div>
                                            @error('mobileNumber')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="3" readonly>{{ $data->address; }}</textarea>
                                            @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="state" class="form-label">City</label>
                                            <input class="form-control" type="text" value="{{ $data->city; }}" id="city" name="city" placeholder="xxx" readonly />
                                            @error('city')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="country">Country</label>
                                            <!-- <select id="country" name="country" class="select2 form-select" readonly>
                                                <option value="">SelectCountry</option>
                                                @foreach ($countries as $country)
                                                <?php if ($data->country_id == $country->id)
                                                    $sele = 'selected';
                                                else
                                                    $sele = '';
                                                echo '<option ' . $sele . ' value="' . $country->id . '">' . $country->name . '-' . $country->shortname . '</option>'; ?>
                                                @endforeach -->
                                            <input class="form-control" type="text" value="{{ App\Models\Country::getCountryNameAndCodeById($data->country_id) }}" id="country" name="country" placeholder="xxx" readonly />
                                            </select>
                                            @error('country')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-6" id="branch">
                                            <label for="branch" class="form-label">Branch</label>
                                            <input class="form-control" type="text" value="{{ App\Models\Branch::getBranchNameByBranchId($data->branch_id) }}" name="country" readonly />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="zipCode" class="form-label">Zip Code</label>
                                            <input type="text" class="form-control" value="{{ $data->zip_code; }}" id="zipCode" name="zipCode" placeholder="231465" maxlength="6" readonly />
                                            @error('zipCode')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            <input type="hidden" name="id" id="id" value="{{ $data->id; }}" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Flatpickr -->

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
    <script type="text/javascript">
        new DataTable('#example', {
            scrollX: true
        });
    </script>
</body>

</html>
