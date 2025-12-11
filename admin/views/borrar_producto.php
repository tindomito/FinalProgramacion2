<?php
// require_once("../classes/Producto.php");
// require_once("../classes/Marca.php");

require_once("../functions/autoload.php");


$id = $_GET['id'] ?? FALSE;
$producto = Producto::get_x_id($id);
// $marca = Marca::get_x_id($producto->getIdMarca());


?>
<h2>Borrar producto</h2>
<div class="row">
    <div class="col-12">
       <p class="h5">Nombre de Producto</p>
       <p><?= $producto->getNombre(); ?></p>
    </div>
        <div class="col-12">
        <p class="h5">Presentación</p>
        <p><?= $producto->getPresentacion(); ?></p>

    </div>
        <div class="col-12">
        <p class="h5">Precio</p>
        <p><?= $producto->getPrecio(); ?></p>

    </div>
        <div class="col-12">
        <p class="h5">Foto</p>
        <img src="../img/productos/<?= $producto->getFoto(); ?>" alt="Imagen de <?= $producto->getNombre(); ?>" width="100">
    </div>
    <div class="col-12">
        <p class="h5">Marca</p>
       
        <p><?= $producto->getMarca(); ?></p>
        </select>    
    </div>

    
    <div class="col-12">
        <a href="actions/borrar_producto_acc.php?id=<?= $producto->getIdProducto(); ?>" class="btn btn-danger">Eliminar</a>
        <a href="?sec=productos" class="btn btn-primary">Cancelar</a>
    </div>
</div>