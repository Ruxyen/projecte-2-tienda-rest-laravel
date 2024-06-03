<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Detalle de Pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/estiloformulario.css"> <!-- Ruta al archivo CSS -->
</head>
<body>

<div class="outer-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="custom-container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Editar Detalle de Pedido</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('detallespedidos.update', $detallePedido->id_detalle_pedido) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_pedido">ID Pedido:</label>
                            <input type="text" name="id_pedido" id="id_pedido" value="{{ $detallePedido->id_pedido }}" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cantidad_productos">Cantidad de Productos:</label>
                            <input type="text" name="cantidad_productos" id="cantidad_productos" value="{{ $detallePedido->cantidad_productos }}" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="precio_total">Precio Total:</label>
                            <input type="text" name="precio_total" id="precio_total" value="{{ $detallePedido->precio_total }}" required class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
