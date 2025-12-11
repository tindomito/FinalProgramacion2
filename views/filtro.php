<?php
require_once "classes/Producto.php";
require_once "classes/Marca.php";

$marca = $_GET['marca'] ?? null;
$min = $_GET['min'] ?? null;
$max = $_GET['max'] ?? null;
$mensaje = $_GET['msg'] ?? null;

$productos = (new Producto())->filtrarProductos($marca, $min, $max);
$marcas = (new Marca())->todasMarcas();
?>

<section class="container py-5 text-light">
  <h1 class="mb-4 text-center text-dark">Catálogo de Productos</h1>

  <?php if ($mensaje === 'agregado'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-2"></i>Producto agregado al carrito correctamente.
      <a href="index.php?sec=carrito" class="alert-link">Ver carrito</a>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- Filtros -->
  <form method="GET" action="index.php" class="mb-5 bg-dark-accent p-4 rounded">
    <input type="hidden" name="sec" value="filtro">

    <div class="row g-3 align-items-end">
      <!-- Marca -->
      <div class="col-md-4">
        <label for="marca" class="form-label text-dark">Marca</label>
        <select name="marca" id="marca" class="form-select">
          <option value="">Todas</option>
          <?php foreach ($marcas as $m): ?>
            <option value="<?= $m->getIdMarca(); ?>" <?= ($marca == $m->getIdMarca()) ? 'selected' : ''; ?>>
              <?= $m->getMarca(); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Precio mínimo -->
      <div class="col-md-2">
        <label for="min" class="form-label text-dark">Precio mínimo</label>
        <input type="number" name="min" id="min" value="<?= htmlspecialchars($min ?? ''); ?>" class="form-control">
      </div>

      <!-- Precio máximo -->
      <div class="col-md-2">
        <label for="max" class="form-label text-dark">Precio máximo</label>
        <input type="number" name="max" id="max" value="<?= htmlspecialchars($max ?? ''); ?>" class="form-control">
      </div>

      <!-- Botón -->
      <div class="col-md-4 text-end">
        <button type="submit" class="btn btn-accent w-100 border">Aplicar Filtros</button>
      </div>
    </div>
  </form>

  <!-- Productos -->
  <?php if (!empty($productos)): ?>
    <div class="row g-4">
      <?php foreach ($productos as $producto): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 bg-dark-accent text-light shadow-sm border-0">
            <img src="img/productos/<?= htmlspecialchars($producto->getFoto()); ?>" class="card-img-top text-dark" alt="<?= htmlspecialchars($producto->getNombre()); ?>">
            <div class="card-body d-flex flex-column justify-content-between">
              <p class="card-text small text-dark"><?= htmlspecialchars($producto->getPresentacion()); ?></p>
            </div>
            <div class="card-footer bg-transparent border-0">
              <h5 class="card-title text-dark"><?= htmlspecialchars($producto->getNombre()); ?></h5>
              <p class="fs-5 fw-bold text-accent">$<?= number_format($producto->getPrecio(), 2); ?></p>
              <a href="index.php?sec=detalle&id=<?= $producto->getIdProducto(); ?>" class="btn btn-outline-light w-100 mb-2 btn-primary">Más detalles</a>
              <a href="actions/carrito_action.php?action=agregar&id_producto=<?= $producto->getIdProducto(); ?>" class="btn btn-accent w-100 text-dark btn-success">
                <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="text-center">No se encontraron productos con esos filtros.</p>
  <?php endif; ?>
</section>
