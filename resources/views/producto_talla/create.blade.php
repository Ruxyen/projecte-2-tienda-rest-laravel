<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estilo de Formulario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/estiloformulario.css"> <!-- Ruta al archivo CSS -->
</head>
<body>

<div class="outer-container">
    <div class="custom-container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Nuevo Producto Talla</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('producto_talla.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="id_talla">ID Talla</label>
                            <input type="text" class="form-control" id="id_talla" name="id_talla" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_producto">ID Producto</label>
                            <input type="text" class="form-control" id="id_producto" name="id_producto" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
