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
		    <div class="modal fade" id="add_response" tabindex="-1" aria-hidden="true" style="text-align: left;">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title mt-2" id="modalCenterTitle" style="text-align: center;">
                                  
                                </h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
								<form id="addAssignmentScore" action="" method="POST">
                                @csrf
								<div class="modal-body">
								<div style="display:none" id="add_score_success" class="alert alert-success" role="alert"></div>
                                  <div class="row g-2">
                                    <div class="col-6 mb-2">
                                      <label for="subject_name" class="form-label">Subject Name</label>
                                      <input type="text" class="form-control" name="subject_name" id="subject_name" placeholder="" value="" readonly />
										<input type="hidden" name="answer_progress_id" id="answer_progress_id">
									</div>
                                    <div class="col-6 mb-2">
                                      <label for="score" class="form-label">Score</label>
                                      <input type="text" class="form-control" name="score" id="score" placeholder="" value="" />
                                    <p id="score_error" style="color:red"></p>
									</div>
                                  </div>
                                  <div class="row mb-4">
                                    <div class="col mb-2">
                                      <label for="comments" class="form-label">Comments</label>
                                      <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
                                    <p id="comments_error" style="color:red"></p>
									</div>
                                  </div>
                                  <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                    <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">
                                      Cancel
                                    </button>
                                  </div>
                                </div>
                                </form>
							  </div>
                            </div>
                          </div>
             
			<div class="modal fade" id="assignmentReUpload" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Reupload <span class="name"></span></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{route('assignment_reupload_status')}}" id="reuploadAssignmentForm" method="GET">
                                                        
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <span>Are you sure, you want the student to Re upload <b class="name">Answer PDF</b></span>
                                                                    <input type="hidden" id="reupload_status" name="reupload_status" value="1" />
                                                                    <input type="hidden" id="id_reupload" name="answer_id" />                                                                    
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
          <!-- Student Submitted Assignments -->
          <div class="container-xxl flex-grow-1 container-p-y" id="student_assigment">
             @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
			<div class="app-ecommerce mb-3">
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div class="d-flex flex-column justify-content-center">
                  <h4 class="mb-1 mt-3" id="pagetitle">Student Lists</h4>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-3">
                  <a href="{{route('assignment')}}" class="btn btn-label-secondary btn-prev waves-effect" id="teacherlist">
                    <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Back</span>
                  </a>
                </div>
              </div>
              <div class="card-header d-flex flex-wrap justify-content-between gap-3 mb-3 mt-3">
                <div class="col-md-2">
                  <form id="filterForm">
				  <label for="selectpickerBasic" class="form-label"><b>Filter by Response Status</b></label>
                  <select id="selectpickerBasic" name="filter" class="selectpicker w-100 select_classroom" data-style="btn-default">
                    <option value="">Select</option>
					<option value="1">Sent</option>
                    <option value="0">Pending</option>
                  </select>
				  </form>
                </div>
                <div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
                  <form action="{{ route('assignment_progress_export') }}" method="GET">
				  <input type="hidden" name="assignment_id" value="<?php echo $assignment_id; ?>">
				  <button type="submit" class="btn btn-label-dark waves-effect" style="float:right;">Export&nbsp;<i class="icon_resize ti ti-file-arrow-right ti-sm"></i></button>
                </form>
				</div>
              </div>
              <div class="card col-12">
                <div class="card-body table_admin text-nowrap">
                  <table id="example_student" class="display" style="width:100%">
                    <thead>
                      <tr style="background-color: #f5c6cb30;">
                        <th>Student Name</th>
                        <th>Submitted On</th>
                        <th>File</th>
                        <th>Add Score</th>
						<th>status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if($answers){
							foreach($answers as $answer) {
						?>
                      <tr>
                        <td><?php $student=App\Models\User::find($answer->student_id);
						$student_name=$student->first_name.' '.$student->last_name;			
						echo $student_name;
						?> </td>
                        <td><?php
						if( isset($answer->updated_at))
						echo $newDate = date("d-m-Y", strtotime($answer->updated_at));
						?></td>
                        <td>
						<?php if(isset($answer->answer_pdf)) { 
						if($answer->teacher_download_status==1){
						?>
						<a target="_blank" download="assignment_answer_file" href="{{ asset('assets/pdf/student_assignment/answer_file/'.$answer->answer_pdf) }}"><span id="answer_file" class="badge bg-label-warning" data-id="{{ $answer->id }}" style="cursor:pointer;">Downloaded</span></a>
						<?php } else { ?>
						<a target="_blank" download="assignment_answer_file" href="{{ asset('assets/pdf/student_assignment/answer_file/'.$answer->answer_pdf) }}"><span id="answer_file" class="badge bg-label-primary" data-id="{{ $answer->id }}" style="cursor:pointer;">Download</span></a>
						<?php }} else { ?>
						<span class="badge bg-label-warning" style="cursor:pointer;">Downloaded</span>
						<?php } ?>
						</td>
                        <td>
						<?php if(isset($answer->score)) { ?>
                        <span data-bs-toggle="modal">
							<span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Score Added" class="badge bg-success badge-center" style="cursor: not-allowed;">
								<i class="ti ti-satellite"></i>
							</span>
						</span>
						<?php } else { ?>
						<span data-bs-toggle="modal" class="score_add" data-assignment_id=<?php echo $answer->assignment_id; ?> data-answer_progress_id=<?php echo $answer->id; ?> data-student_name="<?php echo $student_name; ?>" data-bs-target="#add_response">
                          <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add Score" class="badge bg-info badge-center" style="cursor: pointer;">
                            <i class="ti ti-pointer-share"></i>
                          </span>
                          </span>
						<?php } ?>
                          <!-- Score Board -->
                        </td>						
                        <td>
						<?php if($answer->answer_response_status==1) { ?>
                          <span class="badge bg-label-success">Response Sent</span>
						<?php } else {?>
						  <span class="badge bg-label-warning">Pending</span>
							<?php } ?>
                        </td>
						<td>
							<span>
								<span data-id=<?php echo $answer->id; ?> data-bs-toggle="modal" data-bs-target="#assignmentReUpload" title="Reset" class="badge badge-center bg-secondary reupload_ajax" style="cursor: pointer;">
									<i class="ti ti-repeat-once"></i>
								</span>
							</span>
						</td>
                      </tr>
					<?php } } ?>
                   </tbody>

                  </table>
                </div>
              </div>
            </div>
            <!-- Content -->
            <div class="content-backdrop fade"></div>
          </div>
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
$('#answer_file').click(function(){
	$('#answer_file').removeClass('bg-label-primary').addClass('bg-label-warning').html('Downloaded');
	var ans_id=$(this).data("id");
	$.ajax({
				  url:'{{ route("assignment_teacher_upload_status") }}',
				  type:'get',
				  data:{
					  'ans_id':ans_id
				  },
				  success:function(response)
				  {
					 console.log(response);						  
				  }
			  });
});
$('.score_add').click(function(){
	$('#add_score_success').hide();
				  $('#add_score_success').html('');
	var answer_progress_id=$(this).attr("data-answer_progress_id");
	var student_name=$(this).attr("data-student_name");
	var assignment_id=$(this).attr("data-assignment_id");
	$('#answer_progress_id').val(answer_progress_id);
	$('#modalCenterTitle').html(student_name);
	//ajax subject
	$.ajax({
				  url:'{{ route("get_subjects_by_assignment_id") }}',
				  type:'get',
				  data:{
					  'assignment_id':assignment_id
				  },
				  success:function(response)
				  {
					 var subject=response['subject'];				 
					 var subject_name=subject.subject_name;
					 $('#subject_name').val(subject_name);						  
				  }
			  });
	//ajax subject
});

