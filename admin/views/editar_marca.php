<?php
// require_once("../classes/Marca.php");
require_once("../functions/autoload.php");


$id = $_GET['id'] ?? FALSE;
$marca = Marca::get_x_id($id);


?>
<h2>Editar marca</h2>
<form action="actions/editar_marca_acc.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_marca" class="form-control" id="id_marca" value="<?= $marca->getIdMarca(); ?>" >
    <div class="mb-3">
        <label for="marca" class="form-label">Nombre de marca</label>
        <input type="text" class="form-control" id="marca" name="marca" value="<?= $marca->getMarca(); ?>">
    </div>
    <input type="submit"  class="btn btn-warning" value="Editar">
    <a href="?sec=marcas" class="btn btn-danger">Cancelar</a>
</form>