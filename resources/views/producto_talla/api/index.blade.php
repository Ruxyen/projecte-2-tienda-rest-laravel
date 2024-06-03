<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tu Título</title>

    <!-- Agrega la línea de Bootstrap CDN aquí -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Agrega la línea de jQuery CDN aquí -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Agrega la librería Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <!-- Tus estilos personalizados van aquí -->
    <style>
        .pedido-list {
            font-size: 1rem;
            margin: 0;
            padding: 0;
            display: grid;
            font-weight: 500;
        }

        .pedido-list-item {
            padding: 0.5rem 1.5rem 1rem;
            border-radius: 1.5rem;
            background: lightgray;
            min-height: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            
        }

        .pedido-list-item:hover {
            background-color: #cde5ff;
        }

        .pedido-list-item[selected="true"] {
            background-color: DarkGray;
        }

        .pedido-list-item[deleted="true"] {
            background-color: white;
        }

        .pedido-list-item+.pedido-list-item {
            margin-top: 0.5rem;
        }

        .hidden {
            display: none !important;
        }

        .button-container {
            display: flex;
            display: grid;
            grid-template-columns: repeat(3, auto);
        }

        .custom-padding {
            padding: 0.5rem 1.5rem 1rem;
        }

        .custom-border-radius {
            border-radius: 1.5rem;
        }

        .opcion-no-asignada {
            color: red;
            font-style: italic;
        }

        body {
            background-color: #28242c;
            color: white;
        }

        h1 {
            color: white;
        }

        .card {
            background-color: #28242c;
            color: white;
        }

        .card-header {
            background-color: #007bff;
            /* Color azul de Bootstrap */
            color: white;
        }

        .form-control {
            background-color: #28242c;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            /* Color azul de Bootstrap */
        }

     

     

        .pedido-list-item {
            color: black;
            background-color: #ffffff;
            border: 1px solid #007bff;
        }

        .pagination .page-item .page-link {
            background-color: #007bff;
            /* Color azul de Bootstrap */
            color: white;
        }
    </style>
</head>

