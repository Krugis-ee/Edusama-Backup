<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use App\Models\UserRole;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use App\Models\SuspensionUsers;
use Mail;
use App\Mail\NewOtherUserRegisterMail;
use DB;

class OtherUserController extends Controller
{
    //Other users CRUD
    public function index_other_users()
    {
        //$users = User::where('type',1)->whereNotIn('user_role_id', [1,2,3,4])->get();

        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $users = DB::table('users')
                ->join('user_roles', 'users.user_role_id', '=', 'user_roles.id')
                ->select('users.name as name', 'users.branch_id as branch_id', 'users.email as email', 'users.mobile_number as mobile_number', 'users.id as id', 'users.user_role_id as user_role_id', 'users.type as type', 'users.suspend_msg as suspend_msg')
                ->where("users.organization_id", $org_id)->where('branch_id', $branch_id)->whereNotIn('users.user_role_id', [1, 2, 3, 4])
                ->get();
        } else {
            $users = DB::table('users')
                ->join('user_roles', 'users.user_role_id', '=', 'user_roles.id')
                ->select('users.name as name', 'users.branch_id as branch_id', 'users.email as email', 'users.mobile_number as mobile_number', 'users.id as id', 'users.user_role_id as user_role_id', 'users.type as type', 'users.suspend_msg as suspend_msg')
                ->where("users.organization_id", $org_id)->whereNotIn('users.user_role_id', [1, 2, 3, 4])
                ->get();
        }

        return view('other_users.list', ['users' => $users]);
    }
    public function suspended_list_other_users_index()
    {
        //$users = User::where('type',1)->whereNotIn('user_role_id', [1,2,3,4])->get();
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $users = DB::table('users')
            ->join('user_roles', 'users.user_role_id', '=', 'user_roles.id')
            ->select('users.name as name', 'users.email as email', 'users.mobile_number as mobile_number', 'users.id as id', 'users.user_role_id as user_role_id')
            ->where("users.organization_id", $org_id)->where("users.type", 2)->whereNotIn('users.user_role_id', [1, 2, 3, 4])->where('user_roles.type', 1)
            ->get();

        return view('other_users.suspended_list', ['users' => $users]);
    }
    public function add_other_user()
    {

        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $user_roles = UserRole::where('type', 1)->whereNotIn('id', [1, 2, 3, 4])->where('organization_id', $org_get_id)->get();
        $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();
        return view('other_users.add_new', ['user_roles' => $user_roles, 'branches' => $branches]);
    }
    public function add_new_other_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'user_role_id' => 'required',
            'branch_id' => 'required',
        ]);


        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->branch_id = $request->branch_id;
        $user->organization_id = $request->organization_id;
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
        Mail::to($to)->send(new NewOtherUserRegisterMail($mailData));
        //mail function
        $user->password = Hash::make($new_password);
        $user->user_role_id = $request->user_role_id;
        $user->save();
        return redirect(route('other_user_index'))->with('success', 'User created successfully!');
    }
    public function edit_other_user($id)
    {
        $user = User::find($id);

        $suspensions = SuspensionUsers::where('user_id', $id)->get();
        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches = Branch::where('branches.organization_id', $org_get_id)->where('type', 1)->get();
        $user_roles = UserRole::where('type', 1)->where('organization_id', $org_get_id)->whereNotIn('id', [1, 2, 3, 4])->get();
        return view('other_users.edit', ['user' => $user, 'user_roles' => $user_roles, 'branches' => $branches, 'suspensions' => $suspensions]);
    }
    public function update_other_user(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'user_role_id' => 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->branch_id=$request->branch_id;
        $user->user_role_id = $request->user_role_id;
        $user->save();
        return redirect(route('other_user_index'))->with('success', 'User Details Updated!');
    }
    public function other_user_change_status(Request $request)
    {
        $id = $request->id;

        $user = User::find($id);
        if ($request->status == 1) {
            $user->type = $request->status;
            $user->suspend_msg = $request->suspend_msg;
            $user->save();
        }
        //Suspensions Records
        if ($request->status == 2) {
            if (!empty($request->suspend_msg)) {
                $user->type = $request->status;
                $user->suspend_msg = $request->suspend_msg;
                $user->save();

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

        // return back()->with('success', 'Status Changed!');
    }
    //Other users CRUD
}
