<?php
require_once "classes/Producto.php";

$id = $_GET['id'] ?? null;
$producto = null;

if ($id && is_numeric($id)) {
    $producto = Producto::get_x_id($id);
}
?>

<section class="container py-5 text-light">
  <?php if ($producto): ?>
    <div class="row justify-content-center align-items-center g-5">
      <!-- Imagen del producto -->
      <div class="col-lg-6 text-center">
        <div class="bg-dark-accent p-4 rounded shadow">
          <img src="img/productos/<?= htmlspecialchars($producto->getFoto()); ?>" alt="<?= htmlspecialchars($producto->getNombre()); ?>" class="img-fluid rounded">
        </div>
      </div>

      <!-- Detalles del producto -->
      <div class="col-lg-6">
        <div class="bg-dark-accent p-4 rounded shadow h-100 d-flex flex-column justify-content-between">
          <div>
            <h1 class="mb-3 text-dark"><?= htmlspecialchars($producto->getNombre()); ?></h1>
            <h5 class="text-accent mb-3">Marca: <?= htmlspecialchars($producto->getMarca()); ?></h5>
            <p class="mb-4"><?= htmlspecialchars($producto->getPresentacion()); ?></p>
          </div>
          <div>
            <p class="fs-3 fw-bold text-accent">$<?= number_format($producto->getPrecio(), 2); ?></p>
            <div class="d-grid gap-2 mt-4">
              <a href="#" class="btn btn-primary btn-accent btn-lg">Agregar al carrito</a>
              <a href="index.php?sec=filtro" class="btn btn-success btn-outline-light btn-lg">Volver al catálogo</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="text-center py-5">
      <h2 class="text-danger">Producto no encontrado</h2>
      <a href="index.php?sec=filtro" class="btn btn-outline-light mt-3">Volver al catálogo</a>
    </div>
  <?php endif; ?>
</section>
