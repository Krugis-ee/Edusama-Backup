<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Teacher</title>
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
    </style>
</head>

<body class="add_parent">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('dashboard.sidebar')
            </aside>
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
                        <div class="app-ecommerce">
                            <div class="d-flex flex-column justify-content-center">
                                <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">Add Teacher</h4>
                            </div>
                            <!-- Add Product -->
                            <p style="height: 2px;"></p>
                            <div class="row">
                                <!-- First column-->
                                <div class="col-12 col-lg-12">
                                    <!-- Product Information -->
                                    <div class="card mb-4">
                                        <!-- Account -->
                                        <div class="card-body">
                                            <form method="POST" action="{{route('teacher_add_new');}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                        <img src="{{asset('assets/img/avatars/14.png')}}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                                        <div class="button-wrapper">
                                                            <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                                                <span class="d-none d-sm-block">Upload new photo</span>
                                                                <i class="ti ti-upload d-block d-sm-none"></i>
                                                                <input type="file" id="upload" name="teacher_avatar" class="account-file-input" hidden accept="image/png, image/jpeg" onchange="loadImage(event)" />
                                                            </label>
                                                            <!-- <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Reset</span>
                                                            </button> -->
                                                            @error('teacher_avatar')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                            <div class="text-muted">File size should be less than 100kb and dimension must be less than 100 px*100 px</div>
                                                        </div>
                                                    </div>
                                                    <p style="height: 2px;"></p>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="firstName" class="form-label">First Name</label><span class="text-danger">*</span>
                                                        <input class="form-control" type="text" id="firstName" value="{{ old('firstName')}}" name="firstName" placeholder="John" autofocus />
                                                        @error('firstName')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="lastName" class="form-label">Last Name</label><span class="text-danger">*</span>
                                                        <input class="form-control" type="text" value="{{ old('lastName')}}" name="lastName" id="lastName" placeholder="Doe" />
                                                        @error('lastName')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="email" class="form-label">E-mail</label><span class="text-danger">*</span>
                                                        <input class="form-control" type="text" id="email" value="{{ old('email')}}" name="email" placeholder="john.doe@example.com" />
                                                        @error('email')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="text" id="phoneNumber" value="{{ old('mobileNumber')}}" name="mobileNumber" class="form-control" placeholder="202 555 0111" />
                                                        </div>
                                                        @error('mobileNumber')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="lastName" class="form-label">Designation</label>
                                                        <input class="form-control" type="text" value="{{ old('designation')}}" name="designation" id="designation" placeholder="" />
                                                    </div>
                                                    <!-- <div class="mb-3 col-md-6">
                                                        <label for="orgFormControlSelect" class="form-label">Department</label>
                                                        <select class="form-select" id="orgFormControlSelect" value="{{ old('department')}}" name="department" aria-label="Select Department">
                                                            <option selected disabled>Select Department</option>
                                                            <option value="xxx">xxx</option>
                                                            <option value="yyy">yyy</option>
                                                            <option value="zzz">zzz</option>
                                                        </select>
                                                    </div> -->
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="branch_id">Branch</label><span class="text-danger">*</span>
                                                        <select id="branch_id" name="branch_id" class="select2 form-select">
                                                            <option value="">Select Branch</option>
                                                            @foreach ($branches as $branch)
                                                            <?php if (old('branch_id') == $branch->id)
                                                                $sele = 'selected';
                                                            else
                                                                $sele = '';
															$primary_roles = array(1, 2, 3, 4);
																		if (!in_array($user_role_id, $primary_roles)) {
																			if($branch_id_jp==$branch->id)
																				$sele = 'selected';
																			else
																				$sele = '';
																		}
                                                            echo '<option ' . $sele . ' value="' . $branch->id . '">' . $branch->branch_name . '</option>'; ?>
                                                            @endforeach
                                                        </select>
                                                        @error('branch_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <?php $gender_list = array('Male', 'Female', 'other'); ?>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="exampleFormControlSelect1" class="form-label">Gender</label>
                                                        <select class="form-select" id="exampleFormControlSelect1" name="gender" aria-label="Default select example">
                                                            <option value="">Select Gender</option>
                                                            @foreach ($gender_list as $gender)
                                                            <?php if (old('gender') == $gender)
                                                                $sele = 'selected';
                                                            else
                                                                $sele = '';
                                                            echo '<option ' . $sele . ' value="' . $gender . '">' . $gender . '</option>'; ?>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-md-6"></div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="lastName" class="form-label">Facebook profile link</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon11"><i class="fa-brands fa-facebook"></i></span>
                                                            <input type="text" id="facebook" value="{{ old('facebook_profile')}}" name="facebook_profile" class="form-control" placeholder="https://facebook.com/abc">
                                                        </div>
                                                        @error('facebook_profile')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="lastName" class="form-label">Twitter profile link</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon11"><i class="fa-brands fa-x-twitter"></i></span>
                                                            <input type="text" id="twitter" value="{{ old('twitter_profile')}}" name="twitter_profile" class="form-control" placeholder="https://twitter.com/abc">
                                                        </div>
                                                        @error('twitter_profile')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="lastName" class="form-label">Linkedin profile link</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon11"><i class="fa-brands fa-linkedin"></i></span>
                                                            <input type="text" id="linkedin" value="{{ old('linkedin_profile')}}" name="linkedin_profile" class="form-control" placeholder="https://linkedin.com/abc">
                                                        </div>
                                                        @error('linkedin_profile')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="lastName" class="form-label">Instagram profile link</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon11"><i class="fa-brands fa-instagram"></i></span>
                                                            <input type="text" id="google" value="{{ old('instagram_profile')}}" name="instagram_profile" class="form-control" placeholder="https://instagram.com/abc">
                                                        </div>
                                                        @error('instagram_profile')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="address" class="form-label">Address</label>
                                                        <textarea class="form-control" id="basic-default-address" name="address" rows="3">{{ old('address')}}</textarea>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="state" class="form-label">City</label>
                                                        <input class="form-control" type="text" id="city" value="{{ old('city')}}" name="city" placeholder="xxx" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="country">Country</label>
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
                                                        <label for="zipCode" class="form-label">Zip Code</label>
                                                        <input type="text" class="form-control" id="zipCode" value="{{ old('zipCode')}}" name="zipCode" placeholder="231465" />
                                                        @error('zipCode')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="basic-default-bio">About</label>
                                                        <textarea class="form-control" id="basic-default-bio" name="bio" rows="3">{{ old('bio')}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /Account -->
                                    </div>
                                </div>
                                <!-- /Second column -->
                                <!-- Second column -->
                                <!-- /Second column -->
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->
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
        var loadImage = function(event) {
            var image = document.getElementById('uploadedAvatar');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
</body>

</html>
