
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Legit Style</title>
  <link rel="icon" type="image/x-icon" href="../favicon.ico" />
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <link href="/estilos.css" rel="stylesheet" />


  <style>
        #name_user {
            text-decoration: none;
            color: black;
            font-size: 20px;
            text-transform: capitalize;

        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            align-items: flex-end;
            flex-wrap: wrap;

        }

        #user-info p {
            font-size: 16px;
            font-weight: bold; 
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        input[type="password"] {
            margin-top: 10px;
        }

        #edit-link-btn {
            background-color: gold;
            color: black;
            border: none;
            padding: 10px 42px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

    </style>

</head>


<body id="page-top">

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

                <div id="cesta" style="display: flex;align-items: baseline;margin: -280px;height: 77px;">
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


    
        </nav>
    </div>


  </div>
  </nav>
  </div>

  <div id="user-info">
        @auth
            <form action="{{ route('usuarios.updateProfile') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="name" placeholder="Nombre" value="{{ Auth::user()->name }}"><br>
                <input type="text" name="email" placeholder="Email" value="{{ Auth::user()->email }}"><br>
                <input type="password" name="current_password" placeholder="Contraseña actual"><br>
                <input type="password" name="new_password" placeholder="Nueva contraseña"><br>
                <button id="edit-link-btn" type="submit">Guardar Cambios</button>
            </form>
        @endauth
    </div>
  <!-- Footer-->
  <footer class="py-5 bg-black">
    <div class="container px-5">
      <p class="m-0 text-center text-white small">Copyright &copy; Legit Style {{ date('Y') }}</p>
    </div>
  </footer>
<!-- JavaScript de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script>
  $(document).on('click', function (e) {
    if (!$(e.target).closest('.dropdown-toggle').length) {
      $('.dropdown-menu').each(function () {
        if ($(this).hasClass('show')) {
          $(this).removeClass('show');
        }
      });
    }
  });

  $('.dropdown-toggle').on('click', function (e) {
    e.preventDefault();
    $('.dropdown-menu').toggleClass('show');
  });
</script>
</body>

</html>

