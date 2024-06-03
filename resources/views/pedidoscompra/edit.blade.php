    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Pedido de Compra</title>
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
                        <h2 class="card-title">Editar Pedido de Compra</h2>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('pedidoscompra.update', $pedidoCompra->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ $pedidoCompra->id }}">
                        <div class="form-group">
                            <label for="fecha_pedido">Fecha Pedido:</label>
                            <input type="date" name="fecha_pedido" value="{{ $pedidoCompra->fecha_pedido }}" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="total_pedido">Total Pedido:</label>
                            <input type="number" name="total_pedido" value="{{ $pedidoCompra->total_pedido }}" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="id">ID Pedido:</label>
                            <input type="text" name="id" value="{{ $pedidoCompra->id }}" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="id">ID Usuario:</label>
                            <input type="text" name="user_id" value="{{ $pedidoCompra->user_id }}" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Actualizar Pedido de Compra</button>
                    </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
