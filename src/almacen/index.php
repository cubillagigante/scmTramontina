<?php 
require '../../php/conexion.php';


$sqlcanti = "SELECT * FROM SCM.ALMACEN";
$resultadocanti = sqlsrv_query($conexion, $sqlcanti);

?>
<div class="w-3/4 text-white m-auto ">
    <div id="modalD"></div>
    <section class="flex pt-10 pb-6 gap-x-2 justify-between items-center ">
        <div >
            <label for="InputBuscador" class="font-semibold text-black pr-3">Buscar Almacén: </label>
            <input id="InputBuscador" placeholder="Ej: almacen 1" type="text" class="p-1 px-5 text-black  border border-gray-400" />
        </div>
        <Button onclick="modaladd(this)" data-modal="t-addAlmacen" class="bg-green-600 hover:bg-green-500 px-10 py-1 rounded-md"> <i class="ri-add-circle-fill text-xl"></i></Button>
    </section>
    <section class=" relative">
        <div class=" mt-5 m-auto relative overflow-x-auto shadow-md sm:rounded-lg  " >
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200 text-center">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Código
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Depósito
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ubicación
                        </th>
                        
                        <th scope="col" class=" py-3">
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($fila = sqlsrv_fetch_array($resultadocanti, SQLSRV_FETCH_ASSOC)) { ?>
                    <tr
                        class="bg-white border-b hover:bg-gray-50 text-center">
                        
                        <th scope="row" class="px-6 py-4 font-medium  ">
                            <?php echo $fila['almacenId']; ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php echo $fila['nombre']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $fila['ubicacion']; ?>
                        </td>
                        
                        <td class="flex gap-x-4s items-center  py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><i class="ri-pencil-fill text-xl"></i></a>
                            <a href="#"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><i class="ri-delete-bin-fill text-xl"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </section>
</div>

