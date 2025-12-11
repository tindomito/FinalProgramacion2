<?php
require_once "classes/Producto.php";

$id = $_GET['id'] ?? null;
$mensaje = $_GET['msg'] ?? null;
$producto = null;

if ($id && is_numeric($id)) {
    $producto = Producto::get_x_id($id);
}
?>

<section class="container py-5">
  <?php if ($mensaje === 'agregado'): ?>
    <div class="alert alert-dark border-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle text-success me-2"></i>Producto agregado al carrito correctamente.
      <a href="index.php?sec=carrito" class="alert-link text-accent">Ver carrito</a>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if ($producto): ?>
    <div class="row justify-content-center align-items-stretch g-4">
      <!-- Imagen del producto -->
      <div class="col-lg-6">
        <div class="product-image-card h-100">
          <div class="image-wrapper">
            <img src="img/productos/<?= htmlspecialchars($producto->getFoto()); ?>" alt="<?= htmlspecialchars($producto->getNombre()); ?>" class="img-fluid">
          </div>
        </div>
      </div>

      <!-- Detalles del producto -->
      <div class="col-lg-6">
        <div class="product-details-card h-100">
          <div class="product-info">
            <span class="badge bg-accent text-dark mb-3"><?= htmlspecialchars($producto->getMarca()); ?></span>
            <h1 class="product-title mb-3"><?= htmlspecialchars($producto->getNombre()); ?></h1>
            <p class="product-description text-muted"><?= htmlspecialchars($producto->getPresentacion()); ?></p>
          </div>

          <div class="product-purchase mt-auto">
            <div class="price-tag mb-4">
              <span class="price-label text-muted">Precio</span>
              <span class="price-value">$<?= number_format($producto->getPrecio(), 2); ?></span>
            </div>

            <div class="d-grid gap-3">
              <a href="actions/carrito_action.php?action=agregar&id_producto=<?= $producto->getIdProducto(); ?>" class="btn btn-accent btn-lg">
                <i class="bi bi-cart-plus me-2"></i>Agregar al carrito
              </a>
              <a href="index.php?sec=filtro" class="btn btn-outline-light btn-lg">
                <i class="bi bi-arrow-left me-2"></i>Volver al catálogo
              </a>
            </div>

            <div class="product-features mt-4">
              <div class="feature-item">
                <i class="bi bi-truck text-accent"></i>
                <span>Envío gratis</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-shield-check text-accent"></i>
                <span>Garantía oficial</span>
              </div>
              <div class="feature-item">
                <i class="bi bi-credit-card text-accent"></i>
                <span>Hasta 12 cuotas</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="text-center py-5">
      <i class="bi bi-exclamation-triangle display-1 text-warning"></i>
      <h2 class="text-light mt-4">Producto no encontrado</h2>
      <p class="text-muted">El producto que buscas no existe o fue eliminado.</p>
      <a href="index.php?sec=filtro" class="btn btn-accent mt-3">
        <i class="bi bi-arrow-left me-2"></i>Volver al catálogo
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

.bg-accent {
  background-color: #0dcaf0 !important;
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

.product-image-card {
  background-color: #1f1f1f;
  border: 1px solid #2a2a2a;
  border-radius: 16px;
  padding: 2rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.image-wrapper {
  background-color: #2a2a2a;
  border-radius: 12px;
  padding: 2rem;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.image-wrapper img {
  max-height: 350px;
  object-fit: contain;
  transition: transform 0.3s ease;
}

.image-wrapper:hover img {
  transform: scale(1.05);
}

.product-details-card {
  background-color: #1f1f1f;
  border: 1px solid #2a2a2a;
  border-radius: 16px;
  padding: 2rem;
  display: flex;
  flex-direction: column;
}

.product-title {
  color: #f5f5f5;
  font-weight: 700;
  font-size: 2rem;
}

.product-description {
  font-size: 1.1rem;
  line-height: 1.6;
}

.price-tag {
  background-color: #2a2a2a;
  border-radius: 12px;
  padding: 1rem 1.5rem;
  display: flex;
  flex-direction: column;
}

.price-label {
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.price-value {
  color: #0dcaf0;
  font-size: 2.5rem;
  font-weight: 700;
}

.product-features {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  padding-top: 1rem;
  border-top: 1px solid #2a2a2a;
}

.feature-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: #aaa;
}

.feature-item i {
  font-size: 1.1rem;
}

.alert-dark {
  background-color: #1f1f1f;
  color: #f5f5f5;
}

.btn-outline-light:hover {
  background-color: #f8f9fa;
  color: #121212;
}
</style>
