<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca&display=swap" rel="stylesheet">

  <title>Login</title>


  <link href="/estilos.css" rel="stylesheet" />



</head>

<body>

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


          </ul>

        </div>




      </div>
    </nav>

  </div>




  <section class="bg-light p-3 p-md-4 p-xl-5" style="margin-top:35px;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-xxl-11">
          <div class="  d border-light-subtle shadow-sm">
            <div class="row g-0">
              <div class="col-12 col-md-6">
                <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="login.png" alt="">
              </div>

              <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">

                <div class="col-12 col-lg-11 col-xl-10">
                  <div class="text-center mb-4">
                    <a href="/">
                      <img src="logo_nav.png" alt="" width="220" height="85">
                    </a>
                  </div>
                  <div class="card-body p-3 p-md-4 p-xl-5">
                    <div class="row">
                      <div class="col-12">
                        <div class="mb-5">

                          <h4 class="text-center">Bienvenido/a, te hemos echado de menos.</h4>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="d-flex gap-3 flex-column">

                        </div>

                      </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                      @csrf
                      <div class="row gy-3 overflow-hidden">
                        <div class="col-12">
                          <div class="form-floating mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="email" class="form-label">Correo</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label for="password" class="form-label">Contraseña</label>

                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-secondary" for="remember">
                              Mantener sesión iniciada
                            </label>

                          </div>
                        </div>
                        <div class="col-12">
                          <div class="d-grid">
                            <button class="btn btn-dark btn-lg" type="submit">Iniciar Sesión

                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <div class="row">
                      <div class="col-12">
                        <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                          <a href="{{ route('register') }}" style="color:black;">Crear nueva cuenta</a>

                          

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


</body>

</html>