<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Teacher Assessments</title>
  <meta name="description" content="" />
   <!-- provide the csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  @include('dashboard.header')
  <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    $admin_name= App\Models\User::getOrgAdminNameById($user_id);
    ?>

  <link rel="stylesheet" href="{{asset('assets/jquery-timepicker/jquery-timepicker.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/flatpickr/flatpickr.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/bootstrap-select/bootstrap-select.css')}}" />

  <style type="text/css">
    .admin_assignments .app-brand-logo.demo {
      width: auto !important;
      height: auto !important;
    }

    .admin_assignments .form-check-input:checked,
    .admin_assignments .form-check-input[type=checkbox]:indeterminate {
      background-color: <?php echo $org_color; ?> !important;
      border-color: <?php echo $org_color; ?> !important;
    }

    .admin_assignments .form-check-input:focus {
      border-color: <?php echo $org_color; ?> !important;
    }

    .admin_assignments .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
    .admin_assignments .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
    .admin_assignments .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
    .admin_assignments .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle) {
      background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
      color: #ffffff !important;
    }

    .admin_assignments .menu-vertical .app-brand {
      margin: 20px 0.875rem 20px 1rem;
    }

    .admin_assignments .icon_resize {
      font-size: 17px !important;
    }

    .admin_assignments #layout-menu .icon_resize {
      margin-right: 10px;
    }

    .layout-navbar-fixed .layout-page:before {
      background: #0000000d;
      mask: none;
    }

    .admin_assignments #template-customizer .template-customizer-open-btn {
      display: none;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
      background-color: #fce4e4;
      border-color: #fce4e4;
      color: inherit !important;
    }

    .dropdown-item:not(.disabled).active,
    .dropdown-item:not(.disabled):active {
      background-color: <?php echo $org_color; ?>;
      color: #fff !important;
    }

    html:not(.layout-menu-collapsed) .bg-menu-theme .menu-inner .menu-item:not(.active) > .menu-link:hover {
      background-color: #fce4e4 !important;
      border-color: #fce4e4 !important;
      color: inherit !important;
    }

    #pagetitle,
    #modalCenterTitle,
    #exampleModalLabel5 {
      color: <?php echo $org_color; ?>;
    }

    #reportrange:focus {
      color: #6f6b7d;
      background-color: #fff !important;
      border-color: #7367f0 !important;
      outline: 0;
      box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
    }

    #home_work:hover {
      background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
      color: #ffffff !important;
      padding: 5px 10px;
      border-radius: 5px;
    }

    .word_ellipsis {
      white-space: nowrap;
      width: 100px;
      overflow: hidden;
      text-overflow: ellipsis;
      text-align: center;
      padding: 5px 10px;
      border-radius: 5px;
    }

    #excel_file::before {
      content: "Upload File";
      position: absolute;
      z-index: 2;
      display: block;
      background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, rgb(224, 8, 20, 0.7) 76.47%);
      width: 212px;
      /*left: 24px;
    top: 71px;*/
      padding: 7px 5px;
      border-radius: 4px;
      text-align: center;
      color: #fff;
      border: 0px;
    }

    input#excel_file {
      box-shadow: none;
    }

    #excel_data th:nth-child(8),
    #excel_data td:nth-child(8) {
      color: green;
      font-weight: bold;
    }

    .nav_div {
      text-align: center;
      padding-top: 25px;
    }

    #nav a {
      padding: 10px 20px;
      border: 1px solid #ddd;
      color: #786868;
    }

    #nav a.active {
      color: green;
      background: #0080002e;
      font-weight: bold;
    }

    .nav-pills .nav-link.active,
    .nav-pills .nav-link.active:hover,
    .nav-pills .nav-link.active:focus {
      color: <?php echo $org_color; ?>;
      border-color: transparent;
      background: #fce4e4;
    }

    .remove_button {
      border-color: transparent !important;
      background: #fad6d6 !important;
      color: #ea5455 !important;
      padding: 10px 20px;
      border-radius: 8px;
      margin-top: 22px
    }

    .table_admin select#dt-length-0,
    .table_admin select#dt-length-1 {
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

    table.dataTable.display tbody tr:hover > .sorting_1,
    table.dataTable.order-column.hover tbody tr:hover > .sorting_1,
    table.dataTable.display > tbody > tr:nth-child(odd) > .sorting_1,
    table.dataTable.order-column.stripe > tbody > tr:nth-child(odd) > .sorting_1,
    table.dataTable.stripe > tbody > tr:nth-child(odd) > *,
    table.dataTable.display > tbody > tr:nth-child(odd) > * {
      box-shadow: none !important;
    }

    .dt-layout-row {
      padding-bottom: 20px;
    }

    .table_admin th {
      color: #5d596c !important;
      font-weight: normal !important;
      text-transform: uppercase !important;
      font-size: 0.8125rem !important;
      letter-spacing: 1px !important;
      text-align: center !important;
    }

    .table_admin td {
      text-align: center !important;
    }

    .table_admin .dt-paging-button.current {
      background: rgba(75, 70, 92, 0.08) !important;
      border: 1px solid #aaa !important;
    }

    .table_admin .dt-paging-button.current:active {
      color: #6f6b7d !important;
      background-color: #fff !important;
      border-color: #7367f0 !important;
      outline: 0 !important;
      box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3) !important;
    }

    .dt-empty {
      text-align: center !important;
    }

    .btn_design:not([class*=btn-label-]):not([class*=btn-outline-]),
    .question_paper_cta:not([class*=btn-label-]):not([class*=btn-outline-]),
    .previous_button:not([class*=btn-label-]):not([class*=btn-outline-]) {
      box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
    }
	.previous_button {
		position: absolute;
right:    0;
bottom:   0;
	}
    .btn_design,
    .question_paper_cta,
    .previous_button {
      display: block;
      align-items: center;
      justify-content: center;
      transition: all 0.135s ease-in-out;
      transform: scale(1.001);
      --bs-btn-padding-x: 1.25rem;
      --bs-btn-padding-y: 0.6rem;
      --bs-btn-font-family: ;
      --bs-btn-font-size: 0.9375rem;
      --bs-btn-font-weight: 500;
      --bs-btn-line-height: 1.125;
      --bs-btn-color: var(--bs-body-color);
      --bs-btn-bg: transparent;
      --bs-btn-border-width: var(--bs-border-width);
      --bs-btn-border-color: transparent;
      --bs-btn-border-radius: var(--bs-border-radius);
      --bs-btn-hover-border-color: transparent;
      --bs-btn-box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
      --bs-btn-disabled-opacity: 0.65;
      --bs-btn-focus-box-shadow: 0 0 0 0.05rem rgba(var(--bs-btn-focus-shadow-rgb), .5);
      display: inline-block;
      padding: var(--bs-btn-padding-y) var(--bs-btn-padding-x);
      font-family: var(--bs-btn-font-family);
      font-size: var(--bs-btn-font-size);
      font-weight: var(--bs-btn-font-weight);
      line-height: var(--bs-btn-line-height);
      color: var(--bs-btn-color);
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      user-select: none;
      border: var(--bs-btn-border-width) solid var(--bs-btn-border-color);
      border-radius: var(--bs-btn-border-radius);
      background-color: var(--bs-btn-bg);
      transition: all 0.2s ease-in-out;
      color: #fff;
    }

    .admin_assignments #logo_color.question_bank_creation:hover,
    .admin_assignments #logo_color.question_paper_creation:hover {
      color: <?php echo $org_color; ?> !important;
      background-color: #fdf1f1 !important;
      border-color: <?php echo $org_color; ?> !important;
    }

    .admin_assignments #logo_color {
      background-color: <?php echo $org_color; ?> !important;
      border-color: <?php echo $org_color; ?> !important;
    }

    #paper_lesson_div .dropdown-toggle::after {
      margin-top: 4px !important;
      float: right !important;
    }

    .nav-tabs .nav-link:not(.active):hover,
    .nav-tabs .nav-link:not(.active):focus,
    .nav-pills .nav-link:not(.active):hover,
    .nav-pills .nav-link:not(.active):focus {
      color: <?php echo $org_color; ?> !important;
    }

    #question_lists:hover {
      background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
      color: #ffffff !important;
      padding: 5px 10px;
      border-radius: 5px;
    }

    .word_ellipsis {
      white-space: nowrap;
      width: 100px;
      overflow: hidden;
      text-overflow: ellipsis;
      text-align: center;
      padding: 5px 10px;
      border-radius: 5px;
      margin: auto;
    }
  </style>

</head>

