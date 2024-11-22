<?php

function obtenerCamposDinamicos($tableName) {
    require '../../php/conexion.php';

    // Consulta para obtener los campos y las claves foráneas
    $sql = "
    SELECT DISTINCT 
    c.COLUMN_NAME,
    CASE 
        WHEN fk.name IS NOT NULL THEN 'FK' 
        ELSE 'Normal' 
    END AS column_type
FROM 
    INFORMATION_SCHEMA.COLUMNS AS c
LEFT JOIN 
    sys.foreign_key_columns AS fkc 
    ON fkc.parent_column_id = c.ORDINAL_POSITION
LEFT JOIN 
    sys.foreign_keys AS fk 
    ON fk.object_id = fkc.constraint_object_id
WHERE 
    c.TABLE_NAME = ?  -- El nombre de la tabla se pasa como parámetro
ORDER BY 
    c.COLUMN_NAME;
    ";

    $params = array($tableName);
    $result = sqlsrv_query($conexion, $sql, $params);

    // Verificar si la consulta fue exitosa
    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Almacenar los nombres de las columnas y su tipo (foránea o normal)
    $fields = [];
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $fields[] = [
            'COLUMN_NAME' => $row['COLUMN_NAME'],
            'column_type' => $row['column_type'] // 'FK' para claves foráneas, 'Normal' para columnas normales
        ];
    }

    // Cerrar la conexión
    sqlsrv_close($conexion);

    // Devolver los campos como un JSON
    return json_encode($fields);
}

// Obtener los campos para la tabla 'ALMACEN' (esto puede cambiar según la tabla que desees)
if (isset($_GET['table_name'])) {
    $tableName = $_GET['table_name']; // El nombre de la tabla se pasa por la URL
    echo obtenerCamposDinamicos($tableName);
} else {
    echo json_encode(["error" => "No se ha proporcionado el nombre de la tabla."]);
}


?>