<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <title>Sobre nosotros</title>

  <link href="/estilos.css" rel="stylesheet" />
  <link href="/about.css" rel="stylesheet" />

  <style>
    #name_user {
      text-decoration: none;
      color: black;
      font-size: 20px;
      text-transform: capitalize;

    }
  </style>

</head>

<body id="page-top">

<div class="fixed-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 90px;">
      <div class="logo" style="position: fixed; top: 20px; left: 80px;">

      <a class=" navbar-brand" href="{{ url('/') }}">
          <img src="logo_nav.png" alt="Logo de la Tienda" style="height: 50px;">

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



          <div id="cesta" style="display: flex;align-items: baseline;margin-right: 1%;">
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
                <div class="dropdown-menu" aria-labelledby="name_user" style="margin-left: -26px;margin-top:15px;">
                  <a class="dropdown-item" href="{{ route('usuarios.showProfile') }}">Configuración</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf 
                  </form>
                </div>
              </div>
            </div>
            @endauth
          </div>

        </div>

        @if (Route::has('login'))

        <div style="margin-right: -280px;">
          @auth

          @else
          <a href="{{ route('login') }}"><img class="centered-image" src="login-icon.png" alt="Imagen Centralizada"></a>

          @if (Route::has('register'))
          <a href="{{ route('register') }}"><img class="centered-image" style="margin-top: 1%;" src="register-icon.png" alt="Imagen Centralizada"></a>


          @endif
          @endauth


        </div>
        @endif
      </div>


  </div>
  </nav>
  </div>

  </div>
  </nav>
  </div>

  <div class="container px-4 px-lg-5" style="margin-top: 9%;">

  <div class="row gx-4 gx-lg-5 align-items-center my-5">
      <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="homestyle.png" alt="..." /></div>
      <div class="col-lg-5">
        <h1 class="font-weight-light">Legit Style</h1>
        <hr>
        <p>Tu destino definitivo para la moda urbana y auténtica.</p>
        <p>En Legit Style, no solo ofrecemos moda, sino un estilo de vida. <br><br>Desde prendas de vestir elegantes hasta accesorios modernos, nuestro compromiso es brindarte la mejor experiencia de compra.<br></p>
        <br>
        <p>Explora nuestras ofertas exclusivas y descubre cómo puedes destacar en cualquier ocasión. <br><br>Ya sea que estés buscando el atuendo perfecto para el día a día o algo especial para una ocasión única, Legit Style tiene lo que necesitas para expresar tu auténtico yo.</p>
        <hr>
        <a class="btn btn-primary" href="{{ url('index') }}">Explora Ahora</a>
      </div>
    </div>
    <br>

    <div class="card text-white bg-secondary my-5 py-4 text-center">
      <div class="card-body">
        <p class="text-white m-0">Descubre la autenticidad en cada prenda. ¡Únete a nosotros y redefine tu estilo!</p>
      </div>
    </div>

    <div class="row gx-4 gx-lg-5">
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Últimas Tendencias</h2>
            <p class="card-text">Explora nuestras colecciones con las últimas tendencias de la moda urbana.</p>
          </div>
          <div class="card-footer"><a class="btn btn-primary btn-sm" href="{{ url('index') }}">Ver Colección</a></div>
        </div>
      </div>
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Calidad Garantizada</h2>
            <p class="card-text">Nos comprometemos a ofrecer productos de alta calidad y duraderos.</p>
          </div>
          <div class="card-footer"><a class="btn btn-primary btn-sm" href="{{ url('index') }}">Explora Detalles</a></div>
        </div>
      </div>
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Envío Rápido</h2>
            <p class="card-text">¡Recibe tus compras en la puerta de tu casa de manera rápida y segura!</p>
          </div>
          <div class="card-footer"><a class="btn btn-primary btn-sm" href="{{ url('index') }}">Más Información</a></div>
        </div>
      </div>
    </div>
  </div>


  <footer>
    <div>
      <p style="font-size: initial;">Copyright &copy; Legit Style 2023</p>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).on('click', function(e) {
      if (!$(e.target).closest('.dropdown-toggle').length) {
        $('.dropdown-menu').each(function() {
          if ($(this).hasClass('show')) {
            $(this).removeClass('show');
          }
        });
      }
    });

    $('.dropdown-toggle').on('click', function(e) {
      e.preventDefault();
      $('.dropdown-menu').toggleClass('show');
    });
  </script>


</body>

</html>