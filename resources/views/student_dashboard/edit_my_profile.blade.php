<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Edit MY Profile</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.css')}}" />
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    $branch_name = App\Models\Branch::getBranchNameByBranchId($data->branch_id);
    $parent_name = App\Models\User::getParentNameByParentID($data->parent_id);
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
            @include('student_dashboard.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('student_dashboard.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="d-flex flex-column justify-content-center">
                            <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">Edit My profile</h4>
                        </div>
                        <p style="height: 2px;"></p>
                        <!-- Pills -->
                        <div class="row">
                            <div class="col-xl-12">
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
                                                        <form id="formAccountSettings" method="POST" action="{{route('update_my_profile_student')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                                    <?php
                                                                    $student_avatar = !empty($data->student_avatar) ? $data->student_avatar : '9.png';
                                                                    ?>
                                                                    <img src="{{asset('assets/img/student_avatar/'.$student_avatar)}}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                                                    <div class="button-wrapper">
                                                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                                                            <span class="d-none d-sm-block">Upload new photo</span>
                                                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                                                            <input type="file" id="upload" class="account-file-input" name="student_avatar" hidden accept="image/png, image/jpeg" onchange="loadImage(event)" />
                                                                        </label>
                                                                        <!--button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                                                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                                                            <span class="d-none d-sm-block">Reset</span>
                                                                        </button-->
                                                                        <div class="text-muted">File size should be less than 100kb and dimension must be less than 100 px*100 px</div>
                                                                        @error('student_avatar')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <p style="height: 2px;"></p>
                                                                <div class="mb-3 col-md-6">
                                                                    <input type="hidden" name="organization_id" value="<?php echo $org_id; ?>">
                                                                    <!-- <input type="hidden" -->
                                                                    <label for="firstName" class="form-label">First Name</label><span class="text-danger">*</span>
                                                                    <input class="form-control" type="text" value="{{ $data->first_name; }}" id="firstName" name="firstName" placeholder="John" autofocus />
                                                                    @error('firstName')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label for="lastName" class="form-label">Last Name</label><span class="text-danger">*</span>
                                                                    <input class="form-control" type="text" value="{{ $data->last_name; }}" name="lastName" id="lastName" placeholder="Doe" />
                                                                    @error('lastName')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <!-- <div class="mb-3 col-md-6">
                                                                    <label for="email" class="form-label">E-mail</label><span class="text-danger">*</span>
                                                                    <input class="form-control" type="text" id="email" value="{{ $data->email; }}" name="email" placeholder="john.doe@example.com" />
                                                                    @error('email')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div> -->


                                                                <div class="mb-3 col-md-6">
                                                                    <label for="email" class="form-label">Mobile Number</label>
                                                                    <input class="form-control" type="tel" name="mobileNumber" value="{{ $data->mobile_number; }}" placeholder="90-(164)-188-556" />
                                                                    @error('mobileNumber')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <!-- <div class="mb-3 col-md-6">
                                                                <label for="ID" class="form-label">ID</label>
                                                                <input class="form-control" type="text" name="id" id="id" placeholder="123456" />
                                                                </div> -->
                                                                <!--div class="mb-3 col-md-6" id="class">
                                                                    <label for="exampleFormControlSelect1" class="form-label">Class</label>
                                                                    <select class="form-select" id="class" name="class" aria-label="Default select example">
                                                                        <option value="{{ $data->class; }}">{{ $data->class; }}</option>
                                                                        <option value="class1">class1</option>
                                                                        <option value="class2">class2</option>
                                                                        <option value="class3">class3</option>
                                                                        <option value="class4">class4</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                     <label for="exampleFormControlSelect1" class="form-label">Section</label>
                                                                     <select class="form-select" id="section" name="section" aria-label="Default select example">
                                                                        <option value="{{ $data->section; }}">{{ $data->section; }}</option>
                                                                        <option value="section1">section1</option>
                                                                        <option value="section2">section2</option>
                                                                        <option value="section3">section3</option>
                                                                        <option value="section4">section4</option>
                                                                     </select>
                                                                  </div-->
                                                                <?php $gender_list = array('Male', 'Female', 'other'); ?>
                                                                <div class="mb-3 col-md-6">
                                                                    <label for="exampleFormControlSelect1" class="form-label">Gender</label>
                                                                    <select class="form-select" id="exampleFormControlSelect1" name="gender" aria-label="Default select example">
                                                                        <option value="">Select Gender</option>
                                                                        @foreach ($gender_list as $gender)
                                                                        <?php if ($data->gender == $gender)
                                                                            $sele = 'selected';
                                                                        else
                                                                            $sele = '';
                                                                        echo '<option ' . $sele . ' value="' . $gender . '">' . $gender . '</option>'; ?>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-6" id="birthday">
                                                                    <label for="email" class="form-label">Date of Birth</label>
                                                                    <input class="form-control" type="text" id="flatpickr-date1" value="{{ !empty($data->birth_date)?$data->birth_date->format('d/m/Y'):NULL; }}" name="birthdate" />
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label for="address" class="form-label">Address</label>
                                                                    <textarea class="form-control" id="address" name="address" rows="3">{{ $data->address; }}</textarea>
                                                                </div>
                                                                @error('address')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                <div class="mb-3 col-md-6">
                                                                    <label for="state" class="form-label">City</label>
                                                                    <input class="form-control" type="text" id="city" value="{{ $data->city; }}" name="city" placeholder="" />
                                                                </div>
                                                                @error('city')
                                                                <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label" for="country">Country</label>
                                                                    <select id="country" name="country" class="select2 form-select">
                                                                        <option value="">Select Country</option>
                                                                        @foreach ($countries as $country)
                                                                        <?php if ($data->country_id == $country->id)
                                                                            $sele = 'selected';
                                                                        else
                                                                            $sele = '';
                                                                        echo '<option ' . $sele . ' value="' . $country->id . '">' . $country->name . '-' . $country->shortname . '</option>'; ?>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('country')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <input type="hidden" id="ajax_url" name="ajax_url" value="{{route('get_parents_by_branch')}}">
                                                                <div class="mb-3 col-md-6">
                                                                    <label for="zipCode" class="form-label">Zip Code</label>
                                                                    <input type="text" class="form-control" id="zipCode" value="{{ $data->zip_code; }}" name="zipCode" placeholder="231465" />
                                                                    <input type="hidden" id="id" name="id" value="{{$data->id;}}">
                                                                    @error('zipCode')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                            <div class="mt-2">
                                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                                <a href="{{route('my_profile_student')}}" class="btn btn-label-secondary">Discard</a>
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
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#branch_id").on('change', function() {
                                var branch_id = $('option:selected', this).val();
                                var parent_id = '<?php echo $data->parent_id; ?>';
                                var parent_name = '<?php echo $parent_name; ?>';
                                var ajax_url = $('#ajax_url').val();

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


                        var loadImage = function(event) {
                            var image = document.getElementById('uploadedAvatar');
                            image.src = URL.createObjectURL(event.target.files[0]);
                        };
                        var regex = new RegExp("(.*?)\.(csv)$");

                        function triggerValidation(el) {
                            if (!(regex.test(el.value.toLowerCase()))) {
                                el.value = '';
                                alert('Please select correct file format');
                            }
                        }
                    </script>
                    <!-- Page JS -->
                    <script type="text/javascript">
                        new DataTable('#example', {
                            scrollX: true
                        });
                    </script>
</body>

</html>
