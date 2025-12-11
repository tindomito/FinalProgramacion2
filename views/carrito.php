<?php
require_once "classes/Carrito.php";

$items = Carrito::obtenerItems();
$total = Carrito::calcularTotal();
$totalItems = Carrito::contarItems();
$mensaje = $_GET['msg'] ?? null;
?>

<section class="container py-5">
    <h1 class="mb-4 text-center text-dark">Carrito de Compras</h1>

    <?php if ($mensaje === 'agregado'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>Producto agregado al carrito correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($mensaje === 'eliminado'): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-trash me-2"></i>Producto eliminado del carrito.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($mensaje === 'actualizado'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-arrow-repeat me-2"></i>Cantidad actualizada correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif ($mensaje === 'vaciado'): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-cart-x me-2"></i>El carrito ha sido vaciado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (Carrito::estaVacio()): ?>
        <div class="text-center py-5">
            <i class="bi bi-cart-x display-1 text-muted"></i>
            <h3 class="mt-4 text-dark">Tu carrito está vacío</h3>
            <p class="text-muted">Agrega productos desde nuestro catálogo.</p>
            <a href="index.php?sec=filtro" class="btn btn-primary btn-lg mt-3">
                <i class="bi bi-shop me-2"></i>Ver productos
            </a>
        </div>
    <?php else: ?>
        <div class="row">
            <!-- Lista de productos -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="bi bi-cart3 me-2"></i>Productos en tu carrito</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
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
                                        <tr>
                                            <td>
                                                <img src="img/productos/<?= htmlspecialchars($item['foto']); ?>"
                                                     alt="<?= htmlspecialchars($item['nombre']); ?>"
                                                     class="img-fluid rounded"
                                                     style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                            </td>
                                            <td class="align-middle">
                                                <strong><?= htmlspecialchars($item['nombre']); ?></strong>
                                            </td>
                                            <td class="align-middle text-center">
                                                $<?= number_format($item['precio'], 2); ?>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-center align-items-center gap-2">
                                                    <?php if ($item['cantidad'] > 1): ?>
                                                        <a href="actions/carrito_action.php?action=actualizar&id_producto=<?= $item['id_producto']; ?>&cantidad=<?= $item['cantidad'] - 1; ?>" class="btn btn-outline-secondary btn-sm">
                                                            <i class="bi bi-dash"></i>
                                                        </a>
                                                    <?php else: ?>
                                                        <button class="btn btn-outline-secondary btn-sm" disabled>
                                                            <i class="bi bi-dash"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                    <span class="fw-bold mx-2"><?= $item['cantidad']; ?></span>
                                                    <a href="actions/carrito_action.php?action=actualizar&id_producto=<?= $item['id_producto']; ?>&cantidad=<?= $item['cantidad'] + 1; ?>" class="btn btn-outline-secondary btn-sm">
                                                        <i class="bi bi-plus"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center fw-bold text-success">
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

                <div class="d-flex justify-content-between">
                    <a href="index.php?sec=filtro" class="btn btn-outline-primary">
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
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="bi bi-receipt me-2"></i>Resumen del pedido</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Productos (<?= $totalItems; ?>)</span>
                            <span>$<?= number_format($total, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Envío</span>
                            <span class="text-success">Gratis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong class="fs-5">Total</strong>
                            <strong class="fs-5 text-success">$<?= number_format($total, 2); ?></strong>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-success btn-lg" onclick="alert('Funcionalidad de checkout próximamente');">
                                <i class="bi bi-credit-card me-2"></i>Proceder al pago
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <h6 class="card-title"><i class="bi bi-shield-check me-2 text-success"></i>Compra segura</h6>
                        <p class="card-text small text-muted mb-0">Tus datos están protegidos y tu compra es 100% segura.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<style>
.table th, .table td {
    vertical-align: middle;
}
.card {
    border: none;
}
.card-header {
    border-bottom: none;
}
</style>
