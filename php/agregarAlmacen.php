<?php
 require 'conexion.php';

 $descripcion = $_POST['descripcion']; 
 $ubicacion = $_POST['ubicacion'];

 $sql2 = "INSERT INTO scm.almacen (nombre, ubicacion) VALUES ( '$descripcion', '$ubicacion')";
 $resultado = sqlsrv_query($conexion, $sql2);
 if( !$resultado ) {
    die( print_r(sqlsrv_errors(), true));
}
 //header("location: ../src/app.php");