<body>
    <div class="mt-3">
        <button onclick="window.history.back()" class="btn btn-primary" style="width: 8%;height: 8%;font-size: 150%;position: fixed;margin-left: 2%;margin-top: 1%;">Volver</button>
    </div>
    <div id="container" class="container">

        <div class="row mt-2" style="padding-top: 2%;">

            <!-- Formulario alta/actualización -->
            <div class="col-6">
                <div class="card rounded-0">
                    <div class="card-header bg-dark text-white rounded-0">
                        <label id="operationLabel" class="fw-bold text-uppercase" style="font-size: 140%;">Productos Talla</label>
                    </div>
                    <div class="card-body div-form" style="background: white; color: black;">
                        <form id="productoTallaForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="productoInput" class="col-md-4 col-form-label text-md-end">Producto</label>
                                <div class="col-md-6">
                                    <select name="id_producto" id="productoInput" class="form-control">
                                        <!-- Opciones de productos cargadas dinámicamente desde tu API -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="tallaInput" class="col-md-4 col-form-label text-md-end">Talla</label>
                                <div class="col-md-6">
                                    <select name="id_talla" id="tallaInput" class="form-control">
                                        <!-- Opciones de tallas cargadas dinámicamente desde tu API -->
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div id="buttonContainer" class="col-md-8 offset-md-4">
                                    <button type="button" id="saveButton" class="btn btn-primary me-2">Guardar</button>
                                    <button type="button" id="cancelButton" class="btn btn-secondary me-2">Cancelar</button>
                                    <button type="button" id="deleteButton" class="btn btn-danger">Eliminar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- Zona Mensajes -->
            </div>

            <div class="col-6">
                <div id="productosTallasList" class="pedido-list">
                    <!-- Lista de Productos Tallas se llenará dinámicamente con JavaScript -->
                </div>

                <!-- Contenedor de paginación -->
                <div id="paginationContainer" class="mt-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <!-- Aquí se agregarán los botones de paginación -->
                        </ul>
                    </nav>
                </div>


            </div>
        </div>
    </div>


    <script type="text/javascript">
        // Cargar productos y tallas al iniciar
        var totalProductosTallas = 0;

        loadOptions('productos-api', 'productoInput');
        loadOptions('tallas', 'tallaInput');
        loadProductosTallas();

        // Al cargar la página, mostrar el botón de guardar
        toggleButtonVisibility(true);
        toggleCancelButtonVisibility(false);

        // Nuevo código para mejorar la paginación
        var currentPage = 1;
        var itemsPerPage = 5;

        // Actualizar la lista de productos-tallas y paginación
        function updateListAndPagination() {
            loadProductosTallas();
            createPagination();
        }


        // Crear la paginación
        function createPagination() {
            var totalPages = Math.ceil(totalProductosTallas / itemsPerPage);

            // Eliminar los botones de paginación existentes
            $('#paginationContainer ul').empty();

            // Agregar flecha izquierda para retroceder
            var prevButton = $('<li class="page-item"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">&lt;</a></li>');
            prevButton.click(function() {
                goToPage(currentPage - 1);
            });
            $('#paginationContainer ul').append(prevButton);

            // Crear botones de paginación
            for (var i = 1; i <= totalPages; i++) {
                var button = $('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
                button.click(function() {
                    goToPage(parseInt($(this).text()));
                });
                $('#paginationContainer ul').append(button);
            }

            // Agregar flecha derecha para avanzar
            var nextButton = $('<li class="page-item"><a class="page-link" href="#">&gt;</a></li>');
            nextButton.click(function() {
                goToPage(currentPage + 1);
            });
            $('#paginationContainer ul').append(nextButton);

            // Actualizar la visibilidad de los botones según la página actual
            updatePaginationButtons();
        }


        // Ir a una página específica
        function goToPage(pageNumber) {
            currentPage = pageNumber;
            updateListAndPagination();
        }


        // Actualizar la visibilidad de los botones de paginación
        function updatePaginationButtons() {
            $('.paginationButton').removeClass('active');
            $('.paginationButton').eq(currentPage).addClass('active');
        }



        // Función para llenar la lista de productos-tallas
        function fillProductosTallasList(data) {
            var productosTallasList = $('#productosTallasList');
            productosTallasList.empty();

            // Modificar el rango de elementos que se mostrarán según la página actual
            var startIndex = (currentPage - 1) * itemsPerPage;
            var endIndex = startIndex + itemsPerPage;
            var slicedData = data.slice(startIndex, endIndex);

            $.each(slicedData, function(index, item) {
                var idProductoTalla = item.id_producto_talla || 'No disponible';
                var idProducto = item.producto.id_producto || 'No disponible';
                var idTalla = item.talla.id_talla || 'No disponible';
                var nomProducto = item.producto.nom_producto || 'No disponible';
                var nomTalla = item.talla.nom_talla || 'No disponible';

                productosTallasList.append(
                    '<div class="pedido-list-item" data-id="' + idProductoTalla + '">' +
                    '<span class="fw-bold">ID Producto-Talla:</span> ' + idProductoTalla + '<br>' +
                    '<span class="fw-bold">ID Producto:</span> ' + idProducto + '<br>' +
                    '<span class="fw-bold">ID Talla:</span> ' + idTalla + '<br>' +
                    '<span class="fw-bold">Producto:</span> ' + nomProducto + '<br>' +
                    '<span class="fw-bold">Talla:</span> ' + nomTalla +
                    '</div>'
                );
            });

            // Actualizar la visibilidad de los botones de paginación
            updatePaginationButtons();
        }



        // Función para cargar productos
        function loadProductos() {
            axios.get('/api/productos-api')
                .then(function(response) {
                    fillProductosTallasList(response.data);
                    fillSelect('productoInput', response.data);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        // Función para cargar tallas
        function loadTallas(selectedTallaId) {
            axios.get('/api/tallas')
                .then(function(response) {
                    fillSelect('tallaInput', response.data);
                    $('#tallaInput').val(selectedTallaId || 'seleccionar');
                })
                .catch(function(error) {
                    console.log(error);
                });
        }


        // Función para cargar opciones en un select
        function loadOptions(endpoint, selectId) {
            axios.get('/api/' + endpoint)
                .then(function(response) {
                    response.data.unshift({
                        id: 'seleccionar',
                        nom_producto: 'Seleccionar',
                        nom_talla: 'Seleccionar'
                    });
                    fillSelect(selectId, response.data);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        // Función para llenar un select con opciones
        function fillSelect(selectId, data) {
            var select = $('#' + selectId);
            select.empty();

            $.each(data, function(index, item) {
                var optionText = item.nom_producto || item.nom_talla || 'No disponible';
                select.append($('<option>', {
                    value: item.id_producto || item.id_talla || 'no-id',
                    text: optionText
                }));
            });
        }


        function loadProductosTallas() {
            axios.get('/api/producto-talla')
                .then(function(response) {
                    // Llena la lista de productos-tallas
                    fillProductosTallasList(response.data);

                    // Calcula el total de productos-tallas
                    totalProductosTallas = response.data.length;

                    // Crea la paginación
                    createPagination();
                })
                .catch(function(error) {
                    console.error('Error al cargar productos-tallas:', error);
                });
        }

        function saveProductoTalla() {
            var formData = $('#productoTallaForm').serialize();
            var selectedId = $('#productosTallasList .pedido-list-item.selected').data('id');

            console.log('FormData:', formData);
            console.log('Selected ID:', selectedId);

            if (selectedId) {
                // Es una actualización
                console.log('Updating:', selectedId);
                axios.put('/api/producto-talla/' + selectedId, formData)
                    .then(function(response) {
                        console.log('Update Response:', response);

                        // Agregamos registros adicionales
                        console.log('Update Successful. Reloading ProductosTallas...');
                        loadProductosTallas();
                        console.log('ProductosTallas reloaded.');

                        console.log('Clearing form...');
                        clearForm();
                        console.log('Form cleared.');
                    })
                    .catch(function(error) {
                        console.error('Update Error:', error);
                    });
            } else {
                // Es una creación
                console.log('Creating');
                axios.post('/api/producto-talla', formData)
                    .then(function(response) {
                        console.log('Create Response:', response);

                        // Agregamos registros adicionales
                        console.log('Create Successful. Reloading ProductosTallas...');
                        loadProductosTallas();
                        console.log('ProductosTallas reloaded.');

                        console.log('Clearing form...');
                        clearForm();
                        console.log('Form cleared.');
                    })
                    .catch(function(error) {
                        console.error('Create Error:', error);
                    });
            }
        }


        // Función para editar producto-talla
        // Función para editar producto-talla
        function editProductoTalla(id) {
            console.log('Fetching producto-talla with ID:', id);
            toggleButtonVisibility(false);

            axios.get('/api/producto-talla/' + id)
                .then(function(response) {
                    var productoTalla = response.data;
                    console.log('Editing:', id);

                    if (productoTalla && productoTalla.talla) {
                        console.log('Talla before update:', productoTalla.talla.nom_talla);

                        // Actualizar el formulario con los nuevos valores
                        $('#productoInput').val(productoTalla.producto.id_producto).change();

                        // Cargar las tallas y luego seleccionar la talla correspondiente
                        return loadTallas(productoTalla.talla.id_talla);
                    } else {
                        console.error('Invalid response or missing talla information.');
                        handleEditError('Invalid response or missing talla information.');
                    }
                })
                .then(function() {
                    // Realizar la edición del producto-talla solo después de cargar las tallas
                    updateButtonVisibility();
                })
                .catch(function(error) {
                    console.error('Error fetching producto-talla:', error);
                    handleEditError('Error fetching producto-talla.');
                });
        }



        function handleEditError(errorMessage) {
            // En caso de error, mostrar un mensaje en la consola y limpiar el formulario.
            console.error(errorMessage);
            clearForm();
            // También ocultar los botones de cancelar y eliminar
            toggleCancelButtonVisibility(false);
        }

        // Función para eliminar producto-talla
        function deleteProductoTalla(id) {
            if (confirm('¿Estás seguro?')) {
                axios.delete('/api/producto-talla/' + id)
                    .then(function(response) {
                        loadProductosTallas();
                        clearForm();
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        }

        function clearForm() {
            // Resetear el formulario
            $('#productoTallaForm')[0].reset();

            // Limpiar y recargar los desplegables
            $('#productoInput, #tallaInput').empty();
            loadOptions('productos-api', 'productoInput');
            loadOptions('tallas', 'tallaInput');

            // Restablecer valores por defecto en los desplegables
            $('#productoInput, #tallaInput').val('seleccionar');

            // Mostrar solo el botón de guardar
            toggleButtonVisibility(true);
            toggleCancelButtonVisibility(false);

            // Recargar solo la lista de productos-tallas
            loadProductosTallas();
        }

        // Al cargar la página, ocultar los botones excepto el de guardar
        toggleButtonVisibility(true);
        toggleCancelButtonVisibility(false);


        // Asignar eventos a los botones
        $('#saveButton').click(function() {
            var selectedId = $('#productosTallasList .pedido-list-item.selected').data('id');

            if (selectedId) {
                editProductoTalla(selectedId);
            } else {
                saveProductoTalla();
            }
        });


        $('#cancelButton').click(function() {
            clearForm();
            toggleButtonVisibility(true);
            toggleCancelButtonVisibility(false);
        });


        $('#deleteButton').click(function() {
            var selectedId = $('#productosTallasList .pedido-list-item.selected').data('id');

            if (selectedId) {
                deleteProductoTalla(selectedId);
            }
        });

        $('#productosTallasList').on('click', '.pedido-list-item', function() {
            var itemId = $(this).data('id');
            $('#productosTallasList .pedido-list-item').removeClass('selected');
            $(this).addClass('selected');
            editProductoTalla(itemId);
            updatePaginationButtons();
        });

        function updateButtonVisibility() {
            var hasSelectedItem = $('#productosTallasList .pedido-list-item.selected').length > 0;
            toggleButtonVisibility(hasSelectedItem);
            toggleCancelButtonVisibility(hasSelectedItem);
        }

        function toggleCancelButtonVisibility(hasSelectedItem) {
            console.log('toggleCancelButtonVisibility', hasSelectedItem);
            var displayValue = hasSelectedItem ? 'inline-block' : 'none';
            $('#cancelButton, #deleteButton').css('display', displayValue);
        }

        function toggleButtonVisibility(hasSelectedItem) {
            console.log('toggleButtonVisibility', hasSelectedItem);
            var displayValue = hasSelectedItem ? 'inline-block' : 'none';
            $('#buttonContainer').css('display', displayValue);
        }
    </script>




</body>

</html>