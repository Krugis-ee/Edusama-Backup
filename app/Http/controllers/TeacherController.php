<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Branch;
use App\Models\SuspensionUsers;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\NewTeacherRegisterMail;

class TeacherController extends Controller
{
    //
    public function add()
    {
        $countries = Country::all();
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_id)->where('type', 1)->get();
        return view("teacher.add", compact('countries'), ['branches' => $branches, 'org_id' => $org_id]);
    }

    public function add_new(Request $request)
    {

        $teacher = new User;
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);

        $request->validate([
            'teacher_avatar' => 'mimes:jpeg,jpg,png,gif|dimensions:max_width=100,max_height=100|max:100',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email',
            'facebook_profile' => 'sometimes|nullable|url',
            'twitter_profile' => 'sometimes|nullable|url',
            'linkedin_profile' => 'sometimes|nullable|url',
            'instagram_profile' => 'sometimes|nullable|url',
            'branch_id' => 'required',
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
        $teacher->email = $request->email;
        $teacher->designation = $request->designation;
        // $teacher->department = $request->department;
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
        $teacher->branch_id = $request->branch_id;
        $teacher->organization_id = $org_id;
        $teacher->user_role_id = 4;
        // $teacher->branch_id = $request->branch_id;
        $teacher->type = "1";
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
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $org_logo = Organization::getOrgLogoByID($org_id);
        $org_name = Organization::getOrgNameById($org_id);
        $color_org = Organization::getOrgColorByID($org_id);
        $login_url = route('login');
        $mailData = [
            'login_url' => $login_url,
            'username' => $request->email,
            'pwd' => $new_password,
            'color_org' => $color_org,
            'org_logo' => $org_logo
        ];
        $to = $request->email;
        Mail::to($to)->send(new NewTeacherRegisterMail($mailData));
        //mail function
        $teacher->password = Hash::make($new_password);
        $teacher->save();
        // route("teacher_list")
        return redirect()->route('teacher_list')->with("success", "Teacher Profile Created Successfully");
    }

    public function list()
    {
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $teachers = User::where('user_role_id', 4)->where('organization_id', $org_id)->where('branch_id', $branch_id)->orderBy('created_at', 'DESC')->get();
        } else {
            $teachers = User::where('user_role_id', 4)->where('organization_id', $org_id)->orderBy('created_at', 'DESC')->get();
        }
        return view("teacher.list", ["teachers" => $teachers]);
    }

    public function edit($id)
    {
        $teacher = User::find($id);
        $branch_id = $teacher->branch_id;
        $countries = Country::all();
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();
        $suspensions = SuspensionUsers::where('user_id', $id)->get();
        return view("teacher.edit", ["data" => $teacher, 'branches' => $branches, 'suspensions' => $suspensions], compact('countries'));
    }

    public function update(Request $request)
    {

        $id = $request->id;
        $teacher = User::find($id);

        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);

        $request->validate([
            'teacher_avatar' => 'mimes:jpeg,jpg,png,gif|dimensions:max_width=100,max_height=100|max:100',
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'facebook_profile' => 'sometimes|nullable|url',
            'twitter_profile' => 'sometimes|nullable|url',
            'linkedin_profile' => 'sometimes|nullable|url',
            'instagram_profile' => 'sometimes|nullable|url',
            'branch_id' => 'required',
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
        $teacher->email = $request->email;
        $teacher->designation = $request->designation;
        // $teacher->department = $request->department;
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
        $teacher->branch_id = $request->branch_id;
        $teacher->organization_id = $org_id;
        $teacher->user_role_id = 4;
        // $teacher->branch_id = $request->branch_id;
        $teacher->type = "1";
        $teacher->save();
        // route("teacher_list")
        return redirect()->route('teacher_list')->with("success", "Teacher Profile Updated Sucessfully");
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $teacher = User::find($id);
        if ($request->status == 1) {
            $teacher->type = $request->status;
            $teacher->suspend_msg = $request->suspend_msg;
            $teacher->save();
        }
        //Suspensions Records
        if ($request->status == 2) {
            if (!empty($request->suspend_msg)) {
                $teacher->type = $request->status;
                $teacher->suspend_msg = $request->suspend_msg;
                $teacher->save();

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
            $teachers = User::where('user_role_id', 4)->where('organization_id', $org_id)->where('branch_id', $branch_id)->where('type', 2)->orderBy('updated_at', 'DESC')->get();
        } else {
            $teachers = User::where('user_role_id', 4)->where('organization_id', $org_id)->where('type', 2)->orderBy('updated_at', 'DESC')->get();
        }
        return view("teacher.suspended_list", ["teachers" => $teachers]);
    }
}
