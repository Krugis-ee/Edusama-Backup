<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRoomTimings;
use App\Models\ClassRooms;
use App\Models\User;
use App\Models\ExamAnswers;
use App\Models\Country;
use App\Models\ClassRoomSubjectTeachers;
use App\Models\Branch;
use App\Models\Exam;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;
use App\Models\Assignment;
use App\Models\ExamScores;
use App\Models\AssignmentProgress;
use Illuminate\Support\Facades\Hash;

class TeacherDashboardController extends Controller
{
    //
	public function dashboard()
    {
        return view('teacher_dashboard.home');
    }
	public function get_student_exam_attend($exam_id)
	{
		//$exam_results=ExamScores::where('exam_id',$exam_id)->get();
		//return view('teacher_dashboard.student_results', ['exam_results'=>$exam_results]);
        $exam=Exam::find($exam_id);
		$class_room_id=$exam->class_room_id;
		$subject_id=$exam->subject_id;
		$record=ClassRoomSubjectTeachers::where('class_room_id',$class_room_id)->where('subject_id',$subject_id)->first();
		$students_id_str=$record->students_id;
		$students_id_arr=explode(',',$students_id_str);
		return view('teacher_dashboard.student_results', ['exam_id'=>$exam_id,'students_arr'=>$students_id_arr]);
	}
    public function video_course()
    {
		$user_id = session()->get('loginId');
		$class_rooms = DB::table('class_room_subject_teachers')
    ->where('teacher_id',$user_id)
	->select('class_room_id')
	->groupBy('class_room_id')
    ->get();
	$classroom_ids=[];
	foreach ($class_rooms as $class_room) {	
$jp_class_room=ClassRooms::find($class_room->class_room_id);
				if($jp_class_room->type==1)	
				array_push($classroom_ids,$class_room->class_room_id);
				  }
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
        return view('teacher_dashboard.video_course',['timings' => $timings]);
    }
    public function my_profile()
    {
        $user_id = session()->get('loginId');
        $teacher = User::find($user_id);
        return view('teacher_dashboard.my_profile', ['data' => $teacher]);
    }

    public function edit_my_profile()
    {
        $user_id = session()->get('loginId');
        $teacher = User::find($user_id);
        $countries = Country::all();
        return view('teacher_dashboard.edit_my_profile', ['data' => $teacher, 'countries' => $countries]);
    }

    public function update_my_profile(Request $request)
    {

        $id = $request->id;
        $teacher = User::find($id);

        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);

        $request->validate([
            'teacher_avatar' => 'mimes:jpeg,jpg,png,gif|dimensions:max_width=100,max_height=100|max:100',
            'firstName' => 'required',
            'lastName' => 'required',
            'facebook_profile' => 'sometimes|nullable|url',
            'twitter_profile' => 'sometimes|nullable|url',
            'linkedin_profile' => 'sometimes|nullable|url',
            'instagram_profile' => 'sometimes|nullable|url',
            'mobileNumber' => 'sometimes|nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'zipCode' => 'sometimes|nullable|numeric',
        ]);

