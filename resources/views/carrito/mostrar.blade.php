<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inicio</title>

    <link rel="icon" type="image/x-icon" href="../favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/carrito.css">

    <link href="/estilos.css" rel="stylesheet" />

    


</head>

<body>

    <!-- Navigation-->
    <div class="fixed-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 90px;">
      <div class="logo" style="position: fixed; top: 20px; left: 80px;">
        <!-- Logo de la tienda -->
        <a class=" navbar-brand" href="{{ url('/') }}">
          <img src="../logo_nav.png" alt="Logo de la Tienda" style="height: 50px;">

        </a>
      </div>

      <div class="container px-4 px-lg-5">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="  margin-left: -10px;">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ url('index') }}">Tienda</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('about') }}">Sobre Nosotros</a></li>

            @if(Auth::check() && Auth::user()->is_admin)
                        <li class="nav-item"><a class="nav-link" href="{{ url('admin') }}">Administrar</a></li>
                        @endif
                        
          </ul>

        </div>
     
        <div id="cesta" style="display: flex;align-items: baseline;margin: -280px">
        <form class="d-flex" id="cartForm" action="{{ route('carrito.mostrar') }}" method="GET">
            <button class="btn btn-outline-dark" type="submit">
                <i class="bi-cart-fill"></i>
                <span class="badge bg-dark text-white ms-1 rounded-pill"></span>
            </button>
        </form>
          @auth
            <div id="profile" style="margin-left: 25px; margin-top: 2px;">
                <div class="dropdown" style="margin-top: 5px;">
                    <a id="name_user" class="capitalize-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="name_user" style="margin-left:-68px;margin-top:15px;">
                        <a class="dropdown-item" href="{{ route('usuarios.editProfile') }}">Configuración</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf <!-- Token de seguridad -->
                        </form>
                    </div>
                </div>
            </div>
          @endauth
        </div>


        @if (Route::has('login'))

        <div>
          @auth

          @else
          <a href="{{ route('login') }}"><img class="centered-image" src="login-icon.png" alt="Imagen Centralizada"></a>

          @if (Route::has('register'))
          <a href="{{ route('register') }}"><img class="centered-image" src="register-icon.png" alt="Imagen Centralizada"></a>


          @endif
          @endauth


        </div>
        @endif
      </div>


  </div>
  </nav>
  </div>


  <div class="carrito-container">
    <h1>Cesta</h1>

    <!-- Contenido del carrito -->
    @if(count($carrito) > 0)
        <ul>
            @foreach($carrito as $idProductoConTalla => $producto)
                <li style="border-bottom: 1px solid #eee; padding: 10px 0; position: relative;">
                    <!-- Botón para eliminar producto del carrito -->
                    <form action="{{ route('carrito.eliminar', $idProductoConTalla) }}" method="POST" style="position: absolute; top: 5px; right: 5px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="custom-delete-btn">
                            <i class="bi bi-trash delete-icon"></i>
                        </button>
                    </form>
                    <!-- Detalles del producto -->
                    
                    <p><strong>Nombre del Producto:</strong> {{ $producto['nombre'] }}</p>
                    <p><strong>Precio:</strong> {{ $producto['precio'] }} €</p>
                    <p><strong>Cantidad:</strong> {{ $producto['cantidad'] }}</p>
                    <p><strong>Talla:</strong> {{ $producto['talla'] }}</p>
                    <p><strong>Categoría:</strong> {{ $producto['categoria'] }}</p>
                </li>
            @endforeach
        </ul>
        <!-- Botón para comprar -->
        <form action="{{ route('compra.confirmacion') }}" method="GET">
            <button type="submit" class="boton-compra">Comprar</button>
        </form>

    @else
        <p>El carrito está vacío</p>
    @endif
</div>




    <!-- Footer-->
    <footer class="footercar">
        <div>
            <p>Copyright &copy; Legit Style 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>


</html>