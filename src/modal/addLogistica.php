<?php 
require '../../php/conexion.php';

// Consultas SQL
$sqlTransporte = "SELECT * FROM scm.transportes";
$resultadoTransporte = sqlsrv_query($conexion, $sqlTransporte);


$sqlInventario = "SELECT ID, DESCRIPCION FROM scm.V_Inventario";
$resultadoInventario = sqlsrv_query($conexion, $sqlInventario);

$sqlDestino = "SELECT * FROM scm.destino";
$resultadoDestino = sqlsrv_query($conexion, $sqlDestino);


$sqlDestino = "SELECT * FROM scm.destino";
$resultadoDestino = sqlsrv_query($conexion, $sqlDestino);
// Cerrar conexión

$numero_pedido = 1;

$sqllogistica = "SELECT top 1 * FROM scm.ordenPedidos order by nropedido desc";
$resultadologistica = sqlsrv_query($conexion, $sqllogistica);
$rowres = sqlsrv_fetch_array($resultadologistica, SQLSRV_FETCH_ASSOC);

if (isset($rowres['nropedido'])) {
  $numero_pedido = $rowres['nropedido'] + 1;
} else {
  $numero_pedido = 1;
}


?>

<div id="modalbg" class="z-40 left-0 absolute w-full h-screen bg-gray-800/45"></div>
<div id="modalg" class="p-8 h-[20em] z-40 inset-y-[30%] inset-x-[30%] absolute w-[40%] rounded-xl overflow-hidden border bg-white">
    <form id="formAdd" onsubmit="btn(event);return false;" data-table="logistica">
        <div class="p-2 mb-2 text-black w-full flex justify-start items-center">
            <h1 class="text-2xl font-bold text-left">Nuevo Pedido # <?php echo $numero_pedido; ?></h1>
        </div>
        <div class="p-2 text-black w-full flex justify-between items-center">
            <label for="transporteId">Transporte: </label>
            <select name="transporteId">
                <?php while ($row1 = sqlsrv_fetch_array($resultadoTransporte, SQLSRV_FETCH_ASSOC)) { ?>
                    <option value="<?php echo $row1['transporteId']; ?>"><?php echo $row1['descripcion']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="p-2 text-black w-full flex justify-between items-center">
            <label for="inventarioId">Inventario: </label>
            <select name="inventarioId">
                <?php while ($row2 = sqlsrv_fetch_array($resultadoInventario, SQLSRV_FETCH_ASSOC)) { ?>
                    <option value="<?php echo $row2['ID']; ?>"><?php echo $row2['DESCRIPCION']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="p-2 text-black w-full flex justify-between items-center">
            <label for="destinoId">Destino: </label>
            <select name="destinoId">
                <?php while ($row3 = sqlsrv_fetch_array($resultadoDestino, SQLSRV_FETCH_ASSOC)) { ?>
                    <option value="<?php echo $row3['destinoId']; ?>"><?php echo $row3['descripcion']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class=" p-2 text-black w-full flex justify-between items-center">
            <label for="i-fec">Fecha: </label>
            <input name="fechaEnvio" id="i-fec" class="camposform w-[80%] p-2 rounded-lg border text-center" type="text" placeholder="ej: Almacen1" required />
        </div>
        <div class="hidden p-2 text-black w-full justify-between items-center">
            <label for="i-des">estado: </label>
            <input value="1" name="estado" id="i-des" class="camposform w-[80%] p-2 rounded-lg border text-center" type="text" placeholder="ej: Almacen1" required/>
        </div>
        <div class="p-2 mt-2 text-black w-full flex justify-end items-center gap-x-2">
            <input id="closebtn1" onclick="closebtn()" value="Volver" class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-md text-white font-semibold cursor-pointer" type="button" />
            <input value="Confirmar" class="bg-green-600 hover:bg-green-500 px-4 py-2 rounded-md text-white font-semibold cursor-pointer" type="submit" />
        </div>

        <div id="responseMessage"></div>
    </form>
</div>
