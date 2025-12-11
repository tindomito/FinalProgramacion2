<?php
require_once "classes/Secciones.php";
require_once "classes/Carrito.php";
$secciones = Secciones::secciones_del_sitio();
$cantidadCarrito = Carrito::contarItems();
?>

<header class="bg-dark shadow-sm">
  <nav class="navbar navbar-expand-lg navbar-dark container">
    <a class="navbar-brand fw-bold text-accent" href="?sec=inicio">INDOMITO Tech</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php foreach ($secciones as $value): ?>
          <?php if ($value->getInMenu()): ?>
            <li class="nav-item">
              <a class="nav-link <?php if($_GET['sec'] ?? 'inicio' === $value->getVinculo()) echo 'active'; ?>" href="?sec=<?= $value->getVinculo(); ?>">
                <?= $value->getTexto(); ?>
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
        <li class="nav-item ms-lg-3">
          <a class="nav-link position-relative <?php if(($_GET['sec'] ?? '') === 'carrito') echo 'active'; ?>" href="?sec=carrito" title="Ver carrito">
            <i class="bi bi-cart3 fs-5"></i>
            <?php if ($cantidadCarrito > 0): ?>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                <?= $cantidadCarrito > 99 ? '99+' : $cantidadCarrito; ?>
              </span>
            <?php endif; ?>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>
<style>
    .bg-dark {
  background-color: #1e1e1e !important;
}

.navbar-brand {
  font-size: 1.5rem;
  letter-spacing: 1px;
}

.text-accent {
  color: #0dcaf0 !important;
}

.navbar-dark .navbar-nav .nav-link {
  color: #ddd;
  transition: all 0.2s ease-in-out;
}

.navbar-dark .navbar-nav .nav-link:hover,
.navbar-dark .navbar-nav .nav-link.active {
  color: #0dcaf0;
  border-bottom: 2px solid #0dcaf0;
}

.cart-badge {
  font-size: 0.65rem;
  padding: 0.25em 0.5em;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% {
    transform: translate(-50%, -50%) scale(1);
  }
  50% {
    transform: translate(-50%, -50%) scale(1.1);
  }
}

</style>