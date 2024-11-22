<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
    <title>SCM TRAMONTINA</title>
</head>
<body>
    <div class="flex flex-row">
        <?php include 'menu/index.php'; ?>
        <div id="content" class="w-full relative"></div>
    </div>
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/paginacion.js"></script>
    <script src="../assets/js/crud.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // Obtener todos los botones del menú
            const menuButtons = document.querySelectorAll('.menu-item');
            console.log(menuButtons);
            // Añadir el evento de clic a cada botón del menú
            menuButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Cargar la página PHP correspondiente mediante AJAX
                    const page = button.getAttribute('data-page');
                    loadPage(page);
                    
                    // Resaltar el botón activo
                    setActiveButton(button);
                });
            });

            // Función para cargar la página mediante AJAX
            function loadPage(page) {
                fetch(page)  // Realiza una solicitud GET a la página PHP
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error al cargar la página');
                        }
                        return response.text();  // Si la respuesta es exitosa, convertimos a texto
                    })
                    .then(data => {
                        // Insertar el contenido cargado en el contenedor #content
                        document.getElementById('content').innerHTML = data;
                        consultarDatos('');
                    })
                    .catch(error => {
                        console.error('Hubo un problema con la solicitud AJAX:', error);
                    });
            }

            // Función para resaltar el botón activo en el menú
            function setActiveButton(activeButton) {
                // Eliminar la clase 'active' de todos los botones
                menuButtons.forEach(button => button.classList.remove('bg-cyan-500'));
                menuButtons.forEach(button => button.classList.add('bg-cyan-700'));
                menuButtons.forEach(button => button.classList.add('text-gray-800'));
                menuButtons.forEach(button => button.classList.remove('text-white'));
                // Añadir la clase 'active' al botón que fue clickeado
                activeButton.classList.remove('bg-cyan-700');
                activeButton.classList.add('bg-cyan-500');
                activeButton.classList.remove('text-gray-800');
                activeButton.classList.add('text-white');
            }
            // Cargar la página inicial por defecto
            document.getElementById("btnalmacen").click();
            //loadPage('../almacen/index.php');
           
        });
    </script>
</body>
</html>