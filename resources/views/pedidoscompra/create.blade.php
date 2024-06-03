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
                    <h2 class="card-title">Crear Pedido de Compra</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('pedidoscompra.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="fecha_pedido">Fecha Pedido:</label>
                            <input type="date" name="fecha_pedido" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="total_pedido">Total Pedido:</label>
                            <input type="number" name="total_pedido" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="id_cliente">ID Cliente (user_id):</label>
                            <select name="user_id" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        
                        <button type="submit" class="btn btn-primary mt-3">Crear Pedido de Compra</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
