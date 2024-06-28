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
      width: 450px;
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
      background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
      color: #ffffff !important;
      padding: 5px 10px;
      border-radius: 5px;
    }

    .word_ellipsis {
      white-space: nowrap;
      width: 450px;
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
              <!-- Question Bank Creation -->
              <div class="nav-align-top mb-4" id="questionbank_creation">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                  <li class="nav-item">
                    <a href="{{ route('question_bank','all_questions') }}" class="nav-link <?php if($slug=="all_questions") { echo 'active';} ?>">
                      <i class="tf-icons ti ti-adjustments-question ti-xs me-1"></i> Question Bank
                    </a>
                  </li>                  
				  <li class="nav-item">
                          <a href="{{ route('question_bank','add_question') }}" class="nav-link <?php if($slug=="add_question") { echo 'active';} ?>">
                            <b> <i class="tf-icons ti ti-chart-candle ti-xs me-1"></i> Manual Creation</b>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('question_bank','excel_upload') }}" class="nav-link <?php if($slug=="excel_upload") { echo 'active';} ?>">
                            <b> <i class="tf-icons ti ti-file-spreadsheet ti-xs me-1"></i> Excel Upload</b>
                          </a>
                        </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade <?php if ($slug == "all_questions") {
                                                                    echo 'show active';
                                                                } ?>" id="navs-pills-justified-question-bank" role="tabpanel">
                                        <div class="row">
                                            @if(session()->has('success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success') }}
                                            </div>
                                            @endif
                                            @if(empty($branch_id) && $user_role_id == 1)
                                            <div class="col-4 mb-3" id="questionbank_branch_div">
                                                <label for="selectpickerBasic" class="form-label">Branch</label>
                                                <select id="questionbank_branch" class="form-select w-100 questionbank_branches question_bank_branch_delete_row" data-style="btn-default">
                                                    <option value="">Select Branch</option>
                                                    @foreach ($branches as $branch)
                                                    <?php if (old('branch_id') == $branch->id)
                                                        $sele = 'selected';
                                                    else
                                                        $sele = '';
                                                    echo '<option ' . $sele . ' value="' . $branch->id . '">' . $branch->branch_name . '</option>'; ?>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endif
                                            <div class="col-4 mb-3" id="questionbank_subject_div">
                                                <label for="selectpickerBasic" class="form-label">Subject</label>
                                                <select id="questionbank_sub_ject" class="form-select w-100 subject sub_ject" name="subject_id" data-style="btn-default">
                                                    <option value="">Select Subject</option>
                                                    @if(!empty($subjects))
                                                    <?php foreach ($subjects as $subject) {
                                                        if ($subject->id == old('subject_id'))
                                                            $sel = 'selected';
                                                        else
                                                            $sel = '';
                                                        echo '<option ' . $sel . ' value="' . $subject->id . '">' . $subject->subject_name . '</option>';
                                                    } ?>
                                                    @endif
                                                </select>

                                            </div>
                                            <div class="col-4 mb-3" id="questionbank_lesson_div">
                                                <label for="selectpickerBasic" class="form-label">Lesson</label>
                                                <select id="questionbank_sub_lesson" class="form-select w-100 sub_lesson" data-style="btn-default">
                                                    <option value="">Select Lesson</option>
                                                </select>
                                            </div>
                                            <div class="col-4 mb-3" id="questionbank_difficulty_div">
                                                <label for="selectpickerBasic" class="form-label">Difficulty Level</label>
                                                <select id="questionbank_difficultylevel" class="form-select w-100" data-style="btn-default">
                                                    <option value="">Select Difficulty Level</option>
                                                    <option value="Easy">Easy</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="Hard">Hard</option>
                                                </select>
                                            </div>
                                            <div class="col-5 mb-3" id="questionbank_type_div">
                                                <label for="selectpickerBasic" class="form-label">Filter by Type</label>
                                                <select id="questionbank_filter_type" class="form-select w-100 filter_by_type" onchange="this.form.submit()" data-style="btn-default">
                                                    <option value="">Select Questions</option>
                                                    <option value="mcq_1">Multiple Choice Single Answer</option>
                                                    <option value="mcq_2">Multiple Choice Multiple Answers</option>
                                                    <option value="match_following">Match the Following</option>
                                                    <option value="fill_blanks">Fill in the blanks</option>
                                                    <option value="true_false">True or False</option>
                                                    <option value="short_answer">Short Answer</option>
                                                    <option value="order_sequence">Order/Sequencing</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr />
                                        <div id="questionbank_list" class="table_admin">
                                            <table id="question_bank_list" class="display" style="width:100%">
                                                <thead>
                                                    <th style="background-color: #f5c6cb30;">Question</th>
                                                    <th style="background-color: #f5c6cb30;">Actions</th>
                                                </thead>
                                                <tbody>
                                                    <!-- Multiple choice single answer -->
                                                    <div class="modal fade" id="type_one_preview_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                        Preview Question
                                                                    </h5>
                                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">

                                                                        <div class="mb-3 col-lg-8 col-xl-7 col-12 mb-0">
                                                                            <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control question_pr_ty1" id="exampleFormControlTextarea1" name="question" rows="10" disabled></textarea>
                                                                            <input type="hidden" class="question_id_pr_ty1" name="question_id">
                                                                            <input type="hidden" class="question_type_pr_ty1" name="question_type">
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4 col-xl-5 col-12 mb-0">
                                                                            <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                            <div class="input-group form-check-inline mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio1_pr_ty1" value="a" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_a_pr_ty1" name="option_a" placeholder="Choice (A)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group  form-check-inline mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio2_pr_ty1" value="b" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_b_pr_ty1" name="option_b" placeholder="Choice (B)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group  form-check-inline mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio3_pr_ty1" value="c" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_c_pr_ty1" name="option_c" placeholder="Choice (C)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group  form-check-inline mb-3">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio4_pr_ty1" value="d" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_d_pr_ty1" name="option_d" placeholder="Choice (D)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                            <select id="smallSelect" class="form-select form-select-sm complexity_pr_ty1" name="complexity" disabled>
                                                                                <option>Select</option>
                                                                                <option value="Easy">Easy</option>
                                                                                <option value="Medium">Medium</option>
                                                                                <option value="Hard">Hard</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="type_one_edit_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{route('edit_question_type_one')}}" method="post" id="edit_question">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                            Edit Question
                                                                        </h5>
                                                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">

                                                                            <div class="mb-3 col-lg-8 col-xl-7 col-12 mb-0">
                                                                                <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                                <textarea class="form-control question_ed_ty1" id="exampleFormControlTextarea1" name="question" rows="10" required></textarea>
                                                                                <input type="hidden" class="question_id_ed_ty1" name="question_id">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-4 col-xl-5 col-12 mb-0">
                                                                                <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                <div class="input-group form-check-inline mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_a_ed_ty1" value="a">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_a_ed_ty1" name="option_a" placeholder="Choice (A)" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <div class="input-group  form-check-inline mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_b_ed_ty1" value="b">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_b_ed_ty1" name="option_b" placeholder="Choice (B)" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <div class="input-group  form-check-inline mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_c_ed_ty1" value="c">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_c_ed_ty1" name="option_c" placeholder="Choice (C)" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <div class="input-group  form-check-inline mb-3">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_d_ed_ty1" value="d">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_d_ed_ty1" name="option_d" placeholder="Choice (D)" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                <select id="smallSelect" class="form-select form-select-sm complexity_ed_ty1" name="complexity" required>
                                                                                    <option>Select</option>
                                                                                    <option value="Easy">Easy</option>
                                                                                    <option value="Medium">Medium</option>
                                                                                    <option value="Hard">Hard</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="type_one_suspend_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalCenterTitle">Delete Question</h5>
                                                                </div>
                                                                <form action="{{route('suspend_question_type_one')}}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <span>Are you sure, you want to Delete this question</span>
                                                                                <input type="hidden" id="question_id_sus_ty1" name="question_id">
                                                                                <input type="hidden" id="status" name="status">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">
                                                                            No
                                                                        </button>
                                                                        <button type="submit" id="logo_color" class="btn btn-primary">Yes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Multiple choice multiple answer -->
                                                    <div class="modal fade" id="type_two_preview_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                        Preview Question
                                                                    </h5>
                                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">

                                                                        <div class="mb-3 col-lg-8 col-xl-7 col-12 mb-0">
                                                                            <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control question_pr_ty2" id="exampleFormControlTextarea1" name="question" rows="10" disabled></textarea>
                                                                            <input type="hidden" class="question_id_pr_ty2" name="question_id">
                                                                            <input type="hidden" class="question_type_pr_ty2" name="question_type">
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                                                            <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                            <div class="input-group mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input mt-0" type="checkbox" id="check1_pr_ty2" name="check1" value="a" aria-label="Checkbox for following text input" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_a_pr_ty2" placeholder="Choice (A)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input mt-0" type="checkbox" id="check2_pr_ty2" name="check2" value="b" aria-label="Checkbox for following text input" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_b_pr_ty2" placeholder="Choice (B)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input mt-0" type="checkbox" id="check3_pr_ty2" name="check3" value="c" aria-label="Checkbox for following text input" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_c_pr_ty2" placeholder="Choice (C)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input mt-0" type="checkbox" id="check4_pr_ty2" name="check4" value="d" aria-label="Checkbox for following text input" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_d_pr_ty2" placeholder="Choice (D)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                            <select id="smallSelect" class="form-select form-select-sm complexity_pr_ty2" name="complexity" disabled>
                                                                                <option>Select</option>
                                                                                <option value="Easy">Easy</option>
                                                                                <option value="Medium">Medium</option>
                                                                                <option value="Hard">Hard</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="type_two_edit_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{route('edit_question_type_two')}}" method="post" id="edit_question">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                            Edit Question
                                                                        </h5>
                                                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">

                                                                            <div class="mb-3 col-lg-8 col-xl-7 col-12 mb-0">
                                                                                <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                                <textarea class="form-control question_ed_ty2" id="exampleFormControlTextarea1" name="question" rows="10" required></textarea>
                                                                                <input type="hidden" class="question_id_ed_ty2" name="question_id">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                                                                <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                <div class="input-group mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input mt-0" type="checkbox" id="check1_ed_ty2" name="check1" value="a" aria-label="Checkbox for following text input">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_a_ed_ty2" placeholder="Choice (A)" name="option_a" aria-label="Text input with checkbox">
                                                                                </div>
                                                                                <div class="input-group mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input mt-0" type="checkbox" id="check2_ed_ty2" name="check2" value="b" aria-label="Checkbox for following text input">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_b_ed_ty2" placeholder="Choice (B)" name="option_b" aria-label="Text input with checkbox">
                                                                                </div>
                                                                                <div class="input-group mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input mt-0" type="checkbox" id="check3_ed_ty2" name="check3" value="c" aria-label="Checkbox for following text input">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_c_ed_ty2" placeholder="Choice (C)" name="option_c" aria-label="Text input with checkbox">
                                                                                </div>
                                                                                <div class="input-group mb-3">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input mt-0" type="checkbox" id="check4_ed_ty2" name="check4" value="d" aria-label="Checkbox for following text input">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_d_ed_ty2" placeholder="Choice (D)" name="option_d" aria-label="Text input with checkbox">
                                                                                </div>
                                                                                <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                <select id="smallSelect" class="form-select form-select-sm complexity_ed_ty2" name="complexity">
                                                                                    <option>Select</option>
                                                                                    <option value="Easy">Easy</option>
                                                                                    <option value="Medium">Medium</option>
                                                                                    <option value="Hard">Hard</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="type_two_suspend_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalCenterTitle">Delete Question</h5>
                                                                </div>
                                                                <form action="{{route('suspend_question_type_two')}}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <span>Are you sure, you want to Delete this question</span>
                                                                                <input type="hidden" id="question_id_sus_ty2" name="question_id">
                                                                                <input type="hidden" id="status_sus_ty2" name="status">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">
                                                                            No
                                                                        </button>
                                                                        <button type="submit" id="logo_color" class="btn btn-primary">Yes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Match the following -->
                                                    <div class="modal fade" id="type_three_preview_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                        Preview Question
                                                                    </h5>
                                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0">
                                                                            <label class="form-label">Heading 1<span class="text-danger">*</span></label>
                                                                            <div class="input-group mb-1">
                                                                                <span class="input-group-text">A</span>
                                                                                <textarea class="form-control option_a_pr_ty3" aria-label="With textarea" placeholder="Child Labour (Prohibition and Regulation) Act Year of Legislation" row="10" name="option_a" disabled></textarea>
                                                                            </div>
                                                                            <div class="input-group mb-1">
                                                                                <span class="input-group-text">B</span>
                                                                                <textarea class="form-control option_b_pr_ty3" aria-label="With textarea" placeholder="The Factories Act" row="10" name="option_b" disabled></textarea>
                                                                            </div>
                                                                            <div class="input-group mb-1">
                                                                                <span class="input-group-text">C</span>
                                                                                <textarea class="form-control option_c_pr_ty3" aria-label="With textarea" placeholder="The Mines Act" row="10" name="option_c" disabled></textarea>
                                                                            </div>
                                                                            <div class="input-group mb-1">
                                                                                <span class="input-group-text">D</span>
                                                                                <textarea class="form-control option_d_pr_ty3" aria-label="With textarea" placeholder="The Right of Children to Free and Compulsory Education Act" row="10" name="option_d" disabled></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0">
                                                                            <label class="form-label">Heading 2<span class="text-danger">*</span></label>
                                                                            <div class="input-group mb-1">
                                                                                <span class="input-group-text">1</span>
                                                                                <textarea class="form-control option_1_pr_ty3" aria-label="With textarea" placeholder="1986" row="10" name="option_1" disabled></textarea>
                                                                            </div>
                                                                            <div class="input-group mb-1">
                                                                                <span class="input-group-text">2</span>
                                                                                <textarea class="form-control option_2_pr_ty3" aria-label="With textarea" placeholder="1952" row="10" name="option_2" disabled></textarea>
                                                                            </div>
                                                                            <div class="input-group mb-1">
                                                                                <span class="input-group-text">3</span>
                                                                                <textarea class="form-control option_3_pr_ty3" aria-label="With textarea" placeholder="2009" row="10" name="option_3" disabled></textarea>
                                                                            </div>
                                                                            <div class="input-group mb-1">
                                                                                <span class="input-group-text">4</span>
                                                                                <textarea class="form-control option_4_pr_ty3" aria-label="With textarea" placeholder="1948" row="10" name="option_4" disabled></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                                                                            <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                            <div class="input-group form-check-inline mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_match_1" id="radio1_pr_ty3" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control choice_1_pr_ty3" placeholder="A-1, B-4, C-2, D-3" name="choice_1" required aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group  form-check-inline mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_match_1" id="radio2_pr_ty3" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control choice_2_pr_ty3" placeholder="A-2, B-4, C-3, D-1" name="choice_2" required aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group  form-check-inline mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_match_1" id="radio3_pr_ty3" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control choice_3_pr_ty3" placeholder="A-3, B-2, C-1, D-4" name="choice_3" required aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group  form-check-inline mb-4">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions_match_1" id="radio4_pr_ty3" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control choice_4_pr_ty3" placeholder="A-4, B-3, C-1, D-2" name="choice_4" required aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                            <select id="smallSelect" name="complexity" required class="form-select form-select-sm complexity_pr_ty3" disabled>
                                                                                <option value="">Select</option>
                                                                                <option value="Easy">Easy</option>
                                                                                <option value="Medium">Medium</option>
                                                                                <option value="Hard">Hard</option>
                                                                            </select>
                                                                        </div>
                                                                        <p style="height:4px;"></p>
                                                                        <div class="modal-footer">
                                                                            <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="type_three_edit_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{route('edit_question_type_three')}}" method="post" id="edit_question">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                            Edit Question
                                                                        </h5>
                                                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0">
                                                                                <input type="hidden" class="question_id_ed_ty3" name="question_id">
                                                                                <label class="form-label">Heading 1<span class="text-danger">*</span></label>
                                                                                <div class="input-group mb-1">
                                                                                    <span class="input-group-text">A</span>
                                                                                    <textarea class="form-control option_a_ed_ty3" aria-label="With textarea" placeholder="Child Labour (Prohibition and Regulation) Act Year of Legislation" row="10" name="option_a" required></textarea>
                                                                                </div>
                                                                                <div class="input-group mb-1">
                                                                                    <span class="input-group-text">B</span>
                                                                                    <textarea class="form-control option_b_ed_ty3" aria-label="With textarea" placeholder="The Factories Act" row="10" name="option_b" required></textarea>
                                                                                </div>
                                                                                <div class="input-group mb-1">
                                                                                    <span class="input-group-text">C</span>
                                                                                    <textarea class="form-control option_c_ed_ty3" aria-label="With textarea" placeholder="The Mines Act" row="10" name="option_c" required></textarea>
                                                                                </div>
                                                                                <div class="input-group mb-1">
                                                                                    <span class="input-group-text">D</span>
                                                                                    <textarea class="form-control option_d_ed_ty3" aria-label="With textarea" placeholder="The Right of Children to Free and Compulsory Education Act" row="10" name="option_d" required></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0">
                                                                                <label class="form-label">Heading 2<span class="text-danger">*</span></label>
                                                                                <div class="input-group mb-1">
                                                                                    <span class="input-group-text">1</span>
                                                                                    <textarea class="form-control option_1_ed_ty3" aria-label="With textarea" placeholder="1986" row="10" name="option_1" required></textarea>
                                                                                </div>
                                                                                <div class="input-group mb-1">
                                                                                    <span class="input-group-text">2</span>
                                                                                    <textarea class="form-control option_2_ed_ty3" aria-label="With textarea" placeholder="1952" row="10" name="option_2" required></textarea>
                                                                                </div>
                                                                                <div class="input-group mb-1">
                                                                                    <span class="input-group-text">3</span>
                                                                                    <textarea class="form-control option_3_ed_ty3" aria-label="With textarea" placeholder="2009" row="10" name="option_3" required></textarea>
                                                                                </div>
                                                                                <div class="input-group mb-1">
                                                                                    <span class="input-group-text">4</span>
                                                                                    <textarea class="form-control option_4_ed_ty3" aria-label="With textarea" placeholder="1948" row="10" name="option_4" required></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                                                                                <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                <div class="input-group form-check-inline mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" value="a" id="radio1_ed_ty3" required>
                                                                                    </div>
                                                                                    <input type="text" class="form-control choice_1_ed_ty3" placeholder="A-1, B-4, C-2, D-3" name="choice_1" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <div class="input-group  form-check-inline mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" value="b" id="radio2_ed_ty3">
                                                                                    </div>
                                                                                    <input type="text" class="form-control choice_2_ed_ty3" placeholder="A-2, B-4, C-3, D-1" name="choice_2" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <div class="input-group  form-check-inline mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" value="c" id="radio3_ed_ty3" required>
                                                                                    </div>
                                                                                    <input type="text" class="form-control choice_3_ed_ty3" placeholder="A-3, B-2, C-1, D-4" name="choice_3" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <div class="input-group  form-check-inline mb-4">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" value="d" id="radio4_ed_ty3" required>
                                                                                    </div>
                                                                                    <input type="text" class="form-control choice_4_ed_ty3" placeholder="A-4, B-3, C-1, D-2" name="choice_4" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                <select id="smallSelect" name="complexity" required class="form-select form-select-sm complexity_ed_ty3" required>
                                                                                    <option value="">Select</option>
                                                                                    <option value="Easy">Easy</option>
                                                                                    <option value="Medium">Medium</option>
                                                                                    <option value="Hard">Hard</option>
                                                                                </select>
                                                                            </div>
                                                                            <p style="height:4px;"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="type_three_suspend_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalCenterTitle">Delete Question</h5>
                                                                </div>
                                                                <form action="{{route('suspend_question_type_three')}}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <span>Are you sure, you want to Delete this question</span>
                                                                                <input type="hidden" id="question_id_sus_ty3" name="question_id">
                                                                                <input type="hidden" id="status_sus_ty3" name="status">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">
                                                                            No
                                                                        </button>
                                                                        <button type="submit" id="logo_color" class="btn btn-primary">Yes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Fill in the blanks -->
                                                    <div class="modal fade" id="type_four_preview_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                        Preview Question
                                                                    </h5>
                                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">

                                                                        <div class="mb-3 col-lg-8 col-xl-7 col-12 mb-0">
                                                                            <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control question_pr_ty4" id="exampleFormControlTextarea1" name="question" rows="10" disabled></textarea>
                                                                            <input type="hidden" class="question_id_pr_ty4" name="question_id">
                                                                            <input type="hidden" class="question_type_pr_ty4" name="question_type">
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4 col-xl-5 col-12 mb-0">
                                                                            <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                            <div class="input-group form-check-inline mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio1_pr_ty4" value="a" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_a_pr_ty4" name="option_a" placeholder="Choice (A)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group  form-check-inline mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio2_pr_ty4" value="b" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_b_pr_ty4" name="option_b" placeholder="Choice (B)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group  form-check-inline mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio3_pr_ty4" value="c" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_c_pr_ty4" name="option_c" placeholder="Choice (C)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <div class="input-group  form-check-inline mb-3">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio4_pr_ty4" value="d" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_d_pr_ty4" name="option_d" placeholder="Choice (D)" aria-label="Text input with checkbox" disabled>
                                                                            </div>
                                                                            <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                            <select id="smallSelect" class="form-select form-select-sm complexity_pr_ty4" name="complexity" disabled>
                                                                                <option>Select</option>
                                                                                <option value="Easy">Easy</option>
                                                                                <option value="Medium">Medium</option>
                                                                                <option value="Hard">Hard</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="type_four_edit_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{route('edit_question_type_four')}}" method="post" id="edit_question">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                            Edit Question
                                                                        </h5>
                                                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">

                                                                            <div class="mb-3 col-lg-8 col-xl-7 col-12 mb-0">
                                                                                <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                                <textarea class="form-control question_ed_ty4" id="exampleFormControlTextarea1" name="question" rows="10" required></textarea>
                                                                                <input type="hidden" class="question_id_ed_ty4" name="question_id">
                                                                            </div>
                                                                            <div class="mb-3 col-lg-4 col-xl-5 col-12 mb-0">
                                                                                <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                <div class="input-group form-check-inline mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_a_ed_ty4" value="a">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_a_ed_ty4" name="option_a" placeholder="Choice (A)" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <div class="input-group  form-check-inline mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_b_ed_ty4" value="b">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_b_ed_ty4" name="option_b" placeholder="Choice (B)" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <div class="input-group  form-check-inline mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_c_ed_ty4" value="c">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_c_ed_ty4" name="option_c" placeholder="Choice (C)" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <div class="input-group  form-check-inline mb-3">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_d_ed_ty4" value="d">
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_d_ed_ty4" name="option_d" placeholder="Choice (D)" aria-label="Text input with checkbox" required>
                                                                                </div>
                                                                                <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                <select id="smallSelect" class="form-select form-select-sm complexity_ed_ty4" name="complexity" required>
                                                                                    <option>Select</option>
                                                                                    <option value="Easy">Easy</option>
                                                                                    <option value="Medium">Medium</option>
                                                                                    <option value="Hard">Hard</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="modal fade" id="type_four_suspend_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalCenterTitle">Delete Question</h5>
                                                                </div>
                                                                <form action="{{route('suspend_question_type_four')}}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <span>Are you sure, you want to Delete this question</span>
                                                                                <input type="hidden" id="question_id_sus_ty4" name="question_id">
                                                                                <input type="hidden" id="status_sus_ty4" name="status">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">
                                                                            No
                                                                        </button>
                                                                        <button type="submit" id="logo_color" class="btn btn-primary">Yes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- True or False -->
                                                    <div class="modal fade" id="type_five_preview_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                        Preview Question
                                                                    </h5>
                                                                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                                                            <input type="hidden" class="question_id_pr_ty5" name="question_id">
                                                                            <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                            <textarea class="form-control question_pr_ty5" id="exampleFormControlTextarea1" rows="6" disabled></textarea>
                                                                        </div>
                                                                        <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                                                            <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                            <div class="input-group form-check-inline mb-1">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio1_pr_ty5" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_a_pr_ty5" placeholder="True" aria-label="Text input with checkbox" value="TRUE" disabled>
                                                                            </div>
                                                                            <div class="input-group  form-check-inline mb-3">
                                                                                <div class="input-group-text">
                                                                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio2_pr_ty5" disabled>
                                                                                </div>
                                                                                <input type="text" class="form-control option_b_pr_ty5" placeholder="False" aria-label="Text input with checkbox" value="FALSE" disabled>
                                                                            </div>
                                                                            <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                            <select id="smallSelect" name="complexity" class="form-select form-select-sm complexity_pr_ty5" disabled>
                                                                                <option>Select</option>
                                                                                <option value="Easy">Easy</option>
                                                                                <option value="Medium">Medium</option>
                                                                                <option value="Hard">Hard</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="modal fade" id="type_five_edit_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form action="{{route('edit_question_type_five')}}" method="post" id="edit_question">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title mt-3" id="modalCenterTitle">
                                                                            Edit Question
                                                                        </h5>
                                                                        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                                                                <input type="hidden" class="question_id_ed_ty5" name="question_id">
                                                                                <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                                <textarea class="form-control question_ed_ty5" name="question" id="exampleFormControlTextarea1" rows="6" required></textarea>
                                                                            </div>
                                                                            <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                                                                <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                <div class="input-group form-check-inline mb-1">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio1_ed_ty5" value="a" required>
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_a_ed_ty5" name="option_a" placeholder="True" aria-label="Text input with checkbox" value="TRUE" readonly="readonly">
                                                                                </div>
                                                                                <div class="input-group  form-check-inline mb-3">
                                                                                    <div class="input-group-text">
                                                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio2_ed_ty5" value="b" required>
                                                                                    </div>
                                                                                    <input type="text" class="form-control option_b_ed_ty5" name="option_b" placeholder="False" aria-label="Text input with checkbox" value="FALSE" readonly="readonly">
                                                                                </div>
                                                                                <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                <select id="smallSelect" name="complexity" class="form-select form-select-sm complexity_ed_ty5" required>
                                                                                    <option>Select</option>
                                                                                    <option value="Easy">Easy</option>
                                                                                    <option value="Medium">Medium</option>
                                                                                    <option value="Hard">Hard</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade" id="type_five_suspend_modal" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalCenterTitle">Delete Question</h5>
                                                                </div>
                                                                <form action="{{route('suspend_question_type_five')}}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col mb-3">
                                                                                <span>Are you sure, you want to Delete this question</span>
                                                                                <input type="hidden" id="question_id_sus_ty5" name="question_id">
                                                                                <input type="hidden" id="status_sus_ty5" name="status">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">
                                                                            No
                                                                        </button>
                                                                        <button type="submit" id="logo_color" class="btn btn-primary">Yes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                   <div class="tab-pane fade <?php if ($slug == "add_question") {
                                                                    echo 'show active';
                                                                } ?>" id="navs-pills-justified-add-questions" role="tabpanel">
                                        
                                            <div class="row mb-4">
                                                @if(session()->has('success'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('success') }}
                                                </div>
                                                @endif
                                                @if(empty($branch_id) && $user_role_id == 1)
                                                <div class="col-4 mb-3" id="questionbank_branch_div">
                                                    <label for="selectpickerBasic" class="form-label">Branch</label>
                                                    <select id="questionbank_branch" class="selectpicker w-100 questionbank_branches" name="branch_id" data-style="btn-default" required>
                                                        <option value="">Select Branch</option>
                                                        @foreach ($branches as $branch)
                                                        <?php /*if (old('id_branch') == $branch->id)
                                                            $sele = 'selected';
                                                        else
                                                            $sele = '';*/
                                                        echo '<option value="' . $branch->id . '">' . $branch->branch_name . '</option>'; ?>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endif
                                                <div class="col-4 mb-3" id="subject_div" style="display:none;">
                                                    <label for="selectpickerBasic" class="form-label">Subject</label>
                                                    <?php if (old('id_branch')) { 
						$subjects = App\Models\Subject::where('branch_id', old('id_branch'))->where('type', 1)->get();
						} ?>
													<select id="sub_ject"  class="form-control w-100 sub_ject" name="subject_id" data-style="btn-default" required>
                                                        <option value="">Select Subject</option>
                                                        @if(!empty($subjects))
                                                        <?php foreach ($subjects as $subject) {
                                                            if ($subject->id == old('id_subject'))
                                                                $sel = 'selected';
                                                            else
                                                                $sel = '';
                                                            echo '<option ' . $sel . ' value="' . $subject->id . '">' . $subject->subject_name . '</option>';
                                                        } ?>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-4 mb-3" id="lesson_div">
                                                    <label for="selectpickerBasic" class="form-label">Lesson</label>
                                                    <select id="sub_lesson" class="form-control sub_lesson" name="lesson_id" required>
                                                        <option value="">Select Lesson</option>
                                                    </select>
                                                </div>
                                                <div class="col-5 mb-3" id="type_div">
                                                    <label for="selectpickerBasic" class="form-label">Filter by Type</label>
                                                    <select id="filter_type" class="selectpicker w-100 filter_by_type" name="filter_type" data-style="btn-default" required>
                                                        <option value="">Select Questions</option>
                                                        <option value="mcq_1">Multiple Choice Single Answer</option>
                                                        <option value="mcq_2">Multiple Choice Multiple Answers</option>
                                                        <option value="match_following">Match the Following</option>
                                                        <option value="fill_blanks">Fill in the blanks</option>
                                                        <option value="true_false">True or False</option>
                                                        <option value="short_answer">Short Answer</option>
                                                        <option value="order_sequence">Order/Sequencing</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="nav-align-top mb-4 main_div" id="main_div">

                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="navs-pills-justified-manual" role="tabpanel">
                                                        <div class="row mb-4">
                                                            <div class="col-12">
															<!-- 1. Multiple Choice Single Answers -->
															<form id="add_questions" action="{{route('add_question_manual_creation')}}"  method="POST">
															@csrf
															<input type="hidden" name="slug" value="add_question">
															<input type="hidden" name="filter_type" value="mcq_1">
															<input type="hidden" name="id_branch" class="id_branch">
															<input type="hidden" name="id_subject" class="id_subject">
															<input type="hidden" name="id_lesson" class="id_lesson">
                                                                <div id="single_answer">
                                                                    <div class="group-a">
                                                                        <div class="group-b">
                                                                            <div class="row">
                                                                                <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                                                                    <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="questions[]" rows="10" required></textarea>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                                                                    <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                    <div class="input-group form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="radio_option_1" value="a" required>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (A)" name="option_a[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="radio_option_1" value="b">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (B)" name="option_b[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="radio_option_1" value="c">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (C)" name="option_c[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-3">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="radio_option_1" value="d">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (D)" name="option_d[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                    <select id="smallSelect" name="complexity[]" required class="form-select form-select-sm">
                                                                                        <option value="">Select</option>
                                                                                        <option value="Easy">Easy</option>
                                                                                        <option value="Medium">Medium</option>
                                                                                        <option value="Hard">Hard</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                                                                                    <br><a href="javascript:void(0);" class="remove_button" style="pointer-events: none;cursor: default;"><i class="fa-solid fa-circle-minus"></i></a>
                                                                                </div>
                                                                                <hr />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-0">
                                                                        <button type="button" id="logo_color" class="add_button btn btn-primary" style="float: right;">
                                                                            <i class="ti ti-plus me-1"></i>
                                                                            <span class="align-middle">Add</span>
                                                                        </button>
                                                                    </div>
                                                                    <p style="height:4px;"></p>
                                                                    <div class="mt-2">
                                                                        <button type="submit" class="btn btn-primary me-2 mcq_1" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn bg-label-danger">Cancel</button>
                                                                    </div>
                                                                </div>
															</form>
															<!-- 1. Multiple Choice Single Answers -->
															<!-- 2. Multiple Choice Multiple Answers -->
															<form id="add_questions" action="{{route('add_question_manual_creation')}}"  method="POST">
															@csrf
															<input type="hidden" name="slug" value="add_question">
                                                            <input type="hidden" name="filter_type" value="mcq_2">
															<input type="hidden" name="id_branch" class="id_branch">
															<input type="hidden" name="id_subject" class="id_subject">
															<input type="hidden" name="id_lesson" class="id_lesson">
                                                               <div id="multiple_answer">
                                                                    <div class="group-a">
                                                                        <div class="group-b">
                                                                            <div class="row">
                                                                                <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                                                                    <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="questions[]" rows="10" required></textarea>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0 browsers_jp">
                                                                                    <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                    <div class="input-group mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input mt-0" type="checkbox" name="check_box_option_1[]" required value="a" aria-label="Checkbox for following text input" />
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (A)" name="option_a[]" required aria-label="Text input with checkbox" />
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input mt-0" type="checkbox" name="check_box_option_1[]" required value="b" aria-label="Checkbox for following text input" />
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (B)" name="option_b[]" required aria-label="Text input with checkbox" />
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input mt-0" type="checkbox" name="check_box_option_1[]" required value="c" aria-label="Checkbox for following text input" />
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (C)" name="option_c[]" required aria-label="Text input with checkbox" />
                                                                                    </div>
                                                                                    <div class="input-group mb-3">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input mt-0" type="checkbox" name="check_box_option_1[]" required value="d" aria-label="Checkbox for following text input" />
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (D)" name="option_d[]" required aria-label="Text input with checkbox" />
                                                                                    </div>
                                                                                    <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                    <select name="complexity[]" required id="smallSelect" class="form-select form-select-sm">
                                                                                        <option value="">Select</option>
                                                                                        <option value="Easy">Easy</option>
                                                                                        <option value="Medium">Medium</option>
                                                                                        <option value="Hard">Hard</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                                                                                    <br><a href="javascript:void(0);" class="remove_button" style="pointer-events: none;cursor: default;"><i class="fa-solid fa-circle-minus"></i></a>
                                                                                </div>
                                                                                <hr />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-0">
                                                                        <button type="button" id="logo_color" class="add_button btn btn-primary" style="float: right;">
                                                                            <i class="ti ti-plus me-1"></i>
                                                                            <span class="align-middle">Add</span>
                                                                        </button>
                                                                    </div>
                                                                    <p style="height:4px;"></p>
                                                                    <div class="mt-2">
                                                                        <button type="submit" class="btn btn-primary me-2" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn bg-label-danger">Cancel</button>
                                                                    </div>
                                                                </div>
															</form>
															<!-- 2. Multiple Choice Multiple Answers -->
                                                            <!-- 3. Match the Following -->
                                                            <form id="add_questions" action="{{route('add_question_manual_creation')}}"  method="POST">
															@csrf
															<input type="hidden" name="slug" value="add_question">
															<input type="hidden" name="filter_type" value="match_following">
															<input type="hidden" name="id_branch" class="id_branch">
															<input type="hidden" name="id_subject" class="id_subject">
															<input type="hidden" name="id_lesson" class="id_lesson">
                                                              <div id="match_following">
                                                                    <div class="group-a">
                                                                        <div class="group-b">
                                                                            <div class="row">
                                                                                <div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0">
                                                                                    <label class="form-label">Heading 1<span class="text-danger">*</span></label>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">A</span>
                                                                                        <textarea class="form-control" aria-label="With textarea" placeholder="Child Labour (Prohibition and Regulation) Act Year of Legislation" row="10" name="option_a[]" required></textarea>
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">B</span>
                                                                                        <textarea class="form-control" aria-label="With textarea" placeholder="The Factories Act" row="10" name="option_b[]" required></textarea>
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">C</span>
                                                                                        <textarea class="form-control" aria-label="With textarea" placeholder="The Mines Act" row="10" name="option_c[]" required></textarea>
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">D</span>
                                                                                        <textarea class="form-control" aria-label="With textarea" placeholder="The Right of Children to Free and Compulsory Education Act" row="10" name="option_d[]" required></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0">
                                                                                    <label class="form-label">Heading 2<span class="text-danger">*</span></label>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">1</span>
                                                                                        <textarea class="form-control" aria-label="With textarea" placeholder="1986" row="10" name="option_1[]" required></textarea>
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">2</span>
                                                                                        <textarea class="form-control" aria-label="With textarea" placeholder="1952" row="10" name="option_2[]" required></textarea>
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">3</span>
                                                                                        <textarea class="form-control" aria-label="With textarea" placeholder="2009" row="10" name="option_3[]" required></textarea>
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">4</span>
                                                                                        <textarea class="form-control" aria-label="With textarea" placeholder="1948" row="10" name="option_4[]" required></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                                                                                    <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                    <div class="input-group form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions_match_1" required id="inlineRadio_match" value="a">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="A-1, B-4, C-2, D-3" name="choice_1[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions_match_1" id="inlineRadio_match" value="b">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="A-2, B-4, C-3, D-1" name="choice_2[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions_match_1" id="inlineRadio_match" value="c">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="A-3, B-2, C-1, D-4" name="choice_3[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-4">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="inlineRadioOptions_match_1" id="inlineRadio_match" value="d">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="A-4, B-3, C-1, D-2" name="choice_4[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                    <select id="smallSelect" name="complexity[]" required class="form-select form-select-sm">
                                                                                        <option value="">Select</option>
                                                                                        <option value="Easy">Easy</option>
                                                                                        <option value="Medium">Medium</option>
                                                                                        <option value="Hard">Hard</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                                                                                    <br><a href="javascript:void(0);" class="remove_button" style="pointer-events: none;cursor: default;"><i class="fa-solid fa-circle-minus"></i></a>
                                                                                </div>
                                                                                <hr />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-0">
                                                                        <button type="button" id="logo_color" class="add_button btn btn-primary" style="float: right;">
                                                                            <i class="ti ti-plus me-1"></i>
                                                                            <span class="align-middle">Add</span>
                                                                        </button>
                                                                    </div>
                                                                    <p style="height:4px;"></p>
                                                                    <div class="mt-2">
                                                                        <button type="submit" class="btn btn-primary me-2" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn bg-label-danger">Cancel</button>
                                                                    </div>
                                                                </div>
																</form>
															<!-- 3. Match the Following -->
																
														     <!-- 4. Fill in the blanks -->
                                                            <form id="add_questions" action="{{route('add_question_manual_creation')}}"  method="POST">
															@csrf
															<input type="hidden" name="slug" value="add_question">
															<input type="hidden" name="filter_type" value="fill_blanks">
															<input type="hidden" name="id_branch" class="id_branch">
															<input type="hidden" name="id_subject" class="id_subject">
															<input type="hidden" name="id_lesson" class="id_lesson">
                                                                <div id="fill_blanks">
                                                                    <div class="group-a">
                                                                        <div class="group-b">
                                                                            <div class="row">
                                                                                <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                                                                    <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="questions[]" rows="10" required></textarea>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                                                                    <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                    <div class="input-group form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="radio_option_1" value="a" required>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (A)" name="option_a[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="radio_option_1" value="b">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (B)" name="option_b[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="radio_option_1" value="c">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (C)" name="option_c[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-3">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="radio_option_1" value="d">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (D)" name="option_d[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                    <select id="smallSelect" name="complexity[]" required class="form-select form-select-sm">
                                                                                        <option value="">Select</option>
                                                                                        <option value="Easy">Easy</option>
                                                                                        <option value="Medium">Medium</option>
                                                                                        <option value="Hard">Hard</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                                                                                    <br><a href="javascript:void(0);" class="remove_button" style="pointer-events: none;cursor: default;"><i class="fa-solid fa-circle-minus"></i></a>
                                                                                </div>
                                                                                <hr />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-0">
                                                                        <button type="button" id="logo_color" class="add_button btn btn-primary" style="float: right;">
                                                                            <i class="ti ti-plus me-1"></i>
                                                                            <span class="align-middle">Add</span>
                                                                        </button>
                                                                    </div>
                                                                    <p style="height:4px;"></p>
                                                                    <div class="mt-2">
                                                                        <button type="submit" class="btn btn-primary me-2 mcq_1" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn bg-label-danger">Cancel</button>
                                                                    </div>
                                                                </div>
															</form>
															    
															<!-- 4. Fill in the blanks -->	
                                                             <!-- 5.True or False -->
                                                                
															<form id="add_questions" action="{{route('add_question_manual_creation')}}"  method="POST">
															@csrf
															<input type="hidden" name="slug" value="add_question">
															<input type="hidden" name="filter_type" value="true_false">
															<input type="hidden" name="id_branch" class="id_branch">
															<input type="hidden" name="id_subject" class="id_subject">
															<input type="hidden" name="id_lesson" class="id_lesson">
                                                                <div id="true_false">
                                                                    <div class="group-a">
                                                                        <div class="group-b">
                                                                            <div class="row">
                                                                                <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                                                                    <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="questions[]" rows="6" required></textarea>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                                                                    <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                    <div class="input-group form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="radio_option_1" value="a" required>
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (A)" value="True" readonly name="option_a[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="radio_option_1" value="b">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="Choice (B)" value="False" readonly name="option_b[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                                                                                                        <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                    <select id="smallSelect" name="complexity[]" required class="form-select form-select-sm">
                                                                                        <option value="">Select</option>
                                                                                        <option value="Easy">Easy</option>
                                                                                        <option value="Medium">Medium</option>
                                                                                        <option value="Hard">Hard</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                                                                                    <br><a href="javascript:void(0);" class="remove_button" style="pointer-events: none;cursor: default;"><i class="fa-solid fa-circle-minus"></i></a>
                                                                                </div>
                                                                                <hr />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-0">
                                                                        <button type="button" id="logo_color" class="add_button btn btn-primary" style="float: right;">
                                                                            <i class="ti ti-plus me-1"></i>
                                                                            <span class="align-middle">Add</span>
                                                                        </button>
                                                                    </div>
                                                                    <p style="height:4px;"></p>
                                                                    <div class="mt-2">
                                                                        <button type="submit" class="btn btn-primary me-2 mcq_1" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn bg-label-danger">Cancel</button>
                                                                    </div>
                                                                </div>
															</form>
															
																<!-- 5. True or False-->
                                                                <!-- 6. Short answers -->
                                                                <form id="add_questions" action="{{route('add_question_manual_creation')}}"  method="POST">
															@csrf
															<input type="hidden" name="slug" value="add_question">
															<input type="hidden" name="filter_type" value="short_answer">
															<input type="hidden" name="id_branch" class="id_branch">
															<input type="hidden" name="id_subject" class="id_subject">
															<input type="hidden" name="id_lesson" class="id_lesson">
                                                               <div id="short_answer">
                                                                    <div class="group-a">
                                                                        <div class="group-b">
                                                                            <div class="row">
                                                                                <div class="mb-3 col-lg-7 col-xl-4 col-12 mb-0">
                                                                                    <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="questions[]" required></textarea>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                                                                    <label class="form-label">Answer<span class="text-danger">*</span></label>
                                                                                    <textarea class="form-control" id="shortanswer" rows="4" name="answers[]" required></textarea>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                                                                                    <br>
                                                                                    <br>
                                                                                    <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                                                                    <select id="smallSelect" name="complexity[]"required  class="form-select form-select-sm">
                                                                                        <option value="">Select</option>
                                                                                        <option value="Easy">Easy</option>
                                                                                        <option value="Medium">Medium</option>
                                                                                        <option value="Hard">Hard</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                                                                                    <br><a href="javascript:void(0);" class="remove_button" style="pointer-events: none;cursor: default;"><i class="fa-solid fa-circle-minus"></i></a>
                                                                                </div>
                                                                                <hr />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-0">
                                                                        <button type="button" id="logo_color" class="add_button btn btn-primary" style="float: right;">
                                                                            <i class="ti ti-plus me-1"></i>
                                                                            <span class="align-middle">Add</span>
                                                                        </button>
                                                                    </div>
                                                                    <p style="height:4px;"></p>
                                                                    <div class="mt-2">
                                                                        <button type="submit" class="btn btn-primary me-2" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn bg-label-danger">Cancel</button>
                                                                    </div>
                                                                </div>
																</form>
																<!-- 6. Short answers -->	
                                                                <!-- 7. Ordering/Sequences -->
																<form id="add_questions" action="{{route('add_question_manual_creation')}}"  method="POST">
															@csrf
															<input type="hidden" name="slug" value="add_question">
															<input type="hidden" name="filter_type" value="order_sequence">
															<input type="hidden" name="id_branch" class="id_branch">
															<input type="hidden" name="id_subject" class="id_subject">
															<input type="hidden" name="id_lesson" class="id_lesson">
                                                                <div id="order_sequence">
                                                                    <div class="group-a">
                                                                        <div class="group-b">
                                                                            <div class="row">
                                                                                <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                                                                    <label class="form-label">Question<span class="text-danger">*</span></label>
                                                                                    <textarea class="form-control mb-2" name="question_name[]" required id="order_sequenceTextarea1" rows="3" placeholder="Arrange the following steps in the correct order in which they appear in the process of adaptation."></textarea>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">A</span>
                                                                                        <textarea class="form-control" name="option_a[]" required aria-label="With textarea" placeholder="You gradually feel better and decrease sweating."></textarea>
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">B</span>
                                                                                        <textarea class="form-control" name="option_b[]" required aria-label="With textarea" placeholder="Sudden increase in the temperature of the environment."></textarea>
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">C</span>
                                                                                        <textarea class="form-control" name="option_c[]" required aria-label="With textarea" placeholder="Eventually you stop sweating and then feel completely normal."></textarea>
                                                                                    </div>
                                                                                    <div class="input-group mb-1">
                                                                                        <span class="input-group-text">D</span>
                                                                                        <textarea class="form-control" name="option_d[]" required aria-label="With textarea" placeholder="You feel very hot and start sweating."></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                                                                    <label class="form-label">Choices<span class="text-danger">*</span></label>
                                                                                    <div class="input-group form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="inlineRadio_orderOptions_1" required id="inline_orderRadio" value="a">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="A,B,C,D" name="option_1[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="inlineRadio_orderOptions_1" id="inline_orderRadio" value="b">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="B,C,D,A" name="option_2[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-1">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="inlineRadio_orderOptions_1" id="inline_orderRadio" value="c">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="B,D,A,C" name="option_3[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <div class="input-group  form-check-inline mb-4">
                                                                                        <div class="input-group-text">
                                                                                            <input class="form-check-input" type="radio" name="inlineRadio_orderOptions_1" id="inline_orderRadio" value="d">
                                                                                        </div>
                                                                                        <input type="text" class="form-control" placeholder="B,D,C,A" name="option_4[]" required aria-label="Text input with checkbox">
                                                                                    </div>
                                                                                    <label for="defaultSelect" class="form-label mt-4">Difficulty Level</label>
                                                                                    <select id="smallSelect" name="complexity[]" required class="form-select form-select-sm">
                                                                                        <option value="">Select</option>
                                                                                        <option value="Easy">Easy</option>
                                                                                        <option value="Medium">Medium</option>
                                                                                        <option value="Hard">Hard</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                                                                                    <br><a href="javascript:void(0);" class="remove_button" style="pointer-events: none;cursor: default;"><i class="fa-solid fa-circle-minus"></i></a>
                                                                                </div>
                                                                                <hr />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-0">
                                                                        <button type="button" id="logo_color" class="add_button btn btn-primary" style="float: right;">
                                                                            <i class="ti ti-plus me-1"></i>
                                                                            <span class="align-middle">Add</span>
                                                                        </button>
                                                                    </div>
                                                                    <p style="height:4px;"></p>
                                                                    <div class="mt-2">
                                                                        <button type="submit" class="btn btn-primary me-2" id="logo_color">Submit</button>
                                                                        <button type="reset" class="btn bg-label-danger">Cancel</button>
                                                                    </div>
                                                                </div>
																</form>
																<!-- 7. Ordering/Sequences -->
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    
				 <div class="tab-pane fade <?php if($slug=="excel_upload") { echo 'show active';} ?>" id="navs-pills-justified-excel" role="tabpanel">
                          
                      @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
<div id="excel_upload_msg"></div>
<form method="post" action="{{ route('add_question_paper_import_post') }}" enctype="multipart/form-data">
						  @csrf	
						  <input type="hidden" name="slug" value="excel_upload">
						  <div class="row mb-4">
					  @if(empty($branch_id) && $user_role_id == 1)						  
						<div class="col-6 mb-3" id="questionbank_branch_div">
							<label for="selectpickerBasic" class="form-label">Branch</label>
							<select name="branch_id" class="selectpicker w-100 questionbank_branches" data-style="btn-default">
								<option value="">Select Branch</option>
								@foreach ($branches as $branch)
								<?php /*if (old('branch_id') == $branch->id)
									$sele = 'selected';
								else
									$sele = '';*/
								//echo '<option ' . $sele . ' value="' . $branch->id . '">' . $branch->branch_name . '</option>'; 
								echo '<option value="' . $branch->id . '">' . $branch->branch_name . '</option>'; 
								?>
								@endforeach
							</select>
							 @error('branch_id')
							<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						@endif
                      <div class="col-6 mb-3" id="subject_div">
                        <label for="selectpickerBasic" class="form-label">Subject</label>
                        <?php if (old('branch_id')) { 
						$subjects = App\Models\Subject::where('branch_id', old('branch_id'))->where('type', 1)->get();
						} ?>
						<select name="subject_id" class="form-control sub_ject jp">
                          <option value="">Select Subject</option>
                          <?php if($subjects) {
							  foreach($subjects as $subject)
							  {
								  if (old('subject_id') == $subject->id)
									$selec = 'selected';
								else
									$selec = '';
								  ?>
								<option <?php echo $selec; ?> value="{{$subject->id}}">{{ $subject->subject_name }}</option>
							  <?php }
						  } ?>
                        </select>
						@error('subject_id')
						<p class="text-danger">{{ $message }}</p>
						@enderror
                      </div>
                      </div> <div class="row mb-4">
					  <div class="col-6 mb-3" id="lesson_div">
                        <label for="selectpickerBasic" class="form-label">Lesson</label>
						<?php 
						$lessons='';
						if (old('subject_id')) { 
						$lessons = App\Models\Lesson::where('subject_id', old('subject_id'))->where('type', 1)->get();
						} ?>
                        <select name="lesson_id" class="form-control sub_lesson">
                          <option value="">Select Lesson</option>
						  <?php if($lessons) {
							  foreach($lessons as $lesson)
							  {
								  if (old('lesson_id') == $lesson->id)
									$select = 'selected';
								else
									$select = '';
								  ?>
								<option <?php echo $select; ?> value="{{$lesson->id}}">{{ $lesson->lesson_name }}</option>
							  <?php }
						  } ?>
                        </select>
						@error('lesson_id')
						<p class="text-danger">{{ $message }}</p>
						@enderror
                      </div>
                      <!--div class="col-2 mb-3"></div-->
                      <div class="col-6 mb-3" id="type_div">
                        <label for="selectpickerBasic" class="form-label">Filter by Type</label>
                        <select id="filter_type_jp" name="filter_type" class="selectpicker w-100 filter_by_type" data-style="btn-default">
                          <option value="">Select Questions</option>
                          <option <?php if(old('filter_type') == 'mcq_1') { echo 'selected'; } ?> value="mcq_1">Multiple Choice Single Answer</option>
                          <option <?php if(old('filter_type') == 'mcq_2') { echo 'selected'; } ?> value="mcq_2">Multiple Choice Multiple Answers</option>
                          <option <?php if(old('filter_type') == 'match_following') { echo 'selected'; } ?> value="match_following">Match the Following</option>
                          <option <?php if(old('filter_type') == 'fill_blanks') { echo 'selected'; } ?> value="fill_blanks">Fill in the blanks</option>
                          <option <?php if(old('filter_type') == 'true_false') { echo 'selected'; } ?> value="true_false">True or False</option>
                          <option <?php if(old('filter_type') == 'short_answer') { echo 'selected'; } ?> value="short_answer">Short Answer</option>
                          <option <?php if(old('filter_type') == 'order_sequence') { echo 'selected'; } ?> value="order_sequence">Order/Sequencing</option>
                        </select>
						@error('filter_type')
						<p class="text-danger">{{ $message }}</p>
						@enderror
                      </div>
                    </div>
						  <div class="row">
                            <div class="mb-3 col-md-6">
                              <div class="col-md-12" id="upload_btn">
                                <label for="formFile" class="form-label">Assessment Upload</label>
                                <input class="form-control" id="csvFileInput" name="file" type="file" />
                              </div>
							  @error('file')
						<p class="text-danger">{{ $message }}</p>
						@enderror
                            </div>
                            <div class="mb-3 col-md-6">
                              <br>
                              <a style="display:none !important" href="{{ URL::to('/Sample_assessments_mcq1.xlsx') }}" type="button" class="btn btn-label-primary waves-effect" id="downloadButton1" style="float: right;">
                                    <span class="ti-xs ti ti-download me-1"></span>Download Sample File</a>
							 <a style="display:none !important" href="{{ URL::to('/Sample_assessments_mcq2.xlsx') }}" type="button" class="btn btn-label-primary waves-effect" id="downloadButton2" style="float: right;">
                                    <span class="ti-xs ti ti-download me-1"></span>Download Sample File</a>
							<a style="display:none !important" href="{{ URL::to('/Sample_assessments_match.xlsx') }}" type="button" class="btn btn-label-primary waves-effect" id="downloadButton3" style="float: right;">
                                    <span class="ti-xs ti ti-download me-1"></span>Download Sample File</a>
							<a style="display:none !important" href="{{ URL::to('/Sample_assessments_fill_in_the_blanks.xlsx') }}" type="button" class="btn btn-label-primary waves-effect" id="downloadButton4" style="float: right;">
                                    <span class="ti-xs ti ti-download me-1"></span>Download Sample File</a>
							<a style="display:none !important" href="{{ URL::to('/Sample_assessments_True or False.xlsx') }}" type="button" class="btn btn-label-primary waves-effect" id="downloadButton5" style="float: right;">
                                    <span class="ti-xs ti ti-download me-1"></span>Download Sample File</a>
							<a style="display:none !important" href="{{ URL::to('/Sample_assessments_short_questions_answers.xlsx') }}" type="button" class="btn btn-label-primary waves-effect" id="downloadButton6" style="float: right;">
                                    <span class="ti-xs ti ti-download me-1"></span>Download Sample File</a>
							<a style="display:none !important" href="{{ URL::to('/Sample_assessments_Order_sequencing.xlsx') }}" type="button" class="btn btn-label-primary waves-effect" id="downloadButton7" style="float: right;">
                                    <span class="ti-xs ti ti-download me-1"></span>Download Sample File</a>									
                            </div>
                            <div class="col-md-12 mt-4" id="btn_submit">
                              <button type="submit" class="btn btn-primary me-2" id="logo_color" style="float:right;">Preview</button>
							  <button type="button" class="btn btn-primary me-2 clear_temp" id="logo_color" style="float:right;">Clear</button>
                            </div>
                          </div>
						  </form>
						  <!--type 1 - mcg1-->
						  <?php if(old('filter_type')=='mcq_1') { 
						 $all_questions=App\Models\QuestionTypeOneTemp::all();
						 ?>
						 <form id="previewForm" method="POST" action="{{ route('ExcelpreviewUpdate') }}">
						 @csrf
						 <input type="hidden" name="filter_type_new" value="mcq_1">
						 <input type="hidden" name="slug" value="excel_upload">
						 <?php
						 if($all_questions) { ?>
						 <input type="hidden" name="total" value="<?php echo count($all_questions); ?>">
						 <?php foreach($all_questions as $single_question){
						  ?>
						  <div class="group-a">
						  <input type="hidden" name="branch_id[]" value="<?php echo $single_question->branch_id?>">
							<input type="hidden" name="subject_id[]" value="<?php echo $single_question->subject_id?>">
							<input type="hidden" name="lesson_id[]" value="<?php echo $single_question->lesson_id?>">
							<input type="hidden" name="qid[]" value="<?php echo $single_question->id?>">
							
<div class="group-b">
<div class="row">
  <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
	<label class="form-label">Question<span class="text-danger">*</span></label>
	<textarea class="form-control" name="question_name[]" id="exampleFormControlTextarea1" rows="10" required><?php echo $single_question->question_name; ?></textarea>
  </div>
  <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
	<label class="form-label">Choices<span class="text-danger">*</span></label>
	<div class="input-group form-check-inline mb-1">
	  <div class="input-group-text">
		<input class="form-check-input" type="radio" required <?php if( $single_question->option_a==$single_question->answer) { echo 'checked'; } ?> name="inlineRadioOption_<?php echo $single_question->id; ?>" value="a">
	  </div>
	  <input type="text" class="form-control" name="option_a[]" required placeholder="Choice (A)" value="<?php echo $single_question->option_a; ?>">
	</div>
	<div class="input-group  form-check-inline mb-1">
	  <div class="input-group-text">
		<input class="form-check-input" type="radio" <?php if( $single_question->option_b==$single_question->answer) { echo 'checked'; } ?> name="inlineRadioOption_<?php echo $single_question->id; ?>" value="b">
	  </div>
	  <input type="text" class="form-control" name="option_b[]" required placeholder="Choice (B)" value="<?php echo $single_question->option_b; ?>">
	</div>
	<div class="input-group  form-check-inline mb-1">
	  <div class="input-group-text">
		<input class="form-check-input" type="radio" <?php if( $single_question->option_c==$single_question->answer) { echo 'checked'; } ?> name="inlineRadioOption_<?php echo $single_question->id; ?>" value="c">
	  </div>
	  <input type="text" class="form-control" name="option_c[]" required placeholder="Choice (C)" value="<?php echo $single_question->option_c; ?>">
	</div>
	<div class="input-group  form-check-inline mb-3">
	  <div class="input-group-text">
		<input class="form-check-input" type="radio" <?php if( $single_question->option_d==$single_question->answer) { echo 'checked'; } ?> name="inlineRadioOption_<?php echo $single_question->id; ?>" value="d">
	  </div>
	  <input type="text" class="form-control" name="option_d[]" required placeholder="Choice (D)" value="<?php echo $single_question->option_d; ?>">
	</div>
	<label for="defaultSelect" class="form-label">Difficulty Level</label>
	<select id="smallSelect" required name="complexity[]" class="form-select form-select-sm">
	  <option value="">Select</option>
	  <option <?php if( $single_question->complexity=='Easy') { echo 'selected'; } ?> value="Easy">Easy</option>
	  <option <?php if( $single_question->complexity=='Medium') { echo 'selected'; } ?> value="Medium">Medium</option>
	  <option <?php if( $single_question->complexity=='Hard') { echo 'selected'; } ?> value="Hard">Hard</option>
	</select>
	<!--input type="text" class="form-control" placeholder="Answer" value=""-->
  </div>
  <div class="mb-3 col-lg-1 col-xl-2 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button excel_remove_button" data-type="mcq_1" data-id="<?php echo $single_question->id?>"><i class="fa-solid fa-circle-minus"></i></a></div>
  <hr />
</div>
</div>
</div>       

						 <?php }}?>
						 <div class="col-md-12 mt-4" id="btn_submit">
                              <button type="submit" class="btn btn-primary me-2" id="logo_color" style="float:right;">Submit</button>
                            </div>
							</form>
						 <?php } ?>
						 <!--type 1 - mcg1-->
						 <!--type 2 - mcg2-->
						  <?php if(old('filter_type')=='mcq_2') { 
						 $all_questions=App\Models\QuestionTypeTwoTemp::all();
						 ?>
						 <form id="previewForm" method="POST" action="{{ route('ExcelpreviewUpdate') }}">
						 @csrf
						 <input type="hidden" name="filter_type_new" value="mcq_2">
						 <input type="hidden" name="slug" value="excel_upload">
						 <?php
						 if($all_questions) { ?>
						 <input type="hidden" name="total" value="<?php echo count($all_questions); ?>">
						 <?php foreach($all_questions as $single_question){
							 $ans_array=explode(',',$single_question->answer);
						  ?>
						  <div class="group-a">
						  <input type="hidden" name="branch_id[]" value="<?php echo $single_question->branch_id?>">
							<input type="hidden" name="subject_id[]" value="<?php echo $single_question->subject_id?>">
							<input type="hidden" name="lesson_id[]" value="<?php echo $single_question->lesson_id?>">
							<input type="hidden" name="qid[]" value="<?php echo $single_question->id?>">
							<div class="group-b">
							<div class="row">
								<div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
									<label class="form-label">Question<span class="text-danger">*</span></label>
									<textarea class="form-control" id="exampleFormControlTextarea1" name="question_name[]" rows="10" required>{{ $single_question->question_name;  }}</textarea>
								</div>
								<div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
									<label class="form-label">Choices<span class="text-danger">*</span></label>
									<div class="input-group mb-1">
										<div class="input-group-text">
											<input class="form-check-input mt-0" type="checkbox" <?php if(in_array($single_question->option_a,$ans_array)) echo 'checked'; ?> name="inlineCheckBox_<?php echo $single_question->id; ?>[]" value="a" aria-label="Checkbox for following text input" />
										</div>
										<input type="text" class="form-control" placeholder="Choice (A)" required aria-label="Text input with checkbox" name="option_a[]" value="{{ $single_question->option_a}}" />
									</div>
									<div class="input-group mb-1">
										<div class="input-group-text">
											<input class="form-check-input mt-0" type="checkbox" <?php if(in_array($single_question->option_b,$ans_array)) echo 'checked'; ?> name="inlineCheckBox_<?php echo $single_question->id; ?>[]" value="b" aria-label="Checkbox for following text input" />
										</div>
										<input type="text" class="form-control" placeholder="Choice (B)" required aria-label="Text input with checkbox" name="option_b[]" value="{{ $single_question->option_b}}"/>
									</div>
									<div class="input-group mb-1">
										<div class="input-group-text">
											<input class="form-check-input mt-0" type="checkbox" <?php if(in_array($single_question->option_c,$ans_array)) echo 'checked'; ?> name="inlineCheckBox_<?php echo $single_question->id; ?>[]" value="c" aria-label="Checkbox for following text input" />
										</div>
										<input type="text" class="form-control" placeholder="Choice (C)" required aria-label="Text input with checkbox" name="option_c[]" value="{{ $single_question->option_c}}"/>
									</div>
									<div class="input-group mb-3">
										<div class="input-group-text">
											<input class="form-check-input mt-0" type="checkbox" <?php if(in_array($single_question->option_d,$ans_array)) echo 'checked'; ?> name="inlineCheckBox_<?php echo $single_question->id; ?>[]" value="d" aria-label="Checkbox for following text input" />
										</div>
										<input type="text" class="form-control" placeholder="Choice (D)" required aria-label="Text input with checkbox" name="option_d[]" value="{{ $single_question->option_d}}"/>
									</div>
									<label for="defaultSelect" class="form-label">Difficulty Level</label>
									<select id="smallSelect" required name="complexity[]" class="form-select form-select-sm">
										<option value="">Select</option>
										<option <?php if( $single_question->complexity=='Easy') { echo 'selected'; } ?> value="Easy">Easy</option>
										<option <?php if( $single_question->complexity=='Medium') { echo 'selected'; } ?> value="Medium">Medium</option>
										<option <?php if( $single_question->complexity=='Hard') { echo 'selected'; } ?> value="Hard">Hard</option>
									</select>
								</div>
								<div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
									<br><span data-type="mcq_2" data-id="{{ $single_question->id }}" style="cursor: pointer;" class="excel_remove_button remove_button"><i class="fa-solid fa-circle-minus"></i></span>
								</div>
								<hr />
							</div>
						</div>
							</div>       
						 <?php }}?>
						 <div class="col-md-12 mt-4" id="btn_submit">
                              <button type="submit" class="btn btn-primary me-2" id="logo_color" style="float:right;">Submit</button>
                            </div>
							</form>
						 <?php } ?>
						 <!--type 2 - mcg1-->
						 <!--type 3 - match-->
						  <?php if(old('filter_type')=='match_following') { 
						 $all_questions=App\Models\QuestionTypeThreeTemp::all();
						 ?>
						 <form id="previewForm" method="POST" action="{{ route('ExcelpreviewUpdate') }}">
						 @csrf
						 <input type="hidden" name="filter_type_new" value="match_following">
						 <input type="hidden" name="slug" value="excel_upload">
						 <?php
						 if($all_questions) { ?>
						 <input type="hidden" name="total" value="<?php echo count($all_questions); ?>">
						 <?php foreach($all_questions as $single_question){
							 //$ans_array=explode(',',$single_question->answer);
						  ?>
						  <div class="group-a">
						  <input type="hidden" name="branch_id[]" value="<?php echo $single_question->branch_id?>">
							<input type="hidden" name="subject_id[]" value="<?php echo $single_question->subject_id?>">
							<input type="hidden" name="lesson_id[]" value="<?php echo $single_question->lesson_id?>">
							<input type="hidden" name="qid[]" value="<?php echo $single_question->id?>">
							<div class="group-b">
							<div class="row">
								<div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0">
									<label class="form-label">Heading 1<span class="text-danger">*</span></label>
									<div class="input-group mb-1">
										<span class="input-group-text">A</span>
										<textarea class="form-control" aria-label="With textarea" placeholder="Child Labour (Prohibition and Regulation) Act Year of Legislation" required name="option_a[]" row="10"><?php echo $single_question->option_a; ?></textarea>
									</div>
									<div class="input-group mb-1">
										<span class="input-group-text">B</span>
										<textarea class="form-control" aria-label="With textarea" placeholder="The Factories Act" required name="option_b[]" row="10"><?php echo $single_question->option_b; ?></textarea>
									</div>
									<div class="input-group mb-1">
										<span class="input-group-text">C</span>
										<textarea class="form-control" aria-label="With textarea" placeholder="The Mines Act" required name="option_c[]" row="10"><?php echo $single_question->option_c; ?></textarea>
									</div>
									<div class="input-group mb-1">
										<span class="input-group-text">D</span>
										<textarea class="form-control" aria-label="With textarea" placeholder="The Right of Children to Free and Compulsory Education Act" required name="option_d[]" row="10"><?php echo $single_question->option_d; ?></textarea>
									</div>
								</div>
								<div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0">
									<label class="form-label">Heading 2<span class="text-danger">*</span></label>
									<div class="input-group mb-1">
										<span class="input-group-text">1</span>
										<textarea class="form-control" aria-label="With textarea" placeholder="1986" required name="option_1[]" row="10"><?php echo $single_question->option_1; ?></textarea>
									</div>
									<div class="input-group mb-1">
										<span class="input-group-text">2</span>
										<textarea class="form-control" aria-label="With textarea" placeholder="1952" required name="option_2[]"  row="10"><?php echo $single_question->option_2; ?></textarea>
									</div>
									<div class="input-group mb-1">
										<span class="input-group-text">3</span>
										<textarea class="form-control" aria-label="With textarea" placeholder="2009" required name="option_3[]" row="10"><?php echo $single_question->option_3; ?></textarea>
									</div>
									<div class="input-group mb-1">
										<span class="input-group-text">4</span>
										<textarea class="form-control" aria-label="With textarea" placeholder="1948" required name="option_4[]" row="10"><?php echo $single_question->option_4; ?></textarea>
									</div>
								</div>
								<div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
									<label class="form-label">Choices<span class="text-danger">*</span></label>
									<div class="input-group form-check-inline mb-1">
										<div class="input-group-text">
											<input class="form-check-input" type="radio" required name="inlineRadioOptions_match_<?php echo $single_question->id; ?>" <?php if( $single_question->choice_1==$single_question->answer) { echo 'checked'; } ?> id="inlineRadio_match" value="a">
										</div>
										<input type="text" class="form-control" placeholder="A-1, B-4, C-2, D-3" name="choice_1[]" required value="<?php echo $single_question->choice_1; ?>" aria-label="Text input with checkbox">
									</div>
									<div class="input-group  form-check-inline mb-1">
										<div class="input-group-text">
											<input class="form-check-input" type="radio" name="inlineRadioOptions_match_<?php echo $single_question->id; ?>" id="inlineRadio_match" <?php if( $single_question->choice_2==$single_question->answer) { echo 'checked'; } ?> value="b">
										</div>
										<input type="text" class="form-control" placeholder="A-2, B-4, C-3, D-1" name="choice_2[]" required value="<?php echo $single_question->choice_2; ?>" aria-label="Text input with checkbox">
									</div>
									<div class="input-group  form-check-inline mb-1">
										<div class="input-group-text">
											<input class="form-check-input" type="radio" name="inlineRadioOptions_match_<?php echo $single_question->id; ?>" id="inlineRadio_match" <?php if( $single_question->choice_3==$single_question->answer) { echo 'checked'; } ?> value="c">
										</div>
										<input type="text" class="form-control" placeholder="A-3, B-2, C-1, D-4" name="choice_3[]" required value="<?php echo $single_question->choice_3; ?>" aria-label="Text input with checkbox">
									</div>
									<div class="input-group  form-check-inline mb-4">
										<div class="input-group-text">
											<input class="form-check-input" type="radio" name="inlineRadioOptions_match_<?php echo $single_question->id; ?>" id="inlineRadio_match" <?php if( $single_question->choice_4==$single_question->answer) { echo 'checked'; } ?> value="d">
										</div>
										<input type="text" class="form-control" placeholder="A-4, B-3, C-1, D-2" name="choice_4[]" required value="<?php echo $single_question->choice_4; ?>" aria-label="Text input with checkbox">
									</div>
									<label for="defaultSelect" class="form-label">Difficulty Level</label>
									<select id="smallSelect" required name="complexity[]" class="form-select form-select-sm">
										<option value="">Select</option>
										<option <?php if($single_question->complexity=='Easy') { echo 'selected'; }  ?> value="Easy">Easy</option>
										<option <?php if($single_question->complexity=='Medium') { echo 'selected'; }  ?> value="Medium">Medium</option>
										<option <?php if($single_question->complexity=='Hard') { echo 'selected'; }  ?> value="Hard">Hard</option>
									</select>
								</div>
								<div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
									<br><span data-type="match_following" data-id="{{ $single_question->id }}" style="cursor: pointer;" class="excel_remove_button remove_button"><i class="fa-solid fa-circle-minus"></i></span>
								</div>
								<hr />
							</div>
                                                                       
							</div>
							</div>       
						 <?php }}?>
						 <div class="col-md-12 mt-4" id="btn_submit">
                              <button type="submit" class="btn btn-primary me-2" id="logo_color" style="float:right;">Submit</button>
                            </div>
							</form>
						 <?php } ?>
						 <!--type 3 - match-->
						 <!--type 4 - Fill in blanks-->						
						  <?php if(old('filter_type')=='fill_blanks') { 
						 $all_questions=App\Models\QuestionTypeFourTemp::all();
						 ?>
						 <form id="previewForm" method="POST" action="{{ route('ExcelpreviewUpdate') }}">
						 @csrf
						 <input type="hidden" name="filter_type_new" value="fill_blanks">
						 <input type="hidden" name="slug" value="excel_upload">
						 <?php
						 if($all_questions) { ?>
						 <input type="hidden" name="total" value="<?php echo count($all_questions); ?>">
						 <?php foreach($all_questions as $single_question){
						  ?>
						  <div class="group-a">
						  <input type="hidden" name="branch_id[]" value="<?php echo $single_question->branch_id?>">
							<input type="hidden" name="subject_id[]" value="<?php echo $single_question->subject_id?>">
							<input type="hidden" name="lesson_id[]" value="<?php echo $single_question->lesson_id?>">
							<input type="hidden" name="qid[]" value="<?php echo $single_question->id?>">
							
<div class="group-b">
<div class="row">
  <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
	<label class="form-label">Question<span class="text-danger">*</span></label>
	<textarea class="form-control" name="question_name[]" id="exampleFormControlTextarea1" rows="10" required><?php echo $single_question->question_name; ?></textarea>
  </div>
  <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
	<label class="form-label">Choices<span class="text-danger">*</span></label>
	<div class="input-group form-check-inline mb-1">
	  <div class="input-group-text">
		<input class="form-check-input" type="radio" required <?php if( $single_question->option_a==$single_question->answer) { echo 'checked'; } ?> name="inlineRadioOption_<?php echo $single_question->id; ?>" value="a">
	  </div>
	  <input type="text" class="form-control" required name="option_a[]" placeholder="Choice (A)" value="<?php echo $single_question->option_a; ?>">
	</div>
	<div class="input-group  form-check-inline mb-1">
	  <div class="input-group-text">
		<input class="form-check-input" type="radio" <?php if( $single_question->option_b==$single_question->answer) { echo 'checked'; } ?> name="inlineRadioOption_<?php echo $single_question->id; ?>" value="b">
	  </div>
	  <input type="text" class="form-control" required name="option_b[]" placeholder="Choice (B)" value="<?php echo $single_question->option_b; ?>">
	</div>
	<div class="input-group  form-check-inline mb-1">
	  <div class="input-group-text">
		<input class="form-check-input" type="radio" <?php if( $single_question->option_c==$single_question->answer) { echo 'checked'; } ?> name="inlineRadioOption_<?php echo $single_question->id; ?>" value="c">
	  </div>
	  <input type="text" class="form-control" required name="option_c[]" placeholder="Choice (C)" value="<?php echo $single_question->option_c; ?>">
	</div>
	<div class="input-group  form-check-inline mb-3">
	  <div class="input-group-text">
		<input class="form-check-input" type="radio" <?php if( $single_question->option_d==$single_question->answer) { echo 'checked'; } ?> name="inlineRadioOption_<?php echo $single_question->id; ?>" value="d">
	  </div>
	  <input type="text" class="form-control" required name="option_d[]" placeholder="Choice (D)" value="<?php echo $single_question->option_d; ?>">
	</div>
	<label for="defaultSelect" class="form-label">Difficulty Level</label>
	<select id="smallSelect" required name="complexity[]" class="form-select form-select-sm">
	  <option value="">Select</option>
	  <option <?php if( $single_question->complexity=='Easy') { echo 'selected'; } ?> value="Easy">Easy</option>
	  <option <?php if( $single_question->complexity=='Medium') { echo 'selected'; } ?> value="Medium">Medium</option>
	  <option <?php if( $single_question->complexity=='Hard') { echo 'selected'; } ?> value="Hard">Hard</option>
	</select>
	<!--input type="text" class="form-control" placeholder="Answer" value=""-->
  </div>
  <div class="mb-3 col-lg-1 col-xl-2 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button excel_remove_button" data-type="mcq_1" data-id="<?php echo $single_question->id?>"><i class="fa-solid fa-circle-minus"></i></a></div>
  <hr />
</div>
</div>
</div>       

						 <?php }}?>
						 <div class="col-md-12 mt-4" id="btn_submit">
                              <button type="submit" class="btn btn-primary me-2" id="logo_color" style="float:right;">Submit</button>
                            </div>
							</form>
						 <?php } ?>
						 <!--type 4 - Fill in blanks-->
						 <!--type 5 - True or False-->
						  <?php if(old('filter_type')=='true_false') { 
						 $all_questions=App\Models\QuestionTypeFiveTemp::all();
						 ?>
						 <form id="previewForm" method="POST" action="{{ route('ExcelpreviewUpdate') }}">
						 @csrf
						 <input type="hidden" name="filter_type_new" value="true_false">
						 <input type="hidden" name="slug" value="excel_upload">
						 <?php
						 if($all_questions) { ?>
						 <input type="hidden" name="total" value="<?php echo count($all_questions); ?>">
						 <?php foreach($all_questions as $single_question){
						  ?>
						  <div class="group-a">
						  <input type="hidden" name="branch_id[]" value="<?php echo $single_question->branch_id?>">
							<input type="hidden" name="subject_id[]" value="<?php echo $single_question->subject_id?>">
							<input type="hidden" name="lesson_id[]" value="<?php echo $single_question->lesson_id?>">
							<input type="hidden" name="qid[]" value="<?php echo $single_question->id?>">
							
<div class="group-b">
<div class="row">
  <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
	<label class="form-label">Question<span class="text-danger">*</span></label>
	<textarea class="form-control" name="question_name[]" id="exampleFormControlTextarea1" rows="6" required><?php echo $single_question->question_name; ?></textarea>
  </div>
  <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
	<label class="form-label">Choices<span class="text-danger">*</span></label>
	<div class="input-group form-check-inline mb-1">
	  <div class="input-group-text">
		<input class="form-check-input" type="radio" <?php if( $single_question->option_a==$single_question->answer) { echo 'checked'; } ?> name="inlineRadioOption_<?php echo $single_question->id; ?>" required value="<?php echo $single_question->option_a; ?>">
	  </div>
	  <input type="text" class="form-control" name="option_a[]" readonly placeholder="Choice (A)" value="<?php echo $single_question->option_a; ?>">
	</div>
	<div class="input-group  form-check-inline mb-1">
	  <div class="input-group-text">
		<input class="form-check-input" type="radio" <?php if( $single_question->option_b==$single_question->answer) { echo 'checked'; } ?> name="inlineRadioOption_<?php echo $single_question->id; ?>" value="<?php echo $single_question->option_b; ?>">
	  </div>
	  <input type="text" class="form-control" name="option_b[]" readonly placeholder="Choice (B)" value="<?php echo $single_question->option_b; ?>">
	</div>
	
	<label for="defaultSelect" class="form-label">Difficulty Level</label>
	<select required id="smallSelect" name="complexity[]" class="form-select form-select-sm">
	  <option value="">Select</option>
	  <option <?php if( $single_question->complexity=='Easy') { echo 'selected'; } ?> value="Easy">Easy</option>
	  <option <?php if( $single_question->complexity=='Medium') { echo 'selected'; } ?> value="Medium">Medium</option>
	  <option <?php if( $single_question->complexity=='Hard') { echo 'selected'; } ?> value="Hard">Hard</option>
	</select>
	<!--input type="text" class="form-control" placeholder="Answer" value=""-->
  </div>
  <div class="mb-3 col-lg-1 col-xl-2 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button excel_remove_button" data-type="mcq_1" data-id="<?php echo $single_question->id?>"><i class="fa-solid fa-circle-minus"></i></a></div>
  <hr />
</div>
</div>
</div>       

						 <?php }}?>
						 <div class="col-md-12 mt-4" id="btn_submit">
                              <button type="submit" class="btn btn-primary me-2" id="logo_color" style="float:right;">Submit</button>
                            </div>
							</form>
						 <?php } ?>
						 <!--type 5 - True or False-->
						  <!--type 6 - Short Answers-->
						  <?php if(old('filter_type')=='short_answer') { 
						 $all_questions=App\Models\QuestionTypeSixTemp::all();
						 ?>
						 <form id="previewForm" method="POST" action="{{ route('ExcelpreviewUpdate') }}">
						 @csrf
						 <input type="hidden" name="filter_type_new" value="short_answer">
						 <input type="hidden" name="slug" value="excel_upload">
						 <?php
						 if($all_questions) { ?>
						 <input type="hidden" name="total" value="<?php echo count($all_questions); ?>">
						 <?php foreach($all_questions as $single_question){
						  ?>
						  <div class="group-a">
						  <input type="hidden" name="branch_id[]" value="<?php echo $single_question->branch_id?>">
							<input type="hidden" name="subject_id[]" value="<?php echo $single_question->subject_id?>">
							<input type="hidden" name="lesson_id[]" value="<?php echo $single_question->lesson_id?>">
							<input type="hidden" name="qid[]" value="<?php echo $single_question->id?>">
							
						<div class="group-b">
						<div class="row">
						<div class="mb-3 col-lg-7 col-xl-4 col-12 mb-0">
							<label class="form-label">Question<span class="text-danger">*</span></label>
							<textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="question_name[]" required>{{ $single_question->question_name }}</textarea>
						</div>
						<div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
							<label class="form-label">Answer<span class="text-danger">*</span></label>
							<textarea class="form-control" id="shortanswer" rows="4" name="answer[]" required>{{ $single_question->answer }}</textarea>
						</div>
						<div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
							<br>
							<br>
							<label for="defaultSelect" class="form-label">Difficulty Level</label>
							<select id="smallSelect" name="complexity[]" required  class="form-select form-select-sm">
								<option value="">Select</option>
								<option <?php if( $single_question->complexity=='Easy') { echo 'selected'; } ?> value="Easy">Easy</option>
								<option <?php if( $single_question->complexity=='Medium') { echo 'selected'; } ?> value="Medium">Medium</option>
								<option <?php if( $single_question->complexity=='Hard') { echo 'selected'; } ?> value="Hard">Hard</option>
							</select>
						</div>
						<div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
							<br><a href="javascript:void(0);" class="remove_button excel_remove_button"  style="cursor: pointer;"><i class="fa-solid fa-circle-minus"></i></a>
						</div>
						<hr />
					</div>
</div>
</div>       

						 <?php }}?>
						 <div class="col-md-12 mt-4" id="btn_submit">
                              <button type="submit" class="btn btn-primary me-2" id="logo_color" style="float:right;">Submit</button>
                            </div>
							</form>
						 <?php } ?>
						 <!--type 6 - Short Answers-->
						 <!--type 7 - Ordering-->
						  <?php if(old('filter_type')=='order_sequence') { 
						 $all_questions=App\Models\QuestionTypeSevenTemp::all();
						 ?>
						 <form id="previewForm" method="POST" action="{{ route('ExcelpreviewUpdate') }}">
						 @csrf
						 <input type="hidden" name="filter_type_new" value="order_sequence">
						 <input type="hidden" name="slug" value="excel_upload">
						 <?php
						 if($all_questions) { ?>
						 <input type="hidden" name="total" value="<?php echo count($all_questions); ?>">
						 <?php foreach($all_questions as $single_question){
							 //$ans_array=explode(',',$single_question->answer);
						  ?>
						  <div class="group-a">
						  <input type="hidden" name="branch_id[]" value="<?php echo $single_question->branch_id?>">
							<input type="hidden" name="subject_id[]" value="<?php echo $single_question->subject_id?>">
							<input type="hidden" name="lesson_id[]" value="<?php echo $single_question->lesson_id?>">
							<input type="hidden" name="qid[]" value="<?php echo $single_question->id?>">
							<div class="group-b">
						  <div class="row">
							<div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
								<label class="form-label">Question<span class="text-danger">*</span></label>
								<textarea class="form-control mb-2" id="order_sequenceTextarea1" rows="3" name="question_name[]" required placeholder="Arrange the following steps in the correct order in which they appear in the process of adaptation.">{{ $single_question->question_name }}</textarea>
								<div class="input-group mb-1">
									<span class="input-group-text">A</span>
									<textarea class="form-control" aria-label="With textarea" name="option_a[]" required placeholder="You gradually feel better and decrease sweating.">{{ $single_question->option_a }}</textarea>
								</div>
								<div class="input-group mb-1">
									<span class="input-group-text">B</span>
									<textarea class="form-control" aria-label="With textarea" name="option_b[]" required placeholder="Sudden increase in the temperature of the environment.">{{ $single_question->option_b }}</textarea>
								</div>
								<div class="input-group mb-1">
									<span class="input-group-text">C</span>
									<textarea class="form-control" aria-label="With textarea" name="option_c[]" required placeholder="Eventually you stop sweating and then feel completely normal.">{{ $single_question->option_c }}</textarea>
								</div>
								<div class="input-group mb-1">
									<span class="input-group-text">D</span>
									<textarea class="form-control" aria-label="With textarea" name="option_d[]" required placeholder="You feel very hot and start sweating.">{{ $single_question->option_d }}</textarea>
								</div>
							</div>
							<div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
								<label class="form-label">Choices<span class="text-danger">*</span></label>
								<div class="input-group form-check-inline mb-1">
									<div class="input-group-text">
										<input class="form-check-input" type="radio" required name="inlineRadio_orderOptions_<?php echo $single_question->id; ?>" <?php if( $single_question->option_1==$single_question->answer) { echo 'checked'; } ?> id="inline_orderRadio" value="a">
									</div>
									<input type="text" class="form-control" placeholder="A,B,C,D" value="{{ $single_question->option_1 }}" name="option_1[]" required aria-label="Text input with checkbox">
								</div>
								<div class="input-group  form-check-inline mb-1">
									<div class="input-group-text">
										<input class="form-check-input" type="radio" name="inlineRadio_orderOptions_<?php echo $single_question->id; ?>" id="inline_orderRadio" <?php if( $single_question->option_2==$single_question->answer) { echo 'checked'; } ?> value="b">
									</div>
									<input type="text" class="form-control" placeholder="B,C,D,A" value="{{ $single_question->option_2 }}" name="option_2[]" required aria-label="Text input with checkbox">
								</div>
								<div class="input-group  form-check-inline mb-1">
									<div class="input-group-text">
										<input class="form-check-input" type="radio" name="inlineRadio_orderOptions_<?php echo $single_question->id; ?>" id="inline_orderRadio" <?php if( $single_question->option_3==$single_question->answer) { echo 'checked'; } ?> value="c">
									</div>
									<input type="text" class="form-control" placeholder="B,D,A,C" value="{{ $single_question->option_3 }}" name="option_3[]" required aria-label="Text input with checkbox">
								</div>
								<div class="input-group  form-check-inline mb-4">
									<div class="input-group-text">
										<input class="form-check-input" type="radio" name="inlineRadio_orderOptions_<?php echo $single_question->id; ?>" id="inline_orderRadio" <?php if( $single_question->option_4==$single_question->answer) { echo 'checked'; } ?> value="d">
									</div>
									<input type="text" class="form-control" placeholder="B,D,C,A" value="{{ $single_question->option_4 }}" name="option_4[]" required aria-label="Text input with checkbox">
								</div>
								<label for="defaultSelect" class="form-label mt-4">Difficulty Level</label>
								<select name="complexity[]" required id="smallSelect" class="form-select form-select-sm">
									<option value="">Select</option>
									<option <?php if( $single_question->complexity=='Easy') { echo 'selected'; } ?> value="Easy">Easy</option>
									<option <?php if( $single_question->complexity=='Medium') { echo 'selected'; } ?> value="Medium">Medium</option>
									<option <?php if( $single_question->complexity=='Hard') { echo 'selected'; } ?> value="Hard">Hard</option>
								</select>
							</div>
							<div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
								<br><a href="javascript:void(0);" class="remove_button excel_remove_button" style="cursor: pointer;"><i class="fa-solid fa-circle-minus"></i></a>
							</div>
							<hr />
						</div>
                                                                                                            
							</div>
							</div>       
						 <?php }}?>
						 <div class="col-md-12 mt-4" id="btn_submit">
                              <button type="submit" class="btn btn-primary me-2" id="logo_color" style="float:right;">Submit</button>
                            </div>
							</form>
						 <?php } ?>
						 <!--type 7 - Ordering -->
                        </div>
						<!--3rd tab ends here-->
				</div>
              </div>

              <!-- Question Paper Creation -->
              <!--div class="card mb-4" id="questionpaper_creation">
                <h5 id="pagetitle" class="p-3 mb-0">Create a Exam</h5>
                <div class="card-body">
                  <div class="row">
                    <div class="col-4 mb-3">
                      <label for="selectpickerBasic" class="form-label">Classroom</label>
                      <select id="paper_class_room" class="selectpicker w-100" data-style="btn-default">
                        <option value="">Select Classroom</option>
                        <option value="class_1">Classroom 1</option>
                        <option value="class_2">Classroom 2</option>
                      </select>
                    </div>
                    <div class="col-4 mb-3" id="paper_subject_div">
                      <label for="selectpickerBasic" class="form-label">Subject</label>
                      <select id="paper_sub_ject" class="selectpicker w-100" data-style="btn-default">
                        <option value="">Select Subject</option>
                        <option value="class_1">Subject 1</option>
                        <option value="class_2">Subject 2</option>
                      </select>
                    </div>
                    <div class="col-4 mb-3" id="paper_lesson_div">
                      <label for="selectpickerBasic" class="form-label">Lesson</label>
                      <br>
                      <button class="btn btn-success dropdown-toggle w-100" type="button" id="multiSelectDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="text-align: left; float: left; display: block !important; background: transparent !important; border: 1px solid #dbdade !important; color: #777485 !important; box-shadow: none !important; border-radius: 0.375rem !important;">
                        Select
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown" id="paper_sub_lesson" style="padding: 12px;">
                        <li class="mb-1">
                          <label>
                            <input type="checkbox" class="chkPassport" value="1"> Lesson 1
                          </label>
                        </li>
                        <li class="mb-1">
                          <label>
                            <input type="checkbox" class="chkPassport" value="2"> Lesson 2
                          </label>
                        </li>
                        <li class="mb-1">
                          <label>
                            <input type="checkbox" class="chkPassport" value="3"> Lesson 3
                          </label>
                        </li>
                      </ul>
                    </div>
                    <div class="col-12 mb-3" id="paper_type_div">
                      <label for="selectpickerBasic" class="form-label">Filter by Type</label>
                      <div class="optionBox">
                        <div class="block mb-2">
                          <div class="d-flex">
                            <div class="row">
                              <div class="col-3">
                                <select id="smallSelect" class="form-select form-select-sm">
                                  <option value="">Select Lesson</option>
                                  <option value="lesson_1">Lesson 1</option>
                                  <option value="lesson_2">Lesson 2</option>
                                  <option value="lesson_3">Lesson 3</option>
                                  <option value="lesson_4">Lesson 4</option>
                                </select>
                              </div>
                              <div class="col-3">
                                <select id="smallSelect" class="form-select form-select-sm">
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
                                <select id="smallSelect" class="form-select form-select-sm">
                                  <option value="">Difficulty Level</option>
                                  <option value="easy">Easy</option>
                                  <option value="medium">Medium</option>
                                  <option value="hard">Hard</option>
                                </select>
                              </div>
                              <div class="col-2">
                                <input type="text" class="form-control form-control-sm" id="defaultFormControlInput" placeholder="No.Of Questions" aria-describedby="defaultFormControlHelp">
                              </div>
                              <div class="col-1">
                                <span class="badge badge-center rounded-pill bg-label-danger remove" style="position: relative;top: 4px;pointer-events: none;cursor: default;"><i class="ti ti-minus"></i></span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="block">
                          <span class="badge rounded-pill bg-label-success add"><i class="ti ti-plus ti-sm" style="font-size: 11px !important;"></i>&nbsp;Add Option</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-2" id="form_submit">
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="logo_color">Show</button>
                  </div>
                </div>
              </div-->
              <!--div class="card" id="question_paper">
                <div class="card-body">
                  <h5 id="pagetitle">Multiple Choice Single Answer</h5>
                  <div class="row">
                    <div class="mb-3 col-lg-12 col-xl-1 col-12 align-items-center mb-0" style="text-align: center;">
                      <br>
                      <br>
                      <br>
                      <br>
                      <span class="badge badge-center bg-label-dark">1</span>
                    </div>
                    <div class="mb-3 col-lg-7 col-xl-5 col-12 mb-0">
                      <label class="form-label">Question<span class="text-danger">*</span></label>
                      <textarea class="form-control" id="question_8" rows="7"></textarea>
                    </div>
                    <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                      <label class="form-label">Choices<span class="text-danger">*</span></label>
                      <div class="input-group form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option1">
                        </div>
                        <input type="text" class="form-control answer_8" placeholder="Choice (A)" aria-label="Text input with checkbox">
                      </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option2">
                        </div>
                        <input type="text" class="form-control answer_8" placeholder="Choice (B)" aria-label="Text input with checkbox">
                      </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option3">
                        </div>
                        <input type="text" class="form-control answer_8" placeholder="Choice (C)" aria-label="Text input with checkbox">
                      </div>
                      <div class="input-group  form-check-inline mb-1">
                        <div class="input-group-text">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option4">
                        </div>
                        <input type="text" class="form-control answer_8" placeholder="Choice (D)" aria-label="Text input with checkbox">
                      </div>
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 align-items-center mb-0">
                      <br>
                      <br>
                      <br>
                      <br>
                      <button type="button" class="btn btn-sm btn-label-linkedin waves-effect" id="refetch_btn">
                        <i class="tf-icons ti ti-rotate-rectangle ti-xs me-1"></i> Refetch
                      </button>
                    </div>
                    <hr />
                  </div>
                  <h5 id="pagetitle">Short Answer</h5>
                  <div class="row">
                    <div class="mb-3 col-lg-12 col-xl-1 col-12 align-items-center mb-0" style="text-align: center;">
                      <br>
                      <br>
                      <br>
                      <br>
                      <span class="badge badge-center bg-label-dark">2</span>
                    </div>
                    <div class="mb-3 col-lg-7 col-xl-5 col-12 mb-0">
                      <label class="form-label">Question<span class="text-danger">*</span></label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="7"></textarea>
                    </div>
                    <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                      <label class="form-label">Answer<span class="text-danger">*</span></label>
                      <textarea class="form-control" id="shortanswer" rows="7"></textarea>
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 align-items-center mb-0">
                      <br>
                      <br>
                      <br>
                      <br>
                      <button type="button" class="btn btn-sm btn-label-linkedin waves-effect">
                        <i class="tf-icons ti ti-rotate-rectangle ti-xs me-1"></i> Refetch
                      </button>
                    </div>
                    <hr />
                  </div>
                </div>
              </div-->
              <!--div class="card" id="exam_creation">
                <form class="card-body">
                  <div class="row mb-3 g-3">
                    <div class="col-md-6">
                      <label class="form-label" for="multicol-first-name">Exam Name</label>
                      <input type="text" class="form-control" placeholder="Weekly Exam" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="multicol-last-name">Total Marks</label>
                      <input type="number" class="form-control" placeholder="100" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="multicol-last-name">Passing Mark</label>
                      <input type="number" class="form-control" placeholder="50" />
                    </div>
                    <div class="col-md-6">
                      <label for="bs-datepicker-format" class="form-label">Duration</label>
                      <input type="text" id="timepicker-format" placeholder="HH:MM:SS" class="form-control" />
                    </div>

                    <div class="mb-3 col-md-6">
                      <label class="form-label">Exam End Date</label>
                      <input type="text" value="30-05-2024" class="form-control" />
                    </div>
                    <div class="mb-3 col-md-6"></div>

                    <div class="col-md-4">
                      <label for="bs-rangepicker-single" class="form-label">Publish On</label>
                      <input type="text" class="form-control publish_on" placeholder="DD-MM-YYYY HH:MM" id="flatpickr-datetime" />
                    </div>
                    <div class="col-md-1" style="top: 14px;position: relative;">
                      <div class="divider divider-vertical divider-danger">
                        <div class="divider-text">OR</div>
                      </div>
                    </div>
                    <div class="col-md-3" style="top: 33px;position: relative;">
                      <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="chkPassport1">
                        <label class="form-check-label" for="chkPassport1">Publish Now</label>
                      </div>
                    </div>
                  </div>
                  <div class="pt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1" id="logo_color">Submit</button>
                    <button type="reset" class="btn btn-label-danger">Cancel</button>
                  </div>
                </form>
              </div-->
            </div>
            <!--div class="pt-4" style="float: right;">
              <button type="button" class="btn-label-secondary waves-effect previous_button me-3" id="previous_button" style="border-color:transparent !important;background: #eaebec !important; color: #a8aaae !important;">Previous</button>
              <button type="submit" class="btn-primary me-sm-3 me-1 waves-effect waves-light question_paper_cta" id="logo_color" style="float: right;">Next<i class="tf-icons ti ti-chevron-right ti-xs"></i></button>
            </div-->

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
<script>
        $(function(){
    var requiredCheckboxes = $('#multiple_answer .browsers_jp :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});
    </script>
	<script>
	$('#filter_type_jp').change(function()
	{
		var option=$(this).val();
		
		if(option=='mcq_1')
		{
			$('#downloadButton1').css('display','block');
			$('#downloadButton2').attr("style", "display: none !important");
			$('#downloadButton3').attr("style", "display: none !important");
			$('#downloadButton4').attr("style", "display: none !important");
			$('#downloadButton5').attr("style", "display: none !important");
			$('#downloadButton6').attr("style", "display: none !important");
			$('#downloadButton7').attr("style", "display: none !important");
		}
		if(option=='mcq_2')
		{
			$('#downloadButton2').css('display','block');
			$('#downloadButton1').attr("style", "display: none !important");
			$('#downloadButton3').attr("style", "display: none !important");
			$('#downloadButton4').attr("style", "display: none !important");
			$('#downloadButton5').attr("style", "display: none !important");
			$('#downloadButton6').attr("style", "display: none !important");
			$('#downloadButton7').attr("style", "display: none !important");
		}
		if(option=='match_following')
		{
			$('#downloadButton3').css('display','block');
			$('#downloadButton1').attr("style", "display: none !important");
			$('#downloadButton2').attr("style", "display: none !important");
			$('#downloadButton4').attr("style", "display: none !important");
			$('#downloadButton5').attr("style", "display: none !important");
			$('#downloadButton6').attr("style", "display: none !important");
			$('#downloadButton7').attr("style", "display: none !important");
		}
		if(option=='fill_blanks')
		{
			$('#downloadButton4').css('display','block');
			$('#downloadButton1').attr("style", "display: none !important");
			$('#downloadButton2').attr("style", "display: none !important");
			$('#downloadButton3').attr("style", "display: none !important");
			$('#downloadButton5').attr("style", "display: none !important");
			$('#downloadButton6').attr("style", "display: none !important");
			$('#downloadButton7').attr("style", "display: none !important");
		}
		if(option=='true_false')
		{
			$('#downloadButton5').css('display','block');
			$('#downloadButton1').attr("style", "display: none !important");
			$('#downloadButton2').attr("style", "display: none !important");
			$('#downloadButton3').attr("style", "display: none !important");
			$('#downloadButton4').attr("style", "display: none !important");
			$('#downloadButton6').attr("style", "display: none !important");
			$('#downloadButton7').attr("style", "display: none !important");
		}
		if(option=='short_answer')
		{
			$('#downloadButton6').css('display','block');
			$('#downloadButton1').attr("style", "display: none !important");
			$('#downloadButton2').attr("style", "display: none !important");
			$('#downloadButton3').attr("style", "display: none !important");
			$('#downloadButton4').attr("style", "display: none !important");
			$('#downloadButton5').attr("style", "display: none !important");
			$('#downloadButton7').attr("style", "display: none !important");
		}
		if(option=='order_sequence')
		{
			$('#downloadButton7').css('display','block');
			$('#downloadButton1').attr("style", "display: none !important");
			$('#downloadButton2').attr("style", "display: none !important");
			$('#downloadButton3').attr("style", "display: none !important");
			$('#downloadButton4').attr("style", "display: none !important");
			$('#downloadButton5').attr("style", "display: none !important");
			$('#downloadButton6').attr("style", "display: none !important");
		}
		
	});
	</script>
  <script type="text/javascript">
  $(".excel_remove_button").click(function(){
	  
	  var id=$(this).attr('data-id');
	  var type=$(this).attr('data-type');
	 $(this).closest('.group-a').remove();
	   
  });
  $(".clear_temp").click(function(){
	  $.ajax({
		  url:"{{ route('clear_temp') }}",
		  type:'get',		  
		   dataType:'JSON',
		   contentType: false,
		   cache: false,
		   processData: false,		  
		  success:function(response)
		  {
			  $('#excel_upload_msg').show().html('<div class="alert alert-success">'+response['message']+'</div>');	
		  location.reload();
		  }
  });
  });
    $("#chkPassport1").change(function() {
      if (this.checked) {
        $('.publish_on').val('');
      } else {}
    });
$('.questionbank_branches').change(function() {
            var branch_id = $(this).val();
			
			$('input[name="id_branch"]').val(branch_id);
			$('#subject_div').css('display','block');
            $.ajax({
                url: '{{ route("get_subjects_by_branch_id") }}',
                type: 'GET',
                data: {
                    'branch_id': branch_id,
                },
                success: function(response) {
                    var subjects = response['subjects']
                    var select_content = '<option value="">Select Subject</option>';
                    for (i = 0; i < subjects.length; i++) {
                        var subject_id = subjects[i].subject_id;
                        var subject_name = subjects[i].subject_name;
                        select_content = select_content + '<option value="' + subject_id + '">' + subject_name + '</option>';
                    }
                    $('.sub_ject').html(select_content);
                }
            });
        });
    $(".publish_on").on("click", function() {
      if ($('#chkPassport1').is(':checked')) {
        $('#chkPassport1').prop('checked', false);
      }

    });
	$('#filter_type').change(function(){
		var filter=$(this).val();		
		
	});
  </script>

  <script>
    $(document).ready(function() {

      // Refresh Button

      $('#refetch_btn').click(function() {
        $('.answer_8').val('');
        $('#question_8').val('');
      });


      // Exam Creation

      $('#exam_creation').hide();
      $('.previous_button').hide();

      $('.question_paper_cta').click(function() {
        $('#question_paper').hide();
        //$('#questionpaper_creation').hide();
        $('#exam_creation').show();
        $('.previous_button').show();
        $('.question_paper_cta').hide();

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
          } else {
            $('#paper_lesson_div').hide();
          }
        });
      });

      $('.chkPassport').change(function() {
        if ($('.chkPassport:checked').length == 0) {
          $('#paper_type_div').hide();
          $('#form_submit').hide();
        } else {
          $('.chkPassport:checked').each(function() {
            $('#paper_type_div').show();
            $('#form_submit').show();
          });
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
      $('.block:last').before('<div class="block mb-2"><div class="d-flex"><div class="row"><div class="col-3"><select id="smallSelect" class="form-select form-select-sm"><option value="">Select Lesson</option><option value="lesson_1">Lesson 1</option><option value="lesson_2">Lesson 2</option><option value="lesson_3">Lesson 3</option><option value="lesson_4">Lesson 4</option></select></div><div class="col-3"><select id="smallSelect" class="form-select form-select-sm"><option value="">Select Questions</option><option value="mcq_1">Multiple Choice Single Answer</option><option value="mcq_2">Multiple Choice Multiple Answers</option><option value="match_following">Match the Following</option><option value="fill_blanks">Fill in the blanks</option><option value="true_false">True or False</option><option value="short_answer">Short Answer</option><option value="order_sequence">Order/Sequencing</option></select></div><div class="col-3"><select id="smallSelect" class="form-select form-select-sm"><option value="">Difficulty Level</option><option value="easy">Easy</option><option value="medium">Medium</option><option value="hard">Hard</option></select></div><div class="col-2"><input class="form-control form-control-sm" id="defaultFormControlInput" placeholder="No.Of Questions" aria-describedby="defaultFormControlHelp"></div><div class="col-1"><span class="badge badge-center rounded-pill bg-label-danger remove" style="position:relative;top:4px"><i class="ti ti-minus"></i></span></div></div></div></div>');
    });
    $('.optionBox').on('click', '.remove', function() {
      $(this).parent().parent().remove();
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#question_paper').hide();
      $('.question_paper_cta').hide();

      $("#form_submit").click(function() {
        $('#question_paper').show();
        $('.question_paper_cta').show();
      });

    });
    $(document).ready(function() {
      //$('#questionbank_creation').hide();
      $('.main_div').hide();
      $('#back2lists').hide();
      //$('#questionpaper_creation').hide();


      $(".question_bank_creation").click(function() {
        $('#questionbank_creation').show();
        $('.question_bank_creation').hide();
        $('#back2lists').show();

        $('.lists_assessments').hide();
        $('#assessment_lists').hide();
        //$('#questionpaper_creation').hide();
        $('#question_paper').hide();
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
     // $('#upload_btn').hide();
      $('#main_div').hide();
      //$('#btn_submit').hide();
      $('#single_answer').hide();
      $('#multiple_answer').hide();
      $('#fill_blanks').hide();
      $('#true_false').hide();
      $('#short_answer').hide();
      $('#match_following').hide();

      $('.sub_ject').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue1 = $(this).attr("value");
		  $('input[name="id_subject"]').val(optionValue1);
          if (optionValue1) {
            $('#lesson_div').show();
			
			//ajax lessons			  
			   var subject_id=optionValue1;						  
			  $.ajax({
				  url:'{{ route("get_lessons_by_subjects_id") }}',
				  type:'get',
				  data:{'subject_id':subject_id},
				  success:function(response)
				  {
					 var lessons=response['lessons'];					 
					 var select_content='<option value="">Select Lesson</option>';
					 
					  for(i=0;i<lessons.length;i++)
					  {
						 var id=lessons[i].id;
						 var lesson_name=lessons[i].lesson_name;
						select_content=select_content+'<option value="'+id+'">'+lesson_name+'</option>';
					  
					  }
					  
					  $('.sub_lesson').html(select_content);	
					  						  
				  }
			  });
			   //ajax lessons
          } else {
            $('#lesson_div').hide();
          }
        });
      });

      $('#sub_lesson').change(function() {
        $(this).find("option:selected").each(function() {
          var optionValue2 = $(this).attr("value");
		  $('input[name="id_lesson"]').val(optionValue2);
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

      $('#questionbank_subject_div').hide();
      $('#questionbank_lesson_div').hide();
      $('#questionbank_difficulty_div').hide();
      $('#questionbank_type_div').hide();
      $('#questionbank_list').hide();

      $('.question_bank_branch_delete_row').change(function() {
                $(this).find("option:selected").each(function() {
                    $("#question_bank_list tr").remove();

                    var optionValue2 = $(this).attr("value");
                    if (optionValue2) {
                        $('#questionbank_subject_div').show();
                    } else {
                        $('#questionbank_subject_div').hide();
                    }
                });
            });

            $('#questionbank_subject_div').change(function() {
                $(this).find("option:selected").each(function() {

                    $("#question_bank_list tr").remove();

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

                    $("#question_bank_list tr").remove();

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

                    $("#question_bank_list tr").remove();
                    const selectElement = document.querySelector('#questionbank_filter_type');
                    selectElement.selectedIndex = 0;

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

                    $("#question_bank_list tr").remove();

                    var optionValue2 = $(this).attr("value");
                    var branch_id = $('#questionbank_branch').val();
                    var subject_id = $('#questionbank_sub_ject').val();
                    var lesson_id = $('#questionbank_sub_lesson').val();
                    var complexity = $('#questionbank_difficultylevel').val();
                    var question_type = $('#questionbank_filter_type').val();

                    $.ajax({
                        url: '{{ route("list_question") }}',
                        type: 'GET',
                        data: {
                            branch_id: branch_id,
                            subject_id: subject_id,
                            lesson_id: lesson_id,
                            complexity: complexity,
                            question_type: question_type
                        },
                        success: function(response) {
                            console.log(response['question_type']);
                            var items = '';
                            if (response['question_type'] == 'mcq_1') {
                                $.each(response['list_question_type_one'], function(i, item) {
                                    var rows = "<tr>" +
                                        "<td><span data-bs-toggle='modal' data-branch_id='" + item.branch_id + "' data-subject_id='" + item.subject_id + "' data-lesson_id='" + item.lesson_id + "' data-question='" + item.question_name + "' data-option_a='" + item.option_a + "' data-option_b='" + item.option_b + "' data-option_c='" + item.option_c + "' data-option_d='" + item.option_d + "' data-id='" + item.id + "' data-answer='" + item.answer + "' data-complexity='" + item.complexity + "' class='type-one-toggle-preview'><div class='word_ellipsis' id='question_lists' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" + item.question_name + "' style='cursor:pointer;'>" + item.question_name + "</div></span></td>" +
                                        "<td><span data-bs-toggle='modal' data-branch_id='" + item.branch_id + "' data-subject_id='" + item.subject_id + "' data-lesson_id='" + item.lesson_id + "' data-question='" + item.question_name + "' data-option_a='" + item.option_a + "' data-option_b='" + item.option_b + "' data-option_c='" + item.option_c + "' data-option_d='" + item.option_d + "' data-id='" + item.id + "' data-answer='" + item.answer + "' data-complexity='" + item.complexity + "'  class='type-one-toggle-edit' ><span data-bs-toggle='tooltip' data-bs-placement='bottom' title='Edit' class='badge badge-center bg-warning' style='cursor: pointer;'><i class='ti ti-edit'></i></span></span><label>&nbsp;&nbsp;</label><span><span data-bs-toggle='tooltip' data-bs-placement='bottom' title='Delete' class='badge badge-center bg-danger type-one-toggle-suspend' data-question_id='" + item.id + "' data-status='" + item.type + "' style='cursor: pointer;'><i class='ti ti-trash'></i></span></span></td>" +
                                        "</tr>";
                                    $('#question_bank_list tbody').append(rows);
                                })
                            }
                            if (response['question_type'] == 'mcq_2') {
                                console.log(response['question_type']);
                                $.each(response['list_question_type_two'], function(i, item) {
                                    var rows = "<tr>" +
                                        "<td><span data-bs-toggle='modal' data-branch_id='" + item.branch_id + "' data-subject_id='" + item.subject_id + "' data-lesson_id='" + item.lesson_id + "' data-question='" + item.question_name + "' data-option_a='" + item.option_a + "' data-option_b='" + item.option_b + "' data-option_c='" + item.option_c + "' data-option_d='" + item.option_d + "' data-id='" + item.id + "' data-answer='" + item.answer + "' data-complexity='" + item.complexity + "' class='type-two-toggle-preview'><div class='word_ellipsis' id='question_lists' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" + item.question_name + "' style='cursor:pointer;'>" + item.question_name + "</div></span></td>" +
                                        "<td><span data-bs-toggle='modal' data-branch_id='" + item.branch_id + "' data-subject_id='" + item.subject_id + "' data-lesson_id='" + item.lesson_id + "' data-question='" + item.question_name + "' data-option_a='" + item.option_a + "' data-option_b='" + item.option_b + "' data-option_c='" + item.option_c + "' data-option_d='" + item.option_d + "' data-id='" + item.id + "' data-answer='" + item.answer + "' data-complexity='" + item.complexity + "'  class='type-two-toggle-edit'><span data-bs-toggle='tooltip' data-bs-placement='bottom' title='Edit' class='badge badge-center bg-warning' style='cursor: pointer;'><i class='ti ti-edit'></i></span></span><label>&nbsp;&nbsp;</label><span><span data-bs-toggle='tooltip' data-bs-placement='bottom' title='Delete' class='badge badge-center bg-danger type-two-toggle-suspend' data-question_id='" + item.id + "' data-status='" + item.type + "' style='cursor: pointer;'><i class='ti ti-trash'></i></span></span></td>" +
                                        "</tr>";
                                    $('#question_bank_list tbody').append(rows);
                                })
                            }
                            if (response['question_type'] == 'match_following') {
                                $.each(response['list_question_type_three'], function(i, item) {
                                    var rows = "<tr>" +
                                        "<td><span data-bs-toggle='modal' data-branch_id='" + item.branch_id + "' data-subject_id='" + item.subject_id + "' data-lesson_id='" + item.lesson_id + "' data-question='" + item.question_name + "' data-option_a='" + item.option_a + "' data-option_b='" + item.option_b + "' data-option_c='" + item.option_c + "' data-option_d='" + item.option_d + "' data-id='" + item.id + "' data-answer='" + item.answer + "' data-complexity='" + item.complexity + "' data-option_1='" + item.option_1 + "' data-option_2='" + item.option_2 + "' data-option_3='" + item.option_3 + "' data-option_4='" + item.option_4 + "' data-choice_1='" + item.choice_1 + "' data-choice_2='" + item.choice_2 + "' data-choice_3='" + item.choice_3 + "' data-choice_4='" + item.choice_4 + "' class='type-three-toggle-preview'><div class='word_ellipsis' id='question_lists' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" + item.option_a + "' style='cursor:pointer;'>" + item.option_a + "</div></span></td>" +
                                        "<td><span data-bs-toggle='modal' data-branch_id='" + item.branch_id + "' data-subject_id='" + item.subject_id + "' data-lesson_id='" + item.lesson_id + "' data-question='" + item.question_name + "' data-option_a='" + item.option_a + "' data-option_b='" + item.option_b + "' data-option_c='" + item.option_c + "' data-option_d='" + item.option_d + "' data-id='" + item.id + "' data-answer='" + item.answer + "' data-complexity='" + item.complexity + "' data-option_1='" + item.option_1 + "' data-option_2='" + item.option_2 + "' data-option_3='" + item.option_3 + "' data-option_4='" + item.option_4 + "' data-choice_1='" + item.choice_1 + "' data-choice_2='" + item.choice_2 + "' data-choice_3='" + item.choice_3 + "' data-choice_4='" + item.choice_4 + "' class='type-three-toggle-edit'><span data-bs-toggle='tooltip' data-bs-placement='bottom' title='Edit' class='badge badge-center bg-warning' style='cursor: pointer;'><i class='ti ti-edit'></i></span></span><label>&nbsp;&nbsp;</label><span><span data-bs-toggle='tooltip' data-bs-placement='bottom' title='Delete' class='badge badge-center bg-danger type-three-toggle-suspend' data-question_id='" + item.id + "' data-status='" + item.type + "' style='cursor: pointer;'><i class='ti ti-trash'></i></span></span></td>" +
                                        "</tr>";
                                    $('#question_bank_list tbody').append(rows);
                                })
                            }
                            if (response['question_type'] == 'fill_blanks') {
                                console.log(response['question_type']);
                                $.each(response['list_question_type_four'], function(i, item) {
                                    var rows = "<tr>" +
                                        "<td><span data-bs-toggle='modal' data-branch_id='" + item.branch_id + "' data-subject_id='" + item.subject_id + "' data-lesson_id='" + item.lesson_id + "' data-question='" + item.question_name + "' data-option_a='" + item.option_a + "' data-option_b='" + item.option_b + "' data-option_c='" + item.option_c + "' data-option_d='" + item.option_d + "' data-id='" + item.id + "' data-answer='" + item.answer + "' data-complexity='" + item.complexity + "' class='type-four-toggle-preview'><div class='word_ellipsis' id='question_lists' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" + item.question_name + "' style='cursor:pointer;'>" + item.question_name + "</div></span></td>" +
                                        "<td><span data-bs-toggle='modal' data-branch_id='" + item.branch_id + "' data-subject_id='" + item.subject_id + "' data-lesson_id='" + item.lesson_id + "' data-question='" + item.question_name + "' data-option_a='" + item.option_a + "' data-option_b='" + item.option_b + "' data-option_c='" + item.option_c + "' data-option_d='" + item.option_d + "' data-id='" + item.id + "' data-answer='" + item.answer + "' data-complexity='" + item.complexity + "' class='type-four-toggle-edit'><span data-bs-toggle='tooltip' data-bs-placement='bottom' title='Edit' class='badge badge-center bg-warning' style='cursor: pointer;'><i class='ti ti-edit'></i></span></span><label>&nbsp;&nbsp;</label><span><span data-bs-toggle='tooltip' data-bs-placement='bottom' title='Delete' class='badge badge-center bg-danger type-four-toggle-suspend' data-question_id='" + item.id + "' data-status='" + item.type + "' style='cursor: pointer;'><i class='ti ti-trash'></i></span></span></td>" +
                                        "</tr>";
                                    $('#question_bank_list tbody').append(rows);
                                })
                            }
                            if (response['question_type'] == 'true_false') {
                                console.log(response['question_type']);
                                $.each(response['list_question_type_five'], function(i, item) {
                                    var rows = "<tr>" +
                                        "<td><span data-bs-toggle='modal' data-branch_id='" + item.branch_id + "' data-subject_id='" + item.subject_id + "' data-lesson_id='" + item.lesson_id + "' data-question='" + item.question_name + "' data-option_a='" + item.option_a + "' data-option_b='" + item.option_b + "' data-id='" + item.id + "' data-answer='" + item.answer + "' data-complexity='" + item.complexity + "' class='type-five-toggle-preview'><div class='word_ellipsis' id='question_lists' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" + item.question_name + "' style='cursor:pointer;'>" + item.question_name + "</div></span></td>" +
                                        "<td><span data-bs-toggle='modal' data-branch_id='" + item.branch_id + "' data-subject_id='" + item.subject_id + "' data-lesson_id='" + item.lesson_id + "' data-question='" + item.question_name + "' data-option_a='" + item.option_a + "' data-option_b='" + item.option_b + "' data-id='" + item.id + "' data-answer='" + item.answer + "' data-complexity='" + item.complexity + "' class='type-five-toggle-edit'><span data-bs-toggle='tooltip' data-bs-placement='bottom' title='Edit' class='badge badge-center bg-warning' style='cursor: pointer;'><i class='ti ti-edit'></i></span></span><label>&nbsp;&nbsp;</label><span><span data-bs-toggle='tooltip' data-bs-placement='bottom' title='Delete' class='badge badge-center bg-danger type-five-toggle-suspend' data-question_id='" + item.id + "' data-status='" + item.type + "' style='cursor: pointer;'><i class='ti ti-trash'></i></span></span></td>" +
                                        "</tr>";
                                    $('#question_bank_list tbody').append(rows);
                                })
                            }
                        }

                    })
                    if (optionValue2) {
                        $('#questionbank_list').show();
                    } else {
                        $('#questionbank_list').hide();
                    }
                });
            });

        });
    </script>
    <script>
        // Multiple Choice Single Answer edit
        $("#question_bank_list tbody").on("click", ".type-one-toggle-edit", function() {

            var question = $(this).data('question');
            var option_a = $(this).data('option_a');
            var option_b = $(this).data('option_b');
            var option_c = $(this).data('option_c');
            var option_d = $(this).data('option_d');
            var complexity = $(this).data('complexity');
            var id = $(this).data('id');
            var answer = $(this).data('answer');


            $(".question_id_ed_ty1").val(id);

            $(".option_a_ed_ty1").val(option_a);
            $(".option_b_ed_ty1").val(option_b);
            $(".option_c_ed_ty1").val(option_c);
            $(".option_d_ed_ty1").val(option_d);

            if (answer == option_a) {
                document.getElementById('radio_a_ed_ty1').checked = true;
            }
            if (answer == option_b) {
                document.getElementById('radio_b_ed_ty1').checked = true;
            }
            if (answer == option_c) {
                document.getElementById('radio_c_ed_ty1').checked = true;
            }
            if (answer == option_d) {
                document.getElementById('radio_d_ed_ty1').checked = true;
            }

            $(".question_ed_ty1").html($(this).data('question'));

            $('.complexity_ed_ty1').val(complexity);

            $("#type_one_edit_modal").modal('show');
        });
        // Multiple Choice multiple answer edit
        $("#question_bank_list tbody").on("click", ".type-two-toggle-edit", function() {

            var question = $(this).data('question');
            var option_a = $(this).data('option_a');
            var option_b = $(this).data('option_b');
            var option_c = $(this).data('option_c');
            var option_d = $(this).data('option_d');
            var complexity = $(this).data('complexity');
            var id = $(this).data('id');
            var answer = $(this).data('answer');

            $(".question_id_ed_ty2").val(id);

            $(".option_a_ed_ty2").val(option_a);
            $(".option_b_ed_ty2").val(option_b);
            $(".option_c_ed_ty2").val(option_c);
            $(".option_d_ed_ty2").val(option_d);

            var answer_arr = new Array();
            answer_arr = answer.split(',');


            if (answer_arr.includes(option_a.toString()) == true) {
                console.log(answer_arr);
                document.getElementById('check1_ed_ty2').checked = true;
            }
            if (answer_arr.includes(option_b.toString()) == true) {
                document.getElementById('check2_ed_ty2').checked = true;
            }
            if (answer_arr.includes(option_c.toString()) == true) {
                document.getElementById('check3_ed_ty2').checked = true;
            }
            if (answer_arr.includes(option_d.toString()) == true) {
                document.getElementById('check4_ed_ty2').checked = true;
            }

            $(".question_ed_ty2").html($(this).data('question'));

            $('.complexity_ed_ty2').val(complexity);

            $("#type_two_edit_modal").modal('show');
        })

        // Match the Following
        $("#question_bank_list tbody").on("click", ".type-three-toggle-edit", function() {
            var question = $(this).data('question');

            var option_a = $(this).data('option_a');
            var option_b = $(this).data('option_b');
            var option_c = $(this).data('option_c');
            var option_d = $(this).data('option_d');

            var option_1 = $(this).data('option_1');
            var option_2 = $(this).data('option_2');
            var option_3 = $(this).data('option_3');
            var option_4 = $(this).data('option_4');

            var choice_1 = $(this).data('choice_1');
            var choice_2 = $(this).data('choice_2');
            var choice_3 = $(this).data('choice_3');
            var choice_4 = $(this).data('choice_4');

            var complexity = $(this).data('complexity');
            var id = $(this).data('id');
            var answer = $(this).data('answer');

            $(".question_id_ed_ty3").val(id);

            $(".option_a_ed_ty3").val(option_a);
            $(".option_b_ed_ty3").val(option_b);
            $(".option_c_ed_ty3").val(option_c);
            $(".option_d_ed_ty3").val(option_d);

            $(".option_1_ed_ty3").val(option_1);
            $(".option_2_ed_ty3").val(option_2);
            $(".option_3_ed_ty3").val(option_3);
            $(".option_4_ed_ty3").val(option_4);

            $(".choice_1_ed_ty3").val(choice_1);
            $(".choice_2_ed_ty3").val(choice_2);
            $(".choice_3_ed_ty3").val(choice_3);
            $(".choice_4_ed_ty3").val(choice_4);


            if (answer == choice_1) {
                document.getElementById('radio1_ed_ty3').checked = true;
            }
            if (answer == choice_2) {
                document.getElementById('radio2_ed_ty3').checked = true;
            }
            if (answer == choice_3) {
                document.getElementById('radio3_ed_ty3').checked = true;
            }
            if (answer == choice_4) {
                document.getElementById('radio4_ed_ty3').checked = true;
            }

            $('.complexity_ed_ty3').val(complexity);

            $("#type_three_edit_modal").modal('show');
        })

        //Fill in the blanks edit
        $("#question_bank_list tbody").on("click", ".type-four-toggle-edit", function() {

            var branch_id = $(this).data('branch_id');
            var subject_id = $(this).data('subject_id');
            var lesson_id = $(this).data('lesson_id');
            var option_a = $(this).data('option_a');
            var option_b = $(this).data('option_b');
            var option_c = $(this).data('option_c');
            var option_d = $(this).data('option_d');
            var complexity = $(this).data('complexity');
            var id = $(this).data('id');
            var answer = $(this).data('answer');



            $(".question_id_ed_ty4").val(id);

            $(".option_a_ed_ty4").val(option_a);
            $(".option_b_ed_ty4").val(option_b);
            $(".option_c_ed_ty4").val(option_c);
            $(".option_d_ed_ty4").val(option_d);



            if (answer == option_a) {
                document.getElementById('radio_a_ed_ty4').checked = true;
            }
            if (answer == option_b) {
                document.getElementById('radio_b_ed_ty4').checked = true;
            }
            if (answer == option_c) {
                document.getElementById('radio_c_ed_ty4').checked = true;
            }
            if (answer == option_d) {
                document.getElementById('radio_d_ed_ty4').checked = true;
            }


            $(".question_ed_ty4").html($(this).data('question'));
            $('.complexity_ed_ty4').val(complexity);
            $("#type_four_edit_modal").modal('show');
        })
        // True or False edit
        $("#question_bank_list tbody").on("click", ".type-five-toggle-edit", function() {
            var question = $(this).data('question');

            var option_a = $(this).data('option_a');
            var option_b = $(this).data('option_b');

            var complexity = $(this).data('complexity');
            var id = $(this).data('id');
            var answer = $(this).data('answer');


            $(".question_id_ed_ty5").val(id);

            $(".option_a_ed_ty5").val(option_a);
            $(".option_b_ed_ty5").val(option_b);

            if (answer == option_a) {
                document.getElementById('radio1_ed_ty5').checked = true;
            }
            if (answer == option_b) {
                document.getElementById('radio2_ed_ty5').checked = true;
            }



            $(".question_ed_ty5").html($(this).data('question'));

            $('.complexity_ed_ty5').val(complexity);

            $("#type_five_edit_modal").modal('show');
        })
    </script>
    <script>
        // Multiple Choice single answer suspend
        $("#question_bank_list tbody").on("click", ".type-one-toggle-suspend", function() {

            var question_id = $(this).data('question_id');
            var status = $(this).data('status');
            $("#question_id_sus_ty1").val(question_id);
            $("#status_sus_ty1").val(status);
            $("#type_one_suspend_modal").modal('show');
        })

        // Multiple Choice multiple answer suspend
        $("#question_bank_list tbody").on("click", ".type-two-toggle-suspend", function() {

            var question_id = $(this).data('question_id');
            var status = $(this).data('status');
            $("#question_id_sus_ty2").val(question_id);
            $("#status_sus_ty2").val(status);
            $("#type_two_suspend_modal").modal('show');
        })

        // Match the following suspend
        $("#question_bank_list tbody").on("click", ".type-three-toggle-suspend", function() {

            var question_id = $(this).data('question_id');
            var status = $(this).data('status');
            $("#question_id_sus_ty3").val(question_id);
            $("#status_sus_ty3").val(status);
            $("#type_three_suspend_modal").modal('show');
        })

        // Fill in the blanks suspend
        $("#question_bank_list tbody").on("click", ".type-four-toggle-suspend", function() {

            var question_id = $(this).data('question_id');
            var status = $(this).data('status');
            $("#question_id_sus_ty4").val(question_id);
            $("#status_sus_ty4").val(status);
            $("#type_four_suspend_modal").modal('show');
        })

        // True or False suspend
        $("#question_bank_list tbody").on("click", ".type-five-toggle-suspend", function() {

            var question_id = $(this).data('question_id');
            var status = $(this).data('status');
            $("#question_id_sus_ty5").val(question_id);
            $("#status_sus_ty5").val(status);
            $("#type_five_suspend_modal").modal('show');
        })

    </script>
    <script>
        // Multiple Choice single answer prewiew
        $("#question_bank_list tbody").on("click", ".type-one-toggle-preview", function() {
            var question = $(this).data('question');
            var branch_id = $(this).data('branch_id');
            var subject_id = $(this).data('subject_id');
            var lesson_id = $(this).data('lesson_id');
            var option_a = $(this).data('option_a');
            var option_b = $(this).data('option_b');
            var option_c = $(this).data('option_c');
            var option_d = $(this).data('option_d');
            var complexity = $(this).data('complexity');
            var id = $(this).data('id');
            var answer = $(this).data('answer');


            $(".question_id_pr_ty1").val(id);

            $(".option_a_pr_ty1").val(option_a);
            $(".option_b_pr_ty1").val(option_b);
            $(".option_c_pr_ty1").val(option_c);
            $(".option_d_pr_ty1").val(option_d);

            if (answer == option_a) {
                document.getElementById('radio1_pr_ty1').checked = true;
            }
            if (answer == option_b) {
                document.getElementById('radio2_pr_ty1').checked = true;
            }
            if (answer == option_c) {
                document.getElementById('radio3_pr_ty1').checked = true;
            }
            if (answer == option_d) {
                document.getElementById('radio4_pr_ty1').checked = true;
            }



            $(".question_pr_ty1").html($(this).data('question'));

            $('.complexity_pr_ty1').val(complexity);

            $("#type_one_preview_modal").modal('show');
        })

        // Multiple Choice Multiple answer prewiew
        $("#question_bank_list tbody").on("click", ".type-two-toggle-preview", function() {
            var question = $(this).data('question');
            var branch_id = $(this).data('branch_id');
            var subject_id = $(this).data('subject_id');
            var lesson_id = $(this).data('lesson_id');
            var option_a = $(this).data('option_a');
            var option_b = $(this).data('option_b');
            var option_c = $(this).data('option_c');
            var option_d = $(this).data('option_d');
            var complexity = $(this).data('complexity');
            var id = $(this).data('id');
            var answer = $(this).data('answer');

            var answer_arr = new Array();
            answer_arr = answer.split(',');


            $(".question_id_pr_ty2").val(id);

            $(".option_a_pr_ty2").val(option_a);
            $(".option_b_pr_ty2").val(option_b);
            $(".option_c_pr_ty2").val(option_c);
            $(".option_d_pr_ty2").val(option_d);

            if (answer_arr.includes(option_a.toString()) == true) {
                console.log(answer_arr);
                document.getElementById('check1_pr_ty2').checked = true;
            }
            if (answer_arr.includes(option_b.toString()) == true) {
                document.getElementById('check2_pr_ty2').checked = true;
            }
            if (answer_arr.includes(option_c.toString()) == true) {
                document.getElementById('check3_pr_ty2').checked = true;
            }
            if (answer_arr.includes(option_d.toString()) == true) {
                document.getElementById('check4_pr_ty2').checked = true;
            }


            $(".question_pr_ty2").html($(this).data('question'));

            $('.complexity_pr_ty2').val(complexity);

            $("#type_two_preview_modal").modal('show');
        })

        // Match the Following
        $("#question_bank_list tbody").on("click", ".type-three-toggle-preview", function() {
            var question = $(this).data('question');

            var option_a = $(this).data('option_a');
            var option_b = $(this).data('option_b');
            var option_c = $(this).data('option_c');
            var option_d = $(this).data('option_d');

            var option_1 = $(this).data('option_1');
            var option_2 = $(this).data('option_2');
            var option_3 = $(this).data('option_3');
            var option_4 = $(this).data('option_4');

            var choice_1 = $(this).data('choice_1');
            var choice_2 = $(this).data('choice_2');
            var choice_3 = $(this).data('choice_3');
            var choice_4 = $(this).data('choice_4');

            var complexity = $(this).data('complexity');
            var id = $(this).data('id');
            var answer = $(this).data('answer');

            $(".question_id_pr_ty3").val(id);

            $(".option_a_pr_ty3").val(option_a);
            $(".option_b_pr_ty3").val(option_b);
            $(".option_c_pr_ty3").val(option_c);
            $(".option_d_pr_ty3").val(option_d);

            $(".option_1_pr_ty3").val(option_1);
            $(".option_2_pr_ty3").val(option_2);
            $(".option_3_pr_ty3").val(option_3);
            $(".option_4_pr_ty3").val(option_4);

            $(".choice_1_pr_ty3").val(choice_1);
            $(".choice_2_pr_ty3").val(choice_2);
            $(".choice_3_pr_ty3").val(choice_3);
            $(".choice_4_pr_ty3").val(choice_4);



            if (answer == choice_1) {
                document.getElementById('radio1_pr_ty3').checked = true;
            }
            if (answer == choice_2) {
                document.getElementById('radio2_pr_ty3').checked = true;
            }
            if (answer == choice_3) {
                document.getElementById('radio3_pr_ty3').checked = true;
            }
            if (answer == choice_4) {
                document.getElementById('radio4_pr_ty3').checked = true;
            }

            $('.complexity_pr_ty3').val(complexity);

            $("#type_three_preview_modal").modal('show');
        })

        // Fill in the blanks preview
        $("#question_bank_list tbody").on("click", ".type-four-toggle-preview", function() {
            var question = $(this).data('question');
            var branch_id = $(this).data('branch_id');
            var subject_id = $(this).data('subject_id');
            var lesson_id = $(this).data('lesson_id');
            var option_a = $(this).data('option_a');
            var option_b = $(this).data('option_b');
            var option_c = $(this).data('option_c');
            var option_d = $(this).data('option_d');
            var complexity = $(this).data('complexity');
            var id = $(this).data('id');
            var answer = $(this).data('answer');

            $(".question_id_pr_ty4").val(id);

            $(".option_a_pr_ty4").val(option_a);
            $(".option_b_pr_ty4").val(option_b);
            $(".option_c_pr_ty4").val(option_c);
            $(".option_d_pr_ty4").val(option_d);



            if (answer == option_a) {
                document.getElementById('radio1_pr_ty4').checked = true;
            }
            if (answer == option_b) {
                document.getElementById('radio2_pr_ty4').checked = true;
            }
            if (answer == option_c) {
                document.getElementById('radio3_pr_ty4').checked = true;
            }
            if (answer == option_d) {
                document.getElementById('radio4_pr_ty4').checked = true;
            }


            $(".question_pr_ty4").html($(this).data('question'));

            $('.complexity_pr_ty4').val(complexity);

            $("#type_four_preview_modal").modal('show');
        })

        // True or False Preview
        $("#question_bank_list tbody").on("click", ".type-five-toggle-preview", function() {
            var question = $(this).data('question');

            var option_a = $(this).data('option_a');
            var option_b = $(this).data('option_b');

            var complexity = $(this).data('complexity');
            var id = $(this).data('id');
            var answer = $(this).data('answer');


            $(".question_id_pr_ty5").val(id);

            $(".option_a_pr_ty5").val(option_a);
            $(".option_b_pr_ty5").val(option_b);

            if (answer == option_a) {
                document.getElementById('radio1_pr_ty5').checked = true;
            }
            if (answer == option_b) {
                document.getElementById('radio2_pr_ty5').checked = true;
            }



            $(".question_pr_ty5").html($(this).data('question'));

            $('.complexity_pr_ty5').val(complexity);

            $("#type_five_preview_modal").modal('show');
        })
    </script>


  <!-- Multiple Choice Multiple Answers -->
  <script>
    $(document).ready(function() {
      var addButton = $('#multiple_answer .add_button'); //Add button selector
      var wrapper = $('#multiple_answer .group-a'); //Input field wrapper
      
      var x = 1; //Initial field counter is 1

      // Once add button is clicked
      $(addButton).click(function() {
		x++;
		
		var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control" id="exampleFormControlTextarea1" rows="10" required name="questions[]" ></textarea></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0 browsers_jp"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group mb-1"><div class="input-group-text"><input class="form-check-input mt-0" type="checkbox" name="check_box_option_'+x+'[]" value="a"  aria-label="Checkbox for following text input"></div><input class="form-control" name="option_a[]" required placeholder="Choice (A)" aria-label="Text input with checkbox"></div><div class="input-group mb-1"><div class="input-group-text"><input class="form-check-input mt-0" type="checkbox" name="check_box_option_'+x+'[]" value="b" aria-label="Checkbox for following text input"></div><input type="text" name="option_b[]" required class="form-control" placeholder="Choice (B)" aria-label="Text input with checkbox"></div><div class="input-group mb-1"><div class="input-group-text"><input class="form-check-input mt-0" type="checkbox" name="check_box_option_'+x+'[]" value="c" aria-label="Checkbox for following text input"></div><input type="text" name="option_c[]" required class="form-control" placeholder="Choice (C)" aria-label="Text input with checkbox"></div><div class="input-group mb-3"><div class="input-group-text"><input class="form-check-input mt-0" type="checkbox" name="check_box_option_'+x+'[]" value="d"  aria-label="Checkbox for following text input"></div><input type="text" class="form-control" name="option_d[]" required placeholder="Choice (D)" aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label">Difficulty Level</label><select name="complexity[]" required id="smallSelect" class="form-select form-select-sm"><option value="">Select</option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
        $(wrapper).append(fieldHTML); //Add field html
      });

      // Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrease field counter
      });
    });
  </script>

  <!-- Multiple Choice Single Answer -->

  <script>
    $(document).ready(function() {
      var addButton = $('#single_answer .add_button'); //Add button selector
	  //var id=$('#single_answer .add_button').attr("data-id");
	  
      var wrapper = $('#single_answer .group-a'); //Input field wrapper
      
	  //setter
	  var x = 1; //Initial field counter is 1

      // Once add button is clicked
      $(addButton).click(function() {
        var radiobtn = $(fieldHTML).find('.form-check-input').attr('id');
        x++;
		var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control" id="exampleFormControlTextarea1" name="questions[]" rows="10" required></textarea></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="radio_option_'+x+'" value="a" required></div><input class="form-control" name="option_a[]" required placeholder="Choice (A)" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="radio_option_'+x+'" value="b"></div><input class="form-control" placeholder="Choice (B)" name="option_b[]" required aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="radio_option_'+x+'" value="c"></div><input class="form-control" placeholder="Choice (C)" name="option_c[]" required aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-3"><div class="input-group-text"><input class="form-check-input" type="radio" name="radio_option_'+x+'" value="d"></div><input class="form-control" placeholder="Choice (D)" name="option_d[]" required aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label">Difficulty Level</label><select id="smallSelect" name="complexity[]" required class="form-select form-select-sm"><option value="">Select</option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
      
		//$('#single_answer .add_button').attr("data-id", x);
        $(wrapper).append(fieldHTML); //Add field html
        //$(radiobtn).attr('name', 'inlineRadioOptions' + x);
        //$(radiobtn).attr('id', 'inlineRadio' + x);
        //alert(x);
         //alert(radiobtn);
      });

      // Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrease field counter
      });
    });
  </script>
<!-- Match the Following -->

  <script>
    $(document).ready(function() {
      var addButton = $('#match_following .add_button'); //Add button selector
      var wrapper = $('#match_following .group-a'); //Input field wrapper
      
      var x = 1; //Initial field counter is 1

      // Once add button is clicked
      $(addButton).click(function() {
        var radiobtn = $(fieldHTML).find('.form-check-input').attr('id');
        x++;
		var fieldHTML = '<div class="row"><div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0"><label class="form-label">Heading 1<span class="text-danger">*</span></label><div class="input-group mb-1"><span class="input-group-text">A</span><textarea class="form-control" aria-label="With textarea" placeholder="Child Labour (Prohibition and Regulation) Act Year of Legislation" row="10" name="option_a[]" required></textarea></div><div class="input-group mb-1"><span class="input-group-text">B</span><textarea class="form-control" aria-label="With textarea" placeholder="The Factories Act" row="10" name="option_b[]" required></textarea></div><div class="input-group mb-1"><span class="input-group-text">C</span><textarea class="form-control" aria-label="With textarea" placeholder="The Mines Act" row="10" name="option_c[]" required></textarea></div><div class="input-group mb-1"><span class="input-group-text">D</span><textarea class="form-control" aria-label="With textarea" placeholder="The Right of Children to Free and Compulsory Education Act" row="10" name="option_d[]" required></textarea></div></div><div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0"><label class="form-label">Heading 2<span class="text-danger">*</span></label><div class="input-group mb-1"><span class="input-group-text">1</span><textarea class="form-control" aria-label="With textarea" placeholder="1986" row="10" name="option_1[]" required></textarea></div><div class="input-group mb-1"><span class="input-group-text">2</span><textarea class="form-control" aria-label="With textarea" placeholder="1952" row="10" name="option_2[]" required></textarea></div><div class="input-group mb-1"><span class="input-group-text">3</span><textarea class="form-control" aria-label="With textarea" placeholder="2009" row="10" name="option_3[]" required></textarea></div><div class="input-group mb-1"><span class="input-group-text">4</span><textarea class="form-control" aria-label="With textarea" placeholder="1948" row="10" name="option_4[]" required></textarea></div></div><div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions_match_'+x+'" required id="inlineRadio_match1" value="a"></div><input class="form-control" placeholder="A-1, B-4, C-2, D-3" aria-label="Text input with checkbox" name="choice_1[]" required></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions_match_'+x+'" id="inlineRadio_match1" value="b"></div><input class="form-control" placeholder="A-2, B-4, C-3, D-1" aria-label="Text input with checkbox" name="choice_2[]" required></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions_match_'+x+'" id="inlineRadio_match" value="c"></div><input class="form-control" placeholder="A-3, B-2, C-1, D-4" name="choice_3[]" required aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-4"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions_match_'+x+'" id="inlineRadio_match1" value="d"></div><input class="form-control" placeholder="A-4, B-3, C-1, D-2" name="choice_4[]" required aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label">Difficulty Level</label><select name="complexity[]" required id="smallSelect" class="form-select form-select-sm"><option value="">Select</option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
        $(wrapper).append(fieldHTML); //Add field html
        $(radiobtn).attr('name', 'inlineRadioOptions' + x);
        $(radiobtn).attr('id', 'inlineRadio' + x);
        // alert(x);
        // alert(radiobtn);
      });

      // Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrease field counter
      });
    });
  </script>
  <!-- Fill in the Blanks -->

  <script>
    $(document).ready(function() {
      var addButton = $('#fill_blanks .add_button'); //Add button selector
      var wrapper = $('#fill_blanks .group-a'); //Input field wrapper
      
      var x = 1; //Initial field counter is 1

      // Once add button is clicked
      $(addButton).click(function() {
        var radiobtn = $(fieldHTML).find('.form-check-input').attr('id');
        x++;
		var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control" id="exampleFormControlTextarea1" name="questions[]" rows="10" required></textarea></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="radio_option_'+x+'" value="a" required></div><input class="form-control" name="option_a[]" required placeholder="Choice (A)" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="radio_option_'+x+'" value="b"></div><input class="form-control" placeholder="Choice (B)" name="option_b[]" required aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="radio_option_'+x+'" value="c"></div><input class="form-control" placeholder="Choice (C)" name="option_c[]" required aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-3"><div class="input-group-text"><input class="form-check-input" type="radio" name="radio_option_'+x+'" value="d"></div><input class="form-control" placeholder="Choice (D)" name="option_d[]" required aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label">Difficulty Level</label><select id="smallSelect" name="complexity[]" required class="form-select form-select-sm"><option value="">Select</option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
        $(wrapper).append(fieldHTML); //Add field html
        $(radiobtn).attr('name', 'inlineRadioOptions' + x);
        $(radiobtn).attr('id', 'inlineRadio' + x);
        // alert(x);
        // alert(radiobtn);
      });

      // Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrease field counter
      });
    });
  </script>

  <!-- True or False -->

  <script>
    $(document).ready(function() {
      var addButton = $('#true_false .add_button'); //Add button selector
      var wrapper = $('#true_false .group-a'); //Input field wrapper
      
      var x = 1; //Initial field counter is 1

      // Once add button is clicked
      $(addButton).click(function() {
        var radiobtn = $(fieldHTML).find('.form-check-input').attr('id');
        x++;
		var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="questions[]" required></textarea></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="radio_option_'+x+'" id="inline_trueRadio" value="a" required></div><input class="form-control" name="option_a[]" readonly value="True" required placeholder="True" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-3"><div class="input-group-text"><input class="form-check-input" type="radio" name="radio_option_'+x+'" id="inline_trueRadio" value="b"></div><input class="form-control" placeholder="False" value="False" readonly name="option_b[]" required aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label">Difficulty Level</label><select name="complexity[]" required id="smallSelect" class="form-select form-select-sm"><option value="">Select</option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
        $(wrapper).append(fieldHTML); //Add field html
        $(radiobtn).attr('name', 'inlineRadioOptions' + x);
        $(radiobtn).attr('id', 'inlineRadio' + x);
        // alert(x);
        // alert(radiobtn);
      });

      // Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrease field counter
      });
    });
  </script>

  <!-- Short Answer -->

  <script>
    $(document).ready(function() {
      var addButton = $('#short_answer .add_button'); //Add button selector
      var wrapper = $('#short_answer .group-a'); //Input field wrapper
      var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-4 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control" id="exampleFormControlTextarea1" name="questions[]" required rows="4"></textarea></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Answer<span class="text-danger">*</span></label><textarea class="form-control" id="shortanswer" name="answers[]" required rows="4"></textarea></div><div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0"><br><br><label for="defaultSelect" class="form-label">Difficulty Level</label><select id="smallSelect" name="complexity[]" required class="form-select form-select-sm"><option value="">Select</option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
      var x = 1; //Initial field counter is 1

      // Once add button is clicked
      $(addButton).click(function() {
        var radiobtn = $(fieldHTML).find('.form-check-input').attr('id');
        x++;
        $(wrapper).append(fieldHTML); //Add field html
        $(radiobtn).attr('name', 'inlineRadioOptions' + x);
        $(radiobtn).attr('id', 'inlineRadio' + x);
        // alert(x);
        // alert(radiobtn);
      });

      // Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrease field counter
      });
    });
  </script>

  

  <!-- Order/Sequencing -->

  <script>
    $(document).ready(function() {
      var addButton = $('#order_sequence .add_button'); //Add button selector
      var wrapper = $('#order_sequence .group-a'); //Input field wrapper
      
      var x = 1; //Initial field counter is 1

      // Once add button is clicked
      $(addButton).click(function() {
        var radiobtn = $(fieldHTML).find('.form-check-input').attr('id');
        x++;
		var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control mb-2" id="order_sequenceTextarea1" name="question_name[]" required rows="3" placeholder="Arrange the following steps in the correct order in which they appear in the process of adaptation."></textarea><div class="input-group mb-1"><span class="input-group-text">A</span><textarea name="option_a[]" required class="form-control" aria-label="With textarea" placeholder="You gradually feel better and decrease sweating."></textarea></div><div class="input-group mb-1"><span class="input-group-text">B</span><textarea class="form-control" name="option_b[]" required aria-label="With textarea" placeholder="Sudden increase in the temperature of the environment."></textarea></div><div class="input-group mb-1"><span class="input-group-text">C</span><textarea name="option_c[]" required class="form-control" aria-label="With textarea" placeholder="Eventually you stop sweating and then feel completely normal."></textarea></div><div class="input-group mb-1"><span class="input-group-text">D</span><textarea name="option_d[]" required class="form-control" aria-label="With textarea" placeholder="You feel very hot and start sweating."></textarea></div></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_orderOptions_'+x+'" id="inline_orderRadio" value="a" required></div><input class="form-control" name="option_1[]" required placeholder="A,B,C,D" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_orderOptions_'+x+'" id="inline_orderRadio" value="b"></div><input name="option_2[]" required class="form-control" placeholder="B,C,D,A" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_orderOptions_'+x+'" id="inline_orderRadio" value="c"></div><input name="option_3[]" required class="form-control" placeholder="B,D,A,C" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-4"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_orderOptions_'+x+'" id="inline_orderRadio" value="d"></div><input class="form-control" name="option_4[]" required  placeholder="B,D,C,A" aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label mt-4">Difficulty Level</label><select name="complexity[]" required id="smallSelect" class="form-select form-select-sm"><option value="">Select</option><option value="Easy">Easy</option><option value="Medium">Medium</option><option value="Hard">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
        $(wrapper).append(fieldHTML); //Add field html
        $(radiobtn).attr('name', 'inlineRadioOptions' + x);
        $(radiobtn).attr('id', 'inlineRadio' + x);
        // alert(x);
        // alert(radiobtn);
      });

      // Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrease field counter
      });
    });
  </script>




  <script src="assets/js/form-input-group.js"></script>
  <script>
   /* document.getElementById("downloadButton").addEventListener("click", function() {
      // Create an anchor element
      var downloadLink = document.createElement("a");
      downloadLink.href = "Sample_assessments.xlsx"; // Replace with the path to your file
      downloadLink.download = "filename.pdf"; // Replace with the desired filename for the downloaded file
      downloadLink.click();
    });*/
  </script>
  <script>
    new DataTable('#example', {
      scrollX: true
    });

    new DataTable('#question_bank_list', {
      scrollX: true
    });
  </script>


</body>

</html>