$("#addAssignmentScore").submit(function(e){
	e.preventDefault();
	 $.ajax({
		  url:'{{ route("add_assignment_score") }}',
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
				  $('#add_score_success').show();
				  $('#add_score_success').html(response['message']);
				  location.reload();
			  }
			  else
			  {
				  var errors=response['errors'];
			  if(errors['score'])
			  {
			  $('#score').addClass('is-invalid');
			  $('#score_error').html("<b>"+errors['score']+"</b>");			  
			  }
			  else
			  {
			  $('#score').removeClass('is-invalid');
			  $('#score_error').html("");			  
			  }
			  
			  if(errors['comments'])
			  {
			  $('#comments').addClass('is-invalid');
			  $('#comments_error').html("<b>"+errors['comments']+"</b>");			  
			  }
			  else
			  {
			  $('#comments').removeClass('is-invalid');
			  $('#comments_error').html("");			  
			  }
			  }
		  }
	 });
});
</script>
  <script>
    new DataTable('#example', {
      pagingType: 'simple_numbers'
    });
	$("#selectpickerBasic").change(function(){
		$("#filterForm").submit();
	});
  </script>
<script src="{{asset('assets/js/forms-pickers.js')}}"></script>
  <script>
      new DataTable('#example_student', {
        pagingType: 'simple_numbers'
      });
    </script>
	<script>
	$(".reupload_ajax").click(function(){
	  var ans_id=$(this).attr("data-id");
	  $('#id_reupload').val(ans_id);
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

</body>

</html>
