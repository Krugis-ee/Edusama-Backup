<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Admin Assignments</title>
  <meta name="description" content="" />
  @include('dashboard.header')
  <link rel="stylesheet" href="{{asset('assets/bootstrap-select/bootstrap-select.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/flatpickr/flatpickr.css')}}" />
  <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>
<?php
                                $show_add = 0;
                                $show_edit = 0;
                                $show_suspend = 0;
                                $user_id = session()->get('loginId');
                                $user_role_id = App\Models\User::getRoleID($user_id);
                                $privileges = App\Models\UserPrivilege::getPrivilegesByUserId($user_id);
                                $privileges_arr = explode(',', $privileges);
                                //Add
                                if ($user_role_id == 1)
                                    $show_add = 1;
                                $primary_roles = array(1, 2, 3, 4);
                                if (!in_array($user_role_id, $primary_roles)) {

                                    if (in_array('assignmentsCreate', $privileges_arr)) {
                                        $show_add = 1;
                                    }
                                }
                                //Add
                                //edit
                                if ($user_role_id == 1)
                                    $show_edit = 1;
                                //$primary_roles = array(1, 2, 3, 4);
                                if (!in_array($user_role_id, $primary_roles)) {

                                    if (in_array('assignmentsUpdate', $privileges_arr)) {
                                        $show_edit = 1;
                                    }
                                }
                                //edit
                                //Suspend
                                if ($user_role_id == 1)
                                    $show_suspend = 1;
                                //$primary_roles = array(1, 2, 3, 4);
                                if (!in_array($user_role_id, $primary_roles)) {

                                    if (in_array('assignmentsDelete', $privileges_arr)) {
                                        $show_suspend = 1;
                                    }
                                }
                                //Suspend
                                ?>
  <style type="text/css">
    .admin_assignments #logo_color {
      background-color: <?php echo $org_color; ?> !important;
      border-color: <?php echo $org_color; ?> !important;
    }

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

     .table_admin select#dt-length-0,
    .table_admin #example_student_wrapper select#dt-length-1 {
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

    #home_work:hover{
      background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
      color: #ffffff !important;
      padding: 5px 10px;
      border-radius: 5px;
    }
    .word_ellipsis{
      white-space: nowrap;
      width: 100px;
      overflow: hidden;
      text-overflow: ellipsis;
      text-align: center;
      padding: 5px 10px;
      border-radius: 5px;
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
              <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                <div class="card-title mb-0 me-1">
                  <h4 class="mb-1 mt-3" id="pagetitle">Assignment Lists</h4>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
			  @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
			  <form method="GET" id="firstForm">
			  <input type="hidden" id="filter_id" name="filter">
                <div class="row mb-4">
                  <!-- Basic -->
                  <div class="col-md-6">
                    <label for="selectpickerBasic" class="form-label">Classroom</label>
                    <select id="selectpickerBasic1" name="classroom_id" class="selectpicker w-100" data-style="btn-default">
                      <option value="">Select Classroom</option>
                      <?php
					  $sele='';
					  foreach($class_rooms as $class_room)
					  { 
					  if(isset($_GET['classroom_id']))
					  {
						  if($_GET['classroom_id']==$class_room->id)
							  $sele='selected';
						  else
							  $sele='';
					  }
					  ?>
						<option <?php echo $sele; ?> value="{{ $class_room->id }}">{{ $class_room->class_room_name }}</option>  
					  <?php }  ?>
                    </select>
                  </div>
                  <!-- Group -->
                  <div class="col-md-3 subject_show">
                    <label for="selectpickerBasic" class="form-label">Subject</label>
					<!--selectpicker w-100 sub_ject-->
                    <select id="selectpickerBasic2" name="subject_id" class="form-control">
                      <option value="">Select Subject</option>                  
					  <?php 
					  $selec='';
					  if($subjects) { 
						foreach($subjects as $subject)
						{
							if(isset($_GET['subject_id']))
					  {
						  if($_GET['subject_id']==$subject['subject_id'])
							  $selec='selected';
						  else
							  $selec='';
					  }
					  ?>
					  <option <?php echo $selec; ?> value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['subject_name']; ?></option>
					  <?php }} ?>
                    </select>
					
                  </div>
				  <div class="col-md-3 subject_show" ><br>
				  <button type="submit" class="btn btn-primary waves-effect waves-light" id="logo_color">
                      <span class="ti-xs ti ti-plus me-1"></span>Fetch Assignments
                    </button>
				  </div>
                </div>
                </form>
				<div class="row" id="add_assignnment">
                  <!-- Basic -->
				   <?php if ($show_add == 1) { ?>
                  <div class="col-md-6">
                    <button type="button" class="btn btn-primary waves-effect waves-light" id="logo_color" data-bs-toggle="modal" data-bs-target="#addNewassignment">
                      <span class="ti-xs ti ti-plus me-1"></span>Add Assignment
                    </button>
                  </div>
				   <?php } ?>
                  <div class="modal fade" id="addNewassignment" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalCenterTitle">Add New Assignment</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
						<form id="addAssignmentForm" action="{{ route('add_assignment') }}" method="POST" enctype="multipart/form-data">
                        @csrf
						
						<div class="modal-body">
						<div style="display:none" id="add_assignment_success" class="alert alert-success" role="alert"></div>
                          <div class="row g-2">
                            <div class="col mb-3">
							<?php
							$classroom_id='';
							$subject_id='';
							$teacher_id='';
							$teacher_name='';
							if(isset($_GET['classroom_id']) && isset($_GET['subject_id']))
							{
								$classroom_id=$_GET['classroom_id'];
								$subject_id=$_GET['subject_id'];
							}
							if(count($teacher)>0)
							{
								$teacher_id=$teacher['teacher_id'];
								$teacher_name=$teacher['teacher_name'];
							}
							?>
                              <label for="defaultSelect" class="form-label">Teacher<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="teachertitle" id="teachertitle" value="<?php echo $teacher_name; ?>" aria-describedby="defaultFormControlHelp" readonly />
                            <input type="hidden" name="teacherID" id="teacherID" value="<?php echo $teacher_id; ?>">
							<input type="hidden" name="classRoomID" id="classRoomID" value="<?php echo $classroom_id; ?>">
							<input type="hidden" name="subjectID" id="subjectID" value="<?php echo $subject_id; ?>">
							</div>
                            <div class="col mb-3">
                              <label for="assignment_title" class="form-label">Title<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="assignment_title" id="assignment_title" placeholder="Homework" aria-describedby="defaultFormControlHelp" />
                              <p id="assignment_title_error" style="color:red"></p>
							</div>
                          </div>
                          <div class="row g-2 mb-4">
                            <div class="col">
                              <label for="delivery_date" class="form-label">Delivery Date<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="DD-MM-YYYY" name="delivery_date" id="flatpickr-date" />
							  <p id="delivery_date_error" style="color:red"></p>
							</div>
                            <div class="col">
                              <label for="teacherfile" class="form-label">Add File<span class="text-danger">*</span></label>
                              <input type="file" class="form-control" id="assignment_file" name="assignment_file" />
                              <p id="assignment_file_error" style="color:red"></p>
							</div>
                          </div>
                          <div class="alert alert-danger" role="alert">Please fill all mandatory fields</div>
                        </div>
                        
						<div class="modal-footer">
                          <button type="button" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal">
                            Close
                          </button>
                          <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light jp_add_assignment" id="logo_color">Save changes</button>
                        </div>
						</form>
                      </div>
                    </div>
                  </div>
                  
				   <div class="modal fade" id="EditAssignment" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalCenterTitle">Edit Assignment</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
						<form id="editAssignmentForm" action="{{ route('update_assignment') }}" method="POST" enctype="multipart/form-data">
                        @csrf
						
						<div class="modal-body">
						<div style="display:none" id="edit_assignment_success" class="alert alert-success" role="alert"></div>
                          <div class="row g-2">
                            <div class="col mb-3">
                              <label for="defaultSelect" class="form-label">Teacher<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="teachertitle" id="teachertitle_edit" value="Teacher 1" aria-describedby="defaultFormControlHelp" readonly />
                            <input type="hidden" name="teacherID" id="teacherIDedit" value="">
							<input type="hidden" name="classRoomID" id="classRoomIDedit" value="">
							<input type="hidden" name="subjectID" id="subjectIDedit" value="">
							</div>
                            <div class="col mb-3">
                              <label for="assignment_title" class="form-label">Title<span class="text-danger">*</span></label>
                              <input type="hidden" name="assignment_id" id="assignment_ID_edit" value="">
							  <input type="text" class="form-control" name="assignment_title" id="assignment_title_edit" placeholder="Homework" aria-describedby="defaultFormControlHelp" />
                              <p id="assignment_title_edit_error" style="color:red"></p>
							</div>
                          </div>
                          <div class="row g-2 mb-4">
                            <div class="col">
                              <label for="delivery_date" class="form-label">Delivery Date<span class="text-danger">*</span></label>
                              <input type="text" class="form-control" placeholder="DD-MM-YYYY" name="delivery_date" id="flatpickr-date-edit" />
							  <p id="flatpickr-date-edit_error" style="color:red"></p>
							</div>
                            <div class="col">
                              <label for="teacherfile" class="form-label">Add File<span class="text-danger">*</span></label>
                              <input type="file" class="form-control" id="assignment_file_edit" name="assignment_file" />
                              <p id="assignment_file_edit_error" style="color:red"></p>
							</div>
                          </div>
                          <div class="alert alert-danger" role="alert">Please fill all mandatory fields</div>
                        </div>
                        
						<div class="modal-footer">
                          <button type="button" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal">
                            Close
                          </button>
                          <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light jp_add_assignment" id="logo_color">Save changes</button>
                        </div>
						</form>
                      </div>
                    </div>
                  </div>
                  <!-- Share Assignment -->
                        <div class="modal fade" id="share_assignment" tabindex="-1" aria-hidden="true" style="text-align: left;">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle" style="text-align: center;">
								Publish
                                </h5>
                              </div>
							  <form id="publishAssignment" action="{{ route('publish_assignment') }}" method="POST">							  
                              @csrf
							  
							  <input type="hidden" name="publish_assignment_id" id="publish_assignment_id" value="">
							  <div class="modal-body">
							  <div style="display:none" id="publish_assignment_success" class="alert alert-success" role="alert"></div>
                                <div class="row">
                                  <div class="mb-3 col-md-12">
                                    <label for="bs-rangepicker-single" class="form-label">Publish On</label>
                                    <input type="text" class="form-control publish_on" placeholder="DD-MM-YYYY HH:MM" name="publish_date" id="flatpickr-datetime" value="" />
                                  </div>
                                </div>
                                <div class="divider">
                                  <div class="divider-text">OR</div>
                                </div>
                                <div class="row">
                                  <div class="col mb-2">
                                    <div class="form-check form-switch mb-2">
                                      <input class="form-check-input" type="checkbox" id="chkPassport" name="publish_now" value="1">
                                      <label class="form-check-label" for="flexSwitchCheckChecked">Publish Now</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="submit" id="logo_color" class="btn btn-primary">Submit</button>
                              </div>
                              </form>
							</div>
                          </div>
                        </div>
				  <!-- Group -->
                <!-- Active -->
                                        <div class="modal fade" id="assignmentDelete" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Delete <span class="name"></span></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('assignment_change_status')}}" id="deleteAssignmentForm" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <span>Are you sure, you want to Delete <b class="name">Assignment</b></span>
                                                                    <input type="hidden" id="status_delete" name="status" value="0" />
                                                                    <input type="hidden" id="id_delete" name="assignment_id" />                                                                    
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
				</div>
              </div>
            </div>
            <div class="card-header flex-wrap justify-content-between gap-3 mb-3 mt-3 div_show dflex">
              <!-- <div class="align-items-center flex-wrap">
                <label>Filter:</label>
                <div id="reportrange" style="background: transparent; cursor: pointer; padding: 5px 10px; border: 1px solid #aaa; width: 100%;border-radius: 3px;">
                  <span></span> <i class="fa fa-caret-down"></i>
                </div>
              </div> -->
              <div class="align-items-center flex-wrap col-4">
                    <label for="selectpickerBasic" class="form-label">Filter By Classroom:</label>
                    <select id="filter" class="selectpicker w-100 sub_ject" data-style="btn-default">
                      <option value="">Select</option>
					  <option <?php echo (isset($_GET['filter']) && $_GET['filter'] ==1) ? 'selected':'' ?> value="1">OnGoing</option>
                      <option <?php echo (isset($_GET['filter']) && $_GET['filter'] ==2) ? 'selected':'' ?> value="2">Past</option>
                    </select>
                  </div>
              <div class="justify-content-md-end align-items-center flex-wrap mt-2">
                <?php if(isset($_GET['classroom_id']) && isset($_GET['subject_id'])) { ?>
				<form method="GET" action="{{ route('assignment_export') }}">
				<input type="hidden" name="classroom_id" value="<?php echo $_GET['classroom_id']; ?>">
				<input type="hidden" name="subject_id" value="<?php echo $_GET['subject_id']; ?>">
				<button type="submit" class="btn btn-label-dark waves-effect" style="float:right;">Export&nbsp;<i class="icon_resize ti ti-file-arrow-right ti-sm"></i></button>
				<br><br><br>
				</form>				
				<?php } ?>
			  </div>
            </div>
            <div class="card col-12 div_show">
              <div class="card-body table_admin text-nowrap">
                <table id="example" class="display" style="width:100%">
                  <thead>
                    <tr style="background-color: #f5c6cb30;">
                      <th>Homework</th>
                      <th>Teacher</th>
                      <th>Uploaded On</th>
                      <th>Delivery Date</th>
                      <th>Action</th>
                      <th>Student Response</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php if($assignments) { 
				  foreach($assignments as $assignment) {
				  ?>
                    <tr>
                      <td>
                        <div class="word_ellipsis" id="home_work" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $assignment->title }}" style="cursor:pointer;">{{ $assignment->title }}</div>
                      </td>
                      <td><?php 
					  $teacher_id=$assignment->teacher_id; 
					  $teacher=App\Models\User::find($teacher_id);
					  echo $teacher->first_name.' '.$teacher->last_name;
					  ?></td>
                      <td><?php
					  $originalDate = $assignment->created_at;
					 echo $uploaded_on = date("d-m-Y", strtotime($originalDate));?></td>
                      <td>{{ $assignment->delivery_date }}</td>
                      <td>
					  <?php if($assignment->publish_status==0 ) { ?>                       
						<span class="publish_icon" title="Share" data-bs-toggle="modal" data-publish_date="{{ $assignment->publish_date }}" data-id="{{ $assignment->id }}" data-bs-target="#share_assignment">
                          <span data-bs-toggle="tooltip" data-bs-placement="bottom" class="badge badge-center bg-primary" style="cursor: pointer;" aria-label="Share" data-bs-original-title="Share">
                            <i class="ti ti-share"></i>
                          </span>
                        </span>		
					  <?php } if($assignment->publish_status==1 ) { ?>
					  <span>
                          <span data-bs-toggle="tooltip" title="Shared" data-bs-placement="bottom" class="badge badge-center bg-success" style="cursor: pointer;" aria-label="Shared" data-bs-original-title="Shared">
                            <i class="ti ti-share-off"></i>
                          </span>
                        </span>
					  <?php } ?>
					  
                        <a id="btnShowJP" target="_blank" href="{{ asset('assignments/'.$assignment->assignment_pdf) }}">
                          <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Preview" class="badge bg-info badge-center" style="cursor: pointer;">
                            <i class="ti ti-eye"></i>
                          </a>
                        <div id="dialog" style="display: none"></div>
                        </span>
						<?php if ($show_edit == 1) { ?>
                        <span class="edit_ajax" data-id=<?php echo $assignment->id; ?> data-bs-toggle="modal" data-bs-target="#EditAssignment">
                          <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning" style="cursor: pointer;">
                            <i class="ti ti-edit"></i>
                          </span>
                        </span>
						<?php } ?>
						<?php if ($show_suspend == 1) { ?>						
                        <span>
                          <span data-id=<?php echo $assignment->id; ?> data-bs-toggle="modal" data-bs-target="#assignmentDelete" title="Delete" class="delete_ajax badge badge-center bg-danger" style="cursor: pointer;">
                            <i class="ti ti-trash"></i>
                          </span>
                        </span>
						<?php } ?>

                        <!-- Assignment Preview -->

                        <!--div class="modal fade" id="assignment_preview" tabindex="-1" aria-hidden="true" style="text-align: left;">
                          <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title mt-2" id="modalCenterTitle" style="text-align: center;">
                                  Homework 1
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-6 mb-2">
                                    <label for="lastname" class="form-label">Delivery Date</label>
                                    <input type="text" class="form-control" id="lastname" placeholder="" value="10-05-2024" readonly/>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col mb-2">
                                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="tiger.nixon@xxx.com" readonly/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div-->
                      </td>
                      <td>
					  <?php 
					  $submitted_answer_count=App\Models\AssignmentProgress::where('assignment_id',$assignment->id)->count(); 
					  if($submitted_answer_count==0)
					  {
					  ?>
                        <span class="badge badge-center rounded-pill bg-label-danger"><i class="ti ti-minus"></i></span>
                      <?php } if($submitted_answer_count>0) { ?>
					  <a href="{{ route('assignment_progress',$assignment->id ) }}" class="btn btn-label-success waves-effect studentlist">
                          Received
                          <span class="badge bg-label-danger badge-center ms-1"><?php echo $submitted_answer_count; ?></span>
                        </a>
					  <?php } ?>
					  </td>
                    </tr>
				  <?php } }?>
					</table>
              </div>
            </div>
          </div>

          <!-- Student Submitted Assignments -->
         <!-- Content -->
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

  <!-- endbuild -->
  <!-- Vendors JS -->

  <script>
    new DataTable('#example', {
      pagingType: 'simple_numbers'
    });
  </script>
  <script>
  $('#filter').change('click',function(){
	  var filter_id=$(this).val();
	  $('#filter_id').val(filter_id);
	  $('#firstForm').submit();
  });
  </script>
  
