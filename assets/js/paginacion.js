let currentPage = 1;  // Página actual, inicializada en 1
const resultsPerPage = 5;  // Número de resultados por página

// Esta función hace la consulta con paginación en tiempo real
function consultarDatos(searchValue, pagina, resultados) {
    
    console.log(searchValue);
    let vista = document.getElementById(pagina).dataset.view;
    let campobusqueda = document.getElementById(pagina).dataset.campo;
    let id = document.getElementById(pagina).dataset.id;
    let editbtn = document.getElementById(pagina).dataset.edit;
    let deletebtn = document.getElementById(pagina).dataset.delete;

    // Hacer una solicitud AJAX (fetch) al servidor PHP con el número de página
    fetch('../../scm/php/consultas/consultaDinamica.php', {
        method: 'POST',  // Método POST para enviar datos al servidor
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',  // Tipo de contenido
        },
        body: `search=${encodeURIComponent(searchValue)}&page=${currentPage}&limit=${resultsPerPage}&view=${vista}&campo=${campobusqueda}&id=${id}`  // Enviar parámetros
    })
    .then(response => response.json())  // La respuesta será en formato JSON
    .then(data => {
        // Mostrar los resultados
        let resultadoshtml = document.getElementById(resultados);
        resultadoshtml.innerHTML = '';  // Limpiar resultados anteriores

        if (data.results.length > 0) {
            data.results.forEach(item => {
                console.log(item);  // Mostrar el objeto completo

                let tr = document.createElement('tr');
                tr.classList.add("bg-white", "border-b", "hover:bg-gray-50", "text-center");

                // Recorremos las propiedades del objeto `item` y las insertamos en las celdas de la tabla
                for (let key in item) {
                    if (item.hasOwnProperty(key)) {
                        let td = document.createElement('td');
                        td.classList.add("px-6", "py-4", "text-center");

                        let cellValue = item[key];

                        // Verificar si el valor de la celda es un objeto con una propiedad `date` (fecha)
                        if (cellValue && cellValue.date) {
                            // Si es un objeto con una propiedad `date`, convertirlo a un formato legible
                            let dateStr = cellValue.date;  // La fecha como cadena 'YYYY-MM-DD HH:MM:SS.000000'
                            
                            // Convertir la cadena de fecha a formato ISO para usarla con JavaScript
                            let isoDate = dateStr.replace(' ', 'T');  // Reemplazar espacio por "T"
                            let dateObj = new Date(isoDate);  // Convertir la cadena a un objeto Date

                            // Mostrar la fecha en formato legible (depende de la configuración regional)
                            td.textContent = dateObj.toLocaleString();  // Formato: "11/10/2024, 10:00:00 AM"
                        } else {
                            // Si no es una fecha, mostrar el valor tal cual
                            td.textContent = cellValue;
                        }

                        tr.appendChild(td);  // Añadimos la celda a la fila
                    }
                }

                // Añadir las acciones (editar, eliminar) al final de cada fila
                let tdActions = document.createElement('td');
                tdActions.classList.add("flex", "gap-x-4s", "items-center", "py-4");
                if (editbtn == 'true') {
                    tdActions.innerHTML += `
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <i class="ri-pencil-fill text-xl"></i>
                        </a>
                    `;
                } 
                if (deletebtn == 'true') {
                    tdActions.innerHTML += `
                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">
                            <i class="ri-delete-bin-fill text-xl"></i>
                        </a>
                    `;
                }
                tr.appendChild(tdActions);  // Añadimos la columna de acciones
                resultadoshtml.appendChild(tr);  // Añadimos la fila a la tabla
            });

            // Mostrar la paginación
            mostrarPaginacion(data.totalPages, pagina, resultados);
        } else {
            resultadoshtml.innerHTML = 'No se encontraron resultados.';
        }
    })
    .catch(error => console.error('Error:', error));  // Manejo de errores
}





// Esta función muestra los enlaces de paginación
function mostrarPaginacion(totalPages, pagina, resultados) {
    let pagination = document.getElementById('paginacion');
    pagination.innerHTML = '';  // Limpiar los enlaces de paginación previos

    for (let i = 1; i <= totalPages; i++) {
        let pageLink = document.createElement('div');
        pageLink.innerText = i;
        pageLink.onclick = () => cambiarPagina(i, pagina, resultados);
        pageLink.classList.add('font-semibold', 'px-4', 'py-2', 'rounded-lg', 'text-center','bg-cyan-700', 'cursor-pointer', 'hover:bg-red-500');
        pagination.appendChild(pageLink);
    }
}

// Esta función cambia la página actual
function cambiarPagina(page, pagina, resultados) {

    currentPage = page;
    consultarDatos('', pagina, resultados);  // Realiza la consulta con la nueva página
}


