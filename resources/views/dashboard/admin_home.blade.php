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
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <title>Dashboard</title>
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
      <style type="text/css">
         .index_page .btn-primary{
         background-color: <?php echo $org_color; ?> !important;
         border-color: <?php echo $org_color; ?> !important;
         }
         .index_page .app-brand-logo.demo {
         width: auto !important;
         height: auto !important;
         }
         .index_page .form-control:focus, .index_page .form-select:focus,.index_page .input-group:focus-within .form-control, .index_page .input-group:focus-within .input-group-text{
         color: <?php echo $org_color; ?> !important;
         border-color: <?php echo $org_color; ?> !important;
         }
         .index_page .form-check-input:checked,.index_page .form-check-input[type=checkbox]:indeterminate{
         background-color: <?php echo $org_color; ?> !important;
         border-color: <?php echo $org_color; ?> !important;
         }
         .index_page .form-check-input:focus{
         border-color: <?php echo $org_color; ?> !important;
         }
         .index_page .bg-primary{
         background-color: <?php echo $org_color; ?> !important;
         }
         .index_page .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.index_page .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.index_page .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.index_page .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle){
         background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
         color: #ffffff !important;
         }
         .index_page .menu-vertical .app-brand {
         margin: 20px 0.875rem 20px 1rem ;
         }
         .index_page i{
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
         .index_page #template-customizer .template-customizer-open-btn{
            background-color: <?php echo $org_color; ?> !important;
         }
      </style>
   </head>
   <body class="index_page">
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
                  <div class="container-xxl flex-grow-1 container-p-y" style="background: #0000000d;">
                     <div class="row">
                        <!-- Website Analytics -->
                        <div class="col-lg-5 mb-4">
                           <div
                              class="swiper-container swiper-container-horizontal swiper"
                              id="swiper-with-pagination-cards"
                              style="background-color: #fff;border-radius: 7px;">
                              <div class="swiper-wrapper">
                                 <div class="swiper-slide">
                                    <div class="row">
                                       <div class="col-lg-6 col-6" style="color: #000;">
                                         <h5 class=" mb-0 mt-2" style="color: #000;">Welcome to {{$org_name}} LMS</h5>
                                                    <small>{{$admin_name}}</small>
                                          
                                          <p></p>
                                          <button type="button" class="btn btn-primary waves-effect waves-light">Go to Profile</button>
                                       </div>
                                       <div class="col-lg-6 col-md-3 col-6 order-1 order-md-2 my-4 my-md-0 text-center">
                                          <img
                                             src="assets/img/illustrations/welcome.png"
                                             alt="Go to Profile"
                                             width="170"
                                             class="welcome" />
                                       </div>
                                    </div>
                                 </div>
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
      @include('dashboard.footer')
   </body>
</html>