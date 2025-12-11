<?php
require_once "classes/Carrito.php";

$items = Carrito::obtenerItems();
$total = Carrito::calcularTotal();
$totalItems = Carrito::contarItems();

// Si el carrito está vacío, redirigir
if (Carrito::estaVacio()) {
    header("Location: index.php?sec=carrito");
    exit;
}
?>

<section class="container py-5">
    <h1 class="mb-4 text-center text-light fw-bold">
        <i class="bi bi-credit-card me-2"></i>Checkout
    </h1>
    <p class="text-center text-muted mb-5">Completa tus datos para finalizar la compra</p>

    <form id="checkoutForm" action="index.php?sec=compra-exitosa" method="POST">
        <div class="row g-4">
            <!-- Formulario de datos -->
            <div class="col-lg-8">
                <!-- Datos de envío -->
                <div class="card checkout-card shadow mb-4">
                    <div class="card-header">
                        <h5 class="mb-0 text-light">
                            <i class="bi bi-truck me-2 text-accent"></i>Datos de Envío
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label text-light">Nombre completo</label>
                                <input type="text" class="form-control form-control-dark" id="nombre" name="nombre" placeholder="Juan Pérez" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label text-light">Email</label>
                                <input type="email" class="form-control form-control-dark" id="email" name="email" placeholder="juan@email.com" required>
                            </div>
                            <div class="col-12">
                                <label for="direccion" class="form-label text-light">Dirección</label>
                                <input type="text" class="form-control form-control-dark" id="direccion" name="direccion" placeholder="Av. Siempre Viva 742" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ciudad" class="form-label text-light">Ciudad</label>
                                <input type="text" class="form-control form-control-dark" id="ciudad" name="ciudad" placeholder="Buenos Aires" required>
                            </div>
                            <div class="col-md-6">
                                <label for="codigoPostal" class="form-label text-light">Código Postal</label>
                                <input type="text" class="form-control form-control-dark" id="codigoPostal" name="codigoPostal" placeholder="1234" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label text-light">Teléfono</label>
                                <input type="tel" class="form-control form-control-dark" id="telefono" name="telefono" placeholder="+54 11 1234-5678" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Datos de tarjeta -->
                <div class="card checkout-card shadow">
                    <div class="card-header">
                        <h5 class="mb-0 text-light">
                            <i class="bi bi-credit-card-2-front me-2 text-accent"></i>Datos de Tarjeta de Crédito
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info-dark mb-4">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Solo aceptamos tarjetas de crédito</strong> - Esta es una simulación, los datos no serán procesados.
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="numeroTarjeta" class="form-label text-light">Número de tarjeta</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark-input border-dark-input">
                                        <i class="bi bi-credit-card text-accent"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-dark" id="numeroTarjeta" name="numeroTarjeta"
                                           placeholder="1234 5678 9012 3456" maxlength="19" required
                                           oninput="formatCardNumber(this)">
                                </div>
                                <div class="card-icons mt-2">
                                    <i class="bi bi-credit-card-2-back me-2 text-muted" title="Visa"></i>
                                    <span class="badge bg-secondary">Visa</span>
                                    <span class="badge bg-secondary ms-1">Mastercard</span>
                                    <span class="badge bg-secondary ms-1">Amex</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="nombreTarjeta" class="form-label text-light">Nombre en la tarjeta</label>
                                <input type="text" class="form-control form-control-dark" id="nombreTarjeta" name="nombreTarjeta"
                                       placeholder="JUAN PEREZ" style="text-transform: uppercase;" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fechaExpiracion" class="form-label text-light">Fecha de expiración</label>
                                <input type="text" class="form-control form-control-dark" id="fechaExpiracion" name="fechaExpiracion"
                                       placeholder="MM/AA" maxlength="5" required
                                       oninput="formatExpDate(this)">
                            </div>
                            <div class="col-md-6">
                                <label for="cvv" class="form-label text-light">CVV</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-dark" id="cvv" name="cvv"
                                           placeholder="123" maxlength="4" required>
                                    <span class="input-group-text bg-dark-input border-dark-input"
                                          data-bs-toggle="tooltip" data-bs-placement="top"
                                          title="Los 3 o 4 dígitos en el reverso de tu tarjeta">
                                        <i class="bi bi-question-circle text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Tipo de tarjeta -->
                        <div class="mt-4">
                            <label class="form-label text-light">Tipo de tarjeta</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoTarjeta" id="credito" value="credito" checked>
                                    <label class="form-check-label text-light" for="credito">
                                        <i class="bi bi-credit-card me-1 text-accent"></i>Crédito
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoTarjeta" id="debito" value="debito" disabled>
                                    <label class="form-check-label text-muted" for="debito">
                                        <i class="bi bi-credit-card me-1"></i>Débito <small>(No disponible)</small>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Cuotas -->
                        <div class="mt-4">
                            <label for="cuotas" class="form-label text-light">Cuotas</label>
                            <select class="form-select form-select-dark" id="cuotas" name="cuotas">
                                <option value="1">1 cuota de $<?= number_format($total, 2); ?> (sin interés)</option>
                                <option value="3">3 cuotas de $<?= number_format($total / 3, 2); ?> (sin interés)</option>
                                <option value="6">6 cuotas de $<?= number_format($total / 6, 2); ?> (sin interés)</option>
                                <option value="12">12 cuotas de $<?= number_format($total / 12, 2); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumen del pedido -->
            <div class="col-lg-4">
                <div class="card summary-card shadow sticky-top" style="top: 20px;">
                    <div class="card-header">
                        <h5 class="mb-0 text-light">
                            <i class="bi bi-receipt me-2 text-accent"></i>Resumen del pedido
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Lista de productos -->
                        <div class="products-list mb-3">
                            <?php foreach ($items as $item): ?>
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom border-secondary">
                                    <div class="d-flex align-items-center">
                                        <div class="product-thumb me-2">
                                            <img src="img/productos/<?= htmlspecialchars($item['foto']); ?>"
                                                 alt="<?= htmlspecialchars($item['nombre']); ?>">
                                        </div>
                                        <div>
                                            <small class="text-light d-block"><?= htmlspecialchars($item['nombre']); ?></small>
                                            <small class="text-muted">x<?= $item['cantidad']; ?></small>
                                        </div>
                                    </div>
                                    <span class="text-light">$<?= number_format($item['precio'] * $item['cantidad'], 2); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal (<?= $totalItems; ?> productos)</span>
                            <span class="text-light">$<?= number_format($total, 2); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Envío</span>
                            <span class="text-success">Gratis</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Impuestos</span>
                            <span class="text-light">$0.00</span>
                        </div>
                        <hr class="border-secondary">
                        <div class="d-flex justify-content-between mb-4">
                            <strong class="fs-5 text-light">Total</strong>
                            <strong class="fs-5 text-accent">$<?= number_format($total, 2); ?></strong>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-accent btn-lg">
                                <i class="bi bi-lock me-2"></i>Confirmar Compra
                            </button>
                            <a href="index.php?sec=carrito" class="btn btn-outline-light">
                                <i class="bi bi-arrow-left me-2"></i>Volver al carrito
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Info de seguridad -->
                <div class="card mt-3 info-card shadow">
                    <div class="card-body">
                        <h6 class="card-title text-light">
                            <i class="bi bi-shield-lock me-2 text-accent"></i>Pago 100% Seguro
                        </h6>
                        <p class="card-text small text-muted mb-0">
                            Esta es una simulación. Ningún dato será procesado ni almacenado.
                        </p>
                    </div>
                </div>

                <div class="card mt-3 info-card shadow">
                    <div class="card-body">
                        <h6 class="card-title text-light">
                            <i class="bi bi-arrow-repeat me-2 text-accent"></i>Devolución gratuita
                        </h6>
                        <p class="card-text small text-muted mb-0">
                            30 días para cambios y devoluciones sin costo.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-accent:hover {
    background-color: #0bb2d4;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(13, 202, 240, 0.3);
}

