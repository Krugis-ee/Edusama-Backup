<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Assignment;
use App\Models\AssignmentProgress;
use App\Models\Exam;
use App\Models\ClassRoomSubjectTeachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentDashboardController extends Controller
{
    //
    public function dashboard()
    {
        return view('parent_dashboard.home');
    }

    public function my_profile()
    {
        $user_id = session()->get('loginId');
        $parent = User::find($user_id);
        $countries = Country::all();
        return view('parent_dashboard.my_profile', ['data' => $parent, 'countries' => $countries]);
    }
    public function edit_my_profile()
    {
        $user_id = session()->get('loginId');
        $student = User::find($user_id);
        $countries = Country::all();
        return view('parent_dashboard.edit_my_profile', ['data' => $student, 'countries' => $countries]);
    }
    public function update_my_profile(Request $request)
    {
        $id = $request->id;
        $parent = User::find($id);


        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            // 'email' => 'required|email|unique:users,email,' . $id,
            'mobileNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            // 'branch_id' => 'required',
            'zipCode' => 'required|numeric',
        ]);
        $parent->first_name = $request->firstName;
        $parent->last_name = $request->lastName;
        $parent->mobile_number = $request->mobileNumber;
        $parent->address = $request->address;
        $parent->city = $request->city;
        if (!empty($request->country)) {
            $parent->country_id = $request->country;
        }
        $parent->zip_code = $request->zipCode;
        $parent->save();
        //return redirect()->back()->with('message', 'Parent Details Updated Successfully');
        return redirect(route('my_profile_parent'))->with('success', 'Parent Details Updated!');
    }
    public function change_password()
    {
        return view('parent_dashboard.change_password');
    }

    public function change_password_process(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $user_id = session()->get('loginId');
        $parent = User::find($user_id);
        if (Hash::check($request->old_password, $parent->password)) {
            if ($request->new_password == $request->confirm_password) {
                $parent->password = Hash::make($request->new_password);
                $parent->save();
                return redirect()->route('my_profile_parent')->with('success', 'Password Changed Successfully!');
            } else {
                return back()->with('error', 'Your new password and Confirm password must be same!');
            }
        } else {
            return back()->with('error', 'Please Check Your old password!');
        }
    }
    public function parent_assignment()
    {
        $students = '';
        $assignments = '';
        $subject_id[] ='';
        $class_room_id[] ='';
        $student_id='';
        $parent_id = session()->get('loginId');
        $student_count = User::where('user_role_id', 2)->where('parent_id', $parent_id)->count();
        if ($student_count == 1) {
            $student = User::where('user_role_id', 2)->where('parent_id', $parent_id)->first();
            $student_id = $student->id;
        }
        if ($student_count > 1) {
            $students = User::where('user_role_id', 2)->where('parent_id', $parent_id)->get();
        }
        if(isset($_GET['student_id'])){
            $student_id = $_GET['student_id'];
        }


        if (isset($student_id)) {
            $subjects = ClassRoomSubjectTeachers::whereRaw("find_in_set('" . $student_id . "',students_id)")->get();
            foreach ($subjects as $subject) {
                $subject_id[] = $subject->subject_id;
                $class_room_id[] = $subject->class_room_id;
            }
            $current_date = date('d-m-Y h:i', time());
            // $assignments = Assignment::whereIn('subject_id', $subject_id)->whereIn('class_room_id', $class_room_id)->where('type', 1)->where('publish_status', 1)->get();
            $assignments = Assignment::whereIn('subject_id', $subject_id)->whereIn('class_room_id', $class_room_id)->where('type', 1)
                ->where(function ($query) use ($current_date) {
                    $query->where('publish_status', '==', 0)
                        ->whereNotNull('publish_date')
                        ->where('publish_date', '<=', $current_date)->orWhere(function ($query) {
                            $query->where('publish_status', '<>', 0)
                                ->where('publish_status', 1);
                        })->where('publish_date', '<=', $current_date);
                })->get();
        }
        return view('parent_dashboard.parent_assignment', ['assignments' => $assignments, 'students' => $students,'student_count' => $student_count,'student_id' => $student_id]);
    }
	public function assessment()
	{
		 $parent_id = session()->get('loginId');
         //$student_count = User::where('user_role_id', 2)->where('parent_id', $parent_id)->count();
         $students = User::where('user_role_id', 2)->where('parent_id', $parent_id)->get();
        $exams=[];
		if(isset($_GET['student_id'])){
            $student_id = $_GET['student_id'];
			$subjects = ClassRoomSubjectTeachers::whereRaw("find_in_set('" . $student_id . "',students_id)")->get();
            foreach ($subjects as $subject) {
                //$subject_id[] = $subject->subject_id;
                $class_room_id[] = $subject->class_room_id;
            }
			$exams=Exam::whereIn('class_room_id',$class_room_id)->get();
        }
		return view('parent_dashboard.assessment', ['students' => $students,'exams'=>$exams]);
	}
}