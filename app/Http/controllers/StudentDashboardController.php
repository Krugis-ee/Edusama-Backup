<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRoomTimings;
use App\Models\ClassRooms;
use App\Models\User;
use App\Models\Exam;
use App\Models\ExamAnswers;
use App\Models\ExamScores;
use App\Models\QuestionTypeOne;
use App\Models\QuestionTypeTwo;
use App\Models\QuestionTypeThree;
use App\Models\QuestionTypeFour;
use App\Models\QuestionTypeFive;
use App\Models\QuestionTypeSix;
use App\Models\QuestionTypeSeven;
use App\Models\Country;
use App\Models\Assignment;
use App\Models\AssignmentProgress;
use App\Models\ClassRoomSubjectTeachers;
use App\Models\ClassRoomDetail;
use App\Models\CourseCurriculam;
use Illuminate\Support\Facades\Hash;
use DB;
class StudentDashboardController extends Controller
{
    public function dashboard()
    {
        return view('student_dashboard.home');
    }
	public function assessment()
	{
		$user_id = session()->get('loginId');
		$class_rooms = DB::table('class_room_subject_teachers')
    ->whereRaw('FIND_IN_SET('.$user_id.', students_id)')
	->select('class_room_id')
	->groupBy('class_room_id')
    ->get();
	$cls_room_ids=[];
	foreach ($class_rooms as $class_room) {	
      array_push($cls_room_ids,$class_room->class_room_id);
	}
	$exams=Exam::whereIn('class_room_id',$cls_room_ids)->get();
	return view('student_dashboard.assessment',['exams'=>$exams]);
	}
	public function exam_screen($id)
	{
		$exam=Exam::find($id);
		return view('student_dashboard.exam_screen',['exam'=>$exam]);
	}
	public function exam_screen_post(Request $request)
	{
		//dd($request);		
		$no_of_questions=$request->no_of_questions;
		$question_type=$request->question_type;
		$question_no=$request->question_no;
		$exam_id=$request->exam_id;
		$single_exam=Exam::find($exam_id);
		$total_marks=$single_exam->total_marks;
		$total_score=0;
		$score_sing=0;
		$single_question_score=$total_marks/$no_of_questions;
		for($i=0;$i<$no_of_questions;$i++)
		{
			$score_sing=0;
			$answer_val='answer_'.$i;
			$answer_given=$request->$answer_val;
			$answer=new ExamAnswers;
			$answer->student_id=$request->student_id;
			$answer->exam_id=$request->exam_id;
			$answer->question_type=$question_type[$i];
			$answer->question_no=$question_no[$i];
			if(is_array($answer_given))
				$answer_value=implode(',',$answer_given);
			else
				$answer_value=$answer_given;
			$answer->answer=$answer_value;
			
			//score				
			if($question_type[$i]=='mcq_1')
			{
				$single_ques1=QuestionTypeOne::find($question_no[$i]);
					if($single_ques1->answer==$answer_value)
					{
						
					$score_sing=$single_question_score;
					$total_score+=$single_question_score;
					}
			}
			if($question_type[$i]=='mcq_2')
			{
				$single_ques2=QuestionTypeTwo::find($question_no[$i]);
				$right_ans_arr=explode(',',$single_ques2->answer);
				//$student_ans_arr=explode(',',$answer_value);
				$student_ans_arr=$answer_given;
				$result_jp_arr=[];
				if(is_array($student_ans_arr))
				$result_jp_arr=array_intersect($right_ans_arr,$student_ans_arr);
				
				if(count($right_ans_arr)==count($result_jp_arr))
				{
						
					$score_sing=$single_question_score;
					$total_score+=$single_question_score;
				}
				
				
			}
			if($question_type[$i]=='match_following')
			{
					$single_ques3=QuestionTypeThree::find($question_no[$i]);
					if($single_ques3->answer==$answer_value)
					{
					$score_sing=$single_question_score;
					$total_score+=$single_question_score;
					}
			}
			if($question_type[$i]=='fill_blanks')
			{
				$single_ques4=QuestionTypeFour::find($question_no[$i]);
					if($single_ques4->answer==$answer_value)
					{
					$score_sing=$single_question_score;
					$total_score+=$single_question_score;
					}
			}				
			if($question_type[$i]=='true_false')
			{
				$single_ques5=QuestionTypeFive::find($question_no[$i]);
					if($single_ques5->answer==$answer_value)
					{
					$score_sing=$single_question_score;
					$total_score+=$single_question_score;
					}
			}				
			if($question_type[$i]=='short_answer')
			{
				$single_ques6=QuestionTypeSix::find($question_no[$i]);
					if($single_ques6->answer==$answer_value)
					{
					$score_sing=$single_question_score;
					$total_score+=$single_question_score;
					}
			}
			if($question_type[$i]=='order_sequence')
			{
				$single_ques7=QuestionTypeSeven::find($question_no[$i]);
					if($single_ques7->answer==$answer_value)
					{
					$score_sing=$single_question_score;
					$total_score+=$single_question_score;
					}
			}				
			//score	
			if($score_sing>0)
				$answer->score=$score_sing;
			else
				$answer->score=0;
			$answer->save();
			//echo $score_sing.'<br>';
			
		}
		$exam_score=new ExamScores;
		$exam_score->student_id =$request->student_id;
		$exam_score->exam_id = $request->exam_id;
		$exam_score->score =$total_score;
		$exam_score->save();
		return redirect(route('student_assessment'))->with('success', 'Exam Submitted successfully!');
	}
    public function online_class()
    {
		$user_id = session()->get('loginId');
		$class_rooms = DB::table('class_room_subject_teachers')
    ->whereRaw('FIND_IN_SET('.$user_id.', students_id)')
	->select('class_room_id')
	->groupBy('class_room_id')
    ->get();
	
	$classroom_ids=[];
	$curr_date=date('Y-m-d');
	foreach ($class_rooms as $class_room) {	
$jp_class_room=ClassRooms::find($class_room->class_room_id);
				if($jp_class_room->type==1 && $jp_class_room->start_date<=$curr_date)	
				array_push($classroom_ids,$class_room->class_room_id);
				  }
				  //$classroom_ids_str=implode(',',$classroom_ids);
				  $timings=[];
				  $today = strtolower(date('l'));
				  $timings1=ClassRoomTimings::whereIn('class_room_id',$classroom_ids)->where('weakday',$today)->orderBy('from_time')->get();
				  
				  $day_2=  strtolower(date("l", strtotime("+1 day")));
				  $timings2=ClassRoomTimings::whereIn('class_room_id',$classroom_ids)->where('weakday',$day_2)->orderBy('from_time')->get();
				  
				  $day_3=  strtolower(date("l", strtotime("+2 day")));
				  $timings3=ClassRoomTimings::whereIn('class_room_id',$classroom_ids)->where('weakday',$day_3)->orderBy('from_time')->get();
				  
				  $day_4=  strtolower(date("l", strtotime("+3 day")));
				  $timings4=ClassRoomTimings::whereIn('class_room_id',$classroom_ids)->where('weakday',$day_4)->orderBy('from_time')->get();
				  
				  $day_5=  strtolower(date("l", strtotime("+4 day")));
				  $timings5=ClassRoomTimings::whereIn('class_room_id',$classroom_ids)->where('weakday',$day_5)->orderBy('from_time')->get();
				  
				  $day_6=  strtolower(date("l", strtotime("+5 day")));
				  $timings6=ClassRoomTimings::whereIn('class_room_id',$classroom_ids)->where('weakday',$day_6)->orderBy('from_time')->get();
				  
				  $day_7=  strtolower(date("l", strtotime("+6 day")));
				  $timings7=ClassRoomTimings::whereIn('class_room_id',$classroom_ids)->where('weakday',$day_7)->orderBy('from_time')->get();
				  
				  $day_8=  strtolower(date("l", strtotime("+7 day")));
				  $timings8=ClassRoomTimings::whereIn('class_room_id',$classroom_ids)->where('weakday',$day_8)->orderBy('from_time')->get();
				  
				 
				  
$timings = new \Illuminate\Database\Eloquent\Collection;
$timings = $timings->merge($timings1);
$timings = $timings->merge($timings2);
$timings = $timings->merge($timings3);
$timings = $timings->merge($timings4);
$timings = $timings->merge($timings5);
$timings = $timings->merge($timings6);
$timings = $timings->merge($timings7);
$timings = $timings->merge($timings8);
//upcoming class
$cur_user=User::find($user_id);
$organization_id=$cur_user->organization_id;
$branch_id=$cur_user->branch_id;
$curr_date=date('Y-m-d');
//
$class_room_ids_jp=[];
$class_rooms_student_assigned = DB::table('class_room_subject_teachers')
    ->whereRaw('FIND_IN_SET('.$user_id.', students_id)')
	->select('class_room_id')
	->groupBy('class_room_id')
    ->get();
	foreach ($class_rooms_student_assigned as $class_rooms_student) {	
$class_room_ids_jp[]=$class_rooms_student->class_room_id;
	}
//
$upcoming_classes=ClassRooms::whereNotIn('id', $class_room_ids_jp)->where('organisation_id',$organization_id)->where('branch_id',$branch_id)->where('start_date','>=',$curr_date)->get();
//upcoming class
//featured Course
$class_rooms_featured = DB::table('class_room_subject_teachers')
    ->whereRaw('FIND_IN_SET('.$user_id.', students_id)')
	->select('class_room_id')
	->groupBy('class_room_id')
    ->get();
	$featured_classroom_ids=[];
	
		foreach ($class_rooms_featured as $class_room_featured) {	
$jp_class_room=ClassRooms::find($class_room_featured->class_room_id);
				if($jp_class_room->type==1 && $jp_class_room->start_date>$curr_date)
				{					
				array_push($featured_classroom_ids,$class_room->class_room_id);
				  }
		}
//featured Course
        return view('student_dashboard.online_class',['timings' => $timings,'classroom_ids'=>$classroom_ids,'upcoming_classes'=>$upcoming_classes,'featured_classroom_ids'=>$featured_classroom_ids]);
    }
  public function course_details($id){
       $class_room=ClassRooms::find($id);
	   $class_room_detail=ClassRoomDetail::where('class_room_id',$id)->first();
	   return view('student_dashboard.course_details',['class_room'=>$class_room,'class_room_detail'=>$class_room_detail]);
    }
    public function my_profile()
    {
        $user_id = session()->get('loginId');
        $student = User::find($user_id);
        return view('student_dashboard.my_profile', ['data' => $student]);
    }

