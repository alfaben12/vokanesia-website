<?php

namespace App\Http\Middleware;

use Auth;
use Closure;


class CheckCustomer
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

        $user = Auth::user();
        if($user->verivied !== 'yes'){
            return redirect()->route('customers.otp');
        }else{
            return $next($request);
        }

        
    }
}
