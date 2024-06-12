<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Branch;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\SuspensionUsers;
use App\Models\Organization;
use Validator;
use Mail;
use App\Mail\NewStudentRegisterMail;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //
    public function add($status)
    {
        $slug = $status;
        $countries = Country::all();

        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();
        $parents = User::where('users.user_role_id', 3)->where('users.organization_id', $org_get_id)->get();
        return view("student.add", compact('countries'), ['slug' => $slug, 'branches' => $branches, 'parents' => $parents]);
    }
    public function add_new(Request $request)
    {
        $student = new User;

        $request->validate([
            'student_avatar' => 'mimes:jpeg,jpg,png,gif|max:100|dimensions:max_width=100,max_height=100',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users',
            'mobileNumber' => 'sometimes|nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'zipCode' => 'sometimes|nullable|numeric',
        ]);

        if ($request->hasfile('student_avatar')) {
            $file = $request->file('student_avatar');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extenstion;
            $file->move(public_path('assets/img/student_avatar'), $filename);
            $student->student_avatar = $filename;
        }
        $student->first_name = $request->firstName;
        $student->last_name = $request->lastName;
        $student->mobile_number = $request->mobileNumber;
        $student->class = $request->class;
        $student->gender = $request->gender;
        $student->email = $request->email;
        $student->birth_date = $request->birthdate;
        $student->address = $request->address;
        $student->city = $request->city;
        $student->organization_id = $request->organization_id;

        $student->parent_id = $request->parent;

        if (!empty($request->country)) {
            $student->country_id = $request->country;
        }
        $student->zip_code = $request->zipCode;
        $student->user_role_id = 2;
        $student->organization_id = $request->organization_id;
        $student->branch_id = $request->branch_id;
        $student->type = "1";
        $student->save();
		//mail
		$user_id = session()->get('loginId');
        //$roleId = session()->get('roleId');
        $org_id = User::getOrganizationId($user_id);
		$student_id=$student->id;
		 $student_obj = User::find($student_id);
                //pwd
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $pass = array(); //remember to declare $pass as an array
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
                }
                $new_password = implode($pass);

                //pwd
                //mail function
                $org_logo = Organization::getOrgLogoByID($org_id);
                $org_name = Organization::getOrgNameById($org_id);
                $color_org = Organization::getOrgColorByID($org_id);
                $login_url = route('login');
                $mailData = [
                    'login_url' => $login_url,
                    'username' => $student->email,
                    'pwd' => $new_password,
                    'color_org' => $color_org,
                    'org_logo' => $org_logo
                ];
                $to = $student->email;
                Mail::to($to)->send(new NewStudentRegisterMail($mailData));
                //mail function
                $student_obj->password = Hash::make($new_password);
                $student_obj->save();
		//mail
        return redirect()->route("student_list")->with("success", "Student Profile Created Successfully!");
    }

    public function add_student_by_file(Request $request)
    {
        Excel::import(new StudentImport(), $request->file('file'));

        return redirect()->route('student_list')->with('success', 'Student Details Imported Successfully!');
    }
    public function add_student_bulk(Request $request)
    {

        // $first_name = $request->student['first_name'];
        //$last_name = $request->student['']['last_name'];
        //$email = $request->email;
        $count = count($request->first_name1);

        //$student=$request->student;
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $request->validate([
            'first_name1.*' => 'required',
            'last_name1.*' => 'required',
            'email1.*' => 'required|email'


        ]);
        for ($i = 0; $i < $count; $i++) {
            //$f_name.= $student[$i]['first_name'];


            $email = $request->email1[$i];
            $user_jp = User::where('email', $email)->first();
            if (isset($user_jp))
                $user_id = $user_jp->id;
            else {
                $student_new = new User;
                $student_new->first_name = $request->first_name1[$i];
                $student_new->last_name = $request->last_name1[$i];
                $student_new->email = $request->email1[$i];
                $student_new->user_role_id = 2;
                $student_new->type = 1;
                $student_new->organization_id = $org_get_id;
                $student_new->save();
                $user_id = $student_new->id;
            }
            //return $user_id;
            /*$validator = Validator::make($request->all(), [
        'first_name1.*' => 'required',
        'last_name1.*' => 'required',
        'email1.*' => 'required|email|unique:users'
    ]);
    if ($validator->fails()) {
        return redirect('/admin/student/add/bulk_import')->withErrors($validator);
    }*/
        }
        //return $f_name;

        // return redirect('/admin/student/add/bulk_import?count='.$count);
        return redirect()->route('student_list')->with('success', 'Student Details Imported Successfully');
    }

    public function list()
    {
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $students = User::where('user_role_id', 2)->where('organization_id', $org_id)->where('branch_id', $branch_id)->orderBy('created_at', 'DESC')->get();
        } else {
            $students = User::where('user_role_id', 2)->where('organization_id', $org_id)->orderBy('created_at', 'DESC')->get();
        }
        return view("student.list", ["students" => $students]);
    }

    public function edit($id)
    {
        $student = User::find($id);
        $branch_id = $student->branch_id;
        $countries = Country::all();
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();
        $parents = User::where('users.user_role_id', 3)->where('users.organization_id', $org_get_id)->where('branch_id', $branch_id)->get();
        $suspensions = SuspensionUsers::where('user_id', $id)->get();
        return view("student.edit", ["data" => $student, 'branches' => $branches, 'parents' => $parents, 'suspensions' => $suspensions], compact('countries'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $student = User::find($id);
        $request->validate([
            'student_avatar' => 'mimes:jpeg,jpg,png,gif|max:100|dimensions:max_width=100,max_height=100',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobileNumber' => 'sometimes|nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'zipCode' => 'sometimes|nullable|numeric',
        ]);

        if ($request->hasfile('student_avatar')) {
            // $destination = public_path('assets/img/organization_logo').$organization->logo;
            // if(File::exists($destination))
            // {
            //     File::delete($destination);
            // }
            $file = $request->file('student_avatar');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move(public_path('assets/img/student_avatar'), $filename);
            $student->student_avatar = $filename;
        }
        $student->first_name = $request->firstName;
        $student->last_name = $request->lastName;
        $student->gender = $request->gender;
        $student->email = $request->email;
        $student->class = $request->class;
        $student->section = $request->section;
        $student->birth_date = $request->birthdate;
        $student->mobile_number = $request->mobileNumber;
        $student->address = $request->address;
        $student->city = $request->city;
        $student->parent_id = $request->parent;
        if (!empty($request->country)) {
            $student->country_id = $request->country;
        }
        $student->zip_code = $request->zipCode;
        $student->user_role_id = 2;
        $student->organization_id = $request->organization_id;
        $student->branch_id = $request->branch_id;
        $student->type = "1";
        $student->save();
        //return redirect()->back()->with('message', 'Parent Details Updated Successfully');
        return redirect(route('student_list'))->with('success', 'Student Details Updated!');
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $student = User::find($id);
        if ($request->status == 1) {
            $student->type = $request->status;
            $student->suspend_msg = $request->suspend_msg;
            $student->save();
        }
        //Suspensions Records
        if ($request->status == 2) {
            if (!empty($request->suspend_msg)) {
                $student->type = $request->status;
                $student->suspend_msg = $request->suspend_msg;
                $student->save();

                $suspension = new SuspensionUsers;
                $suspension->user_id = $id;
                $suspension->suspension_reason = $request->suspend_msg;
                $suspension->suspension_date = date('d-m-Y');
                $suspension->save();
            } else {
                return back()->with('error', 'Suspension reason is mandatory');
            }
        }
        //Suspensions Records
        return back()->with('message', 'Status Changed Successfully!');
        //return back()->with('message', 'Status Changed!');
    }

    public function suspended_list()
    {
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $student = User::where('user_role_id', 2)->where('organization_id', $org_id)->where('branch_id', $branch_id)->where('type', 2)->orderBy('updated_at', 'DESC')->get();
        } else {
            $student = User::where('user_role_id', 2)->where('organization_id', $org_id)->where('type', 2)->orderBy('updated_at', 'DESC')->get();
        }
        return view("student.suspended_list", ["students" => $student]);
    }
    public function get_parents_by_branch(Request $request)
    {
        $branch_id = $request->branch_id;
        $users = User::where('branch_id', $branch_id)->where('user_role_id', 3)->where('type', 1)->get();
        return $users;
    }
    public function send_bulk_student_email()
    {
        $user_id = session()->get('loginId');
        //$roleId = session()->get('roleId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $students = User::where('user_role_id', 2)->where('organization_id', $org_id)->where('branch_id', $branch_id)->where('type', 1)->whereNull('password')->orderBy('created_at', 'DESC')->get();
        } else {
            $students = User::where('user_role_id', 2)->where('organization_id', $org_id)->where('type', 1)->whereNull('password')->orderBy('created_at', 'DESC')->get();
        }
        if ($students) {
            foreach ($students as $student) {
                $student_obj = User::find($student->id);
                //pwd
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $pass = array(); //remember to declare $pass as an array
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
                }
                $new_password = implode($pass);

                //pwd
                //mail function
                $org_logo = Organization::getOrgLogoByID($org_id);
                $org_name = Organization::getOrgNameById($org_id);
                $color_org = Organization::getOrgColorByID($org_id);
                $login_url = route('login');
                $mailData = [
                    'login_url' => $login_url,
                    'username' => $student->email,
                    'pwd' => $new_password,
                    'color_org' => $color_org,
                    'org_logo' => $org_logo
                ];
                $to = $student->email;
                if (preg_match('/@.+\./', $to) == true) {

                    Mail::to($to)->send(new NewStudentRegisterMail($mailData));
                    //mail function
                    $student_obj->password = Hash::make($new_password);
                    $student_obj->save();
                }
            }
        }
        return redirect(route('student_list'))->with('success', 'Student Password Mails Sent!');
    }
}
