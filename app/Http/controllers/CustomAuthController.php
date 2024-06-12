<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//jp
use App\Models\User;
use Hash;
use Session;
use Mail;
use App\Mail\DemoMail;
//jp
class CustomAuthController extends Controller
{
     public function login()
    {
        return view('login');
    }
    public function forgot_password()
    {
        return view('forgot_password');
    }
    public function login_process(Request $request)
    {
       //$pageConfigs = ['myLayout' => 'blank'];
        //return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
        $user=User::where('email','=', $request->email )->first();
        if($user)
        {
            if(Hash::check($request->password,$user->password))
            {
                $request->session()->put('loginId',$user->id);
                $request->session()->put('roleId',$user->user_role_id);
                $user_role_id=$user->user_role_id;
                //if ( $user_role_id==1 || $user_role_id==2 )
                   
                    if ( $user_role_id==2 )
                    return redirect('student');
                   else if ( $user_role_id==3 )
                    return redirect('parent');
                    else if ( $user_role_id==4 )
                    return redirect('teacher');
                    else
                    return redirect('admin');
                    
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
    public function forgot_password_process(Request $request)
    {
       //$pageConfigs = ['myLayout' => 'blank'];
        //return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
        $user=User::where('email','=', $request->email )->first();
        $curr_email=$request->email;
        if($user)
        {
            //Mail function
            //pwd
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $new_password=implode($pass);
          $mailData=[
          'title'=>'Hi',
           'body'=>$new_password
          ];
            //pwd
         // $to='jesuspreethi03@gmail.com';
          $to=$curr_email;
          Mail::to($to)->send(new DemoMail($mailData));
            //mail         function
           /* Mail::raw('Hi'.$user->name, function ($message) {
  				$message->to('admin-test@krugis.ee')
    			->subject('Your new password is');
			});*/
                $user->password = Hash::make($new_password);
                $user->save();
                //return back()->with('success','New Password Mail Sent');
          return redirect('login')->with('success','New Password Mail Sent');
        }
        else
        {
           return back()->with('fail','Invalid Credentials');
        }
    }
    public function logout()
    {
        if(Session::has('loginId'))
        Session::pull('loginId');

        //if(Session::has('roleId'))
        //Session::pull('roleId');
        return redirect('login');
    }
}
