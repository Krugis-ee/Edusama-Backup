<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Parent Assessment</title>
    <meta name="description" content="" />
    <link rel="stylesheet" href="{{asset('assets/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/bootstrap-select/bootstrap-select.css')}}" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>
    <style type="text/css">
        .add_parent .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .add_parent .form-check-input:checked,
        .add_parent .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .add_parent .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .add_parent i {
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

        .add_parent #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .add_org .form-label {
            font-size: 17px;
        }
    </style>
</head>

<body class="add_parent">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('parent_dashboard.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('parent_dashboard.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="app-ecommerce mb-4">
              <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                <div class="card-title mb-3 me-1">
                  <h4 class="mb-0 mt-3" id="pagetitle">Assessment Lists</h4>
                </div>
				<form method="GET" id="studentForm">
                <div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap mb-3">
                  <select id="defaultSelect" onchange="this.form.submit()" name="student_id" id="student_id" class="form-select">
                          <option value="">Select Child</option>
                          <?php if($students) { 
						  foreach($students as $student) { ?>
						  <option value="{{$student->id}}">{{$student->first_name.' '.$student->last_name}}</option>
                          <?php } } ?>
                        </select>
                </div>
				</form>
              </div>
            </div>
            <!-- <button type="button" class="btn btn-label-dark waves-effect mb-3" style="float:right;">Export&nbsp;<i class="icon_resize ti ti-file-arrow-right ti-sm"></i></button> -->
            <div class="card col-12">
              <div class="card-body table_admin text-nowrap">
                <table id="example" class="display" style="width:100%">
                  <thead>
                    <tr style="background-color: #f5c6cb30;">
                      <th>Exam Name</th>
                      <th>Subject</th>
                      <th>Last Date</th>
                      <th>Result</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php if($exams) {
						foreach($exams as $exam) {
					  ?>
                    <tr>
                      <td>
                        <div class="word_ellipsis" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $exam->exam_name }}" style="cursor:pointer;">{{ $exam->exam_name }}</div>
                      </td>
                      <td><?php
						$subject_id=$exam->subject_id;
						$subject=App\Models\Subject::find($subject_id);
						echo $subject_name=$subject->subject_name;
						?></td>
                      <td><?php echo $exam->exam_end_date; ?></td>
                      <td>
					  <?php
					  $student_id=$_GET['student_id'];
					  $exam_score=App\Models\ExamScores::where('exam_id',$exam->id)->where('student_id',$student_id)->first();
					  $score='';
					  $passing_mark=$exam->passing_mark;
					  if($exam_score)
					  {
						  $attend_status=1;
						  $score=$exam_score->score;
					  if($score>=$passing_mark)
					  {
						  echo '<span class="badge bg-success bg-glow">Passed</span>';
						  $result_status='Passed';
					  }
					  else if($score<$passing_mark)
					  {
						  echo '<span class="badge bg-danger bg-glow">Failed</span>';
						  $result_status='Failed';
					  }
					  }
					  else 
					  {						  
						  $attend_status=0;
						  $result_status='';
						  echo ' - ';
					  }
					  ?>
					  </td>
                      <td>
					  <?php if($attend_status==1) { ?>
					  <span class="badge bg-label-success">Attended</span>
					  <?php } if($attend_status==0) {?>
					  <span class="badge bg-label-danger">Not Attended</span>
						<?php } ?>
					  </td>
                      <td> 
					  <?php if($attend_status) { ?>
                        <span data-bs-toggle="modal" id="jp_score_board" data-result_status="{{ $result_status }}" data-score="{{ $exam_score-> score}}" data-submitted_on="{{ $exam_score->created_at }}" data-subj_name="{{ $subject_name }}" data-exam_name="{{ $exam->exam_name }}" data-bs-target="#scoreboard_preview" style="cursor:pointer;">
                          <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Score Board"  class="badge badge-center bg-info bg-glow"><i class="ti ti-scoreboard"></i></span> </span>
					  <?php } ?>
                        </div>
                      </td>
                    </tr>
				  <?php }} ?>
				  <div class="modal fade" id="scoreboard_preview" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header d-flex justify-content-between">
                                <h5 class="modal-title" id="modalCenterTitle">
                                  Exam 1
                                </h5> <span id="pass_status" class="badge bg-label-success"></span> </div>
                              <div class="modal-body" style="text-align: left;">
                                <div class="row g-2">
                                  <div class="col mb-2">
                                    <label for="assign_score" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="exam_subject_name" value="Subject 1" readonly/> </div>
                                  <div class="col mb-2">
                                    <label for="received_on" class="form-label">Submitted On</label>
                                    <input type="text" class="form-control" id="received_on" placeholder="" value="12-05-2024" readonly/> </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-2">
                                    <label for="assign_score" class="form-label">Score</label>
                                    <input type="text" class="form-control" id="total_score" placeholder="" value="50" readonly/> </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                </div>
                            </div>
                          </div>
                        </div>
                    </tbody>
                </table>
              </div>
            </div>
                <!-- Content -->
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
   @include('dashboard.footer')
  <script src="{{asset('assets/bootstrap-select/bootstrap-select.js')}}"></script>
  <link rel="stylesheet" href="{{asset('assets/bootstrap-select/bootstrap-select.css')}}" />

  <script src="{{asset('assets/js/forms-pickers.js')}}"></script>
  <script src="{{asset('assets/jquery-timepicker/jquery-timepicker.js')}}"></script>
  <script src="{{asset('assets/flatpickr/flatpickr.js')}}"></script>
  <script src="{{asset('assets/bootstrap-select/bootstrap-select.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script type="text/javascript">
        new DataTable('#example', {
            pagingType: 'simple_numbers'
        });
    </script>
    
    <script>
    
	$('#example tbody').on('click', '#jp_score_board', function () {
				//$('#jp_score_board').click(function(){
					var exam_name=$(this).attr('data-exam_name');
					var subj_name=$(this).attr('data-subj_name');
					var submitted_on=$(this).attr('data-submitted_on');
					var tot_score=$(this).attr('data-score');
					var result_status=$(this).attr('data-result_status');
					
					$('#modalCenterTitle').html(exam_name);
					$('#exam_subject_name').val(subj_name);
					$('#received_on').val(submitted_on);
					$('#total_score').val(tot_score);
					if(result_status=='Passed')
					{
						$('#pass_status').removeClass('bg-label-danger');
						$('#pass_status').addClass('bg-label-success');
					}
					if(result_status=='Failed')
					{
						$('#pass_status').removeClass('bg-label-success');
						$('#pass_status').addClass('bg-label-danger');
					}
					$('#pass_status').html(result_status);
				});
    </script>
</body>

</html>