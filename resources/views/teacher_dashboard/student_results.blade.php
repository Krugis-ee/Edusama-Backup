<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Teacher Assessments</title>
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
      @include('teacher_dashboard.sidebar')
      <div class="layout-page">
        <!-- Navbar -->
        @include('teacher_dashboard.navbar')
        <!-- / Navbar -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y" id="admin_assignment">
            <div class="app-ecommerce mb-3">
              
			  
			<!-- Student Assessment List -->
          <div class="container-xxl flex-grow-1 container-p-y" id="student_assessment">
            <div class="app-ecommerce mb-3">
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div class="d-flex flex-column justify-content-center">
                  <h4 class="mb-1 mt-3" id="pagetitle">Student Lists</h4>
                </div>
                <div class="d-flex align-content-center flex-wrap gap-3">
                  <button class="btn btn-label-secondary btn-prev waves-effect" id="adminassessmentlist">
                    <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                    <span class="align-middle d-sm-inline-block d-none">Back</span>
                  </button>
                </div>
              </div>
              <div class="card-header d-flex flex-wrap justify-content-between gap-3 mb-3 mt-3">
                <div class="col-md-2">
                  <label class="form-label"><b>Filter by Status</b></label>
                  <select id="defaultSelect" class="form-select select_classroom">
                    <option value="all">All</option>
                    <option value="attended">Attended</option>
                    <option value="not_attended">Not Attended</option>
                  </select>
                </div>
                <div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
                  <button type="button" class="btn btn-label-dark waves-effect" style="float:right;">Export&nbsp;<i class="icon_resize ti ti-file-arrow-right ti-sm"></i></button>
                </div>
              </div>
              <div class="card col-12">
                <div class="card-body table_admin text-nowrap">
                  <table id="assessment_student" class="display" style="width:100%">
                    <thead>
                      <tr style="background-color: #f5c6cb30;">
                        <th>Student Name</th>
                        <th>Submitted On</th>
                        <th>Status</th>
                        <th>Result</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if($students_arr){ 
					foreach($students_arr as $student_id){
						$result=App\Models\ExamScores::where('exam_id',$exam_id)->where('student_id',$student_id)->first();
					?>
                      <tr>
                        <td><?php //$student_id=$result->student_id; 
						$student=App\Models\User::find($student_id);
						echo $student_name=$student->first_name.' '.$student->last_name;
						?></td>
                        <td><?php 
						if($result)
						{
						$date=date_create($result->created_at); 
					echo date_format($date,"d/m/Y");
						}
						else
						{
							echo '-';
						}
						?></td>
                        <td>
						<?php if($result)
						{ ?>
                          <span class="badge bg-label-success">Attended</span>
						<?php } else { ?>
						<span class="badge bg-label-danger">Not Attended</span>
						<?php } ?>
                        </td>
                        <td>
                          <?php
						  
					  if($result)
					  {
						  $exam=App\Models\Exam::find($result->exam_id);
						   $passing_mark=$exam->passing_mark;
						   $total_marks=$exam->total_marks;
						  $attend_status=1;
						  $score=$result->score;
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
						<?php if($result)
					  { ?>
                          <span style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#scoreboard_preview_modal">
                            <span data-bs-toggle="tooltip" data-score="{{ $score }}" data-total="{{ $total_marks }}" data-result_status="{{ $result_status }}" data-bs-placement="bottom" data-bs-original-title="Score Board" class="jp_click badge badge-center bg-info bg-glow"><i class="ti ti-scoreboard"></i></span>
                          </span>
							<form action="{{ route('get_student_single_result') }}" class="scoreboard_preview" style="cursor:pointer;">
							<input type="hidden" name="student_id" value="{{ $student_id }}">
							<input type="hidden" name="exam_id" value="{{ $exam->id }}">
                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Score Board" class="jp_exam_preview badge badge-center bg-danger bg-glow"><i class="ti ti-scoreboard"></i></span>
                          </form> 
					  <?php } ?>						  
                        </td>
                      </tr>
					<?php }} ?>
                     </tbody>
                  </table>
				  <div class="modal fade" id="scoreboard_preview_modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title mt-3" id="modalCenterTitle">Score Board</h5>
                                </div>
                                <div class="modal-body">
                                  <div class="row mb-3 g-3">
                                    <div class="col-md-6">
                                      <label class="form-label">Mark Scored</label>
                                      <input type="text" class="form-control" id="jp_score" value="40" readonly /> </div>
                                    <div class="col-md-6">
                                      <label class="form-label">Total Marks</label>
                                      <input type="text" class="form-control" id="jp_total" value="100" readonly /> </div>
                                    <div class="col-md-12 jp_div">
                                      <div class="alert alert-success" role="alert">Result: <b>Passed</b></div>
                                    </div>
                                  </div>
                                  <div class="modal-footer p-0">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="logo_color">Submit</button>
                                    <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                </div>
              </div>
            </div>
            <!-- Content -->
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
  
  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  <!-- Drag Target Area To SlideIn Menu On Small Screens -->
  <div class="drag-target"></div>
  
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
<script>
    $(function() {
		$('.jp_exam_preview').click(function(){
			//$('.scoreboard_preview').submit();
			  $(this).parents('form:first').submit();
		});
		$('.jp_click').click(function(){
			var score = $(this).attr('data-score');
			$('#jp_score').val(score);
			var total = $(this).attr('data-total');
			$('#jp_total').val(total);
			
			var result_status = $(this).attr('data-result_status');
			if(result_status=='Passed')
				$('.jp_div').html('<div class="alert alert-success" role="alert">Result: <b>Passed</b></div>');
			if(result_status=='Failed')
				$('.jp_div').html('<div class="alert alert-danger" role="alert">Result: <b>Failed</b></div>');
		
		});
      
  new DataTable('#assessment_student', {
      scrollX: true
    });
      $('#assessment_branch').change(function() {
			$('#get_form').submit();      
          
			  
            $('#classroom_assessment').show();
            $('#subject_assessment').show();
            $('#assessment_lists').show();
          

       
      });
	  $('#assessment_classroom').change(function() {
			$('#get_form').submit();      
          
			  
            $('#classroom_assessment').show();
            $('#subject_assessment').show();
            $('#assessment_lists').show();
          

       
      });
$('#assessment_subject').change(function() {
			$('#get_form').submit();      
          
			  
            $('#classroom_assessment').show();
            $('#subject_assessment').show();
            $('#assessment_lists').show();
          

       
      });
    });
  </script>
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
    <script>
        $(function() {
            // $('#suspend').on("click",function() {
            $("#example").on("click", ".toggle-class", function() {

                if ($(this).data('type') == 1) {
                    var exam_id = $(this).data('id');
                    $("#id").val(exam_id);
                    //$(".name").html($(this).data('name'));
                    $("#org_active").modal('show');
                } else if ($(this).data('type') == 2) {
                    var exam_id = $(this).data('id');
                    $("#id_active").val(exam_id);
                    //$(".name").html($(this).data('name'));
                    $("#org_suspend").modal('show');
                }
            });
			$('.edit_exam').click(function(){
				
				var id=$(this).attr('data-id');
				var exam_name=$(this).attr('data-exam-name');
				var class_name=$(this).attr('data-cls-name');
				var subj_name=$(this).attr('data-subject-name');
				$.ajax({
                url: '{{ route("get_exam_by_exam_id") }}',
                type: 'GET',
                data: {
                    'id': id,
                },
                success: function(response) {
                    var exam = response['exam'];
					$('.jp_exam_name').html(exam_name);
					$('.jp_cls_name').val(class_name);
					$('.jp_subj_name').val(subj_name);
					$('.jp_exam_id').val(exam.id);
					$('#total_marks').val(exam.total_marks);
					$('#passing_mark').val(exam.passing_mark);
					$('.exam_end_date').val(exam.exam_end_date);
					$('.duration').val(exam.duration);
                    console.log(exam.id);
                    
                }
            });
			});
        });
    </script>

</body>

</html>