<body class="admin_assignments">
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      @include('teacher_dashboard.sidebar')
      <div class="layout-page">
        <!-- Navbar -->
        @include('teacher_dashboard.navbar')
        <!-- / Navbar -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y" id="admin_assignment">
            <div class="app-ecommerce mb-3">
              
              <!-- Question Paper Creation -->
              <div class="card mb-4" id="questionpaper_creation">
                <h5 id="pagetitle" class="p-3 mb-0">Create a Exam</h5>
				 
				<form id="myform" action="{{ route('post_exam_one') }}" method="POST" >
				
                <div class="card-body">
				@if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
                  <div class="row">
				  @csrf
				  <div class="col-3 mb-3">
                      <label for="selectpickerBasic" class="form-label">Branch</label>
                      <select id="branch_id" name="branch_id" required class="selectpicker w-100" data-style="btn-default">
                        <option value="">Select Branch</option>
                      <?php					  
					  foreach($branches as $branch)
					  {					  
					  ?>
						<option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>  
					  <?php } ?>
                      </select>
                    </div>
                    <div class="col-3 mb-3">
                      <label for="selectpickerBasic" class="form-label">Classroom</label>
                      <select id="paper_class_room" name="class_room_id" required class="form-control" data-style="btn-default">
                        <option value="">Select Classroom</option>
                      
                      </select>
                    </div>
                    <div class="col-3 mb-3" id="paper_subject_div">
                      <label for="selectpickerBasic" class="form-label">Subject</label>
                      <select id="paper_sub_ject" required name="subject_id" class="form-control">
                        <option value="">Select Subject</option>
                      </select>
                    </div>
                    <div class="col-3 mb-3" id="paper_lesson_div">
                      <label for="selectpickerBasic" class="form-label">Lesson</label>
                      <br>
                      <button class="btn btn-success dropdown-toggle w-100" type="button" id="multiSelectDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="text-align: left; float: left; display: block !important; background: transparent !important; border: 1px solid #dbdade !important; color: #777485 !important; box-shadow: none !important; border-radius: 0.375rem !important;">
                        Select
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown" id="paper_sub_lesson" style="padding: 12px;">
                      </ul>
                    </div>
                    <div class="col-12 mb-3" id="paper_type_div">
                      <label for="selectpickerBasic" class="form-label">Filter by Type</label>
                      <div class="optionBox">
                        <div class="block mb-2">
                          <div class="d-flex">
                            <div class="row">
                              <div class="col-3">
                                <select id="" name="individual_lesson_id[]" required class="lessonsDD form-select form-select-sm">
                                  <option value="">Select Lesson</option>                                  
                                </select>
                              </div>
                              <div class="col-3">
                                <select id="smallSelect" name="question_type[]" required class="form-select form-select-sm">
                                  <option value="">Questions Type</option>
                                  <option value="mcq_1">Multiple Choice Single Answer</option>
                                  <option value="mcq_2">Multiple Choice Multiple Answers</option>
                                  <option value="match_following">Match the Following</option>
                                  <option value="fill_blanks">Fill in the blanks</option>
                                  <option value="true_false">True or False</option>
                                  <option value="short_answer">Short Answer</option>
                                  <option value="order_sequence">Order/Sequencing</option>
                                </select>
                              </div>
                              <div class="col-3">
                                <select id="smallSelect" name="difficulty_level[]" required class="form-select form-select-sm">
                                  <option value="">Difficulty Level</option>
                                  <option value="Easy">Easy</option>
                                  <option value="Medium">Medium</option>
                                  <option value="Hard">Hard</option>
                                </select>
                              </div>
                              <div class="col-2">
                                <input type="text" name="question_count[]" required class="form-control form-control-sm" id="defaultFormControlInput" placeholder="No.Of Questions" aria-describedby="defaultFormControlHelp">
                              </div>
                              <div class="col-1">
                                <span class="badge badge-center rounded-pill bg-label-danger remove" style="position: relative;top: 4px;pointer-events: none;cursor: default;"><i class="ti ti-minus"></i></span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block">
                          <span style="cursor: pointer;" class="badge rounded-pill bg-label-success add"><i class="ti ti-plus ti-sm" style="font-size: 11px !important;"></i>&nbsp;Add Option</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-2" id="form_submit_jp" style="display:none">
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="logo_color">Show</button>
                  </div>
                </div>
				</form>
              </div>
			  <?php
				//$exam_id=43;			  
			  $exam_id = \Session::get('exam_id');
			  if(isset($exam_id))
			  { ?>
              <div class="card" id="question_paper">
                <div class="card-body">
				<input type="hidden" id="exam_id" value="{{ $exam_id }}">
				<!--type - 1 - mcq 1-->
				<?php 				
				$question_type=App\Models\ExamQuestionType::where('exam_id',$exam_id)->where('question_type','mcq_1')->first(); 
				if($question_type)
				{
					$lesson_id=$question_type->lesson_id;
					$complexity=$question_type->difficulty_level;
				?>
				<input type="hidden" name="question_types[]" value="mcq_1">
                  <h5 id="pagetitle">Multiple Choice Single Answer</h5>
                  <?php $no_of_questions=$question_type->no_of_questions;
					$questions=App\Models\QuestionTypeOne::where('type',1)->where('lesson_id',$lesson_id)->where('complexity',$complexity)->inRandomOrder('id')->limit($no_of_questions)->get(); 				  
				  if(count($questions)>0)
				  {
				  for($i=0;$i<$no_of_questions;$i++)
				  {
					  if(isset($questions[$i]))
					  {
					  $j=$i+1;
				  ?>
				  <div class="row">
                    <div class="mb-3 col-lg-12 col-xl-1 col-12 align-items-center mb-0" style="text-align: center;">
                      <br>
                      <br>
                      <br>
                      <br>
                      <span class="badge badge-center bg-label-dark"><?php echo $j; ?></span>
                    </div>
                    <div class="mb-3 col-lg-7 col-xl-5 col-12 mb-0">
                      <label class="form-label">Question<span class="text-danger">*</span></label>
					  <input type="hidden" name="question_id_mcq1[]" id="question_id_mcq1_<?php echo $i; ?>" value="{{ $questions[$i]->id }}">
                      <textarea class="form-control" id="question_mcq1_<?php echo $i; ?>" rows="7" readonly>{{ $questions[$i]->question_name }}</textarea>
                    </div>
                    <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                      <label class="form-label">Choices<span class="text-danger">*</span></label>
                      <div class="input-group form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" id="radio1_mcq1_<?php echo $i; ?>" name="mcq1_inlineRadio_<?php echo $j?>" <?php if($questions[$i]->option_a==$questions[$i]->answer) { echo 'checked'; }  ?> value="option1">
                        </div>
                        <input type="text" class="form-control answer_8" readonly id="choice1_mcq1_<?php echo $i; ?>" placeholder="Choice (A)" value="{{ $questions[$i]->option_a }}" aria-label="Text input with checkbox">
                      </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" id="radio2_mcq1_<?php echo $i; ?>" name="mcq1_inlineRadio_<?php echo $j?>" <?php if($questions[$i]->option_b==$questions[$i]->answer) { echo 'checked'; }  ?> value="option2">
                        </div>
                        <input type="text" class="form-control answer_8" readonly id="choice2_mcq1_<?php echo $i; ?>" placeholder="Choice (B)" value="{{ $questions[$i]->option_b }}" aria-label="Text input with checkbox">
                      </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" id="radio3_mcq1_<?php echo $i; ?>" name="mcq1_inlineRadio_<?php echo $j?>" <?php if($questions[$i]->option_c==$questions[$i]->answer) { echo 'checked'; }  ?> value="option3">
                        </div>
                        <input type="text" class="form-control answer_8" readonly id="choice3_mcq1_<?php echo $i; ?>" placeholder="Choice (C)" value="{{ $questions[$i]->option_c }}" aria-label="Text input with checkbox">
                      </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" id="radio4_mcq1_<?php echo $i; ?>" name="mcq1_inlineRadio_<?php echo $j?>" <?php if($questions[$i]->option_d==$questions[$i]->answer) { echo 'checked'; }  ?> value="option4">
                        </div>
                        <input type="text" class="form-control answer_8" readonly id="choice4_mcq1_<?php echo $i; ?>" placeholder="Choice (D)" value="{{ $questions[$i]->option_d }}" aria-label="Text input with checkbox">
                      </div>
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 align-items-center mb-0">
                      <br>
                      <br>
                      <br>
                      <br>
                      <button type="button" data-type="mcq_1" data-no="{{ $i}}"  data-lessonID="{{ $lesson_id }}" data-complexity="{{ $complexity }}" class="btn btn-sm btn-label-linkedin waves-effect refetch" id="refetch_btn">
                        <i class="tf-icons ti ti-rotate-rectangle ti-xs me-1"></i> Refetch
                      </button>
                    </div>
                    <hr />
                  </div>
					  <?php } } } } ?>
				  <!--type - 1 - mcq 1-->
				  <!--type - 2 - mcq 2-->
				  <?php 				
				$question_type2=App\Models\ExamQuestionType::where('exam_id',$exam_id)->where('question_type','mcq_2')->first(); 
				if($question_type2)
				{
					$lesson_id=$question_type2->lesson_id;
					$complexity=$question_type2->difficulty_level;
				?>
				<input type="hidden" name="question_types[]" value="mcq_2">
				<h5 id="pagetitle">Multiple Choice Multiple Answer</h5>
				
				<?php $no_of_questions2=$question_type2->no_of_questions;
					$questions2=App\Models\QuestionTypeTwo::where('lesson_id',$lesson_id)->where('complexity',$complexity)->inRandomOrder('id')->limit($no_of_questions2)->get(); 				
				  if(count($questions2)>0)
				  {
				  for($i=0;$i<$no_of_questions2;$i++)
				  {
					  if(isset($questions2[$i]))
					  {
					  $j=$i+1;
					  $ans_str=$questions2[$i]->answer;
					  $ans_arr=explode(',',$ans_str);
				  ?>
				  
                  <div class="row">
                    <div class="mb-3 col-lg-12 col-xl-1 col-12 align-items-center mb-0" style="text-align: center;">
                      <br>
                      <br>
                      <br>
                      <br> <span class="badge badge-center bg-label-dark">{{ $j }}</span> </div>
                    <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                      <label class="form-label">Question<span class="text-danger">*</span></label>
                      <input type="hidden" name="question_id_mcq2[]" id="question_id_mcq2_<?php echo $i; ?>" value="{{ $questions2[$i]->id }}">
					  <textarea class="form-control" id="question_mcq2_<?php echo $i; ?>" rows="7" >{{ $questions2[$i]->question_name }}</textarea>
                    </div>
                    <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                      <label class="form-label">Choices<span class="text-danger">*</span></label>
                      <div class="input-group mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" id="check1_mcq2_<?php echo $i; ?>" type="checkbox" <?php if(in_array($questions2[$i]->option_a,$ans_arr)) { echo 'checked'; }  ?> aria-label="Checkbox for following text input" /> </div>
                        <input type="text" class="form-control" id="choice1_mcq2_<?php echo $i; ?>" placeholder="Choice (A)" value="{{ $questions2[$i]->option_a }}" aria-label="Text input with checkbox" /> </div>
                      <div class="input-group mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" id="check2_mcq2_<?php echo $i; ?>" type="checkbox" <?php if(in_array($questions2[$i]->option_b,$ans_arr)) { echo 'checked'; }  ?> aria-label="Checkbox for following text input" /> </div>
                        <input type="text" class="form-control" id="choice2_mcq2_<?php echo $i; ?>" placeholder="Choice (B)" value="{{ $questions2[$i]->option_b }}" aria-label="Text input with checkbox" /> </div>
                      <div class="input-group mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" id="check3_mcq2_<?php echo $i; ?>" type="checkbox" <?php if(in_array($questions2[$i]->option_c,$ans_arr)) { echo 'checked'; }  ?> aria-label="Checkbox for following text input" /> </div>
                        <input type="text" class="form-control" id="choice3_mcq2_<?php echo $i; ?>" placeholder="Choice (C)" value="{{ $questions2[$i]->option_c }}" aria-label="Text input with checkbox" /> </div>
                      <div class="input-group mb-3">
                        <div class="input-group-text">
                          <input class="form-check-input mt-0" id="check4_mcq2_<?php echo $i; ?>" type="checkbox" <?php if(in_array($questions2[$i]->option_d,$ans_arr)) { echo 'checked'; }  ?> aria-label="Checkbox for following text input" /> </div>
                        <input type="text" class="form-control" id="choice4_mcq2_<?php echo $i; ?>" placeholder="Choice (D)" value="{{ $questions2[$i]->option_d }}" aria-label="Text input with checkbox" /> </div>
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 align-items-center mb-0">
                      <br>
                      <br>
                      <br>
                      <br>
                      <button type="button" data-type="mcq_2" data-no="{{ $i}}" data-lessonID="{{ $lesson_id }}" data-complexity="{{ $complexity }}" class="btn btn-sm btn-label-linkedin waves-effect refetch" id="refetch_btn">
                        <i class="tf-icons ti ti-rotate-rectangle ti-xs me-1"></i> Refetch
                      </button>
                    </div>
					
                    <hr />
                  </div>

					  <?php } } } } ?>				 
				 <!--type - 2 - mcq 2-->
				 <!--type - 3 - match the following-->
				<?php 				
				$question_type3=App\Models\ExamQuestionType::where('exam_id',$exam_id)->where('question_type','match_following')->first(); 
				if($question_type3)
				{
					$lesson_id=$question_type3->lesson_id;
					$complexity=$question_type3->difficulty_level;
				?>
				<input type="hidden" name="question_types[]" value="match_following">
				<h5 id="pagetitle">Match the Following</h5>
				<?php $no_of_questions3=$question_type3->no_of_questions;
					$questions3=App\Models\QuestionTypeThree::where('lesson_id',$lesson_id)->where('complexity',$complexity)->inRandomOrder('id')->limit($no_of_questions3)->get(); 				
				  if(count($questions3)>0)
				  {
				  for($i=0;$i<$no_of_questions3;$i++)
				  {
					 if(isset($questions3[$i]))
					  {
					  $j=$i+1;
				  ?>
				  <div class="row">
				  <input type="hidden" name="question_id_match[]" id="question_id_match_<?php echo $i; ?>" value="{{ $questions3[$i]->id }}">
                    <div class="mb-3 col-lg-12 col-xl-1 col-12 align-items-center mb-0" style="text-align: center;">
                      <br>
                      <br>
                      <br>
                      <br> <span class="badge badge-center bg-label-dark">{{ $j }}</span> </div>
                    <div class="mb-3 col-lg-3 col-xl-3 col-12 mb-0">
                      <label class="form-label">Heading 1<span class="text-danger">*</span></label>
                      <div class="input-group mb-1"> <span class="input-group-text">A</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_a_match_<?php echo $i; ?>" readonly placeholder="Child Labour (Prohibition and Regulation) Act Year of Legislation" row="10">{{ $questions3[$i]->option_a }}</textarea>
                      </div>
                      <div class="input-group mb-1"> <span class="input-group-text">B</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_b_match_<?php echo $i; ?>" readonly  placeholder="The Factories Act" row="10">{{ $questions3[$i]->option_b }}</textarea>
                      </div>
                      <div class="input-group mb-1"> <span class="input-group-text">C</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_c_match_<?php echo $i; ?>" readonly placeholder="The Mines Act" row="10">{{ $questions3[$i]->option_c }}</textarea>
                      </div>
                      <div class="input-group mb-1"> <span class="input-group-text">D</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_d_match_<?php echo $i; ?>" readonly placeholder="The Right of Children to Free and Compulsory Education Act" row="10">{{ $questions3[$i]->option_d }}</textarea>
                      </div>
                    </div>
                    <div class="mb-3 col-lg-3 col-xl-3 col-12 mb-0">
                      <label class="form-label">Heading 2<span class="text-danger">*</span></label>
                      <div class="input-group mb-1"> <span class="input-group-text">1</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_1_match_<?php echo $i; ?>" readonly placeholder="1986" row="10">{{ $questions3[$i]->option_1 }}</textarea>
                      </div>
                      <div class="input-group mb-1"> <span class="input-group-text">2</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_2_match_<?php echo $i; ?>" readonly placeholder="1952" row="10">{{ $questions3[$i]->option_2 }}</textarea>
                      </div>
                      <div class="input-group mb-1"> <span class="input-group-text">3</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_3_match_<?php echo $i; ?>" readonly placeholder="2009" row="10">{{ $questions3[$i]->option_3 }}</textarea>
                      </div>
                      <div class="input-group mb-1"> <span class="input-group-text">4</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_4_match_<?php echo $i; ?>" readonly placeholder="1948" row="10">{{ $questions3[$i]->option_4 }}</textarea>
                      </div>
                    </div>
                    <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                      <label class="form-label">Choices<span class="text-danger">*</span></label>
                      <div class="input-group form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" <?php if($questions3[$i]->choice_1==$questions3[$i]->answer) { echo 'checked'; }  ?> name="inlineRadio_<?php echo $j?>" id="inlineRadio_1_match_<?php echo $i; ?>" value="option1"> </div>
                        <input type="text" class="form-control" readonly id="choice1_match_<?php echo $i; ?>" placeholder="A-1, B-4, C-2, D-3" value="{{ $questions3[$i]->choice_1 }}" aria-label="Text input with checkbox"> </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" <?php if($questions3[$i]->choice_2==$questions3[$i]->answer) { echo 'checked'; }  ?> name="inlineRadio_<?php echo $j?>" id="inlineRadio_2_match_<?php echo $i; ?>" value="option2"> </div>
                        <input type="text" class="form-control" readonly id="choice2_match_<?php echo $i; ?>" placeholder="A-2, B-4, C-3, D-1" value="{{ $questions3[$i]->choice_2 }}" aria-label="Text input with checkbox"> </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" <?php if($questions3[$i]->choice_3==$questions3[$i]->answer) { echo 'checked'; }  ?> name="inlineRadio_<?php echo $j?>" id="inlineRadio_3_match_<?php echo $i; ?>" value="option3"> </div>
                        <input type="text" class="form-control" readonly id="choice3_match_<?php echo $i; ?>" placeholder="A-3, B-2, C-1, D-4" value="{{ $questions3[$i]->choice_3 }}" aria-label="Text input with checkbox"> </div>
                      <div class="input-group  form-check-inline mb-4">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" <?php if($questions3[$i]->choice_4==$questions3[$i]->answer) { echo 'checked'; }  ?> name="inlineRadio_<?php echo $j?>" id="inlineRadio_4_match_<?php echo $i; ?>" value="option4"> </div>
                        <input type="text" class="form-control" readonly id="choice4_match_<?php echo $i; ?>" placeholder="A-4, B-3, C-1, D-2" value="{{ $questions3[$i]->choice_4 }}" aria-label="Text input with checkbox"> </div>
                      
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 align-items-center mb-0">
                      <br>
                      <br>
                      <br>
                      <br>
                       <button type="button" data-type="match_following" data-lessonID="{{ $lesson_id }}" data-complexity="{{ $complexity }}" data-no="{{ $i}}" class="btn btn-sm btn-label-linkedin waves-effect refetch" id="refetch_btn">
                        <i class="tf-icons ti ti-rotate-rectangle ti-xs me-1"></i> Refetch
                      </button>
                    </div>
                    <hr />
                  </div>

				  <?php } } } } ?>
				 <!--type - 3 - match the following-->
				 <!--type - 4 - Fill in blanks-->
				 <?php 				
				$question_type4=App\Models\ExamQuestionType::where('exam_id',$exam_id)->where('question_type','fill_blanks')->first(); 
				if($question_type4)
				{
					$lesson_id=$question_type4->lesson_id;
					$complexity=$question_type4->difficulty_level;
				?>
				<input type="hidden" name="question_types[]" value="fill_blanks">
				<h5 id="pagetitle">Fill in the blanks</h5>
				<?php $no_of_questions4=$question_type4->no_of_questions; 
				  $questions4=App\Models\QuestionTypeFour::where('lesson_id',$lesson_id)->where('complexity',$complexity)->inRandomOrder('id')->limit($no_of_questions4)->get(); 
				  if(count($questions4)>0)
				  {
				  for($i=0;$i<$no_of_questions4;$i++)
				  {
					  if(isset($questions4[$i]))
					  {
					  $j=$i+1;
				  ?>
				   <div class="row">
                    <div class="mb-3 col-lg-12 col-xl-1 col-12 align-items-center mb-0" style="text-align: center;">
                      <br>
                      <br>
                      <br>
                      <br> <span class="badge badge-center bg-label-dark">{{ $j }}</span> </div>
                    <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                      <label class="form-label">Question<span class="text-danger">*</span></label>
                      <input type="hidden" name="question_id_fill[]" id="question_id_fill_<?php echo $i; ?>" value="{{ $questions4[$i]->id }}">
					  <textarea class="form-control" id="question_fill_blanks_<?php echo $i; ?>" readonly rows="7">{{ $questions4[$i]->question_name }}</textarea>
                    </div>
                    <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                      <label class="form-label">Choices<span class="text-danger">*</span></label>
                      <div class="input-group form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadio_fill_blanks_<?php echo $j; ?>" <?php if($questions4[$i]->option_a==$questions4[$i]->answer) { echo 'checked'; }  ?> id="inlineRadio_1_fill_blanks_<?php echo $i; ?>" value="option1"> </div>
                        <input type="text" class="form-control" readonly value="<?php echo $questions4[$i]->option_a; ?>" id="option_a_fill_<?php echo $i; ?>" placeholder="Choice (A)" aria-label="Text input with checkbox"> </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadio_fill_blanks_<?php echo $j; ?>" <?php if($questions4[$i]->option_b==$questions4[$i]->answer) { echo 'checked'; }  ?> id="inlineRadio_2_fill_blanks_<?php echo $i; ?>" value="option2"> </div>
                        <input type="text" class="form-control" readonly value="<?php echo $questions4[$i]->option_b; ?>" id="option_b_fill_<?php echo $i; ?>" placeholder="Choice (B)" aria-label="Text input with checkbox"> </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadio_fill_blanks_<?php echo $j; ?>" <?php if($questions4[$i]->option_c==$questions4[$i]->answer) { echo 'checked'; }  ?> id="inlineRadio_3_fill_blanks_<?php echo $i; ?>" value="option3"> </div>
                        <input type="text" class="form-control" readonly value="<?php echo $questions4[$i]->option_c; ?>" id="option_c_fill_<?php echo $i; ?>" placeholder="Choice (C)" aria-label="Text input with checkbox"> </div>
                      <div class="input-group  form-check-inline mb-3">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadio_fill_blanks_<?php echo $j; ?>" <?php if($questions4[$i]->option_d==$questions4[$i]->answer) { echo 'checked'; }  ?> id="inlineRadio_4_fill_blanks_<?php echo $i; ?>" value="option4"> </div>
                        <input type="text" class="form-control" readonly value="<?php echo $questions4[$i]->option_d; ?>" id="option_d_fill_<?php echo $i; ?>" placeholder="Choice (D)" aria-label="Text input with checkbox"> </div>
                      
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 align-items-center mb-0">
                      <br>
                      <br>
                      <br>
                      <br>
                      <button type="button" data-type="fill_blanks" data-no="{{ $i}}" data-lessonID="{{ $lesson_id }}"  data-complexity="{{ $complexity }}" class="btn btn-sm btn-label-linkedin waves-effect refetch" id="refetch_btn">
                        <i class="tf-icons ti ti-rotate-rectangle ti-xs me-1"></i> Refetch
                      </button>
                    </div>
                    <hr />
                  </div>
				  <?php } } } } ?>
				 <!--type - 4 - Fill in blanks-->
				 <!--type - 5 - true false-->
				<?php 				
				$question_type5=App\Models\ExamQuestionType::where('exam_id',$exam_id)->where('question_type','true_false')->first(); 
				if($question_type5)
				{
					$lesson_id=$question_type5->lesson_id;
					$complexity=$question_type5->difficulty_level;
				?>
				<input type="hidden" name="question_types[]" value="true_false">
				<h5 id="pagetitle">True or False</h5>
				<?php $no_of_questions5=$question_type5->no_of_questions; 
				 $questions5=App\Models\QuestionTypeFive::where('lesson_id',$lesson_id)->where('complexity',$complexity)->inRandomOrder('id')->limit($no_of_questions5)->get(); 
				 if(count($questions5)>0){
				 for($i=0;$i<$no_of_questions5;$i++)
				  {
					  if(isset($questions5[$i]))
					  {
					  $j=$i+1;
				  ?>
				  <div class="row">
                    <div class="mb-3 col-lg-12 col-xl-1 col-12 align-items-center mb-0" style="text-align: center;">
                      <br>
                      <br>
                      <br>
                      <br> <span class="badge badge-center bg-label-dark">{{ $j }}</span> </div>
                    <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                      <label class="form-label">Question<span class="text-danger">*</span></label>
					  <input type="hidden" name="question_id_true_false[]" id="question_id_true_false_<?php echo $i; ?>" value="{{ $questions5[$i]->id }}">
                      <textarea class="form-control" id="question_true_false_<?php echo $i; ?>" readonly rows="7">{{ $questions5[$i]->question_name }}</textarea>
                    </div>
                    <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                      <label class="form-label">Choices<span class="text-danger">*</span></label>
                      <div class="input-group form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" <?php if($questions5[$i]->option_a==$questions5[$i]->answer) { echo 'checked'; }  ?> name="radio_true_false_<?php echo $j; ?>" id="inline_trueRadio1_<?php echo $i; ?>" value="option1"> </div>
                        <input type="text" class="form-control" id="choice1_tf_<?php echo $i; ?>" placeholder="True" readonly value="{{ $questions5[$i]->option_a }}" aria-label="Text input with checkbox"> </div>
                      <div class="input-group  form-check-inline mb-3">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" <?php if($questions5[$i]->option_b==$questions5[$i]->answer) { echo 'checked'; }  ?> name="radio_true_false_<?php echo $j; ?>" id="inline_trueRadio2_<?php echo $i; ?>" value="option2"> </div>
                        <input type="text" class="form-control" id="choice2_tf_<?php echo $i; ?>" placeholder="False" readonly value="{{ $questions5[$i]->option_b }}" aria-label="Text input with checkbox"> </div>
                      
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 align-items-center mb-0">
                      <br>
                      <br>
                      <br>
                      <br>
                      <button type="button" data-type="true_false" data-no="{{ $i}}"  data-lessonID="{{ $lesson_id }}" data-complexity="{{ $complexity }}" class="btn btn-sm btn-label-linkedin waves-effect refetch" id="refetch_btn">
                        <i class="tf-icons ti ti-rotate-rectangle ti-xs me-1"></i> Refetch
                      </button>
                    </div>
                    <hr />
                  </div>

				<?php }}}} ?>
				 <!--type - 5 - true false-->
				 <!--type - 6 - Short answers-->
				  <?php 				
				$question_type6=App\Models\ExamQuestionType::where('exam_id',$exam_id)->where('question_type','short_answer')->first(); 
				if($question_type6)
				{
					$lesson_id=$question_type6->lesson_id;
					$complexity=$question_type6->difficulty_level;
				?>
				<input type="hidden" name="question_types[]" value="short_answer">
				  <h5 id="pagetitle">Short Answer</h5>
				  <?php $no_of_questions6=$question_type6->no_of_questions;
					$questions6=App\Models\QuestionTypeSix::where('lesson_id',$lesson_id)->where('complexity',$complexity)->inRandomOrder('id')->limit($no_of_questions6)->get(); 				  
				  if(count($questions6)>0)
				  {
				  for($i=0;$i<$no_of_questions6;$i++)
				  {
					  if(isset($questions6[$i]))
					  {
					  $j=$i+1;
				  ?>
                  <div class="row">
                    <div class="mb-3 col-lg-12 col-xl-1 col-12 align-items-center mb-0" style="text-align: center;">
                      <br>
                      <br>
                      <br>
                      <br>
                      <span class="badge badge-center bg-label-dark">{{ $j }}</span>
                    </div>
                    <div class="mb-3 col-lg-7 col-xl-5 col-12 mb-0">
                      <input type="hidden" name="question_id_short_answers[]" id="question_id_shortanswer_<?php echo $i; ?>" value="{{ $questions6[$i]->id }}">
					  <label class="form-label">Question<span class="text-danger">*</span></label>
                      <textarea class="form-control" id="question_shortanswer_<?php echo $i; ?>" rows="7" readonly>{{ $questions6[$i]->question_name }} </textarea>
                    </div>
                    <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                      <label class="form-label">Answer<span class="text-danger">*</span></label>
                      <textarea class="form-control" id="answer_shortanswer_<?php echo $i; ?>" rows="7" readonly>{{ $questions6[$i]->answer }}</textarea>
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 align-items-center mb-0">
                      <br>
                      <br>
                      <br>
                      <br>
                      <button type="button" data-type="short_answer" data-lessonID="{{ $lesson_id }}" data-complexity="{{ $complexity }}" data-no="{{ $i}}" class="btn btn-sm btn-label-linkedin waves-effect refetch">
                        <i class="tf-icons ti ti-rotate-rectangle ti-xs me-1"></i> Refetch
                      </button>
                    </div>
                    <hr />
                  </div>
				  <?php } }} } ?>
				  <!--type - 6 - Short answers-->
				  <!--type - 7 - Order Sequencing-->
				   <?php 				
				$question_type7=App\Models\ExamQuestionType::where('exam_id',$exam_id)->where('question_type','order_sequence')->first(); 
				if($question_type7)
				{
					$lesson_id=$question_type7->lesson_id;
					$complexity=$question_type7->difficulty_level;
					
				?>
				<input type="hidden" name="question_types[]" value="order_sequence">
				<h5 id="pagetitle">Ordering/Sequences</h5>
				<?php $no_of_questions7=$question_type7->no_of_questions;
					$questions7=App\Models\QuestionTypeSeven::where('lesson_id',$lesson_id)->where('complexity',$complexity)->inRandomOrder('id')->limit($no_of_questions7)->get(); 				  
				  if(count($questions7)>0)
				  {
				  for($i=0;$i<$no_of_questions7;$i++)
				  {
					  if(isset($questions7[$i]))
					  {
					  $j=$i+1;
				  ?>
				  <div class="row">
                    <div class="mb-3 col-lg-12 col-xl-1 col-12 align-items-center mb-0" style="text-align: center;">
                      <br>
                      <br>
                      <br>
                      <br> <span class="badge badge-center bg-label-dark">{{ $j }}</span> </div>
                    <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                      <label class="form-label">Question<span class="text-danger">*</span></label>
					  <input type="hidden" name="question_id_order_seq[]" id="question_id_order_seq_<?php echo $i; ?>" value="{{ $questions7[$i]->id }}">
                      <textarea class="form-control mb-2" id="question_order_sequence_<?php echo $i; ?>" rows="3" placeholder="Arrange the following steps in the correct order in which they appear in the process of adaptation." readonly>{{ $questions7[$i]->question_name }}</textarea>
                      <div class="input-group mb-1"> <span class="input-group-text">A</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_a_order_seq_<?php echo $i; ?>" placeholder="You gradually feel better and decrease sweating." readonly>{{ $questions7[$i]->option_a }}</textarea>
                      </div>
                      <div class="input-group mb-1"> <span class="input-group-text">B</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_b_order_seq_<?php echo $i; ?>" placeholder="Sudden increase in the temperature of the environment." readonly>{{ $questions7[$i]->option_b }}</textarea>
                      </div>
                      <div class="input-group mb-1"> <span class="input-group-text">C</span>
                        <textarea class="form-control" aria-label="With textarea" id="option_c_order_seq_<?php echo $i; ?>" placeholder="Eventually you stop sweating and then feel completely normal." readonly>{{ $questions7[$i]->option_c }}</textarea>
                      </div>
                      <div class="input-group mb-1"> <span class="input-group-text">D</span>
                        <textarea class="form-control" aria-label="With textarea"id="option_d_order_seq_<?php echo $i; ?>"  placeholder="You feel very hot and start sweating." readonly>{{ $questions7[$i]->option_d }}</textarea>
                      </div>
                    </div>
                    <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                      <label class="form-label">Choices<span class="text-danger">*</span></label>
                      <div class="input-group form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadio_orderOptions_<?php echo $j; ?>" <?php if($questions7[$i]->option_1==$questions7[$i]->answer) { echo 'checked'; }  ?> id="inline_orderRadio1_<?php echo $i; ?>" value="option1"> </div>
                        <input type="text" class="form-control" placeholder="A,B,C,D" aria-label="Text input with checkbox" id="option_1_order_seq_<?php echo $i; ?>" readonly value="{{ $questions7[$i]->option_1 }}"> </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadio_orderOptions_<?php echo $j; ?>" <?php if($questions7[$i]->option_2==$questions7[$i]->answer) { echo 'checked'; }  ?> id="inline_orderRadio2_<?php echo $i; ?>" value="option2"> </div>
                        <input type="text" class="form-control" placeholder="B,C,D,A" aria-label="Text input with checkbox" id="option_2_order_seq_<?php echo $i; ?>" readonly value="{{ $questions7[$i]->option_2 }}"> </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadio_orderOptions_<?php echo $j; ?>" <?php if($questions7[$i]->option_3==$questions7[$i]->answer) { echo 'checked'; }  ?> id="inline_orderRadio3_<?php echo $i; ?>" value="option2"> </div>
                        <input type="text" class="form-control" placeholder="B,D,A,C" aria-label="Text input with checkbox" id="option_3_order_seq_<?php echo $i; ?>" readonly value="{{ $questions7[$i]->option_3 }}"> </div>
                      <div class="input-group  form-check-inline mb-4">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadio_orderOptions_<?php echo $j; ?>" <?php if($questions7[$i]->option_4==$questions7[$i]->answer) { echo 'checked'; }  ?> id="inline_orderRadio4_<?php echo $i; ?>" value="option2"> </div>
                        <input type="text" class="form-control" placeholder="B,D,C,A" aria-label="Text input with checkbox" id="option_4_order_seq_<?php echo $i; ?>" readonly value="{{ $questions7[$i]->option_4 }}"> </div>
                      
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 align-items-center mb-0">
                      <br>
                      <br>
                      <br>
                      <br>
                      <button type="button" data-type="order_sequence" data-lessonID="{{ $lesson_id }}" data-complexity="{{ $complexity }}" data-no="{{ $i}}" class="btn btn-sm btn-label-linkedin waves-effect refetch" id="refetch_btn">
                        <i class="tf-icons ti ti-rotate-rectangle ti-xs me-1"></i> Refetch
                      </button>
                    </div>
                    <hr />
                  </div>
                
				  <?php } }} } ?>
				  <!--type - 7 - Order Sequencing-->
                </div>
              </div>
			  
			  <div class="pt-4" style="float: right;">
              <button type="button" class="btn-label-secondary waves-effect previous_button me-3" id="previous_button" style="border-color: transparent !important; background: rgb(234, 235, 236) !important; color: rgb(168, 170, 174) !important; display: none;">Previous</button>
              <button type="submit" class="btn-primary me-sm-3 me-1 waves-effect waves-light question_paper_cta" id="logo_color" style="float: right;">Next<i class="tf-icons ti ti-chevron-right ti-xs"></i></button>
            </div>
			<br>
			  <?php } ?>
              <div class="card" id="exam_creation">
                <form class="card-body" method="POST" action="{{ route('exam_details_update') }}">
				@csrf
				<input type="hidden" name="exam_id" value="{{ $exam_id }}">
                  <div class="row mb-3 g-3">
                    <div class="col-md-6">
                      <label class="form-label" for="multicol-first-name">Exam Name</label>
                      <input type="text" class="form-control" name="exam_name" required placeholder="Weekly Exam" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="multicol-last-name">Total Marks</label>
                      <input type="number" class="form-control" name="total_marks" required placeholder="100" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="multicol-last-name">Passing Mark</label>
                      <input type="number" class="form-control" name="passing_mark" required placeholder="50" />
                    </div>
                    <div class="col-md-6">
                      <label for="bs-datepicker-format" class="form-label">Duration</label>
                      <input type="text" id="timepicker-format" name="duration" required placeholder="HH:MM:SS" class="form-control" />
                    </div>
					
					<div class="mb-3 col-md-6">
					<label class="form-label">Exam Type</label>
                      <select class="form-control" required id="exam_type" name="exam_type">
					  <option value="">Select Exam Type</option>
					  <option value="1">Flexible</option>
					  <option value="2">Strict</option>
					  </select>
					  
                    </div>
                    <div class="mb-3 col-md-6 jp_exam_end_date">
                      <label class="form-label">Exam End Date</label>
                      <input type="text" value="30-05-2024" name="exam_end_date" id="flatpickr-date1"  class="form-control" />
                    </div>
                    

                    <div class="col-md-4">
                      <label for="bs-rangepicker-single" class="form-label">Publish On</label>
                      <input type="text" class="form-control publish_on" name="publish_on" placeholder="DD-MM-YYYY HH:MM" id="flatpickr-datetime" />
                    </div>
                    <div class="col-md-1 jp_publish" style="top: 14px;position: relative;">
                      <div class="divider divider-vertical divider-danger">
                        <div class="divider-text">OR</div>
                      </div>
                    </div>
                    <div class="col-md-3 jp_publish" style="top: 33px;position: relative;">
                      <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="publish_now" id="chkPassport1">
                        <label class="form-check-label" for="chkPassport1">Publish Now</label>
                      </div>
                    </div>
                  </div>
                  <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1" id="logo_color">Submit</button>
                    <button type="reset" class="btn btn-label-danger">Cancel</button>
                  </div>
                </form>
              </div>
            </div>
            

          </div>
        </div>
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
  <script src="{{asset('assets/bootstrap-select/bootstrap-select.js')}}"></script>
  <link rel="stylesheet" href="{{asset('assets/bootstrap-select/bootstrap-select.css')}}" />

  <script src="{{asset('assets/js/forms-pickers.js')}}"></script>
  <script src="{{asset('assets/jquery-timepicker/jquery-timepicker.js')}}"></script>
  <script src="{{asset('assets/flatpickr/flatpickr.js')}}"></script>
  <script src="{{asset('assets/bootstrap-select/bootstrap-select.js')}}"></script>

  <script type="text/javascript">
    $("#chkPassport1").change(function() {
      if (this.checked) {
        $('.publish_on').val('');
      } else {}
    });

    $(".publish_on").on("click", function() {
      if ($('#chkPassport1').is(':checked')) {
        $('#chkPassport1').prop('checked', false);
      }

    });
  </script>

  <script>
    $(document).ready(function() {

      // Refresh Button

      /*$('#refetch_btn').click(function() {
        $('.answer_8').val('');
        $('#question_8').val('');
      });*/


      // Exam Creation

      $('#exam_creation').hide();
      $('.previous_button').hide();

      $('.question_paper_cta').click(function() {
        $('#question_paper').hide();
        $('#questionpaper_creation').hide();
        $('#exam_creation').show();
        $('.previous_button').show();
        $('.question_paper_cta').hide();

      });
$('.previous_button').click(function(){
	$('#question_paper').show();
        $('#questionpaper_creation').show();
        $('#exam_creation').hide();
        $('.previous_button').hide();
        $('.question_paper_cta').show();
});

    });
  </script>

  <script type="text/javascript">
    const chBoxes =
      document.querySelectorAll('.dropdown-menu input[type="checkbox"]');
    const dpBtn =
      document.getElementById('multiSelectDropdown');
    let mySelectedListItems = [];

    function handleCB() {
      mySelectedListItems = [];
      let mySelectedListItemsText = '';

      chBoxes.forEach((checkbox) => {
        if (checkbox.checked) {
          mySelectedListItems.push(checkbox.value);
          mySelectedListItemsText += checkbox.value + ', ';
        }
      });

      dpBtn.innerText =
        mySelectedListItems.length > 0 ? mySelectedListItemsText.slice(0, -2) : 'Select';
    }

    chBoxes.forEach((checkbox) => {
      checkbox.addEventListener('change', handleCB);
    });
  </script>


  <!-- Question Paper Creation -->
  <script>
    $(function() {
      $('#paper_subject_div').hide();
      $('#paper_lesson_div').hide();
      $('#paper_type_div').hide();
      $('#form_submit').hide();

      $('#paper_class_room').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue = $(this).attr("value");
          if (optionValue) {
            $('#paper_subject_div').show();
			//ajax subjects			  
			  var class_room_id=optionValue;	
			$('#classRoomID').val(class_room_id);			  
			  $.ajax({
				  url:'{{ route("get_subjects_by_class_room_id") }}',
				  type:'get',
				  data:{'class_room_id':class_room_id},
				  success:function(response)
				  {
					 var subjects=response['subjects']
					 var select_content='<option value="">Select Subject</option>';
					  for(i=0;i<subjects.length;i++)
					  {
						 var subject_id=subjects[i].subject_id;
						 var subject_name=subjects[i].subject_name;
						 select_content=select_content+'<option value="'+subject_id+'">'+subject_name+'</option>';
					  }
					  
					  $('#paper_sub_ject').html(select_content);						  
				  }
			  });
			   //ajax subjects
          } else {
            $('#paper_subject_div').hide();
          }

        });
      });

      $('#paper_sub_ject').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue1 = $(this).attr("value");
          if (optionValue1) {
            $('#paper_lesson_div').show();
			$('#form_submit_jp').show();
			//$('#paper_type_div').show();
            //$('#form_submit').show();
			//ajax lessons			  
			   var subject_id=optionValue1;						  
			  $.ajax({
				  url:'{{ route("get_lessons_by_subjects_id") }}',
				  type:'get',
				  data:{'subject_id':subject_id},
				  success:function(response)
				  {
					 var lessons=response['lessons'];					 
					 //var select_content='<option value="">Select Lesson</option>';
					 var select_checkbox='';
					  for(i=0;i<lessons.length;i++)
					  {
						 var id=lessons[i].id;
						 var lesson_name=lessons[i].lesson_name;
						//select_content=select_content+'<option value="'+id+'">'+lesson_name+'</option>';
					  //ul
					  select_checkbox=select_checkbox+'<li class="mb-1"><label><input type="checkbox" name="lesson_id[]" class="chkPassport" data-tex="'+lesson_name+'" value="'+id+'"> '+lesson_name+'</label></li>'
					  //ul
					  }
					  //console.log(select_checkbox);
					  $('#paper_sub_lesson').html(select_checkbox);	
					  //$('.lessonsDD').html(select_content);						  
				  }
			  });
			   //ajax lessons
          } else {
            $('#paper_lesson_div').hide();
          }
        });
      });
