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
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                <div class="d-flex flex-column justify-content-center">
                  <h4 id="pagetitle" class="mb-0 lists_assessments">Assessment Lists</h4>
                  <a href="admin_assessments.html" id="back2lists">
                    <button class="btn btn-label-secondary btn-prev waves-effect">
                      <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                      <span class="align-middle d-sm-inline-block d-none">Back to Lists</span>
                    </button>
                  </a>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-3">
                  <div class="d-flex gap-3">
                    <a href="{{ route('question_bank','all_questions') }}" class="btn_design btn-primary question_bank_creation" id="logo_color" type="button">
                      <span>
                        <i class="ti ti-brand-python me-0 me-sm-1 ti-xs"></i>
                        <span class="d-none d-sm-inline-block">Question Bank</span>
                      </span>
                    </a>
                    <a href="{{ route('create_exam') }}" class="btn_design btn-primary question_paper_creation" id="logo_color" type="button">
                      <span>
                        <i class="ti ti-file-pencil me-0 me-sm-1 ti-xs"></i>
                        <span class="d-none d-sm-inline-block">Exam Creation</span>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
              <!-- Assessment Lists -->
              <div class="card col-12" id="assessment_lists">
                <div class="card-body table_admin text-nowrap">
                  <table id="example" class="display" style="width:100%">
                    <thead>
                      <tr style="background-color: #f5c6cb30;">
                        <th>Exam Name</th>
                        <th>Classroom</th>
                        <th>Subject Name</th>
                        <th>Total Marks</th>
                        <th>Duration</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <span data-bs-toggle="modal" data-bs-target="#exam_preview">
                            <div class="word_ellipsis" id="exam_lists" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Question 1" style="cursor:pointer;">Exam 1</div>
                          </span>
                        </td>
                        <td>Classroom 1</td>
                        <td>Subject 1</td>
                        <td>50/100</td>
                        <td>1 hour</td>
                        <td>30-05-2024</td>
                        <td>
                          <span class="badge bg-label-warning me-1" style="cursor: pointer;">
                            <span  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unpublish">Unpublish</span>
                          </span>
                        </td>
                        <td>
                          <span data-bs-toggle="modal" data-bs-target="#questionlist_preview">
                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Preview" class="badge badge-center bg-primary" style="cursor: pointer;">
                              <i class="ti ti-eye"></i>
                            </span>
                          <div class="modal fade" id="questionlist_preview" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title mt-3" id="modalCenterTitle">
                                          Exam 1
                                        </h5>
                                </div>
                                <div class="modal-body" style="text-align:left;">
                                  <div class="row mb-3 g-3">
                                    <div class="col-md-6">
                                      <label class="form-label" for="multicol-first-name">Classroom</label>
                                      <input type="text" class="form-control" value="Classroom 1" readonly />
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label" for="multicol-first-name">Subject</label>
                                      <input type="text" class="form-control" value="Subject 1" readonly />
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label" for="multicol-last-name">Total Marks</label>
                                      <input type="text" class="form-control" value="100" readonly />
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label" for="multicol-last-name">Passing Mark</label>
                                      <input type="text" class="form-control" value="50" readonly />
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">Exam End Date</label>
                                      <input type="text" value="30-05-2024" class="form-control" readonly />
                                    </div>
                                    <div class="col-md-6">
                                      <label for="bs-datepicker-format" class="form-label">Duration</label>
                                      <input type="text" value="01:00:00" class="form-control" readonly />
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                  <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          </span>
                          <span data-bs-toggle="modal" data-bs-target="#publish_question">
                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" class="badge badge-center bg-success" style="cursor: pointer;" aria-label="Unpublish" data-bs-original-title="Unpublish">
                              <i class="ti ti-share-off"></i>
                            </span>
                          <div class="modal fade" id="publish_question" tabindex="-1" aria-hidden="true" style="text-align: left;">
                            <div class="modal-dialog modal-sm" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalCenterTitle" style="text-align: center;">
                                      Exam 1
                                    </h5>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="mb-3 col-md-12">
                                      <label for="bs-rangepicker-single" class="form-label">Publish On</label>
                                      <input type="text" class="form-control publishon_question" placeholder="DD-MM-YYYY HH:MM" id="flatpickr-datetime" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                      <label class="form-label">Exam End Date</label>
                                      <input type="text" value="30-05-2024" class="form-control" />
                                    </div>
                                  </div>
                                  <div class="divider">
                                    <div class="divider-text">OR</div>
                                  </div>
                                  <div class="row">
                                    <div class="col mb-2">
                                      <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="publishnow_questionn">
                                        <label class="form-check-label" for="publishnow_questionn">Publish Now</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">
                                    Close
                                  </button>
                                  <button type="button" id="logo_color" class="btn btn-primary btn_submit">Submit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          </span>

                          <span data-bs-toggle="modal" data-bs-target="#questionlist_edit">
                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning" style="cursor: pointer;">
                              <i class="ti ti-edit"></i>
                            </span>
                          </span>
                          <div class="modal fade" id="questionlist_edit" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title mt-3" id="modalCenterTitle">
                                        Exam 1
                                      </h5>
                                  <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                </div>
                                <div class="modal-body" style="text-align:left;">
                                  <div class="row mb-3 g-3">
                                    <div class="col-md-6">
                                      <label class="form-label" for="multicol-first-name">Classroom</label>
                                      <input type="text" class="form-control" value="Classroom 1" />
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label" for="multicol-first-name">Subject</label>
                                      <input type="text" class="form-control" value="Subject 1" readonly />
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label" for="multicol-last-name">Total Marks</label>
                                      <input type="number" class="form-control" value="100" />
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label" for="multicol-last-name">Passing Mark</label>
                                      <input type="number" class="form-control" value="50" />
                                    </div>
                                    <div class="col-md-6">
                                      <label class="form-label">Exam End Date</label>
                                      <input type="text" value="30-05-2024" class="form-control" />
                                    </div>
                                    <div class="col-md-6">
                                      <label for="bs-datepicker-format" class="form-label">Duration</label>
                                      <input type="text" id="timepicker-format" value="01:00:00" class="form-control" />
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                  <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <span>
                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" class="badge badge-center bg-danger" style="cursor: pointer;">
                              <i class="ti ti-trash"></i>
                            </span>
                          </span>
                        </td>
                      </tr>
                  </table>
                </div>
              </div>

              <!-- Question Bank Creation -->
              <div class="nav-align-top mb-4" id="questionbank_creation">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                  <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-question-bank" aria-controls="navs-pills-justified-question-bank" aria-selected="true">
                      <i class="tf-icons ti ti-adjustments-question ti-xs me-1"></i> Question Bank
                    </button>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('question_bank','add_question')}}" class="nav-link">
                      <i class="tf-icons ti ti-new-section ti-xs me-1"></i> Add Questions
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="navs-pills-justified-question-bank" role="tabpanel">
                    <div class="row">
                      <div class="col-4 mb-3" id="questionbank_subject_div">
                        <label for="selectpickerBasic" class="form-label">Subject</label>
                        <select id="questionbank_sub_ject" class="selectpicker w-100" data-style="btn-default">
                          <option value="">Select Subject</option>
                          <option value="class_1">Subject 1</option>
                          <option value="class_2">Subject 2</option>
                        </select>
                      </div>
                      <div class="col-4 mb-3" id="questionbank_lesson_div">
                        <label for="selectpickerBasic" class="form-label">Lesson</label>
                        <select id="questionbank_sub_lesson" class="selectpicker w-100" data-style="btn-default">
                          <option value="">Select Lesson</option>
                          <option value="class_1">Lesson 1</option>
                          <option value="class_2">Lesson 2</option>
                        </select>
                      </div>
                      <div class="col-4 mb-3" id="questionbank_difficulty_div">
                        <label for="selectpickerBasic" class="form-label">Difficulty Level</label>
                        <select id="questionbank_difficultylevel" class="selectpicker w-100" data-style="btn-default">
                          <option value="">Select Difficulty Level</option>
                          <option value="class_1">Easy</option>
                          <option value="class_2">Medium</option>
                          <option value="class_2">Hard</option>
                        </select>
                      </div>
                      <div class="col-5 mb-3" id="questionbank_type_div">
                        <label for="selectpickerBasic" class="form-label">Filter by Type</label>
                        <select id="questionbank_filter_type" class="selectpicker w-100 filter_by_type" data-style="btn-default">
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
                    <hr/>
                    <div id="questionbank_list" class="table_admin">
                      <table id="question_bank_list" class="display" style="width:100%">
                        <thead>
                          <tr style="background-color: #f5c6cb30;">
                            <th>Question</th>
                            <th>Difficulty Level</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <span data-bs-toggle="modal" data-bs-target="#questionbank_preview">
                                <div class="word_ellipsis" id="question_lists" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Question 1" style="cursor:pointer;">Question 1</div>
                              </span>
                            </td>
                            <td>Easy</td>
                            <td>
                              <span data-bs-toggle="modal" data-bs-target="#questionbank_preview">
                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning" style="cursor: pointer;">
                                  <i class="ti ti-edit"></i>
                                </span>
                              </span>

                              <div class="modal fade" id="questionbank_preview" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title mt-3" id="modalCenterTitle">
                                        Question 1
                                      </h5>
                                      <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="mb-3 col-lg-8 col-xl-7 col-12 mb-0">
                                          <label class="form-label">Question<span class="text-danger">*</span></label>
                                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-xl-5 col-12 mb-0">
                                          <label class="form-label">Choices<span class="text-danger">*</span></label>
                                          <div class="input-group form-check-inline mb-1">
                                            <div class="input-group-text">
                                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option1">
                                            </div>
                                            <input type="text" class="form-control" placeholder="Choice (A)" aria-label="Text input with checkbox">
                                          </div>
                                          <div class="input-group  form-check-inline mb-1">
                                            <div class="input-group-text">
                                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option2">
                                            </div>
                                            <input type="text" class="form-control" placeholder="Choice (B)" aria-label="Text input with checkbox">
                                          </div>
                                          <div class="input-group  form-check-inline mb-1">
                                            <div class="input-group-text">
                                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option3">
                                            </div>
                                            <input type="text" class="form-control" placeholder="Choice (C)" aria-label="Text input with checkbox">
                                          </div>
                                          <div class="input-group  form-check-inline mb-3">
                                            <div class="input-group-text">
                                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option4">
                                            </div>
                                            <input type="text" class="form-control" placeholder="Choice (D)" aria-label="Text input with checkbox">
                                          </div>
                                          <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                          <select id="smallSelect" class="form-select form-select-sm">
                                            <option>Select</option>
                                            <option value="1">Easy</option>
                                            <option value="2">Medium</option>
                                            <option value="3">Hard</option>
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                      <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <span>
                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete" class="badge badge-center bg-danger" style="cursor: pointer;">
                                  <i class="ti ti-trash"></i>
                                </span>
                              </span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="navs-pills-justified-add-questions" role="tabpanel">
                    <div class="row mb-4">
                      <!-- <div class="col-5 mb-3" id="classroom_div">
                        <label for="selectpickerBasic" class="form-label">Classroom</label>
                        <select id="class_room" class="selectpicker w-100" data-style="btn-default">
                          <option value="">Select Classroom</option>
                          <option value="class_1">Classroom 1</option>
                          <option value="class_2">Classroom 2</option>
                        </select>
                      </div>
                      <div class="col-1 mb-3"></div> -->
                      <div class="col-5 mb-3" id="subject_div">
                        <label for="selectpickerBasic" class="form-label">Subject</label>
                        <select id="sub_ject" class="selectpicker w-100" data-style="btn-default">
                          <option value="">Select Subject</option>
                          <?php if($subjects) {
							  foreach($subjects as $subject)
							  {?>
								<option value="{{$subject->id}}">{{ $subject->subject_name }}</option>
							  <?php }
						  } ?>
                        </select>
                      </div>
                      <div class="col-5 mb-3" id="lesson_div">
                        <label for="selectpickerBasic" class="form-label">Lesson</label>
                        <select id="sub_lesson" class="selectpicker w-100" data-style="btn-default">
                          <option value="">Select Lesson</option>
                          <option value="class_1">Lesson 1</option>
                          <option value="class_2">Lesson 2</option>
                        </select>
                      </div>
                      <div class="col-2 mb-3"></div>
                      <div class="col-5 mb-3" id="type_div">
                        <label for="selectpickerBasic" class="form-label">Filter by Type</label>
                        <select id="filter_type" class="selectpicker w-100 filter_by_type" data-style="btn-default">
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
                    <hr/>
                    <div class="nav-align-top mb-4 main_div" id="main_div">
                      <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-manual" aria-controls="navs-pills-justified-manual" aria-selected="true">
                            <b> <i class="tf-icons ti ti-chart-candle ti-xs me-1"></i> Manual Creation</b>
                          </button>
                        </li>
                        <li class="nav-item">
                          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-excel" aria-controls="navs-pills-justified-excel" aria-selected="false">
                            <b> <i class="tf-icons ti ti-file-spreadsheet ti-xs me-1"></i> Excel Upload</b>
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-pills-justified-manual" role="tabpanel">
                          <div class="row mb-4">
                            <div class="col-12">
                              <!-- <div class="card">
                                <div class="card-body"> -->
                              <!-- Multiple Choice Single Answer -->
                              <form id="single_answer" method="POST" action="">
                                <div class="group-a">
                                  <div class="group-b">
                                    <div class="row">
                                      <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                        <label class="form-label">Question<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                                      </div>
                                      <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                        <label class="form-label">Choices<span class="text-danger">*</span></label>
                                        <div class="input-group form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option1">
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (A)" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option2">
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (B)" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option3">
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (C)" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-3">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option4">
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (D)" aria-label="Text input with checkbox">
                                        </div>
                                        <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                        <select id="smallSelect" class="form-select form-select-sm">
                                          <option>Select</option>
                                          <option value="1">Easy</option>
                                          <option value="2">Medium</option>
                                          <option value="3">Hard</option>
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
                              </form>

                              <!-- Multiple Choice Multiple Answers -->
                              <form id="multiple_answer" method="POST" action="">
                                <div class="group-a">
                                  <div class="group-b">
                                    <div class="row">
                                      <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                        <label class="form-label">Question<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                                      </div>
                                      <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                        <label class="form-label">Choices<span class="text-danger">*</span></label>
                                        <div class="input-group mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input" />
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (A)" aria-label="Text input with checkbox" />
                                        </div>
                                        <div class="input-group mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input" />
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (B)" aria-label="Text input with checkbox" />
                                        </div>
                                        <div class="input-group mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input" />
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (C)" aria-label="Text input with checkbox" />
                                        </div>
                                        <div class="input-group mb-3">
                                          <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input" />
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (D)" aria-label="Text input with checkbox" />
                                        </div>
                                        <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                        <select id="smallSelect" class="form-select form-select-sm">
                                          <option>Select</option>
                                          <option value="1">Easy</option>
                                          <option value="2">Medium</option>
                                          <option value="3">Hard</option>
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
                              </form>

                              <!-- Fill in the blanks -->
                              <form id="fill_blanks" method="POST" action="">
                                <div class="group-a">
                                  <div class="group-b">
                                    <div class="row">
                                      <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                        <label class="form-label">Question<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea>
                                      </div>
                                      <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                        <label class="form-label">Choices<span class="text-danger">*</span></label>
                                        <div class="input-group form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadio_Options" id="inline_Radio" value="option1">
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (A)" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadio_Options" id="inline_Radio" value="option2">
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (B)" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadio_Options" id="inline_Radio" value="option3">
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (C)" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-3">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadio_Options" id="inline_Radio" value="option4">
                                          </div>
                                          <input type="text" class="form-control" placeholder="Choice (D)" aria-label="Text input with checkbox">
                                        </div>
                                        <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                        <select id="smallSelect" class="form-select form-select-sm">
                                          <option>Select</option>
                                          <option value="1">Easy</option>
                                          <option value="2">Medium</option>
                                          <option value="3">Hard</option>
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
                              </form>

                              <!-- True or False -->
                              <form id="true_false" method="POST" action="">
                                <div class="group-a">
                                  <div class="group-b">
                                    <div class="row">
                                      <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                        <label class="form-label">Question<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                                      </div>
                                      <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                        <label class="form-label">Choices<span class="text-danger">*</span></label>
                                        <div class="input-group form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadio_trueOptions" id="inline_trueRadio" value="option1">
                                          </div>
                                          <input type="text" class="form-control" placeholder="True" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-3">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadio_trueOptions" id="inline_trueRadio" value="option2">
                                          </div>
                                          <input type="text" class="form-control" placeholder="False" aria-label="Text input with checkbox">
                                        </div>
                                        <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                        <select id="smallSelect" class="form-select form-select-sm">
                                          <option>Select</option>
                                          <option value="1">Easy</option>
                                          <option value="2">Medium</option>
                                          <option value="3">Hard</option>
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
                              </form>

                              <!-- True or False -->
                              <form id="short_answer" method="POST" action="">
                                <div class="group-a">
                                  <div class="group-b">
                                    <div class="row">
                                      <div class="mb-3 col-lg-7 col-xl-4 col-12 mb-0">
                                        <label class="form-label">Question<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                                      </div>
                                      <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                        <label class="form-label">Answer<span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="shortanswer" rows="4"></textarea>
                                      </div>
                                      <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                                        <br>
                                        <br>
                                        <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                        <select id="smallSelect" class="form-select form-select-sm">
                                          <option>Select</option>
                                          <option value="1">Easy</option>
                                          <option value="2">Medium</option>
                                          <option value="3">Hard</option>
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
                              </form>

                              <!-- Match the Following -->
                              <form id="match_following" method="POST" action="">
                                <div class="group-a">
                                  <div class="group-b">
                                    <div class="row">
                                      <div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0">
                                        <label class="form-label">Heading 1<span class="text-danger">*</span></label>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">A</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="Child Labour (Prohibition and Regulation) Act Year of Legislation" row="10"></textarea>
                                        </div>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">B</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="The Factories Act" row="10"></textarea>
                                        </div>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">C</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="The Mines Act" row="10"></textarea>
                                        </div>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">D</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="The Right of Children to Free and Compulsory Education Act" row="10"></textarea>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0">
                                        <label class="form-label">Heading 2<span class="text-danger">*</span></label>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">1</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="1986" row="10"></textarea>
                                        </div>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">2</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="1952" row="10"></textarea>
                                        </div>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">3</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="2009" row="10"></textarea>
                                        </div>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">4</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="1948" row="10"></textarea>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0">
                                        <label class="form-label">Choices<span class="text-danger">*</span></label>
                                        <div class="input-group form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions_match" id="inlineRadio_match" value="option1">
                                          </div>
                                          <input type="text" class="form-control" placeholder="A-1, B-4, C-2, D-3" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions_match" id="inlineRadio_match" value="option2">
                                          </div>
                                          <input type="text" class="form-control" placeholder="A-2, B-4, C-3, D-1" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions_match" id="inlineRadio_match" value="option3">
                                          </div>
                                          <input type="text" class="form-control" placeholder="A-3, B-2, C-1, D-4" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-4">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions_match" id="inlineRadio_match" value="option4">
                                          </div>
                                          <input type="text" class="form-control" placeholder="A-4, B-3, C-1, D-2" aria-label="Text input with checkbox">
                                        </div>
                                        <label for="defaultSelect" class="form-label">Difficulty Level</label>
                                        <select id="smallSelect" class="form-select form-select-sm">
                                          <option>Select</option>
                                          <option value="1">Easy</option>
                                          <option value="2">Medium</option>
                                          <option value="3">Hard</option>
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
                              </form>

                              <!-- Ordering/Sequences -->
                              <form id="order_sequence" method="POST" action="">
                                <div class="group-a">
                                  <div class="group-b">
                                    <div class="row">
                                      <div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0">
                                        <label class="form-label">Question<span class="text-danger">*</span></label>
                                        <textarea class="form-control mb-2" id="order_sequenceTextarea1" rows="3" placeholder="Arrange the following steps in the correct order in which they appear in the process of adaptation."></textarea>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">A</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="You gradually feel better and decrease sweating."></textarea>
                                        </div>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">B</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="Sudden increase in the temperature of the environment."></textarea>
                                        </div>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">C</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="Eventually you stop sweating and then feel completely normal."></textarea>
                                        </div>
                                        <div class="input-group mb-1">
                                          <span class="input-group-text">D</span>
                                          <textarea class="form-control" aria-label="With textarea" placeholder="You feel very hot and start sweating."></textarea>
                                        </div>
                                      </div>
                                      <div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0">
                                        <label class="form-label">Choices<span class="text-danger">*</span></label>
                                        <div class="input-group form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadio_orderOptions" id="inline_orderRadio" value="option1">
                                          </div>
                                          <input type="text" class="form-control" placeholder="A,B,C,D" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadio_orderOptions" id="inline_orderRadio" value="option2">
                                          </div>
                                          <input type="text" class="form-control" placeholder="B,C,D,A" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-1">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadio_orderOptions" id="inline_orderRadio" value="option2">
                                          </div>
                                          <input type="text" class="form-control" placeholder="B,D,A,C" aria-label="Text input with checkbox">
                                        </div>
                                        <div class="input-group  form-check-inline mb-4">
                                          <div class="input-group-text">
                                            <input class="form-check-input" type="radio" name="inlineRadio_orderOptions" id="inline_orderRadio" value="option2">
                                          </div>
                                          <input type="text" class="form-control" placeholder="B,D,C,A" aria-label="Text input with checkbox">
                                        </div>
                                        <label for="defaultSelect" class="form-label mt-4">Difficulty Level</label>
                                        <select id="smallSelect" class="form-select form-select-sm">
                                          <option>Select</option>
                                          <option value="1">Easy</option>
                                          <option value="2">Medium</option>
                                          <option value="3">Hard</option>
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
                              </form>
                              <!-- </div>
                              </div> -->
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="navs-pills-justified-excel" role="tabpanel">
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <div class="col-md-12" id="upload_btn">
                                <label for="formFile" class="form-label">Assessment Upload</label>
                                <input class="form-control" id="csvFileInput" name="file" type="file" required />
                              </div>
                            </div>
                            <div class="mb-3 col-md-6">
                              <br>
                              <span type="button" class="btn btn-label-primary waves-effect" id="downloadButton" style="float: right;">
                                    <span class="ti-xs ti ti-download me-1"></span>Download Sample File</span>
                            </div>
                            <div class="col-md-12 mt-4" id="btn_submit">
                              <button type="submit" class="btn btn-primary me-2" id="logo_color" style="float:right;">Submit</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Question Paper Creation -->
              <div class="card mb-4" id="questionpaper_creation">
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
              </div>
              <div class="card" id="question_paper">
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
              </div>
              <div class="card" id="exam_creation">
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
              </div>
            </div>
            <div class="pt-4" style="float: right;">
              <button type="button" class="btn-label-secondary waves-effect previous_button me-3" id="previous_button" style="border-color:transparent !important;background: #eaebec !important; color: #a8aaae !important;">Previous</button>
              <button type="submit" class="btn-primary me-sm-3 me-1 waves-effect waves-light question_paper_cta" id="logo_color" style="float: right;">Next<i class="tf-icons ti ti-chevron-right ti-xs"></i></button>
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

      $('#refetch_btn').click(function() {
        $('.answer_8').val('');
        $('#question_8').val('');
      });


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
      $('#questionbank_creation').hide();
      $('.main_div').hide();
      $('#back2lists').hide();
      $('#questionpaper_creation').hide();


      $(".question_bank_creation").click(function() {
        $('#questionbank_creation').show();
        $('.question_bank_creation').hide();
        $('#back2lists').show();

        $('.lists_assessments').hide();
        $('#assessment_lists').hide();
        $('#questionpaper_creation').hide();
        $('#question_paper').hide();
        $('.question_paper_creation').hide();

      });

      $(".question_paper_creation").click(function() {
        $('#questionpaper_creation').show();
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


  <!-- Multiple Choice Multiple Answers -->
  <script>
    $(document).ready(function() {
      var addButton = $('#multiple_answer .add_button'); //Add button selector
      var wrapper = $('#multiple_answer .group-a'); //Input field wrapper
      var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group mb-1"><div class="input-group-text"><input class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for following text input"></div><input class="form-control" placeholder="Choice (A)" aria-label="Text input with checkbox"></div><div class="input-group mb-1"><div class="input-group-text"><input class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for following text input"></div><input class="form-control" placeholder="Choice (B)" aria-label="Text input with checkbox"></div><div class="input-group mb-1"><div class="input-group-text"><input class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for following text input"></div><input class="form-control" placeholder="Choice (C)" aria-label="Text input with checkbox"></div><div class="input-group mb-3"><div class="input-group-text"><input class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for following text input"></div><input class="form-control" placeholder="Choice (D)" aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label">Difficulty Level</label><select id="smallSelect" class="form-select form-select-sm"><option>Select</option><option value="1">Easy</option><option value="2">Medium</option><option value="3">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
      var x = 1; //Initial field counter is 1

      // Once add button is clicked
      $(addButton).click(function() {
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
      var wrapper = $('#single_answer .group-a'); //Input field wrapper
      var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option1"></div><input class="form-control" placeholder="Choice (A)" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option2"></div><input class="form-control" placeholder="Choice (B)" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option3"></div><input class="form-control" placeholder="Choice (C)" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-3"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio" value="option4"></div><input class="form-control" placeholder="Choice (D)" aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label">Difficulty Level</label><select id="smallSelect" class="form-select form-select-sm"><option>Select</option><option value="1">Easy</option><option value="2">Medium</option><option value="3">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
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

  <!-- Fill in the Blanks -->

  <script>
    $(document).ready(function() {
      var addButton = $('#fill_blanks .add_button'); //Add button selector
      var wrapper = $('#fill_blanks .group-a'); //Input field wrapper
      var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control" id="exampleFormControlTextarea1" rows="10"></textarea></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_Options" id="inline_Radio" value="option1"></div><input class="form-control" placeholder="Choice (A)" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_Options" id="inline_Radio" value="option2"></div><input class="form-control" placeholder="Choice (B)" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_Options" id="inline_Radio" value="option3"></div><input class="form-control" placeholder="Choice (C)" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-3"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_Options" id="inline_Radio" value="option4"></div><input class="form-control" placeholder="Choice (D)" aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label">Difficulty Level</label><select id="smallSelect" class="form-select form-select-sm"><option>Select</option><option value="1">Easy</option><option value="2">Medium</option><option value="3">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
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

  <!-- True or False -->

  <script>
    $(document).ready(function() {
      var addButton = $('#true_false .add_button'); //Add button selector
      var wrapper = $('#true_false .group-a'); //Input field wrapper
      var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_trueOptions" id="inline_trueRadio" value="option1"></div><input class="form-control" placeholder="True" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-3"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_trueOptions" id="inline_trueRadio" value="option2"></div><input class="form-control" placeholder="False" aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label">Difficulty Level</label><select id="smallSelect" class="form-select form-select-sm"><option>Select</option><option value="1">Easy</option><option value="2">Medium</option><option value="3">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
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

  <!-- Short Answer -->

  <script>
    $(document).ready(function() {
      var addButton = $('#short_answer .add_button'); //Add button selector
      var wrapper = $('#short_answer .group-a'); //Input field wrapper
      var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-4 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Answer<span class="text-danger">*</span></label><textarea class="form-control" id="shortanswer" rows="4"></textarea></div><div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0"><br><br><label for="defaultSelect" class="form-label">Difficulty Level</label><select id="smallSelect" class="form-select form-select-sm"><option>Select</option><option value="1">Easy</option><option value="2">Medium</option><option value="3">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
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

  <!-- Match the Following -->

  <script>
    $(document).ready(function() {
      var addButton = $('#match_following .add_button'); //Add button selector
      var wrapper = $('#match_following .group-a'); //Input field wrapper
      var fieldHTML = '<div class="row"><div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0"><label class="form-label">Heading 1<span class="text-danger">*</span></label><div class="input-group mb-1"><span class="input-group-text">A</span><textarea class="form-control" aria-label="With textarea" placeholder="Child Labour (Prohibition and Regulation) Act Year of Legislation" row="10"></textarea></div><div class="input-group mb-1"><span class="input-group-text">B</span><textarea class="form-control" aria-label="With textarea" placeholder="The Factories Act" row="10"></textarea></div><div class="input-group mb-1"><span class="input-group-text">C</span><textarea class="form-control" aria-label="With textarea" placeholder="The Mines Act" row="10"></textarea></div><div class="input-group mb-1"><span class="input-group-text">D</span><textarea class="form-control" aria-label="With textarea" placeholder="The Right of Children to Free and Compulsory Education Act" row="10"></textarea></div></div><div class="mb-3 col-lg-3 col-xl-4 col-12 mb-0"><label class="form-label">Heading 2<span class="text-danger">*</span></label><div class="input-group mb-1"><span class="input-group-text">1</span><textarea class="form-control" aria-label="With textarea" placeholder="1986" row="10"></textarea></div><div class="input-group mb-1"><span class="input-group-text">2</span><textarea class="form-control" aria-label="With textarea" placeholder="1952" row="10"></textarea></div><div class="input-group mb-1"><span class="input-group-text">3</span><textarea class="form-control" aria-label="With textarea" placeholder="2009" row="10"></textarea></div><div class="input-group mb-1"><span class="input-group-text">4</span><textarea class="form-control" aria-label="With textarea" placeholder="1948" row="10"></textarea></div></div><div class="mb-3 col-lg-4 col-xl-3 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions_match1" id="inlineRadio_match1" value="option1"></div><input class="form-control" placeholder="A-1, B-4, C-2, D-3" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions_match1" id="inlineRadio_match1" value="option2"></div><input class="form-control" placeholder="A-2, B-4, C-3, D-1" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions_match1" id="inlineRadio_match" value="option3"></div><input class="form-control" placeholder="A-3, B-2, C-1, D-4" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-4"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadioOptions_match1" id="inlineRadio_match1" value="option4"></div><input class="form-control" placeholder="A-4, B-3, C-1, D-2" aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label">Difficulty Level</label><select id="smallSelect" class="form-select form-select-sm"><option>Select</option><option value="1">Easy</option><option value="2">Medium</option><option value="3">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
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
      var fieldHTML = '<div class="row"><div class="mb-3 col-lg-7 col-xl-6 col-12 mb-0"><label class="form-label">Question<span class="text-danger">*</span></label><textarea class="form-control mb-2" id="order_sequenceTextarea1" rows="3" placeholder="Arrange the following steps in the correct order in which they appear in the process of adaptation."></textarea><div class="input-group mb-1"><span class="input-group-text">A</span><textarea class="form-control" aria-label="With textarea" placeholder="You gradually feel better and decrease sweating."></textarea></div><div class="input-group mb-1"><span class="input-group-text">B</span><textarea class="form-control" aria-label="With textarea" placeholder="Sudden increase in the temperature of the environment."></textarea></div><div class="input-group mb-1"><span class="input-group-text">C</span><textarea class="form-control" aria-label="With textarea" placeholder="Eventually you stop sweating and then feel completely normal."></textarea></div><div class="input-group mb-1"><span class="input-group-text">D</span><textarea class="form-control" aria-label="With textarea" placeholder="You feel very hot and start sweating."></textarea></div></div><div class="mb-3 col-lg-4 col-xl-4 col-12 mb-0"><label class="form-label">Choices<span class="text-danger">*</span></label><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_orderOptions" id="inline_orderRadio" value="option1"></div><input class="form-control" placeholder="A,B,C,D" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_orderOptions" id="inline_orderRadio" value="option2"></div><input class="form-control" placeholder="B,C,D,A" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-1"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_orderOptions" id="inline_orderRadio" value="option2"></div><input class="form-control" placeholder="B,D,A,C" aria-label="Text input with checkbox"></div><div class="input-group form-check-inline mb-4"><div class="input-group-text"><input class="form-check-input" type="radio" name="inlineRadio_orderOptions" id="inline_orderRadio" value="option2"></div><input class="form-control" placeholder="B,D,C,A" aria-label="Text input with checkbox"></div><label for="defaultSelect" class="form-label mt-4">Difficulty Level</label><select id="smallSelect" class="form-select form-select-sm"><option>Select</option><option value="1">Easy</option><option value="2">Medium</option><option value="3">Hard</option></select></div><div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0"><br><a href="javascript:void(0);" class="remove_button"><i class="fa-solid fa-circle-minus"></i></a></div><hr></div>'; //New input field html
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
  </script>


</body>

</html>
