<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Exam</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.css')}}" />
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    //$branch_name = App\Models\Branch::getBranchNameByBranchId($data->branch_id);
    //$parent_name = App\Models\User::getParentNameByParentID($data->parent_id);*/
    ?>
    <style type="text/css">
     .student_examscreen #logo_color {
    background-color: <?php echo $org_color; ?> !important;
    border-color: <?php echo $org_color; ?> !important;
  }
  
  .student_examscreen .app-brand-logo.demo {
    width: auto !important;
    height: auto !important;
  }
  
  .student_examscreen .menu-vertical .app-brand {
    margin: 20px 0.875rem 20px 1rem;
  }
  
  .student_examscreen .icon_resize {
    font-size: 17px !important;
  }
  
  .student_examscreen #layout-menu .icon_resize {
    margin-right: 10px;
  }
  
  .student_examscreen #template-customizer .template-customizer-open-btn {
    display: none;
  }
  
  .alert-purple {
    background-color: #f61bf014;
    border-color: #f61bf014;
    color: #f61bf0;
  }
  
  .alert-blue {
    background-color: #43aeff4f;
    border-color: #43aeff4f;
    color: #43aeff;
  }
  
  ul#menu_list li {
    display: inline;
  }
  
  ul#menu_list li:first-child {
    margin-right: 10px;
  }
  
  #scroll_bar::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    background-color: #F5F5F5;
  }
  
  #scroll_bar::-webkit-scrollbar {
    width: 2px;
    background-color: #F5F5F5;
  }
  
  #scroll_bar::-webkit-scrollbar-thumb {
    background-color: <?php echo $org_color; ?>;
  }
  
  #div2,
  #div3 {
    display: none;
  }
  
  .clear {
    clear: both
  }
  
  #prev,
  #back2lists {
    color: #a8aaae !important;
    border-color: transparent !important;
    background: #f1f1f2 !important;
  }
  
  #next,
  #prev,
  #submit,
  #back2lists,
  #exam_submit {
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
    color: #fff;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    user-select: none;
    border: var(--bs-btn-border-width) solid var(--bs-btn-border-color);
    border-radius: var(--bs-btn-border-radius);
    transition: all 0.2s ease-in-out;
  }
  
  #prev,
  #submit {
    display: none;
    float: left;
  }
  
  #pagetitle {
    color: <?php echo $org_color; ?>;
  }
    </style>
</head>