        if ($request->hasfile('teacher_avatar')) {
            $file = $request->file('teacher_avatar');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move(public_path('assets/img/teacher_avatar'), $filename);
            $teacher->teacher_avatar = $filename;
        }
        $teacher->first_name = $request->firstName;
        $teacher->last_name = $request->lastName;
        $teacher->mobile_number = $request->mobileNumber;
        $teacher->gender = $request->gender;
        $teacher->designation = $request->designation;
        $teacher->facebook_profile = $request->facebook_profile;
        $teacher->twitter_profile = $request->twitter_profile;
        $teacher->linkedin_profile = $request->linkedin_profile;
        $teacher->instagram_profile = $request->instagram_profile;
        $teacher->address = $request->address;
        $teacher->city = $request->city;
        if (!empty($request->country)) {
            $teacher->country_id = $request->country;
        }
        $teacher->zip_code = $request->zipCode;
        $teacher->bio = $request->bio;
        $teacher->save();
        // route("teacher_list")
        return redirect()->route('my_profile_teacher')->with("success", "Your Details Updated Sucessfully!");
    }

    public function change_password(){
        return view('teacher_dashboard.change_password');
    }

    public function change_password_process(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $user_id = session()->get('loginId');
        $teacher = User::find($user_id);
        if(Hash::check($request->old_password, $teacher->password)){
           if($request->new_password == $request->confirm_password){
                $teacher->password = Hash::make($request->new_password);
                $teacher->save();
                return redirect()->route('my_profile_teacher')->with('success','Password Changed Successfully!');
           }
           else{
                return back()->with('error','Your new password and Confirm password must be same!');
           }
        }
        else{
            return back()->with('error','Please Check Your old password!');
        }
    }
    public function teacher_assignment(){
		 $teacher_id = session()->get('loginId');
		 $subj_teachers=ClassRoomSubjectTeachers::where('teacher_id',$teacher_id)->get();
		 $class_rooms_arr=[];
		 $assignments=[];
		$subject=[];
		 foreach($subj_teachers as $subj_teacher)
		 {
			 if (!in_array($subj_teacher->class_room_id, $class_rooms_arr))
			 array_push($class_rooms_arr,$subj_teacher->class_room_id);
		 }
		 $class_rooms = ClassRooms::whereIn('id', $class_rooms_arr)->where('type',1)->orderBy('created_at', 'DESC')->get();
        
		if(isset($_GET['classroom_id']))
		{
			$assignments=Assignment::where('class_room_id',$_GET['classroom_id'])->where('teacher_id',$teacher_id)->where('type',1)->get();
		//subject
		
		$room_subject_teacher=ClassRoomSubjectTeachers::where('class_room_id',$_GET['classroom_id'])->where('teacher_id',$teacher_id)->first();
		if($room_subject_teacher)
		{			
				$subject_id=$room_subject_teacher->subject_id;
				$subject=Subject::find($subject_id);
				$subject=array(
				'subject_id'=>$subject_id,
				'subject_name'=>$subject->subject_name
				);
				
		}
		//subject

		}
        return view('teacher_dashboard.teacher_assignment',["class_rooms" => $class_rooms,"assignments" => $assignments,"subject"=>$subject]);
    }
	public function get_subjects_by_teacher_id(Request $request)
	{
		$class_room_id=$request->class_room_id;
		$teacher_id = session()->get('loginId');
		$room_subject_teachers=ClassRoomSubjectTeachers::where('class_room_id',$class_room_id)->where('teacher_id',$teacher_id)->get();
		$subjects=[];
		if($room_subject_teachers)
		{
			foreach($room_subject_teachers as $room_subject_teacher)
			{
				$subject_id=$room_subject_teacher->subject_id;
				$subject=Subject::find($subject_id);
				$subjects[]=array(
				'subject_id'=>$subject_id,
				'subject_name'=>$subject->subject_name
				);
			}
		}
		return response()->json(['subjects'=>$subjects]);
	}
	
	public function teacher_add_assignment(Request $request)
	{
		$validator=Validator::make($request->all(),[
		'class_room_id'=>'required',
		'subject_id'=>'required',
		'assignment_title'=>'required',
		'delivery_date'=>'required',
		'assignment_file'=> 'required|mimes:pdf'
		]);
		if($validator->passes())
		{
			//pdf upload
			
			$assignment_file=$request->assignment_file;
			$file_name='test.pdf';
			if ($assignment_file !== null) {
			$file_name=time().'.'.$assignment_file->getClientOriginalExtension();
			$assignment_file->move(public_path('assignments'),$file_name);
			}
			
			//pdf upload
			$assignment=new Assignment();
			$assignment->title=$request->assignment_title;
			$assignment->subject_id=$request->subject_id;
			$assignment->delivery_date=$request->delivery_date;
			$assignment->assignment_pdf=$file_name;
			$assignment->class_room_id=$request->class_room_id;
			$assignment->teacher_id=$request->teacherID;
			$assignment->save();
			return response()->json([
			'status'=>true,
			'message'=>'Assignment Submitted Successfully'
			]);
		}
		else
		{
			return response()->json([
			'status'=>false,
			'errors'=>$validator->errors()
			]);
		}	
		
	}
	public function edit_teacher_assignment(Request $request)
	{
		$ass_id=$request->ass_id;
		$assignment=Assignment::find($ass_id);
		
		$teacher=User::find($assignment->teacher_id);
		$teacher_name=$teacher->first_name.' '.$teacher->last_name;
		
		$assignment_array=array(
		'id'=>$assignment->id,
		'title'=>$assignment->title,
		'delivery_date'=>$assignment->delivery_date,
		'class_room_id'=>$assignment->class_room_id,
		'subject_id'=>$assignment->subject_id
		);
		return response()->json(['assignment_detail'=>$assignment_array]);
	}
	public function update_teacher_assignment(Request $request)
	{
		$validator=Validator::make($request->all(),[
		'assignment_title'=>'required',
		'delivery_date'=>'required',
		'assignment_file'=> 'mimes:pdf'
		]);
		if($validator->passes())
		{
			$assignment=Assignment::find($request->assignment_id);
			$file_name=$assignment->assignment_pdf;
			//pdf upload			
			$assignment_file=$request->assignment_file;			
			if ($assignment_file !== null) {
			$file_name=time().'.'.$assignment_file->getClientOriginalExtension();
			$assignment_file->move(public_path('assignments'),$file_name);
			}
			
			//pdf upload
			
			$assignment->title=$request->assignment_title;
			$assignment->subject_id=$request->subject_id;
			$assignment->delivery_date=$request->delivery_date;
			$assignment->assignment_pdf=$file_name;
			$assignment->class_room_id=$request->class_room_id;
			$assignment->teacher_id=$request->teacherID;
			$assignment->save();
			return response()->json([
			'status'=>true,
			'message'=>'Assignment Updated Successfully'
			]);
		}
		else
		{
			return response()->json([
			'status'=>false,
			'errors'=>$validator->errors()
			]);
		}	
		
	}
	public function teacher_assignment_change_status(Request $request)
	{
		$assignment=Assignment::find($request->assignment_id);
		$assignment->type=$request->status;
		$assignment->save();
		return redirect()->back()->with('success', 'Assignment Deleted Successfully');
	}
	public function publish_teacher_assignment(Request $request)
	{
		 $assignment_id=$request->publish_assignment_id;
		$assignment=Assignment::find($assignment_id);
		$assignment->publish_status=1;
		
		if(isset($request->publish_date))
		$assignment->publish_date=$request->publish_date;
	
	    if(isset($request->publish_now))
		$assignment->publish_date=date('d-m-Y H:i');
	
		$assignment->save();
		return response()->json([
			'status'=>true,
			'message'=>'Assignment Published'
			]);
	}
	public function teacher_assignment_progress($assignment_id)
	{
		$answers=AssignmentProgress::where('assignment_id',$assignment_id)->get();
		if(isset($_GET['filter']) && $_GET['filter']==1)
			$answers=AssignmentProgress::where('assignment_id',$assignment_id)->where('answer_response_status',1)->get();
		if(isset($_GET['filter']) && $_GET['filter']==0)
			$answers=AssignmentProgress::where('assignment_id',$assignment_id)->where('answer_response_status',0)->get();
		
		return view('teacher_dashboard.teacher_assignment_answers',['answers'=>$answers,"assignment_id"=>$assignment_id]);
	}
	public function teacher_add_assignment_score(Request $request)
	{
		$validator=Validator::make($request->all(),[
		'score'=>'required',
		'comments'=>'required'
		]);
		if($validator->passes())
		{			
		$answer_progress_id=$request->answer_progress_id;
		$ans_progress=AssignmentProgress::find($answer_progress_id);
		$ans_progress->score=$request->score;
		$ans_progress->score_comment=$request->comments;
		$ans_progress->answer_response_status=1;
		$ans_progress->save();
		return response()->json([
			'status'=>true,
			'message'=>'Assignment Score Added'
			]);
		}
		else
		{
			return response()->json([
			'status'=>false,
			'errors'=>$validator->errors()
			]);
		}
	}
	public function assessment()
    {
		$user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
			$subjects=Subject::where('type',1)->where('organization_id',1)->where('branch_id',1)->get();
		}
		else{
			$subjects=Subject::where('type',1)->where('organization_id',1)->get();
		}
		$user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        //$branch_id = User::getBranchID($user_id);
        $branches=Branch::where('organization_id',$org_id)->get();
		
		$exams=[];
		if(!empty($_GET['branch_id']))
		$exams=Exam::where('branch_id',$_GET['branch_id'])->get();
		
		if( !empty($_GET['branch_id']) && !empty($_GET['class_room_id']) )
		$exams=Exam::where('branch_id',$_GET['branch_id'])->where('class_room_id',$_GET['class_room_id'])->get();
        
		if( !empty($_GET['branch_id']) && !empty($_GET['class_room_id']) && !empty($_GET['subject_id']) )
		$exams=Exam::where('branch_id',$_GET['branch_id'])->where('class_room_id',$_GET['class_room_id'])->where('subject_id',$_GET['subject_id'])->get();
        
		return view('teacher_dashboard.teacher_assessment',['subjects'=>$subjects,'exams'=>$exams,'branches'=>$branches]);
    
       
    }
	public function create_exam()
    {
		$user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        //$branch_id = User::getBranchID($user_id);
        $branches=Branch::where('organization_id',$org_id)->get();
        return view('teacher_dashboard.add_exam',["branches" => $branches]);
    }
	public function get_student_single_result()
	{		
		$student_id=$_GET['student_id'];
		$exam_id=$_GET['exam_id'];
		$exam_answers=ExamAnswers::where('student_id',$student_id)->where('exam_id',$exam_id)->get();
		return view('teacher_dashboard.student_result_single',['exam_answers'=>$exam_answers]);
	}
	public function score_update(Request $request)
	{
		$question_type_arr=$request->question_type;
		$score_arr=$request->score;
		$question_no_arr=$request->question_no;
		$exam_id=$request->exam_id;
		$student_id=$request->student_id;
		$total=count($question_no_arr);
		$total_score=0;
		for($i=0;$i<$total;$i++)
		{
			$question_type=$question_type_arr[$i];
			$question_no=$question_no_arr[$i];
			$score=$score_arr[$i];
			$exam_answer=ExamAnswers::where('student_id',$student_id)->where('exam_id',$exam_id)->where('question_type',$question_type)->where('question_no',$question_no)->first();
			$exam_answer->score=$score;
			$exam_answer->approved_status=1;
			$exam_answer->save();
			
			$total_score+=$score;
		}
		$exam_score=ExamScores::where('student_id',$student_id)->where('exam_id',$exam_id)->first();
		$exam_score->score=$total_score;
		$exam_score->approved_status=1;
		$exam_score->save();
		return redirect()->back()->with('message', 'Score Updated');
	}
}
