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
        .user-list {
            font-size: 1rem;
            margin: 0;
            padding: 0;
            display: grid;
            font-weight: 500;
        }

        .user-list-item {
            padding: 0.5rem 1.5rem 1rem;
            border-radius: 1.5rem;
            background: lightgray;
            min-height: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .user-list-item:hover {
            background-color: #cde5ff;
        }

        .user-list-item[selected="true"] {
            background-color: DarkGray;
        }

        .user-list-item[deleted="true"] {
            background-color: white;
        }

        .user-list-item+.user-list-item {
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





        .user-list-item {
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
                        <label id="operationLabel" class="fw-bold text-uppercase" style="font-size: 140%">Operación</label>
                    </div>
                    <div class="card-body div-form" style="background: white; color: black;">
                        <form>
                            <div class="row mb-3">
                                <label for="nameInput" class="col-md-4 col-form-label text-md-end">Nombre Usuario</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" id="nameInput" class="form-control" autocomplete="on" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="currentPasswordInput" class="col-md-4 col-form-label text-md-end">Contraseña Actual</label>
                                <div class="col-md-6">
                                    <input type="password" name="currentPassword" id="currentPasswordInput" class="form-control" autocomplete="on" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="newPasswordInput" class="col-md-4 col-form-label text-md-end">Nueva Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" name="newPassword" id="newPasswordInput" class="form-control" autocomplete="on" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="confirmPasswordInput" class="col-md-4 col-form-label text-md-end">Confirmar Nueva Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" name="confirmPassword" id="confirmPasswordInput" class="form-control" autocomplete="on" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="emailInput" class="col-md-4 col-form-label text-md-end">Correo Electrónico</label>
                                <div class="col-md-6">
                                    <input type="email" name="email" id="emailInput" class="form-control" autocomplete="on" />
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
                <div id="usuariosList" class="user-list">
                    <!-- Lista de Usuarios -->
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
    <script type="text/javascript">
        // Enregistrem els events associats a cada botó del formulari
        const saveButton = document.getElementById('saveButton');
        saveButton.addEventListener('click', saveRegister);
        const cancelButton = document.getElementById('cancelButton');
        cancelButton.addEventListener('click', reset);
        const deleteButton = document.getElementById('deleteButton');
        deleteButton.addEventListener('click', deleteRegister);


        async function saveRegister(event) {

            event.preventDefault();
            console.log('desarem....');

        }


        function clearForm() {
            const nameInput = document.getElementById('nameInput');
            const emailInput = document.getElementById('emailInput');
            const newPasswordInput = document.getElementById('newPasswordInput');

            // Limpiar solo los campos deseados
            nameInput.value = '';
            emailInput.value = '';
            newPasswordInput.value = '';
        }


        function reset() {
            const messagesDiv = document.getElementById('messagesDiv');
            const nameInput = document.getElementById('nameInput');
            const operationLabel = document.getElementById('operationLabel');
            const currentPasswordInput = document.getElementById('currentPasswordInput');
            const newPasswordInput = document.getElementById('newPasswordInput');
            const confirmPasswordInput = document.getElementById('confirmPasswordInput');
            const emailInput = document.getElementById('emailInput');

            operationLabel.style.fontSize = '140%'; // Añade el estilo de tamaño de fuente
            operationLabel.innerText = 'Nuevo Usuario';
            messagesDiv.classList.add("d-none");

            // Desmarcamos el usuario seleccionado
            if (selectedUsuario !== undefined && selectedUsuario.id !== undefined) {
                const currentElement = document.getElementById("usuario-" + selectedUsuario.id);
                if (currentElement) {
                    currentElement.removeAttribute("selected");
                }
            }

            // Limpiamos la selección
            selectedUsuario = undefined;

            // Deshabilitamos los botones de eliminar y cancelar
            deleteButton.style.visibility = 'hidden';
            cancelButton.style.visibility = 'hidden';

            // Limpiamos y mostramos los campos deseados
            nameInput.value = '';
            currentPasswordInput.value = '';
            newPasswordInput.value = '';
            confirmPasswordInput.value = '';
            emailInput.value = '';

            // Ocultamos campos no deseados
            currentPasswordInput.style.display = 'none';
            confirmPasswordInput.style.display = 'none';

            // Mostramos campos deseados
            nameInput.style.display = 'block';
            newPasswordInput.style.display = 'block';
            emailInput.style.display = 'block';

            // Ocultamos nombres de campos no deseados
            document.querySelector('label[for="currentPasswordInput"]').style.display = 'none';
            document.querySelector('label[for="confirmPasswordInput"]').style.display = 'none';
        }


        async function deleteRegister(event) {
            event.preventDefault();

            if (selectedUsuario === undefined || selectedUsuario.id === undefined) {
                showMessages('error', 'No hay usuario seleccionado para eliminar.');
                return;
            }

            try {
                const currentPageBeforeDeletion = currentPage; // Almacenar la página actual antes de la eliminación

                const response = await fetch(url + '/' + selectedUsuario.id, {
                    method: 'DELETE',
                    headers: {
                        'Content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                });

                if (response.ok) {
                    // Elimina el elemento del array y de la interfaz
                    const index = usuarios.findIndex(user => user.id === selectedUsuario.id);
                    if (index !== -1) {
                        usuarios.splice(index, 1);

                        // Calcula la página en la que se encontraba el usuario antes de la eliminación
                        const userPageBeforeDeletion = Math.ceil(index / per_page);

                        // Calcula la página en la que se encuentra el usuario después de la eliminación
                        const userPageAfterDeletion = Math.ceil(usuarios.length / per_page);

                        if (userPageBeforeDeletion === currentPageBeforeDeletion) {
                            // Si el usuario estaba en la página actual antes de la eliminación, actualiza la lista y la paginación
                            loadIntoList();
                            createPaginationBar();
                        } else if (userPageAfterDeletion === currentPageBeforeDeletion) {
                            // Si el usuario está en la página actual después de la eliminación, mantiene la página actual
                            // (esto evita cambiar a la página siguiente)
                            setCurrentPage(currentPageBeforeDeletion);
                        } else {
                            // Si el usuario estaba en una página diferente antes de la eliminación, mantiene la página actual
                            setCurrentPage(currentPageBeforeDeletion);
                        }
                    }

                    showMessages('message', 'Usuario eliminado correctamente');

                    // Actualizar la página actual si es necesario
                    if (usuarios.length % per_page === 0 && currentPage > 1) {
                        setCurrentPage(currentPage - 1);
                    } else {
                        loadIntoList();
                        createPaginationBar();
                    }

                    // Restablecer el formulario después de la eliminación
                    reset(event);
                } else {
                    const data = await response.json();
                    console.error('Error en la respuesta del servidor:', response.status, data);
                    showMessages('error', 'Error al eliminar el usuario. Consulta la consola para más detalles.');
                }
            } catch (error) {
                console.error('Error durante la solicitud:', error);
                showMessages('error', 'Error accediendo a las datos remotos. Consulta la consola para más detalles.');
            }
        }




        async function getList(url) {
            try {
                const response = await fetch(url, {
                    headers: {
                        'Content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                });

                if (response.ok) {
                    const json = await response.json();
                    usuarios = json.data.data;
                    last_page = json.data.last_page;
                    per_page = json.data.per_page;
                } else {
                    showMessages('error', 'Error en la respuesta del servidor.');
                }

            } catch (error) {
                console.error(error);
                showMessages('error', 'Error desconocido al acceder a las datos remotos.');
            }
        }

        async function createEmptyList() {
            // Buido el contingut
            const dataTable = document.getElementById('usuariosList');
            dataTable.innerHTML = "";

            for (var i = 0; i < usuarios.length; i++) {
                addEmptyElement(i);
            }
        }



        function addEmptyElement(index) {
            const usuarioElementList = document.getElementById('usuariosList');

            const usuarioElement = document.createElement('div');
            usuarioElement.classList.add('user-list-item'); // Agrega la clase user-list-item
            usuarioElement.addEventListener('click', function() {
                editUsuario(index);
            });

            usuarioElementList.appendChild(usuarioElement);
        }



        /*function editUsuario(index) {

            // console.log(index);
            // console.log(usuarios[index]);           

        }*/





        async function loadIntoList() {
            console.log('Loading into list...');

            // Obtenemos todos los elementos <usuario> de la lista con id = usuariosList
            const container = document.querySelector("#usuariosList");
            const usuarioElements = container.querySelectorAll(".user-list-item");

            // Iteramos sobre los usuarios y los elementos existentes
            for (let i = 0; i < usuarios.length; i++) {
                let usuarioElement;

                if (i < usuarioElements.length) {
                    // Si hay un elemento existente, úsalo
                    usuarioElement = usuarioElements[i];
                } else {
                    // Si no hay un elemento existente, crea uno nuevo
                    usuarioElement = document.createElement('div');
                    usuarioElement.classList.add('user-list-item');
                    container.appendChild(usuarioElement);
                }

                usuarioElement.setAttribute("selected", false);
                usuarioElement.removeAttribute("deleted");

                // Configura el contenido del usuario
                usuarioElement.textContent = usuarios[i].name;
                usuarioElement.setAttribute('id', 'usuario-' + usuarios[i].id);
                usuarioElement.style = 'cursor: pointer';

                // Registramos un evento cuando hacemos clic en un usuario
                usuarioElement.addEventListener('click', function() {
                    editUsuario(i);
                });
            }

            // Eliminamos los elementos sobrantes si hay más elementos existentes que usuarios
            for (let j = usuarios.length; j < usuarioElements.length; j++) {
                container.removeChild(usuarioElements[j]);
            }
        }

        async function createListAndPagination() {
            // Obtinc les dades del servidor
            await getList(url);
            //... usuarios, per_page, last_page disponibles ...                

            createEmptyList(per_page);
            loadIntoList();
            createPaginationBar(); // Agrega la barra de paginación
        }

        async function setCurrentPage(pageNum) {
            // Actualizar la pàgina actual
            if (pageNum < 1 || pageNum > last_page) return;

            currentPage = pageNum;

            // Carregar dades a la taula, passant la pàgina que vull obtenir
            await getList(url + '?page=' + currentPage);
            loadIntoList();
            createPaginationBar(); // Vuelve a crear la barra para actualizar los estilos de los botones
        }

        function createPaginationBar() {
            const prevButton = document.createElement("button");
            prevButton.innerHTML = "<";
            prevButton.classList.add("navbutton");

            const nextButton = document.createElement("button");
            nextButton.innerHTML = ">";
            nextButton.classList.add("navbutton");

            prevButton.addEventListener("click", function() {
                setCurrentPage(currentPage - 1);
            });

            nextButton.addEventListener("click", function() {
                setCurrentPage(currentPage + 1);
            });

            const paginationNumbers = document.getElementById("pagination-numbers");
            paginationNumbers.innerHTML = ''; // Limpia cualquier contenido anterior
            paginationNumbers.appendChild(prevButton);
            paginationNumbers.appendChild(nextButton);
        }


        async function editUsuario(index) {
            if (index >= usuarios.length) {
                return;
            }

            const selectedElement = document.getElementById('usuario-' + usuarios[index].id);
            const container = document.querySelector("#usuariosList");
            const userElements = container.querySelectorAll(".user-list-item");

            // Desmarcar todos los usuarios
            for (const user of userElements) {
                user.setAttribute("selected", false);
            }

            // Marcar el usuario seleccionado
            selectedElement.setAttribute("selected", true);

            // Cargar información del usuario seleccionado
            selectedUsuario = usuarios[index];
            const nameInput = document.getElementById('nameInput');
            nameInput.value = selectedUsuario.name;

            // Cargar el correo electrónico
            const emailInput = document.getElementById('emailInput');
            emailInput.value = selectedUsuario.email;

            // Mostrar la contraseña actual en el campo correspondiente
            const currentPasswordInput = document.getElementById('currentPasswordInput');
            currentPasswordInput.value = selectedUsuario.password;

            // Activar botones para cancelar la operación de actualización y para eliminar el registro activo
            deleteButton.style.visibility = 'visible';
            cancelButton.style.visibility = 'visible';

            const operationLabel = document.getElementById('operationLabel');
            operationLabel.innerText = "Actualizar Usuario";
            operationLabel.style.fontSize = '140%'; // Añade el estilo de tamaño de fuente

            // Mostrar campos adicionales al seleccionar un usuario
            currentPasswordInput.style.display = 'block';
            confirmPasswordInput.style.display = 'block';

            // Mostrar nombres de campos adicionales
            document.querySelector('label[for="currentPasswordInput"]').style.display = 'block';
            document.querySelector('label[for="confirmPasswordInput"]').style.display = 'block';
        }


        async function saveRegister(event) {
            event.preventDefault();
            console.log('Guardando...');

            const operationLabel = document.getElementById('operationLabel');
            operationLabel.style.fontSize = '140%'; // Añade el estilo de tamaño de fuente

            if (selectedUsuario === undefined) {
                // Nuevo usuario
                console.log('Nuevo usuario');
                const newUsuario = {
                    id: undefined,
                    name: document.getElementById("nameInput").value,
                    email: document.getElementById("emailInput").value, // Añade el campo de correo electrónico
                    password: document.getElementById("newPasswordInput").value
                };
                await newRegister(newUsuario);
            } else {
                // Usuario existente
                console.log('Usuario existente');
                const newPassword = document.getElementById("newPasswordInput").value;

                if (newPassword !== "") {
                    // Si se proporcionó una nueva contraseña, actualizarla
                    selectedUsuario.password = newPassword;
                }

                // Actualizar el nombre y otras propiedades según sea necesario
                selectedUsuario.name = document.getElementById("nameInput").value;

                await updateRegister(selectedUsuario);
            }
        }




        async function updateRegister(selectedUsuario) {
            try {
                // Recupera los valores del formulario
                const currentPassword = document.getElementById("currentPasswordInput").value;
                const newPassword = document.getElementById("newPasswordInput").value;
                const confirmPassword = document.getElementById("confirmPasswordInput").value;
                const email = document.getElementById("emailInput").value;

                // Verifica que las contraseñas coincidan
                if (newPassword !== confirmPassword) {
                    showMessages('error', 'Las contraseñas no coinciden.');
                    return;
                }

                // Construye el objeto con los datos a enviar al servidor
                const requestData = {
                    id: selectedUsuario.id,
                    name: selectedUsuario.name,
                    // Actualiza el correo electrónico si se proporciona uno nuevo
                    email: email,
                    // Solo actualiza la contraseña si se proporciona una nueva
                    password: newPassword !== "" ? newPassword : currentPassword,
                };

                const response = await fetch(url + '/' + selectedUsuario.id, {
                    method: 'PUT',
                    headers: {
                        'Content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify(requestData),
                });

                const data = await response.json();

                if (response.ok) {
                    const selectedTr = document.getElementById('usuario-' + selectedUsuario.id);
                    selectedTr.innerHTML = data.data.name;

                    // Puedes mostrar un mensaje de éxito específico para cambios de contraseña
                    showMessages('message', 'Usuario actualizado correctamente');

                    // Recarga la página después de una actualización exitosa
                    window.location.reload();
                } else {
                    console.error('Error en la respuesta del servidor:', response.status, data);
                    showMessages('error', 'Error al actualizar el usuario. Consulta la consola para más detalles.');
                }
            } catch (error) {
                console.error('Error durante la solicitud:', error);

                if (response) {
                    // Intentar mostrar el contenido de la respuesta en la consola
                    const responseText = await response.text();
                    console.log('Respuesta del servidor:', responseText);
                }

                showMessages('error', 'Error accediendo a los datos remotos. Consulta la consola para más detalles.');
            }
        }

        async function newRegister(newData) {
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(newData),
                });

                const data = await response.json();

                if (response.ok) {
                    console.log('Server Response:', data);

                    // Agrega el nuevo usuario a la lista
                    usuarios.push(data.data);

                    // Calcula la página en la que se encuentra el nuevo usuario
                    const newUserPage = Math.ceil(usuarios.length / per_page);

                    if (newUserPage === currentPage) {
                        // Si el nuevo usuario está en la página actual, simplemente actualiza la lista y la paginación
                        loadIntoList();
                        createPaginationBar();
                    } else {
                        // Si el nuevo usuario está en una página diferente, establece la página actual en la nueva página
                        setCurrentPage(currentPage);
                    }

                    // Muestra un mensaje de éxito después de cargar la interfaz
                    showMessages('message', 'Usuario creado correctamente');

                    // Restablece el formulario después de cargar la interfaz
                    reset();
                } else {
                    const data = await response.json();

                    if (response.status === 400) {
                        // Manejar errores de validación específicos aquí
                        console.error('Error en la respuesta del servidor:', response.status, data);
                        showMessages('error', 'Error al crear el usuario. Consulta la consola para más detalles.');
                    } else {
                        // Trata la respuesta como éxito para otros códigos de estado
                        console.log('Server Response:', data);
                        showMessages('message', 'Usuario creado correctamente');
                    }
                }
            } catch (error) {
                console.error('Error durante la solicitud:', error);
                showMessages('error', 'Error accediendo a los datos remotos. Consulta la consola para más detalles.');
            }
        }






        // url per accedir a l'API
        const url = 'http://localhost:8000/api/usuarios';

        // Número pàgines del llistat
        let last_page = 0;
        // Número de registres per pàgina
        let per_page = 0;
        // Pàgina actual
        let currentPage = 1;

        // llista de planetes
        let usuarios = [];

        let selectedUsuario;

        getList(url).then(() => {
            createListAndPagination();
            reset();
        });
    </script>

</body>

</html>