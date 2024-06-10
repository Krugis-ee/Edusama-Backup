<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Add Student</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.css')}}" />
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
        .remove_button {
            border-color: transparent !important;
            background: #fad6d6 !important;
            color: #ea5455 !important;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 22px
        }

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
                            <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">Add Student</h4>
                        </div>
                        <p style="height: 2px;"></p>
                        <!-- Pills -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="nav-align-top mb-4">
                                    <ul class="nav nav-pills mb-3 nav-fill addstudent" role="tablist">
                                        <li class="nav-item">
                                            <a href="{{ route('student_add','single') }}" class="nav-link <?php if ($slug == 'single') echo 'active'; ?>">
                                                <i class="fa-solid fa-user"></i>&nbsp; Single Student
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('student_add','bulk_import') }}" class="nav-link <?php if ($slug == 'bulk_import') echo 'active'; ?>">
                                                <i class="fa-solid fa-users"></i>&nbsp; Bulk Student
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('student_add','excel_import') }}" class="nav-link <?php if ($slug == 'excel_import') echo 'active'; ?>">
                                                <i class="fa-solid fa-file-excel"></i>&nbsp; Excel Upload
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade <?php if ($slug == 'single') echo 'show active'; ?>" id="navs-pills-justified-single" role="tabpanel">
                                            <div class="col-12 col-lg-12">
                                                <div class="mb-4">
                                                    <div class="card-body">
                                                        <form id="formAccountSettings" method="POST" action="{{route('student_add_new');}}" class="single_student" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                                    <img src="{{asset('assets/img/avatars/14.png')}}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                                                    <div class="button-wrapper">
                                                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                                                            <span class="d-none d-sm-block">Upload new photo</span>
                                                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                                                            <input type="file" id="upload" class="account-file-input" name="student_avatar" hidden accept="image/png, image/jpeg" onchange="loadImage(event)" />
                                                                        </label>
                                                                        <!-- <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                                                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                                                            <span class="d-none d-sm-block">Reset</span>
                                                                        </button> -->
                                                                        <div class="text-muted">File size should be less than 100kb and dimension must be less than 100 px*100 px</div>
                                                                        @error('student_avatar')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <p style="height: 2px;"></p>
                                                                <div class="mb-3 col-md-6">
                                                                    <input type="hidden" name="organization_id" value="<?php echo $org_id; ?>">
                                                                    <label for="firstName" class="form-label">First Name</label><span class="text-danger">*</span>
                                                                    <input class="form-control" type="text" value="{{ old('firstName')}}" id="firstName" name="firstName" placeholder="John" autofocus />
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
                                                                    <input class="form-control" type="text" id="email" name="email" value="{{ old('email')}}" placeholder="john.doe@example.com" />
                                                                    @error('email')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3 col-md-6">
                                                                    <label for="email" class="form-label">Mobile Number</label>
                                                                    <input class="form-control" type="tel" name="mobileNumber" value="{{ old('mobileNumber')}}" placeholder="90-(164)-188-556" />
                                                                    @error('mobileNumber')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <!-- <div class="mb-3 col-md-6">
                                                      <label for="ID" class="form-label">ID</label>
                                                      <input class="form-control" type="text" name="id" id="id" placeholder="123456" />
                                                      </div> -->
                                                                <!--div class="mb-3 col-md-6 class" id="class">
                                                                    <label for="exampleFormControlSelect1" class="form-label">Class</label>
                                                                    <select class="form-select" id="exampleFormControlSelect1" name="class" aria-label="Default select example">
                                                                        <option selected disabled>Select Class</option>
                                                                        <option value="1">class1</option>
                                                                        <option value="2">class2</option>
                                                                        <option value="3">class3</option>
                                                                        <option value="4">class4</option>
                                                                    </select>
                                                                </div-->
                                                                <?php $gender_list = array('Male', 'Female', 'other'); ?>
                                                                <div class="mb-3 col-md-6 gender" id="gender">
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
                                                                <div class="mb-3 col-md-6 birthday" id="birthday">
                                                                    <label for="email" class="form-label">Date of Birth</label>
                                                                    <input class="form-control" type="text" max="<?php echo date("Y-m-d") ?>" value="{{ old('birthdate')}}" id="flatpickr-date1" name="birthdate" placeholder="DD-MM-YYYY" />
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label for="address" class="form-label">Address</label>
                                                                    <textarea class="form-control" id="address" name="address" rows="3">{{ old('address')}}</textarea>
                                                                    @error('address')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label for="state" class="form-label">City</label>
                                                                    <input class="form-control" type="text" id="city" value="{{ old('city')}}" name="city" placeholder="" />
                                                                    @error('city')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
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
                                                                        echo '<option ' . $sele . ' value="' . $country->id. '">'. $country->name .'-'. $country->shortname .'</option>'; ?>
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

                                                                <input type="hidden" name="ajax_url" id="ajax_url" value="{{ route('get_parents_by_branch'); }}">
                                                                <div class="mb-3 col-md-6 student_parent" id="student_parent">
                                                                    <label for="Student Parent" class="form-label">Parent</label>
                                                                    <select class="form-select" id="parent" name="parent" aria-label="Student Parent">
                                                                        <option value="{{old('parent')}}">{{App\Models\User::getParentNameByParentID(old('parent'))}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label for="zipCode" class="form-label">Zip Code</label>
                                                                    <input type="text" class="form-control" id="zipCode" value="{{old('zipCode')}}" name="zipCode" placeholder="231465" />
                                                                    @error('zipCode')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="demo-inline-spacing">
                                                                        <button class="btn btn-primary me-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                            Add Custom Fields +
                                                                        </button>
                                                                    </p>
                                                                    <div class="collapse" id="collapseExample">
                                                                        <div class="d-grid d-sm-flex p-3 border">
                                                                            <div class="col-md-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="" id="birthday_check" />
                                                                                    <label class="form-check-label" for="defaultCheck3"> Date of Birth </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="" id="gender_check" />
                                                                                    <label class="form-check-label" for="defaultCheck3"> Gender </label>
                                                                                </div>
                                                                            </div>
                                                                            <!--div class="col-md-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="" id="class_check" />
                                                                                    <label class="form-check-label" for="defaultCheck3"> Class </label>
                                                                                </div>
                                                                            </div-->
                                                                            <div class="col-md-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" value="" id="parent_check" />
                                                                                    <label class="form-check-label" for="defaultCheck3"> Parent </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2">
                                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade <?php if ($slug == 'bulk_import') echo 'show active'; ?>"" id=" navs-pills-justified-bulk" role="tabpanel">
                                            <div class="col-12 col-lg-12">
                                                <div class="mb-4">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="">
                                                                <div class="card-body">


                                                                    <form id="bulk_form" method="POST" action="{{route('add_student_bulk')}}">
                                                                        @csrf
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="mb-3 col-md-3"></div>
                                                                                    <!--div class="mb-3 col-md-6">
                                                                                        <label for="exampleFormControlSelect1" class="form-label">Class</label>
                                                                                        <select class="form-select" id="exampleFormControlSelect1" name="class" aria-label="Default select example">
                                                                                            <option selected disabled>Select Class</option>
                                                                                            <option value="1">class1</option>
                                                                                            <option value="2">class2</option>
                                                                                            <option value="3">class3</option>
                                                                                            <option value="4">class4</option>
                                                                                        </select>
                                                                                    </div-->
                                                                                    <div class="mb-3 col-md-3"></div>
                                                                                    <p style="height: 2px;"></p>
                                                                                    <hr>
                                                                                    <p style="height: 2px;"></p>
                                                                                </div>
                                                                                <div class="group-a">
                                                                                    <div class="group-b">
                                                                                        <div class="row">

                                                                                            <?php
                                                                                            $count = 0;
                                                                                            $first_names = old('first_name1');
                                                                                            if ($first_names)
                                                                                                $count = count($first_names);
                                                                                            if ($count == 0) {
                                                                                            ?>
                                                                                                <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">

                                                                                                    <label class="form-label">First Name</label> <span class="text-danger">*</span>
                                                                                                    <input type="text" id="first_name" name="first_name1[]" class="form-control" value="{{ old('first_name1.0') }}" placeholder="John" />
                                                                                                    @error('first_name1.0')
                                                                                                    <span style="color:red;">{{ $message }}</span>
                                                                                                    @enderror
                                                                                                </div>
                                                                                                <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                                                                                                    <label class="form-label">Last Name</label> <span class="text-danger">*</span>
                                                                                                    <input type="text" id="last_name" name="last_name1[]" class="form-control" placeholder="Doe" />
                                                                                                </div>
                                                                                                <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                                                                                    <label class="form-label">E-mail</label> <span class="text-danger">*</span>
                                                                                                    <input type="email" id="email" name="email1[]" class="form-control" placeholder="xxx@yy.com" />

                                                                                                </div>
                                                                                                <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"> <br><a href="javascript:void(0);" class="remove_button" style="pointer-events: none;cursor: default;"><i class="fa-solid fa-circle-minus"></i></a> </div>
                                                                                                <hr />

                                                                                                <?php }
                                                                                            if ($count > 0) {
                                                                                                for ($i = 0; $i < $count; $i++) {
                                                                                                ?>
                                                                                                    <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">

                                                                                                        <label class="form-label">First Name</label> <span class="text-danger">*</span>
                                                                                                        <input type="text" id="first_name" name="first_name1[]" class="form-control" value="{{ old('first_name1.'.$i) }}" placeholder="John" />
                                                                                                        @error('first_name1.'.$i)
                                                                                                        <span style="color:red;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                    <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                                                                                                        <label class="form-label">Last Name</label> <span class="text-danger">*</span>
                                                                                                        <input type="text" id="last_name" name="last_name1[]" class="form-control" value="{{ old('last_name1.'.$i) }}" placeholder="Doe" />
                                                                                                        @error('last_name1.'.$i)
                                                                                                        <span style="color:red;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                                                                                        <label class="form-label">E-mail</label> <span class="text-danger">*</span>
                                                                                                        <input type="email" id="email" name="email1[]" class="form-control" value="{{ old('email1.'.$i) }}" placeholder="xxx@yy.com" />
                                                                                                        @error('email1.'.$i)
                                                                                                        <span style="color:red;">{{ $message }}</span>
                                                                                                        @enderror
                                                                                                    </div>
                                                                                                    <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"> <br><a href="javascript:void(0);" class="remove_button" style="pointer-events: none;cursor: default;"><i class="fa-solid fa-circle-minus"></i></a> </div>
                                                                                                    <hr />

                                                                                            <?php }
                                                                                            } ?>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-0">
                                                                                    <button type="button" class="add_button btn btn-primary" style="float: right;">
                                                                                        <i class="ti ti-plus me-1"></i>
                                                                                        <span class="align-middle">Add</span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <p style="height:4px;"></p>
                                                                        <div class="mt-2">
                                                                            <button type="submit" id="nameform" class="btn btn-primary me-2">Submit</button>
                                                                            <button type="reset" class="btn btn-label-secondary">Reset</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                                                                                                
                                        <div class="modal fade modal-xs" id="org_active" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="text-danger" id="modalCenterTitle">Sorry!<span class="name"></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h5 for="nameWithTitle" class="form-label">You are allowed to add maximum of <span class="max_val"></span> Students at a time</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                                                        
                                                                                                                                
                                        <div class="tab-pane fade <?php if ($slug == 'excel_import') echo 'show active'; ?>"" id=" navs-pills-justified-excel" role="tabpanel">
                                            <div class="col-12 col-lg-12">
                                                <div class="mb-4">
                                                    <div class="">
                                                        <div class="card-body">
                                                            <form id="formAccountSettings" method="POST" action="{{route('add_student_by_file')}}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-3"></div>
                                                                    <!--div class="col-md-6">
                                                                        <label for="exampleFormControlSelect1" class="form-label">Class</label>
                                                                        <select class="form-select" id="exampleFormControlSelect1" name="class" aria-label="Default select example">
                                                                            <option selected disabled>Select Class</option>
                                                                            <option value="1">class1</option>
                                                                            <option value="2">class2</option>
                                                                            <option value="3">class3</option>
                                                                            <option value="4">class4</option>
                                                                        </select>
                                                                    </div-->
                                                                    <div class="col-md-3"></div>
                                                                    <p style="height: 2px;"></p>
                                                                    <div class="col-xl-12">
                                                                        <div class="alert alert-warning alert-dismissible" role="alert">
                                                                            Kindly download the sample file to update the values.
                                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 col-md-6">
                                                                        <label for="formFile" class="form-label">Upload Excel</label> <span class="text-danger">*</span>
                                                                        <input class="form-control" id="csvFileInput" name="file" type="file" required />
                                                                    </div>
                                                                    <div class="mb-3 col-md-6">
                                                                        <br>
                                                                        <a type="button" href="{{ URL::to('/Sample.xlsx') }}" class="btn btn-label-primary waves-effect" style="float: right;">
                                                                            <span class="ti-xs ti ti-download me-1"></span>Download Sample File</a>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="{{ asset('assets/flatpickr/flatpickr.js')}}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#mobile_check").click(function() {
                if ($(this).is(":checked")) {
                    $("#mobile").show();
                } else {
                    $("#mobile").hide();
                }
            });
            $("#birthday_check").click(function() {
                if ($(this).is(":checked")) {
                    $("#birthday").show();
                } else {
                    $("#birthday").hide();
                }
            });
            $("#gender_check").click(function() {
                if ($(this).is(":checked")) {
                    $("#gender").show();
                } else {
                    $("#gender").hide();
                }
            });
            $("#class_check").click(function() {
                if ($(this).is(":checked")) {
                    $("#class").show();
                } else {
                    $("#class").hide();
                }
            });
            $("#parent_check").click(function() {
                if ($(this).is(":checked")) {
                    $("#student_parent").show();
                } else {
                    $("#student_parent").hide();
                }
            });
        });
        var loadImage = function(event) {
            var image = document.getElementById('uploadedAvatar');
            image.src = URL.createObjectURL(event.target.files[0]);
        };


        //create CSV file data in an array
        var csvFileData = [];
        //create a user-defined function to download CSV file
        function download_csv_file() {
            //define the heading for each row of the data
            var csv = 'first_name, last_name,email \n';
            //merge the data with CSV
            csvFileData.forEach(function(row) {
                csv += row.join(',');
                csv += "\n";
            });
            var hiddenElement = document.createElement('a');
            hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
            hiddenElement.target = '_blank';
            //provide the name for the CSV file to be downloaded
            hiddenElement.download = 'Sample CSV File.csv';
            hiddenElement.click();
        }

        var regex = new RegExp("(.*?)\.(csv)$");

        function triggerValidation(el) {
            if (!(regex.test(el.value.toLowerCase()))) {
                el.value = '';
                alert('Please select correct file format');
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.group-a'); //Input field wrapper

            //var fieldHTML = '<div class="row"> <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0"> <label class="form-label">First Name</label> <span class="text-danger">*</span> <input type="text" name="first_name1[]" class="form-control" placeholder="John" required /> </div> <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0"> <label class="form-label">Last Name</label> <span class="text-danger">*</span> <input type="text" class="form-control" id="last_name" name="last_name1[]" placeholder="Doe"  required/> </div> <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0"> <label class="form-label">E-mail</label> <span class="text-danger">*</span> <input type="text" id="email" name="email1[]" class="form-control" placeholder="xxx@yy.com" required/> </div> <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"> <br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a> </div> <hr /> </div>'; //New input field html
            var x = 1; //Initial field counter is 1

            // Once add button is clicked
            $(addButton).click(function() {


                var fieldHTML = '<div class="row"> <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0"> <label class="form-label">First Name</label> <span class="text-danger">*</span> <input type="text" name="first_name1[]" class="form-control" placeholder="John" /> </div> <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0"> <label class="form-label">Last Name</label> <span class="text-danger">*</span> <input type="text" class="form-control" id="last_name" name="last_name1[]" placeholder="Doe" /> </div> <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0"> <label class="form-label">E-mail</label> <span class="text-danger">*</span> <input type="text" id="email" name="email1[]" class="form-control" placeholder="xxx@yy.com" /> </div> <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"> <br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a> </div> <hr /> </div>'; //New input field html


                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increase field counter
                    $(wrapper).append(fieldHTML); //Add field html
                } else {
                     $(".max_val").html(maxField);
                    $("#org_active").modal('show');
                }
                addValidationRules();
            });

            // Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').parent('div').remove(); //Remove field html
                x--; //Decrease field counter
            });
            $("#branch_id").change(function() {
                var branch_id = $('option:selected', this).val();
                var ajax_url = $('#ajax_url').val();
                // alert(ajax_url+branch_id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: ajax_url,
                    data: {
                        'branch_id': branch_id
                    },
                    success: function(data) {
                        console.log(data);
                        var options = '<option value="">Select Parent</option>';
                        //alert(data.length);
                        $.each(data, function(index, item) {
                            // alert(item.id)
                            options += '<option value="' + item.id + '">' + item.first_name + ' ' + item.last_name + '</option>';
                        });

                        $('#parent').html(options);
                    }
                });
            });
        });
    </script>

</body>

</html>
