<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin;
use Hash;
use Session;
use Mail;
use App\Mail\DemoMail;

class SuperAdminController extends Controller
{
    public function login()
    {
        return view('superadmin_login');
    }
    public function login_process(Request $request)
    {
       //$pageConfigs = ['myLayout' => 'blank'];
        //return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
        $user=SuperAdmin::where('email','=', $request->email )->first();
        if($user)
        {
            if(Hash::check($request->password,$user->password))
            {
                $request->session()->put('loginIdSuperAdmin',$user->id);
                return redirect('superadmin');
                //return 'ok';
                //$request->session()->put('roleId',$user->user_role_id);
               /* $user_role_id=$user->user_role_id;
                if ( $user_role_id==1 || $user_role_id==2 )
                    return redirect('admin');
                    if ( $user_role_id==3 )
                    return redirect('teacher');
                    if ( $user_role_id==4 )
                    return redirect('student');
                    if ( $user_role_id==5 )
                    return redirect('parent');*/
            }
            else
            {
                return back()->with('fail','Invalid Credentials');
            }

        }
        else
        {
           return back()->with('fail','Invalid Credentials');
        }
    }
  public function dashboard(Request $request){
        return view('super_admin.superadmin_home');

    }
	public function siteconfig(Request $request){
        return view('super_admin.siteconfig');

    }
    public function logout()
    {
        if(Session::has('loginIdSuperAdmin'))
        Session::pull('loginIdSuperAdmin');

        //if(Session::has('roleId'))
        //Session::pull('roleId');
        return redirect()->route('superadmin_login');
    }
}
