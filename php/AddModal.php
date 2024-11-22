<?php
 require 'conexion.php';

// Obtenemos todos los campos recibidos a través de $_POST
$camposValores = $_POST;

// Extraemos el nombre de la tabla de los datos recibidos
$tabla = isset($camposValores['tabla']) ? $camposValores['tabla'] : '';  // Valor por defecto si no está presente

// Construir dinámicamente los nombres de los campos y sus valores
$campos = [];
$valores = [];
$parametros = [];

// Construir las partes de la consulta SQL
foreach ($camposValores as $campo => $valor) {
    if ($campo !== 'tabla') {  // No procesamos el campo 'tabla' en la inserción
        $campos[] = $campo;  // Nombres de los campos
        $valores[] = "?";     // Placeholders para los valores
        $parametros[] = $valor;  // Valores que se insertarán
    }
}

// Construir la parte de la consulta que contiene los nombres de los campos
$camposStr = implode(", ", $campos);

// Construir la parte de la consulta que contiene los placeholders para los valores
$valoresStr = implode(", ", $valores);

// Crear la consulta SQL
$sql = "INSERT INTO $tabla ($camposStr) VALUES ($valoresStr)";  // Usamos la tabla dinámica

// Preparar la consulta SQL
$stmt = sqlsrv_prepare($conexion, $sql, $parametros);

// Ejecutar la consulta SQL
if ($stmt) {
    $resultado = sqlsrv_execute($stmt);
    if ($resultado) {
        $response['status'] = 'success';
        $response['message'] = 'Datos insertados correctamente';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error al insertar los datos';
        die( print_r(sqlsrv_errors(), true));  // Mostrar error en caso de fallo
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error al preparar la consulta';
    die( print_r(sqlsrv_errors(), true));  // Mostrar error en caso de fallo
}

// Devolver la respuesta como JSON
echo json_encode($response);

// Cerrar la conexión
sqlsrv_close($conexion);
