<?php
	date_default_timezone_set("America/Asuncion");

    $hoy = date('Y-m-d H:i:s');
    require 'conexion.php';
    
    $canti = $_GET['canti'];
    $id = $_GET['id'];
    $subtotal = $_GET['subt'];
    $numero_venta = $_GET['nventa'];
    
    $sqlproductos = "SELECT * FROM productos WHERE IDPROD = '$id'";
    $resultadopro = sqlsrv_query($mysqli, $sqlproductos);
    if( !$resultadopro ) {
        die( print_r(sqlsrv_errors(), true));
    }
    $stock = sqlsrv_fetch_array($resultadopro, SQLSRV_FETCH_ASSOC);
    $CAN_ACT = $stock['CANT_ACT'];
    
    if ($canti <= $CAN_ACT ) {
        $total = $CAN_ACT - $canti; 
        $sqlcanti = "UPDATE productos SET CANT_ANT = '$CAN_ACT', CANT_ACT = '$total' WHERE IDPROD = '$id'";
        $resultadocanti = sqlsrv_query($mysqli, $sqlcanti);
        if( !$resultadocanti ) {
            die( print_r(sqlsrv_errors(), true));
        }
    
        $sql2 = "INSERT INTO pedidos (producto, estado, fecha, num_ven, cantidad, subtotal) VALUES ('$id', 0, '$hoy', '$numero_venta', '$canti', '$subtotal')";
        $resultado = sqlsrv_query($mysqli, $sql2);
        if( !$resultado ) {
            die( print_r(sqlsrv_errors(), true));
        }
    
        header("location: ../c1/ventas.php");
    } else {
        header("location: ../c1/ventas.php?error=1&ca=$CAN_ACT");
    }

?>
