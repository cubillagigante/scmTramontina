<?php
    $ruc = $_POST['ruc_cliente'];

    $sql = "SELECT * FROM cliente where ruc = '$ruc'";
    $resultado = $mysqli->query($sql);
    

	header("location: ../c1/venta.php?id");

?>