<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Teacher Assignments</title>
    <meta name="description" content="" />
    <link rel="stylesheet" href="{{asset('assets/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/bootstrap-select/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/flatpickr/flatpickr.css')}}" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>
    <style type="text/css">
        .teacher_assignments .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .teacher_assignments .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .teacher_assignments .form-check-input:checked,
        .teacher_assignments .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .teacher_assignments .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .teacher_assignments .bg-primary {
            background-color: #7367f0 !important;
        }

        .teacher_assignments .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .teacher_assignments .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .teacher_assignments .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .teacher_assignments .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .teacher_assignments .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .teacher_assignments i {
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

        .teacher_assignments #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .add_org .form-label {
            font-size: 17px;
        }
    </style>
</head>

<body class="teacher_assignments">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('teacher_dashboard.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('teacher_dashboard.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <!-- Teacher Assignment -->
                    <div class="container-xxl flex-grow-1 container-p-y" id="teacher_assignment">
                        <div class="app-ecommerce mb-3">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="d-flex flex-column justify-content-center">
                                    <h4 class="mb-1 mt-3" id="pagetitle">Assignment Lists</h4>
                                </div>
                                <div class="d-flex align-content-center flex-wrap gap-3">
                                    <div class="d-flex gap-3">
                                        <button id="logo_color" class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addNewassignment">
                                            <span><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add Assignment</span></span>
                                        </button>
								
								
                                        <div class="modal fade" id="addNewassignment" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Add New Assignment</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
													<form id="addAssignmentForm" action="{{ route('teacher_add_assignment') }}" method="POST" enctype="multipart/form-data">
													@csrf
                                                    <div class="modal-body">
													<div style="display:none" id="add_assignment_success" class="alert alert-success" role="alert"></div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col">
                                                                <label for="smallSelect" class="form-label">Select Classroom<span class="text-danger">*</span></label>
                                                                <select id="class_room_id" name="class_room_id" class="form-select form-select-sm">
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
																<p id="class_room_id_error" style="color:red"></p>
                                                            </div>
                                                            <div class="col">
                                                                <label for="smallSelect" class="form-label">Select Subject<span class="text-danger">*</span></label>
                                                                <select id="subject_id" name="subject_id" class="form-select form-select-sm">
                                                                    <option value="">Select Subject</option>                                                                    
                                                                </select>
																<p id="subject_id_error" style="color:red"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col">
                                                                <label for="defaultSelect" class="form-label">Teacher<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="teachertitle" name="teachertitle" value="<?php $teacher_obj=App\Models\User::find($user_id); echo $teacher_obj->first_name.' '.$teacher_obj->last_name; ?>" aria-describedby="defaultFormControlHelp" readonly />
                                                                <input type="hidden" id="teacherID" name="teacherID" value="<?php echo $user_id; ?>" />
															</div>
                                                            <div class="col">
                                                                <label for="teacherdate" class="form-label">Delivery Date<span class="text-danger">*</span></label>
                                                               <input type="text" class="form-control" placeholder="DD-MM-YYYY" name="delivery_date" id="flatpickr-date" />
																<p id="delivery_date_error" style="color:red"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col">
                                                                <label for="teachertitle" class="form-label">Title<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="assignment_title" name="assignment_title" placeholder="Homework" aria-describedby="defaultFormControlHelp" />
                                                            <p id="assignment_title_error" style="color:red"></p>
															</div>
                                                            <div class="col">
                                                                <label for="teacherfile" class="form-label">Add File<span class="text-danger">*</span></label>
                                                                <input type="file" class="form-control" id="assignment_file" name="assignment_file" />
                                                            <p id="assignment_file_error" style="color:red"></p>
															</div>
                                                        </div>
                                                        <div class="alert alert-danger" role="alert" style="margin:0px;">Please fill all mandatory fields</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
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
													<form id="editAssignmentForm" action="{{ route('update_teacher_assignment') }}" method="POST" enctype="multipart/form-data">
													@csrf
                                                    <div class="modal-body">
													<div style="display:none" id="edit_assignment_success" class="alert alert-success" role="alert"></div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col">
															<input type="hidden" name="assignment_id" id="assignment_ID_edit" value="">
                                                                <label for="smallSelect" class="form-label">Select Classroom<span class="text-danger">*</span></label>
                                                                <select id="class_room_id_edit" name="class_room_id" class="form-select form-select-sm">
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
																<!--p id="class_room_id_edit_error" style="color:red"></p-->
                                                            </div>
                                                            <div class="col">
                                                                <label for="smallSelect" class="form-label">Select Subject<span class="text-danger">*</span></label>
                                                                <select id="subject_id_edit" name="subject_id" class="form-select form-select-sm">
                                                                    <option value="">Select Subject</option>
																	<?php if($subject) {																			
																		?>
																		<option selected value="<?php echo $subject['subject_id']; ?>"><?php echo $subject['subject_name']; ?></option>
																	<?php } ?>
                                                                </select>
																<!--p id="subject_id_edit_error" style="color:red"></p-->
                                                            </div>
                                                        </div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col">
                                                                <label for="defaultSelect" class="form-label">Teacher<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="teachertitle" name="teachertitle" value="<?php $teacher_obj=App\Models\User::find($user_id); echo $teacher_obj->first_name.' '.$teacher_obj->last_name; ?>" aria-describedby="defaultFormControlHelp" readonly />
                                                                <input type="hidden" id="teacherID_edit" name="teacherID" value="<?php echo $user_id ; ?>"/>
															</div>
                                                            <div class="col">
                                                                <label for="teacherdate" class="form-label">Delivery Date<span class="text-danger">*</span></label>
                                                               <input type="text" class="form-control" placeholder="DD-MM-YYYY" name="delivery_date" id="flatpickr-date-edit" />
																<p id="delivery_date_edit_error" style="color:red"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row g-2 mb-3">
                                                            <div class="col">
                                                                <label for="teachertitle" class="form-label">Title<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="assignment_title_edit" name="assignment_title" placeholder="Homework" aria-describedby="defaultFormControlHelp" />
                                                            <p id="assignment_title_edit_error" style="color:red"></p>
															</div>
                                                            <div class="col">
                                                                <label for="teacherfile" class="form-label">Add File<span class="text-danger">*</span></label>
                                                                <input type="file" class="form-control" id="assignment_file_edit" name="assignment_file" />
                                                            <p id="assignment_file_edit_error" style="color:red"></p>
															</div>
                                                        </div>
                                                        <div class="alert alert-danger" role="alert" style="margin:0px;">Please fill all mandatory fields</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                                    </div>
													</form>
                                                </div>
                                            </div>
                                        </div>
                                    
									</div>
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
														<form id="publishAssignment" action="{{ route('publish_teacher_assignment') }}" method="POST">							  
														@csrf							  
														<input type="hidden" name="publish_assignment_id" id="publish_assignment_id" value="">
							  	
                                                            <div class="modal-body">
															<div style="display:none" id="publish_assignment_success" class="alert alert-success" role="alert"></div>
                                                                <div class="row">
                                                                    <div class="mb-3 col-md-12">
                                                                        <label for="bs-rangepicker-single" class="form-label">Publish On</label>
                                                                        <input type="text" class="form-control publish_on" name="publish_date" placeholder="DD-MM-YYYY HH:MM" id="flatpickr-datetime" />
                                                                    </div>
                                                                </div>
                                                                <div class="divider">
                                                                    <div class="divider-text">OR</div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col mb-2">
                                                                        <div class="form-check form-switch mb-2">
                                                                            <input class="form-check-input" type="checkbox" name="publish_now" value="1" id="chkPassport">
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
                          
						    <div class="modal fade" id="assignmentDelete" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Delete <span class="name"></span></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('teacher_assignment_change_status')}}" id="deleteAssignmentForm" method="GET">
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
				
                        <div class="card mb-4">
                            <div class="card-body">
							<form id="fetchAssignments" method="GET">
                                <div class="row">
								@if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
                                    <!-- Basic -->
                                    <div class="col-md-4">
                                        <label for="selectpickerBasic" class="form-label">Classroom</label>
                                        <select id="selectpickerBasic" name="classroom_id" class="selectpicker w-100 select_classroom" data-style="btn-default">
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
                                </div>
								</form>
                            </div>
                        </div>

                        <div class="card col-12" id="list_assignments" <?php if(isset($_GET['classroom_id'])) { echo 'style="display:block"'; } else { echo 'style="display:none"'; }?>>
                            <div class="card-body table_admin text-nowrap">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr style="background-color: #f5c6cb30;">
                                            <th>Homework</th>
                                            <th>Subject</th>
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
					   $subject_id=$assignment->subject_id; 
					  $subject=App\Models\Subject::find($subject_id);
					  echo $subject->subject_name;
					  ?></td>
                                            <td><?php
					  $originalDate = $assignment->created_at;
					 echo $uploaded_on = date("d-m-Y", strtotime($originalDate));?></td>
                      <td>{{ $assignment->delivery_date }}</td>
                                            <td>
                      <?php if($assignment->publish_status==0 ) { ?>                       
						<span class="publish_icon" title="Publish" data-bs-toggle="modal" data-publish_date="{{ $assignment->publish_date }}" data-id="{{ $assignment->id }}" data-bs-target="#share_assignment">
                          <span data-bs-toggle="tooltip" data-bs-placement="bottom" class="badge badge-center bg-primary" style="cursor: pointer;" aria-label="Share" data-bs-original-title="Share">
                            <i class="ti ti-share"></i>
                          </span>
                        </span>		
					  <?php } if($assignment->publish_status==1 ) { ?>
					  <span>
                          <span data-bs-toggle="tooltip" title="Published" data-bs-placement="bottom" class="badge badge-center bg-success" style="cursor: pointer;" aria-label="Shared" data-bs-original-title="Shared">
                            <i class="ti ti-share-off"></i>
                          </span>
                        </span>
					  <?php } ?>
                        <a id="btnShowJP" target="_blank" href="{{ asset('assignments/'.$assignment->assignment_pdf) }}">
                          <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Preview" class="badge bg-info badge-center" style="cursor: pointer;">
                            <i class="ti ti-eye"></i>
							</span>
                          </a>
                        <div id="dialog" style="display: none"></div>
                        
                        <span class="edit_ajax" data-id=<?php echo $assignment->id; ?> data-bs-toggle="modal" data-bs-target="#EditAssignment">
                          <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" class="badge badge-center bg-warning" style="cursor: pointer;">
                            <i class="ti ti-edit"></i>
                          </span>
                        </span>
                        <span>
                          <span data-id=<?php echo $assignment->id; ?> data-bs-toggle="modal" data-bs-target="#assignmentDelete" title="Delete" class="delete_ajax badge badge-center bg-danger" style="cursor: pointer;">
                            <i class="ti ti-trash"></i>
                          </span>
                        </span>
                                            </td>
                                            <td>
					  <?php 
					  $submitted_answer_count=App\Models\AssignmentProgress::where('assignment_id',$assignment->id)->count(); 
					  if($submitted_answer_count==0)
					  {
					  ?>
                        <span class="badge badge-center rounded-pill bg-label-danger"><i class="ti ti-minus"></i></span>
                      <?php } if($submitted_answer_count>0) { ?>
					  <a href="{{ route('teacher_assignment_progress',$assignment->id ) }}" class="btn btn-label-success waves-effect studentlist">
                          Received
                          <span class="badge bg-label-danger badge-center ms-1"><?php echo $submitted_answer_count; ?></span>
                        </a>
					  <?php } ?>
					  </td>
                                        </tr>
									<?php }} ?>
                                        
                                    </tbody>
                                </table>
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
    <!-- Page JS -->
    <script src="{{asset('assets/js/forms-selects.js')}}"></script>
    <script src="{{asset('assets/select2/select2.js')}}"></script>
    <script src="{{asset('assets/bootstrap-select/bootstrap-select.js')}}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script>
        new DataTable('#example', {
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
    <script>
        $(document).ready(function() {

            $("#student_assigment").hide();

            $(".studentlist").click(function() {
                $("#teacher_assignment").hide();
                $("#student_assigment").show();

            });
            $("#teacherlist").click(function() {
                $("#student_assigment").hide();
                $("#teacher_assignment").show();
            });
        });
    </script>
    <script>
        new DataTable('#example_student', {
            pagingType: 'simple_numbers'
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
		  url:'{{ route("publish_teacher_assignment") }}',
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
$("#class_room_id").change(function(){
	 var class_room_id = $(this).val();
	 
	 //ajax subjects
	  $.ajax({
				  url:'{{ route("get_subjects_by_teacher_id") }}',
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
					  $('#subject_id').html(select_content);						  
				  }
			  });
			   //ajax subjects
	 //ajax subjects
});
$("#subject_id").change(function(){
	 var subject_id = $(this).val();
	 var class_room_id = $("#class_room_id").val();
	 //ajax teacher										 
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
});
</script>
<script>
  $("#addAssignmentForm").submit(function(e){
	  e.preventDefault();
	  var data = $('#addAssignmentForm').serializeArray();	  
	  $.ajax({
		  url:'{{ route("teacher_add_assignment") }}',
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
				  $('#class_room_id').removeClass('is-invalid');
			      $('#class_room_id_error').html("");
				  $('#subject_id').removeClass('is-invalid');
			      $('#subject_id_error').html("");
				  $('#assignment_title').removeClass('is-invalid');
			      $('#assignment_title_error').html("");
				  $('#delivery_date').removeClass('is-invalid');
			      $('#delivery_date_error').html("");
				  $('#assignment_file').removeClass('is-invalid');
			      $('#assignment_file_error').html("");
				 
				 
				 //$('#addAssignmentForm').trigger("reset");
				 //$('#class_room_id').val('');
				 $('#subject_id').val('');
				 $('#assignment_title').val('');
				 $('input[name="delivery_date"]').val('');
				 $('#assignment_file').val('');
				$('#add_assignment_success').show().html(response['message']);				 
			  }
			  else
			  {
			  var errors=response['errors'];
			  if(errors['class_room_id'])
			  {
			  $('#class_room_id').addClass('is-invalid');
			  $('#class_room_id_error').html("<b>"+errors['class_room_id']+"</b>");			  
			  }
			  else
			  {
			  $('#class_room_id').removeClass('is-invalid');
			  $('#class_room_id_error').html("");			  
			  }
			  if(errors['subject_id'])
			  {
			  $('#subject_id').addClass('is-invalid');
			  $('#subject_id_error').html("<b>"+errors['subject_id']+"</b>");			  
			  }
			  else
			  {
			  $('#subject_id').removeClass('is-invalid');
			  $('#subject_id_error').html("");			  
			  }
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
			  $('input[name="delivery_date"]').addClass('is-invalid');
			  $('#delivery_date_error').html("<b>"+errors['delivery_date']+"</b>");			  
			  }
			  else
			  {
			  $('input[name="delivery_date"]').removeClass('is-invalid');
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
   $(".delete_ajax").click(function(){
	  var ass_id=$(this).attr("data-id");
	  $('#id_delete').val(ass_id);
  });
  $(".edit_ajax").click(function(){
	  var ass_id=$(this).attr("data-id");
	  //ajax edit assignment					 
			  $.ajax({
				  url:'{{ route("edit_teacher_assignment") }}',
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
					$('#class_room_id_edit').val(class_room_id);
					$('#subject_id_edit').val(subject_id);					
				  }
			  });
	  //ajax edit assignment
  });
  $("#class_room_id_edit").change(function(){
	 var class_room_id = $(this).val();
	 
	 //ajax subjects
	  $.ajax({
				  url:'{{ route("get_subjects_by_teacher_id") }}',
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
					  $('#subject_id_edit').html(select_content);						  
				  }
			  });
			   //ajax subjects
	 //ajax subjects
});
  </script>
  <script>
  $("#editAssignmentForm").submit(function(e){
	  e.preventDefault();	  
	  var data = $('#editAssignmentForm').serializeArray();	  
	  $.ajax({
		  url:'{{ route("update_teacher_assignment") }}',
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
  $("#selectpickerBasic").change(function(){
	  var class_room_id=$(this).val();
	  $('#fetchAssignments').submit();
  });
  </script>
    <script>
        $(function() {
            //$('#list_assignments').hide();
            $('.select_classroom').change(function() {

                $(this).find("option:selected").each(function() {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $('#list_assignments').show();
                    } else {
                        $('#list_assignments').hide();
                    }

                });
            });
        });
    </script>
    <script src="{{asset('assets/js/forms-pickers.js')}}"></script>
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
