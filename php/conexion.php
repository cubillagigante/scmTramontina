<?php
date_default_timezone_set("America/Asuncion");

// Parámetros de conexión a SQL Server
$serverName = "DIEGOC"; // Puede ser la IP del servidor de SQL Server
$connectionInfo = array(
    "Database" => "scm_prueba", // Nombre de la base de datos
    "UID" => "sa", // Nombre de usuario de SQL Server
    "PWD" => "1234" // Contraseña de SQL Server
);

// Establecer la conexión con SQL Server
$conexion = sqlsrv_connect($serverName, $connectionInfo);

// Verificar la conexión
if ($conexion === false) {
    die(print_r(sqlsrv_errors(), true)); // Si hay un error de conexión, lo mostramos
}
?>