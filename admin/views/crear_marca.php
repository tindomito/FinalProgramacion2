<?php
?>
<h2>Agregar una nueva marca</h2>
<form action="actions/crear_marca_acc.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="marca" class="form-label">Nombre de marca</label>
        <input type="text" class="form-control" id="marca" name="marca">
    </div>
    <input type="submit" value="Crear">
    <a href="?sec=marcas" class="btn btn-danger">Cancelar</a>
</form>