.checkout-card,
.summary-card,
.info-card {
    background-color: #1f1f1f;
    border: 1px solid #2a2a2a;
    border-radius: 12px;
    overflow: hidden;
}

.checkout-card .card-header,
.summary-card .card-header {
    background-color: #1a1a1a;
    border-bottom: 1px solid #2a2a2a;
    padding: 1rem 1.25rem;
}

/* Form controls dark theme */
.form-control-dark,
.form-select-dark {
    background-color: #2a2a2a;
    border: 1px solid #3a3a3a;
    color: #f5f5f5;
    transition: all 0.2s ease;
}

.form-control-dark:focus,
.form-select-dark:focus {
    background-color: #2a2a2a;
    border-color: #0dcaf0;
    color: #f5f5f5;
    box-shadow: 0 0 0 0.2rem rgba(13, 202, 240, 0.25);
}

.form-control-dark::placeholder {
    color: #666;
}

.bg-dark-input {
    background-color: #2a2a2a !important;
}

.border-dark-input {
    border-color: #3a3a3a !important;
}

/* Alert info dark */
.alert-info-dark {
    background-color: rgba(13, 202, 240, 0.1);
    border: 1px solid rgba(13, 202, 240, 0.3);
    color: #0dcaf0;
    border-radius: 8px;
}

/* Form check styling */
.form-check-input {
    background-color: #2a2a2a;
    border-color: #3a3a3a;
}

.form-check-input:checked {
    background-color: #0dcaf0;
    border-color: #0dcaf0;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 202, 240, 0.25);
}

/* Product thumbnail */
.product-thumb {
    width: 45px;
    height: 45px;
    background-color: #2a2a2a;
    border-radius: 6px;
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

/* Products list scrollable */
.products-list {
    max-height: 200px;
    overflow-y: auto;
}

.products-list::-webkit-scrollbar {
    width: 6px;
}

.products-list::-webkit-scrollbar-track {
    background: #2a2a2a;
    border-radius: 3px;
}

.products-list::-webkit-scrollbar-thumb {
    background: #3a3a3a;
    border-radius: 3px;
}

.products-list::-webkit-scrollbar-thumb:hover {
    background: #0dcaf0;
}

/* Button outline light */
.btn-outline-light:hover {
    background-color: #f8f9fa;
    color: #121212;
}

/* Card icons */
.card-icons {
    font-size: 0.85rem;
}

/* Form label */
.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}
</style>

<script>
// Formatear número de tarjeta
function formatCardNumber(input) {
    let value = input.value.replace(/\s/g, '').replace(/\D/g, '');
    let formatted = '';
    for (let i = 0; i < value.length && i < 16; i++) {
        if (i > 0 && i % 4 === 0) {
            formatted += ' ';
        }
        formatted += value[i];
    }
    input.value = formatted;
}

// Formatear fecha de expiración
function formatExpDate(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length >= 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    input.value = value;
}

// Inicializar tooltips de Bootstrap
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
