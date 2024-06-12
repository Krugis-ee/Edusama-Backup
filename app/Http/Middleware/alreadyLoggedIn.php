<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;
class alreadyLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //code by jp
        if(session()->has('loginId') && (Session::get('roleId')==1) && (url('login')==$request->url() || url('forgot-password')==$request->url()))
        return redirect('admin');
		
		if(session()->has('loginId') && (Session::get('roleId')==2) && (url('login')==$request->url() || url('forgot-password')==$request->url()))
        return redirect('student');
	
		if(session()->has('loginId') && (Session::get('roleId')==3) && (url('login')==$request->url() || url('forgot-password')==$request->url()))
        return redirect('parent');
	
		if(session()->has('loginId') && (Session::get('roleId')==4) && (url('login')==$request->url() || url('forgot-password')==$request->url()))
        return redirect('teacher');
        //code by jp
        /*return $next($request);*/
      $response = $next($request);
        return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
    }
}
