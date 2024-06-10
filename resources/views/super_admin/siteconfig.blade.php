<!DOCTYPE html>
<html
   lang="en"
   class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
   dir="ltr"
   data-theme="theme-default"
   data-assets-path="assets/"
   data-template="vertical-menu-template">
   <head>
      <meta charset="utf-8" />
      <meta
         name="viewport"
         content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <title>Super Admin</title>
      <meta name="description" content="" />
      @include('super_admin.header')
      <style type="text/css">
         .super_admin .btn-primary{
         background-color: #e00814 !important;
         border-color: #e00814 !important;
         }
         .super_admin .app-brand-logo.demo {
         width: auto !important;
         height: auto !important;
         }
         .super_admin .form-control:focus, .super_admin .form-select:focus,.super_admin .input-group:focus-within .form-control, .super_admin .input-group:focus-within .input-group-text{
         border-color: #e00814 !important;
         }
         .super_admin .form-check-input:checked,.super_admin .form-check-input[type=checkbox]:indeterminate{
         background-color: #e00814 !important;
         border-color: #e00814 !important;
         }
         .super_admin .form-check-input:focus{
         border-color: #e00814 !important;
         }
         .super_admin .bg-primary{
         background-color: #e00814 !important;
         }
         .super_admin .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.super_admin .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.super_admin .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.super_admin .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle){
         background: linear-gradient(72.47deg, #e00814 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
         color: #ffffff !important;
         }
         .super_admin .menu-vertical .app-brand {
         margin: 20px 0.875rem 20px 1rem ;
         }
         .super_admin i{
         font-size: 17px !important;
         }
         #half_logo{
         display: none;
         }
         .layout-menu-collapsed .half_logo{
         margin-left: 3px !important;
         }
         .layout-navbar-fixed .layout-page:before{
         background: #0000000d;
         mask: none;
         }
         #roles_capabilities .form-check{
            width: 22%;
         }
         .template-customizer-open-btn{
            display:none !important;
         }
         .super_admin .row-bordered > [class^=col-]::before, .row-bordered > [class*=" col-"]::before{
            border: 0px;
         }
      </style>
   </head>
   <body class="super_admin">
      <!-- Layout wrapper -->
      <div class="layout-wrapper layout-content-navbar">
         <div class="layout-container">
            <!-- Menu -->
            @include('super_admin.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
               <!-- Navbar -->
               @include('super_admin.navbar')
               <!-- / Navbar -->
               <!-- Content wrapper -->
               <div class="content-wrapper">
                  <!-- Content -->
                  <div class="container-xxl flex-grow-1 container-p-y" style="background: #0000000d;">
                     <div class="row">
                        <!-- Website Analytics -->
                        <div class="col-lg-12 mb-4">
                           <div class="roles_capabilities" id="roles_capabilities" style="background-color: #fff;border-radius: 7px;">
                              <div class="col-xl-12">
                                 <div class="col-xl-12">
                                    <h5 style="padding: 10px 0px;margin: 0px;border-bottom: 1px solid #00000029;"><b>&nbsp;&nbsp;&nbsp;Site Config</b></h5>
                                 </div>
                                 <p style="height: 2px;"></p>
                                 <div class="row row-bordered g-0">
                                    <div class="col-xl-12 col-md" style="padding: 5px 21px;">
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" checked />
                                          <label class="form-check-label" data-bs-toggle="modal" data-bs-target="#editUser" for="Dashboard"> Dashboard </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Profile"> Profile </label>
                                       </div>
                                    </div>
                                 </div>
                                 <p style="height: 2px;"></p>
                                 <div class="row row-bordered g-0">
                                    <div class="col-xl-12 col-md" style="padding: 5px 21px;">
                                       <small class="text-light fw-medium text-uppercase">Academy Section</small>
                                    </div>
                                    <p style="height: 2px;"></p>
                                    <div class="col-xl-12 col-md" style="padding: 5px 21px;">
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Classsrooms"> Classsrooms </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Teachers"> Teachers </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Students"> Students </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Parents"> Parents </label>
                                       </div>
                                    </div>
                                 </div>
                                 <p style="height: 2px;"></p>
                                 <div class="row row-bordered g-0">
                                    <div class="col-xl-12 col-md" style="padding: 5px 21px;">
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Online Courses"> Online Courses </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Materials"> Materials </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Quizzes and Exams"> Quizzes and Exams </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Assignments"> Assignments </label>
                                       </div>
                                    </div>
                                 </div>
                                 <p style="height: 2px;"></p>
                                 <div class="row row-bordered g-0">
                                    <div class="col-xl-12 col-md" style="padding: 5px 21px;">
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Certificates"> Certificates </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Student Progress"> Student Progress </label>
                                       </div>
                                    </div>
                                 </div>
                                 <p style="height: 2px;"></p>
                                 <div class="row row-bordered g-0">
                                    <div class="col-xl-12 col-md" style="padding: 5px 21px;">
                                       <small class="text-light fw-medium text-uppercase">Management Section</small>
                                       <p style="height: 2px;"></p>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Branches"> Branches </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Human Resources"> Human Resources </label>
                                       </div>

                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Accounting"> Accounting </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Agreements"> Agreements </label>
                                       </div>
                                       <p style="height: 2px;"></p>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Inventory Lists"> Inventory Lists </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Services and Products"> Services and Products </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Users and Roles"> Users and Roles </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Smart Reports"> Smart Reports </label>
                                       </div>
                                    </div>
                                 </div>
                                 <p style="height: 2px;"></p>
                                 <div class="row row-bordered g-0">
                                    <div class="col-xl-12 col-md" style="padding: 5px 21px;">
                                       <small class="text-light fw-medium text-uppercase">Support Section</small>
                                       <p style="height: 2px;"></p>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Help Desk"> Help Desk </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Settings"> Settings </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Modules"> Modules </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" />
                                          <label class="form-check-label" for="Logout"> Logout </label>
                                       </div>
                                       <p style="height: 2px;"></p>
                                    </div>
                                 </div>
                                 <p style="height: 2px;"></p>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-12 mb-4" style="text-align: right;">
                           <button type="button" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                        </div>
                     </div>
                  </div>
                  <div class="content-backdrop fade"></div>
               </div>
               <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                           <div class="modal-content p-3 p-md-5">
                              <div class="modal-body">
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 <div class="text-center mb-4">
                                    <h3 class="mb-2">Edit Menu Item</h3>
                                 </div>
                                 <form id="editUserForm" class="row g-3" onsubmit="return false">
                                    <div class="col-xs-hidden col-sm-hidden col-lg-3 col-md-3"></div>
                                    <div class="col-12 col-md-6">
                                       <label class="form-label" for="modalEditUserFirstName">Menu Item</label>
                                       <input
                                          type="text"
                                          id="modalEditUserFirstName"
                                          name="modalEditUserFirstName"
                                          class="form-control"
                                          placeholder=""
                                          value = "Dashboard"/>
                                    </div>
                                    <div class="col-xs-hidden col-sm-hidden col-lg-3 col-md-3"></div>
                                    <div class="col-12 text-center">
                                       <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                                       <button
                                          type="reset"
                                          class="btn btn-label-secondary"
                                          data-bs-dismiss="modal"
                                          aria-label="Close">
                                       Cancel
                                       </button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
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
      @include('super_admin.footer')
   </body>
</html>
