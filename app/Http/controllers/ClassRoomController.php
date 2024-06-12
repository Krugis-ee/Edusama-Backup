<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use App\Models\Template;
use App\Models\Subject;

use App\Models\TemplateTiming;
use App\Models\ClassRooms;
use App\Models\ClassRoomTimings;
use App\Models\ClassRoomSubjectTeachers;
use App\Models\SuspensionClassRooms;
use DB;
use Log;
use Illuminate\Support\Facades\Http;

class ClassRoomController extends Controller
{
	public function index_list()
    {
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);


        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $class_rooms = ClassRooms::where('organisation_id', $org_id)->where('branch_id',$branch_id)->orderBy('created_at', 'DESC')->get();
        } else {
            $class_rooms = ClassRooms::where('organisation_id', $org_id)->orderBy('created_at', 'DESC')->get();
        }
        return view("class_room.list", ["class_rooms" => $class_rooms]);
    }
    public function add_class_room($status)
    {
		$slug = $status;
		$branch_id=0;
		if(isset($_GET['branch_id']))
		$branch_id=$_GET['branch_id'];

		$user_id = session()->get('loginId');
		$org_get_id = User::getOrganizationId($user_id);
		$branches=Branch::where('branches.organization_id',$org_get_id)->where('type', 1)->get();

		$templates=Template::where('branch_id',$branch_id)->where('type',1)->get();
		$subjects=Subject::where('branch_id',$branch_id)->where('type',1)->get();
		$teachers=User::where('branch_id',$branch_id)->where('user_role_id',4)->where('type',1)->get();
		//$templates=[];
		return view('class_room.add_new',['slug'=>$slug,'branches'=>$branches,'templates'=>$templates,'subjects'=>$subjects,'teachers'=>$teachers]);
    }
	public function add_class_room_using_template(Request $request)
    {
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_id)->where('type', 1)->get();
        //$selected_branch_id=$request->branch_id_ut;
        //$templates=Template::where('branch_id',$selected_branch_id)->where('type',1)->get();
        $request->validate([
            'branch_id_ut' => 'required',
            'class_room_name_ut' => 'required',
            'template_id_ut' => 'required',
            'subject_id_ut.*' => 'required',
            'teacher_id_ut.*' => 'required',
            'number_of_students_ut' => 'required'
        ]);
        //JP Start - Good Friday - Same Techer with another class room timing - Rule
        $template_timings = TemplateTiming::where('template_id', $request->template_id_ut)->get();
        $class_room_ids = [];
        foreach ($template_timings as $template_timing) {
            $weakday = $template_timing->weekday;
            $from_time = $template_timing->from_time;
            $to_time = $template_timing->to_time;
            $class_room_timings = ClassRoomTimings::where('weakday', $weakday)->where('from_time', '>=', $from_time)->where('to_time', '<=', $to_time)->get();
            foreach ($class_room_timings as $class_room_timing) {
                array_push($class_room_ids, $class_room_timing->class_room_id);
            }
        }
        $class_room_ids = array_unique($class_room_ids);
        //$class_room_ids_str= implode(',',$class_room_ids);
        $teachers_arr = $request->teacher_id_ut;
        $count = ClassRoomSubjectTeachers::whereIn('class_room_id', $class_room_ids)->whereIn('teacher_id', $teachers_arr)->count();

        //JP End
        //return $request;
        if ($count == 0) {
            //get template
            if ($request->template_id_ut) {
                $class_room = new ClassRooms;
                $class_room->organisation_id = $org_id;
                $class_room->branch_id = $request->branch_id_ut;
                $class_room->template_id = $request->template_id_ut;
                $class_room->type = 1;
                $class_room->add_type = 2;
                $class_room->class_room_name = $request->class_room_name_ut;
                $class_room->number_of_students = $request->number_of_students_ut;
                //template data
                $template = Template::find($request->template_id_ut);
                $class_room->duration = $template->duration;
                $date = strtotime($request->start_date);
                $class_room->start_date = date('Y-m-d', $date);
                $date1 = strtotime($request->end_date);
                $class_room->end_date = date('Y-m-d', $date1);

                $class_room->offline_course_module = $template->offline_course_module;
                $class_room->quiz_exam_module = $template->quiz_exam_module;
                $class_room->assessment_course_module = $template->assessment_course_module;
                $class_room->library_module = $template->library_module;
                $class_room->attendance_module = $template->attendance_module;
                $class_room->online_course_module = $template->online_course_module;
                $class_room->save();
                $class_room_id = $class_room->id;
                //Template Timings
                $template_timings = TemplateTiming::where('template_id', $request->template_id_ut)->get();
                foreach ($template_timings as $template_timing) {
                    $class_room_timing = new ClassRoomTimings;
                    $class_room_timing->class_room_id = $class_room_id;
                    $class_room_timing->weakday = $template_timing->weekday;
                    $class_room_timing->from_time = $template_timing->from_time;
                    $class_room_timing->to_time = $template_timing->to_time;
                    $class_room_timing->template_id = $request->template_id_ut;
                    $class_room_timing->save();
                }
                //Template Timings
                if ($request->subject_id_ut) {
                    $subjects_arr = $request->subject_id_ut;
                    $teachers_arr = $request->teacher_id_ut;
                    for ($i = 0; $i < count($subjects_arr); $i++) {
                        $class_room_teachers = new ClassRoomSubjectTeachers;
                        $class_room_teachers->class_room_id = $class_room_id;
                        $class_room_teachers->subject_id = $subjects_arr[$i];
                        $class_room_teachers->teacher_id = $teachers_arr[$i];
                        $class_room_teachers->subject_suspended_status = 1;
                        $class_room_teachers->save();
                    }
                }
            }
            return redirect(route('index_list'))->with('success', 'Class Room created successfully using template!');
        } else {
            return redirect(route('class_room_add_get', 'using_template'))->with('branches', $branches)->with('fail', 'Teacher already exist in another Class Room with same timing!');
        }
        //get template
        //return redirect(route('class_room_add_get','using_template'))->with('branches',$branches)->with('success', 'Class Room created successfully!');

        //return redirect(route('class_room_add_get','using_template'))->with('branches',$branches)->with('templates',$templates)->with('success', 'Class Room created successfully!');
        // return view('class_room.add_new',['slug'=>'using_template','branches'=>$branches,'templates'=>$templates]);

    }
    public function add_new_manual_creation(Request $request)
    {
        $request->validate([
            'branch_id' => 'required',
            'classroom_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'duration' => 'required',
            'offline_course_module' => 'required',
            'quiz_exam_module' => 'required',
            'assessment_course_module' => 'required',
            'library_module' => 'required',
            'attendance_module' => 'required',
            'online_course_module' => 'required',
            'day_status' => 'required',
            // 'from_time.*'=>'required',
            // 'to_time.*' => 'required',
            'subject_id_mc.*' => 'required',
            'teacher_id_mc.*' => 'required',
            'number_of_students_mc' => 'required',
        ]);

        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_id)->where('type', 1)->get();

        //JP Start
        $week_days = $request->week_days;
        $start = $request->from_time;
        $end = $request->to_time;
        $week_days_status = $request->day_status;
        $class_room_ids = [];
        $i = 0;
        foreach ($week_days as $week_day) {
            $j = $i + 1;
            if (in_array($j, $week_days_status)) {
                //$classroom_timing = new ClassRoomTimings;
                // $classroom_timing->class_room_id=$classroom_id;
                $weakday = $week_day;
                $from_time = $start[$i];
                $to_time = $end[$i];
                $class_room_timings = ClassRoomTimings::where('weakday', $weakday)->where('from_time', '>=', $from_time)->where('to_time', '<=', $to_time)->get();
                foreach ($class_room_timings as $class_room_timing) {
                    array_push($class_room_ids, $class_room_timing->class_room_id);
                }
            }
            $i++;
        }
        $class_room_ids = array_unique($class_room_ids);

        $teachers_arr = $request->teacher_id_mc;
        $count_data = ClassRoomSubjectTeachers::whereIn('class_room_id', $class_room_ids)->whereIn('teacher_id', $teachers_arr)->count();
        //return $count_data;
        //JP End

        if ($count_data == 0) {
            $classroom = new Classrooms;
            $classroom->branch_id = $request->branch_id;
            $classroom->number_of_students = $request->number_of_students_mc;
            $classroom->class_room_name = $request->classroom_name;
            $date = strtotime($request->start_date);
            $classroom->start_date = date('Y-m-d', $date);
            $date1 = strtotime($request->end_date);
            $classroom->end_date = date('Y-m-d', $date1);
            $classroom->duration = $request->duration;

            $classroom->offline_course_module = $request->offline_course_module;
            $classroom->quiz_exam_module = $request->quiz_exam_module;
            $classroom->assessment_course_module     = $request->assessment_course_module;
            $classroom->library_module = $request->library_module;
            $classroom->attendance_module = $request->attendance_module;
            $classroom->online_course_module = $request->online_course_module;

            $classroom->organisation_id     = $org_id;
            $classroom->type     = 1;
            $classroom->add_type = 1;
            $classroom->save();
            $classroom_id = $classroom->id;

            $week_days = $request->week_days;
            $start = $request->from_time;
            $end = $request->to_time;
            $week_days_status = $request->day_status;


            $i = 0;

            foreach ($week_days as $week_day) {

                $j = $i + 1;
                if (in_array($j, $week_days_status)) {
                    $classroom_timing = new ClassRoomTimings;
                    $classroom_timing->class_room_id = $classroom_id;
                    $classroom_timing->weakday = $week_day;
                    $classroom_timing->from_time = $start[$i];
                    $classroom_timing->to_time = $end[$i];
                    $classroom_timing->save();
                }
                $i++;
            }

            $count = count($request->subject_id_mc);

            for ($i = 0; $i < $count; $i++) {
                $classroom_subject = new ClassRoomSubjectTeachers;
                $classroom_subject->class_room_id = $classroom_id;
                $classroom_subject->subject_id = $request->subject_id_mc[$i];
                $classroom_subject->teacher_id = $request->teacher_id_mc[$i];
                $classroom_subject->subject_suspended_status = 1;
                $classroom_subject->save();
            }

            return redirect(route('index_list'))->with('success', 'Class Room created successfully by manual creation!');
        } else {
            return redirect(route('class_room_add_get', 'manual_creation'))->with('branches', $branches)->with('fail', 'Teacher already exist in another Class Room with same timing!');
        }
    }
    public function edit($id, $slug)
    {
        $class_room = ClassRooms::find($id);
        $branch_id = $class_room->branch_id;
        if (isset($_GET['branch_id']))
            $branch_id = $_GET['branch_id'];
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();

        $templates = Template::where('branch_id', $branch_id)->where('type', 1)->get();
        $subjects = Subject::where('branch_id', $branch_id)->where('type', 1)->get();
        $teachers = User::where('branch_id', $branch_id)->where('user_role_id', 4)->where('type', 1)->get();

        $subj_teachers = ClassRoomSubjectTeachers::where('class_room_id', $id)->get()->toArray();
        $subj_timings = ClassRoomTimings::where('class_room_id', $id)->get()->toArray();

        $suspensions = SuspensionClassRooms::where('class_room_id', $id)->get();
        // print_r($subj_timings);
        // die();
        //$templates=[];
        return view('class_room.edit', ['class_room' => $class_room, 'subj_teachers' => $subj_teachers, 'subj_timings' => $subj_timings, 'slug' => $slug, 'branches' => $branches, 'templates' => $templates, 'subjects' => $subjects, 'teachers' => $teachers, 'suspensions' => $suspensions]);
    }
    public function update_using_template(Request $request)
    {
        //return $request;

        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_id)->where('type', 1)->get();
        //$selected_branch_id=$request->branch_id_ut;
        //$templates=Template::where('branch_id',$selected_branch_id)->where('type',1)->get();
        $class_room_id = $request->record_id;
        $request->validate([
            'branch_id_ut' => 'required',
            'class_room_name_ut' => 'required',
            'template_id_ut' => 'required',
            'subject_id_ut.*' => 'required',
            'teacher_id_ut.*' => 'required',
            'number_of_students_ut' => 'required'
        ]);
        //get template
        if ($request->template_id_ut) {
            $class_room = ClassRooms::find($class_room_id);
            $class_room->number_of_students = $request->number_of_students_ut;
            $class_room->organisation_id = $org_id;
            $class_room->branch_id = $request->branch_id_ut;
            $class_room->template_id = $request->template_id_ut;
            $class_room->type = 1;
            $class_room->add_type = 2;
            $class_room->class_room_name = $request->class_room_name_ut;
            //template data
            $template = Template::find($request->template_id_ut);
            $class_room->duration = $template->duration;
            $date = strtotime($request->start_date);
            $class_room->start_date = date('Y-m-d', $date);
            $date1 = strtotime($request->end_date);
            $class_room->end_date = date('Y-m-d', $date1);

            $class_room->offline_course_module = $template->offline_course_module;
            $class_room->quiz_exam_module = $template->quiz_exam_module;
            $class_room->assessment_course_module = $template->assessment_course_module;
            $class_room->library_module = $template->library_module;
            $class_room->attendance_module = $template->attendance_module;
            $class_room->online_course_module = $template->online_course_module;
            $class_room->save();

            //del Timings
            $template_timings_delete = ClassRoomTimings::where('class_room_id', $class_room_id)->delete();

            //Template Timings
            $template_timings = TemplateTiming::where('template_id', $request->template_id_ut)->get();
            foreach ($template_timings as $template_timing) {
                $class_room_timing = new ClassRoomTimings;
                $class_room_timing->class_room_id = $class_room_id;
                $class_room_timing->weakday = $template_timing->weekday;
                $class_room_timing->from_time = $template_timing->from_time;
                $class_room_timing->to_time = $template_timing->to_time;
                $class_room_timing->template_id = $request->template_id_ut;
                $class_room_timing->save();
            }
            //Template Timings

            //del Timings
            /* $subj_teacher_delete=ClassRoomSubjectTeachers::where('class_room_id',$class_room_id)->delete();

		 //subj teachers
		 if($request->subject_id_ut)
		 {
			 $subjects_arr=$request->subject_id_ut;
			 $teachers_arr=$request->teacher_id_ut;
			 for($i=0;$i<count($subjects_arr);$i++)
			 {
			$class_room_teachers=new ClassRoomSubjectTeachers;
			$class_room_teachers->class_room_id=$class_room_id;
			$class_room_teachers->subject_id=$subjects_arr[$i];
			$class_room_teachers->teacher_id=$teachers_arr[$i];
			$class_room_teachers->save();
			 }
		 }*/

            if (!empty($request->subject_id_ut && $request->teacher_id_ut)) {
               // $subj_teacher_delete = ClassRoomSubjectTeachers::where('class_room_id', $class_room_id)->delete();

                //subj teachers
                $subjects_arr = $request->subject_id_ut;
                $teachers_arr = $request->teacher_id_ut;
                for ($i = 0; $i < count($subjects_arr); $i++) {
                    $class_room_teachers = new ClassRoomSubjectTeachers;
                    $class_room_teachers->class_room_id = $class_room_id;
                    $class_room_teachers->subject_id = $subjects_arr[$i];
                    $class_room_teachers->teacher_id = $teachers_arr[$i];
                    //JP
					$subj_teacher_first = ClassRoomSubjectTeachers::where('class_room_id', $class_room_id)->where('subject_id', $subjects_arr[$i])->where('teacher_id',$teachers_arr[$i])->first();
					if($subj_teacher_first)
					$class_room_teachers->students_id=$subj_teacher_first->students_id;					
					$subj_teacher_delete = ClassRoomSubjectTeachers::where('class_room_id', $class_room_id)->where('subject_id', $subjects_arr[$i])->where('teacher_id',$teachers_arr[$i])->delete();
					//JP
					$class_room_teachers->subject_suspended_status = 1;
                    $class_room_teachers->save();
                }

                //get template
                return redirect(route('index_list'))->with('success', 'Class Room updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Assign atleast one subject and one student');
            }
        }

        //get template
        //return redirect(route('index_list'))->with('success', 'Class Room updated successfully!');
        //return redirect(route('class_room_add_get','using_template'))->with('branches',$branches)->with('templates',$templates)->with('success', 'Class Room created successfully!');
        // return view('class_room.add_new',['slug'=>'using_template','branches'=>$branches,'templates'=>$templates]);
    }
    public function update_by_manual_updation(Request $request)
    {
        // print_r($request->all());
        // die();
        $class_room_id = $request->record_id;
        $request->validate([
            'branch_id' => 'required',
            'classroom_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'duration' => 'required',
            'offline_course_module' => 'required',
            'quiz_exam_module' => 'required',
            'assessment_course_module' => 'required',
            'library_module' => 'required',
            'attendance_module' => 'required',
            'online_course_module' => 'required',
            'day_status' => 'required',
            // 'from_time.*'=>'required',
            // 'to_time.*' => 'required',
            'subject_id_mc.*' => 'required',
            'teacher_id_mc.*' => 'required',
            'number_of_students_mc' => 'required'
        ]);

        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $class_room_id = $request->record_id;
        $classroom = ClassRooms::find($class_room_id);
        $classroom->number_of_students = $request->number_of_students_mc;
        $classroom->branch_id = $request->branch_id;
        $classroom->class_room_name = $request->classroom_name;
		$classroom->duration = $request->duration;
        $classroom->start_date = $request->start_date;
        $date = strtotime($request->start_date);
        $classroom->start_date = date('Y-m-d', $date);
        $date1 = strtotime($request->end_date);
        $classroom->end_date = date('Y-m-d', $date1);

        $classroom->offline_course_module = $request->offline_course_module;
        $classroom->quiz_exam_module = $request->quiz_exam_module;
        $classroom->assessment_course_module     = $request->assessment_course_module;
        $classroom->library_module = $request->library_module;
        $classroom->attendance_module = $request->attendance_module;
        $classroom->online_course_module = $request->online_course_module;

        $classroom->organisation_id     = $org_id;
        $classroom->type     = 1;
        $classroom->add_type = 1;
        $classroom->save();
        $classroom_id = $classroom->id;

        $week_days = $request->week_days;
        $start = $request->from_time;
        $end = $request->to_time;
        $week_days_status = $request->day_status;


        $i = 0;
        //del Timings
        $template_timings_delete = ClassRoomTimings::where('class_room_id', $class_room_id)->delete();

        //Template Timings
        foreach ($week_days as $week_day) {

            $j = $i + 1;
            if (in_array($j, $week_days_status)) {
                $classroom_timing = new ClassRoomTimings;
                $classroom_timing->class_room_id = $classroom_id;
                $classroom_timing->weakday = $week_day;
                $classroom_timing->from_time = $start[$i];
                $classroom_timing->to_time = $end[$i];
                $classroom_timing->save();
            }
            $i++;
        }

        //del Timings
        /*$subj_teacher_delete=ClassRoomSubjectTeachers::where('class_room_id',$class_room_id)->delete();
        $count= count($request->subject_id_mc);

        for($i=0; $i<$count;$i++)
        {
            $classroom_subject = new ClassRoomSubjectTeachers;
            $classroom_subject->class_room_id=$classroom_id;
            $classroom_subject->subject_id = $request->subject_id_mc[$i];
            $classroom_subject->teacher_id =$request->teacher_id_mc[$i];
            $classroom_subject->save();
        }
		return redirect(route('index_list'))->with('success', 'Class Room updated successfully!');
        */
        if (!empty($request->subject_id_mc && $request->teacher_id_mc)) {
            //$subj_teacher_delete = ClassRoomSubjectTeachers::where('class_room_id', $class_room_id)->delete();
            $count = count($request->subject_id_mc);

            for ($i = 0; $i < $count; $i++) {              
				
					$classroom_subject = new ClassRoomSubjectTeachers;
					$classroom_subject->class_room_id = $classroom_id;
					$classroom_subject->subject_id = $request->subject_id_mc[$i];
					$classroom_subject->teacher_id = $request->teacher_id_mc[$i];
					//JP
					$subj_teacher_first = ClassRoomSubjectTeachers::where('class_room_id', $class_room_id)->where('subject_id', $request->subject_id_mc[$i])->where('teacher_id',$request->teacher_id_mc[$i])->first();
					if($subj_teacher_first)
					$classroom_subject->students_id=$subj_teacher_first->students_id;					
					$subj_teacher_delete = ClassRoomSubjectTeachers::where('class_room_id', $class_room_id)->where('subject_id', $request->subject_id_mc[$i])->where('teacher_id',$request->teacher_id_mc[$i])->delete();
					//JP
					$classroom_subject->subject_suspended_status = 1;
					$classroom_subject->save();
					
				
				
            }
            return redirect(route('index_list'))->with('success', 'Class Room updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Assign atleast one subject and one student');
        }
        //return redirect(route('index_list'))->with('success', 'Class Room updated successfully by manual updation!');
    }
	 public function change_status(Request $request)
    {
        $id = $request->id;
        $classroom = Classrooms::find($id);

        //Suspensions Records
        if ($request->status == 2) {
            if (!empty($request->suspend_msg)) {
                $classroom->type = $request->status;
                $classroom->suspend_msg = $request->suspend_msg;
                $classroom->save();


                $suspension = new SuspensionClassRooms;
                $suspension->class_room_id = $id;
                $suspension->suspension_reason = $request->suspend_msg;
                $suspension->suspension_date = date('d-m-Y');
                $suspension->save();
            } else {
                return back()->with('error', 'Suspension reason is mandatory');
            }
        } else if ($request->status == 1) {
            $classroom->type = $request->status;
            $classroom->suspend_msg = '';
            $classroom->save();
        }
        return back()->with('message', 'Status Changed Successfully!');
    }

	public function generate_zoom_meeting_get($id)
	{
		$class_room = ClassRooms::find($id);
		return view('class_room.zoom_generate',['class_room'=>$class_room]);
	}
	public function generateZoomAccessToken()
    {
        $apiKey = env('Client_ID');
        $apiSecret = env('Client_Secret');
        $account_id = env('Account_ID');

        $base64Credentials = base64_encode("$apiKey:$apiSecret");

        $url = 'https://zoom.us/oauth/token?grant_type=account_credentials&account_id=' . $account_id;

        $response = Http::withHeaders([
            'Authorization' => "Basic $base64Credentials",
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->post($url);

        $responseData = $response->json();

        if (isset($responseData['access_token'])) {
            return $responseData['access_token'];
        } else {
            // Log or print the entire response for debugging purposes.
            \Log::error('Zoom OAuth Token Response: ' . json_encode($responseData));

            // Handle the error as needed.
            return null; // You might want to return null or throw an exception here.
        }
    }
	public function generate_zoom_meeting_post(Request $request)
	{
	    $zoom_topic=$request->topic;
		$id=$request->id;
		$classroom = Classrooms::find($id);
		//alt hosts
		$alt_hosts=[];
		$alt_hosts_str='';
		$teachers=ClassRoomSubjectTeachers::where('class_room_id',$id)->get();
        if($teachers){
		foreach($teachers as $teacher)
		{
			$single_teacher=User::find($teacher->teacher_id);
			array_push($alt_hosts,$single_teacher->email);
		}
		}
		$alt_hosts_str=implode(';',$alt_hosts);
		//alt hosts
		$end_date_time = $classroom->end_date.'T12:00:00Z';
		$result=array();
		$accessToken = $this->generateZoomAccessToken();
		
		//jp access
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.zoom.us/v2/users/me/meetings',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"topic": "'.$zoom_topic.'",
			"type": 2,
			"timezone": "Asia/Kolkata",
			"end_date_time"	:"'.$end_date_time.'",
			"alternative_hosts":"'.$alt_hosts_str.'",
			"settings": {
				"host_video": true,
				"participant_video": false,
				"join_before_host": true,
				"mute_upon_entry": false,
				"breakout_room": {
					"enable": true
				}
			}
		}',
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization: Bearer '.$accessToken,
			'Cookie: __cf_bm=z57V.cjxOBcpjqyCrL8KyMaFxML8oyq_Hk6ftT4aKgI-1710138931-1.0.1.1-7wFY3NH6G1ULIwH3LYDusD6EAYnhcRCjOJet87etj1Dg4gheJntL3hmGskXkOjtz2VvpHvYy3Bj_mGYHOys5cQ; _zm_mtk_guid=d880997eba58453488c7e1ab61785b22; _zm_page_auth=us05_c_TOHN9Ua4TFmdjCyBUzz0Tw; _zm_ssid=us05_c_aj6N1N3nSUaqzD0OeA8dQQ; cred=4AF7804571B5D9EF8855F7C4A54F88A8; __cf_bm=qQlxFsrSQf5zGICFWNSY_4.DKgb79w_T1JrKDxnO2as-1713346606-1.0.1.1-975QEF6fRH1DmITPg56usL4abf1e3bq61evD1HPZ8myF1khbBl910ODhAStS9H5S84Rqj55HD_nXlHHmxrXJsA; _zm_csp_script_nonce=P1zGnqwnQDuZaaXJ2nil9A; _zm_currency=INR; _zm_mtk_guid=ba8352fbb77442f3be52b66ae556c059; _zm_o2nd=9ab092bfbc45a4b7fc17d9a51a8ec43e; _zm_page_auth=aw1_c_CO6BotRVRnuLwdSLDC5e3g; _zm_ssid=us05_c_rMwDqjQhRLCARc-Qri_TbQ; _zm_visitor_guid=ba8352fbb77442f3be52b66ae556c059; cred=FE9AE1E81CBD1BD2003A0802E23EAF04'
		  ),
		));

 $response = curl_exec($curl);

