<?php

require '../conexion.php';
// Obtener los parámetros de la solicitud AJAX
$search = isset($_POST['search']) ? $_POST['search'] : '';
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 5;
$offset = ($page - 1) * $limit;  // Calcular el desplazamiento para la paginación

// Hacer la consulta SQL con limitación de resultados
$sql = "SELECT almacenId, nombre, ubicacion FROM scm.Almacen WHERE nombre LIKE ? ORDER BY almacenId DESC OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
$params = array("%$search%", $offset, $limit);
$stmt = sqlsrv_query($conexion, $sql, $params);

// Verificar si se obtuvo algún resultado
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Preparar los resultados para devolverlos como JSON
$resultados = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $resultados[] = $row;
}

// Obtener el número total de registros (sin paginación)
$sqlTotal = "SELECT COUNT(*) AS total FROM scm.Almacen WHERE nombre LIKE ?";
$stmtTotal = sqlsrv_query($conexion, $sqlTotal, array("%$search%"));
$rowTotal = sqlsrv_fetch_array($stmtTotal, SQLSRV_FETCH_ASSOC);
$totalRecords = $rowTotal['total'];

// Calcular el total de páginas
$totalPages = ceil($totalRecords / $limit);

// Devolver los resultados y el número total de páginas en formato JSON
echo json_encode(array(
    'results' => $resultados,
    'totalPages' => $totalPages
));

// Cerrar la conexión
sqlsrv_close($conexion);
?>
