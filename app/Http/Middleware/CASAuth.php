<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpCAS;

class CASAuth
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
        require_once (config_path('casconfig.php'));
        if(phpCAS::isAuthenticated()){
            $casuser = phpCAS::getUser();
            $user = User::where('email',$casuser)->first();
            Auth::login($user);
            return $next($request);
        }else{
            phpCAS::forceAuthentication();       
            return $next($request);
        } 
    }
}
