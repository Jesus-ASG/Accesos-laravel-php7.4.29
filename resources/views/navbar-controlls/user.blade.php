<div class="navbar-item" style="display: inline;">
    <a href="{{ route('lector') }}">
        Lector de accesos
    </a>
</div>
<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{ route('ver-estudiantes') }}">Ver estudiantes</a>
    </div>
</li>

@if($tipo==0)
<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{route('register')}}">Registrar usuario</a>
    </div>
</li>
<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{route('espacios')}}">Administrar espacios</a>
    </div>
</li>
@endif

<li class="d-flex m-1">
    <div class="navbar-item">
        <a href="{{route('logout')}}">Cerrar sesión</a>
    </div>
</li>