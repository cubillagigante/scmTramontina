let currentPage = 1;  // Página actual, inicializada en 1
const resultsPerPage = 5;  // Número de resultados por página

// Esta función hace la consulta con paginación en tiempo real
function consultarDatos(searchValue) {  
    console.log(searchValue);
    // Hacer una solicitud AJAX (fetch) al servidor PHP con el número de página
    fetch('../../scm/php/consultas/almacen.php', {
        method: 'POST',  // Método POST para enviar datos al servidor
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',  // Tipo de contenido
        },
        body: `search=${encodeURIComponent(searchValue)}&page=${currentPage}&limit=${resultsPerPage}`  // Enviar parámetros
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
                tr.innerHTML = `<tr
                    class="bg-white border-b hover:bg-gray-50 text-center">
                        <th scope="row" class="px-6 py-4 font-medium  ">
                            ${item.almacenId}
                        </th>
                        <td class="px-6 py-4">
                            ${item.nombre}
                        </td>
                        <td class="px-6 py-4">
                            ${item.ubicacion}
                        </td>
                        
                        <td class="flex gap-x-4s items-center  py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><i class="ri-pencil-fill text-xl"></i></a>
                            <a href="#"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><i class="ri-delete-bin-fill text-xl"></i></a>
                        </td>
                    </tr>`;
                resultados.appendChild(tr);
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


