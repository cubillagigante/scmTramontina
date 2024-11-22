<div id="pagina" data-view="scm.V_Inventario" data-campo="DESCRIPCION" data-id="ID" data-edit="true" data-delete="true" class="w-3/4 text-white m-auto ">
    <div id="modalD"></div>
    <section class="flex pt-10 pb-6 gap-x-2 justify-between items-center ">
        <div >
            <label for="InputBuscador" class="font-semibold text-black pr-3">Buscar Producto: </label>
            <input id="InputBuscador" onkeyup="consultarDatos(this.value)" placeholder="Ej: tenedor" type="text" class="p-1 px-5 text-black  border border-gray-400" />
        </div>
        <Button onclick="modaladd(this)" data-modal="t-addInventario" class="bg-green-600 hover:bg-green-500 px-10 py-1 rounded-md"> <i class="ri-add-circle-fill text-xl"></i></Button>
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
                            Producto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Almacen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stock
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stock Anterior
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ultimo Stock
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha Modificación
                        </th>
                        <th scope="col" class=" py-3">
                            
                        </th>
                    </tr>
                </thead>
                <tbody id="resultados">
                </tbody>
            </table>
            
        </div>
        <div id="paginacion" class=" flex justify-start items-center gap-x-2 mt-4"></div>
    </section>
</div>

