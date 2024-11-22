let currentPage = 1;  // Página actual, inicializada en 1
const resultsPerPage = 5;  // Número de resultados por página

// Esta función hace la consulta con paginación en tiempo real
function consultarDatos(searchValue) {
    console.log(searchValue);
    let vista = document.getElementById("pagina").dataset.view;
    let campobusqueda = document.getElementById("pagina").dataset.campo;
    let id = document.getElementById("pagina").dataset.id;
    // Hacer una solicitud AJAX (fetch) al servidor PHP con el número de página
    fetch('../../scm/php/consultas/almacen.php', {
        method: 'POST',  // Método POST para enviar datos al servidor
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',  // Tipo de contenido
        },
        body: `search=${encodeURIComponent(searchValue)}&page=${currentPage}&limit=${resultsPerPage}&view=${vista}&campo=${campobusqueda}&id=${id}`  // Enviar parámetros
    })
    .then(response => response.json())  // La respuesta será en formato JSON
    .then(data => {
        // Mostrar los resultados
        let resultados = document.getElementById('resultados');
        resultados.innerHTML = '';  // Limpiar resultados anteriores

        if (data.results.length > 0) {
            data.results.forEach(item => {
                console.log(item);
                let tr = document.createElement('tr');
                tr.classList.add("bg-white", "border-b", "hover:bg-gray-50", "text-center");

                // Recorremos las propiedades del objeto `item` y las insertamos en las celdas de la tabla
                for (let key in item) {
                    if (item.hasOwnProperty(key)) {
                        let td = document.createElement('td');
                        td.classList.add("px-6", "py-4", "text-center");
                        td.textContent = item[key];  // Asignamos el valor de la propiedad
                        tr.appendChild(td);  // Añadimos la celda a la fila
                    }
                }

                // Añadir las acciones (editar, eliminar) al final de cada fila
                let tdActions = document.createElement('td');
                tdActions.classList.add("flex", "gap-x-4s", "items-center", "py-4");
                tdActions.innerHTML = `
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                        <i class="ri-pencil-fill text-xl"></i>
                    </a>
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
                        <i class="ri-delete-bin-fill text-xl"></i>
                    </a>
                `;
                tr.appendChild(tdActions);  // Añadimos la columna de acciones
                resultados.appendChild(tr);  // Añadimos la fila a la tabla
            });

            // Mostrar la paginación
            mostrarPaginacion(data.totalPages);
        } else {
            resultados.innerHTML = 'No se encontraron resultados.';
        }
    })
    .catch(error => console.error('Error:', error));  // Manejo de errores
}

// Esta función muestra los enlaces de paginación
function mostrarPaginacion(totalPages) {
    let pagination = document.getElementById('paginacion');
    pagination.innerHTML = '';  // Limpiar los enlaces de paginación previos

    for (let i = 1; i <= totalPages; i++) {
        let pageLink = document.createElement('div');
        pageLink.innerText = i;
        pageLink.onclick = () => cambiarPagina(i);
        pageLink.classList.add('font-semibold', 'px-4', 'py-2', 'rounded-lg', 'text-center','bg-cyan-700', 'cursor-pointer', 'hover:bg-red-500');
        pagination.appendChild(pageLink);
    }
}

// Esta función cambia la página actual
function cambiarPagina(page) {
    currentPage = page;
    consultarDatos('');  // Realiza la consulta con la nueva página
}


