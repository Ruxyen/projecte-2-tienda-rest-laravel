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
            color: black;
            background-color: #ffffff;
            border: 1px solid #007bff;
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

        body {
            background-color: #28242c;
            color: white;
        }

        .form-control {
            background-color: #28242c;
            color: white;
        }
    </style>
</head>

<body>

    <div class="mt-3">
        <button onclick="window.history.back()" class="btn btn-primary" style="width: 8%;height: 8%;font-size: 150%;position: fixed;margin-left: 2%;margin-top: 1%;">Volver</button>
    </div>
    <div id="container" class="container">
        <div class="row mt-2" style="padding-top: 3%;">
            <!-- Formulario alta/actualización -->
            <div class="col-6">
                <div class="card rounded-0">
                    <div class="card-header bg-dark text-white rounded-0">
                        <label id="operationLabel" class="fw-bold text-uppercase" style="font-size: 140%;">Pedidos de Compra</label>
                    </div>
                    <div class="card-body div-form" style="background: white; color: black;">
                        <form>
                            <div class="row mb-3">
                                <label for="fechaPedidoInput" class="col-md-4 col-form-label text-md-end">Fecha Pedido</label>
                                <div class="col-md-6">
                                    <input type="date" name="fechaPedido" id="fechaPedidoInput" class="form-control" autocomplete="on" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="totalPedidoInput" class="col-md-4 col-form-label text-md-end">Total Pedido</label>
                                <div class="col-md-6">
                                    <input type="text" name="totalPedido" id="totalPedidoInput" class="form-control" autocomplete="on" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="userIdInput" class="col-md-4 col-form-label text-md-end">ID Usuario</label>
                                <div class="col-md-6">
                                    <select name="user_id" id="userIdInput" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="button" id="saveButton" class="btn btn-primary me-2">Guardar</button>
                                    <button type="button" id="cancelButton" class="btn btn-secondary me-2">Cancelar</button>
                                    <button type="button" id="deleteButton" class="btn btn-danger">Eliminar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Zona Mensajes -->
                <div id="messagesDiv" class="border p-2 mt-4 rounded-0"></div>
            </div>
            <div class="col-6">
                <div id="pedidosList" class="pedido-list">
                    <!-- Lista de Pedidos -->
                </div>
                <!-- Barra Navegación -->
                <div class="mt-4 p-2 border">
                    <div class="pagination justify-content-center" id="pagination-numbers">
                        <!-- Numeros de Paginación -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<script type="text/javascript">
    const url = 'http://localhost:8000/api/pedidos-compra';
    let pedidos = [];
    let selectedPedido;

    let itemsPerPage = 10;
    let currentPage = 1;

    async function showMessages(type, errors) {
        const messagesDiv = document.getElementById('messagesDiv');
        messagesDiv.classList.remove("d-none");

        messagesDiv.innerHTML = '';

        if (type == "error") {
            messagesDiv.classList.remove("text-dark");
            messagesDiv.classList.add("text-danger");
        } else {
            messagesDiv.classList.remove("text-danger");
            messagesDiv.classList.add("text-dark");
        }

        if (Array.isArray(errors)) {
            const ul = document.createElement("ul");
            for (const error of errors) {
                const li = document.createElement('li');
                li.textContent = error;
                ul.appendChild(li);
            }
            messagesDiv.appendChild(ul);
        } else messagesDiv.innerHTML = errors;
    }

    const saveButton = document.getElementById('saveButton');
    saveButton.addEventListener('click', saveRegister);

    const cancelButton = document.getElementById('cancelButton');
    cancelButton.addEventListener('click', reset);

    const deleteButton = document.getElementById('deleteButton');
    deleteButton.addEventListener('click', deleteRegister);

    async function saveRegister(event) {
        event.preventDefault();
        console.log('Guardando pedido...');

        const fechaPedidoInput = document.getElementById("fechaPedidoInput");
        const fechaPedidoValue = new Date(fechaPedidoInput.value);

        // Obtener la fecha en formato ISO
        const isoFormattedDate = fechaPedidoValue.toISOString();
        console.log('ISO Formatted date:', isoFormattedDate);

        // Formatear la fecha para el servidor
        const formattedFechaPedido = formatDateForServer(isoFormattedDate);

        if (!formattedFechaPedido) {
            // Muestra un mensaje de error si la fecha no es válida
            showMessages('error', 'Fecha de pedido no válida. Utiliza el formato d/m/Y.');
            return;
        }

        console.log('Formatted Fecha Pedido (for server):', formattedFechaPedido);

        if (selectedPedido === undefined) {
            console.log('Nuevo pedido');
            const newPedido = {
                fecha_pedido: formattedFechaPedido,
                total_pedido: document.getElementById("totalPedidoInput").value,
                user_id: document.getElementById("userIdInput").value,
            };
            console.log('New Pedido:', newPedido);

            await newRegister(newPedido);
            await createListAndPagination(); // Actualizar la lista y paginación después de agregar un nuevo pedido
            reset();
        } else {
            console.log('Pedido existente');
            const updatedPedido = {
                id: selectedPedido.id,
                fecha_pedido: formattedFechaPedido,
                total_pedido: document.getElementById("totalPedidoInput").value,
                user_id: document.getElementById("userIdInput").value,
            };

            await updateRegister(updatedPedido);
        }
    }



    async function newRegister(newData) {
        try {
            // Formatear la fecha en el formato correcto ("d/m/Y")
            newData.fecha_pedido = formatDateForServer(newData.fecha_pedido);
            console.log('Formatted Fecha Pedido (newRegister):', newData.fecha_pedido);

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(newData),
            });

            if (response.ok) {
                const data = await response.json();
                console.log('Server Response:', data);
                pedidos.push(data.data);
                showMessages('message', 'Pedido creado correctamente');
                createListAndPagination(); // Actualizar la lista y paginación
                reset();
            } else {
                const data = await response.json();

                if (response.status === 422) {
                    console.error('Error de validación en el servidor:', response.status, data);
                    showMessages('error', 'Error de validación. Consulta la consola para más detalles.');
                } else {
                    console.error('Error en la respuesta del servidor:', response.status, data);
                    showMessages('error', 'Error al crear el pedido. Consulta la consola para más detalles.');
                }
            }
        } catch (error) {
            console.error('Error durante la solicitud:', error);
            showMessages('error', 'Error accediendo a los datos remotos. Consulta la consola para más detalles.');
        }
    }

    async function updateRegister(updatedPedido) {
        try {
            // Guardar una copia del formato original de fecha
            const originalFechaPedido = updatedPedido.fecha_pedido;

            // Formatear la fecha antes de enviarla al servidor
            updatedPedido.fecha_pedido = formatDateForServer(updatedPedido.fecha_pedido);

            const response = await fetch(url + '/' + selectedPedido.id, {
                method: 'PUT',
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(updatedPedido),
            });

            const data = await response.json();

            if (response.ok) {
                // Actualizar la lista de pedidos
                const index = pedidos.findIndex(pedido => pedido.id === selectedPedido.id);
                if (index !== -1) {
                    pedidos[index] = data.data;
                    loadIntoList();
                }

                // Actualizar los campos directamente
                const fechaPedidoInput = document.getElementById('fechaPedidoInput');
                fechaPedidoInput.value = formatDateForInput(data.data.fecha_pedido);

                const totalPedidoInput = document.getElementById('totalPedidoInput');
                totalPedidoInput.value = data.data.total_pedido;

                const userIdInput = document.getElementById('userIdInput');
                userIdInput.value = data.data.user_id;

                showMessages('message', 'Pedido actualizado correctamente');
            } else {
                console.error('Error en la respuesta del servidor:', response.status, data);
                showMessages('error', 'Error al actualizar el pedido. Consulta la consola para más detalles.');
            }
        } catch (error) {
            console.error('Error durante la solicitud:', error);
            showMessages('error', 'Error accediendo a los datos remotos. Consulta la consola para más detalles.');
        }
    }


    async function deleteRegister(event) {
        event.preventDefault();

        if (selectedPedido === undefined || selectedPedido.id === undefined) {
            showMessages('error', 'No hay pedido seleccionado para eliminar.');
            return;
        }

        try {
            const response = await fetch(url + '/' + selectedPedido.id, {
                method: 'DELETE',
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });

            if (response.ok) {
                // Eliminar el pedido de la lista y actualizar la paginación
                const index = pedidos.findIndex(pedido => pedido.id === selectedPedido.id);
                if (index !== -1) {
                    pedidos.splice(index, 1);
                    createListAndPagination(); // Actualizar la lista y paginación
                    reset();
                }

                showMessages('message', 'Pedido eliminado correctamente');
            } else {
                const data = await response.json();
                console.error('Error en la respuesta del servidor:', response.status, data);
                showMessages('error', 'Error al eliminar el pedido. Consulta la consola para más detalles.');
            }
        } catch (error) {
            console.error('Error durante la solicitud:', error);
            showMessages('error', 'Error accediendo a los datos remotos. Consulta la consola para más detalles.');
        }
    }

    async function getList(url, page, perPage) {
        // Añadir parámetros a la URL
        const apiUrl = new URL(url);
        apiUrl.searchParams.append('page', page);
        apiUrl.searchParams.append('per_page', perPage);

        try {
            const response = await fetch(apiUrl, {
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });

            if (response.ok) {
                const json = await response.json();
                console.log('Server Response:', json);

                pedidos = json.data.data;
            } else {
                showMessages('error', 'Error en la respuesta del servidor.');
            }
        } catch (error) {
            console.error(error);
            showMessages('error', 'Error desconocido al acceder a los datos remotos.');
        }
    }


    function addEmptyElement(index) {
        const pedidoElementList = document.getElementById('pedidosList');
        const pedidoElement = document.createElement('div');
        pedidoElement.classList.add('pedido-list-item'); // Asigna la clase correspondiente
        pedidoElement.addEventListener('click', function() {
            editPedido(index);
        });
        pedidoElementList.appendChild(pedidoElement);
    }


    async function loadIntoList() {
        const container = document.querySelector("#pedidosList");
        const pedidoElements = container.querySelectorAll(".pedido-list-item");

        const newPedidoElements = [];

        for (let i = 0; i < pedidos.length; i++) {
            let pedidoElement;

            if (i < pedidoElements.length) {
                pedidoElement = pedidoElements[i];
            } else {
                pedidoElement = document.createElement('div');
                pedidoElement.classList.add('pedido-list-item'); // Asigna la clase correspondiente
                container.appendChild(pedidoElement);
            }

            pedidoElement.setAttribute("selected", false);
            pedidoElement.removeAttribute("deleted");

            // Mostrar solo "Pedido ID: XX" en lugar de la información completa
            pedidoElement.textContent = `Pedido ID: ${pedidos[i].id}`;
            pedidoElement.setAttribute('id', 'pedido-' + pedidos[i].id);
            pedidoElement.style.cursor = 'pointer'; // Se corrige el estilo

            pedidoElement.addEventListener('click', function() {
                editPedido(i);
            });

            newPedidoElements.push(pedidoElement);
        }

        for (let j = pedidos.length; j < pedidoElements.length; j++) {
            container.removeChild(pedidoElements[j]);
        }

        // Actualizar la lista de elementos existentes
        pedidoElements.forEach((element, index) => {
            if (index < pedidos.length) {
                // Mostrar solo "Pedido ID: XX" en lugar de la información completa
                element.textContent = `Pedido ID: ${pedidos[index].id}`;
                element.setAttribute('id', 'pedido-' + pedidos[index].id);
            }
        });
    }


    async function loadUserOptions() {
        const userIdInput = document.getElementById('userIdInput');

        try {
            const usersResponse = await fetch('http://localhost:8000/api/usuarios', {
                headers: {
                    'Content-type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });

            if (usersResponse.ok) {
                const usersData = await usersResponse.json();

                // Limpiar las opciones actuales
                userIdInput.innerHTML = '';

                // Agregar una opción predeterminada
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Seleccionar un ID';
                defaultOption.disabled = true;
                defaultOption.selected = true; // Establecer como seleccionada
                userIdInput.appendChild(defaultOption);

                // Crear las nuevas opciones
                for (const user of usersData.data.data) {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.id; // Cambiado a user.id para mostrar el ID
                    userIdInput.appendChild(option);
                }

                // Si tienes un usuario seleccionado, establece esa opción como seleccionada
                if (selectedPedido && selectedPedido.user_id) {
                    userIdInput.value = selectedPedido.user_id;
                }
            } else {
                showMessages('error', 'Error al cargar la lista de usuarios.');
            }
        } catch (error) {
            console.error(error);
            showMessages('error', 'Error desconocido al acceder a los datos remotos de usuarios.');
        }
    }


    async function createListAndPagination() {
        await getList(url, currentPage, itemsPerPage);
        await loadUserOptions();
        renderPedidosList();
        createPagination();
    }

    function formatDateForServer(date) {
        // Verifica si la entrada es una cadena o un objeto Date
        if (typeof date === 'string') {
            // Intenta analizar la cadena como fecha ISO
            const isoDate = new Date(date);
            if (!isNaN(isoDate)) {
                date = isoDate;
            } else {
                // Si no es una fecha ISO, intenta analizar la cadena como "d/m/Y"
                date = date.split('/').reverse().join('-');
                date = new Date(date);
            }
        }

        // Verifica si date es un objeto Date válido
        if (!(date instanceof Date) || isNaN(date)) {
            console.log('Invalid date format in formatDateForServer:', date);
            return null;
        }

        // Formatea la fecha para coincidir con el formato esperado por el servidor ("d/m/Y")
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();

        const formattedDate = `${day}/${month}/${year}`;
        console.log('Formatted date in formatDateForServer:', formattedDate);
        return formattedDate;
    }







    function formatDateForInput(dateString) {
        const date = new Date(dateString);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');

        return `${year}-${month}-${day}`;
    }


    function formatDate(input) {
        if (!input) {
            console.log('Invalid date format in formatDate:', input);
            return null;
        }

        const parts = input.split(' ');
        if (parts.length !== 2) {
            console.log('Invalid date format in formatDate:', input);
            return null;
        }

        const datePart = parts[0];
        const timePart = parts[1];

        const dateParts = datePart.split('-');
        if (dateParts.length !== 3) {
            console.log('Invalid date format in formatDate:', input);
            return null;
        }

        const year = dateParts[0];
        const month = dateParts[1];
        const day = dateParts[2];

        // Ajusta el formato de salida para coincidir con el formato esperado por el servidor
        const formattedDate = `${day}/${month}/${year}`;
        console.log('Formatted date in formatDate:', formattedDate);
        return formattedDate;
    }


    async function editPedido(index) {
        if (index >= pedidos.length || !pedidos[index] || !pedidos[index].id) {
            return;
        }

        const selectedElement = document.getElementById('pedido-' + pedidos[index].id);
        const container = document.querySelector("#pedidosList");
        const pedidoElements = container.querySelectorAll(".pedido-list-item");

        for (const pedidoElement of pedidoElements) {
            pedidoElement.removeAttribute("selected");
        }

        selectedElement.setAttribute("selected", true);

        selectedPedido = pedidos[index];

        // Agregar esta línea para cargar las opciones del usuario
        await loadUserOptions();

        const fechaPedidoInput = document.getElementById('fechaPedidoInput');
        fechaPedidoInput.value = formatDateForInput(selectedPedido.fecha_pedido);

        const totalPedidoInput = document.getElementById('totalPedidoInput');
        totalPedidoInput.value = selectedPedido.total_pedido;

        const userIdInput = document.getElementById('userIdInput');
        userIdInput.value = selectedPedido.user_id;

        deleteButton.style.visibility = 'visible';
        cancelButton.style.visibility = 'visible';

        const operationLabel = document.getElementById('operationLabel');
        operationLabel.innerText = "Actualizar Pedido";
    }

    function reset() {
        const messagesDiv = document.getElementById('messagesDiv');
        const fechaPedidoInput = document.getElementById('fechaPedidoInput');
        const totalPedidoInput = document.getElementById('totalPedidoInput');
        const userIdInput = document.getElementById('userIdInput');

        messagesDiv.classList.add("d-none");

        fechaPedidoInput.value = '';
        totalPedidoInput.value = '';
        userIdInput.value = '';

        selectedPedido = undefined;

        deleteButton.style.visibility = 'hidden';
        cancelButton.style.visibility = 'hidden';

        operationLabel.innerText = 'Nuevo Pedido';
    }




    function createPagination() {
        const prevButton = document.createElement('button');
        prevButton.classList.add('navbutton');
        prevButton.innerHTML = '&lt;';

        const nextPageLink = document.createElement('button');
        nextPageLink.classList.add('navbutton');
        nextPageLink.innerHTML = '&gt;';

        prevButton.addEventListener('click', function() {
            goToPage(currentPage - 1);
        });

        nextPageLink.addEventListener('click', function() {
            goToPage(currentPage + 1);
        });

        const paginationContainer = document.getElementById('pagination-numbers');
        paginationContainer.innerHTML = '';

        paginationContainer.appendChild(prevButton);
        paginationContainer.appendChild(nextPageLink);
    }

    async function goToPage(pageNumber) {
        currentPage = pageNumber;
        const start = (pageNumber - 1) * itemsPerPage;

        // Llama a getList con los parámetros de la página actual
        await getList(url, pageNumber, itemsPerPage);

        // Obtén los pedidos de la página actual después de llamar a getList
        const paginatedPedidos = pedidos.slice(start, start + itemsPerPage);

        // Renderiza los pedidos en la lista
        renderPedidosList(paginatedPedidos);

        // Vuelve a crear la paginación después de cambiar de página
        createPagination();
    }

    function renderPedidosList() {
        const container = document.querySelector("#pedidosList");

        // Limpiar el contenido existente
        container.innerHTML = '';

        // Iterar sobre los pedidos en la página actual
        for (const pedido of pedidos) {
            // Crear un elemento div para cada pedido
            const pedidoElement = document.createElement('div');
            pedidoElement.classList.add('pedido-list-item');

            // Mostrar solo "Pedido ID: XX" en lugar de la información completa
            pedidoElement.textContent = `Pedido ID: ${pedido.id}`;

            // Asignar un identificador único al elemento
            pedidoElement.setAttribute('id', `pedido-${pedido.id}`);

            // Asignar un evento de clic para editar el pedido
            pedidoElement.addEventListener('click', () => editPedido(pedidos.indexOf(pedido)));

            // Agregar el elemento al contenedor
            container.appendChild(pedidoElement);
        }
    }







    createListAndPagination();
    reset();
</script>

</body>

</html>