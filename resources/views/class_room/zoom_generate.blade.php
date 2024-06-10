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
            <!-- Menu -->

            <!-- <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo half_logo">
          <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                     <img src="assets/logo/edusamanewlogo.png" class="main-logo" id="full_logo" width="170" height="52" alt="Edusama">
                     <img src="assets/favicon/favicon.jpg" class="main-logo" id="half_logo" width="50" height="auto" alt="Edusama">
                     </span>
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
          </a>
        </div>
        <ul class="menu-inner py-1">
          <li class="menu-item">
            <a href="index.html" class="menu-link">
              <i class="menu-icon tf-icons ti ti-smart-home"></i>
              <div data-i18n="Dashboard">Dashboard</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon fa-regular fa-circle-user"></i>
              <div data-i18n="My Profile">My Profile</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Academy Section">Academy Section</span>
          </li>
          <li class="menu-item">
            <a href="list_classrooms.html" class="menu-link">
              <i class="menu-icon fa-solid fa-school"></i>
              <div data-i18n="Classrooms">Classrooms</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa-solid fa-cubes-stacked"></i>
              <div data-i18n="Class Templates">Class Templates</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add_template.html" class="menu-link">
                  <div data-i18n="Create Template">Create Template</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="list_templates.html" class="menu-link">
                  <div data-i18n="List Templates">List Templates</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa-solid fa-user-graduate"></i>
              <div data-i18n="Lecturer">Lecturer</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add_lecturer.html" class="menu-link">
                  <div data-i18n="Add Lecturer">Add Lecturer</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="list_lecturers.html" class="menu-link">
                  <div data-i18n="List Lecturers">List Lecturers</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa-solid fa-user-group"></i>
              <div data-i18n="Students">Students</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add_student.html" class="menu-link">
                  <div data-i18n="Add Student">Add Student</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="list_students.html" class="menu-link">
                  <div data-i18n="List Students">List Students</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa-solid fa-users"></i>
              <div data-i18n="Parents">Parents</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add_parent.html" class="menu-link">
                  <div data-i18n="Add Parent">Add Parent</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="add_student.html" class="menu-link">
                  <div data-i18n="List Parents">List Parents</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link">
              <i class="menu-icon fa-regular fa-calendar-check"></i>
              <div data-i18n="Student Attendance">Student Attendance</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="" class="menu-link">
              <i class="menu-icon fa-solid fa-video"></i>
              <div data-i18n="Recorded Live Classes">Recorded Live Classes</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="" class="menu-link">
              <i class="menu-icon fa-brands fa-simplybuilt"></i>
              <div data-i18n="Video Course">Video Course</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="" class="menu-link">
              <i class="menu-icon fa-solid fa-book-open"></i>
              <div data-i18n="Materials">Materials</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="" class="menu-link">
              <i class="menu-icon fa-solid fa-pen-to-square"></i>
              <div data-i18n="Quizzes and Exams">Quizzes and Exams</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="" class="menu-link">
              <i class="menu-icon fa-solid fa-rectangle-list"></i>
              <div data-i18n="Assignments">Assignments</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="" class="menu-link">
              <i class="menu-icon fa-solid fa-award"></i>
              <div data-i18n="Certificates">Certificates</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="AI Section">AI Section</span>
          </li>
          <li class="menu-item">
            <a href="" class="menu-link">
              <i class="menu-icon fa-brands fa-react"></i>
              <div data-i18n="Student Progress">Student Progress</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="" class="menu-link">
              <i class="menu-icon fa-regular fa-comments"></i>
              <div data-i18n="AI Chan (Chat Bot)">AI Chan (Chat Bot)</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="" class="menu-link">
              <i class="menu-icon fa-solid fa-gamepad"></i>
              <div data-i18n="Games">Games</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Management Section">Management Section</span>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-city"></i>
              <div data-i18n="Branches">Branches</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-fire"></i>
              <div data-i18n="Live Stream Settings">Live Stream Settings</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-child-reaching"></i>
              <div data-i18n="Human Resources">Human Resources</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-money-bill"></i>
              <div data-i18n="Accounting">Accounting</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-file-contract"></i>
              <div data-i18n="Agreements">Agreements</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-coins"></i>
              <div data-i18n="Inventory List">Inventory List</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-dice-d6"></i>
              <div data-i18n="Services and Products">Services and Products</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa-solid fa-users-viewfinder"></i>
              <div data-i18n="Roles">Roles</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="list_roles.html" class="menu-link">
                  <div data-i18n="List Role">List Roles</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="suspended_roles.html" class="menu-link">
                  <div data-i18n="Suspended Roles">Suspended Roles</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa-solid fa-user-plus"></i>
              <div data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add_user.html" class="menu-link">
                  <div data-i18n="Add User">Add User</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="list_users.html" class="menu-link">
                  <div data-i18n="List Users">List Users</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="suspended_privileges.html" class="menu-link">
                  <div data-i18n="Suspended Users">Suspended Users</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa-solid fa-user-gear"></i>
              <div data-i18n="User Privileges">User Privileges</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="add_privileges.html" class="menu-link">
                  <div data-i18n="Add User Privileges">Add User Privileges</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="list_privileges.html" class="menu-link">
                  <div data-i18n="List User Privileges">List User Privileges</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-chart-simple"></i>
              <div data-i18n="Smart Reports">Smart Reports</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-cart-shopping"></i>
              <div data-i18n="Online Store">Online Store</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-money-check-dollar"></i>
              <div data-i18n="Payment Gateways">Payment Gateways</div>
            </a>
          </li>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Support Section">Support Section</span>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-circle-h"></i>
              <div data-i18n="Help Desk">Help Desk</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-gear"></i>
              <div data-i18n="Settings">Settings</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-cubes"></i>
              <div data-i18n="Modules">Modules</div>
            </a>
          </li>
          <li class="menu-item">
            <a href="a" class="menu-link">
              <i class="menu-icon fa-solid fa-right-from-bracket"></i>
              <div data-i18n="Logout">Logout</div>
            </a>
          </li>
        </ul>
      </aside> -->

            <div class="layout-page" style="padding-top: 0px !important; padding-left: 0px;">
                <!-- <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="ti ti-menu-2 ti-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <div class="navbar-nav align-items-center">
              <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                  <i class="ti ti-search ti-md me-2"></i>
                  <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                </a>
              </div>
            </div>

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <i class="ti ti-language rounded-circle ti-md"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                      <span class="align-middle">English</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-language="fr" data-text-direction="ltr">
                      <span class="align-middle">French</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-language="ar" data-text-direction="rtl">
                      <span class="align-middle">Arabic</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-language="de" data-text-direction="ltr">
                      <span class="align-middle">German</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <i class="ti ti-md"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                      <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                      <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                      <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                  <i class="ti ti-layout-grid-add ti-md"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end py-0">
                  <div class="dropdown-menu-header border-bottom">
                    <div class="dropdown-header d-flex align-items-center py-3">
                      <h5 class="text-body mb-0 me-auto">Shortcuts</h5>
                      <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Add shortcuts"><i class="ti ti-sm ti-apps"></i
                        ></a>
                    </div>
                  </div>
                  <div class="dropdown-shortcuts-list scrollable-container">
                    <div class="row row-bordered overflow-visible g-0">
                      <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-calendar fs-4"></i>
                          </span>
                        <a href="app-calendar.html" class="stretched-link">Calendar</a>
                        <small class="text-muted mb-0">Appointments</small>
                      </div>
                      <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-file-invoice fs-4"></i>
                          </span>
                        <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                        <small class="text-muted mb-0">Manage Accounts</small>
                      </div>
                    </div>
                    <div class="row row-bordered overflow-visible g-0">
                      <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-users fs-4"></i>
                          </span>
                        <a href="app-user-list.html" class="stretched-link">User App</a>
                        <small class="text-muted mb-0">Manage Users</small>
                      </div>
                      <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-lock fs-4"></i>
                          </span>
                        <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                        <small class="text-muted mb-0">Permission</small>
                      </div>
                    </div>
                    <div class="row row-bordered overflow-visible g-0">
                      <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-chart-bar fs-4"></i>
                          </span>
                        <a href="index.html" class="stretched-link">Dashboard</a>
                        <small class="text-muted mb-0">User Profile</small>
                      </div>
                      <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-settings fs-4"></i>
                          </span>
                        <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                        <small class="text-muted mb-0">Account Settings</small>
                      </div>
                    </div>
                    <div class="row row-bordered overflow-visible g-0">
                      <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-help fs-4"></i>
                          </span>
                        <a href="pages-faq.html" class="stretched-link">FAQs</a>
                        <small class="text-muted mb-0">FAQs & Articles</small>
                      </div>
                      <div class="dropdown-shortcuts-item col">
                        <span class="dropdown-shortcuts-icon rounded-circle mb-2">
                            <i class="ti ti-square fs-4"></i>
                          </span>
                        <a href="modal-examples.html" class="stretched-link">Modals</a>
                        <small class="text-muted mb-0">Useful Popups</small>
                      </div>
                    </div>
                  </div>
                </div>
              </li>

              <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                  <i class="ti ti-bell ti-md"></i>
                  <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0">
                  <li class="dropdown-menu-header border-bottom">
                    <div class="dropdown-header d-flex align-items-center py-3">
                      <h5 class="text-body mb-0 me-auto">Notification</h5>
                      <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i
                        ></a>
                    </div>
                  </li>
                  <li class="dropdown-notifications-list scrollable-container">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                            <p class="mb-0">Won the monthly best seller gold badge</p>
                            <small class="text-muted">1h ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span
                              ></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span
                              ></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Charles Franklin</h6>
                            <p class="mb-0">Accepted your connection</p>
                            <small class="text-muted">12hr ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span
                              ></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span
                              ></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../assets/img/avatars/2.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">New Message ✉️</h6>
                            <p class="mb-0">You have new message from Natalie</p>
                            <small class="text-muted">1h ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span
                              ></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span
                              ></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-success"><i class="ti ti-shopping-cart"></i
                                ></span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Whoo! You have new order 🛒</h6>
                            <p class="mb-0">ACME Inc. made new order $1,154</p>
                            <small class="text-muted">1 day ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span
                              ></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span
                              ></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../assets/img/avatars/9.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Application has been approved 🚀</h6>
                            <p class="mb-0">Your ABC project application has been approved.</p>
                            <small class="text-muted">2 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span
                              ></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span
                              ></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-success"><i class="ti ti-chart-pie"></i
                                ></span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Monthly report is generated</h6>
                            <p class="mb-0">July monthly financial report is generated</p>
                            <small class="text-muted">3 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span
                              ></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span
                              ></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../assets/img/avatars/5.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">Send connection request</h6>
                            <p class="mb-0">Peter sent you connection request</p>
                            <small class="text-muted">4 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span
                              ></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span
                              ></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <img src="../../assets/img/avatars/6.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">New message from Jane</h6>
                            <p class="mb-0">Your have new message from Jane</p>
                            <small class="text-muted">5 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span
                              ></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span
                              ></a>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar">
                              <span class="avatar-initial rounded-circle bg-label-warning"><i class="ti ti-alert-triangle"></i
                                ></span>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">CPU is running high</h6>
                            <p class="mb-0">CPU Utilization Percent is currently at 88.63%,</p>
                            <small class="text-muted">5 days ago</small>
                          </div>
                          <div class="flex-shrink-0 dropdown-notifications-actions">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span
                              ></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="ti ti-x"></span
                              ></a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown-menu-footer border-top">
                    <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                        View all notifications
                      </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="pages-account-settings-account.html">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-medium d-block">John Doe</span>
                          <small class="text-muted">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="pages-profile-user.html">
                      <i class="ti ti-user-check me-2 ti-sm"></i>
                      <span class="align-middle">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="pages-account-settings-account.html">
                      <i class="ti ti-settings me-2 ti-sm"></i>
                      <span class="align-middle">Settings</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="pages-account-settings-billing.html">
                      <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 ti ti-credit-card me-2 ti-sm"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                      <span class="flex-shrink-0 badge badge-center rounded-pill bg-label-danger w-px-20 h-px-20">2</span
                          >
                        </span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="pages-faq.html">
                      <i class="ti ti-help me-2 ti-sm"></i>
                      <span class="align-middle">FAQ</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="pages-pricing.html">
                      <i class="ti ti-currency-dollar me-2 ti-sm"></i>
                      <span class="align-middle">Pricing</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="auth-login-cover.html" target="_blank">
                      <i class="ti ti-logout me-2 ti-sm"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>

          <div class="navbar-search-wrapper search-input-wrapper d-none">
            <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search..." />
            <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
          </div>
        </nav> -->

                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="app-ecommerce">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center align-items-md-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <h4 class="mb-1 mt-4" style="color: <?php echo $org_color; ?>;">Classroom - <span style="font-style: italic;">Room 1</span></h4>
                                </div>
                                <div class="d-flex align-content-center flex-wrap gap-3">
                                    <div class="d-flex gap-3">
                                        <a href="list_classrooms.html">
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
                                            <form action="{{ route('generate_zoom_meeting_post') }}" method="POST">
											@csrf
                                                <div class="card mb-4">
                                                    <h5 class="card-header" style="color: <?php echo $org_color; ?>;">Generate Class Room <span class="badge bg-success" id="sub_name" style="float: right;"></span></h5>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-4">
                                                                <label for="select2Basic" class="form-label">Topic</label>
																<input type="hidden" name="id" value="{{ $class_room->id }}">
                                                                <input type="text" class="form-control" name="topic" value="{{$class_room->class_room_name}}">
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="mt-2">
                                                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                            <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
                                                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
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
                                                                            <img src="assets/img/course/grid_1.png" width="100%" style="height: 170px;">
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
                                                                            <img src="assets/img/course/grid_1.png" width="100%" style="height: 170px;">
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
    <script src="{{ asset("assets/js/forms-tagify.js") }}"></script>
    <script src="{{ asset("assets/quill/quill.js") }}"></script>
    <script src="{{ asset("assets/js/forms-editors.js") }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#overview_classroom").hide();
            $("#class_announcements").hide();
            $("#login_liveclass").hide();
            $("#login_video").hide();


            $("#headingOne").click(function() {
                $("#student_assign").show();
                $(".classroom_sidebar_assignstudent").addClass("active");

                $("#class_announcements").hide();
                $(".classroom_sidebar_announcement").removeClass("active");
                $("#login_liveclass").hide();
                $(".classroom_sidebar_liveclass").removeClass("active");
                $("#login_video").hide();
                $(".classroom_sidebar_loginvideo").removeClass("active");

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
            $(".select2-selection__placeholder").html("All Courses");
        });
    </script>

</body>

</html>
