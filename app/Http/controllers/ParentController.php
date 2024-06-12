<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Branch;
use App\Models\SuspensionUsers;
use App\Models\Organization;
use DB;
use Mail;
use App\Mail\NewParentRegisterMail;
use Illuminate\Support\Facades\Hash;
class ParentController extends Controller
{
    //
    public function add(){
        $countries = Country::all();

        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches=Branch::where('branches.organization_id',$org_get_id)->where('type', 1)->get();
        return view("parent.add",compact('countries'),['branches'=>$branches]);
    }
    public function add_new(Request $request){
        $parent = new User;

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobileNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'zipCode' => 'required|numeric',
            'branch_id'=> 'required',
        ]);
        $parent->first_name =$request->firstName;
        $parent->last_name = $request->lastName;
        $parent->email= $request->email;
        $parent->mobile_number = $request->mobileNumber;
        $parent->address = $request->address;
        $parent->city = $request->city;
		if (!empty($request->country)) {
        $parent->country_id=$request->country;
		}
        $parent->zip_code = $request->zipCode;
        $parent->user_role_id=3;
        $parent->organization_id=$request->organization_id;
        $parent->branch_id = $request->branch_id;
        $parent->type = "1";
        $parent->save();
        //mail
		$user_id = session()->get('loginId');
        //$roleId = session()->get('roleId');
        $org_id = User::getOrganizationId($user_id);
		$parent_id=$parent->id;
		 $parent_obj = User::find($parent_id);
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
                    'username' => $parent->email,
                    'pwd' => $new_password,
                    'color_org' => $color_org,
                    'org_logo' => $org_logo
                ];
                $to = $parent->email;
                Mail::to($to)->send(new NewParentRegisterMail($mailData));
                //mail function
                $parent_obj->password = Hash::make($new_password);
                $parent_obj->save();
		//mail
        return redirect(route('parent_list'))->with('success', 'Parent Created Successfully');
    }

    public function edit($id)
    {
        $parent = User::find($id);
        $countries = Country::all();
        $suspensions=SuspensionUsers::where('user_id',$id)->get();

        $user_id = session()->get('loginId');
        $org_get_id = User::getOrganizationId($user_id);
        $branches=Branch::where('organization_id',$org_get_id)->where('type', 1)->get();

        $suspensions=SuspensionUsers::where('user_id',$id)->get();
        return view("parent.edit", ["data" => $parent,'branches'=>$branches,'suspensions'=>$suspensions],compact('countries'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $parent = User::find($id);


        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobileNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'branch_id' => 'required',
            'zipCode' => 'required|numeric',
        ]);
        $parent->first_name =$request->firstName;
        $parent->last_name = $request->lastName;
        $parent->email= $request->email;
        $parent->mobile_number = $request->mobileNumber;
        $parent->address = $request->address;
        $parent->city = $request->city;
		if (!empty($request->country)) {
        $parent->country_id=$request->country;
		}
        $parent->zip_code = $request->zipCode;
        $parent->user_role_id=3;
        $parent->branch_id = $request->branch_id;
        $parent->type = "1";
        $parent->save();
        //return redirect()->back()->with('message', 'Parent Details Updated Successfully');
        return redirect(route('parent_list'))->with('success', 'Parent Details Updated!');

    }

    public function status($id)
    {
        $parent = User::find($id);
        return view('parent.status', ['parent' => $parent]);
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $parent = User::find($id);
        if ($request->status == 1) {
            $parent->type = $request->status;
            $parent->suspend_msg = $request->suspend_msg;
            $parent->save();
        }
        //Suspensions Records
      if($request->status==2)
      {
        if (!empty($request->suspend_msg)) {

          $parent->type = $request->status;
          $parent->suspend_msg = $request->suspend_msg;
          $parent->save();

          $suspension = new SuspensionUsers;
          $suspension->user_id = $id;
          $suspension->suspension_reason= $request->suspend_msg;
          $suspension->suspension_date=date('d-m-Y');
          $suspension->save();
      }else{
        return back()->with('error', 'Suspension reason is mandatory');
    }
}
      //Suspensions Records
      return back()->with('message', 'Status Changed Successfully!');
        //return back()->with('message', 'Status Changed!');
    }

    public function list()
    {
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $parents = User::where('user_role_id',3)->where('organization_id', $org_id)->where('branch_id',$branch_id)->orderBy('created_at', 'DESC')->get();
        }else{
            $parents = User::where('user_role_id',3)->where('organization_id', $org_id)->orderBy('created_at', 'DESC')->get();
        }

        return view("parent.list", ["parents" => $parents]);
    }
    public function suspended_list()
    {
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchID($user_id);
        if (!empty($branch_id)) {
            $parents = User::where('user_role_id',3)->where('organization_id', $org_id)->where('branch_id',$branch_id)->where('type', 2)->orderBy('updated_at', 'DESC')->get();
        }else{
            $parents = User::where('user_role_id',3)->where('organization_id', $org_id)->where('type', 2)->orderBy('updated_at', 'DESC')->get();
        }
        return view("parent.suspended_list", ["parents" => $parents]);
    }
}
