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
      <title>Suspended Organisations List</title>
      <meta name="description" content="" />
      @include('super_admin.header')
      <style type="text/css">
        .add_admin .btn-primary{
        background-color: #e00814 !important;
        border-color: #e00814 !important;
        }
        .add_admin .app-brand-logo.demo {
        width: auto !important;
        height: auto !important;
        }
        .add_admin .form-check-input:checked,.add_admin .form-check-input[type=checkbox]:indeterminate{
        background-color: #e00814 !important;
        border-color: #e00814 !important;
        }
        .add_admin .form-check-input:focus{
        border-color: #e00814 !important;
        }
        .add_admin .bg-primary{
        background-color: #e00814 !important;
        }
        .add_admin .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.add_admin .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.add_admin .bg-menu-theme .menu-inner .menu-item.active > .menu-link.menu-toggle,.add_admin .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle){
        background: linear-gradient(72.47deg, #e00814 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
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
     <script type="text/javascript">
     (function () {
  const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });
})();

     </script>
<style>
  .couponcode:hover .coupontooltip {
  /* NEW */
  display: block;
}

.coupontooltip {
  display: none;
  /* NEW */
  background: #C8C8C8;
  padding: 10px;
  position: absolute;
  z-index: 1000;
  width: 200px;
  height: 100px;
}

.couponcode {
  margin: 10px;
}
tr .spnTooltip {
    z-index:10;
    display:none;
    padding: 14px 20px;
    margin-top: 24px;
    margin-left: 4px;
    width: 150px;
    line-height: 16px;
}
tr:hover .spnTooltip {
    display: inline;
    position: absolute;
    color: #fff;
    border: 1px solid #e9525ae0;
    background: #e9525ae0;
    border-radius: 19px;
    text-wrap: wrap;
}
.callout {
    z-index:20;
    position:absolute;
    top:30px;
    border:0;
    left:-12px;
}
tr td, tr th{
    text-align: left !important;
}

   </style>
   </head>
   <body class="add_admin">
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
               <div class="container-xxl flex-grow-1 container-p-y">
                 <h4 class="mb-1 mt-3" style="color: #e00814;">Suspended Organisations List</h4>
                 <p style="height: 2px;"></p>
                 <div class="card">
                    <div class="card-body table_admin text-nowrap">
                     <input type="hidden" id="ajax_url" name="ajax_url" value="{{route('change_organization_status')}}">
                     <table id="example" class="display nowrap" style="width:100%">
                          <thead>
                           <tr>
                              <th>Name</th>
                              <th>Email Address</th>

                              <th>Start Date</th>
                              <th>End Date</th>

                              <th>Actions</th>

                           </tr>
                          </thead>
                          <tbody>


                              <?php foreach ($organizations as $organization) {
                                 echo '<tr title="'.$organization->suspend_msg.'">';
                                 echo '<td>' . $organization->name . '</td>';
                                 echo '<td>' . $organization->email . '<span class="spnTooltip">'.$organization->suspend_msg.'</span></td>';

                                 echo '<td>' . $organization->start_date->format('d/m/Y') . '</td>';
                                 echo '<td>' . $organization->end_date->format('d/m/Y') . '</td>';

                                 echo '<td>

                                     <button class="toggle-class btn btn-success" data-id="'.$organization->id.'"> Activate </button>
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
      @include('super_admin.footer')
      <script type="text/javascript">
         new DataTable('#example', {
         scrollX: true
         });
      </script>
      <script>
         $(function() {
           //$('.toggle-class').click(function() {
            $("#example").on("click",".toggle-class",function() {
               var status = 1;
               var user_id = $(this).data('id');
               var ajax_url= $('#ajax_url').val();
               if(confirm("Are You Sure?"))
             {
               $.ajax({
                   type: "GET",
                   dataType: "json",
                   url: ajax_url,
                   data: {'status': status, 'user_id': user_id},
                   success: function(data){
                     alert(data.success);
                     location.reload();
                   }
               });
            }
           })
         })
       </script>
   </body>
</html>
