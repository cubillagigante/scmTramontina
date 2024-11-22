function insertarDatos(tabla, camposValores) {
    camposValores['tabla'] = tabla;
// Usamos fetch para enviar la solicitud AJAX
    fetch(`../php/AddModal.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams(camposValores)
    })
    .then(response => response.json())
    .then(data => {
        // Mostrar el mensaje de respuesta en el HTML
        document.getElementById("responseMessage").innerText = data.message;
        
        // Limpiar el formulario si la inserción fue exitosa
        if (data.status === "success") {
            console.log('correctooooo');
            loadPage('modalOk');  
            consultarDatos('');
            console.log('dvdsv');
            setTimeout(function() {
                eliminarDiv('modalOk');
            }, 1000); 

        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function btn(event) {
    event.preventDefault(); // Evita el envío del formulario y recarga de la página
    let formulario = event.target;
    let tabla = "scm." + formulario.dataset.table;
    console.log(tabla);

    // Crear un array para almacenar los datos del formulario como objetos
    let datosFormulario = [];

    // Obtener todos los elementos con la clase 'camposform'
    let elementos = document.querySelectorAll(".camposform");

    // Recorrer los elementos y construir un objeto con nombre y valor
    elementos.forEach(function(elemento) {
        // Crear un objeto con el nombre y valor de cada campo
        let campo = {
            nombre: elemento.name,
            valor: elemento.value
        };
        // Añadir el objeto al array 'datosFormulario'
        datosFormulario.push(campo);
    });


    var camposValores = {};
    datosFormulario.forEach(function(item) {
      camposValores[item.nombre] = item.valor;
    });


    insertarDatos(tabla, camposValores); 
    // Mostrar los datos del formulario en la consola
    console.log(camposValores);
}



function eliminarDiv(divname) {
    let div = document.getElementById(divname);
    if (div) {
        div.remove(); 
    } else {
        console.log("El div no existe.");
    }
}