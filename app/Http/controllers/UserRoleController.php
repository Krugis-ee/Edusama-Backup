<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use App\Models\User;
use App\Models\UserPrivilege;
use Illuminate\Http\Request;
use App\Models\SuspensionRoles;

class UserRoleController extends Controller
{
    public function list()
    {
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $user_role = UserRole::where('organization_id', $org_id)->whereNotIn('id', [1, 2, 3, 4])->get();
        return view("user_role.list", ["user_role" => $user_role]);
    }
    public function suspended_list()
    {
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $user_role = UserRole::where('type', 2)->where('organization_id', $org_id)->get();
        return view("user_role.suspended_list", ["user_role" => $user_role]);
    }
    //
    public function add()
    {
        return view("user_role.add");
    }
    public function add_new(Request $request)
    {
        $request->validate([
            'role_name' => 'required',
        ]);
        $user_role = new UserRole;
        $user_role->role_name = $request->role_name;
        $user_role->organization_id = $request->organization_id;
        $user_role->type = "1";
        $user_role->save();
        return redirect()->back()->with('message', 'UserRole Created Successfully');
    }

    public function edit($id)
    {
        $user_role = UserRole::find($id);
        return view("user_role.edit", ["data" => $user_role]);
    }
    public function update(Request $request)
    {

        $request->validate([
            'role_name' => 'required',
        ]);
        $id = $request->id;
        $user_role = UserRole::find($id);

        $user_role->role_name = $request->role_name;
        $user_role->save();
        return redirect()->back()->with('message', 'UserRole Updated Successfully');
    }

    public function status($id)
    {
        $user_role = UserRole::find($id);
        return view('user_role.status', ['user_role' => $user_role]);
    }

    public function change_status(Request $request)
    {

        $id = $request->id;
        $user_role = UserRole::find($id);
        if ($request->status == 1) {
            $user_role->type = $request->status;
            $user_role->suspend_msg = $request->suspend_msg;
            $user_role->save();
        }
        //Suspensions Records
        if ($request->status == 2) {
            if (!empty($request->suspend_msg)) {
                $user_role->type = $request->status;
                $user_role->suspend_msg = $request->suspend_msg;
                $user_role->save();

                $suspension = new SuspensionRoles;
                $suspension->role_id = $id;
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
}