<body class="add_student">
   <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
	
      <div class="container-xxl flex-grow-1 container-p-y" style="background: #dddddd59;">
       <form method="POST" action="{{ route('exam_screen_post') }}" id="jp_form">
	   @csrf
	   <input type="hidden" name="student_id" value="{{ $user_id; }}">
	   <input type="hidden" name="exam_id" value="{{ $exam->id; }}">
	   <div class="row mb-4">
          <div class="col-3 mb-2">
            <div class="alert alert-blue mb-0" role="alert">{{ $exam->exam_name}}</div>
          </div>
          <div class="col-3 mb-2">
            <div class="alert alert-purple" role="alert"><?php
						$subject_id=$exam->subject_id;
						$subject=App\Models\Subject::find($subject_id);
						echo $subject_name=$subject->subject_name;
						
						$duration=$exam->duration;
						$duration_arr=explode(':',$duration);
						$tot_minutes=0;
						$tot_minutes+=$duration_arr[0]*3600;
						$tot_minutes+=$duration_arr[1]*60;
						$tot_minutes+=$duration_arr[2];
						?></div>
          </div>
          <div class="col-3 mb-2">
          </div>
          <div class="col-3 mb-2">
            <h5 style="color:#FF0000;position:absolute;" align="center"><span id="iTimeShow">Time Remaining: </span><span id='timer' style="font-size:20px;"></span></h5>
          </div>
        </div>
        <div class="row mb-4 question_review" id="scroll_bar" style="background: #fff;border-radius: 10px;">
          <div class="col-9 mb-2 p-4" id="scroll_bar" style="max-height: 500px;overflow-y: scroll;">
            <?php
			$exam_id=$exam->id;
			$all_questions = App\Models\ExamQuestions::where('exam_id',$exam_id)->get();
			$final_all_questions=[];
			foreach($all_questions as $single_section)
			{
				$question_ids=$single_section->question_id;
				$question_id_arr=explode(',',$question_ids);
				foreach($question_id_arr as $question_id)
				$final_all_questions[]=array(
				'type' =>$single_section->question_type,
				'question_no' =>$question_id
				);
			}
			shuffle($final_all_questions);			
			?>
			<?php 
			$i=0;
			$j=1;
			$no_of_questions=count($final_all_questions);
			$jp_style='';
			foreach ($final_all_questions as $single_question) {
					if($j!=1)
						$jp_style='display:none;';
			if($i%5==0)
				echo '<div class="div'.$j.'" style="'.$jp_style.'"><h5>Section '.$j.'</h5>';
			//if( $single_question['type'] == 'mcq_1')
			//echo 'No '.$j.'-'.$single_question['type'].' - '.$single_question['question_no'].'<br>';
			//echo $question_no= $single_question['question_no'].'<br>';
			?>
			<input type="hidden" name="no_of_questions" value="<?php echo $no_of_questions; ?>">
			<input type="hidden" name="question_type[]" value="<?php echo $single_question['type']; ?>">
			<input type="hidden" name="question_no[]" value="<?php echo $single_question['question_no']; ?>">
			<!--Type 1 - Multiple Choice Single Answer-->
			<?php 
			if($single_question['type']=='mcq_1')
			{
				$single_ques=App\Models\QuestionTypeOne::find($single_question['question_no']);
			if($single_ques){
			?>
			<div class="col-12 row">
                <p><?php echo $i+1; ?>. <?php echo $single_ques->question_name; ?></p>
                <div class="form-check mb-3" style="padding-left:8%;">
                  <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques->option_a; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_a; ?>. </label>
                  <br>
                  <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques->option_b; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_b; ?>. </label>
                  <br>
                  <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)"  name="answer_<?php echo $i; ?>" value="<?php echo $single_ques->option_c; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_c; ?>. </label>
                  <br>
                  <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques->option_d; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques->option_d; ?>. </label>
                </div>
              </div>
			<?php } } ?>
			<!--Type 1 - Multiple Choice Single Answer-->
			<!--Type 2 - Multiple Choice Multiple Answer-->
			<?php 
			if($single_question['type']=='mcq_2')
			{
				$single_ques2=App\Models\QuestionTypeTwo::find($single_question['question_no']);
			if($single_ques2){
			?>
			<div class="col-12 row">
                <p><?php echo $i+1; ?>. <?php echo $single_ques2->question_name; ?></p>
                <div class="form-check mb-3" style="padding-left:8%;">
                  <input class="form-check-input" type="checkbox" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>[]" value="<?php echo $single_ques2->option_a; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques2->option_a; ?>. </label>
                  <br>
                  <input class="form-check-input" type="checkbox" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>[]" value="<?php echo $single_ques2->option_b; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques2->option_b; ?>. </label>
                  <br>
                  <input class="form-check-input" type="checkbox" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>[]" value="<?php echo $single_ques2->option_c; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques2->option_c; ?>. </label>
                  <br>
                  <input class="form-check-input" type="checkbox" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>[]" value="<?php echo $single_ques2->option_d; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques2->option_d; ?>. </label>
                </div>
              </div>
			<?php } } ?>
			<!--Type 2 - Multiple Choice Multiple Answer-->
			<!--Type 3 - Match the Following-->
			<?php 
			if($single_question['type']=='match_following')
			{
				$single_ques3=App\Models\QuestionTypeThree::find($single_question['question_no']);
			   if($single_ques3){
			?>
			<div class="col-12 row">
                <div class="row" id="match">
                  <p><?php echo $i+1; ?>. Match the Following</p>
                  <div class="col-lg-12 col-xl-12 col-12 mb-0">
                    <div class="row">
                      <div class="col-lg-6 col-xl-6 mb-0">
                        <ol type="A" style="line-height:180%">
                          <li><?php echo $single_ques3->option_a; ?></li>
                          <li><?php echo $single_ques3->option_b; ?></li>
                          <li><?php echo $single_ques3->option_c; ?></li>
                          <li><?php echo $single_ques3->option_d; ?></li>
                        </ol>
                      </div>
                      <div class="col-lg-6 col-xl-6 mb-0">
                        <ol type="1" style="line-height:180%">
                          <li><?php echo $single_ques3->option_1; ?></li>
                          <li><?php echo $single_ques3->option_2; ?></li>
                          <li><?php echo $single_ques3->option_3; ?></li>
                          <li><?php echo $single_ques3->option_4; ?></li>
                        </ol>
                      </div>
                    </div>
                  </div>
                  <div class="form-check mb-3" style="padding-left:8%;">
                    <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques3->choice_1; ?>" id="defaultCheck1" />
                    <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques3->choice_1; ?> </label>
                    <br>
                    <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques3->choice_2; ?>" id="defaultCheck1" />
                    <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques3->choice_2; ?> </label>
                    <br>
                    <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques3->choice_3; ?>" id="defaultCheck1" />
                    <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques3->choice_3; ?> </label>
                    <br>
                    <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques3->choice_4; ?>" id="defaultCheck1" />
                    <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques3->choice_4; ?> </label>
                  </div>
                </div>
              </div>
			   <?php }} ?>
			<!--Type 3 - Match the Following-->
			<!--Type 4 - Fill in Blanks-->
			<?php 
			if($single_question['type']=='fill_blanks')
			{
				$single_ques4=App\Models\QuestionTypeFour::find($single_question['question_no']);
			   if($single_ques4){
			?>
			<div class="col-12 row">
                <p><?php echo $i+1; ?>. <?php echo $single_ques4->question_name; ?></p>
                <div class="form-check mb-3" style="padding-left:8%;">
                  <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques4->option_a; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques4->option_a; ?>. </label>
                  <br>
                  <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques4->option_b; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques4->option_b; ?>. </label>
                  <br>
                  <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques4->option_c; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques4->option_c; ?>. </label>
                  <br>
                  <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques4->option_d; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques4->option_d; ?>. </label>
                </div>
              </div>
			   <?php }} ?>
			<!--Type 4 - Fill in Blanks-->
			<!--Type 5 - True or False-->
			<?php 
			if($single_question['type']=='true_false')
			{
				$single_ques5=App\Models\QuestionTypeFive::find($single_question['question_no']);
			   if($single_ques5){
			?>
			<div class="col-12 row">
                <p><?php echo $i+1; ?>. <?php echo $single_ques5->question_name; ?></p>
                <div class="form-check mb-3" style="padding-left:8%;">
                  <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques5->option_a; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques5->option_a; ?>. </label>
                  <br>
                  <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques5->option_b; ?>" id="defaultCheck1" />
                  <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques5->option_b; ?>. </label>
                  <br>
                  </div>
              </div>
			   <?php }} ?>
			<!--Type 5 - True or False-->
			<!--Type 6 - Short Questions -->
			<?php 
			if($single_question['type']=='short_answer')
			{
				$single_ques6=App\Models\QuestionTypeSix::find($single_question['question_no']);
			if($single_ques6){
			?>
			<div class="col-12 row">
                <p><?php echo $i+1; ?>.<?php echo $single_ques6->question_name; ?>?</p>
                <div class="form-check mb-3" style="padding-left:2%;">
                  <textarea class="form-control" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" rows="3"></textarea>
                </div>
              </div>
			<?php } } ?>
			<!--Type 6 - Short Questions -->
			<!--Type 7 - Order Sequencing-->
			<?php 
			if($single_question['type']=='order_sequence')
			{
				$single_ques7=App\Models\QuestionTypeSeven::find($single_question['question_no']);
			   if($single_ques7){
			?>
			<div class="col-12 row">
                <div class="row" id="match">
                  <p><?php echo $i+1; ?>. Order Sequencing</p>
                  <div class="col-lg-12 col-xl-12 col-12 mb-0">
				  <p><?php echo $single_ques7->question_name; ?></p>
                    <div class="row">
                      <div class="col-lg-6 col-xl-6 mb-0">
                        <ol type="A" style="line-height:180%">
                          <li><?php echo $single_ques7->option_a; ?></li>
                          <li><?php echo $single_ques7->option_b; ?></li>
                          <li><?php echo $single_ques7->option_c; ?></li>
                          <li><?php echo $single_ques7->option_d; ?></li>
                        </ol>
                      </div>                      
                    </div>
                  </div>
                  <div class="form-check mb-3" style="padding-left:8%;">
                    <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques7->option_1; ?>" id="defaultCheck1" />
                    <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques7->option_1; ?> </label>
                    <br>
                    <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques7->option_2; ?>" id="defaultCheck1" />
                    <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques7->option_2; ?> </label>
                    <br>
                    <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques7->option_3; ?>" id="defaultCheck1" />
                    <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques7->option_3; ?> </label>
                    <br>
                    <input class="form-check-input" type="radio" onchange="jp(<?php echo $i;?>)" name="answer_<?php echo $i; ?>" value="<?php echo $single_ques7->option_4; ?>" id="defaultCheck1" />
                    <label class="form-check-label mb-1" for="defaultCheck1"> <?php echo $single_ques7->option_4; ?> </label>
                  </div>
                </div>
              </div>
			   <?php }} ?>
			<!--Type 7 - Order Sequencing-->
			<?php 
			$i++;
			if($i%5==0)
			{
				echo '</div>';
				$j++;
				
			}
			}
			if($no_of_questions%5!=0) echo '</div>';?>
			</div>
          <div class="col-3 mb-2" style="border-left: 1px solid #ddd;">
            <ul class="p-0 mt-4" id="menu_list">
              <li class="mb-4 pb-1 justify-content-between align-items-center">
                <div class="badge bg-label-warning rounded p-2" id="mark_review" style="font-size: 12px;padding: 12px 15px ! important;border-radius: 15px 10px;">
                  0
                </div>
                <small>&nbsp;&nbsp;Marked For Review</small>
              </li>
            </ul>
            <hr/>
            <small class="mb-2"><b>Choose Page number to review the answer</b></small>
            <div class="demo-inline-spacing">
              <?php for( $i=1;$i<=$j;$i++){
				  
				  
				  ?>
              <button type="button"  id="button_<?php echo $i; ?>" data-no="{{ $i }}" data-tot="{{ $j }}" class="btn btn-icon btn-label-secondary bg-label-danger waves-effect jp_sect">
                <?php echo $i; ?>
              </button>
			  <?php } ?>
            </div>
            <br><br><br>
          </div>
        </div>
        
        <div class="row" id="question_button">
          <div class="col-4 mb-2">
          </div>
          <div class="col-2 mb-2">
            <button type="button" class="btn-label-secondary waves-effect" id="previous" style="display:none;" data-current_div="<?php echo 1; ?>" data-total_section="<?php echo $j; ?>" style="float:right;"><span class="ti-xs ti ti-chevrons-left me-1"></span>Previous</button>
          </div>
          <div class="col-2 mb-2">
            <button type="button" class="btn-primary waves-effect waves-light" id="next" data-current_div="<?php echo 1; ?>" data-total_section="<?php echo $j; ?>" style="background-color: <?php echo $org_color; ?> !important;    border-color: <?php echo $org_color; ?> !important;">Next<span class="ti-xs ti ti-chevrons-right me-1"></span></button>

            <button type="button" class="btn-success waves-effect waves-light overview_btn" id="submit_button" data-tot="<?php echo $no_of_questions; ?>" style="display:none; background-color: #28c76f !important;    border-color: #28c76f !important;">Submit</button>
          </div>
          <div class="col-4 mb-2">
          </div>
        </div>
		<div class="row mb-4 last_review">
          <div class="col-3 mb-2">
          </div>
          <div class="card col-6">
            <h3 class="card-header" id="pagetitle" style="text-align: center;">Preview</h3>
            <div class="card-body">
              <div class="row mb-4">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                  <label class="form-label">Answered</label>
                  <input type="text" class="form-control" id="answered" value="0" readonly />
                </div>
                <div class="col-md-5">
                  <label class="form-label">Not Answered</label>
                  <input type="text" class="form-control" id="not_answered" value="<?php echo $no_of_questions?>" readonly />
                </div>
                <div class="col-md-1"></div>
              </div>
              <div class="alert alert-info" role="alert">Click <b><< Back</b> to answer 5 questions</div>
            </div>
          </div>
          <div class="col-3 mb-2">
          </div>
        </div>
        <div class="row" id="preview_button">
          <div class="col-4 mb-2">
          </div>
          <div class="col-2 mb-2">
            <button type="button" class="btn-label-secondary waves-effect" id="back2lists" style="float:right;"><span class="ti-xs ti ti-chevrons-left me-1"></span>Back</button>
          </div>
          <div class="col-2 mb-2">
            <button type="submit" class="btn-success waves-effect waves-light" id="exam_submit" style="background-color: #28c76f !important;    border-color: #28c76f !important;" data-bs-toggle="modal" data-bs-target="#exam_page">Submit</button>
          </div>
          <div class="col-4 mb-2">
          </div>
        </div>
		</form>
		<div class="modal fade" id="exam_page" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col">
                        <h6>Are you sure, you want to submit the exam?</h6> </div>
                    </div>
                    <div class="modal-footer p-0">
                      <button type="button" class="btn btn-sm btn-label-danger" data-bs-dismiss="modal"> No </button>
                      
                        <button type="button" class="btn btn-sm btn-primary exam_screen" id="logo_color">Yes</button>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			<div class="modal fade" id="time_out" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col">
                        <h6>Timeout</h6> </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
			
      </div>
      <div class="content-backdrop fade"></div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
  </div>
   @include('dashboard.footer')
  <script type="text/javascript">
    $(document).ready(function() {
      $('.last_review').hide();
      $('#preview_button').hide();

      $('.overview_btn').click(function() {
        $('.last_review').show();
        $('#preview_button').show();
        $('.question_review').hide();
        $('#question_button').hide();
      });

      $('#back2lists').click(function() {
        $('.last_review').hide();
        $('#preview_button').hide();
        $('.question_review').show();
        $('#question_button').show();
      });
		$('.exam_screen').click(function(){
			$('#jp_form').submit();
		});
    });
  </script>

  <script type="text/javascript">
    var c = <?php echo $tot_minutes; ?>;
    var t;
    $(document).ready(function() {

      timedCount();

    });

    function timedCount() {
      if (c == 185) {
        return false;
      }

      var hours = parseInt(c / 3600) % 24;
      var minutes = parseInt(c / 60) % 60;
      var seconds = c % 60;
      var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds);
      $('#timer').html(result);

      if (c == 0) {
		  $('#time_out').modal('show');
		  $('#jp_form').submit();
        /*$(document).find(".preButton").text("View Answer");
        $(document).find(".nextButton").text("Play Again?");
        quizOver = true;
        return false;*/
		
      }

      c = c - 1;
      t = setTimeout(function() {
        timedCount()
      }, 1000);
    }
  </script>
  <script type="text/javascript">
  $('.jp_sect').click(function(){
	  let no=$(this).attr('data-no');
	  let tot=$(this).attr('data-tot');
	  $('#next').attr('data-current_div',no);
	  $('#previous').attr('data-current_div',no);
	  if(no==1)
	 {
		  $('#previous').hide();
		  $('#next').show();
		  $('#submit_button').css('display','none');
	  }
	  else if(no<tot)
	  {
		  $('#previous').show();
		  $('#next').show();
		   $('#submit_button').css('display','none');
	  }
	  else if(no==tot)
	  {
		  $('#previous').show();
		  $('#next').hide();
		   $('#submit_button').css('display','block');
	  }
	  
	  for(let i=1;i<=tot;i++)
	  $('.div'+i).hide();
  
		$('.div'+no).show();
  });
  
  $('#next').click(function() {
	  
  let current_div=$(this).attr('data-current_div');
  let total_section=$(this).attr('data-total_section');
  let next=parseInt(current_div)+1;
  $(this).attr('data-current_div',next);
  $('#previous').attr('data-current_div',next);
  
  if(next>1)
	  $('#previous').css('display','block');
  else 
	  $('#previous').css('display','none');
  
  if(next==total_section)
  {
	  $('#next').css('display','none');
	  $('#submit_button').css('display','block');
  }
  else 
	  $('#next').css('display','block');
  
  for(let i=1;i<=total_section;i++)
	  $('.div'+i).hide();
  
  $('.div'+next).show();
  
  });
  
  $('#previous').click(function() {
	  
  let current_div=$(this).attr('data-current_div');
  let total_section=$(this).attr('data-total_section');
  let prev=parseInt(current_div)-1;
  $(this).attr('data-current_div',prev);
  $('#next').attr('data-current_div',prev);
  
  if(prev<=1)
	  $('#previous').css('display','none');
  else 
  {
	  $('#previous').css('display','block');
	  $('#next').css('display','block');
	  $('#submit_button').css('display','none');
  }
	  
  if(prev==1)
	  $('#next').css('display','block');
  
  
  for(let i=1;i<=total_section;i++)
	  $('.div'+i).hide();
  
  $('.div'+prev).show();
  });
  const ans=[];
 function jp(q_no)
 {
	 var total_section=$('#next').attr('data-total_section');
	 var total=$('#submit_button').attr('data-tot');
	 if(!ans.includes(q_no))
	 ans.push(q_no);
	 var answered=ans.length;
	 var notanswered=parseInt(total)-parseInt(answered);
	 //alert(answered+'--'+notanswered);
	 $('#answered').val(answered);
	 $('#not_answered').val(notanswered);
	 //each section loop
	/*for(var i=1;i<=total_section;i++)
	 {
		 var num=parseInt(i)*5;
		 for(var j=0;j<num;j++)
		 {
		 if(ans.includes(j))
		 {
			 $('#button_'+i).addClass('bg-label-success');
			 $('#button_'+i).removeClass('bg-label-danger');
		 }
		 else 
		 {
			 $('#button_'+i).addClass('bg-label-danger');
			 $('#button_'+i).removeClass('bg-label-success');
		 }
		 }
	 }*/
 }
 $('#exam_submit').click(function(e){	 
	 e.preventDefault();
	 $('#exam_page').modal('show');
 });
  </script>
  <!--script type="text/javascript">
    $('#next').click(function() {
      $('.current').removeClass('current').hide().next().show().addClass('current');

      if ($('.current').hasClass('div3')) {
        $('#next').css('display', 'none');
        $('#submit').css('display', 'block');
      }
      $('#prev').css('display', 'block');
    });

    $('#prev').click(function() {
      $('.current').removeClass('current').hide().prev().show().addClass('current');

      if ($('.current').hasClass('first')) {
        $('#prev').css('display', 'none');
        $('#submit').css('display', 'none');
      }
      $('#next').css('display', 'block');
      $('#submit').css('display', 'none');
    });
  </script-->
</body>  
</html>
