<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Admin Assessments</title>
  <meta name="description" content="" />
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
      background-color: #e00814 !important;
      border-color: #e00814 !important;
    }
    
    .student_exampreview .form-check-input.wrong:checked,
    .student_exampreview .form-check-input.wrong[type=checkbox]:indeterminate {
      background-color: red !important;
      border-color: red !important;
    }
    
    .student_exampreview .form-check-input.correct:checked,
    .student_exampreview .form-check-input.correct[type=checkbox]:indeterminate {
      background-color: green !important;
      border-color: green !important;
    }
    
    .admin_assignments .form-check-input:focus {
      border-color: #e00814 !important;
    }
    
    .admin_assignments .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
    .admin_assignments .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
    .admin_assignments .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,
    .admin_assignments .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle) {
      background: linear-gradient(72.47deg, #e00814 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
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
    .bootstrap-select .dropdown-menu.inner a[aria-selected=true] {
      background-color: #e00814 !important;
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
      color: #e00814;
    }
    
    #reportrange:focus {
      color: #6f6b7d;
      background-color: #fff !important;
      border-color: #7367f0 !important;
      outline: 0;
      box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
    }
    
    #home_work:hover {
      background: linear-gradient(72.47deg, #e00814 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
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
    
    #exam_lists:hover {
      background: linear-gradient(72.47deg, #e00814 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
      color: #ffffff !important;
      padding: 5px 10px;
      border-radius: 5px;
    }
    
    #excel_file::before {
      content: "Upload File";
      position: absolute;
      z-index: 2;
      display: block;
      background: linear-gradient(72.47deg, #e00814 22.16%, rgb(224, 8, 20, 0.7) 76.47%);
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
      color: #ea5455;
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
    .table_admin select#dt-length-1,
    .table_admin select#dt-length-2 {
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
    
    .btn_design,
    .question_paper_cta,
    .previous_button,
    #next,
    #prev,
    #submit {
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
      color: #ea5455 !important;
      background-color: #fdf1f1 !important;
      border-color: #ea5455 !important;
    }
    
    #prev {
      color: #a8aaae !important;
      border-color: transparent !important;
      background: #f1f1f2 !important;
    }
    
    .admin_assignments #logo_color {
      background-color: #e00814 !important;
      border-color: #e00814 !important;
    }
    
    #paper_lesson_div .dropdown-toggle::after {
      margin-top: 4px !important;
      float: right !important;
    }
    
    .nav-tabs .nav-link:not(.active):hover,
    .nav-tabs .nav-link:not(.active):focus,
    .nav-pills .nav-link:not(.active):hover,
    .nav-pills .nav-link:not(.active):focus {
      color: #e00814 !important;
    }
    
    #question_lists:hover {
      background: linear-gradient(72.47deg, #e00814 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
      color: #ffffff !important;
      padding: 5px 10px;
      border-radius: 5px;
    }
    
    #scroll_bar::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
      background-color: #F5F5F5;
    }
    
    #scroll_bar::-webkit-scrollbar {
      width: 2px;
      background-color: #F5F5F5;
    }
    
    #scroll_bar::-webkit-scrollbar-thumb {
      background-color: #e00814;
    }
    
    #div2,
    #div3 {
      display: none;
    }
    
    #prev,
    #submit {
      display: none;
      float: left;
    }
    
    .clear {
      clear: both
    }
  </style>
</head>

