
<!-- Modal -->
<div class="modal fade" id="modal-almacen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black;" class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../php/guardar_producto.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nombre:</label>
                        <input required type="text" class="form-control" name="nom">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Descripcion:</label>
                        <textarea required class="form-control" id="message-text" name="des"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tipo:</label>
                        <select required style="color:grey;" class="form-control" name="tipo">
                            <option value="0">Seleccione una categoria</option>
                            <?php while ($tipo1 = $resultadotipo1->fetch_array(MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $tipo1['ID_TIPO_PROD']; ?>">
                                    <?php echo $tipo1['DESCRIPCION']; ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Cantidad:</label>
                        <input required type="text" class="form-control" name="cant">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Precio Compra:</label>
                        <input required type="text" class="form-control" name="prec">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Precio Venta:</label>
                        <input required type="text" class="form-control" name="prev">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Proveedor:</label>
                        <select style="color:grey;" class="form-control" name="provee" required>
                            <option value="0">Seleccione un proveedor</option>
                            <?php while ($proveedor1 = $resultadoprov1->fetch_array(MYSQLI_ASSOC)) { ?>
                                <option value="<?php echo $proveedor1['IDPROV']; ?>">
                                    <?php echo $proveedor1['DESCPROD']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar!</button>
                </div>
            </form>
        </div>
    </div>
</div>