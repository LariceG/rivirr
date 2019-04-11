<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(Session::get('user_id'))
        {
            return $next($request);
         
        }
      
          return redirect('employer');
       
    }
}
