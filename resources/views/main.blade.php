<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/logo.png">
    <title> @yield('titulo') </title>

    <!-- Estilos propios -->
    <link rel="stylesheet" href="css/styles.css">
    <!--Bootstrap-->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <!-- Íconos -->
    <script src="https://kit.fontawesome.com/f4ecb098da.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-navbar">
        <div class="container-fluid">
            <div>
                <a href="{{ route('index') }}" style="text-decoration: none;">
                    <img src="img/LOGO-BUAP.jpg" height="80px" class="">
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                @includeWhen($logged, 'navbar-controlls.user')
                @includeUnless($logged, 'navbar-controlls.guest')
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container mt-3">
        @yield('contenido')
    </div>

    <!-- Footer -->

    <!-- Bootstrap script -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.js"></script>

    <!-- Para on document ready -->
    <script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
</body>

</html>
