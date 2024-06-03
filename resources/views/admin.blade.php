<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Panel Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href=".//admin.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-ezI3Dv3HI9rhh0PxpIHvY6sN6d2ExFRTsGVJiI01gjMTlf2O0z3P5GfG2Y9L2v8A" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/simple-datatables.esm.min.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        .sb-sidenav-footer {
            display: flex;
            flex-direction: column;
            align-items: left;
            margin-top: 567px;

        }
    </style>


</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="/admin">Legit Style - Admin</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Buscar ..." aria-label="Buscar ..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div style="color:white;" class="sb-sidenav-menu-heading">Menú</div>
                        <a class="nav-link" style="color:yellow;" href="/index">
                            <div class="sb-nav-link-icon"><i class="fas fa-shop"></i></div>
                            Volver a Tienda
                        </a>
                        <a class="nav-link" style="color:white;" href="/admin">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Pedidos de Compra
                        </a>
                        <a class="nav-link" style="color:white;" href="#tabla2">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Productos
                        </a>
                        <a class="nav-link" style="color:white;" href="#tabla3">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                            Detalles de Pedidos
                        </a>
                        <a class="nav-link" style="color:white;" href="#tabla4">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Usuarios
                        </a>
                        <a class="nav-link" style="color:white;" href="#tabla5">
                            <div class="sb-nav-link-icon"><i class="fas fa-ruler"></i></div>
                            Tallas
                        </a>
                        <a class="nav-link" style="color:white;" href="#tabla6">
                            <div class="sb-nav-link-icon"><i class="fas fa-tshirt"></i></div>
                            Producto - Talla
                        </a>
                        <a class="nav-link" style="color:white;" href="/api/usuarios-pas-a-pas">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                            Rest Usuario
                        </a>

                        <a class="nav-link" style="color:white;" href="/api/pedidoscompra">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                            Rest Pedido Compra
                        </a>

                        <a class="nav-link" style="color:white;" href="/api/productotalla">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                            Rest Producto Talla
                        </a>






                    </div>
                    @auth
                    <div class="sb-sidenav-footer">
                        <div>Has iniciado sesión como:</div>
                        {{ ucfirst(strtolower(Auth::user()->name)) }}
                    </div>
                    @endauth

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>

                <div class="container-fluid px-4">
                    <h1 class="mt-4">Panel</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Administrador</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Pedidos de Compra
                            <a href="{{ route('pedidoscompra.create') }}" class="text-center" style="background: none; border: none; text-decoration: none; display: inline-block;">
                                <i class="fas fa-plus" style="font-size: 15px; color: green;"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>ID Pedido</th>
                                        <th>Fecha Pedido</th>
                                        <th>Total Pedido</th>
                                        <th>ID Usuario</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedidosCompra as $pedido)
                                    <tr>
                                        <td>{{ $pedido->id }}</td>
                                        <td>{{ $pedido->fecha_pedido }}</td>
                                        <td>{{ $pedido->total_pedido }}</td>
                                        <td>{{ $pedido->user_id }}</td>
                                        <td>
                                            <a href="{{ route('pedidoscompra.edit', $pedido->id) }}" class="btn btn-link">
                                                <i class="fas fa-edit" style="font-size: 24px; color: blue;"></i>
                                            </a>
                                            <form action="{{ route('pedidoscompra.destroy', $pedido->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link" style="background: none; padding: 0;">
                                                    <i class="fas fa-trash-alt" style="font-size: 24px; color: red;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr id="tabla2">
                        </div>
                    </div>
                </div>

                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Productos
                            <a href="{{ route('productos.create') }}" class="text-center" style="background: none; border: none; text-decoration: none; display: inline-block;">
                                <i class="fas fa-plus" style="font-size: 15px; color: green;"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple2">
                                <thead>
                                    <tr>
                                        <th>ID Producto</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                        <th>Categoría</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->id_producto }}</td>
                                        <td>{{ $producto->nom_producto }}</td>
                                        <td>{{ $producto->descripcion }}</td>
                                        <td>{{ $producto->precio }}</td>
                                        <td>{{ $producto->categoria }}</td>


                                        <td>
                                            <a href="{{ route('productos.edit', $producto->id_producto) }}" class="btn btn-link">
                                                <i class="fas fa-edit" style="font-size: 24px; color: blue;"></i>
                                            </a>

                                            <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link" style="background: none; padding: 0;">
                                                    <i class="fas fa-trash-alt" style="font-size: 24px; color: red;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr id="tabla3">
                        </div>
                    </div>
                </div>

                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Detalles de Pedidos
                            <a href="{{ route('detallespedidos.create') }}" class="text-center" style="background: none; border: none; text-decoration: none; display: inline-block;">
                                <i class="fas fa-plus" style="font-size: 15px; color: green;"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple3">
                                <thead>
                                    <tr>
                                        <th>ID Detalle Pedido</th>
                                        <th>ID Pedido</th>
                                        <th>Cantidad Productos</th>
                                        <th>Precio Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesPedidos as $detalle)
                                    <tr>
                                        <td>{{ $detalle->id_detalle_pedido }}</td>
                                        <td>{{ $detalle->id_pedido }}</td>
                                        <td>{{ $detalle->cantidad_productos }}</td>
                                        <td>{{ $detalle->precio_total }}</td>
                                        <td>
                                            <a href="{{ route('detallespedidos.edit', $detalle->id_detalle_pedido) }}" class="btn btn-link">
                                                <i class="fas fa-edit" style="font-size: 24px; color: blue;"></i>
                                            </a>
                                            <form action="{{ route('detallespedidos.destroy', $detalle->id_detalle_pedido) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link" style="background: none; padding: 0;">
                                                    <i class="fas fa-trash-alt" style="font-size: 24px; color: red;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr id="tabla4">
                        </div>
                    </div>
                </div>

                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Usuarios
                            <a href="{{ route('usuarios.create.unique') }}" class="text-center" style="background: none; border: none; text-decoration: none; display: inline-block;">
                                <i class="fas fa-plus" style="font-size: 15px; color: green;"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple4">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $usuario)
                                    <tr>
                                        <td>{{ $usuario->id }}</td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->password }}</td>
                                        <td>
                                            <a href="{{ route('usuarios.edit.unique', $usuario->id) }}" class="btn btn-link">
                                                <i class="fas fa-edit" style="font-size: 24px; color: blue;"></i>
                                            </a>
                                            <form action="{{ route('usuarios.destroy.unique', $usuario->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link" style="background: none; padding: 0;">
                                                    <i class="fas fa-trash-alt" style="font-size: 24px; color: red;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr id="tabla5">
                        </div>
                    </div>
                </div>


                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tallas
                            <a href="{{ route('tallas.create.unique') }}" class="text-center" style="background: none; border: none; text-decoration: none; display: inline-block;">
                                <i class="fas fa-plus" style="font-size: 15px; color: green;"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple5">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tallas as $talla)
                                    <tr>
                                        <td>{{ $talla->id_talla }}</td>
                                        <td>{{ $talla->nom_talla }}</td>
                                        <td>
                                            <a href="{{ route('tallas.edit.unique', $talla->id_talla) }}" class="btn btn-link">
                                                <i class="fas fa-edit" style="font-size: 24px; color: blue;"></i>
                                            </a>
                                            <form action="{{ route('tallas.destroy.unique', $talla->id_talla) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link" style="background: none; padding: 0;">
                                                    <i class="fas fa-trash-alt" style="font-size: 24px; color: red;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <hr id="tabla6">
                        </div>
                    </div>
                </div>


                <div class="container-fluid px-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Producto Tallas
                            <a href="{{ route('producto_talla.create') }}" class="text-center" style="background: none; border: none; text-decoration: none; display: inline-block;">
                                <i class="fas fa-plus" style="font-size: 15px; color: green;"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple6">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Talla</th>
                                        <th>ID Producto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productotallas as $productotalla)
                                    <tr>
                                        <td>{{ $productotalla->id_producto_talla }}</td>
                                        <td>{{ $productotalla->id_talla }}</td>
                                        <td>{{ $productotalla->id_producto }}</td>
                                        <td>
                                            <a href="{{ route('producto_talla.edit', $productotalla->id_producto_talla) }}" class="btn btn-link">
                                                <i class="fas fa-edit" style="font-size: 24px; color: blue;"></i>
                                            </a>
                                            <form action="{{ route('producto_talla.destroy', $productotalla->id_producto_talla) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link" style="background: none; padding: 0;">
                                                    <i class="fas fa-trash-alt" style="font-size: 24px; color: red;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>






            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Legit Style 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src=".//scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src=".//datatables-simple-demo.js"></script>
</body>

</html>