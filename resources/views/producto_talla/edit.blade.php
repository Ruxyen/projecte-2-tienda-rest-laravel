<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estilo de Formulario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/estiloformulario.css">
</head>
<body>

<div class="outer-container">
    <div class="custom-container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Editar Producto Talla</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('producto_talla.update', $productotalla->id_producto_talla) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="id_talla">ID Talla</label>
                            <input type="text" class="form-control" id="id_talla" name="id_talla" value="{{ $productotalla->id_talla }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="id_producto">ID Producto</label>
                            <input type="text" class="form-control" id="id_producto" name="id_producto" value="{{ $productotalla->id_producto }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
