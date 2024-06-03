<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Legit Style</title>
  <link rel="icon" type="image/x-icon" href="favicon.ico" />
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <link href="home.css" rel="stylesheet" />
  <link href="/estilos.css" rel="stylesheet" />
</head>

<style>
  #name_user {
    text-decoration: none;
    color: black;
    font-size: 20px;
    text-transform: capitalize;

  }
</style>

<body id="page-top">
  <!-- Navigation-->
  <!-- Navigation-->
  <div class="fixed-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 90px;">
      <div class="logo" style="position: fixed; top: 20px; left: 80px;">
        <!-- Logo de la tienda -->
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
                    @csrf <!-- Token de seguridad -->
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

  <header class=" text-center text-white">
    <video autoplay muted loop id="video-background" width="1800px" height="800px" oncontextmenu="return false;" style="margin-top:7%;z-index: -1;">
      <source src="video.mp4" type="video/mp4">
      Tu navegador no soporta el elemento de video.

    </video>
    <a class="btn-tienda" href="{{ url('index') }}">VISITAR TIENDA</a>

    <div class="masthead-content">
      <div class="container px-5">


      </div>
    </div>

  </header>

  <section id="scroll">
    <div class="container px-5">
      <div class="row gx-5 align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5"><img style="border-radius: 50%; overflow: hidden;" class="img-fluid rounded-circle" src="image1.png" alt="Imagen de moda Legit Style" /></div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Descubre el estilo auténtico</h2>
            <p>Explora nuestra colección única que te llevará a nuevas alturas de la moda. <br>En Legit Style, estamos comprometidos con ofrecerte la mejor experiencia de moda. <br>Desde elegantes prendas de vestir hasta accesorios llamativos, cada pieza cuenta una historia de autenticidad y calidad.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Content section 2 -->
  <section>
    <div class="container px-5">
      <div class="row gx-5 align-items-center">
        <div class="col-lg-6">
          <div class="p-5"><img style="border-radius: 10%; overflow: hidden;" class="img-fluid rounded-circle" src="image2.png" alt="Imagen de moda Legit Style" /></div>
        </div>
        <div class="col-lg-6">
          <div class="p-5">
            <h2 class="display-4">Saludamos a tu estilo único</h2>
            <p>En Legit Style, creemos que la moda es una forma de expresión personal. <br>Nuestra colección está diseñada para celebrar tu singularidad y destacar tu estilo único. <br>Descubre prendas que se adaptan a tu personalidad y te permiten destacar en cualquier ocasión.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section>
    <div class="container px-5">
      <div class="row gx-5 align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5"><img style="border-radius: 50%; overflow: hidden;" class="img-fluid rounded-circle" src="image3.png" alt="Imagen de moda Legit Style" /></div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Que la moda sea el centro de atención</h2>
            <p>Sumérgete en el mundo de Legit Style, donde la moda cobra vida. <br>Nuestra pasión es ofrecerte las últimas tendencias que te permitan destacar. <br>Desde atuendos casuales hasta prendas elegantes, cada pieza está diseñada con atención al detalle para que la moda sea el centro de atención en cada momento de tu vida.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <footer>
    <div>
      <p>Copyright &copy; Legit Style {{ date('Y') }}</p>
    </div>
  </footer>
  <!-- JavaScript de Bootstrap -->
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