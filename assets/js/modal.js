function modaladd(modalnombre) {
    let tablaNombre = modalnombre.getAttribute('data-modal').split("t-");
    console.log(tablaNombre[1]);
    loadPage(tablaNombre[1]);
        
}

function loadPage(page) {
    fetch(`../../scm/src/modal/${page}.php`)  // Realiza una solicitud GET a la página PHP
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar la página');
            }
            return response.text();  // Si la respuesta es exitosa, convertimos a texto
        })
        .then(data => {
            // Insertar el contenido cargado en el contenedor #content
            document.getElementById('modalD').innerHTML = data;
        })
        .catch(error => {
            console.error('Hubo un problema con la solicitud AJAX:', error);
        });
}

function closebtn() {
    let modalD = document.getElementById('modalD');
    modalD.innerHTML = '';
    
}