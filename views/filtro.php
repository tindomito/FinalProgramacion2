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

<section class="container py-5">
  <h1 class="mb-4 text-center text-light fw-bold">Catálogo de Productos</h1>

  <?php if ($mensaje === 'agregado'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle me-2"></i>Producto agregado al carrito correctamente.
      <a href="index.php?sec=carrito" class="alert-link">Ver carrito</a>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- Filtros -->
  <form method="GET" action="index.php" class="mb-5 bg-dark-accent p-4 rounded shadow">
    <input type="hidden" name="sec" value="filtro">

    <div class="row g-3 align-items-end">
      <!-- Marca -->
      <div class="col-md-4">
        <label for="marca" class="form-label text-light">Marca</label>
        <select name="marca" id="marca" class="form-select bg-dark text-light border-secondary">
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
        <label for="min" class="form-label text-light">Precio mínimo</label>
        <input type="number" name="min" id="min" value="<?= htmlspecialchars($min ?? ''); ?>" class="form-control bg-dark text-light border-secondary" placeholder="$0">
      </div>

      <!-- Precio máximo -->
      <div class="col-md-2">
        <label for="max" class="form-label text-light">Precio máximo</label>
        <input type="number" name="max" id="max" value="<?= htmlspecialchars($max ?? ''); ?>" class="form-control bg-dark text-light border-secondary" placeholder="$999999">
      </div>

      <!-- Botón -->
      <div class="col-md-4 text-end">
        <button type="submit" class="btn btn-accent w-100">
          <i class="bi bi-funnel me-2"></i>Aplicar Filtros
        </button>
      </div>
    </div>
  </form>

  <!-- Productos -->
  <?php if (!empty($productos)): ?>
    <div class="row g-4">
      <?php foreach ($productos as $producto): ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="card h-100 product-card shadow">
            <div class="card-img-wrapper">
              <img src="img/productos/<?= htmlspecialchars($producto->getFoto()); ?>" class="card-img-top" alt="<?= htmlspecialchars($producto->getNombre()); ?>">
            </div>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-light"><?= htmlspecialchars($producto->getNombre()); ?></h5>
              <p class="card-text small text-muted flex-grow-1"><?= htmlspecialchars($producto->getPresentacion()); ?></p>
              <p class="fs-4 fw-bold text-accent mb-3">$<?= number_format($producto->getPrecio(), 2); ?></p>
              <div class="d-grid gap-2">
                <a href="index.php?sec=detalle&id=<?= $producto->getIdProducto(); ?>" class="btn btn-outline-light btn-sm">
                  <i class="bi bi-eye me-1"></i>Ver detalles
                </a>
                <a href="actions/carrito_action.php?action=agregar&id_producto=<?= $producto->getIdProducto(); ?>" class="btn btn-accent btn-sm">
                  <i class="bi bi-cart-plus me-1"></i>Agregar al carrito
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="text-center py-5">
      <i class="bi bi-search display-1 text-muted"></i>
      <h3 class="mt-4 text-light">No se encontraron productos</h3>
      <p class="text-muted">Intenta ajustar los filtros de búsqueda.</p>
      <a href="index.php?sec=filtro" class="btn btn-outline-light mt-3">
        <i class="bi bi-arrow-clockwise me-2"></i>Limpiar filtros
      </a>
    </div>
  <?php endif; ?>
</section>

<style>
body {
  background-color: #121212;
  color: #f5f5f5;
}

.bg-dark-accent {
  background-color: #1f1f1f;
}

.text-accent {
  color: #0dcaf0 !important;
}

.btn-accent {
  background-color: #0dcaf0;
  border: none;
  color: #121212;
  font-weight: 500;
  transition: all 0.3s ease;
}

.btn-accent:hover {
  background-color: #0bb2d4;
  color: #fff;
  transform: translateY(-2px);
}

.product-card {
  background-color: #1f1f1f;
  border: 1px solid #2a2a2a;
  border-radius: 12px;
  overflow: hidden;
  transition: all 0.3s ease;
}

.product-card:hover {
  transform: translateY(-5px);
  border-color: #0dcaf0;
  box-shadow: 0 10px 30px rgba(13, 202, 240, 0.15) !important;
}

.card-img-wrapper {
  background-color: #2a2a2a;
  padding: 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 200px;
  overflow: hidden;
}

.card-img-wrapper img {
  max-height: 100%;
  width: auto;
  object-fit: contain;
  transition: transform 0.3s ease;
}

.product-card:hover .card-img-wrapper img {
  transform: scale(1.05);
}

.form-control:focus,
.form-select:focus {
  border-color: #0dcaf0;
  box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25);
}

.btn-outline-light:hover {
  background-color: #f8f9fa;
  color: #121212;
}
</style>