curl_close($curl);
//echo $response;

		//jp access
	
$result = json_decode($response, true);
//print_r($result);
	if(isset($result['topic']))
	{
	$classroom->zoom_topic = $result['topic'];
    $classroom->zoom_type = $result['type'];
	$classroom->zoom_start_url =$result['start_url'] ;
    $classroom->zoom_join_url = $result['join_url'];
	$classroom->save();
//return $zoom_topic;
		return redirect(route('index_list'))->with('success', 'Zoom Meeting Class Room created successfully!');
	}
	if($result['code']==124)
		return redirect(route('index_list'))->with('fail', 'Zoom Meeting Token Expired!');
	}
	public function zoom_meeting($id)
	{
		$class_room = ClassRooms::find($id);
		return view('class_room.zoom_meeting',['class_room'=>$class_room]);
	}
	public function manage_class_room($id)
    {

        $subjects=ClassRoomSubjectTeachers::where('class_room_id',$id)->where('subject_suspended_status',1)->get();
        $classroom=ClassRooms::find($id);
        $branch_id = ClassRooms::getBranchIDByClassRoomId($id);
        $students=User::where('user_role_id',2)->where('branch_id',$branch_id)->where('type',1)->get();
		//JP
		if(isset($_GET['subject_id']))
		{
		$subject_id=$_GET['subject_id'];
		$subjects_edit=ClassRoomSubjectTeachers::where('class_room_id',$id)->where('subject_id',$subject_id)->first();
        }
		else
			$subjects_edit='';
		//jp
        return view('class_room.manage',['subjects'=>$subjects,'students'=>$students,'id'=>$id,'classroom'=>$classroom,'subjects_edit'=>$subjects_edit]);
    }
    public function assign_students_to_classroom(Request $request){
        $request->validate([
			'subject_id' => 'required',
            'students_id' => 'required'
        ]);

		$classroom_subject= ClassRoomSubjectTeachers::where('class_room_id',$request->id)->where('subject_id',$request->subject_id)->first();
        $classroom_subject->students_id=implode(',',$request->students_id);
        $classroom_subject->save();
		return redirect(route('index_list'))->with('success', 'Students assigned successfully!');
    }
}
