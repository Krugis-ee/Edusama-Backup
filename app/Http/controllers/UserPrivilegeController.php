<?php

namespace App\Http\Controllers;
use App\Models\UserRole;
use App\Models\UserPrivilege;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
class UserPrivilegeController extends Controller
{
    public function privilege()
    {
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $user_role = UserRole::where('type', 1)->where('organization_id', $org_id)->whereNotIn('id',[1,2,3,4])->get();
        return view("user_privilege.add", ["user_role" => $user_role]);
    }
    public function privilege_add(Request $request){
        $request->validate([
            'user_id' => 'required|unique:user_privileges,user_id',
            'user_privilege' => 'required',
        ]);
        $user_privilege = new UserPrivilege;
        $user_privilege->user_id = $request->user_id;
        $user_privilege->privileges =implode(',',$request->user_privilege);
        $user_privilege->save();
        return redirect()->back()->with('message', 'UserPrivilege Created Successfully');
    }
    public function privilege_list()
    {
        //$user_privileges = UserPrivilege::all();
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $user_privileges =DB::table('user_privileges')
        ->join('users','user_privileges.user_id','=','users.id')
        ->where('users.type',1)->where('users.organization_id',$org_id)
        ->select('users.name as user_name','user_privileges.id as id', 'users.id as user_id_jp')
        ->get();
        return view("user_privilege.list", ["user_privileges" => $user_privileges]);
    }
    public function edit($id)
    {
        $user_privilege = UserPrivilege::find($id);
        return view("user_privilege.edit", ["user_privilege" => $user_privilege]);
    }
    public function update(Request $request)
    {
        $request->validate([
           // 'user_id' => 'required|unique:user_privileges,user_id',
            'user_privilege' => 'required',
        ]);
        $id = $request->id;
        $user_privilege = UserPrivilege::find($id);
        //$user_privilege->user_id = $request->user_id;
        $user_privilege->privileges = implode(',',$request->user_privilege);
        $user_privilege->save();
        return redirect()->route('user_privilege_list')->with('message', 'User Privileges Updated Successfully');
       // return redirect()->back()->with('message', 'User Privileges Updated Successfully');

    }
    
}
