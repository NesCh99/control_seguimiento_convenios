<!-- Plantilla del Menu Lateral -->
<nav class="nav__convenio">
        <div class="nav__expand">
                <span class="expand__icon expand__icon--click">
                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                </span>

                <div class="expan__liner"></div>
        </div>
    <ul class="nav__links">
        <li class="nav__element nav__element--block">
                <a href="{{route('home')}}" class="nav__link nav__link--small">
                <span class="link__icon--margin">
                <i class="fa-solid fa-house"></i>
                </span>
                Inicio    
                </a>
                <a href="{{url('/') }}" class="nav__link-inicio">
                Inicio
                </a>     
        </li>

        <!-- Opciones de Administración -->

        <li class="nav__element nav__element--block">
                <a href="{{url('/usuarios') }}" class="nav__link nav__link--small">
                <span class="link__icon--margin">
                <i class="fa-solid fa-user-group"></i>
                </span>
                 Usuarios
                </a>
                <a href="{{url('/usuarios') }}" class="nav__link-usuario">
                        Usuarios
                </a>
        </li>

        <li class="nav__element nav__element--block">
                <a href="{{route('admin.clasificaciones.index')}}" class="nav__link nav__link--small">
                <span class="link__icon--margin">
                <i class="fa-solid fa-layer-group"></i>
                </span>
                 Clasificaciones
                </a>
                <a href="{{route('admin.clasificaciones.index')}}" class="nav__link-clasificacion">
                        Clasificaciones
                </a>
        </li>

        <li class="nav__element nav__element--block">
                <a href="{{route('admin.ejes.index')}}" class="nav__link nav__link--small">
                <span class="link__icon--margin">
                <i class="fa-solid fa-list"></i>
                </span>
                 Ejes de Acción
                </a>
                <a href="{{route('admin.ejes.index')}}" class="nav__link-eje">
                        Ejes de Acción
                </a>
        </li>

        <li class="nav__element nav__element--block">
                <a href="{{route('admin.dependencias.index')}}" class="nav__link nav__link--small">
                <span class="link__icon--margin">
                <i class="fa-solid fa-building"></i>
                </span>
                 Dependencias
                </a>
                <a href="{{route('admin.dependencias.index')}}" class="nav__link-dependencia">
                        Dependencias
                </a>
        </li>

        <!-- Opciones de Técnico de Convenios -->
        <li class="nav__element nav__element--block">
                <a href="{{route('tecnico.resoluciones.index')}}" class="nav__link nav__link--small">
                <span class="link__icon--margin">
                <i class="fa-solid fa-file"></i>
                </span>
                Resoluciones
                </a>
                <a href="{{route('tecnico.resoluciones.index')}}" class="nav__link-resolucion">
                       Resoluciones
                </a>
        </li>

        <li class="nav__element nav__element--block">
                <a href="{{route('tecnico.coordinadores.index')}}" class="nav__link nav__link--small">
                <span class="link__icon--margin">
                <i class="fa-solid fa-users"></i>
                </span>
                Coordinadores
                </a>
                <a href="{{route('tecnico.coordinadores.index')}}" class="nav__link-coordinador">
                       Coordinadores
                </a>
        </li>

        <li class="nav__element nav__element--block">
                <a href="{{route('tecnico.convenios.index')}}" class="nav__link nav__link--small">
                <span class="link__icon--margin">
                <i class="fa-solid fa-handshake"></i>
                </span>
                Convenios
                </a>

                <a href="{{route('tecnico.convenios.index')}}" class="nav__link-convenio">
                      Convenios
                   </a>
        </li>
 
        <li class="nav__element nav__element--block">
                <a href="{{route('tecnico.reporte')}}" class="nav__link nav__link--small">
                <span class="link__icon--margin">
                <i class="fa-solid fa-chart-column"></i>
                </span>
                Reportes
                </a>

                <a href="{{route('tecnico.reporte')}}" class="nav__link-reporte">
                       Reporte
                  </a>

        </li>
    </ul>
</nav>