<?php 
// require_once("../classes/Marca.php");
require_once("../functions/autoload.php");
Autenticacion::verify();


$marcas = new Marca;
// echo "<pre>";
// var_dump($marcas->todasMarcas());
// echo "</pre>";

$lista = $marcas->todasMarcas();
?>
<h2>Administración de Marcas</h2>
<table class="table table-striped">
<thead>
<tr>
    <th>ID</th>
    <th>Marca</th>
    <th>Opciones</th>
</tr>
</thead>
<tbody>

<?php
foreach ($lista as $marca) {
    ?>
    <tr>
      <td><?= $marca->getIdMarca();?></td>
      <td><?= $marca->getMarca();?></td>
      <td>
        <a href="?sec=editar_marca&id=<?= $marca->getIdMarca();?>" class="btn btn-warning">Editar</a>
        <a href="?sec=borrar_marca&id=<?= $marca->getIdMarca();?>" class="btn btn-danger">Borrar</a>
    </td>
    </tr> 
    <?php   
}

// $m = Marca::get_x_id(1);
// $m->edit("Marolio");
?>
</tbody>
</table>

<a href="?sec=crear_marca" class="btn btn-primary">Crear Marca</a>
