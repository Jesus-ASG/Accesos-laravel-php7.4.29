<div class="navbar-item" style="display: inline;">
    <a href="{{ route('lector') }}" class="fs4">
        Lector de accesos
    </a>
</div>
<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{ route('ver-estudiantes') }}" class="fs4">Ver estudiantes</a>
    </div>
</li>

@if($tipo==0)
<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{route('register')}}" class="fs4">Registrar usuario</a>
    </div>
</li>
<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{route('espacios')}}" class="fs4">Administrar espacios</a>
    </div>
</li>
@endif

<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{route('logout')}}" class="fs4">Cerrar sesión</a>
    </div>
</li>