$('#myform').on('change', '.chkPassport', function () {
$('#multiSelectDropdown').html($('.chkPassport:checked').length+' Lessons');	
        if ($('.chkPassport:checked').length == 0) {
          $('#paper_type_div').hide();
          $('#form_submit').hide();
        } else {
			var select_content='<option value="">Select Lesson</option>';
          $('.chkPassport:checked').each(function() {			  
			 select_content=select_content+'<option value="'+$(this).val()+'">'+$(this).parent().text()+'</option>';
          });
		  $('.lessonsDD').html(select_content);
		  $('#paper_type_div').show();
            $('#form_submit').show();
        }

      });

      $("#publishnow_questionn").change(function() {
        if (this.checked) {
          $('.publishon_question').val('');
        } else {}
      });

      $(".publishon_question").on("click", function() {
        if ($('#publishnow_questionn').is(':checked')) {
          $('#publishnow_questionn').prop('checked', false);
        }

      });


    });
  </script>

  <script type="text/javascript">
    $('.add').click(function() {
		var select_content='';
		 $('.chkPassport:checked').each(function() {			 
			 select_content=select_content+'<option value="'+$(this).val()+'">'+$(this).parent().text()+'</option>';
          });
      $('.block:last').before('<div class="block mb-2"><div class="d-flex"><div class="row"><div class="col-3"><select id="smallSelect" name="individual_lesson_id[]" required class="lessonsDD  form-select form-select-sm"><option value="">Select Lesson</option>'+select_content+'</select></div><div class="col-3"><select name="question_type[]" required id="smallSelect" class="form-select form-select-sm"><option value="">Select Questions</option><option value="mcq_1">Multiple Choice Single Answer</option><option value="mcq_2">Multiple Choice Multiple Answers</option><option value="match_following">Match the Following</option><option value="fill_blanks">Fill in the blanks</option><option value="true_false">True or False</option><option value="short_answer">Short Answer</option><option value="order_sequence">Order/Sequencing</option></select></div><div class="col-3"><select name="difficulty_level[]" required id="smallSelect" class="form-select form-select-sm"><option value="">Difficulty Level</option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select></div><div class="col-2"><input name="question_count[]" required class="form-control form-control-sm" id="defaultFormControlInput" placeholder="No.Of Questions" aria-describedby="defaultFormControlHelp"></div><div class="col-1"><span style="cursor: pointer;" class="badge badge-center rounded-pill bg-label-danger remove" style="position:relative;top:4px"><i class="ti ti-minus"></i></span></div></div></div></div>');
    });
    $('.optionBox').on('click', '.remove', function() {
      $(this).parent().parent().remove();
    });
  </script>

  <script>
    $(document).ready(function() {
     // $('#question_paper').hide();
      //$('.question_paper_cta').hide();

      $("#form_submit").click(function() {
        //$('#question_paper').show();
        //$('.question_paper_cta').show();
      });

    });
    $(document).ready(function() {
      $('#questionbank_creation').hide();
      $('.main_div').hide();
      $('#back2lists').hide();
      //$('#questionpaper_creation').hide();


      $(".question_bank_creation").click(function() {
        $('#questionbank_creation').show();
        $('.question_bank_creation').hide();
        $('#back2lists').show();

        $('.lists_assessments').hide();
        $('#assessment_lists').hide();
        $('#questionpaper_creation').hide();
        //$('#question_paper').hide();
        $('.question_paper_creation').hide();

      });

      $(".question_paper_creation").click(function() {
        //$('#questionpaper_creation').show();
        $('.question_paper_creation').hide();
        $('#back2lists').show();

        $('.lists_assessments').hide();
        $('#assessment_lists').hide();
        $('#questionbank_creation').hide();
        $('#main_div').hide();
        $('.question_bank_creation').hide();
      });

    });
  </script>
  <!-- Question Paper Creation -->


  <!-- Question Bank Creation -->
  <script>
    $(function() {
      $('#lesson_div').hide();
      $('#type_div').hide();
      $('#upload_btn').hide();
      $('#main_div').hide();
      $('#btn_submit').hide();
      $('#single_answer').hide();
      $('#multiple_answer').hide();
      $('#fill_blanks').hide();
      $('#true_false').hide();
      $('#short_answer').hide();
      $('#match_following').hide();

      $('#sub_ject').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue1 = $(this).attr("value");
          if (optionValue1) {
            $('#lesson_div').show();
          } else {
            $('#lesson_div').hide();
          }
        });
      });

      $('#sub_lesson').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue2 = $(this).attr("value");
          if (optionValue2) {
            $('#type_div').show();
          } else {
            $('#type_div').hide();
          }
        });
      });

      $('#filter_type').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue3 = $(this).attr("value");
          // alert(optionValue3);
          if (optionValue3 == 'mcq_1') {
            $('#upload_btn').show();
            $('#excel_div').show();
            $('#main_div').show();
            $('#btn_submit').show();
            $('#single_answer').show();
            $('#multiple_answer').hide();
            $('#fill_blanks').hide();
            $('#true_false').hide();
            $('#short_answer').hide();
            $('#match_following').hide();
            $('#order_sequence').hide();

          } else if (optionValue3 == 'mcq_2') {
            $('#upload_btn').show();
            $('#excel_div').show();
            $('#main_div').show();
            $('#btn_submit').show();
            $('#multiple_answer').show();
            $('#single_answer').hide();
            $('#fill_blanks').hide();
            $('#true_false').hide();
            $('#short_answer').hide();
            $('#match_following').hide();
            $('#order_sequence').hide();
          } else if (optionValue3 == 'fill_blanks') {
            $('#upload_btn').show();
            $('#excel_div').show();
            $('#main_div').show();
            $('#btn_submit').show();
            $('#multiple_answer').hide();
            $('#single_answer').hide();
            $('#fill_blanks').show();
            $('#true_false').hide();
            $('#short_answer').hide();
            $('#match_following').hide();
            $('#order_sequence').hide();
          } else if (optionValue3 == 'true_false') {
            $('#upload_btn').show();
            $('#excel_div').show();
            $('#main_div').show();
            $('#btn_submit').show();
            $('#multiple_answer').hide();
            $('#single_answer').hide();
            $('#fill_blanks').hide();
            $('#true_false').show();
            $('#short_answer').hide();
            $('#match_following').hide();
            $('#order_sequence').hide();
          } else if (optionValue3 == 'short_answer') {
            $('#upload_btn').show();
            $('#excel_div').show();
            $('#main_div').show();
            $('#btn_submit').show();
            $('#multiple_answer').hide();
            $('#single_answer').hide();
            $('#fill_blanks').hide();
            $('#true_false').hide();
            $('#short_answer').show();
            $('#match_following').hide();
            $('#order_sequence').hide();
          } else if (optionValue3 == 'match_following') {
            $('#upload_btn').show();
            $('#excel_div').show();
            $('#main_div').show();
            $('#btn_submit').show();
            $('#multiple_answer').hide();
            $('#single_answer').hide();
            $('#fill_blanks').hide();
            $('#true_false').hide();
            $('#short_answer').hide();
            $('#match_following').show();
            $('#order_sequence').hide();
          } else if (optionValue3 == 'order_sequence') {
            $('#upload_btn').show();
            $('#excel_div').show();
            $('#main_div').show();
            $('#btn_submit').show();
            $('#multiple_answer').hide();
            $('#single_answer').hide();
            $('#fill_blanks').hide();
            $('#true_false').hide();
            $('#short_answer').hide();
            $('#match_following').hide();
            $('#order_sequence').show();
          } else {
            $('#upload_btn').hide();
            $('#excel_div').hide();
            $('#main_div').hide();
            $('#btn_submit').hide();
            $('#single_answer').hide();
            $('#multiple_answer').hide();
            $('#fill_blanks').hide();
            $('#true_false').hide();
            $('#short_answer').hide();
            $('#match_following').hide();
            $('#order_sequence').hide();
          }
        });
      });

      $('#questionbank_lesson_div').hide();
      $('#questionbank_difficulty_div').hide();
      $('#questionbank_type_div').hide();
      $('#questionbank_list').hide();

      $('#questionbank_subject_div').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue2 = $(this).attr("value");
          if (optionValue2) {
            $('#questionbank_lesson_div').show();
          } else {
            $('#questionbank_lesson_div').hide();
          }
        });
      });

      $('#questionbank_lesson_div').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue2 = $(this).attr("value");
          if (optionValue2) {
            $('#questionbank_difficulty_div').show();
          } else {
            $('#questionbank_difficulty_div').hide();
          }
        });
      });

      $('#questionbank_difficulty_div').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue2 = $(this).attr("value");
          if (optionValue2) {
            $('#questionbank_type_div').show();
          } else {
            $('#questionbank_type_div').hide();
          }
        });
      });

      $('#questionbank_type_div').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue2 = $(this).attr("value");
          if (optionValue2) {
            $('#questionbank_list').show();
          } else {
            $('#questionbank_list').hide();
          }
        });
      });

    });
  </script>

  <script src="assets/js/form-input-group.js"></script>
  <script>
    document.getElementById("downloadButton").addEventListener("click", function() {
      // Create an anchor element
      var downloadLink = document.createElement("a");
      downloadLink.href = "Sample_assessments.xlsx"; // Replace with the path to your file
      downloadLink.download = "filename.pdf"; // Replace with the desired filename for the downloaded file
      downloadLink.click();
    });
  </script>
  <script>
    new DataTable('#example', {
      scrollX: true
    });

    new DataTable('#question_bank_list', {
      scrollX: true
    });
	$('.refetch').click(function(){
		var q_type=$(this).attr('data-type');
		
		var no=$(this).attr('data-no');
		var lesson_id=$(this).attr('data-lessonID');
		var complexity=$(this).attr('data-complexity');
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		if(q_type=='mcq_1')
		{
			var arr = $('input[name="question_id_mcq1[]"]').map(function () {
				return this.value; // $(this).val()
			}).get(); 
		
			$.ajax({
                   
                    url: '{{ route("fetch_question") }}',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, q_type:q_type, arr:arr, lesson_id:lesson_id, complexity:complexity },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
					
                       $('#question_id_mcq1_'+no).val(data['alt_question']['id']);
					   $('#question_mcq1_'+no).val(data['alt_question']['question_name']);
					   
					   $('#choice1_mcq1_'+no).val(data['alt_question']['option_a']);
					   $('#choice2_mcq1_'+no).val(data['alt_question']['option_b']);
					   $('#choice3_mcq1_'+no).val(data['alt_question']['option_c']);
					   $('#choice4_mcq1_'+no).val(data['alt_question']['option_d']);
					   
					   if(data['alt_question']['option_a']== data['alt_question']['answer'])
						$("#radio1_mcq1_"+no).prop("checked", true);
					  if(data['alt_question']['option_b']== data['alt_question']['answer'])
						$("#radio2_mcq1_"+no).prop("checked", true);
					if(data['alt_question']['option_c']== data['alt_question']['answer'])
						$("#radio3_mcq1_"+no).prop("checked", true);
					if(data['alt_question']['option_d']== data['alt_question']['answer'])
						$("#radio4_mcq1_"+no).prop("checked", true);
                    }
                }); 		
		}
		if(q_type=='mcq_2')
		{
			var arr = $('input[name="question_id_mcq2[]"]').map(function () {
				return this.value; // $(this).val()
			}).get(); 
		
			$.ajax({
                   
                    url: '{{ route("fetch_question") }}',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, q_type:q_type, arr:arr, lesson_id:lesson_id, complexity:complexity},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
					
                       $('#question_id_mcq2_'+no).val(data['alt_question']['id']);
					   $('#question_mcq2_'+no).val(data['alt_question']['question_name']);
					   
					   $('#choice1_mcq2_'+no).val(data['alt_question']['option_a']);
					   $('#choice2_mcq2_'+no).val(data['alt_question']['option_b']);
					   $('#choice3_mcq2_'+no).val(data['alt_question']['option_c']);
					   $('#choice4_mcq2_'+no).val(data['alt_question']['option_d']);
					   
					   var text=data['alt_question']['answer'];
					   const ansArray = text.split(",");
					   console.log(ansArray);
					   $("#check1_mcq2_"+no).prop("checked", false);
					    $("#check2_mcq2_"+no).prop("checked", false);
						 $("#check3_mcq2_"+no).prop("checked", false);
						  $("#check4_mcq2_"+no).prop("checked", false);
					   if( ansArray.includes(data['alt_question']['option_a']) )
						  $("#check1_mcq2_"+no).prop("checked", true);
					  if( ansArray.includes(data['alt_question']['option_b'])  )
						$("#check2_mcq2_"+no).prop("checked", true);
					if( ansArray.includes(data['alt_question']['option_c']) )
						$("#check3_mcq2_"+no).prop("checked", true);
					if(ansArray.includes(data['alt_question']['option_d']) )
						$("#check4_mcq2_"+no).prop("checked", true);
                    }
                }); 		
		}
		if(q_type=='match_following')
		{
			var arr = $('input[name="question_id_match[]"]').map(function () {
				return this.value; // $(this).val()
			}).get(); 
		
			$.ajax({
                   
                    url: '{{ route("fetch_question") }}',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, q_type:q_type, arr:arr, lesson_id:lesson_id, complexity:complexity },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
					
                       $('#question_id_match_'+no).val(data['alt_question']['id']);
					   
					   $('#option_a_match_'+no).val(data['alt_question']['option_a']);
					   $('#option_b_match_'+no).val(data['alt_question']['option_b']);
					   $('#option_c_match_'+no).val(data['alt_question']['option_c']);
					   $('#option_d_match_'+no).val(data['alt_question']['option_d']);
					   
					   $('#option_1_match_'+no).val(data['alt_question']['option_1']);
					   $('#option_2_match_'+no).val(data['alt_question']['option_2']);
					   $('#option_3_match_'+no).val(data['alt_question']['option_3']);
					   $('#option_4_match_'+no).val(data['alt_question']['option_4']);
					   
					   
					   $('#choice1_match_'+no).val(data['alt_question']['choice_1']);
					   $('#choice2_match_'+no).val(data['alt_question']['choice_2']);
					   $('#choice3_match_'+no).val(data['alt_question']['choice_3']);
					   $('#choice4_match_'+no).val(data['alt_question']['choice_4']);
					   
					   if(data['alt_question']['choice_1']== data['alt_question']['answer'])
						$("#inlineRadio_1_match_"+no).prop("checked", true);
					  if(data['alt_question']['choice_2']== data['alt_question']['answer'])
						$("#inlineRadio_2_match_"+no).prop("checked", true);
					if(data['alt_question']['choice_3']== data['alt_question']['answer'])
						$("#inlineRadio_3_match_"+no).prop("checked", true);
					if(data['alt_question']['choice_4']== data['alt_question']['answer'])
						$("#inlineRadio_4_match_"+no).prop("checked", true);
                    }
                }); 		
		}
		if(q_type=='fill_blanks')
		{
			var arr = $('input[name="question_id_fill[]"]').map(function () {
				return this.value; // $(this).val()
			}).get(); 
		console.log(arr);
			$.ajax({
                   
                    url: '{{ route("fetch_question") }}',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, q_type:q_type, arr:arr, lesson_id:lesson_id, complexity:complexity },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
					
                       $('#question_id_fill_'+no).val(data['alt_question']['id']);
					   $('#question_fill_blanks_'+no).val(data['alt_question']['question_name']);
					   
					   $('#option_a_fill_'+no).val(data['alt_question']['option_a']);
					   $('#option_b_fill_'+no).val(data['alt_question']['option_b']);
					   $('#option_c_fill_'+no).val(data['alt_question']['option_c']);
					   $('#option_d_fill_'+no).val(data['alt_question']['option_d']);
					   
					   if(data['alt_question']['option_a']== data['alt_question']['answer'])
						$("#inlineRadio_1_fill_blanks_"+no).prop("checked", true);
					  if(data['alt_question']['option_b']== data['alt_question']['answer'])
						$("#inlineRadio_2_fill_blanks_"+no).prop("checked", true);
					if(data['alt_question']['option_c']== data['alt_question']['answer'])
						$("#inlineRadio_3_fill_blanks_"+no).prop("checked", true);
					if(data['alt_question']['option_d']== data['alt_question']['answer'])
						$("#inlineRadio_4_fill_blanks_"+no).prop("checked", true);
                    
					}
                }); 		
		}
		if(q_type=='true_false')
		{
			var arr = $('input[name="question_id_true_false[]"]').map(function () {
				return this.value; // $(this).val()
			}).get(); 
		
			$.ajax({
                   
                    url: '{{ route("fetch_question") }}',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, q_type:q_type, arr:arr, lesson_id:lesson_id, complexity:complexity },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
					
                       $('#question_id_true_false_'+no).val(data['alt_question']['id']);
					   $('#question_true_false_'+no).val(data['alt_question']['question_name']);
					   
					   $('#choice1_tf_'+no).val(data['alt_question']['option_a']);
					   $('#choice2_tf_'+no).val(data['alt_question']['option_b']);
					   
					   if(data['alt_question']['option_a']== data['alt_question']['answer'])
						$("#inline_trueRadio1_"+no).prop("checked", true);
					  if(data['alt_question']['option_b']== data['alt_question']['answer'])
						$("#inline_trueRadio2_"+no).prop("checked", true);
					
                    }
                }); 		
		}
		if(q_type=='short_answer')
		{
	
			var arr = $('input[name="question_id_short_answers[]"]').map(function () {
    return this.value; // $(this).val()
}).get();
console.log(arr);
				$.ajax({
                   
                    url: '{{ route("fetch_question") }}',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, q_type:q_type, arr:arr, lesson_id:lesson_id, complexity:complexity },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
						$('#question_id_shortanswer_'+no).val(data['alt_question']['id']);
					   $('#question_shortanswer_'+no).val(data['alt_question']['question_name']);
					   $('#answer_shortanswer_'+no).val(data['alt_question']['answer']);
					   
					}
				});
		}
		if(q_type=='order_sequence')
		{
			var arr = $('input[name="question_id_order_seq[]"]').map(function () {
				return this.value; // $(this).val()
			}).get(); 
		
			$.ajax({
                   
                    url: '{{ route("fetch_question") }}',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {_token: CSRF_TOKEN, q_type:q_type, arr:arr, lesson_id:lesson_id, complexity:complexity },
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
					
                       $('#question_id_order_seq_'+no).val(data['alt_question']['id']);
					   $('#question_order_sequence_'+no).val(data['alt_question']['question_name']);
					   
					   $('#option_a_order_seq_'+no).val(data['alt_question']['option_a']);
					   $('#option_b_order_seq_'+no).val(data['alt_question']['option_b']);
					   $('#option_c_order_seq_'+no).val(data['alt_question']['option_c']);
					   $('#option_d_order_seq_'+no).val(data['alt_question']['option_d']);
					   
					   $('#option_1_order_seq_'+no).val(data['alt_question']['option_1']);
					   $('#option_2_order_seq_'+no).val(data['alt_question']['option_2']);
					   $('#option_3_order_seq_'+no).val(data['alt_question']['option_3']);
					   $('#option_4_order_seq_'+no).val(data['alt_question']['option_4']);
					   
					   if(data['alt_question']['option_1']== data['alt_question']['answer'])
						$("#inline_orderRadio1_"+no).prop("checked", true);
					  if(data['alt_question']['option_2']== data['alt_question']['answer'])
						$("#inline_orderRadio2_"+no).prop("checked", true);
					if(data['alt_question']['option_3']== data['alt_question']['answer'])
						$("#inline_orderRadio3_"+no).prop("checked", true);
					if(data['alt_question']['option_4']== data['alt_question']['answer'])
						$("#inline_orderRadio4_"+no).prop("checked", true);
                    }
                }); 		
		}
	});
	$('.question_paper_cta').click(function(){
		var exam_id=$('#exam_id').val();
		var q_types_arr = $('input[name="question_types[]"]').map(function () {
    return this.value; // $(this).val()
}).get();
var q_1_arr = $('input[name="question_id_mcq1[]"]').map(function () {
    return this.value; // $(this).val()
}).get();
var q_2_arr = $('input[name="question_id_mcq2[]"]').map(function () {
    return this.value; // $(this).val()
}).get();
var q_3_arr = $('input[name="question_id_match[]"]').map(function () {
    return this.value; // $(this).val()
}).get();
var q_4_arr = $('input[name="question_id_fill[]"]').map(function () {
    return this.value; // $(this).val()
}).get();
var q_5_arr = $('input[name="question_id_true_false[]"]').map(function () {
    return this.value; // $(this).val()
}).get();
var q_6_arr = $('input[name="question_id_short_answers[]"]').map(function () {
    return this.value; // $(this).val()
}).get();
var q_7_arr = $('input[name="question_id_order_seq[]"]').map(function () {
    return this.value; // $(this).val()
}).get();
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$.ajax({
                   
                    url: '{{ route("exam_questions_add") }}',
                    type: 'POST',
                    /* send the csrf-token and the input to the controller */
                    data: {
						_token: CSRF_TOKEN,
						exam_id:exam_id, 
						q_types_arr:q_types_arr, 
						q_1_arr:q_1_arr, 
						q_2_arr:q_2_arr,
						q_3_arr:q_3_arr,
						q_4_arr:q_4_arr,
						q_5_arr:q_5_arr,
						q_6_arr:q_6_arr, 
						q_7_arr:q_7_arr
						},
                    dataType: 'JSON',
                    /* remind that 'data' is the response of the AjaxController */
                    success: function (data) {
						
					}
				});
	});
	$('#branch_id').change(function(){
		var branch_id=$(this).val();
		
		 $.ajax({
				  url:'{{ route("get_classroom_by_branch_id") }}',
				  type:'get',
				  data:{
					  'branch_id':branch_id
				  },
				  success:function(response)
				  {
					 var class_rooms=response['class_rooms'];				 
					 var select_content='<option value="">Select Class Room</option>';
					  for(i=0;i<class_rooms.length;i++)
					  {
						 var class_room_id=class_rooms[i].id;
						 var class_room_name=class_rooms[i].class_room_name;
						 select_content=select_content+'<option value="'+class_room_id+'">'+class_room_name+'</option>';
					  }
					  
					  $('#paper_class_room').html(select_content);					  
				  }
			  });
	});
	$('#exam_type').change(function(){ 
	          var type=$(this).val();
			  if(type==2)
			  {
				  $('.jp_exam_end_date').hide();
				  $('.jp_publish').hide();
			  }
			  if(type==1)
			  {
				  $('.jp_exam_end_date').show();
				  $('.jp_publish').show();
			  }
	});
  </script>


</body>

</html>
