
<div  id="modalbg" class=" z-40 left-0 absolute w-full h-screen bg-gray-800/45 ">
</div>
<div id="modalg" class="p-8 h-[20em] z-40 inset-y-[30%] inset-x-[30%] absolute w-[40%] rounded-xl overflow-hidden border bg-white">
    <form action="../../scm/php/agregarAlmacen.php" method="POST">
        <div class="p-2 mb-2 text-black w-full flex justify-start items-center">
            <h1 class="text-2xl font-bold text-left">Nuevo Almacén</h1>
        
        </div>
        <div class="p-2 text-black w-full flex justify-between items-center">
            <label for="i-des">Descripción: </label>
            <input name="descripcion" id="i-des" class="w-[80%] p-2 rounded-lg border text-center" type="text" placeholder="ej: Almacen1" required/>
        </div>
        <div class="p-2 text-black w-full flex justify-between items-center">
            <label for="i-ubi">Ubicación:</label>
            <input name="ubicacion" id="i-ubi" class="w-[80%] p-2 rounded-lg border text-center" type="text" placeholder="maps.google" required/>
        </div>
        <div class="p-2 mt-2 text-black w-full flex justify-end items-center gap-x-2">
            <input id="closebtn1" onclick="closebtn()" value="Volver" class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-md text-white font-semibold cursor-pointer" type="button"  />
            <input value="Confirmar" class="bg-green-600 hover:bg-green-500 px-4 py-2 rounded-md text-white font-semibold cursor-pointer" type="submit"  />
            
        </div>
    </form>
</div>
