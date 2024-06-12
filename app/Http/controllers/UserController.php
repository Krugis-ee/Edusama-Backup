<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Organization;
use App\Models\SuspensionUsers;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\NewAdminRegisterMail;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('user_role_id', 1)->orderBy('created_at', 'DESC')->get();
        return view('admins.list', ['users' => $users]);
    }
    public function suspended_list_index()
    {
        $users = User::where('type', 2)->where('user_role_id', 1)->orderBy('updated_at', 'DESC')->get();
        return view('admins.suspended_list', ['users' => $users]);
    }
    public function add()
    {
        $organizations = Organization::where('type', 1)->get();
        return view('admins.add_new', ['organizations' => $organizations]);
    }
    public function add_new(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'organization_id' => 'required',
            'siteconfig' => 'required',
        ]);

        //Mail function
        $organization_id = $request->organization_id;
        $organization = Organization::find($organization_id);
        $color_org = $organization->color;
        $org_logo = $organization->logo;
        //pwd
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $new_password = implode($pass);
        $login_url = route('login');
        $mailData = [
            'login_url' => $login_url,
            'username' => $request->email,
            'pwd' => $new_password,
            'color_org' => $color_org,
            'org_logo' => $org_logo
        ];
        //pwd
        // $to='jesuspreethi03@gmail.com';
        $to = $request->email;
        Mail::to($to)->send(new NewAdminRegisterMail($mailData));
        //mail         function
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;


        $user->password = Hash::make($new_password);
        $user->organization_id = $request->organization_id;
        $user->siteconfig = $request->siteconfig;

        //admin role id=1
        $user->user_role_id = 1;
        $user->save();
        return redirect(route('user_index'))->with('success', 'Admin created successfully!');
    }
    public function edit($id)
    {
        $user = User::find($id);
        $organizations = Organization::where('type', 1)->get();
        $suspensions = SuspensionUsers::where('user_id', $id)->get();
        return view('admins.edit', ['user' => $user, 'organizations' => $organizations, 'suspensions' => $suspensions]);
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'organization_id' => 'required',
            'siteconfig' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;



        $user->organization_id = $request->organization_id;
        $user->siteconfig = $request->siteconfig;

        $user->save();


        $user->save();
        return redirect(route('user_index'))->with('success', 'Admin Details Updated!');
    }

    public function status($id)
    {
        $user = User::find($id);
        return view('admins.status', ['user' => $user]);
    }

    public function change_status(Request $request)
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
        // return response()->json(['success'=>'Status changed successfully.']);
        return back()->with('message', 'Status Changed Successfully!');
    }
}
