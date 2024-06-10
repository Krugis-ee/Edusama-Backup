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
      <title>List User Privileges</title>
      <meta name="description" content="" />
      @include('dashboard.header')
      <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>
      <style type="text/css">
	  tr td, tr th{
    text-align: left !important;
}
        .add_admin .btn-primary{
        background-color: <?php echo $org_color; ?> !important;
        border-color: <?php echo $org_color; ?> !important;
        }
        .add_admin .app-brand-logo.demo {
        width: auto !important;
        height: auto !important;
        }
        .add_admin .form-check-input:checked,.add_admin .form-check-input[type=checkbox]:indeterminate{
        background-color: <?php echo $org_color; ?> !important;
        border-color: <?php echo $org_color; ?> !important;
        }
        .add_admin .form-check-input:focus{
        border-color: <?php echo $org_color; ?> !important;
        }
        .add_admin .bg-primary{
        background-color: <?php echo $org_color; ?> !important;
        }
        .add_admin .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.add_admin .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.add_admin .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.add_admin .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle){
         background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
        color: #ffffff !important;
        }
        .add_admin .menu-vertical .app-brand {
        margin: 20px 0.875rem 20px 1rem ;
        }
        .add_admin i{
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
        .add_admin #template-customizer .template-customizer-open-btn{
        display: none;
        }
        .add_org .form-label{
           font-size: 17px;
        }
        .table_admin select#dt-length-0 {
         margin-right: 10px !important;
         }
         .table_admin .dt-search .dt-input{
         margin-left: 14px !important;
         }
         .table_admin .dt-search .dt-input:focus, .table_admin .dt-length select.dt-input:focus{
         color: #6f6b7d;
         background-color: #fff;
         border-color: #7367f0;
         outline: 0;
         box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
         }
         .table_admin .dt-length select.dt-input{
         --bs-form-select-bg-img: url(
         "data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 7.5L10 12.5L15 7.5' stroke='%236f6b7d' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5 7.5L10 12.5L15 7.5' stroke='white' stroke-opacity='0.2' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
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
         table.dataTable.display tbody tr:hover > .sorting_1, table.dataTable.order-column.hover tbody tr:hover > .sorting_1, table.dataTable.display > tbody > tr:nth-child(odd) > .sorting_1, table.dataTable.order-column.stripe > tbody > tr:nth-child(odd) > .sorting_1 {
         box-shadow: none !important;
         }
         .dt-layout-row {
         padding-bottom:20px;
         }
         div.dt-container {
         width: 900px;
         margin: 0 auto;
         }
     </style>

   </head>
   <body class="add_admin">
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

                 <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                           <div class="d-flex flex-column justify-content-center">
                              <h4 class="mb-1 mt-3" style="color: <?php echo $org_color; ?>;">List User Privileges</h4>
                           </div>
						   <div class="d-flex align-content-center flex-wrap gap-3">
                              <div class="d-flex gap-3">
                                 <a href="{{ route('user_privilege') }}">
                                    <button class="btn btn-primary" type="button">
                                       <span>
                                          <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                                          <span class="d-none d-sm-inline-block">Add Privileges</span>
                                       </span>
                                    </button>
                                 </a>
                              </div>
                           </div>
                        </div>
				 <p style="height: 2px;"></p>
                 @if (\Session::has('message'))
                     <div class="alert alert-success">
                        <ul>
                              <li>{!! \Session::get('message') !!}</li>
                        </ul>
                     </div>
                     @endif
                 <div class="card">
                    <div class="card-body table_admin text-nowrap">

                     <table id="example" class="display nowrap" style="width:100%">
                          <thead>
                           <tr>
                              <th>User </th>
                              <th>Role</th>
                              <th>Actions</th>
                           </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($user_privileges as $user_privilege) {
                                 echo '<tr>';
                                 echo '<td>' . $user_privilege->user_name . '</td>';
                                 echo '<td>' . $role_name=App\Models\User::getUserRoleNameByID($user_privilege->user_id_jp).'</td>';
                                  echo '<td>
                                 <a href="'.route("user_privilege_edit", $user_privilege->id). '">
                                 <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning">
                                     <i class="ti ti-edit"></i>
                                 </span>
                                    </a>
                                </td>';

                                     echo '</tr>';
                               } ?>


                          </tbody>
                       </table>
                    </div>
                 </div>
                 <!-- Modal to add new record -->
              </div>

               <!-- / Content -->
               <!-- Footer -->

               <!-- / Footer -->
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
      <script type="text/javascript">
         new DataTable('#example', {
         scrollX: true
         });
      </script>
   </body>
</html>
