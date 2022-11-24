<div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="d-flex m-1">
            <div class="navbar-item" style="display: inline;">
                <a href="{{ route('lector') }}" class="fs4">
                    Lector de accesos
                </a>
            </div>
        </li>
        
        <li class="d-flex m-1">
            <div class="navbar-item">
                <a href="{{ route('ver-estudiantes') }}" class="fs4">Ver estudiantes</a>
            </div>
        </li>
        @if ($tipo == 0)
            <li class="d-flex m-1">
                <div class="navbar-item">
                    <a href="{{ route('espacios') }}" class="fs4">Administrar espacios</a>
                </div>
            </li>
        @endif
    </ul>
    <li class="d-flex m-1">
        <div class="navbar-item">
            <a href="{{route('logout')}}" class="fs4" title="Salir"><i class="fa fa-sign-out fa-3x btn-logout" aria-hidden="true"></i></a>
        </div>
    </li>
</div>


