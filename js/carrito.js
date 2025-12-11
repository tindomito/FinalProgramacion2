// Carrito de compras con localStorage

const Carrito = {
    STORAGE_KEY: 'carrito',

    // Obtener carrito del localStorage
    obtener: function() {
        const data = localStorage.getItem(this.STORAGE_KEY);
        return data ? JSON.parse(data) : [];
    },

    // Guardar carrito en localStorage
    guardar: function(carrito) {
        localStorage.setItem(this.STORAGE_KEY, JSON.stringify(carrito));
        this.actualizarContador();
    },

    // Agregar producto al carrito
    agregar: function(id, nombre, precio, foto) {
        const carrito = this.obtener();
        const index = carrito.findIndex(item => item.id === id);

        if (index !== -1) {
            carrito[index].cantidad++;
        } else {
            carrito.push({
                id: id,
                nombre: nombre,
                precio: parseFloat(precio),
                foto: foto,
                cantidad: 1
            });
        }

        this.guardar(carrito);
        return true;
    },

    // Eliminar producto del carrito
    eliminar: function(id) {
        let carrito = this.obtener();
        carrito = carrito.filter(item => item.id !== id);
        this.guardar(carrito);
    },

    // Actualizar cantidad de un producto
    actualizarCantidad: function(id, cantidad) {
        const carrito = this.obtener();
        const index = carrito.findIndex(item => item.id === id);

        if (index !== -1) {
            if (cantidad <= 0) {
                this.eliminar(id);
            } else {
                carrito[index].cantidad = cantidad;
                this.guardar(carrito);
            }
        }
    },

    // Contar items totales
    contarItems: function() {
        const carrito = this.obtener();
        return carrito.reduce((total, item) => total + item.cantidad, 0);
    },

    // Calcular total
    calcularTotal: function() {
        const carrito = this.obtener();
        return carrito.reduce((total, item) => total + (item.precio * item.cantidad), 0);
    },

    // Vaciar carrito
    vaciar: function() {
        localStorage.removeItem(this.STORAGE_KEY);
        this.actualizarContador();
    },

    // Verificar si está vacío
    estaVacio: function() {
        return this.obtener().length === 0;
    },

    // Actualizar contador en el header
    actualizarContador: function() {
        const contador = document.getElementById('cart-count');
        const cantidad = this.contarItems();

        if (contador) {
            if (cantidad > 0) {
                contador.textContent = cantidad > 99 ? '99+' : cantidad;
                contador.style.display = 'inline-block';
            } else {
                contador.style.display = 'none';
            }
        }
    },

    // Mostrar notificación
    mostrarNotificacion: function(mensaje) {
        // Eliminar notificación existente si hay
        const existente = document.querySelector('.cart-notification');
        if (existente) existente.remove();

        const notif = document.createElement('div');
        notif.className = 'cart-notification alert alert-success alert-dismissible fade show position-fixed';
        notif.style.cssText = 'top: 80px; right: 20px; z-index: 9999; min-width: 300px;';
        notif.innerHTML = `
            <i class="bi bi-check-circle me-2"></i>${mensaje}
            <a href="index.php?sec=carrito" class="alert-link ms-2">Ver carrito</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(notif);

        // Auto-cerrar después de 3 segundos
        setTimeout(() => {
            if (notif.parentNode) notif.remove();
        }, 3000);
    }
};

// Función global para agregar al carrito (llamada desde los botones)
function agregarAlCarrito(id, nombre, precio, foto) {
    Carrito.agregar(id, nombre, precio, foto);
    Carrito.mostrarNotificacion('Producto agregado al carrito');
    return false; // Prevenir navegación
}

// Inicializar contador al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    Carrito.actualizarContador();
});
