<section class="container py-5">
    <h1 class="mb-4 text-center text-dark">Carrito de Compras</h1>

    <!-- Contenedor vacío -->
    <div id="carrito-vacio" class="text-center py-5" style="display: none;">
        <i class="bi bi-cart-x display-1 text-muted"></i>
        <h3 class="mt-4 text-dark">Tu carrito está vacío</h3>
        <p class="text-muted">Agrega productos desde nuestro catálogo.</p>
        <a href="index.php?sec=filtro" class="btn btn-primary btn-lg mt-3">
            <i class="bi bi-shop me-2"></i>Ver productos
        </a>
    </div>

    <!-- Contenedor con productos -->
    <div id="carrito-contenido" style="display: none;">
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
                                <tbody id="carrito-items">
                                    <!-- Items se cargan con JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php?sec=filtro" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>Seguir comprando
                    </a>
                    <button type="button" onclick="vaciarCarrito()" class="btn btn-outline-danger">
                        <i class="bi bi-cart-x me-2"></i>Vaciar carrito
                    </button>
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
                            <span>Productos (<span id="total-items">0</span>)</span>
                            <span>$<span id="subtotal">0.00</span></span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Envío</span>
                            <span class="text-success">Gratis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong class="fs-5">Total</strong>
                            <strong class="fs-5 text-success">$<span id="total">0.00</span></strong>
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
    </div>
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

<script>
// Renderizar el carrito
function renderizarCarrito() {
    const carrito = Carrito.obtener();
    const carritoVacio = document.getElementById('carrito-vacio');
    const carritoContenido = document.getElementById('carrito-contenido');
    const carritoItems = document.getElementById('carrito-items');

    if (carrito.length === 0) {
        carritoVacio.style.display = 'block';
        carritoContenido.style.display = 'none';
        return;
    }

    carritoVacio.style.display = 'none';
    carritoContenido.style.display = 'block';

    let html = '';
    carrito.forEach(item => {
        const subtotal = item.precio * item.cantidad;
        html += `
            <tr>
                <td>
                    <img src="img/productos/${item.foto}"
                         alt="${item.nombre}"
                         class="img-fluid rounded"
                         style="max-width: 80px; max-height: 80px; object-fit: cover;">
                </td>
                <td class="align-middle">
                    <strong>${item.nombre}</strong>
                </td>
                <td class="align-middle text-center">
                    $${item.precio.toFixed(2)}
                </td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <button type="button" onclick="cambiarCantidad(${item.id}, ${item.cantidad - 1})"
                                class="btn btn-outline-secondary btn-sm" ${item.cantidad <= 1 ? 'disabled' : ''}>
                            <i class="bi bi-dash"></i>
                        </button>
                        <span class="fw-bold mx-2">${item.cantidad}</span>
                        <button type="button" onclick="cambiarCantidad(${item.id}, ${item.cantidad + 1})"
                                class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                </td>
                <td class="align-middle text-center fw-bold text-success">
                    $${subtotal.toFixed(2)}
                </td>
                <td class="align-middle text-center">
                    <button type="button" onclick="eliminarItem(${item.id})"
                            class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });

    carritoItems.innerHTML = html;
    actualizarTotales();
}

// Actualizar totales
function actualizarTotales() {
    const total = Carrito.calcularTotal();
    const items = Carrito.contarItems();

    document.getElementById('total-items').textContent = items;
    document.getElementById('subtotal').textContent = total.toFixed(2);
    document.getElementById('total').textContent = total.toFixed(2);
}

// Cambiar cantidad
function cambiarCantidad(id, cantidad) {
    Carrito.actualizarCantidad(id, cantidad);
    renderizarCarrito();
}

// Eliminar item
function eliminarItem(id) {
    if (confirm('¿Eliminar este producto del carrito?')) {
        Carrito.eliminar(id);
        renderizarCarrito();
    }
}

// Vaciar carrito
function vaciarCarrito() {
    if (confirm('¿Estás seguro de vaciar todo el carrito?')) {
        Carrito.vaciar();
        renderizarCarrito();
    }
}

// Inicializar al cargar
document.addEventListener('DOMContentLoaded', function() {
    renderizarCarrito();
});
</script>
