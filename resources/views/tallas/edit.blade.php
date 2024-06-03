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
    <div class="custom-containeredit">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Edit Talla</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tallas.update.unique', $talla->id_talla) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="nom_talla">Nombre de Talla</label>
                            <input type="text" class="form-control" id="nom_talla" name="nom_talla" value="{{ $talla->nom_talla }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Talla</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
