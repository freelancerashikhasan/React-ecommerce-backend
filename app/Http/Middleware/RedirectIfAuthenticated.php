<?php

namespace App\Http\Middleware;

use App\Helpers\Constant;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // if (Auth::guard($guard)->check()) {
            //     return redirect(RouteServiceProvider::HOME);
            // }
            if ($guard == "admin" && Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::ADMIN_HOME);
            }
            if (Auth::guard($guard)->check()) {
                if(Auth::user()->type == Constant::USER_TYPE['agent']){
                    return redirect(RouteServiceProvider::HOME);
                }
                elseif(Auth::user()->type == Constant::USER_TYPE['customer']){
                    return redirect(RouteServiceProvider::CUSTOMER2_HOME);
                }
                elseif(Auth::user()->type == Constant::USER_TYPE['pharmacy']){
                    return redirect(RouteServiceProvider::PHARMACY_HOME);
                }
                else{
                    return redirect(RouteServiceProvider::CUSTOMER_HOME);
                }
            }
        }

        return $next($request);
    }
}
