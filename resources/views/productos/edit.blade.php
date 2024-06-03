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
                    <h2 class="card-title">Editar Producto</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('productos.update', $producto->id_producto) }}" method="post">
                        @csrf
                        @method('PUT')
                        <!-- Campos del formulario para editar un producto -->
                        <div class="form-group">
                            <label for="nom_producto">Nombre del Producto:</label>
                            <input type="text" name="nom_producto" id="nom_producto" value="{{ $producto->nom_producto }}" required class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" required class="form-control">{{ $producto->descripcion }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" name="precio" id="precio" value="{{ $producto->precio }}" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="categoria">Categoría:</label>
                            <input type="text" name="categoria" id="categoria" value="{{ $producto->categoria }}" required class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