<script src="{{asset('assets/js/forms-pickers.js')}}"></script>
  <!-- Filter -->
  <!-- <script type="text/javascript">
    $(function() {

      var start = moment().subtract(29, 'days');
      var end = moment();

      function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }

      $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, cb);

      cb(start, end);

    });
  </script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
 -->
  <!-- Filter -->
  <script>
      $(document).ready(function() {

        

        $(".studentlist").click(function() {
          $("#admin_assignment").hide();
          

        });
        $("#teacherlist").click(function() {
         
          $("#admin_assignment").show();
        });
      });
    </script>
  <script>
    $(function() {
		var $_GET = <?php echo json_encode($_GET); ?>;
		if($_GET['classroom_id'] && $_GET['subject_id'])
		{
			$('.div_show').show();
			$('.subject_show').show();
			$('#add_assignnment').show();
		}
		else
		{
      $('.div_show').hide();
      $('.subject_show').hide();
      $('#add_assignnment').hide();
		}
      $('#selectpickerBasic1').change(function() {

        $(this).find("option:selected").each(function() {
          var optionValue = $(this).attr("value");
          if (optionValue) {			  
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
					  $('#selectpickerBasic2').html(select_content);						  
				  }
			  });
			   //ajax subjects
            $('.subject_show').show();
            $('#selectpickerBasic2').on('change',function() {
				//$("#firstForm").submit();
              //$(this).find("option:selected").each(function() {
				//var optionValue1 =  $('#selectpickerBasic1').val();
                var optionValue2 = $(this).val();
				//var classroom_id=$('#selectpickerBasic1').val();
				//var url=location.protocol + '//' + location.host + location.pathname+"?classroom_id="+classroom_id+"&subject_id="+optionValue2;
				//window.location.href =url;
                if (optionValue2) {
					
					//ajax teacher					
					 var subject_id=optionValue2;
					 $('#subjectID').val(subject_id);
					 var class_room_id=$('#selectpickerBasic1').val();					 
			  $.ajax({
				  url:'{{ route("get_teachers_by_subject_id") }}',
				  type:'get',
				  data:{
					  'class_room_id':class_room_id,
					  'subject_id':subject_id
				  },
				  success:function(response)
				  {
					 var teacher=response['teacher'];				 
					 var teacher_id=teacher.teacher_id;
					 var teacher_name=teacher.teacher_name;
					 
					  $('#teacherID').val(teacher_id);
					 $('#teachertitle').val(teacher_name);						  
				  }
			  });
					//ajax teacher
                  $('.div_show').show();
                  $(".dflex").css("display", "flex");
                  $('#add_assignnment').show();
                } else {
                  $('.div_show').hide();
                  $('#add_assignnment').hide();
                }

              //});
            });
          } else {
            $('.subject_show').hide();
            $('.div_show').hide();
            $('#add_assignnment').hide();
          }

        });
      });
    });
  </script>
  <script>
  $("#addAssignmentForm").submit(function(e){
	  e.preventDefault();
	  var class_room_id=$('#selectpickerBasic1').val();
	  var subject_id=$('#selectpickerBasic2').val();
	  $('#classRoomID').val(class_room_id);
	  $('#subjectID').val(subject_id);
	  var data = $('#addAssignmentForm').serializeArray();	  
	  $.ajax({
		  url:'{{ route("add_assignment") }}',
		  type:'POST',
		  data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,		  
		  success:function(response)
		  {
			  if(response['status']==true)
			  {
				  $('#assignment_title').removeClass('is-invalid');
			      $('#assignment_title_error').html("");
				  $('#delivery_date').removeClass('is-invalid');
			      $('#delivery_date_error').html("");
				  $('#assignment_file').removeClass('is-invalid');
			      $('#assignment_file_error').html("");
				 
				 
				 //$('#addAssignmentForm').trigger("reset");
				 $('#assignment_title').val('');
				 $('input[name="delivery_date"]').val('');
				 $('#assignment_file').val('');
				$('#add_assignment_success').show().html(response['message']);				 
			  }
			  else
			  {
			  var errors=response['errors'];
			  if(errors['assignment_title'])
			  {
			  $('#assignment_title').addClass('is-invalid');
			  $('#assignment_title_error').html("<b>"+errors['assignment_title']+"</b>");			  
			  }
			  else
			  {
			  $('#assignment_title').removeClass('is-invalid');
			  $('#assignment_title_error').html("");			  
			  }
			  
			  if(errors['delivery_date'])
			  {
			  $('#delivery_date').addClass('is-invalid');
			  $('#delivery_date_error').html("<b>"+errors['delivery_date']+"</b>");			  
			  }
			  else
			  {
			  $('#delivery_date').removeClass('is-invalid');
			  $('#delivery_date_error').html("");			  
			  }
			  
			  if(errors['assignment_file'])
			  {
			  $('#assignment_file').addClass('is-invalid');
			  $('#assignment_file_error').html("<b>"+errors['assignment_file']+"</b>");			  
			  }
			  else
			  {
			  $('#assignment_file').removeClass('is-invalid');
			  $('#assignment_file_error').html("");			  
			  }
			  }
		  },
		  error:function(jqXHR,exception)
		  {
			  console.log('Something Went Wrong');
		  }
	  });
  });
  
  </script>
  <script>
  $(".publish_icon").click(function(e){
	  $('#publish_assignment_success').hide();
	  $('#publish_assignment_success').html('');
	  var ass_id=$(this).attr("data-id");
	  var publish_date=$(this).attr("data-publish_date");
	  $('#publish_assignment_id').val(ass_id);
	  $('input[name="publish_date"]' ).val(publish_date) 
	  
  });
  $("#publishAssignment").submit(function(e){
	  e.preventDefault();
//var data = $('#publishAssignment').serializeArray();	  
	  $.ajax({
		  url:'{{ route("publish_assignment") }}',
		  type:'POST',
		  data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,		  
		  success:function(response)
		  {
			  if(response['status']==true)
			  {
			  $('#publish_assignment_success').show();
			  $('#publish_assignment_success').html(response['message']);
			  }
		  }
	  });
  });
  </script>
  <script>
  $("#editAssignmentForm").submit(function(e){
	  e.preventDefault();	  
	  var data = $('#editAssignmentForm').serializeArray();	  
	  $.ajax({
		  url:'{{ route("update_assignment") }}',
		  type:'POST',
		  data:new FormData(this),
   dataType:'JSON',
   contentType: false,
   cache: false,
   processData: false,		  
		  success:function(response)
		  {
			  if(response['status']==true)
			  {
				  $('#assignment_title_edit').removeClass('is-invalid');
			      $('#assignment_title_edit_error').html("");
				  $('#flatpickr-date-edit').removeClass('is-invalid');
			      $('#flatpickr-date-edit_error').html("");
				  $('#assignment_file_edit').removeClass('is-invalid');
			      $('#assignment_file_edit_error').html("");
				 
				 
				 //$('#addAssignmentForm').trigger("reset");
				 $('#assignment_title_edit').val('');
				 $('#flatpickr-date-edit').val('');
				 $('#assignment_file_edit').val('');
				$('#edit_assignment_success').show().html(response['message']);				 
			  }
			  else
			  {
			  var errors=response['errors'];
			  if(errors['assignment_title'])
			  {
			  $('#assignment_title_edit').addClass('is-invalid');
			  $('#assignment_title_edit_error').html("<b>"+errors['assignment_title']+"</b>");			  
			  }
			  else
			  {
			  $('#assignment_title_edit').removeClass('is-invalid');
			  $('#assignment_title_edit_error').html("");			  
			  }
			  
			  if(errors['delivery_date'])
			  {
			  $('#flatpickr-date-edit').addClass('is-invalid');
			  $('#flatpickr-date-edit_error').html("<b>"+errors['delivery_date']+"</b>");			  
			  }
			  else
			  {
			  $('#flatpickr-date-edit').removeClass('is-invalid');
			  $('#flatpickr-date-edit_error').html("");			  
			  }
			  
			  if(errors['assignment_file'])
			  {
			  $('#assignment_file_edit').addClass('is-invalid');
			  $('#assignment_file_edit_error').html("<b>"+errors['assignment_file']+"</b>");			  
			  }
			  else
			  {
			  $('#assignment_file_edit').removeClass('is-invalid');
			  $('#assignment_file_edit_error').html("");			  
			  }
			  }
		  },
		  error:function(jqXHR,exception)
		  {
			  console.log('Something Went Wrong');
		  }
	  });
  });
  
  </script>
  <script>
  $(".delete_ajax").click(function(){
	  var ass_id=$(this).attr("data-id");
	  $('#id_delete').val(ass_id);
  });
  $(".edit_ajax").click(function(){
	  var ass_id=$(this).attr("data-id");
	  //ajax edit assignment					 
			  $.ajax({
				  url:'{{ route("edit_assignment") }}',
				  type:'get',
				  data:{
					  'ass_id':ass_id
				  },
				  success:function(response)
				  {
					 var assignment_detail=response['assignment_detail'];				 
					 var title=assignment_detail.title;
					 var id=assignment_detail.id;
					 var delivery_date=assignment_detail.delivery_date;
					 var class_room_id=assignment_detail.class_room_id;
					 var subject_id=assignment_detail.subject_id;
					 var teacher_name=assignment_detail.teacher_name;
					 var teacher_id=assignment_detail.teacher_id;
					  
					  $('#assignment_ID_edit').val(id);
					 $('#assignment_title_edit').val(title);
					$("#flatpickr-date-edit").val(delivery_date);	
					$('#teacherIDedit').val(teacher_id);
					$('#teachertitle_edit').val(teacher_name);
					$('#classRoomIDedit').val(class_room_id);
					$('#subjectIDedit').val(subject_id);					
				  }
			  });
	  //ajax edit assignment
  });
  </script>
  <script>
      new DataTable('#example_student', {
        pagingType: 'simple_numbers'
      });
    </script>
  <script type="text/javascript">
      $(function() {
        var fileName = "Mudassar_Khan.pdf";
        $("#btnShow").click(function() {
          $(".layout-wrapper").fadeTo(200, 1);
          $("#dialog").dialog({
            modal: true,
            title: fileName,
            width: 600,
            height: 500,
            buttons: {
              Close: function() {
                $(this).dialog('close');
              }
            },
            open: function() {
              var object = "<object data=\"{FileName}\" type=\"application/pdf\" width=\"550px\" height=\"400px\">";
              object += "If you are unable to view file, you can download from <a href = \"{FileName}\">here</a>";
              object += " or download <a target = \"_blank\" href = \"http://get.adobe.com/reader/\">Adobe PDF Reader</a> to view the file.";
              object += "</object>";
              object = object.replace(/{FileName}/g, "Files/" + fileName);
              $("#dialog").html(object);
            }
          });

        });
      });
    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
    <link href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
      $("#chkPassport").change(function() {
        if(this.checked) {
          $('.publish_on').val('');
        }
        else{
        }
      });

      $(".publish_on").on("click",function(){
        if ($('#chkPassport').is(':checked')) {
          $('#chkPassport').prop('checked', false);
        }

      });
    </script>
</body>

</html>
