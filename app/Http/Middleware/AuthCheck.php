<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Organization;
use Session;
class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         //code by jp
         //
        $user_id=Session()->get('loginId');
        $type=User::getStatus($user_id);
        //
         if(!Session()->has('loginId'))
         return redirect('login')->with('fail','You have to login to access admin pages');
		//apr_4
		/*$current_url=$request->url();
		$current_url_arr=explode('/',$current_url);
		if((Session::get('roleId')==2) && $current_url_arr[1]!='student')
			return $current_url_arr[1];
		//return redirect('student');
		*/
		//apr_4
        if($type==2)
        return redirect('suspend');

        //if organisation suspened , redirect to suspended page
        $user=User::find($user_id);
        $org=Organization::find($user->organization_id);
        $org_type=$org->type;
        if($org_type==2)
        return redirect('suspend');
        //if organisation suspened

        
      $response = $next($request);
        /*return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');*/
			$response->headers->set('X-Frame-Options', 'DENY');
$response->headers->set('X-XSS-Protection', '1; mode=block');
$response->headers->set('X-Permitted-Cross-Domain-Policies', 'master-only');
$response->headers->set('X-Content-Type-Options', 'nosniff');
$response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
$response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
$response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
$response->headers->set('Pragma', 'no-cache');
$response->headers->set('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
return $response;
     //code by jp
        // return $next($request);
    }
}
