<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Classroom Integrations</title>

    <meta name="description" content="" />
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>
    @include('dashboard.header')

    <link rel="stylesheet" href="{{ asset("assets/select2/select2.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/bootstrap-select/bootstrap-select.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/tagify/tagify.css") }}" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <link rel="stylesheet" href="{{ asset("assets/quill/editor.css") }}" />
</head>
<style type="text/css">
    .class_integrate .btn-primary {
        background-color: <?php echo $org_color; ?> !important;
        border-color: <?php echo $org_color; ?> !important;
    }

    .class_integrate .app-brand-logo.demo {
        width: auto !important;
        height: auto !important;
    }

    .class_integrate .form-check-input:checked,
    .class_integrate .form-check-input[type=checkbox]:indeterminate {
        background-color: <?php echo $org_color; ?> !important;
        border-color: <?php echo $org_color; ?> !important;
    }

    .class_integrate .form-check-input:focus {
        border-color: <?php echo $org_color; ?> !important;
    }

    .class_integrate .bg-primary {
        background-color: <?php echo $org_color; ?> !important;
    }

    .class_integrate .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
    .class_integrate .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
    .class_integrate .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
    .class_integrate .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
        background: linear-gradient(72.47deg, #fce4e4 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
        color: #ffffff !important;
    }

    .class_integrate .menu-vertical .app-brand {
        margin: 20px 0.875rem 20px 1rem;
    }

    .class_integrate i {
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

    .class_integrate #template-customizer .template-customizer-open-btn {
        display: none;
    }

    #formAccountSettings .content {
        text-align: left;
    }

    .classduration .controls {
        top: 43% !important;
        left: 86% !important;
    }

    .classduration .scroll-btn:nth-child(1) {
        top: -10px !important;
        min-height: 10px !important;
        height: 10px !important;
    }

    .classduration .scroll-btn:nth-child(2) {
        top: 4px !important;
        min-height: 10px !important;
        height: 10px !important;
        transform: translateY(0px);
    }

    .html-duration-picker {
        display: block !important;
        width: 100% !important;
        padding: 0.422rem 0.875rem !important;
        font-size: 0.9375rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        color: #6f6b7d !important;
        appearance: none !important;
        background-color: #fff !important;
        background-clip: padding-box !important;
        border: var(--bs-border-width) solid #dbdade !important;
        border-radius: var(--bs-border-radius) !important;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
    }

    .html-duration-picker-input-controls-wrapper {
        width: auto !important;
    }

    .html-duration-picker:focus {
        color: #6f6b7d;
        background-color: #fff;
        border-color: #7367f0;
        outline: 0;
        box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
    }

    .html-duration-picker-input-controls-wrapper .html-duration-picker {
        text-align: left !important;
    }

    .class_integrate .nav-pills .nav-link.active,
    .class_integrate .nav-pills .nav-link.active:hover,
    .class_integrate .nav-pills .nav-link.active:focus {
        background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
        color: #ffffff !important;
    }

    .class_integrate .nav-pills .nav-link:hover {
        color: <?php echo $org_color; ?> !important;
    }

    .card_icon {
        font-size: 1.625rem !important;
    }

    .class_integrations:hover {
        cursor: pointer;
    }

    .text-center {
        text-align: center !important;
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

    td {
        box-shadow: none !important;
    }

    .dt-layout-row {
        padding-bottom: 20px;
    }

    .table_admin th {
        color: #5d596c;
        font-weight: normal;
        text-transform: uppercase;
        font-size: 0.8125rem;
        letter-spacing: 1px;
    }

    .table_admin .dt-paging-button.current {
        background: rgba(75, 70, 92, 0.08);
        border: 1px solid #aaa;
    }

    .table_admin .dt-paging-button.current:active {
        color: #6f6b7d !important;
        background-color: #fff !important;
        border-color: #7367f0 !important;
        outline: 0 !important;
        box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3) !important;
    }

    .layout-page::before {
        content: none !important;
    }

    .sidebar_intergrate .active .accordion-button {
        box-shadow: 0 0.125rem 0.25rem <?php echo $org_color; ?>;
        background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
        color: #ffffff !important;
    }

    .sidebar_intergrate .alert {
        padding: 7px 10px;
    }

    .sidebar_intergrate .alert:hover {
        cursor: pointer;
    }

    .sidebar_intergrate .tf-icons {
        font-size: 20px !important;
    }

    .sidebar_intergrate .accordion-button {
        background-color: #e2e2e2;
        border-color: #e2e2e2;
        color: #4b4b4b;
    }

    .assign_student .form-check-input:checked,
    .form-check-input[type=checkbox]:indeterminate {
        background-color: #e2e2e2;
        border-color: #e2e2e2;
    }

    .classroom_sidebar {
        align-items: flex-start;
        justify-content: flex-start;
        padding: 15px 21px;
        background-color: #e2e2e2;
        border-color: #e2e2e2;
        color: #4b4b4b;
    }

    .classroom_sidebar.active {
        background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
        color: #ffffff !important;
        border-color: <?php echo $org_color; ?> !important;
    }

    .sidebar_intergrate .accordion-button:hover {
        color: #fff !important;
        background-color: #444444 !important;
        border-color: #444444 !important;
    }
