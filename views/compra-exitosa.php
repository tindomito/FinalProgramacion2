<?php
require_once "classes/Carrito.php";

// Obtener datos del carrito antes de vaciarlo
$items = Carrito::obtenerItems();
$total = Carrito::calcularTotal();
$totalItems = Carrito::contarItems();

// Generar número de orden ficticio
$numeroOrden = 'ORD-' . strtoupper(substr(md5(time() . rand()), 0, 8));

// Obtener datos del formulario (si existen)
$nombre = $_POST['nombre'] ?? 'Cliente';
$email = $_POST['email'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$ciudad = $_POST['ciudad'] ?? '';
$codigoPostal = $_POST['codigoPostal'] ?? '';

// Vaciar el carrito después de "procesar" la compra
Carrito::vaciar();

// Fecha estimada de entrega (3-5 días)
$fechaEntrega = date('d/m/Y', strtotime('+4 days'));
?>

<section class="container py-5">
    <!-- Mensaje de éxito -->
    <div class="text-center mb-5">
        <div class="success-icon mb-4">
            <div class="success-checkmark">
                <i class="bi bi-check-lg"></i>
            </div>
        </div>
        <h1 class="text-light fw-bold mb-3">¡Compra Exitosa!</h1>
        <p class="text-muted fs-5">Gracias por tu compra, <?= htmlspecialchars($nombre); ?>.</p>
        <p class="text-accent fs-4 fw-bold">Orden #<?= $numeroOrden; ?></p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-8">
            <!-- Alerta de simulación -->
            <div class="alert alert-simulation mb-4">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Esto es una simulación.</strong> No se ha realizado ningún cargo real. Los datos ingresados no fueron procesados ni almacenados.
            </div>

            <!-- Detalles de la orden -->
            <div class="card order-card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0 text-light">
                        <i class="bi bi-receipt me-2 text-accent"></i>Detalles de la Orden
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted mb-2">Información de envío</h6>
                            <p class="text-light mb-1"><strong><?= htmlspecialchars($nombre); ?></strong></p>
                            <?php if ($direccion): ?>
                                <p class="text-muted mb-1"><?= htmlspecialchars($direccion); ?></p>
                            <?php endif; ?>
                            <?php if ($ciudad || $codigoPostal): ?>
                                <p class="text-muted mb-1"><?= htmlspecialchars($ciudad); ?> <?= htmlspecialchars($codigoPostal); ?></p>
                            <?php endif; ?>
                            <?php if ($email): ?>
                                <p class="text-muted mb-0"><?= htmlspecialchars($email); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="text-muted mb-2">Información del pedido</h6>
                            <p class="text-light mb-1"><strong>Orden:</strong> <?= $numeroOrden; ?></p>
                            <p class="text-light mb-1"><strong>Fecha:</strong> <?= date('d/m/Y H:i'); ?></p>
                            <p class="text-light mb-1"><strong>Método de pago:</strong> Tarjeta de Crédito</p>
                            <p class="text-accent mb-0"><strong>Estado:</strong> <span class="badge bg-success">Confirmado</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumen de productos -->
            <?php if (!empty($items)): ?>
            <div class="card order-card shadow mb-4">
                <div class="card-header">
                    <h5 class="mb-0 text-light">
                        <i class="bi bi-box-seam me-2 text-accent"></i>Productos Comprados
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dark mb-0">
                            <thead>
                                <tr class="border-secondary">
                                    <th>Producto</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-end">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): ?>
                                    <tr class="border-secondary">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="product-thumb me-3">
                                                    <img src="img/productos/<?= htmlspecialchars($item['foto']); ?>"
                                                         alt="<?= htmlspecialchars($item['nombre']); ?>">
                                                </div>
                                                <span class="text-light"><?= htmlspecialchars($item['nombre']); ?></span>
                                            </div>
                                        </td>
                                        <td class="text-center text-muted align-middle">x<?= $item['cantidad']; ?></td>
                                        <td class="text-end text-light align-middle">$<?= number_format($item['precio'] * $item['cantidad'], 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="border-secondary">
                                    <td colspan="2" class="text-end text-muted">Subtotal:</td>
                                    <td class="text-end text-light">$<?= number_format($total, 2); ?></td>
                                </tr>
                                <tr class="border-secondary">
                                    <td colspan="2" class="text-end text-muted">Envío:</td>
                                    <td class="text-end text-success">Gratis</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end"><strong class="text-light fs-5">Total:</strong></td>
                                    <td class="text-end"><strong class="text-accent fs-5">$<?= number_format($total, 2); ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Información de entrega -->
            <div class="card order-card shadow mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="delivery-icon">
                                <i class="bi bi-truck text-accent"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="text-light mb-1">Entrega estimada</h6>
                            <p class="text-muted mb-0">Tu pedido llegará aproximadamente el <strong class="text-accent"><?= $fechaEntrega; ?></strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones -->
            <div class="d-flex flex-wrap gap-3 justify-content-center mt-5">
                <a href="index.php?sec=inicio" class="btn btn-accent btn-lg">
                    <i class="bi bi-house me-2"></i>Volver al inicio
                </a>
                <a href="index.php?sec=filtro" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-shop me-2"></i>Seguir comprando
                </a>
            </div>

            <!-- Mensaje adicional -->
            <div class="text-center mt-5">
                <p class="text-muted">
                    <i class="bi bi-envelope me-2"></i>
                    <?php if ($email): ?>
                        Se ha enviado una confirmación a <strong class="text-light"><?= htmlspecialchars($email); ?></strong> (simulado)
                    <?php else: ?>
                        Recibirás un email de confirmación (simulado)
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<style>
body {
    background-color: #121212;
    color: #f5f5f5;
}

.text-accent {
    color: #0dcaf0 !important;
}

.btn-accent {
    background-color: #0dcaf0;
    border: none;
    color: #121212;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-accent:hover {
    background-color: #0bb2d4;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(13, 202, 240, 0.3);
}

.btn-outline-light:hover {
    background-color: #f8f9fa;
    color: #121212;
}

/* Success icon animation */
.success-icon {
    display: inline-block;
}

.success-checkmark {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #0dcaf0 0%, #0bb2d4 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: scaleIn 0.5s ease-out, pulse 2s infinite;
    box-shadow: 0 0 30px rgba(13, 202, 240, 0.4);
}

.success-checkmark i {
    font-size: 3rem;
    color: #121212;
}

@keyframes scaleIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes pulse {
    0%, 100% {
        box-shadow: 0 0 30px rgba(13, 202, 240, 0.4);
    }
    50% {
        box-shadow: 0 0 50px rgba(13, 202, 240, 0.6);
    }
}

/* Alert simulation */
.alert-simulation {
    background-color: rgba(13, 202, 240, 0.1);
    border: 1px solid rgba(13, 202, 240, 0.3);
    color: #0dcaf0;
    border-radius: 12px;
    padding: 1rem 1.25rem;
}

/* Order card */
.order-card {
    background-color: #1f1f1f;
    border: 1px solid #2a2a2a;
    border-radius: 12px;
    overflow: hidden;
}

.order-card .card-header {
    background-color: #1a1a1a;
    border-bottom: 1px solid #2a2a2a;
    padding: 1rem 1.25rem;
}

/* Table dark */
.table-dark {
    --bs-table-bg: #1f1f1f;
    --bs-table-hover-bg: #2a2a2a;
}

/* Product thumbnail */
.product-thumb {
    width: 50px;
    height: 50px;
    background-color: #2a2a2a;
    border-radius: 8px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-thumb img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

/* Delivery icon */
.delivery-icon {
    width: 60px;
    height: 60px;
    background-color: rgba(13, 202, 240, 0.1);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.delivery-icon i {
    font-size: 1.75rem;
}

/* Badge success */
.badge.bg-success {
    background-color: #198754 !important;
}
</style>
