<?php
require_once("../functions/autoload.php");

Autenticacion::verify();

$conexion = (new Conexion())->getConexion();

$query = "SELECT id_usuario, usuario, nombre, apellido FROM usuarios";
$PDOStatement = $conexion->prepare($query);
$PDOStatement->execute();
$usuarios = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="container mt-5">
  <h1 class="mb-4">Usuarios registrados</h1>

  <?php if (!empty($usuarios)): ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Usuario (email)</th>
            <th>Nombre</th>
            <th>Apellido</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $usuario): ?>
            <tr>
              <td><?= htmlspecialchars($usuario['id_usuario']); ?></td>
              <td><?= htmlspecialchars($usuario['usuario']); ?></td>
              <td><?= htmlspecialchars($usuario['nombre']); ?></td>
              <td><?= htmlspecialchars($usuario['apellido']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center">No hay usuarios registrados.</div>
  <?php endif; ?>
</section>