    public function edit_my_profile()
    {
        $user_id = session()->get('loginId');
        $student = User::find($user_id);
        $countries = Country::all();
        return view('student_dashboard.edit_my_profile', ['data' => $student, 'countries' => $countries]);
    }

    public function update_my_profile(Request $request)
    {
        $id = $request->id;
        $student = User::find($id);
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'mobileNumber' => 'sometimes|nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'zipCode' => 'sometimes|nullable|numeric',
        ]);
        if ($request->hasfile('student_avatar')) {
            $file = $request->file('student_avatar');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('assets/img/student_avatar'), $filename);
            $student->student_avatar = $filename;
        }
        $student->first_name = $request->firstName;
        $student->last_name = $request->lastName;
        $student->gender = $request->gender;
        $student->birth_date = $request->birthdate;
        $student->mobile_number = $request->mobileNumber;
        $student->address = $request->address;
        $student->city = $request->city;
        if (!empty($request->country)) {
            $student->country_id = $request->country;
        }
        $student->zip_code = $request->zipCode;
        $student->save();
        return back()->with('success', 'Your details updated successfully!');
    }
    public function change_password(){
        return view('student_dashboard.change_password');
    }

    public function change_password_process(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $user_id = session()->get('loginId');
        $student = User::find($user_id);
        if(Hash::check($request->old_password, $student->password)){
           if($request->new_password == $request->confirm_password){
                $student->password = Hash::make($request->new_password);
                $student->save();
                return redirect()->route('my_profile_student')->with('success','Password Changed Successfully!');
           }
           else{
                return back()->with('error','Your new password and Confirm password must be same!');
           }
        }
        else{
            return back()->with('error','Please Check Your old password!');
        }
    }

    public function student_assignment()
    {
        $assignments = '';
        $subject_id=[];
        $class_room_id=[];
        $student_id = session()->get('loginId');
        $subjects = ClassRoomSubjectTeachers::whereRaw("find_in_set('" . $student_id . "',students_id)")->get();
        foreach ($subjects as $subject) {
            $subject_id[] = $subject->subject_id;
            $class_room_id[] = $subject->class_room_id;
        }
        $current_date = date('d-m-Y h:i', time());

         $assignments = Assignment::whereIn('subject_id',$subject_id)->whereIn('class_room_id',$class_room_id)->where('type',1)
        ->where(function($query) use ($current_date) {
            $query->where('publish_status','==',0)
            ->whereNotNull('publish_date')
            ->where('publish_date','<=',$current_date)->orWhere(function($query){
                $query->where('publish_status','<>',0)
                ->where('publish_status',1);
            })->where('publish_date','<=',$current_date);
            })->get();
         return view('student_dashboard.student_assignment', ['assignments' => $assignments, 'student_id' => $student_id]);
    }


    public function assignment_download_status(Request $request)
    {
        $student_id = session()->get('loginId');
        $assignment_progress = AssignmentProgress::where('assignment_id', $request->assignment_id)->where('student_id', $student_id)->first();
        if (!empty($assignment_progress->assignment_id) && !empty($assignment_progress->student_id)) {
            $assignment_progress->assignment_download_status = $request->status;
            $assignment_progress->save();
        } else {
            $assignment_progress_new = new AssignmentProgress;
            $assignment_progress_new->student_id = $student_id;
            $assignment_progress_new->assignment_id = $request->assignment_id;
            $assignment_progress_new->assignment_download_status = $request->status;
            $assignment_progress_new->save();
        }
    }
    public function answer_upload_status(Request $request)
    {
        $request->validate([
            'answer_assignment' => 'mimes:pdf',
        ]);
        $student_id = session()->get('loginId');
        $assignment_progress = AssignmentProgress::where('assignment_id', $request->assignment_id)->where('student_id', $student_id)->first();
        if (!empty($assignment_progress->student_id)) {
            if ($request->hasfile('answer_assignment')) {
                $file = $request->file('answer_assignment');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move(public_path('assets/pdf/student_assignment/answer_file/'), $filename);
                $assignment_progress->answer_pdf = $filename;
                $assignment_progress->answer_upload_status = $request->answer_sent_status;
                $assignment_progress->answer_submitted_date = $request->updated_date;
                $assignment_progress->save();
            }
        } else {
            $assignment_progress_new = new AssignmentProgress;
            if ($request->hasfile('answer_assignment')) {
                $file = $request->file('answer_assignment');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extenstion;
                $file->move(public_path('assets/pdf/student_assignment/answer_file/'), $filename);
                $assignment_progress_new->answer_pdf = $filename;
            }
            $assignment_progress_new->student_id = $student_id;
            $assignment_progress_new->assignment_id = $request->assignment_id;

            $assignment_progress_new->answer_upload_status = $request->answer_sent_status;
            $assignment_progress_new->answer_submitted_date = $request->updated_date;
            $assignment_progress_new->save();
        }
        return back()->with('success', 'Assignment uploaded Successfully!');
    }
}