<body class="admin_assignments">
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      @include('dashboard.sidebar')
      <div class="layout-page">
        <!-- Navbar -->
        @include('dashboard.navbar')
        <!-- / Navbar -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y" id="admin_assignment">
            <div class="app-ecommerce mb-3">
              
			  
			<!-- Student Assessment List -->
          <!-- Student Assessment Preview -->
          <div class="container-xxl flex-grow-1 container-p-y" id="student_assessment_preview">
            <div class="app-ecommerce mb-3">
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                <div class="d-flex flex-column justify-content-center">
                  <h4 class="mb-1 mt-3" id="pagetitle">
				  <?php $student_id=$_GET['student_id'];
				  $stu=App\Models\User::find($student_id);
				  echo $stu->first_name.' '.$stu->last_name
				  ?></h4>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-3">
                  <button class="btn btn-label-secondary btn-prev waves-effect" id="assessment_students">
                    <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none"><a href="{{ route('get_student_exam_attend',$_GET['exam_id'] )}}">Back</a></span>
                  </button>
                </div>
              </div>
              <div class="card col-12">
			  @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                <div class="card-body student_exampreview text-nowrap">
                  <div class="row mb-4" id="scroll_bar" style="background: #fff;border-radius: 10px;">
                    <div class="col-12 mb-2 p-4" id="scroll_bar" style="max-height: 500px;overflow-y: scroll;">
                      <?php 
					   $no_of_questions= count($exam_answers);
					   $total_sections=ceil($no_of_questions/5);
					   $i=0;
			$j=1;			
			$jp_style='';
					 ?>
					  <?php foreach ($exam_answers as $single_answer) {
					if($j!=1)
						$jp_style='display:none;';
			if($i%5==0)
				echo '<div class="div'.$j.'" style="'.$jp_style.'"><h5>Section '.$j.'</h5>';
			
			?>
			<?php
						$question_type=$single_answer->question_type;
						$question_no=$single_answer->question_no;
			?>
			<form action="{{ route('score_update'); }}" method="post">
			@csrf
			<input type="hidden" name="question_type[]" value="<?php echo $question_type; ?>"> 
			<input type="hidden" name="question_no[]" value="<?php echo $question_no; ?>"> 
             <input type="hidden" name="student_id" value="<?php echo $_GET['student_id']; ?>"> 
			<input type="hidden" name="exam_id" value="<?php echo $_GET['exam_id']; ?>"> 
                          
			<!--Type 1 - Multiple Choice Single Answer-->
			<div class="col-12 row">
			<?php 
						  
						  if($question_type=='mcq_1') {
							 $single_ques=App\Models\QuestionTypeOne::find($question_no);
			                 if($single_ques){
								 
							  ?>
						 <div class="col-8 row">						  
                            <p><?php echo $i+1; ?>. <?php echo $single_ques->question_name; ?></p>
                            <div class="form-check mb-3" style="padding-left:8%;">
                              <input class="form-check-input <?php if( $single_ques->option_a ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_a ==$single_answer->answer) { ?> checked  <?php } ?> disabled/>
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_a; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->option_b ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_b ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_b; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->option_c ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_c ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_c; ?> </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->option_d ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_d ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_d; ?> </label>
                            </div>
                          </div>
                          <div class="col-4 row">
                            <div>
                              <label for="defaultFormControlInput" class="form-label">Score</label>
                              <input type="text" class="form-control" name="score[]" value="<?php echo $single_answer->score; ?>">
                            </div>
                          </div>
						  <?php } }?>
                        </div>
			<!--Type 1 - Multiple Choice Single Answer-->
			<!--Type 2 - Multiple Choice Multiple Answer-->
			<div class="col-12 row">
			<?php 
						  
						  if($question_type=='mcq_2') {
							 $single_ques=App\Models\QuestionTypeTwo::find($question_no);
			                 if($single_ques){
								 $correct_ans_arr=explode(',',$single_ques->answer);
								 $student_ans_arr=explode(',',$single_answer->answer);
							  ?>
						
                          <div class="col-8 row">
                            <p><?php echo $i+1; ?>. <?php echo $single_ques->question_name; ?></p>
                            <div class="form-check mb-3" style="padding-left:8%;">
                              <input class="form-check-input <?php if( in_array($single_ques->option_a,$correct_ans_arr)) { echo 'correct'; } else { echo 'wrong'; } ?>" type="checkbox" value="" id="defaultCheck1" <?php if( in_array($single_ques->option_a,$student_ans_arr)) { ?> checked  <?php } ?> disabled/>
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_a; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( in_array($single_ques->option_b,$correct_ans_arr)) { echo 'correct'; } else { echo 'wrong'; } ?>" type="checkbox" value="" id="defaultCheck1" <?php if( in_array($single_ques->option_b,$student_ans_arr)) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_b; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( in_array($single_ques->option_c,$correct_ans_arr)) { echo 'correct'; } else { echo 'wrong'; } ?>" type="checkbox" value="" id="defaultCheck1" <?php if( in_array($single_ques->option_c,$student_ans_arr)) { ?> checked  <?php } ?> disabled/>
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_c; ?> </label>
                              <br>
                              <input class="form-check-input <?php if( in_array($single_ques->option_d,$correct_ans_arr)) { echo 'correct'; } else { echo 'wrong'; } ?>" type="checkbox" value="" id="defaultCheck1" <?php if( in_array($single_ques->option_d,$student_ans_arr)) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_d; ?>. </label>
                            </div>
                          </div>
                          <div class="col-4 row">
                            <div>
                              <label for="defaultFormControlInput" class="form-label">Score</label>
                              <input type="text" class="form-control" name="score[]" value="<?php echo $single_answer->score; ?>">
                            </div>
                          </div>
						   <?php } } ?>
                        </div>
			<!--Type 2 - Multiple Choice Multiple Answer-->
			<!--Type 3 - Match the following-->
			<div class="col-12 row">
			<?php 
						  
						  if($question_type=='match_following') {
							 $single_ques=App\Models\QuestionTypeThree::find($question_no);
			                 if($single_ques){
								 
							  ?>
						 <div class="col-8 row">						  
                            <p><?php echo $i+1; ?>. Match The Following</p>
							  <div class="row">
                      <div class="col-lg-6 col-xl-6 mb-0">
                        <ol type="A" style="line-height:180%">
                          <li><?php echo $single_ques->option_a; ?></li>
                          <li><?php echo $single_ques->option_b; ?></li>
                          <li><?php echo $single_ques->option_c; ?></li>
                          <li><?php echo $single_ques->option_d; ?></li>
                        </ol>
                      </div>
                      <div class="col-lg-6 col-xl-6 mb-0">
                        <ol type="1" style="line-height:180%">
                          <li><?php echo $single_ques->option_1; ?></li>
                          <li><?php echo $single_ques->option_2; ?></li>
                          <li><?php echo $single_ques->option_3; ?></li>
                          <li><?php echo $single_ques->option_4; ?></li>
                        </ol>
                      </div>
                    </div>
                            <div class="form-check mb-3" style="padding-left:8%;">
                              <input class="form-check-input <?php if( $single_ques->choice_1 ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->choice_1 ==$single_answer->answer) { ?> checked  <?php } ?> disabled/>
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->choice_1; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->choice_2 ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->choice_2 ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->choice_2; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->choice_3 ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->choice_3 ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->choice_3; ?> </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->choice_4 ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->choice_4 ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->choice_4; ?> </label>
                            </div>
                          </div>
                          <div class="col-4 row">
                            <div>
                              <label for="defaultFormControlInput" class="form-label">Score</label>
                              <input type="text" class="form-control"  name="score[]" value="<?php echo $single_answer->score; ?>">
                            </div>
                          </div>
						  <?php } }?>
                        </div>
			<!--Type 3 - Match the following-->
			<!--Type 4 - Fill in blanks-->
			<div class="col-12 row">
			<?php 
						  
						  if($question_type=='fill_blanks') {
							 $single_ques=App\Models\QuestionTypeFour::find($question_no);
			                 if($single_ques){
								 
							  ?>
						<div class="col-8 row">						  
                            <p><?php echo $i+1; ?>. <?php echo $single_ques->question_name; ?></p>
                            <div class="form-check mb-3" style="padding-left:8%;">
                              <input class="form-check-input <?php if( $single_ques->option_a ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_a ==$single_answer->answer) { ?> checked  <?php } ?> disabled/>
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_a; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->option_b ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_b ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_b; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->option_c ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_c ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_c; ?> </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->option_d ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_d ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_d; ?> </label>
                            </div>
                          </div>
                          <div class="col-4 row">
                            <div>
                              <label for="defaultFormControlInput" class="form-label">Score</label>
                              <input type="text" class="form-control" name="score[]" value="<?php echo $single_answer->score; ?>">
                            </div>
                          </div>
						  <?php } }?>
                        </div>
			
			<!--Type 4 - Fill in blanks-->
			<!--Type 5 - True or False-->
			<div class="col-12 row">
			<?php 
						  
						  if($question_type=='true_false') {
							 $single_ques=App\Models\QuestionTypeFive::find($question_no);
			                 if($single_ques){
								 
							  ?>
						<div class="col-8 row">						  
                            <p><?php echo $i+1; ?>. <?php echo $single_ques->question_name; ?></p>
                            <div class="form-check mb-3" style="padding-left:8%;">
                              <input class="form-check-input <?php if( $single_ques->option_a ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_a ==$single_answer->answer) { ?> checked  <?php } ?> disabled/>
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_a; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->option_b ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_b ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_b; ?>. </label>
                             </div>
                          </div>
                          <div class="col-4 row">
                            <div>
                              <label for="defaultFormControlInput" class="form-label">Score</label>
                              <input type="text" class="form-control"  name="score[]" value="<?php echo $single_answer->score; ?>">
                            </div>
                          </div>
						  <?php } }?>
                        </div>
			<!--Type 5 - True or False-->
			<!--Type 6 - Short Answer-->
			<div class="col-12 row">
			<?php 
						  
						  if($question_type=='short_answer') {
							 $single_ques=App\Models\QuestionTypeSix::find($question_no);
			                 if($single_ques){
								 
							  ?>
					   <div class="col-8 row">
                            <p><?php echo $i+1; ?>. <?php echo $single_ques->question_name; ?></p>
                            <div class="form-check mb-3" style="padding-left:2%;">
                              <textarea id="autosize-demo" rows="3" class="form-control" readonly>
							  <?php echo $single_answer->answer;?>
							  </textarea>
                            </div>
                          </div>
                          <div class="col-4 row">
                            <div>
                              <label for="defaultFormControlInput" class="form-label">Score</label>
                              <input type="text" class="form-control"  name="score[]" value="<?php echo $single_answer->score; ?>">
                            </div>
                          </div>
						  <?php } }?>
                        </div>
			<!--Type 6 - Short Answer-->
			<!--Type 7 - Order Sequence-->
			<div class="col-12 row">
			<?php 
						  
						  if($question_type=='order_sequence') {
							 $single_ques=App\Models\QuestionTypeSeven::find($question_no);
			                 if($single_ques){
								 
							  ?>
						<div class="col-8 row">						  
                            <p><?php echo $i+1; ?>. <?php echo $single_ques->question_name; ?></p>
							<div class="row">
                      <div class="col-lg-6 col-xl-6 mb-0">
                        <ol type="A" style="line-height:180%">
                          <li><?php echo $single_ques->option_a; ?></li>
                          <li><?php echo $single_ques->option_b; ?></li>
                          <li><?php echo $single_ques->option_c; ?></li>
                          <li><?php echo $single_ques->option_d; ?></li>
                        </ol>
                      </div>
					  </div>
                            <div class="form-check mb-3" style="padding-left:8%;">
                              <input class="form-check-input <?php if( $single_ques->option_1 ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_1 ==$single_answer->answer) { ?> checked  <?php } ?> disabled/>
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_1; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->option_2 ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_2 ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_2; ?>. </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->option_3 ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_3 ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_3; ?> </label>
                              <br>
                              <input class="form-check-input <?php if( $single_ques->option_4 ==$single_ques->answer) {  echo 'correct'; } else { echo 'wrong'; } ?>" type="radio" value="" <?php if( $single_ques->option_4 ==$single_answer->answer) { ?> checked  <?php } ?> disabled />
                              <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_4; ?> </label>
                            </div>
                          </div>
                          <div class="col-4 row">
                            <div>
                              <label for="defaultFormControlInput" class="form-label">Score</label>
                              <input type="text" class="form-control" name="score[]" value="<?php echo $single_answer->score; ?>">
                            </div>
                          </div>
						  <?php } }?>
                        </div>
			<!--Type 7 - Order Sequence-->
			
			<?php 
			$i++;
			if($i%5==0)
			{
				echo '</div>';
				$j++;
				
			}
			}
			if($no_of_questions%5!=0) echo '</div>';?>
				</div>
                  </div>
                  
		 <div class="row" id="question_button">
          <div class="col-4 mb-2">
          </div>
          <div class="col-2 mb-2">
            <button type="button" class="btn-label-secondary waves-effect" id="previous" style="display:none;" data-current_div="<?php echo 1; ?>" data-total_section="<?php echo $j; ?>" style="float:right;"><span class="ti-xs ti ti-chevrons-left me-1"></span>Previous</button>
          </div>
          <div class="col-2 mb-2">
            <button type="button" class="btn-primary waves-effect waves-light" id="next" data-current_div="<?php echo 1; ?>" data-total_section="<?php echo $j; ?>" style="background-color: <?php echo $org_color; ?> !important;    border-color: <?php echo $org_color; ?> !important;">Next<span class="ti-xs ti ti-chevrons-right me-1"></span></button>

            <button type="submit" class="btn-success waves-effect waves-light overview_btn" id="submit_button" data-tot="<?php echo $no_of_questions; ?>" style="display:none; background-color: #28c76f !important;    border-color: #28c76f !important;">Submit</button>
          </div>
          <div class="col-4 mb-2">
          </div>
        </div>
			</form>	  
				  <div class="modal fade" id="scoreboard_submit" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title mt-3" id="modalCenterTitle">Score Board</h5>
                            </div>
                            <div class="modal-body">
                              <div class="row mb-3 g-3">
                                <div class="col-md-6">
                                  <label class="form-label">Mark Scored</label>
                                  <input type="text" class="form-control" value="40" readonly /> </div>
                                <div class="col-md-6">
                                  <label class="form-label">Total Marks</label>
                                  <input type="text" class="form-control" value="100" readonly /> </div>
                                <div class="col-md-12">
                                  <div class="alert alert-danger" role="alert">Result: <b>Failed</b></div>
                                  <div class="alert alert-success" role="alert">Result: <b>Passed</b></div>
                                </div>
                              </div>
                              <div class="modal-footer p-0">
                                <a href="admin_assessments.html">
                                  <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                </a>
                                <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
					  
                </div>
              </div>
            </div>
            <!-- Content -->
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
  
  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  <!-- Drag Target Area To SlideIn Menu On Small Screens -->
  <div class="drag-target"></div>
  
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
  $('.jp_sect').click(function(){
	  let no=$(this).attr('data-no');
	  let tot=$(this).attr('data-tot');
	  $('#next').attr('data-current_div',no);
	  $('#previous').attr('data-current_div',no);
	  if(no==1)
	 {
		  $('#previous').hide();
		  $('#next').show();
		  $('#submit_button').css('display','none');
	  }
	  else if(no<tot)
	  {
		  $('#previous').show();
		  $('#next').show();
		   $('#submit_button').css('display','none');
	  }
	  else if(no==tot)
	  {
		  $('#previous').show();
		  $('#next').hide();
		   $('#submit_button').css('display','block');
	  }
	  
	  for(let i=1;i<=tot;i++)
	  $('.div'+i).hide();
  
		$('.div'+no).show();
  });
  
  $('#next').click(function() {
	  
  let current_div=$(this).attr('data-current_div');
  let total_section=$(this).attr('data-total_section');
  let next=parseInt(current_div)+1;
  $(this).attr('data-current_div',next);
  $('#previous').attr('data-current_div',next);
  
  if(next>1)
	  $('#previous').css('display','block');
  else 
	  $('#previous').css('display','none');
  
  if(next==total_section)
  {
	  $('#next').css('display','none');
	  $('#submit_button').css('display','block');
  }
  else 
	  $('#next').css('display','block');
  
  for(let i=1;i<=total_section;i++)
	  $('.div'+i).hide();
  
  $('.div'+next).show();
  
  });
  
  $('#previous').click(function() {
	  
  let current_div=$(this).attr('data-current_div');
  let total_section=$(this).attr('data-total_section');
  let prev=parseInt(current_div)-1;
  $(this).attr('data-current_div',prev);
  $('#next').attr('data-current_div',prev);
  
  if(prev<=1)
	  $('#previous').css('display','none');
  else 
  {
	  $('#previous').css('display','block');
	  $('#next').css('display','block');
	  $('#submit_button').css('display','none');
  }
	  
  if(prev==1)
	  $('#next').css('display','block');
  
  
  for(let i=1;i<=total_section;i++)
	  $('.div'+i).hide();
  
  $('.div'+prev).show();
  });
  const ans=[];
 function jp(q_no)
 {
	 var total_section=$('#next').attr('data-total_section');
	 var total=$('#submit_button').attr('data-tot');
	 if(!ans.includes(q_no))
	 ans.push(q_no);
	 var answered=ans.length;
	 var notanswered=parseInt(total)-parseInt(answered);
	 //alert(answered+'--'+notanswered);
	 $('#answered').val(answered);
	 $('#not_answered').val(notanswered);
	 //each section loop
	/*for(var i=1;i<=total_section;i++)
	 {
		 var num=parseInt(i)*5;
		 for(var j=0;j<num;j++)
		 {
		 if(ans.includes(j))
		 {
			 $('#button_'+i).addClass('bg-label-success');
			 $('#button_'+i).removeClass('bg-label-danger');
		 }
		 else 
		 {
			 $('#button_'+i).addClass('bg-label-danger');
			 $('#button_'+i).removeClass('bg-label-success');
		 }
		 }
	 }*/
 }
 $('#exam_submit').click(function(e){	 
	 e.preventDefault();
	 $('#exam_page').modal('show');
 });
  </script>
  </body>
</html>