<?php
	
	require 'conexion.php';
 
	$id = $_GET['id'];
	
	//traemos los datos del pedido
	$sqlpedidos = "SELECT cantidad, producto from pedidos where id_pedido = '$id'";
	$resultadoped = $mysqli->query($sqlpedidos);
	$pedido = $resultadoped->fetch_array(MYSQLI_ASSOC);

	$id_producto = $pedido['producto'];
	$canti = $pedido['cantidad'];

	//traemos la cantidad actual del producto
	$sqlproductos = "SELECT * from productos where IDPROD = '$id_producto'";
	$resultadopro = $mysqli->query($sqlproductos);
	$stock = $resultadopro->fetch_array(MYSQLI_ASSOC);
	$CAN_ACT = $stock['CANT_ACT'];
	
	//Le devolvemos al producto la cantidad restada
	$total = $CAN_ACT + $canti; 
	$sqlcanti = "UPDATE productos SET CANT_ANT='$CAN_ACT', CANT_ACT='$total' WHERE IDPROD = '$id_producto'";
	$resultadocanti = $mysqli->query($sqlcanti);

	//borramos el pedido ò producto añadido al carrito
	$sql = "DELETE FROM pedidos WHERE id_pedido = '$id'";
	$resultado = $mysqli->query($sql);


	//volvemos a la vista ventas
	header("location: ../c1/ventas.php");
	
?>
 