</style>

<body class="class_integrate">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">		
            <div class="layout-page" style="padding-top: 0px !important; padding-left: 0px;">
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
								@if(session()->has('fail'))
                                <div class="alert alert-danger">
                                    {{ session()->get('fail') }}
                                </div>
                                @endif
						<div class="app-ecommerce">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center align-items-md-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <h4 class="mb-1 mt-4" style="color: <?php echo $org_color; ?>;">Classroom - <span style="font-style: italic;">{{$classroom->class_room_name}}</span></h4>
                                </div>
                                <div class="d-flex align-content-center flex-wrap gap-3">
                                    <div class="d-flex gap-3">
                                        <a href="{{route('index_list')}}">
                                            <button class="btn btn-label-secondary btn-prev">
                                                <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Back to Classrooms</span>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Product -->
                            <p style="height: 2px;"></p>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6 mb-4">
                                            <div class="card card-border-shadow-secondary h-100">
                                                <div class="card-body d-flex align-items-center">
                                                    <div class="card-icon" style="margin-right: 10px;">
                                                        <span class="badge bg-label-secondary rounded-pill p-3">
                                                            <i class="card_icon fa-solid fa-user-graduate"></i>
                                                        </span>
                                                    </div>
                                                    <div class="card-title mb-0">
                                                        <small>Total Number of Courses</small>
                                                        <h5 class="mb-0 me-2">30</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 mb-4">
                                            <div class="card card-border-shadow-primary h-100">
                                                <div class="card-body d-flex align-items-center">
                                                    <div class="card-icon" style="margin-right: 10px;">
                                                        <span class="badge bg-label-primary rounded-pill p-3">
                                                            <i class="card_icon fa-solid fa-user-graduate"></i>
                                                        </span>
                                                    </div>
                                                    <div class="card-title mb-0">
                                                        <span class="mb-0 me-2" style="font-size: 1.125rem;">10/100</span><small>Teachers</small>
                                                        <br>
                                                        <small style="color: #ff9f43;font-weight: bold;font-style: italic;">Not Assigned</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 mb-4">
                                            <div class="card card-border-shadow-info h-100">
                                                <div class="card-body d-flex align-items-center">
                                                    <div class="card-icon" style="margin-right: 10px;">
                                                        <span class="badge bg-label-info rounded-pill p-3">
                                                            <i class="card_icon tf-icons ti ti-brand-nexo ti-md"></i>
                                                        </span>
                                                    </div>
                                                    <div class="card-title mb-0">
                                                        <span class="mb-0 me-2" style="font-size: 1.125rem;">10/100</span><small>Classes</small>
                                                        <br>
                                                        <small style="color: #ff9f43;font-weight: bold;font-style: italic;">Not Assigned</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 mb-4">
                                            <div class="card card-border-shadow-dark h-100">
                                                <div class="card-body d-flex align-items-center">
                                                    <div class="card-icon" style="margin-right: 10px;">
                                                        <span class="badge bg-label-dark rounded-pill p-3">
                                                            <i class="card_icon fa-solid fa-users"></i>
                                                        </span>
                                                    </div>
                                                    <div class="card-title mb-0">
                                                        <span class="mb-0 me-2" style="font-size: 1.125rem;">10/100</span><small>Students</small>
                                                        <br>
                                                        <small style="color: #ff9f43;font-weight: bold;font-style: italic;">Not Assigned</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4 col-md-12 sidebar_intergrate">
                                    <div class="row">
                                        <div class="col-lg-4 mb-4 col-md-12">
                                            <div class="col-md mb-4 mb-md-2">
                                                <!-- Assign Student -->
                                                <button type="submit" class="btn btn-dark mb-2 col-md-12 classroom_sidebar classroom_sidebar_assignstudent" id="headingOne">
                                                    <i class="tf-icons ti ti-table-plus ti-md me-1"></i>
                                                    <span style="position: relative;top: 1px;">Assign Students</span>
                                                </button>
												<!-- Generate  Zoom Meeting -->
                                                <button type="submit" class="btn btn-dark mb-2 col-md-12 classroom_sidebar classroom_sidebar_zoom_meeting" id="headingFive">
                                                    <i class="tf-icons ti ti-speakerphone ti-md me-1"></i>
                                                    <span style="position: relative;top: 1px;">Generate Zoom Meeting  </span>
                                                </button>
                                                <!-- Adding a new announcement -->
                                                <button type="submit" class="btn btn-dark mb-2 col-md-12 classroom_sidebar classroom_sidebar_announcement" id="headingTwo">
                                                    <i class="tf-icons ti ti-speakerphone ti-md me-1"></i>
                                                    <span style="position: relative;top: 1px;">Adding a Class Anouncement</span>
                                                </button>
                                                <!-- Login To Live Class -->
                                                <button type="submit" class="btn btn-dark mb-2 col-md-12 classroom_sidebar classroom_sidebar_liveclass" id="headingThree">
                                                    <i class="tf-icons ti ti-login ti-md me-1"></i>
                                                    <span style="position: relative;top: 1px;">Login To Live Class</span>
                                                </button>
                                                <!-- Video Course -->
                                                <button type="submit" class="btn btn-dark mb-2 col-md-12 classroom_sidebar classroom_sidebar_loginvideo" id="headingFour">
                                                    <i class="tf-icons ti ti-video ti-md me-1"></i>
                                                    <span style="position: relative;top: 1px;">Video Courses</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 mb-4 col-md-12">
                                            <!-- Assign Student -->
                                            <form action="{{ route('assign_students') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" id="ajax_url" value="{{URL::to('/')}}" />
                                                <div class="card mb-4" id="student_assign">
                                                    <h5 class="card-header" style="color: <?php echo $org_color; ?>;">Assign Students <span class="badge bg-success" id="sub_name" style="float: right;"></span></h5>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <input type="hidden" name="id" value="{{$id}}">
                                                                <label for="select2Basic" class="form-label">Subject Name</label>
                                                                <?php 
																$stu_arr=[];
																if($subjects_edit)
																{
																$stu_str= $subjects_edit->students_id;
																$stu_arr=explode(",",$stu_str);
																
																}
																?>
																<select id="subjects_list" class="select2 form-select form-select-lg" name="subject_id" data-allow-clear="true">
                                                                    <option value="">Select Subject</option>
																	@foreach ($subjects as $subject)
                                                                    <?php 
																	/*if ($subject->subject_id == old('subject_id'))
                                                                        $sel = 'selected';
                                                                    else
                                                                        $sel = '';*/
																	$sel = '';
																	if(isset($_GET['subject_id']))
																	{
																		if($_GET['subject_id']==$subject->subject_id)
																			$sel = 'selected';
																		else
																			$sel = '';
																	}
                                                                    echo '<option '.$sel.' value="' . $subject->subject_id . '">' . App\Models\Subject::getSubjectNameBySubjectID($subject->subject_id) . '</option>'; ?>
                                                                    @endforeach
                                                                </select>
																 @error('subject_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                            </div>
                                                            <input type="hidden" id="classroom_id" value="{{$id}}">
                                                            <input type="hidden" id="maximum_val" value="{{$classroom->number_of_students}}">
                                                            <div class="col-md-12 mb-4">
                                                                <!-- <label for="TagifyUserList" class="form-label">Student Lists</label>
                                                                <input id="TagifyUserList" name="TagifyUserList" class="form-control" value="abatisse2@nih.gov, Justinian Hattersley" /> -->
                                                                <label for="select2Basic" class="form-label">Students List</label>
																<select id="students_list" multiple="multiple" class="student_select form-select form-select-lg" name="students_id[]" data-allow-clear="true">
																   @foreach ($students as $student)
                                                                    <?php
																		if(in_array($student->id,$stu_arr))
																		$sel = 'selected';
																		else
																		$sel = '';
                                                                    /*if (in_array($student->id, explode(',', $subject->students_id)))
                                                                        $sel = 'selected';
                                                                    else
                                                                        $sel = '';*/
                                                                    echo '<option '.$sel.' value="' . $student->id . '">' . App\Models\User::getStudentNameByID($student->id) . '</option>'; ?>
                                                                    @endforeach
                                                                </select>
																 @error('students_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mt-2">
                                                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                            <!--button type="reset" class="btn btn-label-secondary">Cancel</button-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            
											<!--Generate Zoom-->											
                                            <div class="card mb-4" id="generate_zoom">
                                                <h5 class="card-header" style="color: <?php echo $org_color; ?>;">Generate Zoom Meeting   <span class="badge bg-success" id="announce_name" style="float: right;"></span></h5>
                                                <div class="card-body">
                                                    <form action="{{ route('generate_zoom_meeting_post') }}" method="POST">
											@csrf
                                                <div class="card mb-4">
                                                    
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <!--label for="select2Basic" class="form-label">Topic</label-->
																<input type="hidden" name="id" value="{{ $classroom->id }}">
                                                                <input type="hidden" class="form-control" name="topic" value="{{$classroom->class_room_name}}">
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="mt-2 col-md-12 mb-4">
                                                                    <button type="submit" class="btn me-2" style="background-color:#3b5998; color:#ffffff">Generate</button>
                                                                </div>
                                                                <div class="col-md-12 mb-4">
                                                                    <input type="text" class="form-control" name="zoom_link">
                                                                </div>
                                                    </div>
                                                </div>
                                            </form>
                                                  <?php
											if($classroom->zoom_join_url) {
												?>
                                                <a target="_blank" href="{{ route('zoom_meeting',$classroom->id) }}">
                                                   {{ route('zoom_meeting',$classroom->id) }}
												   <!--span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="custom-tooltip" title="Zoom Meeting" class="badge badge-center bg-primary">
                                                        <i class="ti ti-brand-zoom"></i>
                                                    </span-->
                                                </a>
												<?php } ?> 
                                                </div>
                                            </div>
                                            <!--Generate Zoom-->
											
											<!-- Adding a new announcement -->
                                            <div class="card mb-4" id="class_announcements">
                                                <h5 class="card-header" style="color: <?php echo $org_color; ?>;">Adding a Class Anouncement <span class="badge bg-success" id="announce_name" style="float: right;"></span></h5>
                                                <div class="card-body">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="select2Basic" class="form-label">Subject Name</label>
                                                        <select id="select2Basic1" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="N4">N4 Intermediate</option>
                                                            <option value="N5">N5 Advanced</option>
                                                        </select>
                                                    </div>
                                                    <div id="full-editor">
                                                        <h6>Quill Rich Text Editor</h6>
                                                        <p>
                                                            Cupcake ipsum dolor sit amet. Halvah cheesecake chocolate bar gummi bears cupcake. Pie macaroon bear claw. Soufflé I love candy canes I love cotton candy I love.
                                                        </p>
                                                    </div>
                                                    <div class="mt-2">
                                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                        <!--button type="reset" class="btn btn-label-secondary">Cancel</button-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Login To Live Class -->
                                            <div class="card mb-4" id="login_liveclass">
                                                <h5 class="card-header" style="color: <?php echo $org_color; ?>;">Login To Live Class <span class="badge bg-success" id="classlive" style="float: right;"></span></h5>
                                                <div class="card-body" id="liveclass_show">
                                                    <div class="col-md-6 mb-4">
                                                        <label for="select2Basic" class="form-label">Subject Name</label>
                                                        <select id="select2Basic2" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="N4">N4 Intermediate</option>
                                                            <option value="N5">N5 Advanced</option>
                                                        </select>
                                                    </div>
                                                    <div class="row g-3">
                                                        <div class="col-sm-6 mb-3">
                                                            <label for="defaultFormControlInput" class="form-label">Started On</label>
                                                            <input type="text" class="form-control" id="defaultFormControlInput" value="27-03-2024 16:00" aria-describedby="defaultFormControlHelp" readonly>
                                                        </div>
                                                        <div class="col-sm-6 mb-3">
                                                            <label for="defaultFormControlInput" class="form-label">Duration</label>
                                                            <input type="text" class="form-control" id="defaultFormControlInput" value="3 months" aria-describedby="defaultFormControlHelp" readonly>
                                                        </div>
                                                        <div class="col-sm-6 mb-3">
                                                            <label for="defaultFormControlInput" class="form-label">Teacher</label>
                                                            <input type="text" class="form-control" id="defaultFormControlInput" value="John Doe" aria-describedby="defaultFormControlHelp" readonly>
                                                        </div>
                                                        <div class="col-sm-6 mb-3">
                                                            <label for="defaultFormControlInput" class="form-label">Status</label>
                                                            <div class="progress" style="margin:12px 0px;">
                                                                <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                                    25%
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 mb-3">
                                                            <label for="defaultFormControlInput" class="form-label">Link</label>
                                                            <input type="text" class="form-control" id="defaultFormControlInput" value="https://zoom.us/j/96576334898?pwd=MHZiOENrZWFabVgxTWwySHJENytLUT09" aria-describedby="defaultFormControlHelp" readonly>
                                                        </div>
                                                        <div class="mt-2">
                                                            <button type="submit" class="btn btn-primary me-2" style="float:right;">Join</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Video Course -->
                                            <div class="card mb-4" id="login_video">
                                                <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                                                    <div class="card-title mb-0 me-1">
                                                        <h5 class="mb-4" style="color: <?php echo $org_color; ?>;">Video Courses <span class="badge bg-success" id="loginlive" style="float: right;"></span></h5>
                                                    </div>
                                                    <div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
                                                        <select id="select2Basic3" class="select2 form-select form-select-lg" data-allow-clear="true">
                                                            <option value="N4">N4</option>
                                                            <option value="N5">N5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-3">
                                                        <div class="card mb-2" style="background: #bdb8b83b;padding: 0px;">
                                                            <div class="card-body" style="padding:0px;">
                                                                <div class="col-lg-12 col-xl-12 col-md-12">
                                                                    <div class="row g-3">
                                                                        <div class="col-lg-5 col-xl-5 col-md-12">
                                                                            <img src="{{asset('assets/img/course/grid_1.png')}}" width="100%" style="height: 170px;">
                                                                        </div>
                                                                        <div class="col-lg-7 col-xl-7 col-md-12" style="padding: 1rem;">
                                                                            <div class="col-lg-12 col-xl-12 col-md-12">
                                                                                <div class="row g-3">
                                                                                    <div class="col-lg-6 col-xl-6 col-md-12" style="color:#7367f0;">
                                                                                        <i class="ti ti-notes"></i>&nbsp;<small>23 lessons</small>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-xl-6 col-md-12" style="color:#7367f0;float:left;">
                                                                                        <i class="ti ti-clock-hour-9"></i>&nbsp;<small>1hr 30mins</small>
                                                                                    </div>
                                                                                    <div class="col-lg-12 col-xl-12 col-md-12 mb-2">
                                                                                        <h5 class="mb-0">
                                                                                            <a href="course-details.html" style="color: #dd3333;">N4 Intermediate</a>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-lg-12 col-xl-12 col-md-12 mb-2" style="margin-top:0px;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6 col-xl-6 col-md-12" style="color:#ff9f43 !important;">
                                                                                                <small>Starting On: March 20, 2024</small>
                                                                                            </div>
                                                                                            <div class="col-lg-6 col-xl-6 col-md-12" style="color:#7367f0;">
                                                                                                <span class="badge bg-label-info live_badge" style="float:left;">N4</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 col-xl-12 col-md-12" style="margin-top:0px;">
                                                                                        <span id="demo" style="float:left;color: #00751f;font-weight: bold;font-size: 25px;"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card" style="background: #bdb8b83b;padding: 0px;">
                                                            <div class="card-body" style="padding:0px;">
                                                                <div class="col-lg-12 col-xl-12 col-md-12">
                                                                    <div class="row g-3">
                                                                        <div class="col-lg-5 col-xl-5 col-md-12">
                                                                            <img src="{{asset('assets/img/course/grid_1.png')}}" width="100%" style="height: 170px;">
                                                                        </div>
                                                                        <div class="col-lg-7 col-xl-7 col-md-12" style="padding: 1rem;">
                                                                            <div class="col-lg-12 col-xl-12 col-md-12">
                                                                                <div class="row g-3">
                                                                                    <div class="col-lg-6 col-xl-6 col-md-12" style="color:#7367f0;">
                                                                                        <i class="ti ti-notes"></i>&nbsp;<small>23 lessons</small>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-xl-6 col-md-12" style="color:#7367f0;float:left;">
                                                                                        <i class="ti ti-clock-hour-9"></i>&nbsp;<small>1hr 30mins</small>
                                                                                    </div>
                                                                                    <div class="col-lg-12 col-xl-12 col-md-12 mb-2">
                                                                                        <h5 class="mb-0">
                                                                                            <a href="course-details.html" style="color: #dd3333;">N4 Intermediate</a>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-lg-12 col-xl-12 col-md-12 mb-2" style="margin-top:0px;">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6 col-xl-6 col-md-12" style="color:#ff9f43;">
                                                                                                <small>Starting On: March 20, 2024</small>
                                                                                            </div>
                                                                                            <div class="col-lg-6 col-xl-6 col-md-12" style="color:#7367f0;">
                                                                                                <span class="badge bg-label-info live_badge" style="float:left;">N4</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 col-xl-12 col-md-12" style="margin-top:0px;">
                                                                                        <button type="submit" class="btn btn-primary me-2" style="float:left;">Join</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                        <div class="col ">
                                            <h for="nameWithTitle" class="form-label">You can assign maximum <span class="max_val"></span> Students only!</h>
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
                    
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                    <!-- / Content -->

                    <!-- Footer -->

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
    <script src="{{ asset("assets/select2/select2.js") }}"></script>
    <script src="{{ asset("assets/bootstrap-select/bootstrap-select.js") }}"></script>
    <script src="{{ asset("assets/js/forms-selects.js") }}"></script>
    <script src="{{ asset("assets/tagify/tagify.js") }}"></script>
    <!-- <script src="{{ asset("assets/js/forms-tagify.js") }}"></script> -->
    <script src="{{ asset("assets/quill/quill.js") }}"></script>
    <script src="{{ asset("assets/js/forms-editors.js") }}"></script>
    
	<script type="text/javascript">
        $(document).ready(function() {
            $("#overview_classroom").hide();
            $("#class_announcements").hide();
            $("#login_liveclass").hide();
            $("#login_video").hide();
            $('#generate_zoom').hide();

            $("#headingOne").click(function() {
                $("#student_assign").show();
                $(".classroom_sidebar_assignstudent").addClass("active");

                $("#class_announcements").hide();
                $(".classroom_sidebar_announcement").removeClass("active");
                $("#login_liveclass").hide();
                $(".classroom_sidebar_liveclass").removeClass("active");
                $("#login_video").hide();
                $(".classroom_sidebar_loginvideo").removeClass("active");
                $("#generate_zoom").hide();
                $(".classroom_sidebar_zoom_meeting").removeClass("active");

            });

            $("#headingTwo").click(function() {
                $("#class_announcements").show();
                $(".classroom_sidebar_announcement").addClass("active");

                $("#student_assign").hide();
                $(".classroom_sidebar_assignstudent").removeClass("active");
                $("#login_liveclass").hide();
                $(".classroom_sidebar_liveclass").removeClass("active");
                $("#login_video").hide();
                $(".classroom_sidebar_loginvideo").removeClass("active");
                $("#generate_zoom").hide();
                $(".classroom_sidebar_zoom_meeting").removeClass("active");
            });

            $("#headingThree").click(function() {
                $("#login_liveclass").show();
                $(".classroom_sidebar_liveclass").addClass("active");

                $("#student_assign").hide();
                $(".classroom_sidebar_assignstudent").removeClass("active");
                $("#class_announcements").hide();
                $(".classroom_sidebar_announcement").removeClass("active");
                $("#login_video").hide();
                $(".classroom_sidebar_loginvideo").removeClass("active");
                $("#generate_zoom").hide();
                $(".classroom_sidebar_zoom_meeting").removeClass("active");
            });

            $("#headingFour").click(function() {
                $("#login_video").show();
                $(".classroom_sidebar_loginvideo").addClass("active");

                $("#student_assign").hide();
                $(".classroom_sidebar_assignstudent").removeClass("active");
                $("#class_announcements").hide();
                $(".classroom_sidebar_announcement").removeClass("active");
                $("#login_liveclass").hide();
                $(".classroom_sidebar_liveclass").removeClass("active");
                $("#generate_zoom").hide();
                $(".classroom_sidebar_zoom_meeting").removeClass("active");
            });
            $("#headingFive").click(function() {
                $("#generate_zoom").show();
                $(".classroom_sidebar_zoom_meeting").addClass("active");

                $("#student_assign").hide();
                $(".classroom_sidebar_assignstudent").removeClass("active");
                $("#class_announcements").hide();
                $(".classroom_sidebar_announcement").removeClass("active");
                $("#login_liveclass").hide();
                $(".classroom_sidebar_liveclass").removeClass("active");
                $("#login_video").hide();
                $(".classroom_sidebar_loginvideo").removeClass("active");
            });
        });
    </script>
    <script>
        new DataTable('#studentlist_integrate', {
            scrollX: true
        });
    </script>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("Mar 28, 2024 15:37:25").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            document.getElementById("demo1").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#headingFour').on('click', function(event) {
                $('.collapse').collapse('hide')
            });
            //$(".select2-selection__placeholder").html("All Courses");
			$('#subjects_list').change(function() {
				var subject_id = this.value;
                var classroom_id = $('#classroom_id').val();
				var ajax_url = $('#ajax_url').val() + '/admin/class_room/manage/' + classroom_id + '?subject_id=' + subject_id;
                window.location = ajax_url;
			});
            /*$('#subjects_list').change(function() {
                var subject_id = this.value;
                var classroom_id = $('#classroom_id').val();

                var ajax_url = $('#ajax_url').val() + '/admin/class_room/get_students/' + classroom_id + '/' + subject_id;
                alert(ajax_url);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: ajax_url,
                    success: function(data) {
                        console.log(data);
                        $("#student_list").select2("val", data);
                        //                         var options = '';
                        //                         var temp = new Array();
                        //                         // This will return an array with strings "1", "2", etc.
                        //                         temp = data.split(",");
                        //                         for (let i = 0; i < temp.length; ++i) {
                        //                             console.log(temp[i]);
                        //     // do something with `substr[i]`
                        // }
                    }
                });
            });*/
        });
    </script>
    <script type="text/javascript">
        $("#students_list").on('change', function(e) {
            var maximum_val=$('#maximum_val').val();
            if (Object.keys($(this).val()).length > maximum_val) {
                $('option[value="' + $(this).val().toString().split(',')[maximum_val] + '"]').prop('selected', false);
                $(".max_val").html(maximum_val);
                $("#org_active").modal('show');
            }
        });
    </script>
</body>

</html>
