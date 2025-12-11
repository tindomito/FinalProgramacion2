<?php
require_once "classes/Carrito.php";

$items = Carrito::obtenerItems();
$total = Carrito::calcularTotal();
$totalItems = Carrito::contarItems();
$mensaje = $_GET['msg'] ?? null;
?>

<section class="container py-5">
    <h1 class="mb-4 text-center text-light fw-bold">
        <i class="bi bi-cart3 me-2"></i>Carrito de Compras
    </h1>

    <?php if ($mensaje === 'agregado'): ?>
        <div class="alert alert-dark border-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle text-success me-2"></i>Producto agregado al carrito correctamente.
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($mensaje === 'eliminado'): ?>
        <div class="alert alert-dark border-info alert-dismissible fade show" role="alert">
            <i class="bi bi-trash text-info me-2"></i>Producto eliminado del carrito.
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($mensaje === 'actualizado'): ?>
        <div class="alert alert-dark border-success alert-dismissible fade show" role="alert">
            <i class="bi bi-arrow-repeat text-success me-2"></i>Cantidad actualizada correctamente.
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($mensaje === 'vaciado'): ?>
        <div class="alert alert-dark border-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-cart-x text-warning me-2"></i>El carrito ha sido vaciado.
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (Carrito::estaVacio()): ?>
        <div class="text-center py-5">
            <div class="empty-cart-icon mb-4">
                <i class="bi bi-cart-x display-1 text-muted"></i>
            </div>
            <h3 class="mt-4 text-light">Tu carrito está vacío</h3>
            <p class="text-muted">Agrega productos desde nuestro catálogo.</p>
            <a href="index.php?sec=filtro" class="btn btn-accent btn-lg mt-3">
                <i class="bi bi-shop me-2"></i>Ver productos
            </a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <!-- Lista de productos -->
            <div class="col-lg-8">
                <div class="card cart-card shadow">
                    <div class="card-header">
                        <h5 class="mb-0 text-light">
                            <i class="bi bi-box-seam me-2 text-accent"></i>Productos en tu carrito
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover mb-0">
                                <thead>
                                    <tr class="border-secondary">
                                        <th style="width: 100px;">Imagen</th>
                                        <th>Producto</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center" style="width: 150px;">Cantidad</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                        <tr class="border-secondary">
                                            <td>
                                                <div class="cart-img-wrapper">
                                                    <img src="img/productos/<?= htmlspecialchars($item['foto']); ?>"
                                                         alt="<?= htmlspecialchars($item['nombre']); ?>"
                                                         class="img-fluid rounded">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <strong class="text-light"><?= htmlspecialchars($item['nombre']); ?></strong>
                                            </td>
                                            <td class="align-middle text-center text-muted">
                                                $<?= number_format($item['precio'], 2); ?>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <?php if ($item['cantidad'] > 1): ?>
                                                        <a href="actions/carrito_action.php?action=actualizar&id_producto=<?= $item['id_producto']; ?>&cantidad=<?= $item['cantidad'] - 1; ?>" class="btn btn-outline-light btn-sm qty-btn">
                                                            <i class="bi bi-dash"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <button class="btn btn-outline-secondary btn-sm qty-btn" disabled>
                                                            <i class="bi bi-dash"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <span class="fw-bold mx-2 text-light"><?= $item['cantidad']; ?></span>
                                                    <a href="actions/carrito_action.php?action=actualizar&id_producto=<?= $item['id_producto']; ?>&cantidad=<?= $item['cantidad'] + 1; ?>" class="btn btn-outline-light btn-sm qty-btn">
                                                        <i class="bi bi-plus"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center fw-bold text-accent">
                                                $<?= number_format($item['precio'] * $item['cantidad'], 2); ?>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="actions/carrito_action.php?action=eliminar&id_producto=<?= $item['id_producto']; ?>"
                                                   class="btn btn-outline-danger btn-sm"
                                                   onclick="return confirm('¿Eliminar este producto del carrito?');">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="index.php?sec=filtro" class="btn btn-outline-light">
                        <i class="bi bi-arrow-left me-2"></i>Seguir comprando
                    </a>
                    <a href="actions/carrito_action.php?action=vaciar"
                       class="btn btn-outline-danger"
                       onclick="return confirm('¿Estás seguro de vaciar todo el carrito?');">
                        <i class="bi bi-cart-x me-2"></i>Vaciar carrito
                    </a>
                </div>
            </div>

            <!-- Resumen del pedido -->
            <div class="col-lg-4">
                <div class="card summary-card shadow">
                    <div class="card-header">
                        <h5 class="mb-0 text-light">
                            <i class="bi bi-receipt me-2 text-accent"></i>Resumen del pedido
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Productos (<?= $totalItems; ?>)</span>
                            <span class="text-light">$<?= number_format($total, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Envío</span>
                            <span class="text-success">Gratis</span>
                        </div>
                        <hr class="border-secondary">
                        <div class="d-flex justify-content-between mb-4">
                            <strong class="fs-5 text-light">Total</strong>
                            <strong class="fs-5 text-accent">$<?= number_format($total, 2); ?></strong>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-accent btn-lg" onclick="alert('Funcionalidad de checkout próximamente');">
                                <i class="bi bi-credit-card me-2"></i>Proceder al pago
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card mt-3 info-card shadow">
                    <div class="card-body">
                        <h6 class="card-title text-light">
                            <i class="bi bi-shield-check me-2 text-accent"></i>Compra segura
                        </h6>
                        <p class="card-text small text-muted mb-0">
                            Tus datos están protegidos y tu compra es 100% segura.
                        </p>
                    </div>
                </div>

                <div class="card mt-3 info-card shadow">
                    <div class="card-body">
                        <h6 class="card-title text-light">
                            <i class="bi bi-truck me-2 text-accent"></i>Envío express
                        </h6>
                        <p class="card-text small text-muted mb-0">
                            Entrega en 24-48hs a todo el país.
                        </p>
                    </div>
                </div>
            </div>
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

.cart-card,
.summary-card,
.info-card {
  background-color: #1f1f1f;
  border: 1px solid #2a2a2a;
  border-radius: 12px;
  overflow: hidden;
}

.cart-card .card-header,
.summary-card .card-header {
  background-color: #1a1a1a;
  border-bottom: 1px solid #2a2a2a;
  padding: 1rem 1.25rem;
}

.table-dark {
  --bs-table-bg: #1f1f1f;
  --bs-table-hover-bg: #2a2a2a;
}

.cart-img-wrapper {
  width: 80px;
  height: 80px;
  background-color: #2a2a2a;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.5rem;
}

.cart-img-wrapper img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.qty-btn {
  width: 32px;
  height: 32px;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.empty-cart-icon {
  opacity: 0.5;
}

.alert-dark {
  background-color: #1f1f1f;
  color: #f5f5f5;
}

.btn-outline-light:hover {
  background-color: #f8f9fa;
  color: #121212;
}

.btn-outline-danger:hover {
  background-color: #dc3545;
  border-color: #dc3545;
}
</style>
