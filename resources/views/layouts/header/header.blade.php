<?php
$casservername = 'seguridad.espoch.edu.ec';
$casport = 443;
$casbaseuri = '/cas';
$caslogouturl = '/logout?service=';
$casprotocol = 'https://';
?>
<nav class="nav__convenio">
    <img src="{{url('img/logoEspoch.svg')}}" alt="" class="logo">
    <ul class="nav__links">
        <li class="nav__element">
            <a href="#" class="nav__link">
               Control y Seguimiento de Convenios
            </a>
        </li>
        
        <li class="nav__element nav__element--right nav__element--click">
            <a href="#" class="nav__link">
               {{phpCAS::getUser()}}
               <span class="link__arrow">
                    <i class="fa-solid fa-chevron-right link__arrow--transform"></i>
               </span>
            </a>
            <div class="overlay"> 
                <nav class="nav nav--display">
                    <ul class="nav__links">
                        <li class="nav__element nav__element--right">
                            <a href="{{$casprotocol . $casservername . $casbaseuri . $caslogouturl . route('logout')}}" class="nav__link nav__link--display">
                            <span class="link__icon"><i class="fa-solid fa-power-off"></i></span>
                            Salir
                            </a>
                        </li>
                    </ul>
                </nav> 
            </div>
        </li>
        <li class="nav__element nav__element--right nav__element--rol">
            <a href="#" class="nav__link">
              <span>{{str_replace(array('"', '[', ']'),'',auth()->user()->getRoleNames())}}</span>
            </a>
        </li>
        <li class="nav__element nav__element--right">
            <a href="#" class="nav__link">
               <span>Rol:</span>
            </a>
        </li>
    </ul>
</nav>