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

    <div class="custom-container larger-form">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Create Talla</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('tallas.store.unique') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nom_talla">Nombre de Talla</label>
                        <input type="text" class="form-control" id="nom_talla" name="nom_talla" required>
                    </div>


                    <button type="submit" class="btn btn-primary">Crear Talla</button>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
