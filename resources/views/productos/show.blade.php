<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Producto</title>

    <link rel="icon" type="image/x-icon" href="../favicon.ico" />

    <link href="/item.css" rel="stylesheet" />
    <link href="/estilos.css" rel="stylesheet" />
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        #name_user {
            text-decoration: none;
            color: black;
            font-size: 20px;
            text-transform: capitalize;

        }
    </style>


</head>

<body>

    <div class="fixed-navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 90px;">
            <div class="logo" style="position: fixed; top: 20px; left: 80px;">
                <!-- Logo de la tienda -->
                <a class=" navbar-brand" href="{{ url('/') }}">
                    <img src="/logo_nav.png" alt="Logo de la Tienda" style="height: 50px;">

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

                <div id="cesta" style="display: flex;margin: -280px;align-items: baseline;">
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
                    <a href="{{ route('login') }}"><img class="centered-image" src="/login-icon.png" alt="login"></a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}"><img class="centered-image" src="/register-icon.png" alt="register"></a>


                    @endif
                    @endauth


                </div>
                @endif
            </div>
        </nav>

    </div>


    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6 text-center mb-4">
                    <img class="card-img-top" src="{{ asset('producto' . $producto->id_producto . '.png') }}" alt="...">
                </div>

                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $producto->nom_producto }}</h1>

                    <h2 class="small mb-1">Categoria: {{ $producto->categoria }}</h2>

                    <div class="fs-5 mb-4">
                        <span class="text-muted text-decoration-line-through">{{ $producto->precio*2 }} €</span>
                        <span style="color:red;">{{ $producto->precio }} €</span>
                    </div>
                    <p class="lead">{{ $producto->descripcion }}</p>

                    <div class="mb-3">
                        <label for="selectTalla" class="form-label">Selecciona la talla:</label>
                        <select class="form-select" id="selectTalla" name="talla">

                            @if(count($tallas) > 0)

                            @foreach($tallas as $talla)
                            <option value="{{ $talla->id_talla }}">{{ $talla->nom_talla }}</option>
                            @endforeach
                            @else

                            <option value="" disabled selected>No hay tallas disponibles</option>
                            @endif
                        </select>
                    </div>


                    <div class="d-flex">
                        <input class="form-control text-center me-3" id="inputQuantity" type="number" value="1" style="width:25%;" min="1" />
                        <button class="btn btn-outline-dark flex-shrink-0 addToCart" data-product-id="{{ $producto->id_producto }}">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </section>



    <footer>
        <div>
            <p >Copyright &copy; Legit Style 2023</p>
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
    <script>
        $(document).ready(function() {
            $('.addToCart').on('click', function() {
                var productId = $(this).data('product-id');
                var quantity = $('#inputQuantity').val();
                var selectedTalla = $('#selectTalla').val();

                $.ajax({
                    type: 'POST',
                    url: '/agregar-al-carrito/' + productId,
                    data: {
                        quantity: quantity,
                        talla: selectedTalla,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Producto agregado al carrito');
                        // Redirigir a la página del carrito o realizar acciones adicionales
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseText;
                        alert('Error al agregar el producto al carrito: ' + errorMessage);
                    }
                });
            });
        });
    </script>
    <script>
        document.getElementById('cartForm').addEventListener('submit', function() {
            window.location = this.action;
        });
    </script>
</body>

</html>