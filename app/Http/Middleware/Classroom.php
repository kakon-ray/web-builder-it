<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use DB;
use Illuminate\Http\Request;

class Classroom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $check_active_class = DB::table('active_courses')->where('student_id',Auth::guard('student')->user()->id)->where('status',1)->count();
        if(!$check_active_class){
            return redirect()->route('student.wishlist');
        }
        return $next($request);
    }
}
