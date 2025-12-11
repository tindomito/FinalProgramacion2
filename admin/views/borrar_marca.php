<?php
require_once("../functions/autoload.php");


$id = $_GET['id'] ?? FALSE;
$marca = Marca::get_x_id($id);


?>
<h2>Editar marca</h2>
<div class="row">
    <div class="col-12">
        <h3>Nombre de Marca</h3>
        <p><?= $marca->getMarca(); ?></p>
    </div>
    <div class="col-12">
        <a href="actions/borrar_marca_acc.php?id=<?= $marca->getIdMarca(); ?>" class="btn btn-danger">Eliminar</a>
        <a href="?sec=marcas" class="btn btn-primary">Cancelar</a>
    </div>
</div>