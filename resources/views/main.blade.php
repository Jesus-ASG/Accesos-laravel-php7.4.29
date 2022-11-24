<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/logo.png">
    <!-- Para peticiones de ajax -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('titulo') </title>

    <!-- Estilos propios -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Estilos de página -->
    @yield('page_styles')
    <!--Bootstrap-->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <!-- Íconos -->
    <script src="https://kit.fontawesome.com/f4ecb098da.js" crossorigin="anonymous"></script>
</head>

<body id="body_id">
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-navbar">
        <div class="container-fluid">
            <div>
                <a href="{{ route('index') }}" style="text-decoration: none;">
                    <img src="img/logo-navbar.jpg" height="80px" class="navbar-img">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            @includeWhen($logged, 'navbar-controlls.user')
            @includeUnless($logged, 'navbar-controlls.guest')
            
            
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container mt-3">
        @yield('contenido')
    </div>

    <!-- Footer -->
    <!-- Bootstrap script -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
    <!-- Scripts propios -->
    @yield('page_scripts')
</body>

</html>
