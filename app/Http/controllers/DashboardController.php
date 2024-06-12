<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\Country;
use App\Models\UserRole;
use App\Models\ClassRooms;
use App\Models\AssignmentProgress;
use App\Models\Subject;
use App\Models\ClassRoomSubjectTeachers;
use App\Models\Assignment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Exports\AssignmentExport;
use App\Exports\AssignmentProgressExport;
use Excel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.admin_home');
    }
    public function suspend()
    {
        if(Session::has('loginId'))
        Session::pull('loginId');

        if(Session::has('roleId'))
        Session::pull('roleId');
        return view('dashboard.suspend');
    }
    public function my_profile_user()
    {
        $user_id = session()->get('loginId');
        $user = User::find($user_id);
        $countries = Country::all();
        $org_id = User::getOrganizationId($user_id);
        $user_roles = UserRole::where('organization_id', $org_id)->whereNotIn('id', [1, 2, 3, 4])->get();
        return view('dashboard.my_profile_user', ['user' => $user, 'countries' => $countries,'user_roles' => $user_roles]);

    }
    public function edit_my_profile_user()
    {
        $user_id = session()->get('loginId');
        $user = User::find($user_id);
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $countries = Country::all();
        $user_roles = UserRole::where('type', 1)->where('organization_id', $org_get_id)->whereNotIn('id', [1, 2, 3, 4])->get();
        return view('dashboard.edit_my_profile_user', ['user' => $user, 'countries' => $countries, 'user_roles' => $user_roles]);
    }

    public function update_my_profile_user(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            // 'user_role_id' => 'required'
        ]);

        $user->name = $request->name;
        // $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->branch_id=$request->branch_id;
        // $user->user_role_id = $request->user_role_id;
        $user->save();
        return redirect(route('my_profile_user'))->with('success', 'User Details Updated!');
    }
    public function change_password_user(){
        return view('dashboard.change_password_user');
    }

    public function change_password_process_user(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $user_id = session()->get('loginId');
        $user = User::find($user_id);
        if(Hash::check($request->old_password, $user->password)){
           if($request->new_password == $request->confirm_password){
                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->route('my_profile_user')->with('success','Password Changed Successfully!');
           }
           else{
                return back()->with('error','Your new password and Confirm password must be same!');
           }
        }
        else{
            return back()->with('error','Please Check Your old password!');
        }
    }

    public function my_profile()
    {
        $user_id = session()->get('loginId');
        $user = User::find($user_id);
        // $countries = Country::all();
        $org_id = User::getOrganizationId($user_id);
        $organization = Organization::find($org_id);
        return view('dashboard.my_profile', ['user'=> $user,'data'=>$organization]);

    }

    public function edit_my_profile_admin(){
        $user_id = session()->get('loginId');
        $user = User::find($user_id);
        $organizations = Organization::where('type', 1)->get();
        return view('dashboard.edit_my_profile_admin', ['user' => $user, 'organizations' => $organizations,]);
    }

    public function update_my_profile_admin(Request $request){
        $id = $request->id;
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            // 'organization_id' => 'required',
            // 'siteconfig' => 'required',
        ]);

        $user->name = $request->name;
        // $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;



        // $user->organization_id = $request->organization_id;
        // $user->siteconfig = $request->siteconfig;

        $user->save();
        return redirect()->route('my_profile_admin')->with('success', 'Your Details Updated Successfully!');
    }
    public function change_password_admin(){
        return view('dashboard.change_password_admin');
    }

    public function change_password_process_admin(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $user_id = session()->get('loginId');
        $parent = User::find($user_id);
        if(Hash::check($request->old_password, $parent->password)){
           if($request->new_password == $request->confirm_password){
                $parent->password = Hash::make($request->new_password);
                $parent->save();
                return redirect()->route('my_profile_admin')->with('success','Password Changed Successfully!');
           }
           else{
                return back()->with('error','Your new password and Confirm password must be same!');
           }
        }
        else{
            return back()->with('error','Please Check Your old password!');
        }
    }

    public function edit_my_profile_organization(){
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $organization = Organization::find($org_id);
        $organizations = Organization::where('type', 1)->get();
        return view('dashboard.edit_my_profile_organization', ['data' => $organization , 'organizations' => $organizations,]);
    }

    public function update_my_profile_organization(Request $request)
    {

        $id = $request->id;
        $request->validate([
            'name' =>'required',
            // 'email' => 'email|required|unique:organizations,email,' . $id ,
            'address' => 'required',
            //'vat_no' => 'required',
            'contact_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            // 'start_date' => 'required',
            // 'end_date' => 'required',
            //'logo' => 'mimes:jpeg,jpg,png|dimensions:max_width=170,max_height=52|max:5120',
        ]);

        $organization = Organization::find($id);

            $organization->name = $request->name;
            // $organization->email = $request->email;

            // $date = strtotime($request->start_date);
            // $start_date = date('Y-m-d',$date);
            // $date1 = strtotime($request->end_date);
            // $end_date = date('Y-m-d',$date1);

            // $organization->start_date = $start_date;
            // $organization->end_date = $end_date;

            //$organization->start_date = Carbon\Carbon::createFromFormat('d/m/Y', $request->start_date)->format('d-m-Y') ;
            //$organization->end_date = Carbon\Carbon::createFromFormat('d/m/Y', $request->end_date)->format('d-m-Y') ;
            $organization->color = $request->color;
            $organization->address = $request->address;
            //$organization->vat_no = $request->vat_no;
            $organization->contact_no = $request->contact_no;
            if ($request->hasfile('logo')) {
                // $destination = public_path('assets/img/organization_logo').$organization->logo;
                // if(File::exists($destination))
                // {
                //     File::delete($destination);
                // }
                $file = $request->file('logo');
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extention;
                $file->move(public_path('assets/img/organization_logo'), $filename);
                $organization->logo = $filename;
            }
            $organization->save();
            return redirect(route('my_profile_admin'))->with('success', 'Organisation Details Updated Successfully!');
    }
     public function assignment(){
		 $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);


        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $class_rooms = ClassRooms::where('type',1)->where('organisation_id', $org_id)->where('branch_id',$branch_id)->orderBy('created_at', 'DESC')->get();
        } else {
            $class_rooms = ClassRooms::where('type',1)->where('organisation_id', $org_id)->orderBy('created_at', 'DESC')->get();
        }
		$subjects=[];
		if(isset($_GET['classroom_id']))
		{
			$room_subject_teachers=ClassRoomSubjectTeachers::where('class_room_id',$_GET['classroom_id'])->get();
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
		}
		$assignments=[];
		$teacher=[];
		if(isset($_GET['classroom_id']) && isset($_GET['subject_id']))
		{
			$curr_date_timestamp=time();
			if(isset($_GET['filter']) && $_GET['filter'] ==1)
			$assignments=Assignment::where('class_room_id',$_GET['classroom_id'])->where('subject_id',$_GET['subject_id'])->where('type',1)->where('delivery_date_timestamp','>=',$curr_date_timestamp)->get();
			else if(isset($_GET['filter']) && $_GET['filter'] ==2)
			$assignments=Assignment::where('class_room_id',$_GET['classroom_id'])->where('subject_id',$_GET['subject_id'])->where('type',1)->where('delivery_date_timestamp','<=',$curr_date_timestamp)->get();
			else
			$assignments=Assignment::where('class_room_id',$_GET['classroom_id'])->where('subject_id',$_GET['subject_id'])->where('type',1)->get();
		//teacher
		$room_subject_teacher=ClassRoomSubjectTeachers::where('class_room_id',$_GET['classroom_id'])->where('subject_id',$_GET['subject_id'])->first();
		if($room_subject_teacher)
		{			
				$teacher_id=$room_subject_teacher->teacher_id;
				$teacher=User::find($teacher_id);
				$teacher=array(
				'teacher_id'=>$teacher_id,
				'teacher_name'=>$teacher->first_name.' '.$teacher->last_name
				);
		}
		//teacher
		}
        return view('dashboard.assignment',["class_rooms" => $class_rooms,"assignments"=>$assignments,"subjects"=>$subjects,"teacher"=>$teacher]);
    }
	public function get_subjects_by_class_room_id(Request $request)
	{
		$class_room_id=$request->class_room_id;
		$room_subject_teachers=ClassRoomSubjectTeachers::where('class_room_id',$class_room_id)->get();
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
	public function get_teachers_by_subject_id(Request $request)
	{
		$class_room_id=$request->class_room_id;
		$subject_id=$request->subject_id;
		$room_subject_teacher=ClassRoomSubjectTeachers::where('class_room_id',$class_room_id)->where('subject_id',$subject_id)->first();
		$teacher=[];
		if($room_subject_teacher)
		{			
				$teacher_id=$room_subject_teacher->teacher_id;
				$teacher=User::find($teacher_id);
				$teacher=array(
				'teacher_id'=>$teacher_id,
				'teacher_name'=>$teacher->first_name.' '.$teacher->last_name
				);
		}
		return response()->json(['teacher'=>$teacher]);
	}
	public function add_assignment(Request $request)
	{
		$validator=Validator::make($request->all(),[
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
			$assignment->subject_id=$request->subjectID;
			$assignment->delivery_date=$request->delivery_date;
			$assignment->delivery_date_timestamp=strtotime($request->delivery_date);
			$assignment->assignment_pdf=$file_name;
			$assignment->class_room_id=$request->classRoomID;
			$assignment->teacher_id=$request->teacherID;
			$assignment->save();
			return response()->json([
			'status'=>true,
			'message'=>'Assignment Added Successfully'
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
	public function edit_assignment(Request $request)
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
		'subject_id'=>$assignment->subject_id,
		'teacher_id'=>$assignment->teacher_id,
		'teacher_name'=>$teacher_name
		);
		return response()->json(['assignment_detail'=>$assignment_array]);
	}
	public function update_assignment(Request $request)
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
			$assignment->subject_id=$request->subjectID;
			$assignment->delivery_date=$request->delivery_date;
			$assignment->delivery_date_timestamp=strtotime($request->delivery_date);
			$assignment->assignment_pdf=$file_name;
			$assignment->class_room_id=$request->classRoomID;
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
	public function publish_assignment(Request $request)
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
	public function assignment_change_status(Request $request)
	{
		$assignment=Assignment::find($request->assignment_id);
		$assignment->type=$request->status;
		$assignment->save();
		return redirect()->back()->with('success', 'Assignment Deleted Successfully');
	}
	public function assignment_teacher_upload_status(Request $request)
	{
		$assignment=AssignmentProgress::find($request->ans_id);
		$assignment->teacher_download_status=1;
		$assignment->save();
	}
	public function assignment_reupload_status(Request $request)
	{
		//$assignment=AssignmentProgress::find($request->answer_id);
		//$assignment->reupload_status=$request->reupload_status;
		//$assignment->save();
		$res=AssignmentProgress::where('id',$request->answer_id)->delete();
		return redirect()->back()->with('success', 'Assignment Answer Deleted');
	}
	public function assignment_progress($assignment_id)
	{
		$answers=AssignmentProgress::where('assignment_id',$assignment_id)->get();
		if(isset($_GET['filter']) && $_GET['filter']==1)
			$answers=AssignmentProgress::where('assignment_id',$assignment_id)->where('answer_response_status',1)->get();
		if(isset($_GET['filter']) && $_GET['filter']==0)
			$answers=AssignmentProgress::where('assignment_id',$assignment_id)->where('answer_response_status',0)->get();
		return view('dashboard.assignment_answers',['answers'=>$answers,'assignment_id'=>$assignment_id]);
	}
	public function get_subjects_by_assignment_id(Request $request)
	{
		$assignment_id=$request->assignment_id;
		//$subject_id=$request->subject_id;
		$assignment=Assignment::find($assignment_id);
		$subject=[];
		if($assignment)
		{			
				$subject_id=$assignment->subject_id;
				$subject_obj=Subject::find($subject_id);
				$subject=array(
				'subject_id'=>$subject_id,
				'subject_name'=>$subject_obj->subject_name
				);
		}
		return response()->json(['subject'=>$subject]);
	}
	public function add_assignment_score(Request $request)
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
	public function assignment_export()
	{
		$classroom_id=$_GET['classroom_id'];
		$subject_id=$_GET['subject_id'];
		$assignments= Assignment::where('type', 1)->where('class_room_id',$classroom_id)->where('subject_id',$subject_id)->get();
		$data =  [			
			'assignments' => $assignments,
		];
		
		return Excel::download(new AssignmentExport($data),'assignment.xlsx');
	}
	public function assignment_progress_export()
	{
		$assignment_id=$_GET['assignment_id'];
		
		$assignment_progresses= AssignmentProgress::where('assignment_id',$assignment_id)->get();
		$data =  [			
			'assignment_progresses' => $assignment_progresses,
		];
		
		return Excel::download(new AssignmentProgressExport($data),'assignment_progress.xlsx');
	}
    public function assessment()
    {
        return view('dashboard.admin_assessment');
    }
}
