<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpCAS;

use function PHPUnit\Framework\isEmpty;

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
        require_once (config_path('casconfig.php')); //Obtiene la configuración del CAS para la ESPOCH
        /**
         * Verifica si el usuario se autentico mediante CAS, si no lo fuerza a autenticarse
         * despues verifica si el usuario se autentico en el sistema, si no intenta autenticarlo
         * si el usuario no se encuentra en los registros de la base de datos de usuarios del sistema
         * no lo autentica e ingresa al sistema como un visitante
         */
        if(phpCAS::isAuthenticated()){
            $casuser = phpCAS::getUser();
            if(Auth::check() == false){
                $user = User::where('email',$casuser)->first();
                if(is_null($user) == false){
                    Auth::login($user);
                } 
            }           
        }else{
            phpCAS::forceAuthentication();
        } 
        return $next($request);
    }
}
